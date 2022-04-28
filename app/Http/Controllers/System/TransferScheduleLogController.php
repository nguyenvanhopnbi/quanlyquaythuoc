<?php

namespace App\Http\Controllers\System;

use App\Http\Requests\TransferLogCreateRequest;
use App\Mail\SendMailOtp;
use App\Models\TransferLog;
use App\Services\System\AuthOtpService;
use App\Services\System\TransferAccountService;
use App\Services\System\TransferScheduleLogService;
use App\Services\System\TransferTransactionService;
use App\Services\System\TransferLogService;
use App\Transformers\System\TransferAccountTransformer;
use App\Transformers\System\TransferLogTransformer;
use App\Transformers\System\TransferTransactionTransformer;
use Carbon\Carbon;
use Erdemkeren\Otp\OtpFacade;
use Illuminate\Http\Request;
use App\Services\ValidationService;
use App\Http\Controllers\Controller;
use App\Services\Gate\BankTransactionService;

class TransferScheduleLogController extends Controller
{
    protected $validator;
    protected $request;
    protected $transferTransactionService;
    protected $transferAccountService;
    protected $transferLogService;
    protected $transferScheduleLog;

    public function __construct(ValidationService $validator,
                                TransferLogService $transferLogService,
                                TransferAccountService $transferAccountService,
                                TransferTransactionService $transferTransactionService,
                                TransferScheduleLogService $transferScheduleLog,
                                Request $request)
    {
        $this->validator = $validator;
        $this->transferTransactionService = $transferTransactionService;
        $this->transferAccountService = $transferAccountService;
        $this->transferLogService = $transferLogService;
        $this->request = $request;
        $this->transferScheduleLog = $transferScheduleLog;
    }

    public function scheduleLogListAjax(Request $request)
    {
        $req = $request->all();
        $limit = isset($req['pagination']) ? $req['pagination']['perpage'] ?? 10 : 10;
        $page = isset($req['pagination']) ? $req['pagination']['page'] ?? 1 : 1;
        $limit = is_numeric($limit) && $limit > 0 && $limit <= 100 ? $limit : 10;
        $page = is_numeric($page) && $page > 0 ? $page : 1;
        $filter = ['transfer_log_id' => $request->log_id];
        $transactions = $this->transferScheduleLog->scheduleLogListAjax($page, $limit, $filter);
        $data = $transactions->items();
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

        return response($paginate);
    }

}
