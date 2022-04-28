<?php

namespace App\Http\Controllers\Gate;

use App\Connection\BillServiceConnection;
use App\Helpers\ArrayHelper;
use App\Http\Controllers\Controller;
use App\Services\ValidationService;
use App\Services\Gate\TransferMoneyTransactionService;
use App\Transformers\TransferMoneyTransactionTransformer;
use App\Http\Controllers\Export\ExportTransferMoneyTransaction;
use Illuminate\Http\Request;
use App\Helpers\CheckIsAmUser;

class TransferMoneyTransactionController extends Controller
{

    protected $transferMoneyTransactionService;
    protected $validator;
    protected $request;

    function __construct(ValidationService $validator, TransferMoneyTransactionService $transferMoneyTransactionService, Request $request)
    {
        $this->validator = $validator;
        $this->transferMoneyTransactionService = $transferMoneyTransactionService;
        $this->request = $request;
    }

    public function index()
    {
        return view('gate.transfer-money-transaction.list');
    }

    public function managebalance(){
        return view('gate.transfer-money-transaction.manage-balance');
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

        $data = $this->transferMoneyTransactionService->getList($params, $partnerCode);

        if (isset($data->data) && $data->data) {
            $data->data = TransferMoneyTransactionTransformer::transformCollection($data->data);
            return response()->json($data);
        } else {
            return response()->json([]);
        }
    }

    public function detail($id)
    {
        $result = $this->transferMoneyTransactionService->detail($id);
        return view('gate.transfer-money-transaction.detail-popup', ['detail' => TransferMoneyTransactionTransformer::transform($result->data)]);
    }

    public function exportTransaction(Request $request)
    {
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $time = date('d-m-Y H:i:s');
        $objExport = new ExportTransferMoneyTransaction();
        $objExport->params = $params;
        $filepath = '/log-transfer-money-transaction-' . $time . '.xlsx';
        try {
            \Excel::store($objExport, $filepath, 'public');
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

    public function refund(Request $request)
    {
        $request->validate([
            'transactionId' => 'required'
        ]);

        $refundStatus = BillServiceConnection::refund($request->transactionId);
        if (isset($refundStatus->errorCode) && $refundStatus->errorCode == 0) {
            return response()->json([], 204);
        }
        return response()->json(['message' => $refundStatus->message], 500);
    }
}
