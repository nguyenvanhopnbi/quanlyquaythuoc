<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Connection\DoubleCheckConnection;
use App\Connection\PartnerConnection;
class ListEbillTransactionByAccount extends Component
{
    protected $listeners = [
        'search' => 'search'
    ];
    public function render()
    {
        return view('livewire.list-ebill-transaction-by-account', [
            'listTrans' => $this->getList()
        ]);
    }

    public $account = '';
    public $providerCode = 'VIETCAPITALBANK';

    public $message;
    public $search = false;

    public function getList(){
        $params = [];
        $params['provider_code'] = $this->providerCode;
        $params['account'] = $this->account;
        $data = DoubleCheckConnection::getListEbillTransByAccount($params);
        if($this->search){
            if(!$data){
                $this->message = "Không có data! providerCode: ". $this->providerCode . " - Account: ". $this->account ;
                return;
            }

            if(empty($data->data)){
                $this->message = "Không có data! providerCode: ". $this->providerCode . " - Account: ". $this->account ;
                return;
            }else{
                unset($this->message);
            }
        }

        if(isset($data->data)){
            return $data->data;
        }
    }

    // public function getPartnerCode(){
    //     $params = [];
    //     $params['pagination']['limit'] = 10000;
    //     $data = PartnerConnection::getList($params);
    //     if(isset($data->data)){
    //         return $data->data;
    //     }
    // }

    public $loadingState;

    public function loading(){
        if(isset($this->loadingState)){
            unset($this->loadingState);
            return true;
        }

        return false;
    }

    public function search($providerCode, $account){
        $this->providerCode = $providerCode;
        $this->account = $account;
        $this->loadingState = $providerCode . $account;

        $this->search = true;
    }
}
