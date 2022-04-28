<?php

namespace App\Http\Livewire\Gate\PartnerDocumentReport;

use Livewire\Component;
use App\Connection\partnerDocumentReportConnection;
use App\Connection\PartnerConnection;

class PartnerDocumentReport extends Component
{
    protected $listeners = [
        'searchPartnerDocumentReport' => 'searchPartnerDocumentReport',
        'savePartnerDocumentReport' => 'savePartnerDocumentReport',
        'deletePartnerDocumentReport' => 'deletePartnerDocumentReport',
        'UpdatePartnerDocumentReport' => 'UpdatePartnerDocumentReport'
    ];
    public function render()
    {
        $this->getList();
        $this->getPartnerCodeList();
        return view('livewire.gate.partner-document-report.partner-document-report');
    }

    public $listPartnerDocumentReport;
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

        if($data->meta->total){
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


    public function UpdatePartnerDocumentReport(
        $id,
        $partnerCode,
        $title,
        $detail,
        $point,
        $day,
        $sumDocument,
        $sumDocumentMiss
    ){
        $this->partnerDocumentID = $id;

        if(!$this->checkPartnerCode($partnerCode)){
            $this->warning = true;
            $this->message = "Partner Code: ".$partnerCode." is not existed !!!";
            return;
        }

        if($sumDocument < $sumDocumentMiss){
            $this->warning = true;
            $this->message = "Miss document can not be bigger than total sum document";
            return;
        }

        if(!is_numeric($point) || !is_numeric($sumDocument) || !is_numeric($sumDocumentMiss)){
            $this->warning = true;
            $this->message = "Field: Point, SumDocument, SumDocumentMiss must be numberic!!!";
            return;
        }

        $params["partner_code"] = $partnerCode;
        $params["title"] = $title;
        $params["detail"] = $detail;
        $params["point"] = $point;
        $params["sum_document"] = $sumDocument;
        $params["sum_document_miss"] = $sumDocumentMiss;
        $day = str_replace('00:00:00', '', $day);
        $params["day"] = strtotime($day. '00:00:00');

        $result = partnerDocumentReportConnection::edit($id, $params);
        if($result){
            $this->message = "Update successfully! PartnerCode: ".$partnerCode." Title: ".$title." Details: ".$detail." Point: ".$point." Sum Document: ".$sumDocument. " Sum Document Miss: ".$sumDocumentMiss. " Day: ".$day;

            $this->warning = false;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_DOCUMENT_REPORT, "Sửa Partner Document Report", compact('id', 'params')));

        }else{
            $this->warning = true;
            $this->message = "Something wrong! Please check your input data!";
        }
    }

    public function searchPartnerDocumentReport($partnerCode, $startTime, $endTime){
        $this->partnerCode = $partnerCode;

        if($startTime){
            $this->startTime = strtotime($startTime);
        }

        if($endTime){
            $this->endTime = strtotime($endTime);
        }
    }

    public function deletePartnerDocumentReport($id){
        $result = partnerDocumentReportConnection::delete($id);
        if($result){
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_DOCUMENT_REPORT, "Xoá Partner Document Report", compact('id')));
        }

    }

    public $warning = false;
    public $message;

    public function savePartnerDocumentReport($partnerCode, $title, $detail, $point, $sumDocument, $sumDocumentMiss, $day){
        if($sumDocument < $sumDocumentMiss){
            $this->warning = true;
            $this->message = "Miss document can not be bigger than total sum document";
            return;
        }

        if(!$this->checkPartnerCode($partnerCode)){
            $this->warning = true;
            $this->message = "Partner Code: ".$partnerCode." is not existed !!!";
            return;
        }

        if(!is_numeric($point) || !is_numeric($sumDocument) || !is_numeric($sumDocumentMiss)){
            $this->warning = true;
            $this->message = "Field: Point, SumDocument, SumDocumentMiss must be numberic!!!";
            return;
        }


        $params['partner_code'] = $partnerCode;
        $params['title'] = $title;
        $params['detail'] = $detail;
        $params['point'] = $point;
        $params['sum_document_miss'] = $sumDocumentMiss;
        $params['sum_document'] = $sumDocument;
        $params['day'] = strtotime($day . '00:00:00');

        $result = partnerDocumentReportConnection::add($params);
        if($result){
            $this->message = "Add new successfully! PartnerCode: ".$partnerCode." Title: ".$title." Details: ".$detail." Point: ".$point." Sum Document: ".$sumDocument. " Sum Document Miss: ".$sumDocumentMiss. " Day: ".$day;

            $this->warning = false;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_DOCUMENT_REPORT, "Thêm mới Partner Document Report", compact('params')));
        }else{
            $this->warning = true;
            $this->message = "Partner code exist! Please check your input data!";
        }
    }

    public function getList(){
        $this->listPartnerDocumentReport = '';
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

        $data = partnerDocumentReportConnection::getList($params);

        if(isset($data->data)){
            $this->listPartnerDocumentReport = $data->data;
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
}
