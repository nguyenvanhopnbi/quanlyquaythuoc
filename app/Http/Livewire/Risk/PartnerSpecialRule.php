<?php

namespace App\Http\Livewire\Risk;

use Livewire\Component;
use App\Connection\PartnerSpecialRuleConnection;
use App\Connection\ruleSpecialConnection;
use App\Connection\PartnerConnection;

class PartnerSpecialRule extends Component
{
    protected $listeners = [
        'searchPartnerSpecialCode' => 'searchPartnerSpecialCode',
        'addMoreParamsPartnerSpecial' => 'addMoreParamsPartnerSpecial',
        'addNewPartnerRuleSpecial' => 'addNewPartnerRuleSpecial',
        'getParamSpecial' => 'getParamSpecial',
        'resetMessage' => 'resetMessage',
        'deletePartnerRuleSpecial' => 'deletePartnerRuleSpecial',
        'getParamSpecialUpdate' => 'getParamSpecialUpdate',
        'UpdatePartnerRuleSpecial' => 'UpdatePartnerRuleSpecial',
        'getIDUpdatePartCodeSpecial' => 'getIDUpdatePartCodeSpecial',
        'Detail' => 'Detail',
        'DetailUpdate' => 'DetailUpdate'

    ];

    public $partnerSpecialRuleList = [];
    public $pageCurrent;
    public $total;
    public $getPageCurrent;

    public $ruleCode;
    public $countNum;

    public $paramInput = '<input placeholder="Choose rule code to load param" type="text" class="form-control" id="rulePartnerSpecialParam1">';
     public $paramInputUpdate = '<input placeholder="Choose code to load param update " type="text" class="form-control" id="rulePartnerSpecialParamUpdate1">';

    public function render()
    {
        $this->getList();
        $this->getListRuleSpecial();
        $this->getPartnerCode();
        return view('livewire.risk.partner-special-rule');
    }

    public $DetailInstructionUpdate = '';

    public function DetailUpdate($code){

        $params = [];
        if(!isset($code) or empty($code)){
            $this->DetailInstructionUpdate = "Detail Instruction here! Please choose your special code first!";
            return;
        }

        $params['filter']['code'] = $code;

        $data = ruleSpecialConnection::getList($params);

        if(isset($data->data)){
            foreach($data->data as $data){
                $this->DetailInstructionUpdate = $data->detail;
            }
            // dd($this->DetailInstruction);
        }
    }

    public $DetailInstruction = '';

    public function Detail($code){

        $params = [];
        if(!isset($code) or empty($code)){
            $this->DetailInstruction = "Detail Instruction here! Please choose your special code first!";
            return;
        }

        $params['filter']['code'] = $code;

        $data = ruleSpecialConnection::getList($params);

        if(isset($data->data)){
            foreach($data->data as $data){
                $this->DetailInstruction = $data->detail;
            }
            // dd($this->DetailInstruction);
        }

    }


