<?php

namespace App\Http\Livewire\Gate\PartnerCooperate;

use Livewire\Component;
use App\Connection\partnerCooperateConnection;
use App\Connection\PartnerConnection;

class PartnerCooperate extends Component
{
    protected $listeners = [
        'searchPartnerCooperate' => 'searchPartnerCooperate',
        'savePartnerCooperate' => 'savePartnerCooperate',
        'resetMessage' => 'resetMessage',
        'deletePartnerCooperate' => 'deletePartnerCooperate',
        'UpdatePartnerCooperate' => 'UpdatePartnerCooperate'
    ];
    public function render()
    {
        $this->getList();
        $this->getPartnerCodeList();
        return view('livewire.gate.partner-cooperate.partner-cooperate');
    }

    public $partnerCooperate;
    public $currentPage;
    public $totalPage;

    public $pageCurrent;

    public $partnerCopperateID;
    public $partnerCodeList;

    public $partnerCodeSearch;
    public $startTime;
    public $endTime;

    public function getPartnerCodeList(){
        $params = [];
        $data = PartnerConnection::getList($params);

        if($data->meta->total){
            $params['pagination']['limit'] = $data->meta->total;
            $data = PartnerConnection::getList($params);
            $this->partnerCodeList = $data->data;
        }
        // dd($data);
    }

    public function deletePartnerCooperate($id){
         $result = partnerCooperateConnection::delete($id);
         if($result){
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_COOPERATE, "Xoá Partner Cooperate", compact('id')));
         }
    }

    public function UpdatePartnerCooperate($id, $partner_code, $title, $detail, $point){
        $this->partnerCopperateID = $id;

        if(!$this->checkPartnerCode($partner_code)){
            $this->message = "Partner Code: ".$partner_code." is not existed.";
            return;
        }

        if(!is_numeric($point)){
            $this->message = "Point must be numberic!";
            return;
        }

        $params['partner_code'] = $partner_code;
        $params['title'] = $title;
        $params['detail'] = $detail;
        $params['point'] = $point;

        $result = partnerCooperateConnection::edit($id, $params);
        if($result){
            $this->message = "Update successfully! PartnerCode: ". $partner_code . " and Title: ".$title. " and Details: ".$detail. " and Point: " .$point ;

            $this->warning = false;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_COOPERATE, "Sửa Partner Cooperate", compact('id', 'params')));
        }else{
            $this->message = "Maybe PartnerCode exist! Please check your input data or contact DEV!";
            $this->warning = true;
        }

    }

    public $message;
    public $warning  = true;

    public function savePartnerCooperate($partner_code, $title, $detail, $point){

        if(!$this->checkPartnerCode($partner_code)){
            $this->message = "Partner Code: ".$partner_code." is not existed.";
            return;
        }

        if(!is_numeric($point)){
            $this->message = "Point must be numberic!";
            return;
        }

        $params['partner_code'] = $partner_code;
        $params['title'] = $title;
        $params['detail'] = $detail;
        $params['point'] = $point;

        $result = partnerCooperateConnection::add($params);

        if($result){
            $this->message = "Add successfully! PartnerCode: ".$partner_code . " and Title: ".$title. " and Details: ". $detail. " and Point: ".$point;
            $this->warning = false;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_COOPERATE, "Thêm mới Partner Cooperate", compact('params')));
        }else{
            $this->message = "Maybe PartnerCode exist! Please check your input data or contact DEV!";
            $this->warning = true;
        }
    }

    public function resetMessage(){
        unset($this->message);
        unset($this->warning);
    }

    public function checkPartnerCode($partnerCode){
        $params = [];
        $data = PartnerConnection::getList($params);
        $list = [];
        if($data->meta->total){
            $params['pagination']['limit'] = $data->meta->total;
            $data = PartnerConnection::getList($params);
            if(isset($data->data)){
                foreach($data->data as $data){
                    $list[] = $data->partner_code;
                }
                if(in_array($partnerCode, $list)){
                    return true;
                }
            }
        }
        return false;
    }

    protected $queryString = [
        'partnerCodeSearch' => ['except' => ''],
        'startTime' => ['except' => ''],
        'endTime' => ['except' => '']
    ];

    public function searchPartnerCooperate($partnerCode, $startTime, $endTime){
        $this->partnerCodeSearch = $partnerCode;
        if(isset($startTime) && !empty($startTime)){
            $this->startTime = strtotime($startTime);
        }else{
            $this->startTime = '';
        }
        if(isset($endTime) && !empty($endTime)){
            $this->endTime = strtotime($endTime);
        }else{
            $this->endTime = '';
        }

    }

    public function getList(){
        $params = [];
        $params['pagination'] ['limit'] = 20;
        $params['sort']['id'] = 'desc';
        if(isset($this->partnerCodeSearch)){
            $params['filter']['partner_code'] = $this->partnerCodeSearch;
        }

        if(isset($this->startTime)){
            $params['filter']['start_time'] = $this->startTime;
        }

        if(isset($this->endTime)){
            $params['filter']['end_time'] = $this->endTime;
        }

        $data = partnerCooperateConnection::getList($params);
        if(isset($data->data)){
            $this->partnerCooperate = $data->data;
        }
        if(isset($data->meta->page_current)){
            $this->currentPage = $data->meta->page_current;
        }
        if(isset($data->meta->total_pages)){
            $this->totalPage = $data->meta->total_pages;
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
