<?php

namespace App\Http\Controllers\Gate;

use App\Helpers\ArrayHelper;
use App\Helpers\Message;
use App\Helpers\PusherHelper;
use Illuminate\Http\Request;
use App\Services\ValidationService;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Export\ExportRefundTransaction;
use App\Services\Gate\BankTransactionService;
use App\Transformers\BankTransactionTransformer;
use App\Transformers\BankRefundTransactionTransformer;
use App\Http\Controllers\Export\ExportBankTransaction;
use Exception;
use App\Models\UserAMmodel;
use Illuminate\Support\Facades\Auth;
use App\Helpers\CheckIsAmUser;
use App\Connection\BankTransactionConnection;
use Illuminate\Support\Facades\Gate;

class BankTransactionController extends Controller
{
    protected $bankTransactionService;
    protected $validator;
    protected $request;

    public function __construct(ValidationService $validator, BankTransactionService $bankTransactionService, Request $request)
    {
        $this->validator = $validator;
        $this->bankTransactionService = $bankTransactionService;
        $this->request = $request;
    }

    public function PartnerServiceTypeConfig(){
        return view('gate.bank-transaction.PartnerServiceTypeConfig');
    }


    public function index()
    {
        return view('gate.bank-transaction.list-transaction');
    }

    public function HoldTransaction(){
        return view('gate.bank-transaction.bankTransactionHold');
    }

    public function UnHoldTransaction(){
        return view('gate.bank-transaction.bankTransactionUnHold');
    }

    public function CrossCheckTranSaction(){
        return view('gate.bank-transaction.bankTransactionCrossCheck');
    }

    public function ajaxGetList(Request $request)
    {
        $params = $request->all();

        if($params['query']['holding_status'] == 'all'){
            $params['query']['holding_status'] = '';
        }

        $partnerCode = CheckIsAmUser::checkIsAmUser();

        $params = ArrayHelper::removeArrayNull($params);
        $data = $this->bankTransactionService->getList($params, $partnerCode);
        // dd($data);

        $data->data = !empty($data->data) ? BankTransactionTransformer::transformCollection($data->data) : [];

        foreach($data->data as $valueData){
            ($valueData->holding_status == 'no') ? $valueData->holding_status = '<div class="badge badge-warning text-white"> No </div>' : $valueData->holding_status = '<div class="badge badge-primary"> '.$valueData->holding_status.' </div>';
            ($valueData->has_refund == '1') ? $valueData->has_refund = '<div class="badge badge-primary text-white"> True </div>' : $valueData->has_refund = '<div class="badge badge-warning text-white"> False </div>';
        }


        return response()->json($data);
    }

    public function detail($id)
    {
        $data = $this->bankTransactionService->detail($id);
        return view('gate.bank-transaction.detail-popup', ['detail' => BankTransactionTransformer::transform($data)]);
    }

    public function exportTransaction(Request $request)
    {

        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $secret = $this->bankTransactionService->exportCSV($params);
        return response(
            [
                'message' => 'success',
                'channelName' => PusherHelper::getExportChannel(auth()->id()),
                'channelEven' => PusherHelper::getExportEven($secret),
                'key' => env('PUSHER_APP_KEY'),
                'cluster' => env('PUSHER_APP_CLUSTER')
            ]
        )->header('Content-Type', 'json');
    }

    public function listExportColumns()
    {
        return ExportBankTransaction::AVAILABLE_COLUMNS;
    }

    public function downloadTransaction()
    {
        $file = $this->request->input('file', '');
        if (!$file) {
            $data = Message::get(1);
            return response()->json($data, 400);
        }
        return \Response::download($this->bankTransactionService->getExportPath($file))->deleteFileAfterSend(true);
    }

