<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Connection\BankTransactionConnection;
use App\Connection\PartnerConnection;
use App\Services\Gate\PartnerService;


class PartnerServiceTypeConfig extends Component
{

    protected $listeners = [
        'add' => 'add',
        'delete' => 'delete',
        'edit' => 'edit',
        'search' => 'search'
    ];

    public function render()
    {
        return view('livewire.partner-service-type-config', [
            'dataList' => $this->getList(),
            'ListPartner' => $this->getListPartner()
        ]);
    }

    public $message;
    public $warning = false;

    public function edit($id, $partnerCode, $name, $napasType){
        $params = [];
        $params['id'] = $id;
        $params['partner_code'] = $partnerCode;
        // $params['type'] = $type;
        $params['mastercard_type'] = $name;
        $params['napas_type'] = $napasType;
        $result = BankTransactionConnection::editPartnerServiceTypeConfig($params);
        if(isset($result->errorCode)){
            if($result->errorCode != 0){
                $this->message = $result->message;
                $this->warning = true;
                $this->emit('messageScript', [
                    'message' => $this->message,
                    'warning' => $this->warning
                ]);
            }
        }

        if(isset($result->success)){
            if($result->success){
                $this->message = "Sửa config thành công";
                $this->warning = false;

                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::GATE_CONFIG_SERVICE_TYPE, "Sửa partner type config thành công params: " . json_encode($params), compact('params')));

                $this->emit('messageScript', [
                    'message' => $this->message,
                    'warning' => $this->warning
                ]);
            }
        }else{
            $this->message = "Sửa config thất bại";
            $this->warning = true;

            $this->emit('messageScript', [
                'message' => $this->message,
                'warning' => $this->warning
            ]);
        }
    }


    public function delete($id){
        $params = [];
        $params['id'] = $id;
        $result = BankTransactionConnection::deletePartnerServiceTypeConfig($params);

        if(isset($result->errorCode)){
            if($result->errorCode != 0){
                $this->message = $result->message;
                $this->warning = true;
                $this->emit('messageScript', [
                    'message' => $this->message,
                    'warning' => $this->warning
                ]);
            }
        }

        if(isset($result->success)){
            if($result->success){
                $this->message = "Xóa config thành công";
                $this->warning = false;

                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::GATE_CONFIG_SERVICE_TYPE, "Xóa partner type config thành công params: " . json_encode($params), compact('params')));

                $this->emit('messageScript', [
                    'message' => $this->message,
                    'warning' => $this->warning
                ]);
            }
        }else{
            $this->message = "Xóa config thất bại";
            $this->warning = true;

            $this->emit('messageScript', [
                'message' => $this->message,
                'warning' => $this->warning
            ]);
        }

    }

    // public $formmat_Type;

    public function add($partnerCode, $name, $napas_type){
        $params = [];
        $params['partner_code'] = $partnerCode;
        // $params['type'] = $type;
        $params['mastercard_type'] = $name;
        $params['napas_type'] = $napas_type;

        if($partnerCode == ""){
            $this->message = "Cần nhập partner code.";
            $this->warning = true;
            $this->emit('messageScript', [
                    'message' => $this->message,
                    'warning' => $this->warning
            ]);

            return;
        }

        // if($type == ""){
        //     $this->message = "Cần nhập type.";
        //     $this->warning = true;
        //     $this->emit('messageScript', [
        //             'message' => $this->message,
        //             'warning' => $this->warning
        //     ]);

        //     return;
        // }

        // $regex = '/^[a-zA-Z\d\_-]+$/';
        // if(!preg_match($regex, $type)){
        //     $this->message = "Type chưa đúng định dạng, chỉ được nhập chữ, số và dấu '_-'";
        //     $this->warning = true;
        //     $this->emit('messageScript', [
        //             'message' => $this->message,
        //             'warning' => $this->warning
        //     ]);

        //     return;
        // }

        if($name == ""){
            $this->message = "Cần nhập name.";
            $this->warning = true;
            $this->emit('messageScript', [
                    'message' => $this->message,
                    'warning' => $this->warning
            ]);

            return;
        }

        if($napas_type == ""){
            $this->message = "Cần nhập napas type.";
            $this->warning = true;
            $this->emit('messageScript', [
                    'message' => $this->message,
                    'warning' => $this->warning
            ]);

            return;
        }




        $result = BankTransactionConnection::createPartnerServiceTypeConfig($params);
        if(isset($result->errorCode)){
            if($result->errorCode != 0){
                $this->message = $result->message;
                $this->warning = true;
                $this->emit('messageScript', [
                    'message' => $this->message,
                    'warning' => $this->warning
                ]);
            }
        }

        if(isset($result->success)){
            if($result->success){
                $this->message = "Thêm mới config thành công";
                $this->warning = false;

                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::GATE_CONFIG_SERVICE_TYPE, "Thêm mới partner type config thành công params: " . json_encode($params), compact('params')));

                $this->emit('messageScript', [
                    'message' => $this->message,
                    'warning' => $this->warning
                ]);
            }
        }else{
            $this->message = "Thêm mới config thất bại";
            $this->warning = true;

            $this->emit('messageScript', [
                'message' => $this->message,
                'warning' => $this->warning
            ]);
        }


    }

    public $currentPage;
    public $totalPage;
    public $start;
    public $end;
    public $part = 10;

    public $pageCurrent;

    public $partner_code;
    public $type;
    public $name;
    public $napas_type;

    public function getListPartner(){
        $params = [];
        $params['pagination']['limit'] = 10000;
        $data = PartnerConnection::getList($params);
        if(isset($data->data)){
            return $data->data;
        }else{
            return null;
        }
    }

    public function getList(){
        $params = [];
        $params['pagination']['page'] = 1;

        if(isset($this->partner_code) and !empty($this->partner_code)){
            $params['query']['partner_code'] = $this->partner_code;
        }

        // if(isset($this->type) and !empty($this->type)){
        //     $params['query']['type'] = $this->type;
        // }

        if(isset($this->name) and !empty($this->name)){
            $params['query']['mastercard_type'] = $this->name;
        }

        if(isset($this->napas_type) and !empty($this->napas_type)){
            $params['query']['napas_type'] = $this->napas_type;
        }


        if(isset($this->pageCurrent)){
            $params['pagination']['page'] = $this->pageCurrent;
        }

        $params['pagination']['limit'] = 20;
        $data = BankTransactionConnection::listPartnerServiceTypeConfig($params);
        // dd($data);
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

        if(isset($data->data)){
            return $data->data;
        }

    }

    public function gotoCurrentPage($page){
        if($page < 1){
            $page = 1;
        }
        if($page >= $this->totalPage){
            $page = $this->totalPage;
        }

        $this->pageCurrent = $page;
    }

    public function search($partnerCode, $name, $napas_type){
        $this->partner_code = $partnerCode;
        // $this->type = $type;
        $this->name = $name;
        $this->napas_type = $napas_type;
    }
}
