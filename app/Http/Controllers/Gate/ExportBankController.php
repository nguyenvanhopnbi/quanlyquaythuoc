<?php

namespace App\Http\Controllers\Gate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Gate\BankTransactionService;
use App\Helpers\CheckIsAmUser;

class ExportBankController extends Controller
{
    public $rows = [];
    public $pages = 0;
    public $perpage = 30000;
    public $transaction_id;
    public $Amount;
    public $order_id;
    public $status;
    public $bank_code;
    public $partner_code;
    public $startTime;
    public $endTime;
    public $application_id;
    public $payment_method;
    public $client_ip;
    public $order_info;
    public $vendor_code;
    public $result;
    public $tit = [];

    public function exportCSV(Request $request){
        $BankTransactionService = new BankTransactionService();

        $this->params = [
            'pagination' => [
                'page' => 1,
                'perpage' => $this->perpage
            ],
        ];

        if(isset($request->result)){
            $this->result = $request->result;
        }
        if(isset($request->result)){
            $this->result = $request->result;
        }
        if(isset($request->transaction_id)){
            $this->transaction_id = $request->transaction_id;
            $this->params['query']['transaction_id'] = $this->transaction_id;
        }
        if(isset($request->order_id)){
            $this->order_id = $request->order_id;
            $this->params['query']['order_id'] = $this->order_id;
        }
        if(isset($request->status)){
            $this->status = $request->status;
            $this->params['query']['status'] = $this->status;
        }
        if(isset($request->Amount)){
            $this->Amount = $request->Amount;
            $this->params['query']['amount'] = $this->Amount;
        }
        if(isset($request->bank_code)){
            $this->bank_code = $request->bank_code;
            $this->params['query']['bank_code'] = $this->bank_code;
        }
        if(isset($request->partner_code)){
            $this->partner_code = $request->partner_code;
            $this->params['query']['partner_code'] = $this->partner_code;
        }
        if(isset($request->startTime)){
            $this->startTime = $request->startTime;
            $this->params['query']['startTime'] = $this->startTime;
        }

        if(isset($request->endTime)){
            $this->endTime = $request->endTime;
            $this->params['query']['endTime'] = $this->endTime;
        }

        if(isset($request->application_id)){
            $this->application_id = $request->application_id;
            $this->params['query']['application_id'] = $this->application_id;
        }
        if(isset($request->payment_method)){
            $this->payment_method = $request->payment_method;
            $this->params['query']['payment_method'] = $this->payment_method;
        }
        if(isset($request->client_ip)){
            $this->client_ip = $request->client_ip;
            $this->params['query']['client_ip'] = $this->client_ip;
        }
        if(isset($request->order_info)){
            $this->order_info = $request->order_info;
            $this->params['query']['order_info'] = $this->order_info;
        }
         if(isset($request->vendor_code)){
            $this->vendor_code = $request->vendor_code;
            $this->params['query']['vendor_code'] = $this->vendor_code;
        }
        if(isset($request->vendor_ref_id)){
            $this->params['query']['vendor_ref_id'] = $request->vendor_ref_id;
        }

        if(isset($request->input_bank_holding_status)){
            $this->params['query']['holding_status'] = $request->input_bank_holding_status;
        }
        if(isset($request->hasRefund)){
            $this->params['query']['has_refund'] = $request->hasRefund;
        }

        $partnerCode = CheckIsAmUser::checkIsAmUser();


        // 'input_bank_holding_status' => $this->input_bank_holding_status,
        // 'hasRefund' => $this->hasRefund

        // $this->params['pagination']['page'] = 1;
        $data = $BankTransactionService->getList($this->params, $partnerCode);
        $this->pages = $data->meta->pages;
        unset($data);

        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $fileName = date('YmdHis', time());
        header('Content-Type: application/vnd.ms-execl');
        header('Content-Disposition: attachment;filename="' . $fileName . '.csv"');

        $handle = fopen("php://output", 'a');
        fputs($handle, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

        $firstTime = 1;
        for ($i=1; $i <=$this->pages ; $i++) {
            $this->params['pagination']['page'] = $i;

            $partnerCode = CheckIsAmUser::checkIsAmUser();

            $data = $BankTransactionService->getList($this->params, $partnerCode);

            foreach($data->data as $key => $data){
                $data = (array)$data;
                unset($data['vendor_callback_data']);
                unset($data['error_code']);
                unset($data['extra_data']);
                unset($data['extra_info']);

                $data['request_time'] = date('d-m-Y H:i:s', $data['request_time']);
                $data['response_time'] = date('d-m-Y H:i:s', $data['response_time']);

                foreach($data as $ind => $value){

                    if(!in_array($ind, $this->result) && $ind != 'transaction_fee'){
                        unset($data[$ind]);
                    }
                }

                if($key == 0 and $firstTime == 1){
                    foreach($data as $title=>$content){
                        $this->tit[] = $title;
                    }
                    fputcsv($handle, $this->tit);
                    $firstTime++;
                }

                if(isset($data['has_refund'])){
                    if($data['has_refund'] == '0'){
                        $data['has_refund'] = 'Không';
                    }else{
                        $data['has_refund'] = 'Có';
                    }
                }

                fputcsv($handle, $data);
            }

        }
        unset($data);

        fclose($handle);
        ob_flush();
        flush();
        $end = microtime(true);
    }
}
