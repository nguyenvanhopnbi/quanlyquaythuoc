<?php

namespace App\Http\Livewire\Gate\TopupTelcoProvider;

use Livewire\Component;
use App\Services\Gate\TopupDenominationService;
use App\Transformers\TopupDenominationTransformer;
use App\Services\Gate\PartnerService;
use App\Services\Gate\TopupProviderConfigService;
use App\Transformers\ApplicationProvidersTransformer;
use App\Connection\TopupTelcoProviderConnection;

class Addconfig2 extends Component
{
    protected $listeners = [
        'addnewConfig2' => 'addnewConfig2'
    ];
    public $telcoValueDatac1;
    public $telcoValueConfig1;
    public $partnerCodeListAddConfig2;
    public $providerCodeALL;
    public $messageResultC2;


    public function render()
    {
        $this->getProviderCodeALL();
        $this->getPartnerCode();
        return view('livewire.gate.topup-telco-provider.addconfig2');
    }

    public function addnewConfig2(
        $telco,
        $providerCode,
        $telcoServiceType,
        $partnerCode
    ){
        // dd('vaoday');
        $params['providerCode'] = $providerCode;
        $params['partnerCode'] = $partnerCode;
        $params['telco'] = $telco;
        $params['telcoServiceType'] = $telcoServiceType;
        $TopupTelcoProviderConnection = new TopupTelcoProviderConnection();
        $result = $TopupTelcoProviderConnection->add_config2($params);
        // dd($result);
        if($result->errorCode == 0){
            $this->messageResultC2 = "Add new successfully ! Please click reload list to check";
            $this->emit('loadDataConfig2');

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TOPUP_CONFIG2, "Thêm mới Topup config2", compact('params')));

            // dd('vao day');

        }else{
            $this->messageResultC2 = "Please recheck your input data!";
        }
    }

    public function getProviderCodeALL(){
        $params = [];
        $TopupProviderConfigService = new TopupProviderConfigService();
        $data = $TopupProviderConfigService->getList($params);
        // dd($data);
        if(isset($data->data)){
            $data->data = ApplicationProvidersTransformer::transformCollection($data->data);
            $this->providerCodeALL = $data->data;
        }

    }
    public function getPartnerCode(){
        $partnerService = new PartnerService();
        $params = [];
        $params['pagination']['perpage'] = 100;
        $data = $partnerService->getList($params);
        if(isset($data->data)){
            $this->partnerCodeListAddConfig2 = $data->data;
        }

        // dd($this->partnerCodeList);
    }
}
