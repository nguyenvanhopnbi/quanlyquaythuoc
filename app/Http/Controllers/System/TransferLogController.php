<?php

namespace App\Http\Controllers\System;

use App\Helpers\MailHelper;
use App\Helpers\Message;
use App\Helpers\SmsHelper;
use App\Http\Controllers\Export\TransferLogExport;
use App\Http\Requests\TransferLogCreateRequest;
use App\Jobs\TransferLogScheduleOnce;
use App\Mail\SendMailOtp;
use App\Models\TransferLog;
use App\Services\System\AuthOtpService;
use App\Services\System\TransferAccountService;
use App\Services\System\TransferScheduleLogService;
use App\Services\System\TransferTransactionService;
use App\Services\System\TransferLogService;
use App\Transformers\System\TransferAccountTransformer;
use App\Transformers\System\TransferLogTransformer;
use Carbon\Carbon;
use Erdemkeren\Otp\OtpFacade;
use Illuminate\Http\Request;
use App\Services\ValidationService;
use App\Http\Controllers\Controller;
use App\Services\Gate\BankTransactionService;

class TransferLogController extends Controller
{
    protected $validator;
    protected $request;
    protected $transferTransactionService;
    protected $transferAccountService;
    protected $transferLogService;
    protected $authOtpService;
    protected $transferScheduleLogService;

    public function __construct(ValidationService $validator,
                                TransferLogService $transferLogService,
                                TransferAccountService $transferAccountService,
                                TransferTransactionService $transferTransactionService,
                                TransferScheduleLogService $transferScheduleLogService,
                                AuthOtpService $authOtpService,
                                Request $request)
    {
        $this->validator = $validator;
        $this->transferTransactionService = $transferTransactionService;
        $this->transferAccountService = $transferAccountService;
        $this->transferLogService = $transferLogService;
        $this->transferScheduleLogService = $transferScheduleLogService;
        $this->authOtpService = $authOtpService;
        $this->request = $request;
    }

    public function index(Request $request)
    {
        $filter = [
            'account_no_from' => $request->account_no_from,
            'account_no_to' => $request->account_no_to,
            'status' => $request->status,
            'schedule_type' => $request->schedule_type,
            'fd' => $request->startTime ? Carbon::createFromFormat('m/d/Y', $request->startTime)->startOfDay()->format('Y-m-d H:i:s') : null,
            'td' => $request->endTime ? Carbon::createFromFormat('m/d/Y', $request->endTime)->endOfDay()->format('Y-m-d H:i:s') : null,
        ];
        if ($filter['account_no_from']) {
            $accountFrom = $this->transferLogService->logListAccount(1, 1, array_merge($filter, ['account_no_type' => 'from', 'account_no' => $request->account_no_from]));
            $accountFrom = $accountFrom->items();
        }
        if ($filter['account_no_to']) {
            $accountTo = $this->transferLogService->logListAccount(1, 1, array_merge($filter, ['account_no_type' => 'to', 'account_no' => $request->account_no_to]));
            $accountTo = $accountTo->items();
        }

        if($request->request_type === 'export') {
            return (new TransferLogExport($filter))->export();
        }

        $statuses = TransferLogTransformer::getStatuses();
        array_unshift($statuses, 'Tất cả');
        $scheduleTypes = TransferLogTransformer::getScheduleTypes();
        array_unshift($scheduleTypes, 'Tất cả');
        $scheduleTypes['now'] = 'Chuyển ngay';

        return view('system.transfer.transfer_log', [
            'filter' => $filter,
            'accountFrom' => $accountFrom[0] ?? null,
            'accountTo' => $accountTo[0] ?? null,
            'statuses' => $statuses,
            'scheduleTypes' => $scheduleTypes,
        ]);
    }

    public function transactionList(Request $request)
    {
        $req = $request->all();
        $limit = isset($req['pagination']) ? $req['pagination']['perpage'] ?? 10 : 10;
        $page = isset($req['pagination']) ? $req['pagination']['page'] ?? 1 : 1;
        $limit = is_numeric($limit) && $limit > 0 && $limit <= 100 ? $limit : 10;
        $page = is_numeric($page) && $page > 0 ? $page : 1;
        $filter = [
            'id' => $request->id,
            'account_no_from' => $request->account_no_from,
            'account_no_to' => $request->account_no_to,
            'fd' => $request->startTime ? Carbon::createFromFormat('m/d/Y', $request->startTime)->startOfDay()->format('Y-m-d H:i:s') : null,
            'td' => $request->endTime ? Carbon::createFromFormat('m/d/Y', $request->endTime)->endOfDay()->format('Y-m-d H:i:s') : null,
            'status' => $request->status,
            'schedule_type' => $request->schedule_type,
        ];
        $transactions = $this->transferLogService->transactionList($page, $limit, $filter);
        $data = $transactions->items();
        $data = TransferLogTransformer::convertAttributesForTable($data);
        $paginate = [
            'data' => $data,
            'meta' => [
                'page' => $page,
                'limit' => $limit,
                'total' => $transactions->total(),
                'pages' => $limit,
                'perpage' => $limit
            ]
        ];

        if ($request->detail === 'get') {
            $res = \View::make('system.transfer.partials.detail_modal_log', ['detail' => $data[0] ?? null])->render();
            return response($res);
        }
        return response($paginate);
    }

