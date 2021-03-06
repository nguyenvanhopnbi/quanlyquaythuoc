<?php

namespace App\Http\Livewire\Gate\BankVendorPaymentMethod;

use Livewire\Component;
use App\Connection\PartnerVendorConnection;
use App\Connection\PartnerConnection;
use App\Connection\BankVendorConnection;

class VendorPaymentMethod extends Component
{
    protected $listeners = [
        'search' => 'search',
        'addnew' => 'addnew',
        'update' => 'update',
        'delete' => 'delete',
        'getVendorCodePaymentMethod' => 'getVendorCodePaymentMethod'
    ];


    public function render()
    {
        $this->getList();
        return view('livewire.gate.bank-vendor-payment-method.vendor-payment-method', [
            'dataList' => $this->getList(),
            'partnerCodeList' => $this->getPartner(),
            'vendorCodeList' => $this->getVendorcode()
        ]);
    }

    public $partner_code;
    public $payment_method;

    public $payment_method_add_new = "";

    public $vendor_code;

    public $message;
    public $waring;

    public function getPartner(){
        $params['pagination']['limit'] = 10000;
        $data = PartnerConnection::getList($params);
        if(isset($data->data)){
            return $data->data;
        }

        return null;
    }



    public function getVendorcode(){
        $params = [];
        $params['pagination']['limit'] = 100000;
        $params['query']['payment_method'] = $this->payment_method_add_new;
        $data = BankVendorConnection::getList($params);
        if(isset($data->data)){
            return $data->data;
        }

        return null;
    }


    public function getVendorCodePaymentMethod($paymentMethod){
        $this->payment_method_add_new = $paymentMethod;
    }


    public function checkVendor($vendorCode){
        $params = [];
        $params['pagination']['limit'] = 100000;
        $data = BankVendorConnection::getList($params);
        if(isset($data->data)){
            foreach($data->data as $data){
                if($vendorCode == $data->vendor_code){
                    return true;
                }
            }
        }

        return null;
    }

    public function checkPartnerCode($partner_code){
        $params['pagination']['limit'] = 10000;
        $data = PartnerConnection::getList($params);
        if(isset($data->data)){
            foreach($data->data as $data){
                if($partner_code == $data->partner_code){
                    return true;
                }
            }
        }

        return false;
    }

    public function delete($id){
        $params['id'] = $id;
        $result = PartnerVendorConnection::deleteVendorMethod($params);
        if($result->success){
            $this->warning = false;
            $this->message = "B???n ???? x??a th??nh c??ng";

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::GATE_VENDOR_CONFIG, "X??a c???u h??nh vendor theo payment method th??nh c??ng #params: " . json_encode($params), compact('params')));

            $this->emit('messageScript', [
                'message' => $this->message,
                'warning' => $this->warning
            ]);
        }else{
            $this->warning = true;
            $this->message = "Kh??ng x??a ???????c";
        }

    }

    public function update($id, $partner_code, $payment_method, $vendor_code){

        // if(!$this->checkPartnerCode($partner_code)){
        //     $this->emit('messageScript', [
        //         'message' => 'Partner code kh??ng t???n t???i',
        //         'warning' => true
        //     ]);

        //     return;
        // }

        // if(!$this->checkVendor($vendor_code)){
        //     $this->emit('messageScript', [
        //         'message' => 'Vendor code kh??ng t???n t???i',
        //         'warning' => true
        //     ]);

        //     return;
        // }


        $params['id'] = $id;
        $params['partner_code'] = $partner_code;

        $params['payment_method'] = $payment_method;

        $params['vendor_code'] = $vendor_code;

        $result = PartnerVendorConnection::updateVendorMethod($params);

        if(isset($result->message) and $result->errorCode != 0){
            $this->emit('messageScript', [
                'message' => 'Partner code ???? t???n t???i ho???c ' . $result->message,
                'warning' => true
            ]);
            return;
        }


        if($result->success){
            $this->warning = false;
            $this->message = "B???n ???? edit th??nh c??ng";

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::GATE_VENDOR_CONFIG, "Edit c???u h??nh vendor theo payment method th??nh c??ng #params: " . json_encode($params), compact('params')));

            $this->emit('messageScript', [
                'message' => $this->message,
                'warning' => $this->warning
            ]);
        }else{
            $this->warning = true;
            $this->message = "Edit kh??ng th??nh c??ng!";
        }

    }

    public function search($partner_code, $vendor_code, $payment_method){
        $this->partner_code = $partner_code;
        $this->vendor_code = $vendor_code;
        $this->payment_method = $payment_method;
    }

    public function addnew($partnerCode, $payment_method, $vendor_code){

        // if(!$this->checkPartnerCode($partnerCode)){
        //     $this->emit('messageScript', [
        //         'message' => 'Partner code kh??ng t???n t???i',
        //         'warning' => true
        //     ]);

        //     return;
        // }

        // if(!$this->checkVendor($vendor_code)){
        //     $this->emit('messageScript', [
        //         'message' => 'Vendor code kh??ng t???n t???i',
        //         'warning' => true
        //     ]);

        //     return;
        // }

        $params['partner_code'] = $partnerCode;
        $params['payment_method'] = $payment_method;
        $params['vendor_code'] = $vendor_code;

        $result = PartnerVendorConnection::addnewtVendorMethod($params);

        if(isset($result->message) and $result->errorCode != 0){
            $this->emit('messageScript', [
                'message' => 'Partner code ???? t???n t???i ho???c ' . $result->message,
                'warning' => true
            ]);
            return;
        }
        if($result->success){
            $this->warning = false;
            $this->message = "B???n ???? th??m m???i th??nh c??ng";

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::GATE_VENDOR_CONFIG, "Th??m m???i c???u h??nh vendor theo payment method th??nh c??ng #params: " . json_encode($params), compact('params')));

            $this->emit('messageScript', [
                'message' => $this->message,
                'warning' => $this->warning
            ]);
        }else{
            $this->warning = true;
            $this->message = "Kh??ng th??m m???i ???????c";
        }

    }

    public $currentPage;
    public $totalPage;
    public $part = 10;
    public $start;
    public $end;

    public $pageCurrent;

    public function getList(){

        $params = [];

        if(isset($this->pageCurrent)){
            $params['pagination']['page'] = $this->pageCurrent;
        }

        if(isset($this->partner_code)){
            $params['query']['partner_code'] = $this->partner_code;
        }

        if(isset($this->vendor_code)){
            $params['query']['vendor_code'] = $this->vendor_code;
        }

        if(isset($this->payment_method)){
            $params['query']['payment_method'] = $this->payment_method;
        }


        $data = PartnerVendorConnection::getListVendorMethod($params);

        if(isset($data->meta->page)){
            $this->currentPage = $data->meta->page;
        }

        if(isset($data->meta->pages)){
            $this->totalPage = $data->meta->pages;
        }

        $this->start = $this->currentPage - $this->part;
        if($this->start < 1){
            $this->start = 1;
        }

        $this->end = $this->currentPage + $this->part;
        if($this->end > $this->totalPage){
            $this->end = $this->totalPage;
        }

        // $partnerLists = $this->getPartner();

        // if($partnerLists != null){
        //     foreach($data->data as $dataList){
        //         foreach($partnerLists as $partnerList){
        //             if($dataList->partner_code = $partnerList->partner_code){
        //                 $dataList->partnerName = $partnerList->name;
        //             }
        //         }
        //     }
        // }



        if(isset($data->data)){
            return $data->data;
        }
        return null;
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
