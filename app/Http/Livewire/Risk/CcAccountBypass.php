<?php

namespace App\Http\Livewire\Risk;

use Livewire\Component;
use App\Connection\RiskManagementConnection;
use App\Connection\rulerRiskManagement;

class CcAccountBypass extends Component
{
    protected $listeners = [

        'resetMessageBlacklist' => 'resetMessageBlacklist',
        'addNewAccountBypass' => 'addNewAccountBypass',
        'UpdateAccountBypass' => 'UpdateAccountBypass',
        'resetMessageBypass' => 'resetMessageBypass',
        'deleteCCAccountBypass' => 'deleteCCAccountBypass',
        'searchCCAccountBypass' => 'searchCCAccountBypass',
        'addNewAccountBypassDirect' => 'addNewAccountBypassDirect',
        'addNewRuleRisk' => 'addNewRuleRisk',
        'resetRuleRiskMessage' => 'resetRuleRiskMessage',
        'deleteRuleRisk' => 'deleteRuleRisk',
        'UpdateRuleRisk' => 'UpdateRuleRisk',
        'searchRuleRiskCode' => 'searchRuleRiskCode',
        'getCardNumberByID' => 'getCardNumberByID'
    ];
    public function render()
    {
        $this->checkRuleRiskCode('2333');
        $this->getRuleRisk();
        $this->getListCCAccountBypassRule();
        return view('livewire.risk.cc-account-bypass');
    }

    // begin cc account bypass rule

    public $ccAcountBypassRuleList = [];
    public $ccPageCurrent;
    public $ccTotal;

    public $currentPageccAccountBypass;
    public $rule_code;

    public $card_number;
    public $startTime;
    public $endTime;

    public $idWhitelist;

    public function getListCCAccountBypassRule(){
        $params = [];
        $params['sort']['id'] = 'desc';

        if(isset($this->currentPageccAccountBypass)){
            $params['pagination']['page'] = $this->currentPageccAccountBypass;
        }

        if(isset($this->rule_code)){
            $params['filter']['rule_code'] = $this->rule_code;
        }

        if(isset($this->card_number)){
            $params['filter']['card_number'] = $this->card_number;
        }

        if(isset($this->startTime)){
            $params['filter']['start_time'] = $this->startTime;
        }

        if(isset($this->endTime)){
            $params['filter']['end_time'] = $this->endTime;
        }

        if(isset($this->idWhitelist)){
            $params['filter']['cc_accounts_whitelist_id'] = $this->idWhitelist;
        }

        // $params['filter']['cc_accounts_whitelist_id'] = 9;

        // dump($params);

        $data = RiskManagementConnection::getListAccountBypassRule($params);
        // dump($data);
        if(isset($data->data)){
            $this->ccAcountBypassRuleList = $data->data;
        }
        if(isset($data->meta)){

            $this->ccTotal = $data->meta->total_pages;
            $this->ccPageCurrent = $data->meta->page_current;

        }
    }



    public function searchCCAccountBypass($ruleCode, $card_number, $startTime, $endTime){
        if(isset($card_number) and strlen($card_number) >= 10){
            $this->idWhitelist = $this->getIDFromCardNumber($card_number);
        }else{
            $this->idWhitelist = '';
        }

        if(isset($startTime) and !empty($startTime)){
            $this->startTime = strtotime($startTime);
        }
        if(isset($endTime) and !empty($endTime)){
            $this->endTime = strtotime($endTime);
        }



        $this->rule_code = $ruleCode;

        $this->tab = 'ccbypass';

    }

    public $messageBypass;
    public $idFromCardNumber;
    public $cardNumberUpdate;
    public $idccBypas;

    public function getCardNumberByID($idwhiteList, $id){
        $this->idccBypas = $id;
        $params['filter']['id'] = $id;
        $dataWhiteList = RiskManagementConnection::getList($params);
        foreach($dataWhiteList->data as $whiteData){
            $this->cardNumberUpdate = $whiteData->card_number;
        }
    }

    public function getIDFromCardNumber($cardNumber){

        $sixFirstNumber = substr($cardNumber, 0, 6);
        $fourLastNumber = substr($cardNumber, -4);

        $cardNumber = $sixFirstNumber.'-'.$fourLastNumber;

        $params['filter']['card_number'] = $cardNumber;
        $dataWhiteList = RiskManagementConnection::getList($params);
        foreach($dataWhiteList->data as $whiteData){
            $this->idFromCardNumber = $whiteData->id;
        }

        return $this->idFromCardNumber;

    }

