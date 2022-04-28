<?php

namespace App\Http\Controllers\System;

use App\Http\Requests\TransferLogCreateRequest;
use App\Services\System\TransferAccountService;
use App\Services\System\TransferTransactionService;
use App\Services\System\TransferLogService;
use App\Transformers\System\TransferAccountTransformer;
use Illuminate\Http\Request;
use App\Services\ValidationService;
use App\Http\Controllers\Controller;
use App\Services\Gate\BankTransactionService;

class TransferAccountController extends Controller
{
    protected $validator;
    protected $request;
    protected $transferTransactionService;
    protected $transferAccountService;
    protected $transferLogService;

    public function __construct(ValidationService $validator,
                                TransferLogService $transferTransactionService,
                                TransferAccountService $transferAccountService,
                                TransferTransactionService $transferLogService,
                                Request $request)
    {
        $this->validator = $validator;
        $this->transferTransactionService = $transferTransactionService;
        $this->transferAccountService = $transferAccountService;
        $this->transferLogService = $transferLogService;
        $this->request = $request;
    }

    public function accountList(Request $request)
    {
        $filter = ['query' => $request->query('q')];
        $accounts = $this->transferAccountService->accountList(1, 15, $filter);
        if($accounts->isNotEmpty()) {
            $accounts = $accounts->items();
        } else {
            $accounts = [];
        }
        $accounts = TransferAccountTransformer::convertAttributes($accounts);
        return response()->json([
            'results' => $accounts
        ]);
    }



}
