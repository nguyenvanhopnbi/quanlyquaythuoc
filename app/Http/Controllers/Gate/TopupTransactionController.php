<?php

namespace App\Http\Controllers\Gate;

use App\Helpers\ArrayHelper;
use App\Http\Controllers\Controller;
use App\Services\ValidationService;
use App\Services\Gate\TopupTransactionService;
use App\Services\Gate\TopupProviderConfigService;
use App\Transformers\TopupTransactionTransformer;
use App\Http\Controllers\Export\ExportTopupTransaction;
use Illuminate\Http\Request;
use App\Helpers\CheckIsAmUser;

class TopupTransactionController extends Controller
{
    protected $topupTransactionService;
    protected $validator;
    protected $request;

    function __construct(ValidationService $validator, TopupTransactionService $topupTransactionService, Request $request, TopupProviderConfigService $topupProviderConfigService)
    {
        $this->validator = $validator;
        $this->topupTransactionService = $topupTransactionService;
        $this->topupProviderConfigService = $topupProviderConfigService;
        $this->request = $request;
    }

    public function index()
    {
        $params['limit'] = 1000;
        $data = $this->topupProviderConfigService->getListSource($params);
        $provider = $data['items'] ? $data['items'] : [];
        return view('gate.topup-transaction.list')->with(['providers' => $provider]);
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
        $data = $this->topupTransactionService->getList($params, $partnerCode);
        $data->data = TopupTransactionTransformer::transformCollection($data->data);

        return response()->json($data);
    }

    public function detail($id)
    {
        $result = $this->topupTransactionService->detail($id);
        return view('gate.topup-transaction.detail-popup', ['detail' => TopupTransactionTransformer::transform($result->data)]);
    }

    public function exportTransaction(Request $request)
    {
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $time = date('d-m-Y H:i:s');
        $objExport = new ExportTopupTransaction();
        $objExport->params = $params;
        $filepath = '/log-card-transaction-' . $time . '.xlsx';
        try {
            \Excel::store($objExport, $filepath, 'public');
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TOPUP_TRANSACTION, "Export Giao dịch Topup", compact('params')));
        } catch (\Exception $ex) {
            return  response(['code' => 500, 'message' => 'error'])->header('Content-Type', 'json');
        }
        return response(['code' => 200, 'message' => 'success', 'path' => $filepath])->header('Content-Type', 'json');
    }

    public function downloadTransaction()
    {
        $file = $_GET['file'];
        return \Response::download(storage_path('app/public') . $file)->deleteFileAfterSend(true);
    }

    public function refund()
    {
        $params = $this->request->only('transaction_id');
        $transactionId = $params['transaction_id'];
        $result = $this->topupTransactionService->refund($transactionId);
        if ($result['success']) {
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TOPUP_TRANSACTION, "Refund Giao dịch Topup #$transactionId", compact('transactionId')));
        }
        return response()->json($result);
    }
}
