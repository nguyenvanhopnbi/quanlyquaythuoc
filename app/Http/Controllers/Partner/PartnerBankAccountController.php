<?php

namespace App\Http\Controllers\Partner;

use App\Enums\LogCategoryEnum;
use App\Events\ActivityOccur;
use App\Helpers\MailHelper;
use App\Helpers\SmsHelper;
use App\Http\Controllers\Export\ExportPartnerBankAccount;
use App\Http\Controllers\Export\ExportPartnerBankAccountTransfer;
use App\Http\Requests\Partner\PartnerBankAccountCancelOrderRequest;
use App\Http\Requests\Partner\PartnerBankAccountMakeRequest;
use App\Models\AuthOtp;
use App\Models\PartnerBankTransfer;
use App\Repositories\PartnerBankTransferRepository;
use App\Services\File\UploadFileService;
use App\Services\Gate\ApplicationService;
use App\Services\Gate\PartnerService;
use App\Services\Partner\PartnerBankAccountService;
use App\Services\System\AuthOtpService;
use App\Transformers\Partner\PartnerAccountTransferTransformer;
use App\Transformers\Partner\PartnerBankAccountTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Transformers\Game\PartnerAccountTransformer;

// use App\Connection\BankTransactionConnection;

class PartnerBankAccountController extends Controller
{
    protected $request;
    protected $applicationService;
    protected $partnerBankAccountService;
    protected $authOtpService;
    protected $partnerService;
    protected $partnerBankTransferRepository;
    protected $channelMailOtp = 'partner_bank_mail';
    protected $channelSmsOtp = 'partner_bank_sms';

    public function __construct(
        Request $request,
        ApplicationService $applicationService,
        AuthOtpService $authOtpService,
        PartnerService $partnerService,
        PartnerBankTransferRepository $partnerBankTransferRepository,
        PartnerBankAccountService $partnerBankAccountService
    )
    {
        $this->request = $request;
        $this->applicationService = $applicationService;
        $this->partnerBankAccountService = $partnerBankAccountService;
        $this->authOtpService = $authOtpService;
        $this->partnerService = $partnerService;
        $this->partnerBankTransferRepository = $partnerBankTransferRepository;
    }

