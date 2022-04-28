<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Connection\PaypalConnection;
use App\Connection\PartnerConnection;

class Paypal extends Component
{
    protected $listeners = [
        'ViewDataDetail' => 'ViewDataDetail',
        'ViewDataLogsDetails' => 'ViewDataLogsDetails',
        'search' => 'search'
    ];
    public function render()
    {
        // dd($this->getList());
        return view('livewire.paypal', [
            'listPaypal' => $this->getList(),
            'listPartnerCode' => $this->getPartnerCode()
        ]);
    }

    public $pageCurrent  = 1;

    public $currentPage;
    public $totalPage;
    public $start;
    public $end;
    public $part = 10;

    public $partnerCode;
    public $status;
    public $startTime;
    public $endTime;

    public function getList(){
        $params = [];
        $params['pagination']['limit'] = 20;
        $params['pagination']['page'] = $this->pageCurrent;
        $params['filter']['status'] = 'pending';
        $params['filter']['startTime'] = 1;
        $params['filter']['endTime'] = 999999999999;

        if(isset($this->partnerCode)){
            $params['filter']['partner_code'] = $this->partnerCode;
        }

        if(isset($this->status) and !empty($this->status)){
            $params['filter']['status'] = $this->status;
        }

        if(isset($this->startTime)){
            $params['filter']['startTime'] = $this->startTime;
        }

        if(isset($this->endTime)){
            $params['filter']['endTime'] = $this->endTime;
        }

        $data = PaypalConnection::getList($params);
        // dd($data);
        if(isset($data->meta->page_current)){
            $this->currentPage = $data->meta->page_current;
        }
        if(isset($data->meta->total_pages)){
            $this->totalPage = $data->meta->total_pages;
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

    public function getPartnerCode(){
        $params = [];
        $params['pagination']['limit'] = 1000000;
        $data = PartnerConnection::getList($params);
        if(isset($data->data)){
            return $data->data;
        }
    }

    public function search($partnerCode, $status, $startTime, $endTime){
        $this->partnerCode = $partnerCode;
        $this->status = $status;
        if(isset($startTime) and !empty($startTime)){
            $this->startTime = strtotime($startTime);
        }else{
            unset($this->startTime);
        }

        if(isset($endTime) and !empty($endTime)){
            $this->endTime = strtotime($endTime);
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

    public $detailsPaypalRegister;
    public $LogPaypal;

    public function ViewDataDetail($id){
        $params = [];
        $params['id'] = $id;
        $data = PaypalConnection::getListDetails($params);
        if(isset($data->data_detail)){
            $data->data_detail = json_decode($data->data_detail);
            $data->data_detail = json_encode($data->data_detail, JSON_PRETTY_PRINT);
            $this->detailsPaypalRegister = $data->data_detail;
        }
    }

    public function ViewDataLogsDetails($id){
        $params = [];
        $params['id'] = $id;
        $data = PaypalConnection::getListDetails($params);
        if(isset($data->logs_paypal)){
            $data->logs_paypal = json_decode($data->logs_paypal);
            $data->logs_paypal = json_encode($data->logs_paypal, JSON_PRETTY_PRINT);
            $this->LogPaypal = $data->logs_paypal;
        }
    }
}
