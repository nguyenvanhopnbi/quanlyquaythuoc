<?php

namespace App\Http\Livewire\Risk;

use Livewire\Component;
use App\Connection\RiskManagementConnection;
use App\Connection\rulerRiskManagement;

class Riskmanagement extends Component
{
    protected $listeners = [
        'searchWhiteList' => 'searchWhiteList',
        'addnewWhiteList' => 'addnewWhiteList',
        'removeMessage' => 'removeMessage',
        'updateWhiteList' => 'updateWhiteList',
        'deleteWhiteList' => 'deleteWhiteList',
        'goCurrentPages' => 'goCurrentPages',
        'detailWhiteList' => 'detailWhiteList',
        'searchBlackList' => 'searchBlackList',
        'addnewBlackList' => 'addnewBlackList',
        'resetMessageBlacklist' => 'resetMessageBlacklist',
        'updateBlackList' => 'updateBlackList',
        'deleteBlackList' => 'deleteBlackList',
        'detailBlackList' => 'detailBlackList',
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
        'searchRuleRiskCode' => 'searchRuleRiskCode'
    ];
    protected $risk;
    public $whitelist;
    public $whitelistParams;
    public $whitelistParamsadd;

    public $metaPage;
    public $pageCurrent;
    public $limit;
    public $total_record;
    public $totalPages;

    public $card_number;
    public $card_name;

    public $messageWhiteList;

    public $tab = 'whitelist';

    public $blacklistParams;
    public $blackList;
    public $cardNumberBlackList;
    public $cardNameBlackList;
    public $messageBlacklist;
    public $warming;

    public $messageBypassSearch;
    public $card_hash_search_bypass;

    public $requestServer;



    public function render()
    {
        $this->getCountry();
        $this->getWhiteList();
        $this->getFullBlackList();

        $this->getRuleRisk();
        // $this->getListCCAccountBypassRule();

        // $this->getfullBlackListNumberCard();
        return view('livewire.risk.riskmanagement');
    }
    public function setTab($tabRequest){
        $this->tab = $tabRequest;
        // dd($this->requestServer);
    }

    public function __construct(){
        // $this->risk = new RiskManagementConnection();
        // $this->getFullBlackList();
    }


    public $idRuleRisk;
    public function UpdateRuleRisk($id, $code, $name){
        $this->idRuleRisk = $id;

        $params = [];
        $params['code']=$code;
        $params['name'] = $name;

        $result = rulerRiskManagement::edit($this->idRuleRisk, $params);
        // dd($result);
        if($result){
            $this->messageRuleRisk = "Update successfully! Code: ". $code . " and Name: ".$name;
            $this->tab='rulerisk';
            return;
        }
        $this->tab='rulerisk';
    }

    public function deleteRuleRisk($id){
        $result = rulerRiskManagement::delete($id);
        $this->tab='rulerisk';
    }

    public $messageRuleRisk;
    public function addNewRuleRisk($code , $name){
        // dd($code . '-' . $name);
        $params = [];
        $params['code'] = $code;
        $params['name'] = $name;

        $result = rulerRiskManagement::add($params);
        // dd($result);
        if($result == 'code phải là duy nhất'){
            $this->tab='rulerisk';
            $this->messageRuleRisk = "Maybe code exist! Please try again.";
            return;
        }
        if($result){
            $this->tab='rulerisk';
            $this->messageRuleRisk = "Add successfully! Code: ". $code . " and Name: ".$name;
            return;
        }
    }

    public function resetRuleRiskMessage(){
        unset($this->messageRuleRisk);

    }

    public $listRuleRisk = [];
    public $searchCodeRuleRisk;
    public $currentPageRuleRisk;
    public $totalPageRuleRisk;

    public $riskRuleCurrent;

    public function getRuleRisk(){
        $params = [];
        $params['sort']['id'] = 'desc';
        $params['pagination']['limit'] = 20;
        if(isset($this->searchCodeRuleRisk)){
            $params['filter']['code'] = $this->searchCodeRuleRisk;
        }
        if(isset($this->riskRuleCurrent)){
            $params['pagination']['page'] = $this->riskRuleCurrent;
        }


        $data = rulerRiskManagement::getList($params);
        // dd($data);
        if(isset($data->data)){
            $this->listRuleRisk = $data->data;
            $this->currentPageRuleRisk = $data->meta->page_current;
            $this->totalPageRuleRisk = $data->meta->total_pages;
        }


        // dd($this->totalPageRuleRisk);

    }

    public function searchRuleRiskCode($code){
        if(isset($code)){
            $this->searchCodeRuleRisk = $code;
            $this->tab='rulerisk';
        }
    }

    public function getPageCurrentRuleRisk($page){

        $this->riskRuleCurrent = $page;
        $this->tab='rulerisk';
    }


    // begin cc account bypass rule

    public $ccAcountBypassRuleList = [];
    public $ccPageCurrent;
    public $ccTotal;

