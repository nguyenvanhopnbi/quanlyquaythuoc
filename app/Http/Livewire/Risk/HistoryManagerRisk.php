<?php

namespace App\Http\Livewire\Risk;

use Livewire\Component;
use App\Connection\HistoryRiskManagerConnection;
use App\Connection\RiskManagementConnection;
use App\Connection\blackListIPConnection;
use App\Connection\PartnerMethodConnection;

use App\Connection\PartnerConnection;

class HistoryManagerRisk extends Component
{

    public $titleKey = [];
    protected $dataHis = [];

    protected $listeners = [
        'showHideColum' => 'showHideColum',
        'searchHistoryRisk' => 'searchHistoryRisk',
        'ExportHistoryRisk' => 'ExportHistoryRisk',
        'hisAddCardtoBlacklist' => 'hisAddCardtoBlacklist',
        'resetMessageHis' => 'resetMessageHis',
        'AddIPtoBlacklist' => 'AddIPtoBlacklist',
        'inactivePartnerCode' => 'inactivePartnerCode',
        'LoadingDelay' => 'LoadingDelay'
    ];

    public $filterLoading = 0;

    public function LoadingDelay(){
        $this->filterLoading = 1;
    }

    public function render()
    {
        $this->checkIPExist('1');
        $this->getPartnerCodeList();
        $this->getList();

        return view('livewire.risk.history-manager-risk', [
            'partnerCodeList' => $this->partnerCodeList,
            'dataHis' => $this->dataHis
        ]);
    }
    public function mount(){
        // $this->getListTitleCheck();
    }

    protected $partnerCodeList;
    public function getPartnerCodeList(){
        $params = [];
        $data = PartnerConnection::getList($params);
        if(isset($data->meta->total)){
            $params['pagination']['limit'] = $data->meta->total;
        }
        $data = PartnerConnection::getList($params);
        if(isset($data->data) or !empty($data->data)){
            $this->partnerCodeList = $data->data;
        }
        // dd($this->partnerCodeList);
    }

    public function inactivePartnerCode($partner_code, $payment_method){
        // dd($partner_code . '-' . $payment_method);
        $params['partner_code'] = $partner_code;
        $params['payment_method'] = $payment_method;

        $result = PartnerMethodConnection::add($params);
        if($result == "Cặp partner_code và payment_method đã tồn tại"){
            $this->message = "Partner Code: ".$partner_code. " and Payment Method ".$payment_method." are inactive already!";
            return;
        }
        if($result){
            $this->message = "Add Partner Code: ".$partner_code. " and Payment Method ".$payment_method." successfully!";

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_PAYMENT_METHOD, "Thêm mới Gate chặn PTTT"));

