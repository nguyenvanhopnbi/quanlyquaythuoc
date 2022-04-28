<?php

namespace App\Http\Livewire\Gate\Ebill;

use Livewire\Component;
use App\Connection\EbillConnection;
use App\Connection\PartnerConnection;

class EbillVAFeeConfig extends Component
{

    protected $listeners = [
        'searchEbillConfigFeeVA' => 'searchEbillConfigFeeVA',
        'saveNewEbillConfigVAFee' => 'saveNewEbillConfigVAFee',
        'EditEbillVAConfigFee' => 'EditEbillVAConfigFee',
        'resetMessage' => 'resetMessage',
        'deleteEbillConfigFeeVA' => 'deleteEbillConfigFeeVA'
    ];

    public function render()
    {
        return view('livewire.gate.ebill.ebill-v-a-fee-config', [
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

    public $currentPage;
    public $totalPage;
    public $part = 10;
    public $start;
    public $end;

    public $pageCurrent;
    public $partnerCode;
    public $startTime;
    public $endTime;

    public $message;
    public $warning;

    public function resetMessage(){
        unset($this->message);
        unset($this->warning);
    }

    public function deleteEbillConfigFeeVA($id){

        $params['id'] = $id;
        $result = EbillConnection::deleteFeeConfigVA($params);
        if(!$result){
            $this->message = 'Không thể xóa, kiểm tra lại api.';
            $this->warning = false;
            return false;
        }
        if(isset($result->success) and $result->success){
            $this->message = 'Bạn đã xóa thành công';
            $this->warning = false;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::EBILL_CROSS_CHECK, "Xóa cấu hình fee VA thành công, params: ". json_encode($params) , compact('params')));
        }else{
            $this->message = 'Bạn đã xóa thất bại';
            $this->warning = true;
        }

    }

    public function EditEbillVAConfigFee($id, $transFeeEdit, $partnerCode, $is_use_auto_balance_edit){
        $params = [];
        // $params['sort']['id'] = 'desc';
        $params['partner_code'] = $partnerCode;
        if(!is_int((int)$transFeeEdit)){
            $this->message = 'Chỉ được nhập số nguyên.';
            $this->warning = true;
            return;
        }
        if(is_numeric($transFeeEdit)){
            $params['fee']['feeTrans'] = $transFeeEdit;
        }
        $params['is_use_auto_balance'] = $is_use_auto_balance_edit;
        $params['id'] = $id;

        $result = EbillConnection::editFeeConfigVA($params);
        if(!$result){
            $this->message = 'Không thể edit, partnerCode bị trùng.';
            $this->warning = false;
            return false;
        }
        if(isset($result->success) and $result->success){
            $this->message = 'Bạn đã edit thành công';
            $this->warning = false;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::EBILL_CROSS_CHECK, "Edit cấu hình fee VA thành công, params: ". json_encode($params) , compact('params')));
        }else{
            $this->message = 'Bạn đã edit thất bại';
            $this->warning = true;
        }
    }

    public function saveNewEbillConfigVAFee($partnerCode, $transFee, $is_use_auto_balance){
        $params = [];
        $params['sort']['id'] = 'desc';
        $params['partner_code'] = $partnerCode;

        if(!is_int((int)$transFee)){
            $this->message = 'Chỉ được nhập số nguyên.';
            $this->warning = true;
            return;
        }
        // dd($transFee);
        if(is_numeric($transFee)){
            $params['fee']['feeTrans'] = $transFee;
        }
        $params['is_use_auto_balance'] = $is_use_auto_balance;

        $result = EbillConnection::addnewFeeConfigVA($params);

        if(!$result){
            $this->message = 'Không thể thêm, partnerCode bị trùng.';
            $this->warning = false;
            return false;
        }
        if(isset($result->success) and $result->success){
            $this->message = 'Bạn đã thêm mới thành công';
            $this->warning = false;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::EBILL_CROSS_CHECK, "Thêm cấu hình fee VA thành công, params: ". json_encode($params) , compact('params')));
        }else{
            $this->message = 'Bạn đã thêm mới thất bại';
            $this->warning = true;
        }

    }


    public function searchEbillConfigFeeVA($partnerCode, $startTime, $endTime){
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
    }

    public function getList(){
        $params = [];
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

        $dataList = EbillConnection::getListVAEbillFeeConfig($params);
        if(isset($dataList->data->data)){
            foreach($dataList->data->data as $data){
                $data->feeDisplay = json_decode($data->fee);
            }
        }
        if(isset($dataList->data->meta->page_current)){
            $this->currentPage = $dataList->data->meta->page_current;
        }
        if(isset($dataList->data->meta->total_pages)){
            $this->totalPage = $dataList->data->meta->total_pages;
        }

        $this->start = $this->currentPage - $this->part;

        if($this->start < 1){
            $this->start = 1;
        }

        $this->end = $this->currentPage + $this->part;
        if($this->end > $this->totalPage){
            $this->end = $this->totalPage;
        }

        return $dataList;
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


    public function exportCSV(){

    }


}
