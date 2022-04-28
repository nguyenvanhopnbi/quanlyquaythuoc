<?php

namespace App\Http\Livewire\Gate\TransferInternalMoney;

use Livewire\Component;
use App\Connection\BillServiceConnection;

class TransferInternalMoney extends Component
{
    protected $listeners = [
        'SearchTransInternalMoney' => 'SearchTransInternalMoney'
    ];
    public function render()
    {
        $this->getListTransferInternalMoney();
        return view('livewire.gate.transfer-internal-money.transfer-internal-money', [
            'listTransferInternalMoney' => $this->listTransferInternalMoney
        ]);
    }

    public $transaction_id;
    public $ref_transaction_id;
    public $from_account_no;
    public $from_account_name;
    public $from_bank_code;
    public $to_account_no;
    public $to_account_name;
    public $to_bank_code;
    public $amount;
    public $status;
    public $startTimeSearch;
    public $endTimeSearch;

    public function SearchTransInternalMoney(
        $transaction_id,
        $ref_transaction_id,
        $from_account_no,
        $from_account_name,
        $from_bank_code,
        $to_account_no,
        $to_account_name,
        $to_bank_code,
        $amount,
        $status,
        $startTimeSearch,
        $endTimeSearch
    ){
        $this->transaction_id = $transaction_id;
        $this->ref_transaction_id = $ref_transaction_id;
        $this->from_account_no = $from_account_no;
        $this->from_account_name = $from_account_name;
        $this->from_bank_code = $from_bank_code;
        $this->to_account_no = $to_account_no;
        $this->to_account_name = $to_account_name;
        $this->to_bank_code = $to_bank_code;
        $this->amount = $amount;
        if($status != 'all'){
            $this->status = $status;
        }
        if(isset($startTimeSearch) and !empty($startTimeSearch)){
            $this->startTimeSearch = strtotime($startTimeSearch);
        }else{
            unset($this->startTimeSearch);
        }

        if(isset($endTimeSearch) and !empty($endTimeSearch)){
            $this->endTimeSearch = strtotime($endTimeSearch);
        }else{
            unset($this->endTimeSearch);
        }
    }


    protected $listTransferInternalMoney;
    public $currentPage;
    public $totalPage;
    public $start;
    public $end;
    public $part = 10;

    public $pageCurrent;

    public function getListTransferInternalMoney(){
        $params = [];
        $params['pagination']['page'] = $this->pageCurrent;

        if(isset($this->transaction_id)){
            $params['query']['transaction_id'] = $this->transaction_id;
        }
        if(isset($this->ref_transaction_id)){
            $params['query']['ref_transaction_id'] = $this->ref_transaction_id;
        }
        if(isset($this->from_account_no)){
            $params['query']['from_account_no'] = $this->from_account_no;
        }
        if(isset($this->from_account_name)){
            $params['query']['from_account_name'] = $this->from_account_name;
        }
        if(isset($this->from_bank_code)){
            $params['query']['from_bank_code'] = $this->from_bank_code;
        }
        if(isset($this->to_account_no)){
            $params['query']['to_account_no'] = $this->to_account_no;
        }
        if(isset($this->to_account_name)){
            $params['query']['to_account_name'] = $this->to_account_name;
        }
        if(isset($this->to_bank_code)){
            $params['query']['to_bank_code'] = $this->to_bank_code;
        }
        if(isset($this->amount)){
            $params['query']['amount'] = $this->amount;
        }
        if(isset($this->status)){
            $params['query']['status'] = $this->status;
        }
        if(isset($this->startTimeSearch)){
            $params['query']['startTime'] = $this->startTimeSearch;
        }
        if(isset($this->endTimeSearch)){
            $params['query']['endTime'] = $this->endTimeSearch;
        }

        $data = BillServiceConnection::getListTransferInternalMoney($params);
        if(isset($data->data)){
            $this->listTransferInternalMoney = $data->data;
        }

        if(isset($data->meta->page)){
            $this->currentPage = $data->meta->page;
        }
        if(isset($data->meta->pages)){
            $this->totalPage = $data->meta->pages;
        }

        $this->start = $this->currentPage - $this->part;
        if($this->start < 1){
            $this->start = 1;
        }
        $this->end = $this->currentPage + $this->part;
        if($this->end > $this->totalPage){
            $this->end = $this->totalPage;
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