    public $currentPageccAccountBypass;
    public $rule_code;

    public function getListCCAccountBypassRule(){
        $params = [];
        $params['sort']['id'] = 'desc';
        if(isset($this->currentPageccAccountBypass)){
            $params['pagination']['page'] = $this->currentPageccAccountBypass;
        }
        if(isset($this->rule_code)){
            $params['filter']['rule_code'] = $this->rule_code;
        }

        $data = RiskManagementConnection::getListAccountBypassRule($params);
        // dd($data);
        if(isset($data->data)){
            $this->ccAcountBypassRuleList = $data->data;
        }
        if(isset($data->meta)){

            $this->ccTotal = $data->meta->total_pages;
            $this->ccPageCurrent = $data->meta->page_current;

        }
    }

    public function searchCCAccountBypass($ruleCode){

        $this->rule_code = $ruleCode;

        $this->tab = 'ccbypass';

    }

    public $messageBypass;
    public function addNewAccountBypass($idwhitelist, $ruleCode){
        $params['cc_accounts_whitelist_id'] = $idwhitelist;
        $params['rule_code'] = $ruleCode;
        $result = RiskManagementConnection::addNewAccountByPass($params);
        // dd($result);
        if($result){
            $this->tab = 'ccbypass';
            $this->messageBypass = "Add new successfully! ID WhiteList: " .$idwhitelist . " and RuleCode: ".$ruleCode;
        }
    }

    public $warning;
    public function addNewAccountBypassDirect($idwhitelist, $ruleCode){
        // dd($idwhitelist. '-'. $ruleCode);
        $params['cc_accounts_whitelist_id'] = $idwhitelist;
        $params['rule_code'] = $ruleCode;
        $result = RiskManagementConnection::addNewAccountByPass($params);
        // dd($result);
        if($result){
            $this->tab = 'whitelist';
            $this->messageBypass = "Add new successfully! ID WhiteList: " .$idwhitelist . " and RuleCode: ".$ruleCode;
        }else{
            $this->tab = 'whitelist';
            $this->warning = "exist";
            $this->messageBypass = "ID WhiteList: " .$idwhitelist . " and RuleCode: ".$ruleCode. " maybe exist, please check your input data!";
        }

        // dd($idwhitelist . '--' . $ruleCode);
    }

    public $idccBypas;
    public function UpdateAccountBypass($id, $idWhiteList, $ruleCode){
        $params = [];
        // $params['id'] = $id;
        $params['cc_accounts_whitelist_id'] = $idWhiteList;
        $params['rule_code'] = $ruleCode;
        $result = RiskManagementConnection::editCCAcountBypass($id, $params);
        if($result){
            $this->tab = 'ccbypass';
            $this->messageBypass = "Updated successfully! New ID WhiteList: " .$idWhiteList . " and new RuleCode: ".$ruleCode;
        }
    }

    public function deleteCCAccountBypass($id){
        $result = RiskManagementConnection::deleteCCAccountBypass($id);

        if($result){
            $this->tab = 'ccbypass';
            $this->getListCCAccountBypassRule();
        }
    }

    public function resetMessageBypass(){
        unset($this->messageBypass);
        unset($this->messageBypassSearch);
        unset($this->warning);
    }

    public function getPageCurrent($page){
        $this->currentPageccAccountBypass = $page;
    }

    // end cc account bypass rule

// begin blacklist

    public $detailblackCardID;
    public $detailblackCardNumber;
    public $detailblackCardHash;
    public $detailblackCardName;
    public $detailblackCardReason;
    public $detailblackStatus;
    public $detailblackCardCreatat;
    public $detailblackCardUpdateat;

    public function detailBlackList($id, $message){
        $this->tab = $message;
        $risks = new RiskManagementConnection();
        $data = $risks->detailBlacklist($id);
        if(!empty($data)){
            $this->detailblackCardID = $data->id;
            $this->detailblackCardNumber = $data->card_number;
            $this->detailblackCardHash = $data->card_hash;
            $this->detailblackCardName = $data->card_name;

            $this->detailblackCardReason = $data->reason;
            $this->detailblackStatus = $data->card_status;
            $this->detailblackCardCreatat = date("Y-m-d H:i:s", $data->created_at);
            $this->detailblackCardUpdateat = date("Y-m-d H:i:s", $data->updated_at);
            // $this->detailblackCardID = $data->id;

        }

    }


