<?php

namespace App\Http\Livewire\Gate\PartnerDocumentReport;

use Livewire\Component;
use App\Connection\partnerPaygateFeeConfigConnection;
use Illuminate\Http\Request;
use App\Connection\PartnerConnection;

class PartnerPaygateFeeConfig extends Component
{
    protected $listeners = [
        'searchPartnerPaygateFee' => 'searchPartnerPaygateFee',
        'deletePartnerPaygateFeeConfig' => 'deletePartnerPaygateFeeConfig',
        'resetList' => 'resetList',
        'getFirstDataSession' => 'getFirstDataSession',
        'changeBankcodeCC' => 'changeBankcodeCC',
        'changeBankcodeEWALLET' => 'changeBankcodeEWALLET',
        'changeBankcodeVA' => 'changeBankcodeVA',
        'changeBankcodeMM' => 'changeBankcodeMM'
    ];
    public function render()
    {
        $this->getListPartner();
        // $this->getList();
        // $this->getListPaygateBankcodeConfig();
        return view('livewire.gate.partner-document-report.partner-paygate-fee-config', [
            'listPartnerPaygateConfig' => $this->getList(),
            'listBankcode' => $this->getListPaygateBankcodeConfig(),
            'dataListPartner' => $this->dataListPartner
        ]);
    }

    // public function getFirstDataSession($formData){
    //     $value = session('key', $formData);
    //     dd(request($formData)->all());
    // }

    public $checkValidateCC = 'all';
    public $checkValidateEWALLET = 'all';
    public $checkValidateVA = 'all';
    public $checkValidateMM = 'all';

    public function mount()
    {
        if (session()->has('alerts')) {
            $this->partner_code = "";
            session()->forget('alerts');
        }
    }

    public function changeBankcodeCC(){
        $this->checkValidateCC = 'bankcode';
    }

    public function changeBankcodeEWALLET(){
        $this->checkValidateEWALLET = 'bankcode';
    }

    public function changeBankcodeVA(){
        $this->checkValidateVA = 'bankcode';
    }

    public function changeBankcodeMM(){
        $this->checkValidateMM = 'bankcode';
    }

    public function resetList(){
        $this->partner_code = "";
    }

    public $partnerCodeModel;
    public $partnerCodeModelUpdate;
    public $messageCheckPartnerCodeModel;
    public $messageCheckPartnerCodeModelUpdate;

    public function checkPartnerCodeChange(){
        $checkPartnerCode = $this->checkPartnerCode($this->partnerCodeModel);
        if(!$checkPartnerCode){
            $this->messageCheckPartnerCodeModel = "PartnerCode không tồn tại!";
        }else{
            unset($this->messageCheckPartnerCodeModel);
        }
    }

    public function checkPartnerCodeChangeUpdate(){
        $checkPartnerCode = $this->checkPartnerCode($this->partnerCodeModel);
        if(!$checkPartnerCode){
            $this->messageCheckPartnerCodeModelUpdate = "PartnerCode không tồn tại!";
        }else{
            unset($this->messageCheckPartnerCodeModelUpdate);
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


    protected $dataListPartner;

    public function getListPartner(){
        $params['pagination']['limit'] = 10000;
        $data = PartnerConnection::getList($params);
        if(isset($data->data)){
            $this->dataListPartner = $data->data;
        }
    }




    public $partner_code;
    public $startTime;
    public $endTime;

    public $start;
    public $end;
    public $currentPage;
    public $pageCurrent;
    public $part = 10;
    public $totalPage;

    public function getListPaygateBankcodeConfig(){
        $params = [];
        $result = partnerPaygateFeeConfigConnection::getListPaygateBankcodeConfig($params);

        if(isset($result->data->list)){
            return $result->data->list;
        }

        return null;
    }

    public $partnerCodeAddnew;

    public function deletePartnerPaygateFeeConfig($id){
        $params['id'] = $id;
        $result = partnerPaygateFeeConfigConnection::delete($params);
        if(!$result){
            return;
        }
        if(isset($result->success) and $result->success){
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_PAYGATE_FEE_CONFIG, "Xóa cấu hình phí Paygate Partner thành công #PARAMS: ". json_encode($params), compact('params')));
        }
    }


