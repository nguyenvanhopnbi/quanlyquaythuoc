<?php

namespace App\Http\Livewire\Gate\Ebill;

use Livewire\Component;
use App\Connection\EbillConnection;

class EbilltransferPartnerBank extends Component
{

    protected $listeners = [
        'saveNewEbillPartnerProvider' => 'saveNewEbillPartnerProvider',
        'deleteEbillBLankPartnerProvider' => 'deleteEbillBLankPartnerProvider',
        'SearchEbillBankPartnerProvider' => 'SearchEbillBankPartnerProvider',
        'EditEbillPartnerProvider' => 'EditEbillPartnerProvider'
    ];

    public function render()
    {
        $this->getList();
        return view('livewire.gate.ebill.ebilltransfer-partner-bank', [
            'EbillPartnerBankTransfer' => $this->EbillPartnerBankTransfer
        ]);
    }

    protected $EbillPartnerBankTransfer;
    public $currentPage;
    public $totalPage;
    public $start;
    public $end;
    public $part = 10;

    public $pageCurrent = 1;

    public $startTimeSearch;
    public $endTimeSearch;
    public $partnerCode;
    public $searchBankCode;
    public $searchProviderCode;

    public function SearchEbillBankPartnerProvider(
        $partnerCode,
        $searchBankCode,
        $searchProviderCode,
        $startTimeSearch,
        $endTimeSearch
    ){
        if(isset($partnerCode) and !empty($partnerCode)){
            $this->partnerCode = $partnerCode;
        }else{
            unset($this->partnerCode);
        }
        if(isset($searchBankCode) and !empty($searchBankCode)){
            $this->searchBankCode = $searchBankCode;
        }else{
            unset($this->searchBankCode);
        }
        if(isset($searchProviderCode) and !empty($searchProviderCode)){
            $this->searchProviderCode = $searchProviderCode;
        }else{
            unset($this->searchProviderCode);
        }
        if(isset($startTimeSearch) and !empty($startTimeSearch)){
            $this->startTimeSearch = strtotime($startTimeSearch);
        }else{
            unset($this->$startTimeSearch);
        }
        if(isset($endTimeSearch) and !empty($endTimeSearch)){
            $this->endTimeSearch = strtotime($endTimeSearch);
        }else{
            unset($this->$endTimeSearch);
        }
        // dd($this->searchProviderCode);
    }



    public function getList(){
        $params = [];
        if(isset($this->startTimeSearch)){
            $params['filter']['updated_at']['start_time'] = $this->startTimeSearch;
        }
        if(isset($this->endTimeSearch)){
            $params['filter']['updated_at']['end_time'] = $this->endTimeSearch;
        }
        if(isset($this->partnerCode)){
            $params['filter']['partner_code'] = $this->partnerCode;
        }
        if(isset($this->searchBankCode)){
            $params['filter']['bank_code'] = $this->searchBankCode;
        }
        if(isset($this->searchProviderCode)){
            $params['filter']['provider_code'] = $this->searchProviderCode;
        }

        // dump($params);

        $params['pagination']['page'] = $this->pageCurrent;
        $result = EbillConnection::getListTransferParnerBankProvider($params);
        if(isset($result->data)){
            $this->EbillPartnerBankTransfer = $result->data;
        }
        if(isset($result->meta->page_current)){
            $this->currentPage = $result->meta->page_current;
        }
        if(isset($result->meta->total_pages)){
            $this->totalPage = $result->meta->total_pages;
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

    public $message;
    public $warning = false;

    public $idUpdate;

    public function EditEbillPartnerProvider($partner_code, $bank_code, $provider_code, $id){
        $this->idUpdate = $id;
        $params['id'] = $this->idUpdate;
        $params['partner_code'] = $partner_code;
        $params['bank_code'] = $bank_code;
        $params['provider_code'] = $provider_code;

        $result = EbillConnection::updateTransferParnerBankProvider($params);
        if(!$result){
            $this->message = "Update th???t b???i!";
            $this->warning = true;
            return;
        }
        if(isset($result->errorCode)){
            if($result->errorCode == 0){
                $this->message = "Update th??nh c??ng!";
                $this->warning = false;

                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::EBILL_BANK,
                    "S???a Transfer Partner Bank Provider th??nh c??ng", compact('params', 'id')));
            }else{
                $this->message = "Update th???t b???i!";
                $this->warning = true;
            }
        }
    }

    public function deleteEbillBLankPartnerProvider($id){
        $params['id'] = $id;
        $result = EbillConnection::deleteTransferParnerBankProvider($params);
        if(isset($result->errorCode)){
            if($result->errorCode  == 0){
                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::EBILL_BANK,
                    "X??a Transfer Partner Bank Provider th??nh c??ng", compact('params')));
            }
        }

    }

    public function saveNewEbillPartnerProvider($partner_code, $Bank_code, $provider_code){
        // dd($provider_code);
        $params = [];
        $params['partner_code'] = $partner_code;
        $params['bank_code'] = $Bank_code;
        $params['provider_code'] = $provider_code;

        $result = EbillConnection::addNewTransferParnerBankProvider($params);
        if(!$result){
            $this->message = "Th??m m???i th???t b???i!";
            $this->warning = true;
            return;
        }
        if(isset($result->errorCode)){
            if($result->errorCode == 0){
                $this->message = "Th??m m???i th??nh c??ng!";
                $this->warning = false;


                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::EBILL_BANK,
                    "Th??m m???i Transfer Partner Bank Provider th??nh c??ng", compact('params')));
            }else{
                $this->message = "Th??m m???i th???t b???i!";
                $this->warning = true;
            }
        }


    }
}
