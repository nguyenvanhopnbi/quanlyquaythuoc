<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Connection\BankTransactionConnection;
use App\Services\Gate\PartnerService;
use App\Connection\PartnerConnection;

class BankTransactionCrossCheck extends Component
{

    protected $listeners = [
        'Search' => 'Search',
        'exportTransactionCrossCheck' => 'exportTransactionCrossCheck'
    ];

    public function render()
    {
        $listPartner = $this->getPartner();
        if($listPartner == false){
            $listPartner = [];
        }

        return view('livewire.bank-transaction-cross-check', [
            'vaList' => $this->getList(),
            'partnerList' => $listPartner
        ]);
    }

    public $currentPage;
    public $totalPage;
    public $start;
    public $end;
    public $part = 10;

    public $pageCurrent;

    public $transaction_id;
    public $order_id;
    public $partner_code;
    public $va_transaction_id;
    public $va_transaction_status;
    public $start_time;
    public $end_time;

    public function getList(){
        $params = [];
        $params['pagination']['limit'] = 20;
        if(isset($this->pageCurrent)){
            $params['pagination']['page'] = $this->pageCurrent;
        }
        if(isset($this->transaction_id)){
            $params['query']['transaction_id'] = $this->transaction_id;
        }
        if(isset($this->order_id)){
            $params['query']['order_id'] = $this->order_id;
        }
        if(isset($this->partner_code)){
            $params['query']['partner_code'] = $this->partner_code;
        }
        if(isset($this->va_transaction_id)){
            $params['query']['va_transaction_id'] = $this->va_transaction_id;
        }
        if(isset($this->va_transaction_status)){
            $params['query']['va_transaction_status'] = $this->va_transaction_status;
        }

        if(isset($this->start_time)){
            $params['query']['start_time'] = $this->start_time;
        }
        if(isset($this->end_time)){
            $params['query']['end_time'] = $this->end_time;
        }

        $vaList = BankTransactionConnection::vaTransactionList($params);

        if(isset($vaList->meta->page)){
            $this->currentPage = $vaList->meta->page;
        }

        if(isset($vaList->meta->pages)){
            $this->totalPage = $vaList->meta->pages;
        }

        $this->start = $this->currentPage - $this->part;

        if($this->start < 1){
            $this->start = 1;
        }

        $this->end = $this->currentPage + $this->part;
        if($this->end > $this->totalPage){
            $this->end = $this->totalPage;
        }

        return $vaList;
    }

    // public function exportTransactionCrossCheck($transaction_id, $partner_code, $va_transaction_id, $va_transaction_status, $order_id, $start_time, $end_time){

    //     return redirect()->route('gate.transaction.export.cross.check', [
    //         'transaction_id'=>$transaction_id,
    //         'partner_code'=>$partner_code,
    //         'va_transaction_id'=>$va_transaction_id,
    //         'va_transaction_status'=>$va_transaction_status,
    //         'order_id'=>$order_id,
    //         'start_time'=>$start_time,
    //         'end_time'=>$end_time,
    //     ]);


    // }




    public function getPartner(){
        // $parner = new PartnerService();
        // return $parner->getAll();
        $params = [];
        $params['pagination']['limit'] = 10000;
        return PartnerConnection::getList($params);
    }

    public function Search($transaction_id, $partner_code, $va_transaction_id, $va_transaction_status, $order_id, $startTimeSearch, $endTimeSearch){

        $this->transaction_id = $transaction_id;
        $this->partner_code = $partner_code;
        $this->va_transaction_id = $va_transaction_id;
        $this->va_transaction_status = $va_transaction_status;
        $this->order_id = $order_id;
        if(isset($startTimeSearch) and !empty($startTimeSearch)){
            $this->start_time = strtotime($startTimeSearch);
        }else{
            unset($this->start_time);
        }
        if(isset($endTimeSearch) and !empty($endTimeSearch)){
            $this->end_time = strtotime($endTimeSearch);
        }else{
            unset($this->end_time);
        }

    }

    public function gotoCurrentPage($page){
        if($page < 1){
            $page = 1;
        }
        if($page > $this->totalPage){
            $page = $this->totalPage;
        }
        $this->pageCurrent = $page;
    }
}