    public function accounts(Request $request)
    {
        $req = $request->all();
        $limit = isset($req['pagination']) ? $req['pagination']['perpage'] ?? 10 : 10;
        $page = isset($req['pagination']) ? $req['pagination']['page'] ?? 1 : 1;
        $limit = is_numeric($limit) && $limit > 0 && $limit <= 100 ? $limit : 10;
        $page = is_numeric($page) && $page > 0 ? $page : 1;
        $filter = [
            'page' => $page,
            'limit' => $limit,
            'partner_code' => $request->partner_code,
            'bank_code' => $request->bank_code,
            'bank_account_no' => $request->bank_account_no,
            'bank_account_type' => $request->bank_account_type,
            'fd' => $request->fd ? Carbon::createFromFormat('m/d/Y', $request->fd)->startOfDay()->format('m/d/Y') : '',
            'td' => $request->td ? Carbon::createFromFormat('m/d/Y', $request->td)->endOfDay()->format('m/d/Y') : '',
        ];
        if (!$request->request_type) {
            $bankAccountTypes[''] = 'Tất cả';
            $bankAccountTypes = array_merge($bankAccountTypes, PartnerBankAccountTransformer::getBankAccountTypes());
            $banks = [
                'VCB' => 'Ngân hàng thương mại Cổ phần Ngoại thương Việt Nam',
                'TECHCOMBANK' => 'Ngân hàng thương mại Cổ phần kỹ thương Việt Nam',
                'TPBANK' => 'Ngân hàng thương mại Cổ phần Tiên Phong',
                'VIETINBANK' => 'Ngân hàng Thương mại cổ phần Công Thương Việt Nam',
                'VIB' => 'Ngân Hàng Quốc Tế VIB',
                'HDBANK' => 'Ngân hàng thương mại cổ phần Phát triển Thành phố Hồ Chí Minh',
                'MB' => 'Ngân hàng thương mại cổ phần Quân đội',
                'VIETABANK' => 'Ngân hàng thương mại CP Việt Á',
                'MARITIMEBANK' => 'Ngân hàng thương mại cổ phần Hàng hải Việt Nam',
                'EXIMBANK' => 'Ngân hàng thương mại cổ phần Xuất Nhập Khẩu Việt Nam',
                'SCB' => 'Ngân hàng TMCP Sài Gòn',
                'VPBANK' => 'Ngân hàng TMCP Việt Nam Thịnh Vượng',
                'ABBANK' => 'Ngân hàng Thương mại Cổ phần An Bình',
                'SACOMBANK' => 'Ngân hàng thương mại cổ phần Sài Gòn Thương Tín',
                'OCEANBANK' => 'Ngân hàng Đại Dương',
                'BIDV' => 'Ngân hàng Đầu tư và Phát triển Việt Nam',
                'SEABANK' => 'Ngân hàng TMCP Đông Nam Á',
                'BACA' => 'Bắc Á Bank',
                'AGRIBANK' => 'Ngân hàng Nông nghiệp và Phát triển Nông thôn Việt Nam',
                'SAIGONBANK' => 'Ngân hàng thương mại cổ phần Sài Gòn Công Thương',
                'PVBANK' => 'Ngân hàng TMCP Đại Chúng Việt Nam',
                'ACB' => 'Ngân hàng thương mại cổ phần Á Châu',
                'BVBANK' => 'Ngân hàng TMCP Bảo Việt',
                'GPBANK' => 'Ngân hàng TMCP Dầu Khí Toàn Cầu',
                'LPB' => 'Ngân hàng thương mại cổ phần Bưu điện Liên Việt',
                'NCB' => 'Ngân hàng Thương mại Cổ phần Quốc Dân',
                'HONGLEONG' => 'Ngân hàng TNHH MTV Hongleong Việt Nam',
                'PBVN' => 'Ngân hàng Public Bank',
                'OCB' => 'Ngân hàng TMCP Phương Đông',
                'SHB' => 'Ngân hàng TMCP Sài Gòn - Hà Nội',
                'SHINHAN' => 'Ngân hàng TNHH MTV Shinhan Việt Nam',
                'VIETBANK' => 'Ngân hàng TMCP Việt Nam Thương Tín',
                'VIETCAPITALBANK' => 'Ngân hàng TMCP Bản Việt',
                'KIENLONGBANK' => 'Ngân hàng TMCP Kiên Long',
                'PGBANK' => 'Ngân hàng TMCP Xăng Dầu Petrolimex',
                'VRB' => 'Ngân hàng Liên Doanh Việt Nga',
                'NAMABANK' => 'Ngân hàng TMCP Nam Á',
                'IVB' => 'Ngân hàng TNHH Indovina',
                'WOORIBANK' => 'Ngân hàng Wooribank',
                'UOB' => 'Ngân hàng TNHH MTV United Overseas Bank',
                'COOPBANK' => 'Ngân hàng hợp tác Co-opBank',
                'CIMB' => 'Ngân hàng CIMB Việt Nam',
                'IBK' => 'Ngân Hàng Công Nghiệp Hàn Quốc',
                'DAB' => 'Ngân hàng TMCP Đông Á',
            ];
            $data = [
                'bankAccountTypes' => $bankAccountTypes,
                'filter' => $filter,
                'banks' => $banks,
            ];
            return view('partner.bank-account', $data);
        } elseif ($request->request_type === 'download') {
            return \Response::download(public_path('/media/exports/') . $request->file)->deleteFileAfterSend(true);
        }
        if ($filter['fd']) {
            $filter['fd'] = Carbon::createFromFormat('m/d/Y', $filter['fd'])->format('Y-m-d');
        }
        if ($filter['td']) {
            $filter['td'] = Carbon::createFromFormat('m/d/Y', $filter['td'])->format('Y-m-d');
        }
        if ($request->request_type === 'export') {
            $objExport = new ExportPartnerBankAccount($filter);
            $name = 'Danh sách giao dịch_' . now()->format('dmYHis') . '.xlsx';
            try {
                \Excel::store($objExport, $name, 'exports');
                event(new ActivityOccur(LogCategoryEnum::PARTNER_BANK_ACCOUNT_EXPORT, "Xuất file danh sách tài khoản ngân hàng Partner", compact('filter')));
            } catch (\Exception $ex) {
                Log::error('+++Error: export PartnerBankAccountController@accounts ', [$ex]);
                return response(['code' => 500, 'message' => 'error'])->header('Content-Type', 'json');
            }
            return response(['code' => 200, 'message' => 'success', 'path' => $name])->header('Content-Type', 'json');
        }
        $overview = $this->partnerBankAccountService->listBankAccount($filter);
        $items = $overview['data'] ?? [];
        foreach ($items as &$item) {
            $item = PartnerBankAccountTransformer::convertAttributes($item);
        }
        $paginate = [
            'data' => $items,
            'meta' => [
                'page' => $page,
                'limit' => $limit,
                'total' => $overview['total'] ?? 0,
                'pages' => $limit,
                'perpage' => $limit
            ]
        ];

        return response($paginate);
    }

