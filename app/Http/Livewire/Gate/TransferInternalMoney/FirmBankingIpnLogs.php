<?php

namespace App\Http\Livewire\Gate\TransferInternalMoney;

use Livewire\Component;
use App\Connection\BillServiceConnection;

class FirmBankingIpnLogs extends Component
{

    protected $listeners = [
        'search' => 'search'
    ];

    public function render()
    {
        $this->getList();
        return view('livewire.gate.transfer-internal-money.firm-banking-ipn-logs', [
            'listLogs' => $this->getList()
        ]);
    }

    public $currentPage;
    public $totalPage;
    public $start;
    public $end;
    public $part = 10;

    public $pageCurrent;


    public $idlog;
    public $startTime;
    public $endTime;
    public $transactionId;

    public function getList(){
        $params = [];
        if(isset($this->pageCurrent)){
            $params['pagination']['page'] = $this->pageCurrent;
        }
        if(isset($this->transactionId)){
            $params['query']['transactionId'] = $this->transactionId;
        }
        if(isset($this->idlog)){
            $params['query']['id'] = $this->idlog;
        }

        if(isset($this->startTime)){
            $params['query']['startTime'] = $this->startTime;
        }
        if(isset($this->endTime)){
            $params['query']['endTime'] = $this->endTime;
        }

        $data = BillServiceConnection::getListIpnLogs($params);

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

    public function gotoCurrentPage($page){
        if($page < 1){
            $page = 1;
        }
        if($page > $this->totalPage){
            $page = $this->totalPage;
        }

        $this->pageCurrent = $page;
    }

    public function search($logid, $logtransactionID, $startTimeSearch, $endTimeSearch){
        $this->idlog = $logid;
        $this->transactionId = $logtransactionID;
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
}
