<?php

namespace App\Http\Livewire\Gate;

use Livewire\Component;
use App\Connection\DoubleCheckConnection;
use App\Connection\PartnerConnection;
use Illuminate\Support\Collection;

class DoubleCheck extends Component
{
    protected $listeners = [
        'searchDoubleCheck' => 'searchDoubleCheck',
        'confirmDoubleCheck' => 'confirmDoubleCheck',
        'NoconfirmDoubleCheck' => 'NoconfirmDoubleCheck'
    ];
    protected $transactionList;
    protected $partnerCodeList;

    public function render()
    {
        $this->getList();
        $this->getPartnerCode();
        return view('livewire.gate.double-check', [
            'transactionList' => $this->transactionList,
            'partnerCodeList' => $this->partnerCodeList
        ]);
    }

    public $currentPage;
    public $totalPage;
    public $part = 10;
    public $start;
    public $end;

    public $partnerCode;
    public $status;
    public $startTime;
    public $endTime;

    public $message;
    public $warning = false;

    public function getList(){
        $params = [];
        $params['pagination']['limit'] = 20;
        $params['pagination']['page'] = $this->pageCurrent;

        if(isset($this->partnerCode)){
            $params['filter']['partner_code'] = $this->partnerCode;
        }
        if(isset($this->status)){
            $params['filter']['status'] = $this->status;
        }
        if(isset($this->startTime)){
            $params['filter']['startTime'] = $this->startTime;
        }
        if(isset($this->endTime)){
            $params['filter']['endTime'] = $this->endTime;
        }


        $data = DoubleCheckConnection::getList($params);
        if(isset($data->data)){
            $this->transactionList = $data->data;
            foreach($this->transactionList as $list){
                $j = json_decode($list->logs);
                $json = Collection::make($j)->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                $list->logs = $json;
                // dd($list->logs);
            }
        }
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

    }

    public function NoconfirmDoubleCheck($id, $reason){
        $params['reason'] = $reason;
        $params['id'] = $id;

        $result = DoubleCheckConnection::Noconfirm($params);
        if(!$result){
            session()->flash('messageNotConfirm', 'Tr???ng th??i giao d???ch ph???i ??? tr???ng th??i pending');
            // $this->message = 'Status must be pending!';
            $this->warning = true;
        }else{
            session()->flash('messageNotConfirm', 'Confirm th??nh c??ng!');
            // $this->message = 'Status must be pending!';
            $this->warning = false;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_DOUBLE_CHECK, "T??? ch???i ?????i so??t th??nh c??ng", compact('id', 'params')));

            return;
        }
    }

    public function confirmDoubleCheck($id){
        $result = DoubleCheckConnection::confirm($id);
        if(!$result){
            session()->flash('message', 'Ch??? ???????c confirm khi tr???ng th??i giao d???ch l?? pending!');
            $this->warning = true;
            return;
        }else{
            session()->flash('message', 'Confirm th??nh c??ng!');
            $this->warning = false;
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_DOUBLE_CHECK, "X??c nh???n ?????i so??t th??nh c??ng", compact('id')));

            return;
        }
    }


    public function searchDoubleCheck($partnerCode, $status, $startTime, $endTime){
        $this->partnerCode = $partnerCode;
        $this->status = $status;
        if(isset($startTime) && !empty($startTime)){
            $this->startTime = $startTime;
        }else{
             unset($this->startTime);
        }

        if(isset($endTime) && !empty($endTime)){
            $this->endTime = $endTime;
        }else{
            unset($this->endTime);
        }
    }

    public $pageCurrent;
    public function gotoCurrentPage($page){
        if($page < 1){
            $page = 1;
        }
        if($page > $this->totalPage){
            $page = $this->totalPage;
        }
        $this->pageCurrent = $page;
    }

    public function getPartnerCode(){
        $params = [];
        $params['pagination']['limit'] = 20;
        $data = PartnerConnection::getList($params);
        if(isset($data->data)){
            $this->partnerCodeList = $data->data;

        }

    }
}
