<?php

namespace App\Http\Livewire\Risk;

use Livewire\Component;
use App\Connection\ruleSpecialConnection;

use App\Connection\PartnerSpecialRuleConnection;
use App\Connection\rulerRiskManagement;

class RuleSpecial extends Component
{
    protected $listeners = [
        'searchRuleSpecialCode' => 'searchRuleSpecialCode',
        'deleteRuleSpecial' => 'deleteRuleSpecial',
        'addMoreParams' => 'addMoreParams',
        'addNewRuleSpecial' => 'addNewRuleSpecial',
        'getDateTableRuleSpecialData' => 'getDateTableRuleSpecialData',
        'addMoreParamsHTMLUpdate' => 'addMoreParamsHTMLUpdate',
        'updateRuleSpecial' => 'updateRuleSpecial',
        'removeMessage' => 'removeMessage'

    ];
    public function render()
    {
        $this->getListRuleSpecial();
        $this->getRuleRisk();
        return view('livewire.risk.rule-special');
    }

    public function getRuleRisk(){
        $params = [];
        $params['pagination']['limit'] = 10000000;
        $data = rulerRiskManagement::getList($params);
        if(isset($data->data)){
            $this->ruleRiskList = $data->data;
        }
    }

    public $ruleRiskList;

    public $codeSpecial;
    public $specialList = [];
    public $currentPage;
    public $totalPage;
    public $pageCurrent;
    public $message;

    public $count = 1;
    public $paramInput = '<input placeholder="Enter your param 1 " type="text" class="form-control" id="ruleSpecialParam1">';
    public function addMoreParams(){
        $this->count++;
        $this->paramInput = $this->paramInput .
        '<input placeholder="Enter your param '.$this->count.' " id="ruleSpecialParam'. $this->count .'" style="margin-top: 5px" type="text" class="form-control">';

    }

    public $idSpecialRule;
    public $nameSpecialRule;
    public $codeSpecialRule;
    public $paramSpecialRule;
    public $paramInputUpdate;

    public function getDateTableRuleSpecialData($id){
        $data = ruleSpecialConnection::detail($id);
        if(isset($data->id)){
            $this->idSpecialRule = $data->id;
        }
        if(isset($data->name)){
            $this->nameSpecialRule = $data->name;
        }
        if(isset($data->code)){
            $this->codeSpecialRule = $data->code;
        }
        if(isset($data->param)){
            $this->paramInputUpdate = '';
            $this->paramSpecialRule = json_decode($data->param, true);
            $this->paramSpecialRule = $this->paramSpecialRule['allParam'];
            $countParam = count($this->paramSpecialRule);

            $this->inum = 0;
            foreach($this->paramSpecialRule as $paramSpecialRuleData){
                $this->inum++;
                $this->paramInputUpdate
                = $this->paramInputUpdate . '<input value="'.$paramSpecialRuleData.'" placeholder="Enter your param '.$this->inum.' " id="ruleSpecialParamUpdate'. $this->inum .'" style="margin-top: 5px" type="text" class="form-control">';
            }

        }
        // dd($data);
    }

    public function updateRuleSpecial($id, $code, $name, $param, $detail){

        $param = array_filter($param);
        $param = array_unique($param);

        $newParam = [];
        foreach($param as $p){
            $newParam[] = $p;
        }

        if(isset($name)){
            $params['name'] = $name;
        }
        if(isset($code)){
            $params['code'] = $code;
        }
        if(isset($param)){
            $params['param'] = $newParam;
        }

        $params['detail'] = $detail;

        if(isset($id)){
            $result = ruleSpecialConnection::edit($id, $params);
            if($result){
                $this->message =
            "Update successfully! Name: ".$name. " Code: ". $code;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::RISK_MANAGEMENT_SPECIAL_RULE, "Sửa special rule", compact('id', 'params')));

            }else{
                $this->message = "Please check your input data again! " . $result;
            }
        }

    }

    public function removeMessage(){
        unset($this->message);
    }



    public $inum;

    public function addMoreParamsHTMLUpdate(){
        $this->inum++;
        $this->paramInputUpdate = $this->paramInputUpdate . '<input placeholder="Enter your param '
        .$this->inum.' " id="ruleSpecialParamUpdate'. $this->inum .'" style="margin-top: 5px" type="text" class="form-control">';
    }

    public function addNewRuleSpecial($code, $name, $param, $detail){

        // dump($param);
        $param = array_filter($param);
        $param = array_unique($param);
        $newParam = [];
        foreach($param as $p){
            $newParam[] = $p;
        }

        $params['param'] = $newParam;
        $params['code'] = $code;
        $params['name'] = $name;

        $params['detail'] = $detail;


        // dd($params);
        $result = ruleSpecialConnection::add($params);
        if($result){
            $this->message =
            "Add new successfully! Name: ".$name. " Code: ". $code;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::RISK_MANAGEMENT_SPECIAL_RULE, "Thêm mới special rule", compact('params')));
        }else{
            $this->message = "Your code must be unique! ".$result ;
        }
    }

    public function deleteRuleSpecial($id, $specialCode){
        $idPartnerSpecialCode = [];
        $params = [];
        // $params['filter']['rule_code'] = 'no value';
        if(isset($specialCode) and !empty($specialCode)){
            $params['filter']['rule_code'] = $specialCode;
            $data = PartnerSpecialRuleConnection::getList($params);
            if(isset($data->data) and !empty($data->data)){
                foreach($data->data as $data){
                    $idspecialPartnerRule = $data->id;
                    $result = PartnerSpecialRuleConnection::delete($data->id);
                    event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::RISK_MANAGEMENT_PARTNER_SPECIAL_RULE, "Xoá partner special rule", compact('idspecialPartnerRule')));


                }
            }
            // dd($data);
        }



         $result = ruleSpecialConnection::delete($id);
         if($result){
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::RISK_MANAGEMENT_SPECIAL_RULE, "Xoá special rule", compact('id')));
         }
    }

    public function getListRuleSpecial(){
        $params = [];
        $params['sort']['id'] = 'desc';
        if(isset($this->codeSpecial)){
            $params['filter']['code'] = $this->codeSpecial;
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

        $data = ruleSpecialConnection::getList($params);

        if(isset($data->data)){
            $this->specialList = $data->data;
        }
        if(isset($data->meta->page_current)){
            $this->currentPage = $data->meta->page_current;

        }
        if(isset($data->meta->total_pages)){
            $this->totalPage = $data->meta->total_pages;
            // dd($this->totalPage);
        }
    }
    public function getCurrentPage($page){
        $this->pageCurrent = $page;
    }

    public $startTime;
    public $endTime;

    public function searchRuleSpecialCode($code, $startTime, $endTime){
        $this->codeSpecial = $code;

        if(isset($startTime) and !empty($startTime)){
            $this->startTime = strtotime($startTime);
        }
        else{
            $this->startTime = '';
        }

        if(isset($endTime) and !empty($endTime)){
            $this->endTime = strtotime($endTime);
        }else{
            $this->endTime = '';
        }
    }
}