    public function transactionFormCreate(Request $request)
    {
        $otpCountTimeSms = $this->authOtpService->getOtpCountTime('sms');
        if ($otpCountTimeSms) {
            $expiredAtSms = now()->addSeconds($otpCountTimeSms)->getTimestamp();
        }
        $otpCountTimeEmail = $this->authOtpService->getOtpCountTime('email');
        if ($otpCountTimeEmail) {
            $expiredAtEmail = now()->addSeconds($otpCountTimeEmail)->getTimestamp();
        }
        $accounts = $this->transferAccountService->accountList(1, 15, []);
        $accounts = $accounts->items();
        $phoneOtp = SmsHelper::getDefaultPhoneForOtpCode();
        $emailOtp = MailHelper::getDefaultEmailForOtpCode();
        $phoneOtp = str_repeat("x", strlen($phoneOtp) - 2) . substr($phoneOtp, -2);
        $emailOtp = substr($emailOtp, 0, 2) . str_repeat("x", strlen($emailOtp) - 2);
        return view('system.transfer.transfer_transaction_create')->with([
            'expiredAtSms' => $expiredAtSms ?? 0,
            'expiredAtEmail' => $expiredAtEmail ?? 0,
            'accounts' => $accounts,
            'phoneOtp' => $phoneOtp,
            'emailOtp' => $emailOtp,
        ]);
    }

