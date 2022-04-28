<?php

namespace App\Http\Livewire\EbillConfig;

use Livewire\Component;
use App\Connection\EbillConnection;
use App\Connection\PartnerConnection;

class EbillConfigPartnerProvider extends Component
{

    public $message;
    public $warning = false;

    protected $listeners = [
        'searchEbillConfigProvider' => 'searchEbillConfigProvider',
        'addnewEbillConfigProvider' => 'addnewEbillConfigProvider',
        'deleteConfigPartnerProvider' => 'deleteConfigPartnerProvider',
        'updateConfigPartnerProvider' => 'updateConfigPartnerProvider',
        'resetMessage' => 'resetMessage'
    ];
    protected $dataList;

    public function render()
    {
        $this->getList();
        $this->getListPartnerCode();
        return view('livewire.ebill-config.ebill-config-partner-provider', [
            'dataList' => $this->dataList,
            'partnerCodeList' => $this->partnerCodeList
        ]);
    }

    public function resetMessage(){
        unset($this->message);
        unset($this->warning);
    }

    protected $partnerCodeList;
    public function getListPartnerCode(){
        $params = [];
        $params['pagination']['limit'] = 100000;
        $data = PartnerConnection::getList($params);
        if(isset($data->data)){
            $this->partnerCodeList = $data->data;
        }
    }

    public function updateConfigPartnerProvider($id, $partnerCode, $providerCode){
        $params = [];
        $params['id'] = $id;
        $params['partner_code'] = $partnerCode;
        $params['provider_code'] = $providerCode;

        $result = EbillConnection::UpdateConfigPartnerProvider($params);
        if(!$result){
            $this->message = "Update config thất bại! PartnerCode: " .$partnerCode ." and Provider Code: " .$providerCode;
            $this->warning = true;
            return;
        }
        if($result->errorCode == 0){
            $this->message = "Update config thành công! PartnerCode: " .$partnerCode ." and Provider Code: " .$providerCode;
            $this->warning = false;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::EBILL_BANK_CONFIG_PARTNER_PROVIDER, "Update cấu hình thu hộ bank partner provider", compact('params')));

            return;
        }else{
            $this->message = "Update config thất bại! PartnerCode: " .$partnerCode ." and Provider Code: " .$providerCode;
            $this->warning = true;

            return;
        }
    }

    public function deleteConfigPartnerProvider($id){
        $params = [];
        $params['id'] = $id;
        $result = EbillConnection::DeleteConfigPartnerProvider($params);
        if($result->errorCode == 0){
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::EBILL_BANK_CONFIG_PARTNER_PROVIDER, "Xóa cấu hình thu hộ bank partner provider", compact('id')));
        }


    }


    public function addnewEbillConfigProvider($partnerCode, $providerCode){
        $params = [];
        $params['partner_code'] = $partnerCode;
        $params['provider_code'] = $providerCode;

        $result = EbillConnection::AddnewConfigPartnerProvider($params);
        if(!$result){
            $this->message = "Thêm mới config thất bại! PartnerCode: " .$partnerCode ." and Provider Code: " .$providerCode;
            $this->warning = true;
            return;
        }
        if($result->errorCode == 0){
            $this->message = "Thêm mới config thành công! PartnerCode: " .$partnerCode ." and Provider Code: " .$providerCode;
            $this->warning = false;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::EBILL_BANK_CONFIG_PARTNER_PROVIDER, "Thêm mới cấu hình thu hộ bank partner provider", compact('params')));

        }else{
            $this->message = "Thêm mới config thất bại! PartnerCode: " .$partnerCode ." and Provider Code: " .$providerCode;
            $this->warning = true;
        }


        // EBILL_BANK_CONFIG_PARTNER_PROVIDER
    }

    public function getList(){
        $params = [];
        $params['pagination']['limit'] = 20;
        $params['pagination']['page'] = $this->pageCurrent;

        if(isset($this->partner_code)){
            $params['filter']['partner_code'] = $this->partner_code;
        }

        if(isset($this->provider_code)){
            $params['filter']['provider_code'] = $this->provider_code;
        }

        if(isset($this->startTime)){
            $params['filter']['updated_at']['start_time'] = $this->startTime;
        }

        if(isset($this->endTime)){
            $params['filter']['updated_at']['end_time'] = $this->endTime;
        }

        $data = EbillConnection::ConfigPartnerProvider($params);
        if(isset($data->data)){
            $this->dataList = $data->data;
        }

        if(isset($data->meta->page_current)){
            $this->currentPage = $data->meta->page_current;
        }

        if($data->meta->total_pages){
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

    public function gotoCurrentPage($page){
        if($page < 1){
            $page = 1;
        }
        if($page > $this->totalPage){
            $page = $this->totalPage;
        }
        $this->pageCurrent = $page;
    }

    public $currentPage;
    public $totalPage;
    public $pageCurrent;
    public $start;
    public $end;
    public $part = 10;

    public $partner_code;
    public $provider_code;
    public $startTime;
    public $endTime;
    public function searchEbillConfigProvider($partnerCode, $providerCode, $startTime, $endTime){
        $this->partner_code = $partnerCode;
        $this->provider_code = $providerCode;
        if(isset($startTime) and !empty($startTime)){
            $this->startTime = strtotime($startTime);
        }else{
            $this->startTime = 0;
        }

        if(isset($endTime) and !empty($endTime)){
            $this->endTime = strtotime($endTime);
        }else{
            $this->endTime = 9999999999;
        }

    }
}
