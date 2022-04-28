<?php

namespace App\Http\Controllers\Gate;

use App\Services\Gate\ShopcardDashboardService;
use Illuminate\Http\Request;
use App\Services\ValidationService;
use App\Http\Controllers\Controller;
use App\Services\Gate\TopupTransactionService;
use App\Helpers\CheckIsAmUser;

class ShopCardDashboardController extends Controller
{
    protected $shopCardDashboardService;
    protected $validator;
    protected $request;

    public function __construct(
        ValidationService $validator,
        ShopcardDashboardService $shopCardDashboardService,
        Request $request
    )
    {
        $this->validator = $validator;
        $this->shopCardDashboardService = $shopCardDashboardService;
        $this->request = $request;
    }

    public function index()
    {
        return view('gate.shopcard-dashboard.index');
    }

    /**
     * get char
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getChartTransaction(Request $request)
    {
        $params = $request->all();
        $partnerCode = null;
        $partnerCode = CheckIsAmUser::checkIsAmUser();

        $listTransaction = $this->shopCardDashboardService->getChartTransaction($params['data'], $partnerCode);

        return response()->json($listTransaction);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getFlash(Request $request)
    {
        $params = $request->only('query');
        $params['partner_code'] = $params['query']['partner_code'] ? $params['query']['partner_code'] : 'all';

        $partnerCode = null;
        $partnerCode = CheckIsAmUser::checkIsAmUser();

        $dataTotal = $this->shopCardDashboardService->getReportPartnerByDay($params, $partnerCode);
        return view('gate.shopcard-dashboard.flash')->with(['data'=> $dataTotal]);
    }
}
