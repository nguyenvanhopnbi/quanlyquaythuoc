<?php

namespace App\Http\Livewire\Gate\PartnerBusiness;

use Livewire\Component;
use App\Connection\partnerBusinessConnection;
use App\Connection\PartnerConnection;
use App\Helpers\ArrayHelper;

class PartnerBusiness extends Component
{

    protected $listeners = [
        'searchPartnerBusiness' => 'searchPartnerBusiness',
        'savePartnerBusiness' => 'savePartnerBusiness',
        'setID' => 'setID',
        'UpdatePartnerBusiness' => 'UpdatePartnerBusiness',
        'deletePartnerBusiness' => 'deletePartnerBusiness'
    ];

    public $partnerCodeList;
    public function render()
    {
        $this->getList();
        $this->getListPartnerCode();
        // $this->checkPartnerCode('11');
        return view('livewire.gate.partner-business.partner-business');
    }

    public $listPartnerBusiness;
    public $currentPage;
    public $totalPage;

    public $pageCurrent;

    public $partnerCode;
    public $startTime;
    public $endTime;

    public $message;
    public $warning = false;

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



        $data = partnerBusinessConnection::getList($params);
        if(isset($data->data)){
            $this->listPartnerBusiness = $data->data;
        }
        if(isset($data->meta->page_current)){
            $this->currentPage = $data->meta->page_current;
        }
        if(isset($data->meta->total_pages)){
            $this->totalPage = $data->meta->total_pages;
        }

    }

    public function getListPartnerCode(){
        $params = [];
        $data = PartnerConnection::getList($params);
        if(isset($data->meta->total)){
            $params['pagination']['limit'] = $data->meta->total;
            $data = PartnerConnection::getList($params)->data;
            $this->partnerCodeList = $data;
            // dd($this->partnerCodeList);
        }
    }

    public $partnerBusinessID;
    public function setID($id){
        // dd($id);
        $this->partnerBusinessID = $id;
    }

    // public $partnerCodeListfull = [];
    public function checkPartnerCode($partner_code){
        $params = [];
        $partnerCodeListfull = [];
        $data = PartnerConnection::getList($params);
        if(isset($data->meta->total)){
            $params['pagination']['limit'] = $data->meta->total;
            $data = PartnerConnection::getList($params);
            if(isset($data->data)){
                foreach($data->data as $data){
                    $partnerCodeListfull[] = $data->partner_code;
                }
                $partnerCodeListfull = ArrayHelper::removeArrayNull($partnerCodeListfull);
                if(in_array($partner_code, $partnerCodeListfull)){
                    return true;
                }
            }
        }
        return false;

    }
    public function resetMessage(){
        unset($this->message);
        unset($this->warning);
    }

    public function deletePartnerBusiness($id){
        $result = partnerBusinessConnection::delete($id);
        if($result){
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_BUSINESS, "Xoá Partner Business", compact('id')));
        }
    }

    public function UpdatePartnerBusiness(
        $id,
        $partner_code,
        $title,
        $detail,
        $point
    ){

        if(!$this->checkPartnerCode($partner_code)){
            $this->message = "Partner Code: ".$partner_code." is not existed!";
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

        $result = partnerBusinessConnection::edit($id, $params);
        if($result){
            $this->message = "Update successfully! Partner Code: " . $partner_code. " and Title: ".$title. " and Details: ".$detail ." and Point: ".$point;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_BUSINESS, "Sửa Partner Business", compact('id', 'params')));
        }else{
            $this->message = "Please check your input data and contact dev!";
            $this->warning = true;
        }
    }

    public function savePartnerBusiness(
        $partner_code,
        $title,
        $details,
        $point
    ){

        if(!$this->checkPartnerCode($partner_code)){
            $this->message = "Partner Code: ".$partner_code." is not existed!";
            return;
        }

        if(!is_numeric($point)){
            $this->message = "Point must be numberic!";
            return;
        }

        $params['partner_code'] = $partner_code;
        $params['title'] = $title;
        $params['detail'] = $details;
        $params['point'] = $point;

        $result = partnerBusinessConnection::add($params);

        if($result){
            $this->message = "Add successfully! Partner Code: " . $partner_code. " and Title: ".$title. " and Details: ".$details ." and Point: ".$point;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_BUSINESS, "Thêm mới Partner Business", compact('params')));
        }else{
             $this->message = "Please check your input data and contact dev!";
            $this->warning = true;
        }

        // dd($partner_code . '-'. $title. '-'. $details. '-'.$point);
    }

    protected $queryString = [
        'partnerCode' => ['except' => ''],
        'startTime' => ['except' => ''],
        'endTime' => ['except' => '']
    ];

    public function searchPartnerBusiness($partnerCode, $startTime, $endTime){
        $this->partnerCode = $partnerCode;

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