    public function deleteBlackList($id, $message){

        if(empty($id)){
            $this->messageBlacklist = "Card ID " .$id . " deleted.";
            return;
        }
        if(isset($id)){
            $risks = new RiskManagementConnection();
            $result = $risks->deleteBlackList($id);

            if($result){
                $this->messageBlacklist = "Card ID " .$id . " deleted.";
                $this->warming = 'delete';

                $this->tab = $message;

                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::RISK_MANAGEMENT_BLACKLIST, "Xoá blacklist", compact('id')));

            }else{
                $this->messageBlacklist = "Please check your input data and try again!";
            }
        }

    }
    public $idBlack;

    public function updateBlackList($id, $sixFirstNumber, $fourLastNumber, $card_name, $messages, $reason){
        // dd($id . '-' .$sixFirstNumber. '- '.$fourLastNumber.'-'.$card_name);
        $this->idBlack = $id;
        if(isset($sixFirstNumber) && isset($fourLastNumber)){
            $params['card_number'] = $sixFirstNumber.'-'.$fourLastNumber;
            $params['card_hash'] = md5(hash( 'sha256', $sixFirstNumber.'-'.$fourLastNumber ));
        }

        if(isset($card_name)){
            $params['card_name'] = $card_name;
        }

        if(isset($reason)){
            $params['reason'] = $reason;
        }

        // dd($this->whitelistParamsadd['card_name']);
        if(!is_numeric($sixFirstNumber)
            || !is_numeric($fourLastNumber)
            && strlen($sixFirstNumber) < 6 || strlen($fourLastNumber) < 4){
            $this->tab = $messages;
            $this->valid = true;
            $this->messageBlacklist = "Must be numberic! Put six first number and four last number card!
            <br> ex: ******_****";
            return;
        }

        if(empty($card_name)){
            $this->tab = $messages;
            $this->valid = true;
            $this->messageBlacklist = "Please enter your card name!";
            return;
        }

        $risks = new RiskManagementConnection();

        $result = $risks->editblacklist($this->idBlack, $params);
        // dd($result);
        if($result){
            $this->valid = false;
            $this->messageBlacklist = "Update Card successfully! Card: ". $sixFirstNumber.'-'.$fourLastNumber;

            $id = $this->idBlack;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::RISK_MANAGEMENT_BLACKLIST, "Sửa blacklist", compact('id', 'params')));
        }else{
            $this->messageBlacklist = "Please check your input data and try again!";
        }

         $this->tab = $messages;
    }


    public function addnewBlackList($sixFirstNumber, $fourLastNumber, $card_name, $messages, $id, $reason){

        $card_number = $sixFirstNumber . '-'.$fourLastNumber;

        if(isset($sixFirstNumber) && isset($fourLastNumber)){
            $params['card_number'] = $card_number;
            $params['card_hash'] = md5(hash( 'sha256', $card_number ));
        }

        if(isset($reason)){
            $params['reason'] = $reason;
        }

        if(isset($card_name)){
            $params['card_name'] = $card_name;
        }

        if(!is_numeric($sixFirstNumber)
            || !is_numeric($fourLastNumber)
            && strlen($sixFirstNumber) < 6 || strlen($fourLastNumber) < 4){
            $this->tab = $messages;
            $this->valid = true;
            $this->messageBlacklist = "Must be numberic! Put six first number and four last number card!
            <br> ex: ******_****";
            return;
        }

        if(empty($card_name)){
            $this->tab = $messages;
            $this->valid = true;
            $this->messageBlacklist = "Please enter your card name!";
            return;
        }
        $risks = new RiskManagementConnection();
        $result = $risks->addBlacklist($params);
        // dd($result);
        if($result){
            $this->valid = false;
            $this->messageBlacklist = "Added card number ". $card_number . " to blacklist successfully!";
            $this->deleteWhiteList($id);

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::RISK_MANAGEMENT_BLACKLIST, "Thêm  mới blacklist", compact('params')));

        }
        $this->tab = $messages;

    }

    public function resetMessageBlacklist(){
        $this->messageBlacklist = '';
    }


    public $startTimeBlacklist;
    public $endTimeBlacklist;

    public function getFullBlackList(){
        $this->blacklistParams = [];
        $this->blacklistParams['sort']['id'] = 'desc';
        $this->blacklistParams['pagination']['limit'] = 20;
        if(isset($this->cardNumberBlackList)){
            $this->blacklistParams['filter']['card_number'] = $this->cardNumberBlackList;
        }

        if(isset($this->cardNameBlackList)){
            $this->blacklistParams['filter']['card_name'] = $this->cardNameBlackList;
        }
         if(isset($this->blacklistCurrentPage)){
            $this->blacklistParams['pagination']['page'] = $this->blacklistCurrentPage;
        }

        if(isset($this->startTimeBlacklist)){
            $this->blacklistParams['filter']['start_time'] = $this->startTimeBlacklist;
        }

        if(isset($this->endTimeBlacklist)){
            $this->blacklistParams['filter']['end_time'] = $this->endTimeBlacklist;
        }

        $risks = new RiskManagementConnection();
        $data = $risks->getBlackList($this->blacklistParams);

        if(isset($data->meta->total_pages)){

            $this->getBlacklistTotalPage($data->meta->total_pages);
        }
        if(isset($data->meta->page_current)){
            $this->getBlacklistCurrentPage($data->meta->page_current);

        }

        $this->blackList = [];
        if(!empty($data->data) and isset($data->data)){
            $this->blackList = $data->data;

        }

    }
    public $blacklistCurrentPage;
    public $blacklistTotalPage;
    public function getBlacklistCurrentPage($page){
        $this->blacklistCurrentPage = $page;
    }
    public function getBlacklistTotalPage($total){
        $this->blacklistTotalPage = $total;
    }
    public function goCurrentPagesBlacklist($currentPage){

        if($currentPage < 1){
            $currentPage = 1;
        }
        if($currentPage > $this->blacklistTotalPage){
            $currentPage = $this->blacklistTotalPage;
        }

        $this->blacklistCurrentPage = $currentPage;

        $this->tab = 'blacklist';
    }



    public function searchBlackList($cardNumber, $cardName, $startTime, $endTime){

        if(isset($startTime) and $startTime != false){
            $this->startTimeBlacklist = strtotime($startTime);
        }
        if(isset($endTime) and $endTime != false){
            $this->endTimeBlacklist = strtotime($endTime);
        }



        if(isset($cardNumber)){
            if(strlen($cardNumber) >= 10 ){

                $sixFirstNumber = substr($cardNumber, 0, 6);
                $fourLastNumber = substr($cardNumber, -4);

                $cardNumber = $sixFirstNumber.'-'.$fourLastNumber;

                $this->cardNumberBlackList = $cardNumber;
            }else{
                $this->cardNumberBlackList = $cardNumber;
            }


        }

        if(isset($cardName)){
            $this->cardNameBlackList = $cardName;
        }

        $this->tab = 'blacklist';
    }


