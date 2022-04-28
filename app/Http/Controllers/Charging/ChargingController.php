<?php

namespace App\Http\Controllers\Charging;

use App\Helpers\ArrayHelper;
use Illuminate\Http\Request;
use App\Services\ValidationService;
use App\Http\Controllers\Controller;
use App\Transformers\ChargingTransformer;
use App\Services\Charging\ChargingService;
use App\Http\Controllers\Export\ExportCardTransaction;
use App\Services\Gate\PartnerService;
use Exception;
use App\Helpers\CheckIsAmUser;
use Illuminate\Support\Facades\Gate;


class ChargingController extends Controller
{
    protected $chargingService;
    protected $validator;
    protected $request;

    public function __construct(
        ValidationService $validator,
        ChargingService $chargingService,
        Request $request,
        PartnerService $partnerService
    ) {
        $this->validator = $validator;
        $this->chargingService = $chargingService;
        $this->request = $request;
        $this->partnerService = $partnerService;
    }

    public function index()
    {
        return view('charging.transaction.list');
    }

    public function sandbox(){
        return view('charging.transaction.sandbox');
    }

    /*
     *
     */
    public function ajaxGetList(Request $request)
    {
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);

        $partnerCode = null;
        $partnerCode = CheckIsAmUser::checkIsAmUser();
        $data = $this->chargingService->getList($params, $partnerCode);

        if (isset($data->data)) {
            $data->data = ChargingTransformer::transformCollection($data->data);
        }
        return response()->json($data);
    }

    public function detail($id)
    {

        if (!Gate::allows('charging-card-transaction-read')) {
            return ['success' => false, 'message' => 'Bạn chưa được cấp quyền xem chi tiết charging'];
        }

        $partnerCode = null;
        $partnerCode = CheckIsAmUser::checkIsAmUser();
        $result = $this->chargingService->detail($id, $partnerCode);
        return view('charging.transaction.detail-popup', ['detail' => ChargingTransformer::transform($result->data)]);
    }

    public function exportTransaction(Request $request)
    {
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $time = date('d-m-Y H:i:s');
        $objExport = new ExportCardTransaction();
        $objExport->params = $params;
        $filepath = '/log-card-transaction-' . $time . '.xlsx';
        try {
            \Excel::store($objExport, $filepath, 'public');
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::CHARGING_CARD_TRANSACTION, "Export Giao dịch gạch thẻ AC", compact('params')));
        } catch (Exception $ex) {
            return  response(['code' => 500, 'message' => 'error'])->header('Content-Type', 'json');
        }
        return response(['code' => 200, 'message' => 'success', 'path' => $filepath])->header('Content-Type', 'json');
    }

    public function downloadTransaction()
    {
        $file = $_GET['file'];
        return \Response::download(storage_path('app/public') . $file)->deleteFileAfterSend(true);
    }

    public function dashboard()
    {
        $partners = [];
        $partners = $this->partnerService->getAll();
        return view('charging.dashboard.index')->with(['partners' => $partners]);
    }

    /**
     * get sum + count transaction
     *
     * @param Request $request
     * @return JSON
     */
    public function getTtTransaction(Request $request)
    {
        $params = $request->all();

        $partnerCode = null;
        $partnerCode = CheckIsAmUser::checkIsAmUser();

        $dataRow = $this->chargingService->getListTtTransaction($params, $partnerCode);
        return response(['data' => $dataRow])->header('Content-Type', 'json');
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
        $listTransaction = $this->chargingService->getChartTransaction($params['data'], $partnerCode);

        return response()->json($listTransaction);
    }

    /**
     * get chart pie transaction
     *
     * @param Request $request
     * @return void
     */
    public function getChartPieTransaction(Request $request)
    {
        $params = $request->all();
        $partnerCode = null;
        $partnerCode = CheckIsAmUser::checkIsAmUser();
        $listTransaction = $this->chargingService->getChartPieTransaction($params['data'], $partnerCode);
        return response()->json($listTransaction);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return json
     */
    public function getFlashReport(Request $request)
    {
        $params = $request->all('partner_code', 'time-from', 'time-to');
        $params['partner_code'] = isset($params['partner_code']) ? $params['partner_code'] : 'all';
        $params['time-from'] = isset($params['time-from']) ? $params['time-from'] : '';
        $params['time-to'] = isset($params['time-to']) ? $params['time-to'] : '';

        $partnerCode = null;
        $partnerCode = CheckIsAmUser::checkIsAmUser();
        $dataTotal = $this->chargingService->getReportPartnerByDay($params, $partnerCode);
        return view('charging.dashboard.flash')->with(['data' => $dataTotal->data]);
    }
}
