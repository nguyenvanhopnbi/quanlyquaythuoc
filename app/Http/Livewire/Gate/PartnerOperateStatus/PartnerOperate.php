<?php

namespace App\Http\Livewire\Gate\PartnerOperateStatus;

use Livewire\Component;
use App\Connection\PartnerConnection;
use App\Connection\partnerOperateStatusConnection;


class PartnerOperate extends Component
{

    // protected $queryString = ['search'];

    protected $listeners = [
        'searchPartnerOperate' => 'searchPartnerOperate',
        'savePartnerOperateStatus' => 'savePartnerOperateStatus',
        'deletePartnerOperateStatus' => 'deletePartnerOperateStatus',
        'UpdatePartnerOperateStatus' => 'UpdatePartnerOperateStatus'
    ];

    public function render()
    {
        $this->getPartnerCodeList();

        $this->getList();

        return view('livewire.gate.partner-operate-status.partner-operate');
    }

    protected $queryString = [
        'partnerCode' => ['except' => ''],
        'startTime' => ['except' => ''],
        'endTime' => ['except' => '']
    ];

    public $listPartnerOperate;
    public $currentPage;
    public $totalPage;

    public $partnerCode;

    public $startTime;
    public $endTime;

    public $IDPartnerCo;

    public function getList(){
        $params = [];
        $params['sort']['id'] = 'desc';
        $params['pagination']['limit'] = 20;

        if(isset($this->pageCurrent)){
            $params['pagination']['page'] = $this->pageCurrent;
        }

        if(isset($this->partnerCode)){
            $params['filter']['partner_code'] = $this->partnerCode;
        }

        if(isset($this->startTime)){
            $params['filter']['start_time'] = $this->startTime;
        }

        if(isset($this->endTime)){
            $params['filter']['end_time'] = $this->endTime;
        }

        $data = partnerOperateStatusConnection::getList($params);

        if(isset($data->data)){
            $this->listPartnerOperate = $data->data;
        }
        if($data->meta->page_current){
            $this->currentPage = $data->meta->page_current;
        }

        if($data->meta->total_pages){
            $this->totalPage = $data->meta->total_pages;
        }

    }

    public function UpdatePartnerOperateStatus($id, $PartnerCode, $Title, $detail, $point){
        $this->IDPartnerCo = $id;
        if(!$this->checkPartnerCode($PartnerCode)){
            $this->message = "PartnerCode: ".$PartnerCode. " is not existed!";
            $this->warning = true;
            return;
        }

        if(!is_numeric($point)){
            $this->message = "Point must be numberic!";
            return;
        }

        $params['partner_code'] = $PartnerCode;
        $params['title'] = $Title;

        $params['detail'] = $detail;
        $params['point'] = $point;

        $result = partnerOperateStatusConnection::edit($id, $params);
        if($result){
            $this->message = "Update successfully! PartnerCode: ". $PartnerCode." and Title: ".$Title. " Details: ".$detail." and Point: ".$point;
            $this->warning = false;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_OPERATE_STATUS, "Sửa Partner Operate Status", compact('id', 'params')));

        }else{
            $this->message = $result. "Partner Code mus be unique! Please check your input data or contact dev!";
            $this->warning = true;
        }

    }

    public function deletePartnerOperateStatus($id){
        $result = partnerOperateStatusConnection::delete($id);
        if($result){
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_OPERATE_STATUS, "Xoá Partner Operate Status", compact('id')));
        }
    }

    public $message;
    public $warning  = false;

    public function savePartnerOperateStatus($partner_code, $title, $detail, $point){

        if(!$this->checkPartnerCode($partner_code)){
            $this->message = "PartnerCode: ".$partner_code. " is not existed!";
            $this->warning = true;
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

        $result = partnerOperateStatusConnection::add($params);
        // dd($result);
        if($result){
            $this->message = "Add successfully! PartnerCode: ". $partner_code." and Title: ".$title. " Details: ".$detail." and Point: ".$point;
            $this->warning = false;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_OPERATE_STATUS, "Thêm mới Partner Operate Status", compact('params')));

        }else{
            $this->message = $result. "Partner Code mus be unique! Please check your input data or contact dev!";
            $this->warning = true;
        }
    }

    public function searchPartnerOperate($partnerCode, $startTime, $endTime){

        $this->partnerCode = $partnerCode;
        if(isset($startTime) and !empty($startTime)){
            $this->startTime = strtotime($startTime);
        }else{
            $this->startTime = '';
        }
        if(isset($endTime) and !empty($endTime)){
            $this->endTime = strtotime($endTime);
        }else{
            $this->endTime = '';
        }
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

    public $pageCurrent;
    public function gotoCurrentpage($page){
        if($page < 1){
            $page = 1;
        }
        if($page > $this->totalPage){
            $page = $this->totalPage;
        }

        $this->pageCurrent = $page;
    }

    public $partnerCodeList;

    public function getPartnerCodeList()
    {
        $params = [];
        $data = PartnerConnection::getList($params);
        if(isset($data->meta->total)){
            $params['pagination']['limit'] = $data->meta->total;
            $data = PartnerConnection::getList($params);
            if(isset($data->data)){
                $this->partnerCodeList = $data->data;
            }
        }
        // dd($data);
    }
}
