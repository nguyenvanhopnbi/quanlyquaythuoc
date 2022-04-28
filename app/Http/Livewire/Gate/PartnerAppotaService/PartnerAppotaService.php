<?php

namespace App\Http\Livewire\Gate\PartnerAppotaService;

use Livewire\Component;
use App\Connection\PartnerAppotaServiceConnection;
use App\Connection\PartnerConnection;
use App\Helpers\ArrayHelper;

class PartnerAppotaService extends Component
{

    protected $listeners = [
        'searchPartnerAppotaService' => 'searchPartnerAppotaService',
        'pushDetail' => 'pushDetail',
        'savePartnerAppotaService' => 'savePartnerAppotaService',
        'resetMessage' => 'resetMessage',
        'deletePartnerAppotaService' => 'deletePartnerAppotaService',
        'pushDataDetailUpdate' => 'pushDataDetailUpdate',
        'UpdatePartnerAppotaService' => 'UpdatePartnerAppotaService',
        'pushDetailUpdate' => 'pushDetailUpdate'
    ];

    public function render()
    {

        $this->getPartnerCodeList();
        // $this->checkPartnerCode('111');
        $this->getList();
        return view('livewire.gate.partner-appota-service.partner-appota-service');
    }

    public $dataPartnerAppotaService = [];
    public $currentPage;
    public $totalPage;

    public $pageCurrent;

    public $partnerCode;
    public $startTime;
    public $endTime;

    public function getList(){
        $params = [];
        $params['sort']['id'] = 'desc';
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
        $dataService = PartnerAppotaServiceConnection::getList($params);
        if(isset($dataService->data)){
            $this->dataPartnerAppotaService = $dataService->data;
        }

        if(isset($dataService->meta->page_current)){
            $this->currentPage = $dataService->meta->page_current;
        }
        if(isset($dataService->meta->total_pages)){
            $this->totalPage = $dataService->meta->total_pages;
        }
    }

    public $message;
    public $warming  = false;

    public $details = '';
    public $valueInputDetails = [];
    public function pushDetail($detail){
        $this->details = $this->details . $detail . '<br>';
        $this->valueInputDetails[] = $detail . '<br>';
    }

    public function resetMessage(){
        unset($this->message);
        unset($this->warming);
    }

    public function deletePartnerAppotaService($id){
        $result = PartnerAppotaServiceConnection::delete($id);
        if($result){
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_APPOTA_SERVICE, "Xoá Partner Appota Service", compact('id')));
        }
    }

    public function savePartnerAppotaService(
        $partner_code,
        $appota_service_code,
        $title,
        $detail,
        $point,
        $isActive
    ){

        if(!$this->checkPartnerCode($partner_code)){
            $this->message = "Partner Code: ". $partner_code. " is not existed";
            return;
        }

        if(!is_numeric($point)){
            $this->message = "Point must be numberic!";
            return;
        }

        $params['partner_code'] = $partner_code;
        $params['appota_service_code'] = $appota_service_code;
        $params['title'] = $title;
        if(empty($this->valueInputDetails)){
            $params['detail'] = $detail;
        }else{
            $params['detail'] = $this->details;
        }

        $params['point'] = $point;
        $params['is_active'] = ($isActive)?'1':'0';

        $result = PartnerAppotaServiceConnection::add($params);
        // dd($result);
        if($result){
            $this->message = "Add new successfully! Partner Code: ".$partner_code. " and Appota Service Code: ".$appota_service_code;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_APPOTA_SERVICE, "Thêm mới Partner Appota Service", compact('params')));
        }else{
            $this->message = "Partner Code: ".$partner_code. " and Appota Service Code: ".$appota_service_code. " may existed!";
            $this->warming = true;
        }

    }

    public $detailUpdate;
    public $idUpdate;
    public function pushDataDetailUpdate($detail, $id){
        $this->idUpdate = $id;
        $this->detailUpdate = $detail;
    }

    public function pushDetailUpdate($detail){
        $this->detailUpdate = $this->detailUpdate . $detail . '<br>';
        // dd($this->detailUpdate);
    }

    public function checkPartnerCode($partnerCode){

        $params = [];
        $data = PartnerConnection::getList($params);
        if(isset($data->meta->total)){
            $total = $data->meta->total;
            $params['pagination']['limit'] = $total;
            $data = PartnerConnection::getList($params);
        }
        // if(isset($data->data)){
        //     $this->partnerCodeList = $data->data;
        // }


        $partnerCodeArray = [];
        foreach($data->data as $list){
            $partnerCodeArray[] = $list->partner_code;
        }
        $partnerCoderAray = ArrayHelper::removeArrayNull($partnerCodeArray);
        // dd($partnerCoderAray);
        if(in_array($partnerCode, $partnerCoderAray)){
            return true;
        }
        return false;
    }

    public function UpdatePartnerAppotaService(
        $id,
        $partner_code,
        $appota_service_code,
        $title,
        $point,
        $isActiveValue,
        $details
    ){

        if(!$this->checkPartnerCode($partner_code)){
            $this->message = "Partner Code: ". $partner_code. " is not existed";
            return;
        }

        if(!is_numeric($point)){
            $this->message = "Point must be numberic!";
            return;
        }
        $params['partner_code'] = $partner_code;
        $params['appota_service_code'] = $appota_service_code;
        $params['title'] = $title;
        $params['detail'] = $details;
        $params['point'] = $point;
        $params['is_active'] = $isActiveValue;

        $isActiveMessage = ($isActiveValue == 1)?'active':'inactive';

        $result = PartnerAppotaServiceConnection::edit($id, $params);
        if($result){
            $this->message = "Update successfully! Partner Code: " .$partner_code. " and Appota Service Code: ".$appota_service_code . " and Title: " .$title . " and Details: ". $this->detailUpdate. " and Point: ".$point."<br> ".$isActiveMessage;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_APPOTA_SERVICE, "Sửa Partner Appota Service", compact('id','params')));
        }

    }

    public function removeDetails(){
        $this->detailUpdate = '';
        $this->details = '';
    }

    protected $queryString = [
        'partnerCode' => ['except' => ''],
        'startTime' => ['except' => ''],
        'endTime' => ['except' => '']
    ];

    public function searchPartnerAppotaService($partnerCode, $startTime, $endTime){
        if(isset($partnerCode) and !empty($partnerCode)){
            $this->partnerCode = $partnerCode;
        }else{
            $this->partnerCode = '';
        }
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

    public function gotoCurrentPage($page){
        if($page < 1){
            $page = 1;
        }
        if($page > $this->totalPage){
            $page = $this->totalPage;
        }
        $this->pageCurrent = $page;
    }

    public $partnerCodeList = [];

    public function getPartnerCodeList(){
        $params = [];
        $data = PartnerConnection::getList($params);
        if(isset($data->meta->total)){
            $total = $data->meta->total;
            $params['pagination']['limit'] = $total;
            $data = PartnerConnection::getList($params);
        }
        if(isset($data->data)){
            $this->partnerCodeList = $data->data;
        }

    }
}
