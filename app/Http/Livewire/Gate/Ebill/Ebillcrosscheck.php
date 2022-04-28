<?php

namespace App\Http\Livewire\Gate\Ebill;

use Livewire\Component;
use App\Connection\EbillConnection;
use App\Connection\PartnerConnection;

class Ebillcrosscheck extends Component
{
    public $idUpdate;
    public $currentPage;
    public $totalPage;
    public $start;
    public $end;
    public $part = 10;

    public $pageCurrent;
    public $partnerCode;
    public $startTime;
    public $endTime;
    public $schedule_code;

    protected $listeners = [
        'searchEbillCrossCheck' => 'searchEbillCrossCheck',
        'saveNewEbillCrossCheck' => 'saveNewEbillCrossCheck',
        'resetMessage' => 'resetMessage',
        'EditEbillCrossCheck' => 'EditEbillCrossCheck',
        'deleteEbillCrossCheck' => 'deleteEbillCrossCheck'
    ];

    public function render()
    {
        return view('livewire.gate.ebill.ebillcrosscheck', [
            'listData' => $this->getList(),
            'listPartnerCode' => $this->getListPartner()
        ]);
    }

    public function getListPartner(){
        $params = [];
        $params['pagination']['limit'] = 10000;
        $partnerCodeList = PartnerConnection::getList($params);
        return $partnerCodeList;
    }

    public function deleteEbillCrossCheck($id){
        $params = [];
        $params['id'] = $id;
        $result = EbillConnection::DeleteReconciliationSchedule($params);
        if(isset($result->success) and $result->success){
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::EBILL_CROSS_CHECK, "Xóa đối soát Ebill reconciliation schedule, id: ". $id , compact('params')));
        }

    }

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
            $params['filter']['startTime'] = $this->startTime;
        }
        if(isset($this->endTime)){
            $params['filter']['endTime'] = $this->endTime;
        }

        if(isset($this->schedule_code)){
            $params['filter']['schedule_code'] = $this->schedule_code;
        }

        $listData = EbillConnection::getListReconciliationSchedule($params);

        if(isset($listData->data)){
            foreach($listData->data as $data){
                if($data->schedule_code == 'every_day'){
                    $data->schedule_code_display = ' Every Day';
                }
                if($data->schedule_code == 'every_three_day'){
                    $data->schedule_code_display = ' Every Three Day';
                }
                if($data->schedule_code == 'every_week'){
                    $data->schedule_code_display = ' Every Week';
                }
                if($data->schedule_code == 'every_month'){
                    $data->schedule_code_display = ' Every Month';
                }
            }
        }

        if(isset($listData->meta->page_current)){
            $this->currentPage = $listData->meta->page_current;
        }
        if(isset($listData->meta->total_pages)){
            $this->totalPage = $listData->meta->total_pages;
        }

        $this->start = $this->currentPage - $this->part;
        if($this->start < 1){
            $this->start = 1;
        }
        $this->end = $this->currentPage + $this->part;
        if($this->end > $this->totalPage){
            $this->end = $this->totalPage;
        }


        return $listData;
    }

    public function EditEbillCrossCheck($id, $cheduleCode, $partnerCode){
        $params = [];
        $params['partner_code'] = $partnerCode;
        $params['schedule_code'] = $cheduleCode;
        $params['id'] = $id;
        $result = EbillConnection::UpdateReconciliationSchedule($params);
        if(!$result){
            return false;
        }
        if(isset($result->success) and $result->success){
            $this->message = 'Bạn đã update thành công';
            $this->warning = false;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::EBILL_CROSS_CHECK, "Sửa đối soát Ebill reconciliation schedule, params: ". json_encode($params) , compact('params')));
        }else{
            $this->message = 'Bạn đã update thất bại';
            $this->warning = true;
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

    public function searchEbillCrossCheck($partnerCode , $scheduleSearch, $startTime, $endTime){
        $this->partnerCode = $partnerCode;
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

        $this->schedule_code = $scheduleSearch;
    }

    public $message;
    public $warning = false;

    public function saveNewEbillCrossCheck($partnerCode, $scheduleCode){
        $params = [];
        $params['partner_code'] = $partnerCode;
        $params['schedule_code'] = $scheduleCode;

        $result = EbillConnection::AddNewReconciliationSchedule($params);
        if(!$result){
            return false;
        }
        if(isset($result->success) and $result->success){
            $this->message = 'Bạn đã thêm mới thành công';
            $this->warning = false;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::EBILL_CROSS_CHECK, "Thêm đối soát Ebill reconciliation schedule, params: ". json_encode($params) , compact('params')));
        }else{
            $this->message = 'Bạn đã thêm mới thất bại';
            $this->warning = true;
        }
    }

    public function resetMessage(){
        unset($this->message);
        unset($this->warning);
    }
}
