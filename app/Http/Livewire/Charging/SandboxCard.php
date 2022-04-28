<?php

namespace App\Http\Livewire\Charging;

use Livewire\Component;
use App\Connection\ChargingConnection;
use App\Connection\PartnerConnection;

class SandboxCard extends Component
{

    protected $listeners = [
        'search' => 'search'
    ];

    public function render()
    {
        // $this->sandbox();
        return view('livewire.charging.sandbox-card', [
            'listSandBox' => $this->sandbox(),
            'dataListPartner' => $this->getPartnerCode()
        ]);
    }

    public function getPartnerCode(){
        $params = [];
        $params['pagination']['limit'] = 10000;
        $dataListPartner = PartnerConnection::getList($params);
        if(isset($dataListPartner->data)){
            return $dataListPartner->data;
        }
    }

    public $currentPage;
    public $totalPage;
    public $start;
    public $end;
    public $part = 10;

    public $pageCurrent;


    public $transaction_id;
    public $partner_transaction_id;
    public $partner_code;
    public $amount;
    public $status;
    public $code;
    public $serial;
    public $startTime;
    public $endTime;

    public function sandbox(){
        $params = [];
        $params['pagination']['limit'] = 10;

        if(isset($this->transaction_id)){
            $params['query']['transaction_id'] = $this->transaction_id;
        }

        if(isset($this->partner_transaction_id)){
            $params['query']['partner_transaction_id'] = $this->partner_transaction_id;
        }

        if(isset($this->partner_code)){
            $params['query']['partner_code'] = $this->partner_code;
        }

        if(isset($this->amount)){
            $params['query']['amount'] = $this->amount;
        }

        if(isset($this->status)){
            $params['query']['status'] = $this->status;
        }

        if(isset($this->code)){
            $params['query']['code'] = $this->code;
        }

        if(isset($this->serial)){
            $params['query']['serial'] = $this->serial;
        }

        if(isset($this->startTime)){
            $params['query']['startTime'] = $this->startTime;
        }

        if(isset($this->endTime)){
            $params['query']['endTime'] = $this->endTime;
        }

        if(isset($this->pageCurrent)){
            $params['pagination']['page'] = $this->pageCurrent;
        }

        $data = ChargingConnection::getListSandbox($params);

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

        if(isset($data->data)){
            return $data->data;
        }
    }

    public function search($transactionID, $partnerTransID, $partnerCode, $amount, $status, $cardcode, $cardSerial, $startTimeSearch, $endTimeSearch){
        $this->transaction_id = $transactionID;
        $this->partner_transaction_id = $partnerTransID;
        $this->partner_code = $partnerCode;
        $this->amount = $amount;
        $this->status = $status;
        $this->code = $cardcode;
        $this->serial = $cardSerial;

        if(isset($startTimeSearch) and !empty($startTimeSearch)){
            $this->startTime = strtotime($startTimeSearch);
        }else{
            unset($this->startTime);
        }

        if(isset($endTimeSearch) and !empty($endTimeSearch)){
            $this->endTime = strtotime($endTimeSearch);
        }else{
            unset($this->endTime);
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
