<?php

namespace App\Http\Controllers\Gate;

use App\Helpers\ArrayHelper;
use App\Http\Controllers\Controller;
use App\Services\ValidationService;
use App\Services\Gate\PartnerTransactionService;
use App\Transformers\PartnerTransactionTransformer;
use App\Http\Controllers\Export\ExportPartnerTransaction;
use Illuminate\Http\Request;

class PartnerTransactionController extends Controller
{
    protected $partnerTransactionService;
    protected $validator;
    protected $request;

    function __construct(ValidationService $validator, PartnerTransactionService $partnerTransactionService, Request $request)
    {
        $this->validator = $validator;
        $this->partnerTransactionService = $partnerTransactionService;
        $this->request = $request;
    }

    public function index()
    {
        return view('gate.partner-transaction.list');
    }

    /*
     *
     */
    public function ajaxGetList(Request $request)
    {
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        // dd($params);
        $data = $this->partnerTransactionService->getList($params);
        $data->data = PartnerTransactionTransformer::transformCollection($data->data);

        return response()->json($data);
    }

    public function detail($id)
    {
        $data = $this->partnerTransactionService->detail($id);
        return view('gate.partner-transaction.detail-popup', ['detail' => PartnerTransactionTransformer::transform($data->data)]);
    }

    public function exportTransaction(Request $request)
    {
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $time = date('d-m-Y H:i:s');
        $objExport = new ExportPartnerTransaction();
        $objExport->params = $params;
        $filepath = '/log-card-transaction-' . $time . '.xlsx';
        try {
            \Excel::store($objExport, $filepath, 'public');
        } catch (\Exception $ex) {
            return  response(['code' => 500, 'message' => 'error'])->header('Content-Type', 'json');
        }
        event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_TRANSACTION, "Export Giao dịch Partner", compact('params')));
        return response(['code' => 200, 'message' => 'success', 'path' => $filepath])->header('Content-Type', 'json');
    }

    public function downloadTransaction()
    {
        $file = $_GET['file'];
        return \Response::download(storage_path('app/public') . $file)->deleteFileAfterSend(true);
    }
}
