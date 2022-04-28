<?php

namespace App\Http\Livewire\Gate\TopupTelcoProvider;

use Livewire\Component;
use App\Services\Gate\TopupDenominationService;
use App\Transformers\TopupDenominationTransformer;
use App\Services\Gate\PartnerService;
use App\Services\Gate\TopupProviderConfigService;
use App\Transformers\ApplicationProvidersTransformer;
use App\Connection\TopupTelcoProviderConnection;

class Addconfig4 extends Component
{
    protected $listeners = [
        'getTelcoValueConfig4' => 'getTelcoValueConfig4',
        'addnewConfig333' => 'addnewConfig333'

    ];
    public $telcoValueDatac4;
    public $telcoValueConfig4;
    public $partnerCodeListAddConfig1;
    public $providerCodeALL4;
    public $messageResultC4;
    public function render()
    {
        $this->getProviderCodeALL();

        return view('livewire.gate.topup-telco-provider.addconfig4');
    }
    public function mount(){
        $this->getTelcoValueConfig4('viettel');
    }

    public function addnewConfig333(
        $telco,
        $providerCode,
        $value,
        $telcoServiceType
    ){
        $params['providerCode'] = $providerCode;
        $params['telco'] = $telco;
        $params['telcoServiceType'] = $telcoServiceType;
        $params['value'] = $value;

        $TopupTelcoProviderConnection = new TopupTelcoProviderConnection();
        $result = $TopupTelcoProviderConnection->add_config4($params);
        if($result->errorCode == 0){
            $this->messageResultC4 = "Add new successfully ! Please click reload list to check";
            $this->emit('loadDataConfig4');

        event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TOPUP_CONFIG3, "Thêm mới Topup config3", compact('params')));

        }else{
            $this->messageResultC4 = $result->message;
        }
    }

    public function getProviderCodeALL(){
        $params = [];
        $TopupProviderConfigService = new TopupProviderConfigService();
        $data = $TopupProviderConfigService->getList($params);
        // dd($data);
        if(isset($data->data)){
            $data->data = ApplicationProvidersTransformer::transformCollection($data->data);
            $this->providerCodeALL4 = $data->data;
        }

    }
    public function getTelcoValueConfig4($telco){

        $params = [];
        if(isset($telco)){
            $this->telcoValueConfig4 = $telco;
            $params['query']['telco'] = $this->telcoValueConfig4;
        }

        $TopupDenominationService = new TopupDenominationService();
        $data = $TopupDenominationService->getList($params);
        // $data->data = TopupDenominationTransformer::transformCollection($data->data);
        $this->telcoValueDatac4 = [];
        if(isset($data->data) and !empty($data->data)){
                foreach($data->data as $data){
                $this->telcoValueDatac4[] = str_replace('.', '', $data->value);
            }
        }
    }
}
