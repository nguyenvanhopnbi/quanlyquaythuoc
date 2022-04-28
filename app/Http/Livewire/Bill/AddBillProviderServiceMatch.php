<?php

namespace App\Http\Livewire\Bill;

use Livewire\Component;
use App\Helpers\ArrayHelper;
use App\Connection\PartnerConnection;

class AddBillProviderServiceMatch extends Component
{
    protected $listeners = [
        'checkPartnerCode' => 'checkPartnerCode'
    ];
    public $data;
    public $providerCodeList;
    public $partnerCodelist;

    public $message = 'message';
    public function render()
    {
        // $this->getPartnerCodeAPI();
        return view('livewire.bill.add-bill-provider-service-match');
    }

    public function checkPartnerCode($partnerCode){
        if(!$this->checkPartnerCodeAPI($partnerCode)){
            $this->message = 'Partner Code does not exist';
        }
    }

    public function getPartnerCodeAPI(){
        $partnerCodeArray = [];

        $params = [];
        $data = PartnerConnection::getList($params);
        if($data->meta->total){
            $params['pagination']['limit'] = $data->meta->total;
            $data = PartnerConnection::getList($params);
            if(isset($data->data)){
                $this->partnerCodelist = $data->data;
            }
        }
    }


}
