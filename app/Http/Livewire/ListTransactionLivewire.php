<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Services\Gate\BankTransactionService;
use App\Http\Controllers\Gate\ExportBankController;


class ListTransactionLivewire extends Component
{

    // details
    public $hidden_transactionid;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'findByTime', 'findByTime',
        'linkPage' => 'linkPage',
        'Previous' => 'Previous',
        'Next' => 'Next',
        'ExportCSV' => 'ExportCSV',
        'getIpnDetailsScript', 'getIpnDetails'
    ];

    public $transaction_id;
    public $order_id;
    public $partner_code;
    public $status;
    public $amount;
    public $bank_code;
    public $startTime;
    public $endTime;
    public $application_id;
    public $payment_method;
    public $client_ip;
    public $order_info;
    public $vendor_code;

    public $params = [];
    public $result = [];
    public $page;
    public $pages;
    public $limit;
    public $part = 10;
    public $start;
    public $end;

    public $dom = '';

    public function render()
    {
        $data = $this->loadview();
        $meta = $data->meta;
        $this->limit = get_object_vars($meta)['limit'];
        $this->page = get_object_vars($meta)['page'];
        $this->pages = get_object_vars($meta)['pages'];

        $this->start = $this->page - $this->part;
        if($this->start < 0){
            $this->start = $this->page;
        }
        $this->end = $this->page + $this->part;
        if($this->end > $this->pages){
            $this->end = $this->pages;
        }


        return view('livewire.list-transaction-livewire', [
            'data' => $data,
            'meta' => $meta,
            'start' => $this->start,
            'end' => $this->end,
            'dom' => $this->dom
        ]);
    }
    public function getIpnDetails($transaction_id){
        // dd($transaction_id);
        $this->dom = '<div>' . $transaction_id . '</div>';
    }

    public function Next($page){
        $pageNav = $page + 1;
        if($pageNav > $this->pages){
            $pageNav = $this->pages;
        }
        $this->params['pagination']['page'] = $pageNav;
    }
    public function Previous($page){
        $pageNav = $page - 1;
        if($pageNav < 1){
            $pageNav = 1;
        }
        $this->params['pagination']['page'] = $pageNav;
    }
    public function linkPage($page){
        // dump($page);

        $this->params['pagination']['page'] = $page;
    }
    public function findByTime($startTime, $endTime){
        $this->params['pagination']['page'] = 1;
        $this->params['query']['startTime'] = $startTime;
        $this->params['query']['endTime'] = $endTime;
    }
    public function loadview(){
        $BankTransactionService = new BankTransactionService();
        $this->params['query']['limit'] = 20;
        if(isset($this->transaction_id)){
            $this->params['query']['transaction_id'] = $this->transaction_id;
        }
        if(isset($this->order_id)){
            $this->params['query']['order_id'] = $this->order_id;
        }
        if(isset($this->partner_code)){
            $this->params['query']['partner_code'] = $this->partner_code;
        }

        if(isset($this->status)){
            $this->params['query']['status'] = $this->status;
        }
        if(isset($this->amount)){
            $this->params['query']['amount'] = $this->amount;
        }
        if(isset($this->bank_code)){
            $this->params['query']['bank_code'] = $this->bank_code;
        }
        if(isset($this->startTime)){
            $this->params['query']['startTime'] = $this->startTime;
        }
        if(isset($this->application_id)){
            $this->params['query']['application_id'] = $this->application_id;
        }
        if(isset($this->payment_method)){
            $this->params['query']['payment_method'] = $this->payment_method;
        }
        if(isset($this->client_ip)){
            $this->params['query']['client_ip'] = $this->client_ip;
        }
        if(isset($this->order_info)){
            $this->params['query']['order_info'] = $this->order_info;
        }
        if(isset($this->vendor_code)){
            $this->params['query']['vendor_code'] = $this->vendor_code;
        }

        // dd($params);
        $data = $BankTransactionService->getList($this->params);
        return $data;
    }

    // public $transaction_id;
    // public $order_id;
    // public $partner_code;
    // public $status;
    // public $amount;
    // public $bank_code;
    // public $startTime;
    // public $application_id;
    // public $payment_method;
    // public $client_ip;
    // public $order_info;
    // public $vendor_code;

    // public $params = [];
    // public $page;
    // public $pages;
    // public $limit;
    // public $part = 10;
    // public $start;
    // public $end;


    public function ExportCSV($transaction_id, $Amount, $status, $result, $vendor_code, $order_info, $client_ip, $payment_method, $partner_code, $bank_code, $application_id, $startTime, $endTime){

        if(isset($Amount)){
            $this->amount = $Amount;
        }
        if(isset($status)){
            $this->status = $status;
        }

        if(isset($result)){
            $this->result = $result;
        }
        if(isset($transaction_id)){
            $this->transaction_id = $transaction_id;
        }
        if(isset($startTime)){

            $this->startTime = $startTime;
        }
        if(isset($endTime)){
            $this->endTime = $endTime;
        }
        if(isset($partner_code)){
            $this->partner_code = $partner_code;
        }
        if(isset($bank_code)){
            $this->bank_code = $bank_code;
        }
        if(isset($application_id)){
            $this->application_id = $application_id;
        }
        if(isset($payment_method)){
            $this->payment_method = $payment_method;
        }
        if(isset($client_ip)){
            $this->client_ip = $client_ip;
        }
        if(isset($order_info)){
            $this->order_info = $order_info;
        }
        if(isset($vendor_code)){
            $this->vendor_code = $vendor_code;
        }
       return redirect()->action([ExportBankController::class, 'exportCSV'], [
        'Amount' => $this->amount,
        'transaction_id' => $this->transaction_id,
        'order_id' => $this->order_id,
        'status' => $this->status,
        'bank_code' => $this->bank_code,
        'partner_code' => $this->partner_code,
        'startTime' => $this->startTime,
        'endTime' => $this->endTime,
        'application_id' => $this->application_id,
        'payment_method' => $this->payment_method,
        'client_ip' => $this->client_ip,
        'vendor_code' => $this->vendor_code,
        'order_info' => $this->order_info,
        'result' => $this->result,
    ]);

    }



}