    public function resendIpn()
    {

        if (!Gate::allows('resend-action-gate-transaction')) {
            return ['success' => false, 'message' => 'Bạn chưa được cấp quyền resend'];
        }

        $params = $this->request->only('transaction_id');
        $transactionId = $params['transaction_id'];
        $result = $this->bankTransactionService->resendIpn($transactionId);
        if ($result['success']) {
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::GATE_BANK, "ResendIpn Transaction CTT #$transactionId']}", compact('transactionId')));
        }
        // return ['success' => false, 'message' => 'that bai'];
        return response()->json($result);
    }

    public function getPopupRefund()
    {

        // if (!Gate::allows('refund-action-gate-transaction')) {
        //     return ['success' => false, 'message' => 'Bạn chưa được cấp quyền refund'];
        // }

        $params = $this->request->only('transaction_id', 'max_amount', 'bank_code');
        return view('gate.bank-transaction.popup_refund_bank_transaction', ['detail' => $params]);
    }

    public function getPopupHolding()
    {

        // if (!Gate::allows('hold-action-gate-transaction')) {
        //     return ['success' => false, 'message' => 'Bạn chưa được cấp quyền hold'];
        // }

        $params = $this->request->only('transaction_id');
        return view('gate.bank-transaction.popup_holding_bank_transaction', ['detail' => $params]);
    }
    public function getPopupunHolding(){

        // if (!Gate::allows('unhold-action-gate-transaction')) {
        //     return ['success' => false, 'message' => 'Bạn chưa được cấp quyền un-hold'];
        // }

        $params = $this->request->only('transaction_id');
        return view('gate.bank-transaction.popup_un_holding_bank_transaction', ['detail' => $params]);
    }

    public function refundTransaction()
    {

        if (!Gate::allows('refund-action-gate-transaction')) {
            $data['success'] = false;
            $data['message'] = "Bạn chưa được cấp quyền refund !!!";
            return response()->json($data, 200);
        }

        $params = $this->request->only('amount', 'reason', 'transaction_id');
        $params = ArrayHelper::removeArrayNull($params);
        $validator = $this->validator->make($params, 'refund_bank_transaction_fields');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->messages()), 400);
        }

        $result = $this->bankTransactionService->refund($params);

        if (isset($result->errorCode) && $result->errorCode === 0) {

            $data['success'] = true;
            $data['message'] = "Refund bank transaction thành công !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::GATE_BANK, "Refund Transaction CTT #{$params['transaction_id']}", compact('params')));

            return response()->json($data, 200);
        } else if (isset($result->errorCode) && $result->errorCode != 0) {
            $data = Message::getArray($result->errorCode, $result->message, []);
            return response()->json($data, 400);
        } else {
            $data = Message::get(13, $lang = '', $params);
            return response()->json($data, 400);
        }
    }

    public function refundTransactions()
    {
        return view('gate.bank-refund-transaction.list-transaction');
    }

    /*
     *
     */
    public function ajaxGetListRefund(Request $request)
    {
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        // dd($params);
        // $params['query']['vendor_ref_id'] = 'NAPAS:521500147';

        $partnerCode = CheckIsAmUser::checkIsAmUser();

        $data = $this->bankTransactionService->getListRefund($params, $partnerCode);
        $data->data = BankRefundTransactionTransformer::transformCollection($data->data);
        // dump($params);
        // dump($data);
        foreach($data->data as $valueData){
            ($valueData->holding_status == 'no') ? $valueData->holding_status = '<div class="badge badge-warning text-white">No</div>' : '<div class="badge badge-primary text-white">'.$valueData->holding_status.'</div>';
        }
        return response()->json($data);
    }

    public function detailRefundTransaction($id)
    {
        $data = $this->bankTransactionService->detailRefundTransaction($id);
        return view('gate.bank-refund-transaction.detail-popup', ['detail' => BankRefundTransactionTransformer::transform($data)]);
    }

    public function exportRefundTransaction(Request $request)
    {

        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $time = date('d-m-Y H:i:s');
        $objExport = new ExportRefundTransaction();
        $objExport->params = $params;
        $name = 'log_transaction_' . now()->format('dmYHis') . '.xlsx';
        try {
            \Excel::store($objExport, $name, 'exports');
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::GATE_BANK, "Export Refund Transaction CTT", compact('params')));
        } catch (Exception $ex) {
            return  response(['code' => 500, 'message' => 'error'])->header('Content-Type', 'json');
        }
        return response(['code' => 200, 'message' => 'success', 'path' => $name])->header('Content-Type', 'json');
    }

    public function downloadRefundTransaction()
    {
        $file = $_GET['file'];
        return \Response::download(storage_path('app/public') . $file)->deleteFileAfterSend(true);
    }

    public function ExportCrossCheckTranSaction(Request $request){
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $params = [];
        $params['pagination']['limit'] = 10000;
        // if(isset($this->pageCurrent)){
        //     $params['pagination']['page'] = $this->pageCurrent;
        // }
        if(isset($request->transaction_id)){
            $params['query']['transaction_id'] = $request->transaction_id;
        }
        if(isset($request->order_id)){
            $params['query']['order_id'] = $request->order_id;
        }
        if(isset($request->partner_code)){
            $params['query']['partner_code'] = $request->partner_code;
        }
        if(isset($request->va_transaction_id)){
            $params['query']['va_transaction_id'] = $request->va_transaction_id;
        }
        if(isset($request->va_transaction_status) and !empty($request->va_transaction_status)){
            $params['query']['va_transaction_status'] = $request->va_transaction_status;
        }

        if(isset($request->start_time)){
            $params['query']['start_time'] = strtotime($request->start_time);
        }
        if(isset($request->end_time)){
            $params['query']['end_time'] = strtotime($request->end_time);
        }

        $data = BankTransactionConnection::vaTransactionList($params);

        $meta = $data->meta;
        $pages = $meta->pages;
        $page = $meta->page;
        unset($data);
        $count = 0;
        $title = [];
        $valueCSV = [];

        $begin = microtime(true);
        $fileName = date('YmdHis', time());
        header('Content-Type: application/vnd.ms-execl');
        header('Content-Disposition: attachment;filename="' . $fileName . '.csv"');

        $handle = fopen("php://output", 'a');
        fputs($handle, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

        if($pages >= 1){
            for ($i = 1; $i <= $pages ; $i++) {
                $params['pagination']['page'] = $i;
                $data = BankTransactionConnection::vaTransactionList($params)->data;

                foreach($data as $data){

                    if($count == 0){
                        $title = [
                            'Transaction ID',
                            'Order ID',
                            'Payment Amount',
                            'Partner Code',
                            'VA transaction id',
                            'VA transaction va',
                            'VA transaction status',
                            'Timestamps'
                        ];
                        fputcsv($handle, $title);
                        $count++;
                    }

                    $data = (array)$data;
                    $valueCSV[] = $data['transaction_id'];
                    $valueCSV[] = $data['order_id'];
                    $valueCSV[] = number_format($data['payment_amount'], 0, '', ',');
                    $valueCSV[] = $data['partner_code'];
                    $valueCSV[] = $data['va_transaction_id'];
                    $valueCSV[] = number_format($data['va_transaction_amount'], 0, '', ',');
                    $valueCSV[] = $data['va_transaction_status'];
                    $valueCSV[] = date('d-m-Y H:i:s', $data['va_transaction_timestamp']);

                    // dump($valueCSV);
                    // dd($data);

                    fputcsv($handle, $valueCSV);
                    $valueCSV = [];
                }
                $count++;

            }
        }
        unset($data);
        unset($valueCSV);
        fclose($handle);

        ob_flush();
        flush();

        $end = microtime(true);

    }
}
