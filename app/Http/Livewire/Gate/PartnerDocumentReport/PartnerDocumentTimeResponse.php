<?php

namespace App\Http\Livewire\Gate\PartnerDocumentReport;

use Livewire\Component;
use App\Connection\partnerDocumentTimeResponseConnection;
use App\Connection\PartnerConnection;

class PartnerDocumentTimeResponse extends Component
{

    protected $listeners = [
        'searchPartnerDocumentTimeResponse' => 'searchPartnerDocumentTimeResponse',
        'savePartnerDocumentReport' => 'savePartnerDocumentReport',
        'deletePartnerDocumentTimeResponse' => 'deletePartnerDocumentTimeResponse',
        'UpdatePartnerDocumentTimeResponse' => 'UpdatePartnerDocumentTimeResponse'
    ];
    public function render()
    {
        $this->getPartnerCodeList();
        $this->getList();
        return view('livewire.gate.partner-document-report.partner-document-time-response');
    }

    public $listData;

    public $currentPage;
    public $totalPage;

    public $partnerCode;
    public $startTime;
    public $endTime;

    public $partnerCodeList;
    public $partnerDocumentID;

    public function getPartnerCodeList(){
        $params = [];
        $data = PartnerConnection::getList($params);

        if(isset($data->meta->total)){
            $params['pagination']['limit'] = $data->meta->total;
            $data = PartnerConnection::getList($params);
            $this->partnerCodeList = $data->data;
        }
        // dd($data);
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

    public function UpdatePartnerDocumentTimeResponse($id, $partner_code, $title, $point, $detail){
        if(!is_numeric($point)){
            $this->warning = true;
            $this->message = "Field: Point must be numberic!!!";
            return;
        }

        if(!$this->checkPartnerCode($partner_code)){
            $this->warning = true;
            $this->message = "Partner Code: ".$partner_code." is not existed !!!";
            return;
        }

        $params['partner_code'] = $partner_code;
        $params['title'] = $title;
        $params['detail'] = $detail;
        $params['point'] = $point;

        $result = partnerDocumentTimeResponseConnection::edit($id, $params);

        if($result){
            $this->message = "Update successfully! PartnerCode: ".$partner_code." Title: ".$title." Details: ".$detail." Point: ".$point;

            $this->warning = false;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_DOCUMENT_TIME_RESPONSE, "Sửa Partner Document Time Response", compact('id', 'params')));
        }else{
            $this->warning = true;
            $this->message = "Something wrong ! Please check your input data!";
        }

    }

    public function deletePartnerDocumentTimeResponse($id){
        $result = partnerDocumentTimeResponseConnection::delete($id);
        if($result){
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_DOCUMENT_TIME_RESPONSE, "Xoá Partner Document Time Response", compact('id')));
        }

    }

    public $warning = false;
    public $message;

    public function savePartnerDocumentReport($partnerCode, $title, $detail, $point){

        if(!is_numeric($point)){
            $this->warning = true;
            $this->message = "Field: Point must be numberic!!!";
            return;
        }

        if(!$this->checkPartnerCode($partnerCode)){
            $this->warning = true;
            $this->message = "Partner Code: ".$partnerCode." is not existed !!!";
            return;
        }

        $params['partner_code'] = $partnerCode;
        $params['title'] = $title;
        $params['detail'] = $detail;
        $params['point'] = $point;


        $result = partnerDocumentTimeResponseConnection::add($params);
        if($result){
            $this->message = "Add new successfully! PartnerCode: ".$partnerCode." Title: ".$title." Details: ".$detail." Point: ".$point;

            $this->warning = false;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_DOCUMENT_TIME_RESPONSE, "Thêm mới Partner Document Time Response", compact('params')));
        }else{
            $this->warning = true;
            $this->message = "Partner code: ".$partnerCode." exist! Please check your input data!";
        }
    }

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

        $data = partnerDocumentTimeResponseConnection::getList($params);
        // dd($data);
        if(isset($data->data)){
            $this->listData = $data->data;
        }


        if(isset($data->meta->page_current)){
            $this->currentPage = $data->meta->page_current;
        }
        if($data->meta->total_pages){
            $this->totalPage = $data->meta->total_pages;
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

    public function searchPartnerDocumentTimeResponse($partnerCode, $startTime, $endTime){
        $this->partnerCode = $partnerCode;

        if($startTime){
            $this->startTime = strtotime($startTime);
        }

        if($endTime){
            $this->endTime = strtotime($endTime);
        }
    }
}
