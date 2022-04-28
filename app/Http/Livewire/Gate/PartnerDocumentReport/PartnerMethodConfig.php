<?php

namespace App\Http\Livewire\Gate\PartnerDocumentReport;

use Livewire\Component;
use App\Connection\partnerDocumentReportConnection;
use App\Connection\PartnerConnection;

class PartnerMethodConfig extends Component
{

    protected $listeners = [
        'searchPartnerConfigMethod' => 'searchPartnerConfigMethod',
        'addBankcodeCCList' => 'addBankcodeCCList',
        'addnewPartnerMethodConfig' => 'addnewPartnerMethodConfig',
        'addBankcodeEWALLETList' => 'addBankcodeEWALLETList',
        'addBankcodeVAList' => 'addBankcodeVAList',
        'deletePartnerMethodConfig' => 'deletePartnerMethodConfig',
        'updatePaymentMethodConfig' => 'updatePaymentMethodConfig',
        'removeaddBankcodeCCList' => 'removeaddBankcodeCCList',
        'removeaddBankcodeEWALLETList' => 'removeaddBankcodeEWALLETList',
        'removeaddBankcodeVAList' => 'removeaddBankcodeVAList',
        'resetMessage' => 'resetMessage',
        'addBankcodeMMList' => 'addBankcodeMMList',
        'removeaddBankcodeMMList' => 'removeaddBankcodeMMList'
    ];

    public function render()
    {

        $this->partnerDocumentReportConnectionList();
        $this->getListPaymentBankcodeConfig();
        $this->getListPartner();
        return view('livewire.gate.partner-document-report.partner-method-config', [
            'listPartnerMethodConfig' => $this->listPartnerMethodConfig,
            'bankCodeList' => $this->bankCodeList,
            'dataListPartner' => $this->dataListPartner
        ]);
    }

    protected $dataListPartner;

    public function getListPartner(){
        $params['pagination']['limit'] = 10000;
        $data = PartnerConnection::getList($params);
        if(isset($data->data)){
            $this->dataListPartner = $data->data;
        }
    }

    public function checkPartnerCode($partnerCode){
        $params = [];
        $params['pagination']['limit'] = '10000';
        $data = PartnerConnection::getList($params);
        $list = [];

            if(isset($data->data)){
                foreach($data->data as $data){
                    $list[] = $data->partner_code;
                }
                if(in_array($partnerCode, $list)){
                    return true;
                }
            }

        return false;
    }


    // public function checkPartnerCode($partnerCode){
    //     $params = [];
    //     $data = PartnerConnection::getList($params);
    //     $list = [];
    //     if(isset($data->meta->total)){
    //         $params['pagination']['limit'] = $data->meta->total;
    //         $data = PartnerConnection::getList($params);
    //         if(isset($data->data)){
    //             foreach($data->data as $data){
    //                 $list[] = $data->partner_code;
    //             }
    //             if(in_array($partnerCode, $list)){
    //                 return true;
    //             }
    //         }
    //     }
    //     return false;
    // }


    public function updatePaymentMethodConfig($PartnerCodeUpdate, $ATMupdate, $bankcode, $id){

        $checkPartnerCode = $this->checkPartnerCode($PartnerCodeUpdate);
        if(!$checkPartnerCode){
            $this->message = "Không tồn tại PartnerCode: ". $PartnerCodeUpdate;
            $this->warning = true;


            $this->emit('resultScript', [
                'warning' => $this->warning,
                'message' => $this->message
            ]);

            return;
        }

        $params = [];
        $params['id'] = $id;
        if(isset($PartnerCodeUpdate)){
            $params['partner_code'] = $PartnerCodeUpdate;
        }

        if(isset($ATMupdate) and $ATMupdate != "null"){
            $params['payment_method_config']['ATM'] = $ATMupdate;
        }

        if(isset($bankcode['CC'])){
            $params['payment_method_config']['CC'] = array_unique($bankcode['CC']);
        }
        if(isset($bankcode['EWALLET'])){
            $params['payment_method_config']['EWALLET'] = array_unique($bankcode['EWALLET']);
        }
        if(isset($bankcode['VA'])){
            $params['payment_method_config']['VA'] = array_unique($bankcode['VA']);
        }


        if(isset($bankcode['MM'])){
            $params['payment_method_config']['MM'] = array_unique($bankcode['MM']);
        }else{
            $bankcode['MM'] = [];
            $params['payment_method_config']['MM'] = array_unique($bankcode['MM']);
        }

        $result = partnerDocumentReportConnection::updatePaymentBankcodeConfig($params);

        if(!$result){
            $this->message = "Bạn đã update thất bại PartnerCode: ". $PartnerCodeUpdate;
            $this->warning = true;

            $this->emit('resultScript', [
                'warning' => $this->warning,
                'message' => $this->message
            ]);


            return;
        }
        if($result->success){
            $this->message = "Bạn đã update thành công PartnerCode: ". $PartnerCodeUpdate;
            $this->warning = false;


            $this->emit('resultScript', [
                'warning' => $this->warning,
                'message' => $this->message
            ]);

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_PAYMENT_CONFIG, "Cấu hình thanh toán PARTNER #PARAMS" . json_encode($params), compact('params')));

