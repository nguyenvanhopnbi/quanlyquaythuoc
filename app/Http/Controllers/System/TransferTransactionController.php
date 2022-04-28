<?php

namespace App\Http\Controllers\System;

use App\Http\Requests\TransferLogCreateRequest;
use App\Mail\SendMailOtp;
use App\Services\System\AuthOtpService;
use App\Services\System\TransferAccountService;
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

class TransferTransactionController extends Controller
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
        $this->authOtpService = $authOtpService;
        $this->request = $request;
    }

    public function index(Request $request)
    {
        $filter = [
            'fd' => $request->fd,
            'td' => $request->td,
            'log_id' => $request->log_id,
        ];

        return view('system.transfer.transfer_transaction', [
            'filter' => $filter,
        ]);
    }

    public function transactionListAjax(Request $request)
    {
        $req = $request->all();
        $limit = isset($req['pagination']) ? $req['pagination']['perpage'] ?? 10 : 10;
        $page = isset($req['pagination']) ? $req['pagination']['page'] ?? 1 : 1;
        $limit = is_numeric($limit) && $limit > 0 && $limit <= 100 ? $limit : 10;
        $page = is_numeric($page) && $page > 0 ? $page : 1;
        $filter = [
            'log_id' => $request->log_id,
            'fd' => $request->startTime ? Carbon::createFromFormat('m/d/Y', $request->startTime)->startOfDay()->format('Y-m-d H:i:s') : null,
            'td' => $request->endTime ? Carbon::createFromFormat('m/d/Y', $request->endTime)->endOfDay()->format('Y-m-d H:i:s') : null,
        ];
        if($filter['log_id']) {
            $page = 1;
            $limit = 1000;
        }
        $transactions = $this->transferTransactionService->transactionList($page, $limit, $filter);
        $data = $transactions->items();
        $data = TransferTransactionTransformer::convertAttributesForTable($data);
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
            $res = \View::make('system.transfer.partials.detail_modal_transaction', ['data' => $data])->render();
            return response($res);
        }
        return response($paginate);
    }
}
