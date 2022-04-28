<?php

namespace App\Http\Controllers\Gate;

use App\Helpers\ArrayHelper;
use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Export\ExportEbillTransaction;
use App\Http\Controllers\Export\ExportShopcard;
use App\Services\ValidationService;
use App\Services\Gate\EbillTransactionService;
use App\Transformers\EbillTransactionTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Connection\PartnerConnection;
use App\Connection\CollectMoneyPartnerConnection;
use App\Connection\EbillTransactionConnection;
use App\Helpers\CheckIsAmUser;



class EbillTransactionController extends Controller
{
    protected $ebillTransactionService;
    protected $validator;
    protected $request;

    function __construct(ValidationService $validator, EbillTransactionService $ebillTransactionService, Request $request)
    {
        $this->validator = $validator;
        $this->ebillTransactionService = $ebillTransactionService;
        $this->request = $request;
    }

    public function resendIPN(Request $request){
        // dd($request->transaction_id . "-------" . $request->bill_id);
        $params = [];
        if(isset($request->transaction_id)){
            $params['transaction_id'] = $request->transaction_id;
        }

        if(isset($request->bill_id)){
            $params['bill_id'] = $request->bill_id;
        }

        $result = EbillTransactionConnection::resendTransaction($params);
        if(!$result){
            return;
        }
        if(isset($result) and $result->success){
            header('Content-Type: application/json; charset=utf-8');
            $request->session()->flash('status_resend', 'Resend transaction was successful! TransactionID: '.$request->transaction_id. ' BillID: '.$request->bill_id);
            return redirect()->route('gate.ebill-transaction.list', [
                'transaction_id_resend' => $request->transaction_id,
                'result_resend' => ($result->success)?'success':'fail'
            ]);
        }



    }

    public function getListPartnerCode(){
        $params = [];
        $params['pagination']['limit'] = 100000;
        $data = PartnerConnection::getList($params);
        if(isset($data->data)){
            return $data->data;
        }

    }

    public function getProviderCode(){
        $params = [];
        $params['pagination']['limit'] = 100000;
        $data = CollectMoneyPartnerConnection::getList($params);
        if(isset($data->data)){
            return $data->data;
        }

    }

    public function index()
    {
        return view('gate.ebill-transaction.list', [
            'partnerCodeList' => $this->getListPartnerCode(),
            'providerCodeList' => $this->getProviderCode()
        ]);
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
        $data = $this->ebillTransactionService->getList($params, $partnerCode);
        $data->data = EbillTransactionTransformer::transformCollection($data->data);
        return response()->json($data);
    }

    public function detail($id)
    {
        $data = $this->ebillTransactionService->detail($id);

        return view('gate.ebill-transaction.detail-popup', ['detail' => EbillTransactionTransformer::transform($data->data)]);
    }

    /**
     * @param Request $request
     */
    public function exportEbillTransaction(Request $request){
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $date = date('d-m-Y');
        $time = date('H:i:s');
        $objExport = new ExportEbillTransaction();
        $objExport->params = $params;
        $filepath = '/ebill-transaction-list-' . $date.'-'.$time . '.xlsx';

        try {
            \Excel::store($objExport, $filepath, 'public');
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::EBILL_TRANSACTION, "Export Giao dịch Ebill", compact('params')));
        } catch (\Exception $ex) {
            return response(['code' => 500, 'message' => 'error'])->header('Content-Type', 'json');
        }

        return response(['code' => 200, 'message' => 'success', 'path' => $filepath])->header('Content-Type', 'json');
    }
}
