<?php

namespace App\Http\Livewire\Gate\PartnerMethod;

use Livewire\Component;
use App\Connection\PartnerMethodConnection;
use App\Connection\PartnerConnection;

class PartnerMethod extends Component
{
    protected $listeners = [
        'savePartnerCodeMethod'=> 'savePartnerCodeMethod',
        'resetMessage' => 'resetMessage',
        'DataUpdate' => 'DataUpdate',
        'deletePartnerMethod' => 'deletePartnerMethod',
        'searchPartnerMethod' => 'searchPartnerMethod'

    ];
    public $parnerMethodList;
    public $allPartnerCode;
    public $idpartnerMethod;

    public $list;
    public $message;
    public $messageUpdate;

    public $meta;
    public $currentPage;
    public $totalPage;

    public function __construct(){
        // $PartnerMethodConnection = new PartnerMethodConnection();
    }
    public function render()
    {
        $this->getListPartnerMethod();

        return view('livewire.gate.partner-method.partner-method');
    }



    public function deletePartnerMethod($id){
        $result = PartnerMethodConnection::delete($id);
        if($result){
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_PAYMENT_METHOD, "Xoá Gate chặn PTTT", compact('id')));
        }

    }
    public $warmingMessage = false;

    public function savePartnerCodeMethod($partner_code, $payment_method){
        // dd($partner_code . '-'. $payment_method);
        $params = [];
        $params['partner_code'] = $partner_code;
        $params['payment_method'] = $payment_method;

        $PartnerMethodConnection = new PartnerMethodConnection();
        $result = $PartnerMethodConnection->add($params);
        if($result == "Cặp partner_code và payment_method đã tồn tại"){
            $this->message = "Partner Code: ". $partner_code . " and Payment Method: " . $payment_method. " is exist.";
            $this->warmingMessage = true;
            return;
        }
        if($result){
            $this->message = "Add successfully! Partner Code: ".$partner_code. " Payment Method: ".$payment_method;
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_PAYMENT_METHOD, "Thêm mới Gate chặn PTTT"));
        }
    }

    public function DataUpdate($id, $partnerCode, $paymentMethod){
        $this->idpartnerMethod = $id;
        $params = [];
        if(isset($id)){
            $this->idpartnerMethod = $id;
            $params['id'] = $id;
        }


        if(isset($partnerCode)){
            $params['partner_code'] = $partnerCode;
        }
        if(isset($paymentMethod)){
            $params['payment_method'] = $paymentMethod;
        }

        $PartnerMethodConnection = new PartnerMethodConnection();
        $result = $PartnerMethodConnection->edit($params);
        if($result == "Cặp partner_code và payment_method đã tồn tại"){
            $this->messageUpdate = "Partner code: ".$partnerCode. " and payment method: ".$paymentMethod . " is existed!";
            return;
        }
        if($result){
            $this->messageUpdate = "Update successfully! New partner code: ".$partnerCode. " and new payment method: ".$paymentMethod;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_PAYMENT_METHOD, "Sửa Gate chặn PTTT"));

            return;
        }
    }

    public function resetMessage(){
        unset($this->message);
        unset($this->warmingMessage);
    }

    public $partnerCodeSearch;
    public $paymentMethodSearch;

    protected $queryString = [
        'partnerCodeSearch' => ['except' => ''],
        'paymentMethodSearch' => ['except' => '']
    ];

    public function searchPartnerMethod($partner_code, $payment_method){
        if(isset($partner_code)){
            $this->partnerCodeSearch = $partner_code;
        }
        if(isset($payment_method)){
            $this->paymentMethodSearch = $payment_method;
        }
    }

    public function getListPartnerMethod(){

        // lay partner code
        $paramsPartnerCode = [];
        $PartnerConnection = new PartnerConnection();
        $this->allPartnerCode = $PartnerConnection->getList($paramsPartnerCode);
        if(isset($this->allPartnerCode->meta->total)){
            $paramsPartnerCode['pagination']['limit'] = $this->allPartnerCode->meta->total;
        }

        if(!isset($PartnerConnection->getList($paramsPartnerCode)->data)){
            return;
        }
        $this->allPartnerCode = $PartnerConnection->getList($paramsPartnerCode)->data;
        // end lay partner code

        $params = [];
        $params['pagination']['limit'] = 20;
        $params['sort']['id'] = 'desc';
        if(isset($this->currentPage)){
            if($this->currentPage > $this->totalPage){
                $params['pagination']['page'] = $this->totalPage;
            }else{
                $params['pagination']['page'] = $this->currentPage;
            }

            if($this->currentPage < 1){
                $this->currentPage = 1;
            }

        }
        if(isset($this->partnerCodeSearch)){
            $params['filter']['partner_code'] = $this->partnerCodeSearch;
        }
        if(isset($this->paymentMethodSearch)){
            $params['filter']['payment_method'] = $this->paymentMethodSearch;
        }

        $PartnerMethodConnection = new PartnerMethodConnection();
        $data = $PartnerMethodConnection->getList($params);

        $this->list = [];
        if(!empty($data->data)){
            $this->list = $data->data;
        }

        if(!empty($data->meta)){

            $this->getTotalPage($data->meta->total_pages);
            $this->getCurrentPage($data->meta->page_current);

        }
    }

    public function getTotalPage($page){
        $this->totalPage = $page;
    }
    public function getCurrentPage($page){
        $this->currentPage = $page;
    }


}
