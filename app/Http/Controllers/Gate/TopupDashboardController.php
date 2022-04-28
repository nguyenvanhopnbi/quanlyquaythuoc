<?php

namespace App\Http\Controllers\Gate;

use Illuminate\Http\Request;
use App\Services\ValidationService;
use App\Http\Controllers\Controller;
use App\Services\Gate\TopupTransactionService;
use App\Helpers\CheckIsAmUser;

class TopupDashboardController extends Controller
{
    protected $topupTransactionService;
    protected $validator;
    protected $request;

    public function __construct(
        ValidationService $validator,
        TopupTransactionService $topupTransactionService, 
        Request $request
    )
    {
        $this->validator = $validator;
        $this->topupTransactionService = $topupTransactionService;
        $this->request = $request;
    }

    public function index()
    {
        return view('gate.topup-dashboard.index');
    }

    /**
    * get chart transaction
    *
    * @param Request $request
    * @return void
    */
    public function getChartTransaction(Request $request)
    {
        $params = $request->all();

        $partnerCode = null;
        $partnerCode = CheckIsAmUser::checkIsAmUser();

        $listTransaction = $this->topupTransactionService->getChartTransaction($params['data'], $partnerCode);
        return response()->json($listTransaction);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return json
     */
    public function getFlash(Request $request)
    {
        $params = $request->only('query');
        $params['partner_code'] = $params['query']['partner_code'] ? $params['query']['partner_code'] : 'all';

        $partnerCode = null;
        $partnerCode = CheckIsAmUser::checkIsAmUser();

        $dataTotal = $this->topupTransactionService->getReportPartnerByDay($params, $partnerCode);

        return view('gate.dashboard.flash')->with(['data'=> $dataTotal]);
    }
}