    public function getList(){
        $params = [];
        $params['sort']['id'] = 'desc';
        if(isset($this->partner_code)){
            $params['filter']['partner_code'] = $this->partner_code;
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

        $data = partnerPaygateFeeConfigConnection::getList($params);

        // dump($data);

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


        if(isset($data->data->data)){
            foreach($data->data->data as $listFee){
                $listFee->feeDisplay = json_decode($listFee->fee);
            }
            return $data->data->data;
        }
        // dd($data);

        return null;
    }

    public function exportCSV(Request $request){
        $params = [];
        $params['sort']['id'] = 'desc';
        $params['pagination']['limit'] = 10000;
        if(isset($request->partner_code)){
            $params['filter']['partner_code'] = $request->partner_code;
        }

        if(isset($request->startTime)){
            $params['filter']['start_time'] = strtotime($request->startTime);
        }

        if(isset($request->endTime)){
            $params['filter']['end_time'] = strtotime($request->endTime);
        }

        $data = partnerPaygateFeeConfigConnection::getList($params);

        $meta = $data->data->meta;
        $pages = $meta->total_pages;
        $page = $meta->page_current;

        $begin = microtime(true);

        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $fileName = date('YmdHis', time());
        header('Content-Type: application/vnd.ms-execl');
        header('Content-Disposition: attachment;filename="' . $fileName . '.csv"');

        $handle = fopen("php://output", 'a');
        fputs($handle, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));


        $header = [
            'ID',
            'PARTNER CODE',
            'CONTRACT NUMBER',
            'CREATE AT',
            'UPDATE_AT',
            'ATM_TRANSACTION_FEE',
            'ATM_PAYMENT_FEE',
            'CC_VISA_TRANSACTION_FEE',
            'CC_VISA_PAYMENT_FEE',
            'CC_MASTERCARD_TRANSACTION_FEE',
            'CC_MASTERCARD_PAYMENT_FEE',
            'EWALLET_APPOTA_TRANSACTION_FEE',
            'EWALLET_APPOTA_PAYMENT_FEE',
            'EWALLET_MOMO_TRANSACTION_FEE',
            'EWALLET_MOMO_PAYMENT_FEE',
            'EWALLET_MOCA_TRANSACTION_FEE',
            'EWALLET_MOCA_PAYMENT_FEE',
            'EWALLET_SHOPEEPAY_TRANSACTION_FEE',
            'EWALLET_SHOPEEPAY_PAYMENT_FEE',
            'EWALLET_VNPAY_TRANSACTION_FEE',
            'EWALLET_VNPAY_PAYMENT_FEE',
            'VA_WOORIBANK_TRANSACTION_FEE',
            'VA_WOORIBANK_PAYMENT_FEE',
            'VA_VIETCAPITALBANK_TRANSACTION_FEE',
            'VA_CAPITALBANK_PAYMENT_FEE',
            'MM_TRANSACTION_FEE',
            'MM_PAYMENT_FEE',
        ];

        fputcsv($handle, $header);

        if($pages >= 1){
            for ($i=1; $i <= $pages ; $i++) {
                $params['pagination']['page'] = $i;
                // $params['filter']['id'] = 34;
                $data = partnerPaygateFeeConfigConnection::getList($params)->data;

                foreach($data->data as $dataCSV){

                    $dataCSV->fee = json_decode($dataCSV->fee);

                    if(isset($dataCSV->fee->ATM->ALL->transFee)){
                        $dataCSV->ATM_TRANSACTION_FEE = $dataCSV->fee->ATM->ALL->transFee;
                    }else{
                        $dataCSV->ATM_TRANSACTION_FEE = "";
                    }

                    if(isset($dataCSV->fee->ATM->ALL->transPercentFee)){
                        $dataCSV->ATM_PAYMENT_FEE = $dataCSV->fee->ATM->ALL->transPercentFee;
                    }else{
                        $dataCSV->ATM_PAYMENT_FEE = "";
                    }

                    // cc all

                    // if(isset($dataCSV->fee->CC->ALL->transFee)){
                    //     $dataCSV->CC_TRANSACTION_FEE = $dataCSV->fee->CC->ALL->transFee;
                    // }else{
                    //     $dataCSV->CC_TRANSACTION_FEE = "";
                    // }

                    // if(isset($dataCSV->fee->CC->ALL->transPercentFee)){
                    //     $dataCSV->CC_PAYMENT_FEE = $dataCSV->fee->CC->ALL->transPercentFee;
                    // }else{
                    //     $dataCSV->CC_PAYMENT_FEE = "";
                    // }

                    // cc VISA
                    if(isset($dataCSV->fee->CC->VISA->transFee)){
                        $dataCSV->CC_VISA_TRANSACTION_FEE = $dataCSV->fee->CC->VISA->transFee;
                    }else{
                        $dataCSV->CC_VISA_TRANSACTION_FEE = isset($dataCSV->fee->CC->ALL->transFee)?$dataCSV->fee->CC->ALL->transFee:"0";
                    }

                    if(isset($dataCSV->fee->CC->VISA->transPercentFee)){
                        $dataCSV->CC_VISA_PAYMENT_FEE = $dataCSV->fee->CC->VISA->transPercentFee;
                    }else{
                        $dataCSV->CC_VISA_PAYMENT_FEE =  isset($dataCSV->fee->CC->ALL->transPercentFee)?$dataCSV->fee->CC->ALL->transPercentFee:'0';
                    }

                    // cc MASTERCARD


                    if(isset($dataCSV->fee->CC->MASTERCARD->transFee)){
                        $dataCSV->CC_MASTERCARD_TRANSACTION_FEE = $dataCSV->fee->CC->MASTERCARD->transFee;
                    }else{
                        $dataCSV->CC_MASTERCARD_TRANSACTION_FEE = isset($dataCSV->fee->CC->ALL->transFee)?$dataCSV->fee->CC->ALL->transFee:"0";
                    }

                    if(isset($dataCSV->fee->CC->MASTERCARD->transPercentFee)){
                        $dataCSV->CC_MASTERCARD_PAYMENT_FEE = $dataCSV->fee->CC->MASTERCARD->transPercentFee;
                    }else{
                        $dataCSV->CC_MASTERCARD_PAYMENT_FEE =  isset($dataCSV->fee->CC->ALL->transPercentFee)?$dataCSV->fee->CC->ALL->transPercentFee:'0';
                    }


                    // EWALLET BANKCODE

                    if(isset($dataCSV->fee->EWALLET->APPOTA->transFee)){
                        $dataCSV->EWALLET_APPOTA_TRANSACTION_FEE = $dataCSV->fee->EWALLET->APPOTA->transFee;
                    }else{
                        $dataCSV->EWALLET_APPOTA_TRANSACTION_FEE = isset($dataCSV->fee->EWALLET->ALL->transFee)?$dataCSV->fee->EWALLET->ALL->transFee:"0";
                    }

                    if(isset($dataCSV->fee->EWALLET->APPOTA->transPercentFee)){
                        $dataCSV->EWALLET_APPOTA_PAYMENT_FEE = $dataCSV->fee->EWALLET->APPOTA->transPercentFee;
                    }else{
                        $dataCSV->EWALLET_APPOTA_PAYMENT_FEE =  isset($dataCSV->fee->EWALLET->ALL->transPercentFee)?$dataCSV->fee->EWALLET->ALL->transPercentFee:'0';
                    }

                    if(isset($dataCSV->fee->EWALLET->MOMO->transFee)){
                        $dataCSV->EWALLET_MOMO_TRANSACTION_FEE = $dataCSV->fee->EWALLET->MOMO->transFee;
                    }else{
                        $dataCSV->EWALLET_MOMO_TRANSACTION_FEE = isset($dataCSV->fee->EWALLET->ALL->transFee)?$dataCSV->fee->EWALLET->ALL->transFee:'0';
                    }

                    if(isset($dataCSV->fee->EWALLET->MOMO->transPercentFee)){
                        $dataCSV->EWALLET_MOMO_PAYMENT_FEE = $dataCSV->fee->EWALLET->MOMO->transPercentFee;
                    }else{
                        $dataCSV->EWALLET_MOMO_PAYMENT_FEE =  isset($dataCSV->fee->EWALLET->ALL->transPercentFee)?$dataCSV->fee->EWALLET->ALL->transPercentFee:'0';
                    }

                    if(isset($dataCSV->fee->EWALLET->MOCA->transFee)){
                        $dataCSV->EWALLET_MOCA_TRANSACTION_FEE = $dataCSV->fee->EWALLET->MOCA->transFee;
                    }else{
                        $dataCSV->EWALLET_MOCA_TRANSACTION_FEE = isset($dataCSV->fee->EWALLET->ALL->transFee)?$dataCSV->fee->EWALLET->ALL->transFee:'0';
                    }

                    if(isset($dataCSV->fee->EWALLET->MOCA->transPercentFee)){
                        $dataCSV->EWALLET_MOCA_PAYMENT_FEE = $dataCSV->fee->EWALLET->MOCA->transPercentFee;
                    }else{
                        $dataCSV->EWALLET_MOCA_PAYMENT_FEE = isset($dataCSV->fee->EWALLET->ALL->transPercentFee)?$dataCSV->fee->EWALLET->ALL->transPercentFee:'0';
                    }

                    if(isset($dataCSV->fee->EWALLET->SHOPEEPAY->transFee)){
                        $dataCSV->EWALLET_SHOPEEPAY_TRANSACTION_FEE = $dataCSV->fee->EWALLET->SHOPEEPAY->transFee;
                    }else{
                        $dataCSV->EWALLET_SHOPEEPAY_TRANSACTION_FEE =  isset($dataCSV->fee->EWALLET->ALL->transFee)?$dataCSV->fee->EWALLET->ALL->transFee:'0';
                    }

                    if(isset($dataCSV->fee->EWALLET->SHOPEEPAY->transPercentFee)){
                        $dataCSV->EWALLET_SHOPEEPAY_PAYMENT_FEE = $dataCSV->fee->EWALLET->SHOPEEPAY->transPercentFee;
                    }else{
                        $dataCSV->EWALLET_SHOPEEPAY_PAYMENT_FEE = isset($dataCSV->fee->EWALLET->ALL->transPercentFee)?$dataCSV->fee->EWALLET->ALL->transPercentFee:'0';
                    }

                    if(isset($dataCSV->fee->EWALLET->VNPTWALLET->transFee)){
                        $dataCSV->EWALLET_VNPAY_TRANSACTION_FEE = $dataCSV->fee->EWALLET->VNPTWALLET->transFee;
                    }else{
                        $dataCSV->EWALLET_VNPAY_TRANSACTION_FEE = isset($dataCSV->fee->EWALLET->ALL->transFee)?$dataCSV->fee->EWALLET->ALL->transFee:'0';
                    }

                    if(isset($dataCSV->fee->EWALLET->VNPTWALLET->transPercentFee)){
                        $dataCSV->EWALLET_VNPAY_PAYMENT_FEE = $dataCSV->fee->EWALLET->VNPTWALLET->transPercentFee;
                    }else{
                        $dataCSV->EWALLET_VNPAY_PAYMENT_FEE = isset($dataCSV->fee->EWALLET->ALL->transPercentFee)?$dataCSV->fee->EWALLET->ALL->transPercentFee:'0';
                    }

                    if(isset($dataCSV->fee->VA->WOORIBANK->transFee)){
                        $dataCSV->VA_WOORIBANK_TRANSACTION_FEE = $dataCSV->fee->VA->WOORIBANK->transFee;
                    }else{
                        $dataCSV->VA_WOORIBANK_TRANSACTION_FEE = isset($dataCSV->fee->VA->ALL->transFee)?$dataCSV->fee->VA->ALL->transFee:'0';
                    }

                    if(isset($dataCSV->fee->VA->WOORIBANK->transPercentFee)){
                        $dataCSV->VA_WOORIBANK_PAYMENT_FEE = $dataCSV->fee->VA->WOORIBANK->transPercentFee;
                    }else{
                        $dataCSV->VA_WOORIBANK_PAYMENT_FEE = isset($dataCSV->fee->VA->ALL->transPercentFee)?$dataCSV->fee->VA->ALL->transPercentFee:'0';
                    }

                    if(isset($dataCSV->fee->VA->VIETCAPITALBANK->transFee)){
                        $dataCSV->VA_VIETCAPITALBANK_TRANSACTION_FEE = $dataCSV->fee->VA->VIETCAPITALBANK->transFee;
                    }else{
                        $dataCSV->VA_VIETCAPITALBANK_TRANSACTION_FEE = isset($dataCSV->fee->VA->ALL->transFee)?$dataCSV->fee->VA->ALL->transFee:'0';
                    }

                    if(isset($dataCSV->fee->VA->VIETCAPITALBANK->transPercentFee)){
                        $dataCSV->VA_CAPITALBANK_PAYMENT_FEE = $dataCSV->fee->VA->VIETCAPITALBANK->transPercentFee;
                    }else{
                        $dataCSV->VA_CAPITALBANK_PAYMENT_FEE = isset($dataCSV->fee->VA->ALL->transPercentFee)?$dataCSV->fee->VA->ALL->transPercentFee:'0';
                    }




                    if(isset($dataCSV->fee->MM->ALL->transFee)){
                        $dataCSV->MM_TRANSACTION_FEE = $dataCSV->fee->MM->ALL->transFee;
                    }else{
                        $dataCSV->MM_TRANSACTION_FEE = isset($dataCSV->fee->MM->ALL->transFee)?$dataCSV->fee->MM->ALL->transFee:'0';
                    }

                    if(isset($dataCSV->fee->MM->ALL->transPercentFee)){
                        $dataCSV->MM_PAYMENT_FEE = $dataCSV->fee->MM->ALL->transPercentFee;
                    }else{
                        $dataCSV->MM_PAYMENT_FEE = isset($dataCSV->fee->MM->ALL->transPercentFee)?$dataCSV->fee->MM->ALL->transPercentFee:'0';
                    }

                    unset($dataCSV->fee);

                    $dataCSV = (array)$dataCSV;

                    if(isset($dataCSV['created_at'])){
                        $dataCSV['created_at'] = date('d-m-Y H:i:s', $dataCSV['created_at']);
                    }

                    if(isset($dataCSV['updated_at'])){
                        $dataCSV['updated_at'] = date('d-m-Y H:i:s', $dataCSV['updated_at']);
                    }

                    fputcsv($handle, $dataCSV);
                }

            }
        }

        fclose($handle);
        ob_flush();
        flush();
        $end = microtime(true);
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



    public function searchPartnerPaygateFee($partnerCode, $startTime, $endTime){
        $this->partner_code = $partnerCode;
        if(!empty($startTime)){
            $this->startTime = strtotime($startTime);
        }else{
            unset($this->startTime);
        }

        if(!empty($endTime)){
            $this->endTime = strtotime($endTime);
        }else{
            unset($this->endTime);
        }
    }
}
