<?php

namespace App\Http\Livewire\EbillConfig;

use Livewire\Component;
use App\Connection\EbillConnection;
use App\Connection\PartnerConnection;

class EbillConfigBankPartnerProvider extends Component
{

    protected $listeners = [
        'AddnewConfigBankPartnerProvider' => 'AddnewConfigBankPartnerProvider',
        'SearchEbillConfigBankPartnerProvider' => 'SearchEbillConfigBankPartnerProvider',
        'deleteConfigPartnerBankProvider' => 'deleteConfigPartnerBankProvider',
        'UpdateEbillConfigBankPartnerProvider' => 'UpdateEbillConfigBankPartnerProvider',
        'resetMessage' => 'resetMessage'
    ];

    protected $dataList;
    public function render()
    {
        $this->getListPartnerCode();
        $this->getList();
        return view('livewire.ebill-config.ebill-config-bank-partner-provider', [
            'partnerCodeList' => $this->partnerCodeList,
            'dataList' => $this->dataList
        ]);
    }

    public function resetMessage(){
        unset($this->message);
        unset($this->warning);
    }

    public $message;
    public $warning = false;

    public function deleteConfigPartnerBankProvider($id){
        $params = [];
        $params['id'] = $id;
        $result = EbillConnection::DeleteConfigPartnerBankProvider($params);
        if(isset($result->errorCode)){
            if($result->errorCode == 0){
                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::EBILL_BANK_CONFIG_PARTNER_PROVIDER, "Xóa Config Bank Partner Provider thành công", compact('params')));
            }
        }
    }

    public function UpdateEbillConfigBankPartnerProvider($id, $partner_code, $bank_code, $provider_code){
        $params = [];
        $params['partner_code'] = $partner_code;
        $params['bank_code'] = $bank_code;
        $params['provider_code'] = $provider_code;
        $params['id'] = $id;

        $result = EbillConnection::UpdateConfigPartnerBankProvider($params);
        if(isset($result->errorCode)){
            if($result->errorCode == 0){
                $this->message = "Update thành công! Partner Code: ". $partner_code . " and Bank Code: ". $bank_code . " and Provider Code: " . $provider_code;
                $this->warning = false;

                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::EBILL_BANK_CONFIG_PARTNER_PROVIDER, "Update Config Bank Partner Provider thành công", compact('params')));

            }
        }else{
            $this->message = "Update thất bại, kiểm tra lại dữ liệu nhập vào!";
                $this->warning = true;
        }

    }

    public $partner_code;
    public $bank_code;
    public $provider_code;
    public $startTime;
    public $endTime;

    public function SearchEbillConfigBankPartnerProvider(
        $PartnerCodeSearch, $ProviderCodeSearch, $BankCodeSearch, $startTime, $endTime
    ){
        $this->partner_code = $PartnerCodeSearch;
        $this->bank_code = $BankCodeSearch;
        $this->provider_code = $ProviderCodeSearch;
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

    public function getList(){
        $params = [];
        $params['pagination']['limit'] = 20;
        if(isset($this->pageCurrent)){
            $params['pagination']['page'] = $this->pageCurrent;
        }

        if(isset($this->partner_code)){
            $params['filter']['partner_code'] = $this->partner_code;
        }
        if(isset($this->bank_code)){
            $params['filter']['bank_code'] = $this->bank_code;
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

        $data = EbillConnection::ConfigPartnerBankProvider($params);
        if(isset($data->data)){
            $this->dataList = $data->data;
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

    public function gotoCurrentPage($page){
        if($page < 1){
            $page = 1;
        }
        if($page > $this->totalPage){
            $page = $this->totalPage;
        }

        $this->pageCurrent = $page;
    }

    public $start;
    public $end;
    public $part = 10;
    public $currentPage;
    public $totalPage;
    public $pageCurrent;

    public function AddnewConfigBankPartnerProvider($partnerCode, $bankCode, $providerCode){
        $params = [];
        $params['partner_code'] = $partnerCode;
        $params['bank_code'] = $bankCode;
        $params['provider_code'] = $providerCode;

        $result = EbillConnection::AddnewConfigPartnerBankProvider($params);
        if(!$result){
            $this->message = "Thêm mới config thất bại!";
            $this->warning = true;
            return;
        }
        if(isset($result->errorCode)){

            if($result->errorCode == 0){
                $this->message = "Thêm mới config thành công! Partner Code: ". $partnerCode. " Bank Code: ". $bankCode . " Provider Code: " .$providerCode;
                $this->warning = false;

                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::EBILL_BANK_CONFIG_PARTNER_PROVIDER, "Thêm mới Config Bank Partner Provider thành công", compact('params')));


                return;
            }

        }else{
            $this->message = "Thêm mới config thất bại!";
            $this->warning = true;
            return;
        }
        // AddnewConfigPartnerBankProvider
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
}