// begin whitelist
    public function deleteWhiteList($id){

        if(isset($id)){
            $risks = new RiskManagementConnection();
            $result = $risks->delete($id);
            if($result){
                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::RISK_MANAGEMENT_WHITELIST, "Xoá whitelist", compact('id')));
            }

        }

        $this->tab = 'whitelist';


    }
    public $idCardUpdate;
    public function updateWhiteList($id, $card_number, $card_name, $country_card, $bank_card){
        $this->idCardUpdate = $id;
        if(isset($card_number)){
            $sixFirstNumber = substr($card_number, 0, 6);
            $fourLastNumber = substr($card_number, -4);
            $this->whitelistParamsadd['card_number'] = $sixFirstNumber.'_'.$fourLastNumber;
        }
        if(isset($card_number)){
            $this->whitelistParamsadd['card_hash'] = md5(hash( 'sha256', $card_number ));
        }
        if(isset($card_name)){
            $this->whitelistParamsadd['card_name'] = $card_name;
        }

        if(isset($country_card)){
            $this->whitelistParamsadd['country_card'] = $country_card;
        }

        if(isset($bank_card)){
            $this->whitelistParamsadd['bank_card'] = $bank_card;
        }

        if(!is_numeric($card_number) && strlen($card_number) < 10){
            $this->valid = true;
            $this->messageWhiteList = "Must be numberic and at least 10 number! ex: ******_****";
            return;
        }

        if(empty($card_name)){
            $this->valid = true;
            $this->messageWhiteList = "Please enter your card name!";
            return;
        }
        if(empty($country_card)){
            $this->valid = true;
            $this->messageWhiteList = "Please enter your country card!";
            return;
        }

        if(empty($bank_card)){
            $this->valid = true;
            $this->messageWhiteList = "Please enter your bank card!";
            return;
        }

        $risks = new RiskManagementConnection();

        $result = $risks->edit($this->idCardUpdate, $this->whitelistParamsadd);
        // dd($result);
        if($result){
            $this->valid = false;
            $this->messageWhiteList = "Update Card successfully! Card: ". $sixFirstNumber.'-'.$fourLastNumber;

            $params = $this->whitelistParamsadd;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::RISK_MANAGEMENT_WHITELIST, "Sửa whitelist", compact('id', 'params')));
        }else{
            $this->messageWhiteList = "Please check your input data and try again!";
        }

         $this->tab = 'whitelist';


    }
    public $cardNumberArray = [];
    public function getfullBlackListNumberCard(){
        $params = [];
        // $params['pagination']['limit'] = '';
        $risks = new RiskManagementConnection();
        $data = $risks->getBlackList($params);
        $params['pagination']['limit'] = $data->meta->total_record;
        $data = $risks->getBlackList($params);
        if(isset($data->data)){
                foreach($data->data as $data){
                $sixFirstNumber = substr($data->card_number, 0, 6);
                $fourLastNumber = substr($data->card_number, -4);
                $this->cardNumberArray[] = $sixFirstNumber . '_'. $fourLastNumber;
            }
        }

    }

    public $valid;




    public function addnewWhiteList($card_number, $card_name, $country_card, $bank_card){
        // $this->getfullBlackListNumberCard();

        $sixFirstNumber = substr($card_number, 0, 6);
        $fourLastNumber = substr($card_number, -4);

        $check_card_number = $sixFirstNumber . '-'.$fourLastNumber;

        // if(in_array($check_card_number, $this->cardNumberArray)){
        //     $this->messageWhiteList = "Card Number: ".$check_card_number." belong to blacklist!" ;
        //     $this->valid = true;
        //     return;
        // }

        if(isset($card_number)){
            $sixFirstNumber = substr($card_number, 0, 6);
            $fourLastNumber = substr($card_number, -4);
            // dd($fourLastNumber);
            $this->whitelistParamsadd['card_number'] = $sixFirstNumber.'-'.$fourLastNumber;
        }
        if(isset($card_number)){
            $this->whitelistParamsadd['card_hash'] = md5(hash( 'sha256', $card_number ));
        }
        if(isset($card_name)){
            $this->whitelistParamsadd['card_name'] = $card_name;
        }

        if(isset($country_card)){
            $this->whitelistParamsadd['country_card'] = $country_card;
        }

        if(isset($bank_card)){
            $this->whitelistParamsadd['bank_card'] = $bank_card;
        }

        if(!is_numeric($card_number) && strlen($card_number) < 10){
            $this->valid = true;
            $this->messageWhiteList = "Must be numberic and at least 10 number! ex: ******_****";

            return;
        }

        if(empty($card_name)){
            $this->valid = true;
            $this->messageWhiteList = "Please enter your card name!";

            return;
        }

        if(empty($country_card)){
            $this->valid = true;
            $this->messageWhiteList = "Please enter your country card!";
            return;
        }

        if(empty($bank_card)){
            $this->valid = true;
            $this->messageWhiteList = "Please enter your bank card!";
            return;
        }

        if(is_numeric($card_number) && strlen($card_number) >= 10){
            $risks = new RiskManagementConnection();
            $result = $risks->add($this->whitelistParamsadd);

            if($result){
                $this->valid = false;
                $this->messageWhiteList = "Add Card successfully! Card: ". $sixFirstNumber.'-'.$fourLastNumber;

                $params = $this->whitelistParamsadd;

                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::RISK_MANAGEMENT_WHITELIST, "Thêm mới whitelist", compact('params')));

            }else{
                $this->messageWhiteList = "Please check your input data and try again!";
            }
            // dd($card_name);
        }

        else{
            $this->valid = true;
            $this->messageWhiteList = "Must be numberic and at least 10 number! ex: ******_****";

        }

        $this->tab = 'whitelist';

    }
    public function removeMessage(){
        $this->messageWhiteList = '';
        unset($this->messageWhiteList);
        unset($this->messageBlacklist);
    }


    public function getWhiteList(){
        // $this->getfullBlackListNumberCard();

        $this->whitelistParams = [];
        $this->whitelistParams['sort']['id'] = 'desc';
        $this->whitelistParams['pagination']['limit'] = '20';

        if(isset($this->card_number)){
            $this->whitelistParams['filter']['card_number'] = $this->card_number;
        }
        if(isset($this->card_name)){
            $this->whitelistParams['filter']['card_name'] = $this->card_name;
        }
        // $this->pageCurrent = '2';
        if(isset($this->pageCurrent)){
            $this->whitelistParams['pagination']['page'] = $this->pageCurrent;
        }

        if(isset($this->startTimeWhitelist)){
            $this->whitelistParams['filter']['start_time'] = $this->startTimeWhitelist;
        }

        if(isset($this->endTimeWhitelist)){
            $this->whitelistParams['filter']['end_time'] = $this->endTimeWhitelist;
        }

        $risks = new RiskManagementConnection();

        $data = $risks->getList($this->whitelistParams);

        if(isset($data->data)){
            $this->whitelist = $data->data;
        }
        if(isset($data->meta)){
            $metaPage = $data->meta;
            // dd($metaPage);
            $this->getCurrentPage($metaPage->page_current);
            $this->getTotalPage($metaPage->total_pages);
        }



    }
    public function goCurrentPages($page){
        if(isset($page)){
            $this->pageCurrent = $page;
        }
         $this->tab = 'whitelist';
    }
    public function getCurrentPage($current){
        $this->pageCurrent = $current;
    }


    public function getTotalPage($total){
        $this->totalPages = $total;
    }

    public $startTimeWhitelist;
    public $endTimeWhitelist;


    public function searchWhiteList($card_number, $card_name, $startTime, $endTime){

        if(isset($startTime) and $startTime != false){
            $this->startTimeWhitelist = strtotime($startTime);
        }

        if(isset($endTime) and $endTime != false){
            $this->endTimeWhitelist = strtotime($endTime);
        }




        if(isset($card_number) and (strlen($card_number) >= 10)){


            $sixFirstNumber = substr($card_number, 0, 6);
            $fourLastNumber = substr($card_number, -4);
            $card_number = $sixFirstNumber. '-'. $fourLastNumber;

            $this->card_number = $card_number;
        }else{
            $this->card_number = $card_number;
        }
        if(isset($card_name)){
            $this->card_name = $card_name;
        }
         $this->tab = 'whitelist';

    }

    public $detailCardNumber;
    public $detailCardHash;
    public $detailCardName;
    public $detailCardID;
    public $detailCardCreatat;
    public $detailCardUpdateat;

    public $detailCardCountry_card;
    public $detailCardBank_card;

    public function detailWhiteList($id){
        // $this->detailCardID = '';
        $risks = new RiskManagementConnection();
        $data = $risks->detail($id);
        $this->detailCardID = $data->id;
        $this->detailCardNumber = $data->card_number;
        $this->detailCardName = $data->card_name;
        $this->detailCardHash = $data->card_hash;
        $this->detailCardCreatat = $data->created_at;
        $this->detailCardUpdateat = $data->updated_at;
        $this->detailCardCountry_card = $data->country_card;
        $this->detailCardBank_card = $data->bank_card;

        $this->tab="whitelist";
    }

    public $countrycode_list = [];

    public function getCountry(){

        $country =
        '[
            {"name": "Afghanistan", "code": "AF"},
            {"name": "land Islands", "code": "AX"},
            {"name": "Albania", "code": "AL"},
            {"name": "Algeria", "code": "DZ"},
            {"name": "American Samoa", "code": "AS"},
            {"name": "AndorrA", "code": "AD"},
            {"name": "Angola", "code": "AO"},
            {"name": "Anguilla", "code": "AI"},
            {"name": "Antarctica", "code": "AQ"},
            {"name": "Antigua and Barbuda", "code": "AG"},
            {"name": "Argentina", "code": "AR"},
            {"name": "Armenia", "code": "AM"},
            {"name": "Aruba", "code": "AW"},
            {"name": "Australia", "code": "AU"},
            {"name": "Austria", "code": "AT"},
            {"name": "Azerbaijan", "code": "AZ"},
            {"name": "Bahamas", "code": "BS"},
            {"name": "Bahrain", "code": "BH"},
            {"name": "Bangladesh", "code": "BD"},
            {"name": "Barbados", "code": "BB"},
            {"name": "Belarus", "code": "BY"},
            {"name": "Belgium", "code": "BE"},
            {"name": "Belize", "code": "BZ"},
            {"name": "Benin", "code": "BJ"},
            {"name": "Bermuda", "code": "BM"},
            {"name": "Bhutan", "code": "BT"},
            {"name": "Bolivia", "code": "BO"},
            {"name": "Bosnia and Herzegovina", "code": "BA"},
            {"name": "Botswana", "code": "BW"},
            {"name": "Bouvet Island", "code": "BV"},
            {"name": "Brazil", "code": "BR"},
            {"name": "British Indian Ocean Territory", "code": "IO"},
            {"name": "Brunei Darussalam", "code": "BN"},
            {"name": "Bulgaria", "code": "BG"},
            {"name": "Burkina Faso", "code": "BF"},
            {"name": "Burundi", "code": "BI"},
            {"name": "Cambodia", "code": "KH"},
            {"name": "Cameroon", "code": "CM"},
            {"name": "Canada", "code": "CA"},
            {"name": "Cape Verde", "code": "CV"},
            {"name": "Cayman Islands", "code": "KY"},
            {"name": "Central African Republic", "code": "CF"},
            {"name": "Chad", "code": "TD"},
            {"name": "Chile", "code": "CL"},
            {"name": "China", "code": "CN"},
            {"name": "Christmas Island", "code": "CX"},
            {"name": "Cocos (Keeling) Islands", "code": "CC"},
            {"name": "Colombia", "code": "CO"},
            {"name": "Comoros", "code": "KM"},
            {"name": "Congo", "code": "CG"},
            {"name": "Congo, The Democratic Republic of the", "code": "CD"},
            {"name": "Cook Islands", "code": "CK"},
            {"name": "Costa Rica", "code": "CR"},
            {"name": "Cote D\"Ivoire", "code": "CI"},
            {"name": "Croatia", "code": "HR"},
            {"name": "Cuba", "code": "CU"},
            {"name": "Cyprus", "code": "CY"},
            {"name": "Czech Republic", "code": "CZ"},
            {"name": "Denmark", "code": "DK"},
            {"name": "Djibouti", "code": "DJ"},
            {"name": "Dominica", "code": "DM"},
            {"name": "Dominican Republic", "code": "DO"},
            {"name": "Ecuador", "code": "EC"},
            {"name": "Egypt", "code": "EG"},
            {"name": "El Salvador", "code": "SV"},
            {"name": "Equatorial Guinea", "code": "GQ"},
            {"name": "Eritrea", "code": "ER"},
            {"name": "Estonia", "code": "EE"},
            {"name": "Ethiopia", "code": "ET"},
            {"name": "Falkland Islands (Malvinas)", "code": "FK"},
            {"name": "Faroe Islands", "code": "FO"},
            {"name": "Fiji", "code": "FJ"},
            {"name": "Finland", "code": "FI"},
            {"name": "France", "code": "FR"},
            {"name": "French Guiana", "code": "GF"},
            {"name": "French Polynesia", "code": "PF"},
            {"name": "French Southern Territories", "code": "TF"},
            {"name": "Gabon", "code": "GA"},
            {"name": "Gambia", "code": "GM"},
            {"name": "Georgia", "code": "GE"},
            {"name": "Germany", "code": "DE"},
            {"name": "Ghana", "code": "GH"},
            {"name": "Gibraltar", "code": "GI"},
            {"name": "Greece", "code": "GR"},
            {"name": "Greenland", "code": "GL"},
            {"name": "Grenada", "code": "GD"},
            {"name": "Guadeloupe", "code": "GP"},
            {"name": "Guam", "code": "GU"},
            {"name": "Guatemala", "code": "GT"},
            {"name": "Guernsey", "code": "GG"},
            {"name": "Guinea", "code": "GN"},
            {"name": "Guinea-Bissau", "code": "GW"},
            {"name": "Guyana", "code": "GY"},
            {"name": "Haiti", "code": "HT"},
            {"name": "Heard Island and Mcdonald Islands", "code": "HM"},
            {"name": "Holy See (Vatican City State)", "code": "VA"},
            {"name": "Honduras", "code": "HN"},
            {"name": "Hong Kong", "code": "HK"},
            {"name": "Hungary", "code": "HU"},
            {"name": "Iceland", "code": "IS"},
            {"name": "India", "code": "IN"},
            {"name": "Indonesia", "code": "ID"},
            {"name": "Iran, Islamic Republic Of", "code": "IR"},
            {"name": "Iraq", "code": "IQ"},
            {"name": "Ireland", "code": "IE"},
            {"name": "Isle of Man", "code": "IM"},
            {"name": "Israel", "code": "IL"},
            {"name": "Italy", "code": "IT"},
            {"name": "Jamaica", "code": "JM"},
            {"name": "Japan", "code": "JP"},
            {"name": "Jersey", "code": "JE"},
            {"name": "Jordan", "code": "JO"},
            {"name": "Kazakhstan", "code": "KZ"},
            {"name": "Kenya", "code": "KE"},
            {"name": "Kiribati", "code": "KI"},
            {"name": "Korea, Democratic People\"S Republic of", "code": "KP"},
            {"name": "Korea, Republic of", "code": "KR"},
            {"name": "Kuwait", "code": "KW"},
            {"name": "Kyrgyzstan", "code": "KG"},
            {"name": "Lao People\"S Democratic Republic", "code": "LA"},
            {"name": "Latvia", "code": "LV"},
            {"name": "Lebanon", "code": "LB"},
            {"name": "Lesotho", "code": "LS"},
            {"name": "Liberia", "code": "LR"},
            {"name": "Libyan Arab Jamahiriya", "code": "LY"},
            {"name": "Liechtenstein", "code": "LI"},
            {"name": "Lithuania", "code": "LT"},
            {"name": "Luxembourg", "code": "LU"},
            {"name": "Macao", "code": "MO"},
            {"name": "Macedonia, The Former Yugoslav Republic of", "code": "MK"},
            {"name": "Madagascar", "code": "MG"},
            {"name": "Malawi", "code": "MW"},
            {"name": "Malaysia", "code": "MY"},
            {"name": "Maldives", "code": "MV"},
            {"name": "Mali", "code": "ML"},
            {"name": "Malta", "code": "MT"},
            {"name": "Marshall Islands", "code": "MH"},
            {"name": "Martinique", "code": "MQ"},
            {"name": "Mauritania", "code": "MR"},
            {"name": "Mauritius", "code": "MU"},
            {"name": "Mayotte", "code": "YT"},
            {"name": "Mexico", "code": "MX"},
            {"name": "Micronesia, Federated States of", "code": "FM"},
            {"name": "Moldova, Republic of", "code": "MD"},
            {"name": "Monaco", "code": "MC"},
            {"name": "Mongolia", "code": "MN"},
            {"name": "Montenegro", "code": "ME"},
            {"name": "Montserrat", "code": "MS"},
            {"name": "Morocco", "code": "MA"},
            {"name": "Mozambique", "code": "MZ"},
            {"name": "Myanmar", "code": "MM"},
            {"name": "Namibia", "code": "NA"},
            {"name": "Nauru", "code": "NR"},
            {"name": "Nepal", "code": "NP"},
            {"name": "Netherlands", "code": "NL"},
            {"name": "Netherlands Antilles", "code": "AN"},
            {"name": "New Caledonia", "code": "NC"},
            {"name": "New Zealand", "code": "NZ"},
            {"name": "Nicaragua", "code": "NI"},
            {"name": "Niger", "code": "NE"},
            {"name": "Nigeria", "code": "NG"},
            {"name": "Niue", "code": "NU"},
            {"name": "Norfolk Island", "code": "NF"},
            {"name": "Northern Mariana Islands", "code": "MP"},
            {"name": "Norway", "code": "NO"},
            {"name": "Oman", "code": "OM"},
            {"name": "Pakistan", "code": "PK"},
            {"name": "Palau", "code": "PW"},
            {"name": "Palestinian Territory, Occupied", "code": "PS"},
            {"name": "Panama", "code": "PA"},
            {"name": "Papua New Guinea", "code": "PG"},
            {"name": "Paraguay", "code": "PY"},
            {"name": "Peru", "code": "PE"},
            {"name": "Philippines", "code": "PH"},
            {"name": "Pitcairn", "code": "PN"},
            {"name": "Poland", "code": "PL"},
            {"name": "Portugal", "code": "PT"},
            {"name": "Puerto Rico", "code": "PR"},
            {"name": "Qatar", "code": "QA"},
            {"name": "Reunion", "code": "RE"},
            {"name": "Romania", "code": "RO"},
            {"name": "Russian Federation", "code": "RU"},
            {"name": "RWANDA", "code": "RW"},
            {"name": "Saint Helena", "code": "SH"},
            {"name": "Saint Kitts and Nevis", "code": "KN"},
            {"name": "Saint Lucia", "code": "LC"},
            {"name": "Saint Pierre and Miquelon", "code": "PM"},
            {"name": "Saint Vincent and the Grenadines", "code": "VC"},
            {"name": "Samoa", "code": "WS"},
            {"name": "San Marino", "code": "SM"},
            {"name": "Sao Tome and Principe", "code": "ST"},
            {"name": "Saudi Arabia", "code": "SA"},
            {"name": "Senegal", "code": "SN"},
            {"name": "Serbia", "code": "RS"},
            {"name": "Seychelles", "code": "SC"},
            {"name": "Sierra Leone", "code": "SL"},
            {"name": "Singapore", "code": "SG"},
            {"name": "Slovakia", "code": "SK"},
            {"name": "Slovenia", "code": "SI"},
            {"name": "Solomon Islands", "code": "SB"},
            {"name": "Somalia", "code": "SO"},
            {"name": "South Africa", "code": "ZA"},
            {"name": "South Georgia and the South Sandwich Islands", "code": "GS"},
            {"name": "Spain", "code": "ES"},
            {"name": "Sri Lanka", "code": "LK"},
            {"name": "Sudan", "code": "SD"},
            {"name": "Suriname", "code": "SR"},
            {"name": "Svalbard and Jan Mayen", "code": "SJ"},
            {"name": "Swaziland", "code": "SZ"},
            {"name": "Sweden", "code": "SE"},
            {"name": "Switzerland", "code": "CH"},
            {"name": "Syrian Arab Republic", "code": "SY"},
            {"name": "Taiwan, Province of China", "code": "TW"},
            {"name": "Tajikistan", "code": "TJ"},
            {"name": "Tanzania, United Republic of", "code": "TZ"},
            {"name": "Thailand", "code": "TH"},
            {"name": "Timor-Leste", "code": "TL"},
            {"name": "Togo", "code": "TG"},
            {"name": "Tokelau", "code": "TK"},
            {"name": "Tonga", "code": "TO"},
            {"name": "Trinidad and Tobago", "code": "TT"},
            {"name": "Tunisia", "code": "TN"},
            {"name": "Turkey", "code": "TR"},
            {"name": "Turkmenistan", "code": "TM"},
            {"name": "Turks and Caicos Islands", "code": "TC"},
            {"name": "Tuvalu", "code": "TV"},
            {"name": "Uganda", "code": "UG"},
            {"name": "Ukraine", "code": "UA"},
            {"name": "United Arab Emirates", "code": "AE"},
            {"name": "United Kingdom", "code": "GB"},
            {"name": "United States", "code": "US"},
            {"name": "United States Minor Outlying Islands", "code": "UM"},
            {"name": "Uruguay", "code": "UY"},
            {"name": "Uzbekistan", "code": "UZ"},
            {"name": "Vanuatu", "code": "VU"},
            {"name": "Venezuela", "code": "VE"},
            {"name": "Viet Nam", "code": "VN"},
            {"name": "Virgin Islands, British", "code": "VG"},
            {"name": "Virgin Islands, U.S.", "code": "VI"},
            {"name": "Wallis and Futuna", "code": "WF"},
            {"name": "Western Sahara", "code": "EH"},
            {"name": "Yemen", "code": "YE"},
            {"name": "Zambia", "code": "ZM"},
            {"name": "Zimbabwe", "code": "ZW"}
            ]';
            $this->countrycode_list = json_decode($country);
            // dd($this->countrycode_list);

    }


}
