<?php

namespace App\Http\Controllers\System;

use App\Helpers\MailHelper;
use App\Helpers\SmsHelper;
use App\Http\Requests\Auth\AuthOtpRequest;
use App\Http\Requests\TransferLogCreateRequest;
use App\Mail\SendMailOtp;
use App\Models\AuthOtp;
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
    protected $transferTransactionService;
    protected $transferAccountService;
    protected $transferLogService;
    protected $authOtpService;

    public function __construct(ValidationService $validator,
                                TransferLogService $transferLogService,
                                TransferAccountService $transferAccountService,
                                TransferTransactionService $transferTransactionService,
                                AuthOtpService $authOtpService,
                                Request $request)
    {
        $this->validator = $validator;
        $this->transferTransactionService = $transferTransactionService;
        $this->transferAccountService = $transferAccountService;
        $this->transferLogService = $transferLogService;
        $this->request = $request;
        $this->authOtpService = $authOtpService;
    }


    public function sendOtp(Request $request)
    {

        $genCode = AuthOtp::generateOtpCode();
        $code = $genCode['code'];
        $data = [
            'email' => $request->otp_method === 'email' ? MailHelper::getDefaultEmailForOtpCode() : null,
            'phone' => $request->otp_method === 'sms' ? SmsHelper::getDefaultPhoneForOtpCode() : null,
            'secure_code' => $genCode['secure_code'],
            'expired_at' => now()->addMinutes(10),
            'max_retry' => 5,
            'times_retry' => 0,
        ];
        $channel = $request->otp_method;
        if (!$data['email'] && !$data['phone']) {
            return response(['success' => false, 'message' => 'Vui lòng nhập thông tin sms/email nhận OTP']);
        }
        $otpCountTime = $this->authOtpService->getOtpCountTime($channel);
        if ($otpCountTime) {
            return response(['success' => false, 'message' => 'Vui lòng gửi lại sau ' . $otpCountTime . ' giây']);
        }

        if ($data['email']) {
            $success = $this->authOtpService->sendMailOtp($data['email'], $code);
        } elseif ($data['phone']) {
            $success = $this->authOtpService->sendSmsOtp($data['phone'], $code);
        } else {
            $success = false;
        }
        if (!$success) {
            return response(['success' => false]);
        }
        $this->authOtpService->setExpireTime(60, $channel);
        $this->authOtpService->createOtp($data);
        $otpCountTime = $this->authOtpService->getOtpCountTime($channel);
        $expiredAt = now()->addSeconds($otpCountTime)->getTimestamp();
        return response(['success' => true, 'expiredAt' => $expiredAt]);
    }

    public function sendOtpEmailSMSTest(AuthOtpRequest $request)
    {
        $genCodeEmail = AuthOtp::generateOtpCode();
        $genCodeSms = AuthOtp::generateOtpCode();
        $codeEmail = $genCodeEmail['code'];
        $codeSms = $genCodeSms['code'];
        $data = [
            'email' => $request->otp_email,
            'phone' => SmsHelper::getDefaultPhoneForOtpCode(),
        ];
        if (!$data['email'] || !$data['phone']) {
            return response(['success' => false, 'message' => 'Vui lòng nhập thông tin sms/email nhận OTP']);
        }
        $otpCountTime = $this->authOtpService->getOtpCountTime();
        if ($otpCountTime) {
            return response(['success' => false, 'message' => 'Vui lòng gửi lại sau ' . $otpCountTime . ' giây']);
        }

        $successEmail = $this->authOtpService->sendMailOtp($data['email'], $codeEmail);
        if (!$successEmail) {
            return response(['success' => false, 'message' => 'Lỗi gửi OTP Email']);
        } else {
            $this->authOtpService->createOtp([
                'email' => $data['email'],
                'phone' => null,
                'expired_at' => now()->addMinutes(5),
                'secure_code' => $genCodeEmail['secure_code'],
            ]);
        }
        $successSms = $this->authOtpService->sendSmsOtp($data['phone'], $codeSms);
        if (!$successSms) {
            return response(['success' => false, 'message' => 'Lỗi gửi OTP SMS']);
        } else {
            $this->authOtpService->createOtp([
                'email' => null,
                'phone' => $data['phone'],
                'expired_at' => now()->addMinutes(5),
                'secure_code' => $genCodeSms['secure_code'],
            ]);
        }

        $this->authOtpService->setExpireTime();
        $otpCountTime = $this->authOtpService->getOtpCountTime();
        $expiredAt = now()->addSeconds($otpCountTime)->getTimestamp();
        return response(['success' => true, 'expiredAt' => $expiredAt]);
    }

}