    public function addNewAccountBypass($cardNumber, $ruleCode){

        if(!$this->checkRuleRiskCode($ruleCode)){
            $this->messageBypass = "Rule Code: ". $ruleCode. " doesn't exist!";
            return;
        }

        $this->getIDFromCardNumber($cardNumber);
        if(!isset($this->idFromCardNumber) || !is_numeric($this->idFromCardNumber)){
            $this->messageBypass = "This Card Number ".$cardNumber." doesn't exist! ";
            return;
        }

        $idwhitelist = $this->idFromCardNumber;


        $params['cc_accounts_whitelist_id'] = $idwhitelist;
        $params['rule_code'] = $ruleCode;
        $result = RiskManagementConnection::addNewAccountByPass($params);

        if($result){
            $this->warning = false;
            $this->tab = 'ccbypass';
            $this->messageBypass = "Add new successfully! ID WhiteList: " .$idwhitelist . " and RuleCode: ".$ruleCode;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::RISK_MANAGEMENT_CCACOUNTBYPASS, "Thêm mới cc Account bypass", compact('params')));
        }else{
            $this->warning = true;
            $this->tab = 'ccbypass';
            $this->messageBypass = "ID WhiteList: " .$idwhitelist . " and RuleCode: ".$ruleCode . " maybe exist! Please check your input data again!";
        }
    }

    public $warning = false;

    public function addNewAccountBypassDirect($idwhitelist, $ruleCode){

        $params['cc_accounts_whitelist_id'] = $idwhitelist;
        $params['rule_code'] = $ruleCode;
        $result = RiskManagementConnection::addNewAccountByPass($params);
        if($result){
            $this->tab = 'whitelist';
            $this->messageBypass = "Add new successfully! ID WhiteList: " .$idwhitelist . " and RuleCode: ".$ruleCode;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::RISK_MANAGEMENT_CCACOUNTBYPASS, "Thêm mới cc Account bypass", compact('params')));
        }

        // dd($idwhitelist . '--' . $ruleCode);
    }

    public $listRuleRisk = [];

    public function getRuleRisk(){
        $params= [];
        $params['pagination']['limit'] = 1000000000000000000;
        $dataRuleRisk = rulerRiskManagement::getList($params);

        foreach($dataRuleRisk->data as $dataRuleRisk){
            $this->listRuleRisk[] = $dataRuleRisk->code;
        }
    }

    public function checkRuleRiskCode($code){
        $params['filter']['code'] = $code;
        $dataRuleRisk = rulerRiskManagement::getList($params);

        if(isset($dataRuleRisk->meta->total_record)){
            if($dataRuleRisk->meta->total_record == 1){
                return true;
            }
        }

        return false;
    }


    public function UpdateAccountBypass($id, $CardWhiteList, $ruleCode){

        if(!$this->checkRuleRiskCode($ruleCode)){
            $this->messageBypass = "Rule Code: ". $ruleCode. " doesn't exist!";
            return;
        }

        $this->getIDFromCardNumber($CardWhiteList);
        if(!isset($this->idFromCardNumber) || !is_numeric($this->idFromCardNumber)){
            $this->messageBypass = "This Card Number ".$CardWhiteList." doesn't exist! ";
            return;
        }

        $idwhitelist = $this->idFromCardNumber;


        $params = [];
        // $params['id'] = $id;
        $params['cc_accounts_whitelist_id'] = $idwhitelist;
        $params['rule_code'] = $ruleCode;
        // dump($id);
        // dd($params);
        $result = RiskManagementConnection::editCCAcountBypass($id, $params);
        if($result){
            $this->tab = 'ccbypass';
            $this->messageBypass = "Updated successfully! New ID WhiteList: " .$idwhitelist . " and new RuleCode: ".$ruleCode;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::RISK_MANAGEMENT_CCACOUNTBYPASS, "Sửa cc Account bypass", compact('id', 'params')));
        }
    }

    public function deleteCCAccountBypass($id){
        $result = RiskManagementConnection::deleteCCAccountBypass($id);

        if($result){
            $this->tab = 'ccbypass';

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::RISK_MANAGEMENT_CCACOUNTBYPASS, "Xoá cc Account bypass", compact('id')));
        }
    }

    public function resetMessageBypass(){
        unset($this->messageBypass);
        unset($this->messageBypassSearch);
    }

    public function getPageCurrent($page){
        $this->currentPageccAccountBypass = $page;
    }

    // end cc account bypass rule
}