    public function accountCreate(Request $request)
    {
        $data = $request->all();
        $res = $this->partnerBankAccountService->bankAccountCreate($data);
        if ($res['success']) {
            event(new ActivityOccur(LogCategoryEnum::PARTNER_BANK_ACCOUNT_CREATE, "Tạo tài khoản chuyển tiền Partner", compact('data')));
            return response($res);
        }
        return response($res, 400);
    }

    public function accountDelete($accountId, Request $request)
    {
        $res = $this->partnerBankAccountService->bankAccountDelete($accountId);
        if ($res['success']) {
            event(new ActivityOccur(LogCategoryEnum::PARTNER_BANK_ACCOUNT_DELETE, "Xoá tài khoản chuyển tiền Partner", compact('res')));
            return response($res);
        }
        return response($res, 400);
    }

    public function accountMake(Request $request)
    {
        $otpCountTimeSms = $this->authOtpService->getOtpCountTime('sms');
        if ($otpCountTimeSms) {
            $expiredAtSms = now()->addSeconds($otpCountTimeSms)->getTimestamp();
        }
        $otpCountTimeEmail = $this->authOtpService->getOtpCountTime('email');
        if ($otpCountTimeEmail) {
            $expiredAtEmail = now()->addSeconds($otpCountTimeEmail)->getTimestamp();
        }
        $phoneOtp = SmsHelper::getDefaultPhoneForOtpCode();
        $emailOtp = MailHelper::getDefaultEmailForOtpCode();
        $phoneOtp = str_repeat("x", strlen($phoneOtp) - 2) . substr($phoneOtp, -2);
        $emailOtp = substr($emailOtp, 0, 2) . str_repeat("x", strlen($emailOtp) - 2);
        return view('partner.bank_account_make')->with([
            'expiredAtSms' => $expiredAtSms ?? 0,
            'expiredAtEmail' => $expiredAtEmail ?? 0,
            'phoneOtp' => $phoneOtp,
            'emailOtp' => $emailOtp,
        ]);
    }

    public function accountMakeSubmit(PartnerBankAccountMakeRequest $request)
    {
        ## check bbds_id status
        $result = $this->partnerBankTransferRepository->checkBbdsId($request->bbds_id);
        if (!$result['success']) {
            return response(['message' => $result['message'], 'errors' => ['bbds_id' => [$result['message']]]], 400);
        }
        $account = $this->partnerBankAccountService->detailBankAccount($request->account_id);
        if (!$account) {
            return response(['message' => 'Tài khoản ngân hàng không tồn tại', 'errors' => ['account_id' => ['Tài khoản ngân hàng không tồn tại']]], 400);
        }

        $data = [
            'bbds_id' => $request->bbds_id,
            'content' => 'AppotaPay thanh toan dich vu ' . $request->input('content') . ' ' . $account['partner_code'] . '',
            'amount' => $request->amount,
        ];
        // check otp valid
        $otpPhone = $this->authOtpService->getByPhone(SmsHelper::getDefaultPhoneForOtpCodePartnerBankAccountTransfer(), false);

        if (!$otpPhone) {
            return response(['errors' => ['otp_sms_code' => 'Mã OTP không chính xác, vui lòng click button "Gửi mã OTP" để nhận OTP"'], 'message' => 'Thất bại'], 400);
        }

        $errors = [];
        $otpPhoneValid = $this->authOtpService->isOtpValid($request->otp_sms_code, $otpPhone);
        if (!$otpPhoneValid['is_valid']) {
            $errors['otp_sms_code'] = $otpPhoneValid['message'];
        }
        if (!empty($errors)) {
            return response(['errors' => $errors, 'message' => 'Thất bại'], 400);
        }

        ## upload file
        $file = $request->file('file_attach');
        $uploadResult = app(UploadFileService::class)->saveLocalFile($file);
        if (!$uploadResult['success']) {
            return response(['errors' => ['file_attach' => 'Lỗi không thể upload file']], 400);
        }

        $data = array_merge(
            [
                'creator_id' => \Auth::id(),
                'creator_name' => \Auth::user()->name,
                'creator_email' => \Auth::user()->email,
                'file_url' => $uploadResult['path'],
                'bank_account_name' => $account['bank_account_name'],
                'bank_account_no' => $account['bank_account_no'],
                'bank_branch' => $account['bank_branch'],
                'bank_code' => $account['bank_code'],
                'partner_code' => $account['partner_code'],
                'bank_account_type' => $account['bank_account_type'],
                'status' => PartnerBankTransfer::STATUS_PENDING,
            ],
            $data);
        $bank = $this->partnerBankTransferRepository->create($data);

        $params = [
            'id' => $bank->id,
            'partner_code' => $account['partner_code'],
            'bbds_id' => $request->bbds_id,
            'content' => $data['content'],
            'amount' => $request->amount,
            'file_url' => $uploadResult['url'],
        ];

        // send email otp
        $otpResult = $this->sendOtpMail($params);
        if (!$otpResult['success']) {
            return response(['errors' => ['otp_sms_code' => 'Lỗi không thể gửi otp email']], 400);
        }

        $this->authOtpService->markAsUsed($otpPhone->id);
        event(new ActivityOccur(LogCategoryEnum::PARTNER_BANK_ACCOUNT_MAKE, "Chuyển tiền đến partner account", compact('data')));

        $this->authOtpService->resetCountTime($this->channelSmsOtp);
        $this->authOtpService->resetCountTime($this->channelMailOtp);

        return response(['success' => true]);
    }

