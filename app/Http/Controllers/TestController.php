<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Gate\BankTransactionService;

class TestController extends Controller
{
    public $rows = [];
    public $pages = 0;
    public $perpage = 10000;
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
    public $params;

    public function __construct($Amount, $status, $result, $vendor_code, $order_info, $client_ip, $payment_method, $transaction_id, $partner_code, $bank_code, $application_id, $startTime, $endTime){
        $this->result = $result;
        $this->vendor_code = $vendor_code;
        $this->order_info = $order_info;
        $this->client_ip = $client_ip;
        $this->payment_method = $payment_method;
        $this->transaction_id = $transaction_id;
        $this->partner_code = $partner_code;
        $this->bank_code = $bank_code;
        $this->application_id = $application_id;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->status = $status;
        $this->Amount = $Amount;
    }
    public function Test(){

        $BankTransactionService = new BankTransactionService();
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $this->params = [
            'pagination' => [
                'page' => 1,
                'perpage' => $this->perpage
            ],

        ];

        if(!empty($this->transaction_id) && isset($this->transaction_id)){
            $this->params['query']['transaction_id'] = $this->transaction_id;
        }
        if(!empty($this->order_id) && isset($this->order_id)){
            $this->params['query']['order_id'] = $this->order_id;
        }
        if(!empty($this->status) && isset($this->status)){
            $this->params['query']['status'] = $this->status;
        }
        if(!empty($this->Amount) && isset($this->Amount)){
            $this->params['query']['Amount'] = $this->Amount;
        }
        if(!empty($this->bank_code) && isset($this->bank_code)){
            $this->params['query']['bank_code'] = $this->bank_code;
        }
        if(!empty($this->partner_code) && isset($this->partner_code)){
            $this->params['query']['partner_code'] = $this->partner_code;
        }
        if(!empty($this->startTime) && isset($this->startTime)){
            $this->params['query']['startTime'] = $this->startTime;
        }
        if(!empty($this->endTime) && isset($this->endTime)){
            $this->params['query']['endTime'] = $this->endTime;
        }
        if(!empty($this->application_id) && isset($this->application_id)){
            $this->params['query']['application_id'] = $this->application_id;
        }
        if(!empty($this->payment_method) && isset($this->payment_method)){
            $this->params['query']['payment_method'] = $this->payment_method;
        }
        if(!empty($this->client_ip) && isset($this->client_ip)){
            $this->params['query']['client_ip'] = $this->client_ip;
        }
        if(!empty($this->order_info) && isset($this->order_info)){
            $this->params['query']['order_info'] = $this->order_info;
        }
         if(!empty($this->vendor_code) && isset($this->vendor_code)){
            $this->params['query']['vendor_code'] = $this->vendor_code;
        }

        $data = $BankTransactionService->getList($this->params);
        $this->pages = $data->meta->pages;


        set_time_limit(0);
        ini_set('memory_limit', '128M');
        $fileName = date('YmdHis', time());
        header('Content-Type: application/vnd.ms-execl');
        header('Content-Disposition: attachment;filename="' . $fileName . '.csv"');

        $handle = fopen("php://output", 'a');
        fputs($handle, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));


        for ($i=1; $i <=$this->pages ; $i++) {
            $this->params['pagination']['page'] = $i;
            $data = $BankTransactionService->getList($this->params);


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

                if($key == 0){
                    foreach($data as $title=>$content){
                        $this->tit[] = $title;
                    }
                    fputcsv($handle, $this->tit);
                }

                fputcsv($handle, $data);
            }

        }

        fclose($handle);
        ob_flush();
        flush();
        $end = microtime(true);

        // dd('11111111111111');
    }
}
