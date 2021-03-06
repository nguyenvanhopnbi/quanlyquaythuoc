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
            $bankAccountTypes[''] = 'T???t c???';
            $bankAccountTypes = array_merge($bankAccountTypes, PartnerBankAccountTransformer::getBankAccountTypes());
            $banks = [
                'VCB' => 'Ng??n h??ng th????ng m???i C??? ph???n Ngo???i th????ng Vi???t Nam',
                'TECHCOMBANK' => 'Ng??n h??ng th????ng m???i C??? ph???n k??? th????ng Vi???t Nam',
                'TPBANK' => 'Ng??n h??ng th????ng m???i C??? ph???n Ti??n Phong',
                'VIETINBANK' => 'Ng??n h??ng Th????ng m???i c??? ph???n C??ng Th????ng Vi???t Nam',
                'VIB' => 'Ng??n H??ng Qu???c T??? VIB',
                'HDBANK' => 'Ng??n h??ng th????ng m???i c??? ph???n Ph??t tri???n Th??nh ph??? H??? Ch?? Minh',
                'MB' => 'Ng??n h??ng th????ng m???i c??? ph???n Qu??n ?????i',
                'VIETABANK' => 'Ng??n h??ng th????ng m???i CP Vi???t ??',
                'MARITIMEBANK' => 'Ng??n h??ng th????ng m???i c??? ph???n H??ng h???i Vi???t Nam',
                'EXIMBANK' => 'Ng??n h??ng th????ng m???i c??? ph???n Xu???t Nh???p Kh???u Vi???t Nam',
                'SCB' => 'Ng??n h??ng TMCP S??i G??n',
                'VPBANK' => 'Ng??n h??ng TMCP Vi???t Nam Th???nh V?????ng',
                'ABBANK' => 'Ng??n h??ng Th????ng m???i C??? ph???n An B??nh',
                'SACOMBANK' => 'Ng??n h??ng th????ng m???i c??? ph???n S??i G??n Th????ng T??n',
                'OCEANBANK' => 'Ng??n h??ng ?????i D????ng',
                'BIDV' => 'Ng??n h??ng ?????u t?? v?? Ph??t tri???n Vi???t Nam',
                'SEABANK' => 'Ng??n h??ng TMCP ????ng Nam ??',
                'BACA' => 'B???c ?? Bank',
                'AGRIBANK' => 'Ng??n h??ng N??ng nghi???p v?? Ph??t tri???n N??ng th??n Vi???t Nam',
                'SAIGONBANK' => 'Ng??n h??ng th????ng m???i c??? ph???n S??i G??n C??ng Th????ng',
                'PVBANK' => 'Ng??n h??ng TMCP ?????i Ch??ng Vi???t Nam',
                'ACB' => 'Ng??n h??ng th????ng m???i c??? ph???n ?? Ch??u',
                'BVBANK' => 'Ng??n h??ng TMCP B???o Vi???t',
                'GPBANK' => 'Ng??n h??ng TMCP D???u Kh?? To??n C???u',
                'LPB' => 'Ng??n h??ng th????ng m???i c??? ph???n B??u ??i???n Li??n Vi???t',
                'NCB' => 'Ng??n h??ng Th????ng m???i C??? ph???n Qu???c D??n',
                'HONGLEONG' => 'Ng??n h??ng TNHH MTV Hongleong Vi???t Nam',
                'PBVN' => 'Ng??n h??ng Public Bank',
                'OCB' => 'Ng??n h??ng TMCP Ph????ng ????ng',
                'SHB' => 'Ng??n h??ng TMCP S??i G??n - H?? N???i',
                'SHINHAN' => 'Ng??n h??ng TNHH MTV Shinhan Vi???t Nam',
                'VIETBANK' => 'Ng??n h??ng TMCP Vi???t Nam Th????ng T??n',
                'VIETCAPITALBANK' => 'Ng??n h??ng TMCP B???n Vi???t',
                'KIENLONGBANK' => 'Ng??n h??ng TMCP Ki??n Long',
                'PGBANK' => 'Ng??n h??ng TMCP X??ng D???u Petrolimex',
                'VRB' => 'Ng??n h??ng Li??n Doanh Vi???t Nga',
                'NAMABANK' => 'Ng??n h??ng TMCP Nam ??',
                'IVB' => 'Ng??n h??ng TNHH Indovina',
                'WOORIBANK' => 'Ng??n h??ng Wooribank',
                'UOB' => 'Ng??n h??ng TNHH MTV United Overseas Bank',
                'COOPBANK' => 'Ng??n h??ng h???p t??c Co-opBank',
                'CIMB' => 'Ng??n h??ng CIMB Vi???t Nam',
                'IBK' => 'Ng??n H??ng C??ng Nghi???p H??n Qu???c',
                'DAB' => 'Ng??n h??ng TMCP ????ng ??',
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
            $name = 'Danh s??ch giao d???ch_' . now()->format('dmYHis') . '.xlsx';
            try {
                \Excel::store($objExport, $name, 'exports');
                event(new ActivityOccur(LogCategoryEnum::PARTNER_BANK_ACCOUNT_EXPORT, "Xu???t file danh s??ch t??i kho???n ng??n h??ng Partner", compact('filter')));
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
            event(new ActivityOccur(LogCategoryEnum::PARTNER_BANK_ACCOUNT_CREATE, "T???o t??i kho???n chuy???n ti???n Partner", compact('data')));
            return response($res);
        }
        return response($res, 400);
    }

    public function accountDelete($accountId, Request $request)
    {
        $res = $this->partnerBankAccountService->bankAccountDelete($accountId);
        if ($res['success']) {
            event(new ActivityOccur(LogCategoryEnum::PARTNER_BANK_ACCOUNT_DELETE, "Xo?? t??i kho???n chuy???n ti???n Partner", compact('res')));
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
            return response(['message' => 'T??i kho???n ng??n h??ng kh??ng t???n t???i', 'errors' => ['account_id' => ['T??i kho???n ng??n h??ng kh??ng t???n t???i']]], 400);
        }

        $data = [
            'bbds_id' => $request->bbds_id,
            'content' => 'AppotaPay thanh toan dich vu ' . $request->input('content') . ' ' . $account['partner_code'] . '',
            'amount' => $request->amount,
        ];
        // check otp valid
        $otpPhone = $this->authOtpService->getByPhone(SmsHelper::getDefaultPhoneForOtpCodePartnerBankAccountTransfer(), false);

        if (!$otpPhone) {
            return response(['errors' => ['otp_sms_code' => 'M?? OTP kh??ng ch??nh x??c, vui l??ng click button "G???i m?? OTP" ????? nh???n OTP"'], 'message' => 'Th???t b???i'], 400);
        }

        $errors = [];
        $otpPhoneValid = $this->authOtpService->isOtpValid($request->otp_sms_code, $otpPhone);
        if (!$otpPhoneValid['is_valid']) {
            $errors['otp_sms_code'] = $otpPhoneValid['message'];
        }
        if (!empty($errors)) {
            return response(['errors' => $errors, 'message' => 'Th???t b???i'], 400);
        }

        ## upload file
        $file = $request->file('file_attach');
        $uploadResult = app(UploadFileService::class)->saveLocalFile($file);
        if (!$uploadResult['success']) {
            return response(['errors' => ['file_attach' => 'L???i kh??ng th??? upload file']], 400);
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
            return response(['errors' => ['otp_sms_code' => 'L???i kh??ng th??? g???i otp email']], 400);
        }

        $this->authOtpService->markAsUsed($otpPhone->id);
        event(new ActivityOccur(LogCategoryEnum::PARTNER_BANK_ACCOUNT_MAKE, "Chuy???n ti???n ?????n partner account", compact('data')));

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
            return response(['success' => false, 'message' => 'Vui l??ng nh???p th??ng tin sms/email nh???n OTP']);
        }
        $otpCountTime = $this->authOtpService->getOtpCountTime($channel);
        if ($otpCountTime) {
            return response(['success' => false, 'message' => 'Vui l??ng g???i l???i sau ' . $otpCountTime . ' gi??y']);
        }

        $partner = PartnerService::getList(['query' => ['partner_code' => $request->partner_code, 'partner_code_abs' => 1, 'active' => 1]]);
        $partner = isset($partner->data) && isset($partner->data[0]) ? $partner->data[0] : null;
        if (!$partner) {
            return response(['success' => false, 'message' => 'Partner kh??ng t???n t???i']);
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
            $statuses = ['' => 'T???t c???'];
            $statuses = array_merge($statuses, PartnerBankTransfer::getStatuses());
            $bankAccountTypes = ['' => 'T???t c???'];
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
            $name = 'Danh s??ch giao d???ch_' . now()->format('dmYHis') . '.xlsx';
            try {
                \Excel::store($objExport, $name, 'exports');
                event(new ActivityOccur(LogCategoryEnum::PARTNER_BANK_ACCOUNT_TRANSFER_EXPORT, "Xu???t file danh s??ch giao d???ch", compact('filter')));
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
            return response(['message' => 'Kh??ng th??? hu??? giao d???ch n??y'], 400);
        }

        $partner = PartnerService::getList(['query' => ['partner_code' => $transaction->partner_code, 'partner_code_abs' => 1, 'active' => 1]]);
        $partner = isset($partner->data) && isset($partner->data[0]) ? $partner->data[0] : null;
        if (!$partner) {
            return response(['success' => false, 'message' => 'L???i, Partner kh??ng t???n t???i']);
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
            'status_message' => '[Y??u c???u b??? hu???] ' . $request->reason,
            'approver_name' => \Auth::user()->name,
            'approver_email' => \Auth::user()->email,
            'approver_id' => \Auth::user()->id,
            'approved_at' => now(),
        ]);

        // send email otp
        $subject = "[K??? TO??N] T??? ch???i y??u c???u chi ti???n k??? ?????i so??t {$params['bbds_id']} cho ?????i t??c {$params['partner_name']}";
        $success = $this->authOtpService->sendMailOtpWithInfo($transaction->creator_email, 'partner.email.mail_otp_cancel_request_bank_account', $subject, $params);
        if (!$success) {
            Log::error('PartnerBankAccountController@cancelOrder cant send mail');
        }

        return response(['message' => '???? hu??? y??u c???u']);
    }

}