    public function transactionFormSubmit(TransferLogCreateRequest $request)
    {
        $accountFrom = $this->transferAccountService->getById($request->account_from_id);
        $accountTo = $this->transferAccountService->getById($request->account_to_id);
        if (!$accountFrom || !$accountTo) {
            return redirect(route('system.transfer.index'))->with([
                'message' => 'Tài khoản chuyển tiền/nhận tiền không tồn tại',
                'type' => 'error'
            ]);
        }
        $scheduleDate = $request->scheduled_date;
        if ($scheduleDate && $request->is_schedule && $request->schedule_type === TransferLog::SCHEDULE_TYPE_ONCE) {
            ### check date valid
            $scheduleDate = Carbon::createFromFormat('d/m/Y H:i', $scheduleDate . ' ' . $request->schedule_at);
            if ($scheduleDate->greaterThan(now())) {
                $scheduleDate = $scheduleDate->format('Y-m-d');
            } else {
                \Session::flash('account_from', $accountFrom);
                \Session::flash('account_to', $accountTo);
                return redirect()->back()->withErrors([
                    'schedule_at' => 'Thời gian hẹn lịch đặt lệnh phải lớn hơn thời gian hiện tại',
                ])->withInput();
            }
        }

        $data = [
            'account_from_id' => $request->account_from_id,
            'account_to_id' => $request->account_to_id,
            'total_amount' => $request->total_amount,
            'amount_per_trans' => $request->amount_per_trans,
            'content' => $request->input('content'),
            'otp_sms' => SmsHelper::getDefaultPhoneForOtpCode(),
            'otp_email' => MailHelper::getDefaultEmailForOtpCode(),
            'otp_sms_code' => $request->otp_sms_code,
            'otp_email_code' => $request->otp_email_code,
            'is_schedule' => (bool)$request->is_schedule,
            'schedule_at' => $request->schedule_at,
            'schedule_type' => $request->schedule_type,
            'scheduled_date' => $scheduleDate,
        ];
        // check otp valid
        $otpEmail = $this->authOtpService->getByEmail($data['otp_email']);
        $otpPhone = $this->authOtpService->getByPhone($data['otp_sms']);

        if (!$otpEmail || !$otpPhone) {
            \Session::flash('account_from', $accountFrom);
            \Session::flash('account_to', $accountTo);
            return redirect()->back()->withInput()->withErrors(['otp_code' => 'Mã OTP Sms/Email không chính xác, vui lòng thử lại']);
        }

        $otpEmailValid = $this->authOtpService->isOtpValid($data['otp_email_code'], $otpEmail);
        $errors = [];
        if (!$otpEmailValid['is_valid']) {
            $errors['otp_email_code'] = $otpEmailValid['message'];
        }
        $otpPhoneValid = $this->authOtpService->isOtpValid($data['otp_sms_code'], $otpPhone);
        if (!$otpPhoneValid['is_valid']) {
            $errors['otp_sms_code'] = $otpPhoneValid['message'];
        }
        if (!empty($errors)) {
            \Session::flash('account_from', $accountFrom);
            \Session::flash('account_to', $accountTo);
            return redirect()->back()->withInput()->withErrors($errors);
        }

        ## mask used otp before create trans, prevent duplicate trans
        $this->authOtpService->markAsUsed($otpEmail->id);
        $this->authOtpService->markAsUsed($otpPhone->id);

        $data = array_merge(
            [
                'account_no_from' => $accountFrom->account_no,
                'account_no_to' => $accountTo->account_no,
                'account_name_from' => $accountFrom->account_name,
                'account_name_to' => $accountTo->account_name,
                'bank_code_from' => $accountFrom->bank_code,
                'bank_code_to' => $accountTo->bank_code,
            ],
            $data);

        ## make transaction
        $result = $this->transferLogService->transactionCreate($data);

        $return['message'] = $result['message'];
        event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::SYSTEM_TRANSFER, "Chuyển tiền nội bộ", compact('data')));

        $this->authOtpService->resetCountTime('sms');
        $this->authOtpService->resetCountTime('email');

        return redirect()->back()->with($return);
    }

    public function logListAccount(Request $request)
    {
        $filter = ['query' => $request->query('q'), 'account_no_type' => $request->account_no_type ?? 'from',];
        $accounts = $this->transferLogService->logListAccount(1, 15, $filter);
        if ($accounts->isNotEmpty()) {
            $accounts = $accounts->items();
        } else {
            $accounts = [];
        }
        $accounts = TransferAccountTransformer::convertAttributes($accounts);
        return response()->json([
            'results' => $accounts
        ]);
    }


    public function setStateJob($logId, Request $request)
    {
        $return = ['success' => false, 'message' => null, 'current_status' => null];
        $log = $this->transferLogService->getById($logId);
        if (!$log) {
            $return['message'] = 'Không tìm thấy lệnh chuyển tiền';
            return $return;
        }

        ### check status valid
        $status = $request->status;
        if (!in_array($status, [TransferLog::STATUS_SCHEDULE, TransferLog::STATUS_PAUSED]) || !in_array($log->status, [TransferLog::STATUS_SCHEDULE, TransferLog::STATUS_PAUSED])) {
            $return['message'] = 'Trạng thái không phù hợp';
            return $return;
        }
        if ($status === TransferLog::STATUS_PAUSED) {
            $update = [
                'schedule_at' => null,
                'scheduled_date' => null,
            ];
        } else {
            $update = [];
        }

        ### check transfer log is run or not, if run -> stop action
        if ($log->schedule_type === TransferLog::SCHEDULE_TYPE_ONCE) {
            $scheduleLog = $this->transferScheduleLogService->getByTransferLogId($logId);
            if ($scheduleLog) {
                $return['message'] = 'Lệnh đã được thực hiện, không thể thao tác tạm hoãn hoặc hẹn lịch';
                return response($return);
            }
        }

        ### check schedule type transfer is once, only run one
        if ($log->schedule_type === TransferLog::SCHEDULE_TYPE_ONCE && $status === TransferLog::STATUS_SCHEDULE) {
            $validator = \Validator::make($request->only('schedule_at', 'scheduled_date'), [
                'schedule_at' => 'required|date_format:G:i',
                'scheduled_date' => 'required|date_format:d/m/Y',
            ]);
            if ($validator->fails()) {
                $return['error'] = $validator->getMessageBag();
                $return['message'] = 'Thông tin thiếu hoặc không hợp lệ';
                return response($return);
            }
            $delay = Carbon::createFromFormat('d/m/Y G:i', $request->scheduled_date . ' ' . $request->schedule_at);
            if ($delay->lessThanOrEqualTo(now())) {
                $return['message'] = 'Thời gian hẹn lịch phải lơn hơn hiện tại';
                return response($return);
            }

            $update = [
                'schedule_at' => $delay->format('H:i:s'),
                'scheduled_date' => $delay->format('Y-m-d')
            ];
        }

        $statusText = $log->status === $status ? 'Hẹn lịch' : 'Tạm dừng';
        if ($status === $log->status) {
            $return['message'] = 'Lệnh chuyển đang ở trạng thái "' . $statusText . '", không thể chuyển đổi';
            return $return;
        }

        $statusNew = $status === TransferLog::STATUS_PAUSED ? '"Tạm dừng"' : '"Hẹn lịch"';
        $update['status'] = $status;
        $success = $this->transferLogService->update($logId, $update);
        if (isset($delay)) {
            dispatch(new TransferLogScheduleOnce($logId))->delay($delay);
        }
        $return['new_status_text'] = $statusText;
        $return['current_status'] = $status;
        $return['success'] = (bool)$success;
        $return['message'] = "Đã cập nhật lại trạng thái lệnh chuyển tiền sang " . $statusNew;
        event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::SYSTEM_TRANSFER, $return['message'], compact('return')));
        return $return;
    }
}
