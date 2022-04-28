<?php

namespace App\Http\Controllers\Gate;

use App\Helpers\ArrayHelper;
use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Export\ExportShopcardPartnerCardData;
use App\Services\ValidationService;
use App\Services\Gate\ShopcardPartnerCardDataService;
use App\Transformers\ShopcardPartnerCardDataTransformer;
use Illuminate\Http\Request;

class ShopCardPartnerCardDataController extends Controller
{
    protected $shopcardPartnerCardDataService;
    protected $validator;
    protected $request;

    function __construct(ValidationService $validator, ShopcardPartnerCardDataService $shopcardPartnerCardDataService, Request $request)
    {
        $this->validator = $validator;
        $this->shopcardPartnerCardDataService = $shopcardPartnerCardDataService;
        $this->request = $request;
    }

    public function index()
    {
        return view('gate.shop-card-partner-card-data.list');
    }

    /*
     *
     */
    public function ajaxGetList(Request $request)
    {
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $data = $this->shopcardPartnerCardDataService->getList($params);
        $data->data = ShopcardPartnerCardDataTransformer::transformCollection($data->data);

        return response()->json($data);
    }

    public function detail($id)
    {
        $result = $this->shopcardPartnerCardDataService->detail($id);
        // return response()->json($result->data);
        return view('gate.shop-card-partner-card-data.detail-popup', ['detail' => ShopcardPartnerCardDataTransformer::transform($result->data)]);
    }

    public function exportTransaction(Request $request)
    {
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $time = date('d-m-Y H:i:s');
        $objExport = new ExportShopcardPartnerCardData();
        $objExport->params = $params;
        $filepath = '/log-shop-card-' . $time . '.xlsx';
        try {
            \Excel::store($objExport, $filepath, 'public');
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::SHOPCARD_PARTNER_CARD_DATA, "Export Thẻ đã bán Shopcard", compact('params')));
        } catch (\Exception $ex) {
            return response(['code' => 500, 'message' => 'error'])->header('Content-Type', 'json');
        }
        return response(['code' => 200, 'message' => 'success', 'path' => $filepath])->header('Content-Type', 'json');
    }

    public function downloadTransaction()
    {
        $file = $_GET['file'];
        return \Response::download(storage_path('app/public') . $file)->deleteFileAfterSend(true);
    }
}
