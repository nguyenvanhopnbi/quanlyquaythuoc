<?php

namespace App\Http\Controllers\Gate;

use App\Http\Controllers\Controller;
use App\Services\Gate\TransferMoneyTransactionService;
use Illuminate\Http\Request;
use App\Helpers\CheckIsAmUser;

class TransferMoneyDashboardController extends Controller
{
    protected $transferMoneyTransactionService;
    
    function __construct(TransferMoneyTransactionService $transferMoneyTransactionService)
    {
        $this->transferMoneyTransactionService = $transferMoneyTransactionService;
    }

    public function index()
    {
        return view('gate.transfer-money-dashboard.index');
    }

    public function getChartTransaction(Request $request)
    {
        $params = $request->all();
        $listTransaction = $this->transferMoneyTransactionService->getChartTransaction($params['data']);
        return response()->json($listTransaction);
    }

    public function getFlash(Request $request)
    {
        $params = $request->only('query');
        $params['partner_code'] = $params['query']['partner_code'] ? $params['query']['partner_code'] : 'all';

        $partnerCode = null;
        $partnerCode = CheckIsAmUser::checkIsAmUser();

        $dataTotal = $this->transferMoneyTransactionService->getReportPartnerByDay($params, $partnerCode);
        return view('gate.dashboard.flash')->with(['data'=> $dataTotal]);
    }

    public function TransferMoneyInternalTransaction(){
        return view('gate.transfer-money-dashboard.TransferMoneyInternalTransaction');
    }

    public function firmBankingIpnLogs(){
        return view('gate.transfer-money-dashboard.firmBankingIpnLogs');
    }
}