    private function sendOtpMail($request)
    {
        $request = (object)$request;
        $genCode = AuthOtp::generateOtpCode();
        $code = $genCode['code'];
        $data = [
            'email' => MailHelper::getDefaultEmailForOtpCodePartnerBankAccountTransfer(),
            'phone' => null,
            'secure_code' => $genCode['secure_code'],
            'expired_at' => now()->addMinutes(60),
            'max_retry' => 5,
            'times_retry' => 0,
        ];
        $channel = $this->channelMailOtp;
        if (!$data['email'] && !$data['phone']) {
            return response(['success' => false, 'message' => 'Vui lòng nhập thông tin sms/email nhận OTP']);
        }
        $otpCountTime = $this->authOtpService->getOtpCountTime($channel);
        if ($otpCountTime) {
            return response(['success' => false, 'message' => 'Vui lòng gửi lại sau ' . $otpCountTime . ' giây']);
        }

        $partner = PartnerService::getList(['query' => ['partner_code' => $request->partner_code, 'partner_code_abs' => 1, 'active' => 1]]);
        $partner = isset($partner->data) && isset($partner->data[0]) ? $partner->data[0] : null;
        if (!$partner) {
            return response(['success' => false, 'message' => 'Partner không tồn tại']);
        }
        $params = [
            'partner_code' => $request->partner_code,
            'partner_name' => $partner->name,
            'bbds_id' => $request->bbds_id,
            'content' => $request->content,
            'amount' => $request->amount,
            'code' => $code,
            'file_url' => $request->file_url,
            'link' => route('partner.bank-account.make.list', ['id' => $request->id]),
        ];
        $success = $this->authOtpService->sendMailOtpWithParams($data['email'], 'partner.email.mail_otp', $params);
//        Log::info($code);
//        $success = true;
        if (!$success) {
            return ['success' => false];
        }
        $this->authOtpService->setExpireTime(60 * 30, $channel);
        $this->authOtpService->createOtp($data);
        $otpCountTime = $this->authOtpService->getOtpCountTime($channel);
        $expiredAt = now()->addSeconds($otpCountTime)->getTimestamp();
        return ['success' => true, 'expiredAt' => $expiredAt];
    }

    public function partnerList()
    {
        $partners = $this->partnerService->getAll();
        if (!empty($partners)) {
            foreach ($partners as &$partner) {
                $partner->id = $partner->partner_code;
            }
        }
        $res = ['results' => $partners ?? []];
        return response($res);
    }

    public function accountListAjax(Request $request)
    {
        $filter = $request->only('q');
        $overview = $this->partnerBankAccountService->listBankAccount($filter);
        $items = $overview['data'] ?? [];

        $res = ['results' => $items];
        return response($res);
    }