            return;
        }else{
            $this->message = "Bạn đã update thất bại PartnerCode: ". $PartnerCodeUpdate;
            $this->warning = true;


            $this->emit('resultScript', [
                'warning' => $this->warning,
                'message' => $this->message
            ]);

            return;
        }

    }


    public function deletePartnerMethodConfig($id){
        $params = [];
        $params['id'] = $id;
        $result = partnerDocumentReportConnection::deletePaymentBankcodeConfig($params);
        if(!$result){
            return;
        }
        if($result->success){
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_PAYMENT_CONFIG, "Cấu hình thanh toán PARTNER #PARAMS" . json_encode($params), compact('id')));
        }
    }


    public $message;
    public $warning = false;

    public function resetMessage(){
        unset($this->message);
        unset($this->warning);
    }

    public $bankcodeCC = [];
    public $bankcodeEWALLET = [];
    public $bankcodeVA = [];

    public $bankcodeMM = [];
    // removeaddBankcodeVAList

    public function removeaddBankcodeVAList($bankcodeVA){
        if(in_array($bankcodeVA, $this->bankcodeVA)){
            if (($key = array_search($bankcodeVA, $this->bankcodeVA)) !== false) {
                unset($this->bankcodeVA[$key]);
            }
        }else{
            $this->message = "Không tồn tại Bank Code: ". $bankcodeVA;
            $this->warning = true;
        }

        // dd($this->bankcodeCC);
    }


    public function removeaddBankcodeEWALLETList($bankcodeEWALLET){
        if(in_array($bankcodeEWALLET, $this->bankcodeEWALLET)){
            if (($key = array_search($bankcodeEWALLET, $this->bankcodeEWALLET)) !== false) {
                unset($this->bankcodeEWALLET[$key]);
            }
        }else{
            $this->message = "Không tồn tại Bank Code: ". $bankcodeEWALLET;
            $this->warning = true;
        }

        // dd($this->bankcodeCC);
    }

    public function removeaddBankcodeCCList($bankcodeCC){
        if(in_array($bankcodeCC, $this->bankcodeCC)){
            if (($key = array_search($bankcodeCC, $this->bankcodeCC)) !== false) {
                unset($this->bankcodeCC[$key]);
            }
        }else{
            $this->message = "Không tồn tại Bank Code: ". $bankcodeCC;
            $this->warning = true;
        }

        // dd($this->bankcodeCC);
    }

    public function removeaddBankcodeMMList($bankcodeMM){
        if(in_array($bankcodeMM, $this->bankcodeMM)){
            if (($key = array_search($bankcodeMM, $this->bankcodeMM)) !== false) {
                unset($this->bankcodeMM[$key]);
            }
        }else{
            $this->message = "Không tồn tại Bank Code: ". $bankcodeMM;
            $this->warning = true;
        }

        // dd($this->bankcodeCC);
    }


    public function addBankcodeMMList($bankcodeMM){
        if(!in_array($bankcodeMM, $this->bankcodeMM) and !empty($bankcodeMM)){
            $this->bankcodeMM[] = $bankcodeMM;
        }else{
            $this->message = "Không được để trống MM BankCode hoặc bạn đã add Bank Code: ". $bankcodeMM;
            $this->warning = true;
        }

    }

    public function addBankcodeCCList($bankcodeCC){
        if(!in_array($bankcodeCC, $this->bankcodeCC) and !empty($bankcodeCC)){
            $this->bankcodeCC[] = $bankcodeCC;
        }else{
            $this->message = "Không được để trống CC BankCode hoặc bạn đã add Bank Code: ". $bankcodeCC;
            $this->warning = true;
        }

    }

    public function addBankcodeEWALLETList($bankcodeEWALLET){
        if(!in_array($bankcodeEWALLET, $this->bankcodeEWALLET) and !empty($bankcodeEWALLET)){
            $this->bankcodeEWALLET[] = $bankcodeEWALLET;
        }else{
            $this->message = "Không được để trống EWALLET BankCode hoặc bạn đã add Bank Code: ". $bankcodeEWALLET;
            $this->warning = true;
        }
    }

    public function addBankcodeVAList($bankcodeVA){
        if(!in_array($bankcodeVA, $this->bankcodeVA) and !empty($bankcodeVA)){
            $this->bankcodeVA[] = $bankcodeVA;
        }else{
            $this->message = "Không được để trống VA BankCode hoặc bạn đã add Bank Code: ". $bankcodeVA;
            $this->warning = true;
        }
    }


    public function addnewPartnerMethodConfig(
        $partnerCodeAddnew,
        $startTimeAddnew,
        $endTimeAddnew,
        $atm,
        $cc, $ewallet, $va, $mm
    ){


        $checkPartnerCode = $this->checkPartnerCode($partnerCodeAddnew);
        if(!$checkPartnerCode){
            $this->message = "Không tồn tại PartnerCode: ". $partnerCodeAddnew;
            $this->warning = true;
            return;
        }

        $params = [];
        if(!empty($partnerCodeAddnew)){
            $params['partner_code'] = $partnerCodeAddnew;
        }
        if(!empty($startTimeAddnew)){
            $params['start_time'] = strtotime($startTimeAddnew);
        }
        if(!empty($endTimeAddnew)){
            $params['end_time'] = strtotime($endTimeAddnew);
        }

        // dd($atm);

        $params['payment_method_config']['ATM'] = $atm;

        if(!empty($this->bankcodeCC)){
            $params['payment_method_config']['CC'] = $this->bankcodeCC;
        }else{
            if(!empty($cc)){
                $params['payment_method_config']['CC'] = [$cc];
            }
        }

        if(!empty($this->bankcodeMM)){
            $params['payment_method_config']['MM'] = $this->bankcodeMM;
        }else{
            if(!empty($mm)){
                $params['payment_method_config']['MM'] = [$mm];
            }
        }

        if(!empty($this->bankcodeEWALLET)){
            $params['payment_method_config']['EWALLET'] = $this->bankcodeEWALLET;
        }else{
            if(!empty($ewallet)){
                $params['payment_method_config']['EWALLET'] = [$ewallet];
            }
        }

        if(!empty($this->bankcodeVA)){
            $params['payment_method_config']['VA'] = $this->bankcodeVA;
        }else{
            if(!empty($va)){
                $params['payment_method_config']['VA'] = [$va];
            }
        }
         // dd($params);

        $result = partnerDocumentReportConnection::addPaymentBankcodeConfig($params);
        if(!$result){
            $this->message = "Partner code " . $partnerCodeAddnew . " đã được config";
            $this->warning = true;
            $this->emit('resultScript', [
                'warning' => $this->warning,
                'message' => $this->message
            ]);
            return;
        }
        if($result->success){

            $this->message = "Thêm config mới thành công. PartnerCode: " . $partnerCodeAddnew;
            $this->warning = false;

            $this->emit('resultScript', [
                'warning' => $this->warning,
                'message' => $this->message
            ]);

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_PAYMENT_CONFIG, "Cấu hình thanh toán PARTNER #PARAMS" . json_encode($params), compact('params')));
            return;

        }else{
            $this->message = "Thêm config thất bại. " .$result->message;
            $this->warning = true;

            $this->emit('resultScript', [
                'warning' => $this->warning,
                'message' => $this->message
            ]);

            return;
        }

    }

    protected $bankCodeList;

    public function getListPaymentBankcodeConfig(){
        $params = [];
        $data = partnerDocumentReportConnection::getListPaymentBankcodeConfig($params);
        // dd($data->data->data->list);
        if(isset($data->data->data->list)){
            $this->bankCodeList = $data->data->data->list;

        }

         // dd($this->bankCodeList);

    }


    public function searchPartnerConfigMethod($partnerCode, $startTime, $endTime){
        $this->partnerCode = $partnerCode;

        if(isset($startTime) and !empty($startTime)){
            $this->startTime = strtotime($startTime);
        }else{
            unset($this->startTime);
        }

        if(isset($endTime) and !empty($endTime)){
            $this->endTime = strtotime($endTime);
        }else{
            unset($this->endTime);
        }


    }

    protected $listPartnerMethodConfig;

    public $partnerCode;
    public $startTime;
    public $endTime;

    public $currentPage;
    public $totalPage;
    public $part = 10;
    public $pageCurrent;
    public $start;
    public $end;

    public function partnerDocumentReportConnectionList(){
        $params = [];
        $params['sort']['id'] = 'desc';

        if(isset($this->partnerCode)){
            $params['filter']['partner_code'] = $this->partnerCode;
        }

        if(isset($this->startTime)){
            $params['filter']['start_time'] = $this->startTime;
        }

        if(isset($this->endTime)){
            $params['filter']['end_time'] = $this->endTime;
        }

        if(isset($this->pageCurrent)){
            $params['pagination']['page'] = $this->pageCurrent;
        }


        $data = partnerDocumentReportConnection::getListPaymentMethodConfig($params);

        if(isset($data->data)){
            $this->listPartnerMethodConfig = $data->data;
            foreach($this->listPartnerMethodConfig->data as $list){
                $list->payment_method_config_json = $list->payment_method_config;
                $list->payment_method_config = json_decode($list->payment_method_config);
            }
        }

        if(isset($data->data->meta->page_current)){
            $this->currentPage = $data->data->meta->page_current;
        }

        if(isset($data->data->meta->total_pages)){
            $this->totalPage = $data->data->meta->total_pages;
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
}
