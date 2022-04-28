<?php

namespace App\Http\Controllers\Partner;

use App\Helpers\MailHelper;
use App\Helpers\SmsHelper;
use App\Http\Requests\Auth\AuthOtpRequest;
use App\Http\Requests\TransferLogCreateRequest;
use App\Mail\SendMailOtp;
use App\Models\AuthOtp;
use App\Models\PartnerBankTransfer;
use App\Repositories\PartnerBankTransferRepository;
use App\Rules\AmountValid;
use App\Rules\FileValid;
use App\Services\File\UploadFileService;
use App\Services\Gate\PartnerService;
use App\Services\Partner\PartnerBankAccountService;
use App\Services\System\AuthOtpService;
use App\Services\System\TransferAccountService;
use App\Services\System\TransferTransactionService;
use App\Services\System\TransferLogService;
use Carbon\Carbon;
use Erdemkeren\Otp\OtpFacade;
use Illuminate\Http\Request;
use App\Services\ValidationService;
use App\Http\Controllers\Controller;

class AuthOtpController extends Controller
{
    protected $validator;
    protected $request;
    protected $partnerBankAccountService;
    protected $authOtpService;
    protected $partnerBankTransferRepository;
    protected $channelMailOtp = 'partner_bank_mail';
    protected $channelSmsOtp = 'partner_bank_sms';

    public function __construct(ValidationService $validator,
                                AuthOtpService $authOtpService,
                                PartnerBankAccountService $partnerBankAccountService,
                                PartnerBankTransferRepository $partnerBankTransferRepository,
                                Request $request)
    {
        $this->validator = $validator;
        $this->partnerBankAccountService = $partnerBankAccountService;
        $this->request = $request;
        $this->authOtpService = $authOtpService;
        $this->partnerBankTransferRepository = $partnerBankTransferRepository;
    }

    public function sendOtp(Request $request)
    {
        $genCode = AuthOtp::generateOtpCode();
        $code = $genCode['code'];
        $data = [
            'email' => null,
            'phone' => SmsHelper::getDefaultPhoneForOtpCodePartnerBankAccountTransfer(),
            'secure_code' => $genCode['secure_code'],
            'expired_at' => now()->addMinutes(10),
            'max_retry' => 5,
            'times_retry' => 0,
        ];
        $channel = $this->channelSmsOtp;
        if (!$data['email'] && !$data['phone']) {
            return response(['success' => false, 'message' => 'Vui lòng nhập thông tin sms/email nhận OTP']);
        }
        $otpCountTime = $this->authOtpService->getOtpCountTime($channel);
        if ($otpCountTime) {
            return response(['success' => false, 'message' => 'Vui lòng gửi lại sau ' . $otpCountTime . ' giây']);
        }
        $success = $this->authOtpService->sendSmsOtp($data['phone'], $code);

        if (!$success) {
            return response(['success' => false]);
        }
        $this->authOtpService->setExpireTime(60, $channel);
        $this->authOtpService->createOtp($data);
        $otpCountTime = $this->authOtpService->getOtpCountTime($channel);
        $expiredAt = now()->addSeconds($otpCountTime)->getTimestamp();
        if (isset($params) && $params['file_url']) {
            return response(['success' => true, 'file_url' => $params['file_url'], 'expiredAt' => $expiredAt]);
        }
        return response(['success' => true, 'expiredAt' => $expiredAt]);
    }

    public function confirmEmailOtp($id, Request $request)
    {
        $validator = \Validator::make($request->only('code'), [
            'code' => 'required'
        ], ['code.*' => 'Vui lòng nhập mã OTP trong email']);
        if ($validator->fails()) {
            return response(['errors' => $validator->getMessageBag()], 400);
        }

        ## check transacion
        $transaction = $this->partnerBankTransferRepository->getById($id);
        if (!$transaction || $transaction->partner_ref_id) {
            return response(['errors' => ['code' => 'Không tìm thấy giao dịch này']], 400);
        }
        // check otp valid
        $otpEmail = $this->authOtpService->getByEmail(MailHelper::getDefaultEmailForOtpCodePartnerBankAccountTransfer(), false);

        if (!$otpEmail) {
            return response(['errors' => ['code' => 'Mã OTP Email không chính xác, vui lòng thử lại'], 'message' => 'Thất bại'], 400);
        }

        $errors = [];
        $otpEmailValid = $this->authOtpService->isOtpValid($request->code, $otpEmail);
        if (!$otpEmailValid['is_valid']) {
            $errors['code'] = $otpEmailValid['message'];
        }
        if (!empty($errors)) {
            return response(['errors' => $errors], 400);
        }

        ## make transaction
        $result = $this->partnerBankAccountService->requestMakeTransferMoney($id, $transaction->toArray());
        $this->authOtpService->resetCountTime($this->channelMailOtp);
        return response($result);
    }

    public function resendEmailOtp($id)
    {
        ## check transacion
        $transaction = $this->partnerBankTransferRepository->getById($id);
        if (!$transaction) {
            return response(['message' => 'Không tìm thấy giao dịch này'], 400);
        }
        // check otp valid
        $channel = 'email';
        $otpEmail = $this->authOtpService->getByEmail(MailHelper::getDefaultEmailForOtpCodePartnerBankAccountTransfer());
        $countTime = $this->authOtpService->getOtpCountTime($channel);

        if ($otpEmail) {
            $canRetry = (!$countTime || !AuthOtp::validateExpireTime($otpEmail->expired_at) || $otpEmail->times_retry >= $otpEmail->max_retry) && !$otpEmail->is_used;
            if (!$canRetry) {
                return response(['message' => 'Mã OTP cũ vẫn còn hiệu lực, chưa thể cấp lại OTP'], 400);
            }
        }
        $partner = PartnerService::getList([], $transaction->partner_code);
        $partner = isset($partner->data) && isset($partner->data[0]) ? $partner->data[0] : null;
        if (!$partner) {
            return response(['success' => false, 'message' => 'Partner không tồn tại']);
        }
        $params = [
            'partner_name' => $partner->name,
            'partner_code' => $transaction->partner_code,
            'bbds_id' => $transaction->bbds_id,
            'id' => $transaction->id,
            'content' => $transaction->content,
            'amount' => $transaction->amount,
            'file_url' => \Storage::disk('public_folder')->url($transaction->file_url),
        ];
        $result = $this->partnerBankAccountService->sendOtpEmail($params);

        return response(['message' => $result['message'] ?? ''], $result['success'] ? 200 : 400);
    }
}
