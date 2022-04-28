<?php

namespace App\Http\Controllers\Gate;

use App\Helpers\ArrayHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Export\ExportShopcardTransaction;
use App\Services\ValidationService;
use App\Services\Gate\ShopcardTransactionService;
use App\Transformers\ShopCardTransactionTransformer;
use Illuminate\Http\Request;
use App\Helpers\CheckIsAmUser;

class ShopCardTransactionController extends Controller
{
    protected $shopcardTransaction;
    protected $validator;
    protected $request;

    function __construct(ValidationService $validator, ShopcardTransactionService $shopcardTransaction, Request $request)
    {
        $this->validator = $validator;
        $this->shopcardTransaction = $shopcardTransaction;
        $this->request = $request;
    }

    public function index()
    {
        return view('gate.shopcard-transaction.list');
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

        $data = $this->shopcardTransaction->getList($params, $partnerCode);

        $data->data = ShopCardTransactionTransformer::transformCollection($data->data);

        return response()->json($data);
    }

    public function detail($id)
    {
        $result = $this->shopcardTransaction->detail($id);
        // return response()->json($result->data);
        return view('gate.shopcard-transaction.detail-popup', ['detail' => ShopCardTransactionTransformer::transform($result->data)]);
    }
    public function exportTransaction(Request $request)
    {
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $time = date('d-m-Y H:i:s');
        $objExport = new ExportShopcardTransaction();
        $objExport->params = $params;
        $filepath = '/log-shop-card-' . $time . '.xlsx';
        try {
            \Excel::store($objExport, $filepath, 'public');
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::SHOPCARD_TRANSACTION, "Export Giao dịch Shopcard", compact('params')));
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