    public function accountMakeList(Request $request)
    {
        if (!$request->request_type) {
            $statuses = ['' => 'Tất cả'];
            $statuses = array_merge($statuses, PartnerBankTransfer::getStatuses());
            $bankAccountTypes = ['' => 'Tất cả'];
            $bankAccountTypes = array_merge($bankAccountTypes, PartnerBankTransfer::getBankAccountType());
            $data = [
                'statuses' => $statuses,
                'bankAccountTypes' => $bankAccountTypes,
            ];
            return view('partner.bank_account_transaction', $data);
        } elseif ($request->request_type === 'download') {
            return \Response::download(public_path('/media/exports/') . $request->file)->deleteFileAfterSend(true);
        }
        $req = $request->all();
        $limit = isset($req['pagination']) ? $req['pagination']['perpage'] ?? 10 : 10;
        $page = isset($req['pagination']) ? $req['pagination']['page'] ?? 1 : 1;
        $limit = is_numeric($limit) && $limit > 0 && $limit <= 100 ? $limit : 10;
        $page = is_numeric($page) && $page > 0 ? $page : 1;
        $filter = [
            'bbds_id' => $request->bbds_id,
            'page' => $page,
            'limit' => $limit,
            'id' => $request->id,
            'partner_code' => $request->partner_code,
            'bank_code' => $request->bank_code,
            'bank_account_no' => $request->bank_account_no,
            'bank_account_type' => $request->bank_account_type,
            'bank_account_name' => $request->bank_account_name,
            'status' => $request->status,
            'fd' => $request->fd ? Carbon::createFromFormat('m/d/Y', $request->fd)->startOfDay()->format('Y-m-d') : null,
            'td' => $request->td ? Carbon::createFromFormat('m/d/Y', $request->td)->endOfDay()->format('Y-m-d') : null,
        ];

        if ($request->request_type === 'export') {
            $objExport = new ExportPartnerBankAccountTransfer($filter);
            $name = 'Danh sách giao dịch_' . now()->format('dmYHis') . '.xlsx';
            try {
                \Excel::store($objExport, $name, 'exports');
                event(new ActivityOccur(LogCategoryEnum::PARTNER_BANK_ACCOUNT_TRANSFER_EXPORT, "Xuất file danh sách giao dịch", compact('filter')));
            } catch (\Exception $ex) {
                Log::error('+++Error: export PartnerBankAccountController@accountMakeList ', [$ex]);
                return response(['code' => 500, 'message' => 'error'])->header('Content-Type', 'json');
            }
            return response(['code' => 200, 'message' => 'success', 'path' => $name])->header('Content-Type', 'json');
        }
        $rs = $this->partnerBankTransferRepository->transactions($page, $limit, $filter);
        $items = $rs['data'] ?? [];
        foreach ($items as &$item) {
            $item = PartnerAccountTransferTransformer::convertAttributes($item);
        }
        $paginate = [
            'data' => $items,
            'meta' => [
                'page' => $page,
                'limit' => $limit,
                'total' => $rs['total'] ?? 0,
                'pages' => $limit,
                'perpage' => $limit
            ]
        ];

        return response($paginate);
    }

    public function cancelOrder($id, PartnerBankAccountCancelOrderRequest $request)
    {
        ## check transacion
        $transaction = $this->partnerBankTransferRepository->getById($id);
        if (!$transaction || $transaction->status !== PartnerBankTransfer::STATUS_PENDING) {
            return response(['message' => 'Không thể huỷ giao dịch này'], 400);
        }

        $partner = PartnerService::getList(['query' => ['partner_code' => $transaction->partner_code, 'partner_code_abs' => 1, 'active' => 1]]);
        $partner = isset($partner->data) && isset($partner->data[0]) ? $partner->data[0] : null;
        if (!$partner) {
            return response(['success' => false, 'message' => 'Lỗi, Partner không tồn tại']);
        }
        $params = [
            'partner_code' => $transaction->partner_code,
            'partner_name' => $partner->name,
            'bbds_id' => $transaction->bbds_id,
            'content' => $transaction->content,
            'reason' => $request->reason,
            'amount' => $transaction->amount,
            'file_url' => \Storage::disk('public_folder')->url($transaction->file_url),
        ];

        $this->partnerBankTransferRepository->updateById($id, [
            'status' => PartnerBankTransfer::STATUS_ERROR,
            'status_message' => '[Yêu cầu bị huỷ] ' . $request->reason,
            'approver_name' => \Auth::user()->name,
            'approver_email' => \Auth::user()->email,
            'approver_id' => \Auth::user()->id,
            'approved_at' => now(),
        ]);

        // send email otp
        $subject = "[KẾ TOÁN] Từ chối yêu cầu chi tiền kỳ đối soát {$params['bbds_id']} cho đối tác {$params['partner_name']}";
        $success = $this->authOtpService->sendMailOtpWithInfo($transaction->creator_email, 'partner.email.mail_otp_cancel_request_bank_account', $subject, $params);
        if (!$success) {
            Log::error('PartnerBankAccountController@cancelOrder cant send mail');
        }

        return response(['message' => 'Đã huỷ yêu cầu']);
    }

}
