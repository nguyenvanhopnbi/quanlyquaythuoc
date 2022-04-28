<?php

namespace App\Http\Controllers\Gate;

use App\Http\Controllers\Controller;
use App\Services\Gate\EbillDashboardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Helpers\CheckIsAmUser;

class EbillDashboardController extends Controller
{
    private $ebillDashboardService;

    function __construct(EbillDashboardService $ebillDboardService )
    {
        $this->ebillDashboardService = $ebillDboardService;
    }

    public function index()
    {
        return view('gate.ebill-dashboard.index');
    }

    public function getChartTransaction(Request $request)
    {
        $params = $request->all();
        $partnerCode = null;
        $partnerCode = CheckIsAmUser::checkIsAmUser();
        $listTransaction = $this->ebillDashboardService->getChartTransaction($params['query'], $partnerCode);
        return response()->json($listTransaction);
    }

    public function getFlash(Request $request)
    {
        $params = $request->only('query');
        $params['status'] = isset($params['query']['status']) ? $params['query']['status'] : 'all';
        $partnerCode = null;
        $partnerCode = CheckIsAmUser::checkIsAmUser();

        $dataAll = $this->ebillDashboardService->getReportPartnerByDay($params, $partnerCode);
        return view('gate.ebill-dashboard.flash',compact('dataAll'));
    }
}