            return;
        }
    }

    public function AddIPtoBlacklist($ip){

        if($this->checkIPExist($ip)){
            $this->message = "IP: ".$ip." is in blacklist already";
            return;
        }

        $params = [];
        $params['ip'] = $ip;
        $result = blackListIPConnection::add($params);
        if($result){
            $this->message = "IP: ".$ip." add to blacklist successfully!";

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::RISK_MANAGEMENT_BLACKLIST_IP, "Thêm mới blacklist IP", compact('params')));

            return;
        }
    }

    public $IPblaclist = [];
    public function checkIPExist($ip){
        $params = [];
        $dataIP = blackListIPConnection::getList($params);
        if(isset($dataIP->meta->total_record)){
            $total = $dataIP->meta->total_record;
            $params['pagination']['limit'] = $total;
        }

        $dataIP = blackListIPConnection::getList($params);
        if(isset($dataIP->data)){
            foreach($dataIP->data as $data){
                $this->IPblaclist[] = $data->ip;
            }
        }
        if(in_array($ip, $this->IPblaclist)){
            return true;
        }
        return false;
    }

    public function resetMessageHis(){
        unset($this->message);
    }

    public $blacklistCardNumber = [];

    public function checkBlacklist($cardNumber){

        if(isset($cardNumber)){
            $sixFirstNumber = substr($cardNumber, 0, 6);
            $fourLastNumber = substr($cardNumber, -4);

            $cardNumber = $sixFirstNumber. '_'.$fourLastNumber;
        }

        $params = [];
        // $params['pagination']['limit'] = 20;
        $dataBlacklist = RiskManagementConnection::getBlackList($params);
        if(isset($dataBlacklist->data)){
            foreach($dataBlacklist->data as $data){
                $this->blacklistCardNumber[] = $data->card_number;
            }
            if(in_array($cardNumber, $this->blacklistCardNumber)){
                return true;
            }
        }
        return false;
    }


    public $message;
    public function hisAddCardtoBlacklist($cardNumber, $cardName){
        if(!isset($cardNumber)){
            return;
        }
        // dd($this->checkBlacklist($cardNumber));
        if($this->checkBlacklist($cardNumber)){
            $this->message = "This Card Number ". $cardNumber . " is in blacklist already!";
            return;
        }

        $sixFirstNumber = substr($cardNumber, 0, 6);
        $fourLastNumber = substr($cardNumber, -4);
        $cardNumber = $sixFirstNumber . '-'. $fourLastNumber;
        $params['card_number'] = $cardNumber;
        $params['card_name'] = $cardName;

        $result = RiskManagementConnection::addBlacklist($params);
        if($result){
            $this->message = "Card Number: ". $cardNumber. " add to blacklist successfully!";

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::RISK_MANAGEMENT_BLACKLIST, "Thêm  mới blacklist", compact('params')));
            return;
        }
    }

    public function getListTitleCheck(){
        $params = [];
        $params['pagination']['limit'] = 1;
        $dataHis = HistoryRiskManagerConnection::getList($params);
        if(isset($dataHis->data)){
            $dataTitleKey = $dataHis->data[0];
            foreach($dataTitleKey as $key=>$title){
                $this->titleKey[] = $key;
            }
        }
    }

    public $currentPage;
    public $totalPage;
    public $part = 5;
    public $start;
    public $end;

    public $pageCurrent;

    public $ruleCode;
    public $action;
    public $startTime;
    public $endTime;

    public $transaction_id;
    public $card_number;
    public $order_id;
    public $card_name;
    public $ip;
    public $amount;
    public $partnerCode;
    public $vendorCode;
    public $bankcode;
    public $status;

    public $totalRecord;


    protected $queryString = [
        'ruleCode' => ['except' => ''],
        'action' => ['except' => ''],
        'startTime' => ['except' => false],
        'endTime' => ['except' => false],
        'transaction_id' => ['except' => ''],
        'card_number' => ['except' => ''],
        'order_id' => ['except' => ''],
        'card_name' => ['except' => ''],
        'ip' => ['except' => ''],
        'amount' => ['except' => ''],
        'partnerCode' => ['except' => ''],
        'vendorCode' => ['except' => ''],
        'bankcode' => ['except' => ''],
        'status' => ['except' => ''],
    ];

    public function getList(){
        $params = [];
        $params['pagination']['limit'] = 20;
        $params['sort']['id'] = 'desc';
        if(isset($this->pageCurrent)){
            $params['pagination']['page'] = $this->pageCurrent;
        }
        if(isset($this->ruleCode) && !empty($this->ruleCode)){
            $params['filter']['rule_code'] = $this->ruleCode;
        }
        if(isset($this->action) && !empty($this->action)){
            $params['filter']['like']['where']['action'] = $this->action;
        }
        if(isset($this->startTime) && date($this->startTime)){
            $params['filter']['start_time'] = $this->startTime;
        }
        if(isset($this->endTime) && date($this->endTime)){
            $params['filter']['end_time'] = $this->endTime;
        }


        if(isset($this->transaction_id) && !empty($this->transaction_id)){
            $params['filter']['transaction_id'] = $this->transaction_id;
        }
        if(isset($this->card_number) && !empty($this->card_number)){
            $params['filter']['card_number'] = $this->card_number;
        }

        if(isset($this->order_id) && !empty($this->order_id)){
            $params['filter']['order_id'] = $this->order_id;
        }

        if(isset($this->card_name) && !empty($this->card_name)){
            $params['filter']['card_name'] = $this->card_name;
        }

        if(isset($this->ip) && !empty($this->ip)){
            $params['filter']['ip'] = $this->ip;
        }

        if(isset($this->amount) && !empty($this->amount)){
            $params['filter']['amount'] = $this->amount;
        }

        if(isset($this->partnerCode) && !empty($this->partnerCode)){
            $params['filter']['partner_code'] = $this->partnerCode;
        }

        if(isset($this->vendorCode) && !empty($this->vendorCode)){
            $params['filter']['vendor_code'] = $this->vendorCode;
        }

        if(isset($this->bankcode) && !empty($this->bankcode)){
            $params['filter']['bank_code'] = $this->bankcode;
        }
        if(isset($this->status) && !empty($this->status)){
            $params['filter']['transaction_status'] = $this->status;
        }

        $dataHis = HistoryRiskManagerConnection::getList($params);

        if(isset($dataHis->data)){
            $this->dataHis = $dataHis->data;
        }

        if(isset($dataHis->meta->page_current)){
            $this->currentPage = $dataHis->meta->page_current;
        }
        if(isset($dataHis->meta->total_pages)){
            $this->totalPage = $dataHis->meta->total_pages;
        }
        if(isset($dataHis->meta->total_record)){
            $this->totalRecord = $dataHis->meta->total_record;
        }


        // dump($dataHis->meta);
        if(!empty($dataHis->data)){
            $this->start = $this->currentPage - $this->part;
            if($this->start < 1){
                $this->start = 1;
            }
            $this->end = $this->currentPage + $this->part;
            if($this->end > $this->totalPage){
                $this->end = $this->totalPage;
            }
        }else{
            $this->start = 1;
            $this->end = 1;
        }
    }

    public $meta;

    public function getMetaPage($meta){
        $this->meta = $meta;
        return $this->meta;
    }



    public function searchHistoryRisk(
        $rule_code,
        $actionArray,
        $startTime,
        $endTime,
        $transaction_id,
        $card_number,
        $order_id,
        $card_name,
        $ip,
        $amount,
        $partnerCode,
        $vendorCode,
        $bankcode,
        $status


    ){
        // dd($startTime . '-' .$endTime);
        $this->ruleCode = $rule_code;
        $this->action = [];
        $this->action = $actionArray;

        $this->startTime = strtotime($startTime);
        $this->endTime = strtotime($endTime);

        $this->transaction_id = $transaction_id;

        $this->card_number = $card_number;

        $this->order_id = $order_id;

        $this->card_name = $card_name;

        $this->ip = $ip;

        $this->amount = $amount;

        $this->partnerCode = $partnerCode;

        $this->vendorCode = $vendorCode;

        $this->bankcode = $bankcode;

        $this->status = $status;


    }


    public function getCurrentPage($page){
        $this->pageCurrent = $page;
    }


    public function ExportHistoryRisk(
        $rule_code,
        $actionArray,
        $startTime,
        $endTime,

        $transaction_id,
        $card_number,
        $order_id,
        $card_name,
        $ip,
        $amount,
        $partnerCode,
        $vendorCode,
        $bankcode,
        $status

    ){

        return redirect()->route('risk-management.historyManagementExportCSV', [
                'rule_code' => $rule_code,
                'actionArray' => $actionArray,
                'startTime' => $startTime,
                'endTime' => $endTime,
                'transaction_id' => $transaction_id,
                'card_number' => $card_number,
                'order_id' => $order_id,
                'card_name' => $card_name,
                'ip' => $ip,
                'amount' => $amount,
                'partner_code' => $partnerCode,
                'vendor_code' => $vendorCode,
                'bank_code' => $bankcode,
                'transaction_status' => $status

            ]);


    }

    public $riskCodeFromBankDisplay = 'none';
    public $OrderInfo = 'none';
    public $OrderID = 'none';
    public $Transaction_status = 'none';
    public  $Action = 'none';
    public  $RuleCode = 'none';
    public  $VendorCode = 'none';
    public  $BankCode = 'none';
    public  $TimeResponse = 'none';
    public  $TimeRequest = '';
    public  $IP = '';
    public  $Amount = '';
    public  $PartnerCode = '';
    public  $TransactionID = '';
    public  $CardName = '';
    public  $CardNumber = '';
    public  $ID = '';

    public function showHideColum(
        $riskCodeFromBank,
        $OrderInfo,
        $Action,
        $RuleCode,
        $VendorCode,
        $BankCode,
        $TimeResponse,
        $TimeRequest,
        $IP,
        $Amount,
        $PartnerCode,
        $TransactionID,
        $CardName,
        $CardNumber,
        $ID,
        $OrderID,
        $Transaction_status

    ){
        $this->riskCodeFromBankDisplay = ($riskCodeFromBank)?'':'none';
        $this->OrderInfo = ($OrderInfo)?'':'none';
        $this->Action = ($Action)?'':'none';
        $this->RuleCode = ($RuleCode)?'':'none';
        $this->VendorCode = ($VendorCode)?'':'none';
        $this->BankCode = ($BankCode)?'':'none';
        $this->TimeResponse = ($TimeResponse)?'':'none';
        $this->TimeRequest = ($TimeRequest)?'':'none';
        $this->IP = ($IP)?'':'none';
        $this->Amount = ($Amount)?'':'none';
        $this->PartnerCode = ($PartnerCode)?'':'none';
        $this->TransactionID = ($TransactionID)?'':'none';
        $this->CardName = ($CardName)?'':'none';
        $this->CardNumber = ($CardNumber)?'':'none';
        $this->ID = ($ID)?'':'none';

        $this->OrderID = ($OrderID)?'':'none';
        $this->Transaction_status = ($Transaction_status)?'':'none';

    }

}
