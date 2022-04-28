<?php

namespace App\Http\Controllers\Gate;

use App\Helpers\ArrayHelper;
use App\Http\Controllers\Export\ExportBankTransactionDashboard;
use Illuminate\Http\Request;
use App\Services\ValidationService;
use App\Http\Controllers\Controller;
use App\Services\Gate\BankTransactionService;
use Illuminate\Support\Facades\Log;
// use App\Connection\BankTransactionConnection;
use App\Helpers\CheckIsAmUser;

class TranferMoneyDashdoardController extends Controller
{
    protected $bankTransactionService;
    protected $validator;
    protected $request;

    public function __construct(
        ValidationService $validator,
        BankTransactionService $bankTransactionService, 
        Request $request
    )
    {
        $this->validator = $validator;
        $this->bankTransactionService = $bankTransactionService;
        $this->request = $request;
    }

    public function dashboard()
    {
        return view('gate.dashboard.index');
    }

    // /**
    //  * get sum + count transaction
    //  *
    //  * @param Request $request
    //  * @return JSON
    //  */
    // public function getTtTransaction(Request $request)
    // {
    //     $params = $request->all();
    //     $dataRow = $this->bankTransactionService->getListTtTransaction($params);
    //     return response(['data'=> $dataRow])->header('Content-Type', 'json');
    // }

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

        $listTransaction = $this->bankTransactionService->getChartTransaction($params['data'], $partnerCode);

        $valueChart = [];
        $valueChart['data']['sum'] = 0;
        $valueChart['data']['count'] = 0;

        foreach($listTransaction['data'] as $data){
            $valueChart['data']['head'][] = date('d/m', strtotime($data->response_time));
            $valueChart['data']['value'][] = $data->sumAmount;
            $valueChart['data']['sum'] = $valueChart['data']['sum'] + $data->sumAmount;
            $valueChart['data']['count']++;
        }

        // dump($valueChart);


        return response()->json($valueChart);
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
        $dataTotal = $this->bankTransactionService->getReportPartnerByDay($params, $partnerCode);
        // dump($dataTotal);
        return view('gate.dashboard.flash')->with(['data'=> $dataTotal]);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return json
     */
    public function getFlashSecond(Request $request)
    {
        $params = $request->only('query');
        // dump($params);
        $dataTotal = $this->bankTransactionService->getReportPartnerByDay2($params);
        return view('gate.dashboard.flash_second')->with(['data'=> $dataTotal]);
    }

    public function exportBankTransactionDashboard(Request $request)
    {
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $time = date('d-m-Y H:i:s');
        $objExport = new ExportBankTransactionDashboard();
        $objExport->params = $params;
        $name = 'Thống kê theo nhà cung cấp và theo ngân hàng_' . now()->format('dmYHis') . '.xlsx';
        try {
            \Excel::store($objExport, $name, 'exports');
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::GATE_BANK, "Export Bank Transaction Dashboard", compact('params')));
        } catch (\Exception $ex) {
            return  response(['code' => 500, 'message' => 'error'])->header('Content-Type', 'json');
        }
        return response(['code' => 200, 'message' => 'success', 'path' => $name])->header('Content-Type', 'json');
    }


    public function downloadBankTransactionDashboard()
    {
        $file = $_GET['file'];
        return \Response::download(public_path('/media/exports/') . $file)->deleteFileAfterSend(true);
    }
}