    public function UpdatePartnerRuleSpecial($id, $partnerCode, $ruleCode, $obj){
        foreach($obj as $objCheck){

            if(!is_numeric($objCheck)){
                $this->message = "Param value must be numberic!";
                return;
            }
        }


        $params['partner_code'] = $partnerCode;
        $params['rule_code'] = $ruleCode;
        $params['param'] = $obj;

        $result = PartnerSpecialRuleConnection::edit($id, $params);
        if($result){
            $this->message = "Update successfully! Rule Code: ".$ruleCode.
            " Partner Code: ".$partnerCode;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::RISK_MANAGEMENT_PARTNER_SPECIAL_RULE, "Sửa partner special rule", compact('params')));
        }else{
            $this->message = "RuleCode existed already Rule Code: ". $ruleCode;
        }
    }



    public $count = 1;
    public function addMoreParamsPartnerSpecial(){
        $this->count++;
        $this->paramInput = $this->paramInput . '<input style="margin-top: 5px" placeholder="Enter your param ' .$this->count. '" type="text" class="form-control" id="rulePartnerSpecialParam' .$this->count. '">';
    }

    public $idUpdatePartnerSpecial;
    public function getIDUpdatePartCodeSpecial($id){
        $this->idUpdatePartnerSpecial = $id;
    }
    public $countUpdate = 0;
    public function getParamSpecialUpdate($code, $id, $partnerCode){
        // $this->idUpdatePartnerSpecial = $id;
        $this->paramInputUpdate = '';
        $inum = 0;
        $params['filter']['rule_code'] = $code;
        $params['filter']['partner_code'] = $partnerCode;
        $data = PartnerSpecialRuleConnection::getList($params);

        $paramAll = [];
        if(isset($data->data)){
            foreach($data->data as $dataParam){
                $paramAll = json_decode($dataParam->rule_param);
                // dd($paramAll->allParam);
                foreach($paramAll->allParam as $key=>$value){
                    // dd($key. '-'. $value);
                    $inum++;
                    $this->paramInputUpdate =$this->paramInputUpdate . '<span> '.$key.' </span><input value="'.$value.'" key="'.$key.'" style="margin-top: 5px" placeholder="Enter your param[' .$key. '] value " type="text" class="form-control" id="rulePartnerSpecialParamUpdate' .$inum. '">';
                }
            }
        }

        $this->countUpdate = $inum;


    }



    public function getParamSpecial($code){
        $this->paramInput =  '';

        $params = [];
        if(isset($code)){
            $params['filter']['code'] = $code;
        }

        $data = ruleSpecialConnection::getList($params);
        if(isset($data->data)){
            foreach($data->data as $dataParam){
                $paramSpecial = json_decode($dataParam->param);
                // dd($this->paramSpecial->allParam);

                $count = count($paramSpecial->allParam);
                $this->countNum = $count;
                $this->paramInput = '';

                $inum = 0;
                foreach($paramSpecial->allParam as $ps){
                    $inum++;
                    $this->paramInput = $this->paramInput .
                    '<lable> '.$ps.'</lable>'.
                    '
                    <input key="'.$ps.'" style="margin-top: 5px" placeholder="Enter your param[' .$ps. '] value " type="text" class="form-control" id="rulePartnerSpecialParam' .$inum. '">
                    ';
                }

            }


        }

    }

    public function resetMessage(){
        unset($this->message);
    }

    public function deletePartnerRuleSpecial($id){
        $result = PartnerSpecialRuleConnection::delete($id);
        if($result){
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::RISK_MANAGEMENT_PARTNER_SPECIAL_RULE, "Xoá partner special rule", compact('id')));
        }
    }

    public $message;

    public function addNewPartnerRuleSpecial($partner_code, $code, $obj){

        foreach($obj as $objCheck){

            if(!is_numeric($objCheck)){
                $this->message = "Param value must be numberic!";
                return;
            }
        }

        $params['param'] = (array)$obj;

        $params['partner_code'] = $partner_code;
        $params['rule_code'] = $code;

        $result = PartnerSpecialRuleConnection::add($params);

        if($result){
            $this->message = "Add new successfully! Rule Code: ".$code.
            " Partner Code: ".$partner_code;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::RISK_MANAGEMENT_PARTNER_SPECIAL_RULE, "Sửa partner special rule", compact('params')));
        }else{
            $this->message = "RuleCode existed already Rule Code: ". $code;
        }

    }
    public $partnerCodelist = [];
    public function getPartnerCode(){
        $params = [];
        $params['pagination']['limit'] = 100000;
        $partnerCodelist = PartnerConnection::getList($params);

        if(isset($partnerCodelist->data)){
            foreach($partnerCodelist->data as $list){
                $this->partnerCodelist[] = $list->partner_code;
            }
        }
    }

    public $listRuleSpecial;
    public function getListRuleSpecial(){
        $params = [];

        $data = ruleSpecialConnection::getList($params);
        if(isset($data->data)){
            $this->listRuleSpecial = $data->data;
        }
        // dd($this->listRuleSpecial);
    }

    public $startTime;
    public $endTime;

    public function getList(){
        $params = [];
        $params['sort']['id'] = 'desc';
        if(isset($this->ruleCode)){
            $params['filter']['rule_code'] = $this->ruleCode;
        }

        if(isset($this->getPageCurrent)){
            $params['pagination']['page'] = $this->getPageCurrent;
        }

        if(isset($this->startTime)){
            $params['filter']['start_time'] = $this->startTime;
        }

        if(isset($this->endTime)){
            $params['filter']['end_time'] = $this->endTime;
        }

        if(isset($this->partnerCode)){
            $params['filter']['partner_code'] = $this->partnerCode;
        }


        $data = PartnerSpecialRuleConnection::getList($params);
        // dd($data);
        if(isset($data->data)){
            $this->partnerSpecialRuleList = $data->data;
        }
        if(isset($data->meta)){
            $this->pageCurrent = $data->meta->page_current;
            $this->total = $data->meta->total_pages;
        }
    }

    public function getCurrentPage($page){
        $this->getPageCurrent = $page;
        if($this->getPageCurrent < 1){
            $this->getPageCurrent = 1;
        }
        if($this->getPageCurrent > $this->total){
            $this->getPageCurrent = $this->total;
        }
    }

    public $partnerCode;

    public function searchPartnerSpecialCode($ruleCode, $startTime, $endTime, $partnerCode){
        $this->ruleCode = $ruleCode;

        if(isset($startTime) and !empty($startTime)){
            $this->startTime = strtotime($startTime);
        }else{
            $this->startTime = '';
        }

        if(isset($endTime) and !empty($endTime)){
            $this->endTime = strtotime($endTime);
        }else{
            $this->endTime = '';
        }

        $this->partnerCode = $partnerCode;
    }
}
