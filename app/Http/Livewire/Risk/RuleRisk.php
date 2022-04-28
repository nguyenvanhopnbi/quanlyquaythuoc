<?php

namespace App\Http\Livewire\Risk;

use Livewire\Component;
use App\Connection\rulerRiskManagement;

class RuleRisk extends Component
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
    public function render()
    {
        $this->getRuleRisk();
        return view('livewire.risk.rule-risk');
    }

    public $idRuleRisk;
    public function UpdateRuleRisk($id, $code, $name, $detail){

        $this->idRuleRisk = $id;

        $params = [];
        $params['code']=$code;
        $params['name'] = $name;
        $params['detail'] = $detail;

        $result = rulerRiskManagement::edit($this->idRuleRisk, $params);
        // dd($this->idRuleRisk);
        if($result){
            $this->messageRuleRisk = "Update successfully! Code: ". $code . " and Name: ".$name;
            $this->tab='rulerisk';

            $id = $this->idRuleRisk;
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::RISK_MANAGEMENT_RULERISK, "Sửa Rule risk", compact('id', 'params')));

            return;
        }else{
            $this->messageRuleRisk = "Please check your input data! " . $result;
            $this->tab='rulerisk';
        }
        $this->tab='rulerisk';
    }

    public function deleteRuleRisk($id){
        $result = rulerRiskManagement::delete($id);
        $this->tab='rulerisk';
        if($result){
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::RISK_MANAGEMENT_RULERISK, "Xoá Rule risk", compact('id')));
        }
    }

    public $messageRuleRisk;
    public function addNewRuleRisk($code , $name, $detail){
        // dd($code . '-' . $name);
        $params = [];
        $params['code'] = $code;
        $params['name'] = $name;
        $params['detail'] = $detail;

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

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::RISK_MANAGEMENT_RULERISK, "Thêm mới Rule risk", compact('params')));

            return;
        }else{
            $this->tab='rulerisk';
            $this->messageRuleRisk = "Code must be unique ! " . $result;
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



    public $nameCode;
    public $startTime;
    public $endTime;

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

        if(isset($this->nameCode)){
            $params['filter']['name'] = $this->nameCode;
        }

        if(isset($this->startTime)){
            $params['filter']['start_time'] = $this->startTime;
        }

        if(isset($this->endTime)){
            $params['filter']['end_time'] = $this->endTime;
        }


        $data = rulerRiskManagement::getList($params);

        // dump($params);
        // dump($data);
        if(isset($data->data)){
            $this->listRuleRisk = $data->data;
            $this->currentPageRuleRisk = $data->meta->page_current;
            $this->totalPageRuleRisk = $data->meta->total_pages;
        }


        // dd($this->totalPageRuleRisk);

    }



    public function searchRuleRiskCode($code, $name, $startTime, $endTime){
        if(isset($code)){
            $this->searchCodeRuleRisk = $code;
            $this->tab='rulerisk';
        }

        if(isset($name)){
            $this->nameCode = $name;
        }
        if(isset($startTime) and $startTime != false){
            $this->startTime = strtotime($startTime);
        }

        if(isset($endTime) and $endTime != false){
            $this->endTime = strtotime($endTime);
        }




    }

    public function getPageCurrentRuleRisk($page){

        $this->riskRuleCurrent = $page;
        $this->tab='rulerisk';
    }
}
