<?php

namespace App\Http\Livewire\Risk;

use Livewire\Component;
use App\Connection\ccBinCardAllowConnection;
use App\Connection\PartnerConnection;

class CcPartnerBinCardAllow extends Component
{

    protected $listeners = [
        'searchCCBinCardAllow' => 'searchCCBinCardAllow',
        'addNewCCPartnerBinCardAllow' => 'addNewCCPartnerBinCardAllow',
        'deleteCCPartnerBinCardAllow' => 'deleteCCPartnerBinCardAllow',
        'UpdateCCPartnerBinCardAllow' => 'UpdateCCPartnerBinCardAllow',
        'resetMessage' => 'resetMessage'
    ];
    public function render()
    {
        $this->getPartnerCode();
        $this->getList();
        return view('livewire.risk.cc-partner-bin-card-allow');
    }

    public $binCardList = [];
    public $partnerCodeList = [];

    public $partnerCodeSearch;
    public $binCardSearch;

    public $currentPage;
    public $totalPage;

    public $pageCurrent;

    public function getList(){
        $params = [];
        $params['sort']['id'] = 'desc';
        if(isset($this->partnerCodeSearch)){
            $params['filter']['partner_code'] = $this->partnerCodeSearch;
        }

        if(isset($this->binCardSearch)){
            $params['filter']['bin_card'] = $this->binCardSearch;
        }

        if(isset($this->pageCurrent)){
            $params['pagination']['page'] = $this->pageCurrent;
        }

        if(isset($this->startTime)){
            $params['filter']['start_time'] = $this->startTime;
        }

        if(isset($this->endTime)){
            $params['filter']['end_time'] = $this->endTime;
        }

        $dataBinCard = ccBinCardAllowConnection::getList($params);
        if(isset($dataBinCard->data)){
            $this->binCardList = $dataBinCard->data;
             // dd($dataBinCard);
        }
        if(isset($dataBinCard->meta->page_current)){
            $this->currentPage = $dataBinCard->meta->page_current;
        }
        if(isset($dataBinCard->meta->total_pages)){
            $this->totalPage = $dataBinCard->meta->total_pages;
        }
    }

    public function deleteCCPartnerBinCardAllow($id){
        $result = ccBinCardAllowConnection::delete($id);
        if($result){
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::RISK_MANAGEMENT_CC_PARTNER_BIN_CARD_ALLOW, "Xoá cc partner bincard allow", compact('id')));
        }
    }

    public $idBinCard;
    public $messageUpdate;

    public function UpdateCCPartnerBinCardAllow($id, $bin_card, $partner_code){
        $this->idBinCard = $id;
        $params['partner_code'] = $partner_code;
        $params['bin_card'] = $bin_card;

        if(!$this->checkPartnerCode($partner_code)){
            $this->messageUpdate = "Partner Code is not existed";
            return;
        }

        if(!is_numeric($bin_card)){
            $this->messageUpdate = "Must be numberic!";
            return;
        }
        if(strlen($bin_card) > 6){
            $this->messageUpdate = "Maximum is 6 number!";
            return;
        }
        if(strlen($bin_card) < 6){
            $this->messageUpdate = "Exactly is 6 number!";
            return;
        }

        $result = ccBinCardAllowConnection::edit($id, $params);
        if($result){
            $this->messageUpdate = "Update Successfully! BinCard: ". $bin_card. " Partner Code: ".$partner_code;
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::RISK_MANAGEMENT_CC_PARTNER_BIN_CARD_ALLOW, "Sửa cc partner bincard allow", compact('id', 'params')));
        }
    }

    public function gotoPage($page){
        // dd($page);
        if($page < 1){
            $page = 1;
        }
        if($page > $this->totalPage){
            $page = $this->totalPage;
        }
        $this->pageCurrent = $page;
    }

    public $message;

    public function addNewCCPartnerBinCardAllow($bin_card, $partner_code){
        // dd($bin_card . '-' . $partner_code);
        if(!$this->checkPartnerCode($partner_code)){
            $this->message = "Partner Code is not existed";
            return;
        }

        if(!is_numeric($bin_card)){
            $this->message = "Must be numberic!";
            return;
        }
        if(strlen($bin_card) > 6){
            $this->message = "Maximum is 6 number!";
            return;
        }
        if(strlen($bin_card) < 6){
            $this->message = "Exactly is 6 number!";
            return;
        }
        if(isset($bin_card) and !empty($bin_card)){
            $params['bin_card'] = $bin_card;
        }
        if(isset($partner_code) and !empty($partner_code)){
            $params['partner_code'] = $partner_code;
        }

        $result = ccBinCardAllowConnection::add($params);
        // dd($result);
        if($result){
            $this->warning = false;
            $this->message = "Add new successfully! BinCard: ".$bin_card. " Partner Code: ".$partner_code;
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::RISK_MANAGEMENT_CC_PARTNER_BIN_CARD_ALLOW, "Thêm mới cc partner bincard allow", compact('params')));
        }else{
            $this->warning = true;
            $this->message = "BinCard: ".$bin_card. " Partner Code: ".$partner_code. " maybe exist! Please check your input data again!";
        }
    }
    public $warning = false;

    public function resetMessage(){
        unset($this->warning);
        unset($this->message);
    }


    public function getPartnerCode(){
        $params = [];
        $partnerCodeList = PartnerConnection::getList($params);
        if(isset($partnerCodeList->meta->total)){
            $params['pagination']['limit'] = $partnerCodeList->meta->total;
        }

        $partnerCodeList = PartnerConnection::getList($params);

        if(isset($partnerCodeList->data)){
            $this->partnerCodeList = $partnerCodeList->data;
        }

    }

    public $partnerCodeArray = [];
    public $partnerCodeArray2 = [];

    public function checkPartnerCode($partnerCode){
        foreach($this->partnerCodeList as $list){
            $this->partnerCodeArray[] = $list['partner_code'];
        }
        foreach($this->partnerCodeArray as $arr){
            if($arr == null){
                // dd('vao day');
                unset($arr);
            }else{
                $this->partnerCodeArray2[] = $arr;
            }
            // dd($arr);


        }
        // dd($this->partnerCodeArray2);
        if(!in_array($partnerCode, $this->partnerCodeArray2)){
            return false;
        }
        return true;
    }

    public $startTime;
    public $endTime;

    public function searchCCBinCardAllow($partner_code, $bin_card, $startTime, $endTime){
        $this->partnerCodeSearch = $partner_code;
        $this->binCardSearch = $bin_card;

        if(isset($startTime) and !empty($startTime)){
            $this->startTime = strtotime($startTime);
        }
        if(isset($endTime) and !empty($endTime)){
            $this->endTime = strtotime($endTime);
        }

    }
}
