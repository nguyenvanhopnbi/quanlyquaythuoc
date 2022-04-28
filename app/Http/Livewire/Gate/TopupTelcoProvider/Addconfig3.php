<?php

namespace App\Http\Livewire\Gate\TopupTelcoProvider;

use Livewire\Component;
use App\Services\Gate\TopupDenominationService;
use App\Transformers\TopupDenominationTransformer;
use App\Services\Gate\PartnerService;
use App\Services\Gate\TopupProviderConfigService;
use App\Transformers\ApplicationProvidersTransformer;
use App\Connection\TopupTelcoProviderConnection;

class Addconfig3 extends Component
{
    protected $listeners = ['addnewConfig444' => 'addnewConfig444'];
    public $providerCodeALL3;
    public $messageResultC3;
    public function render()
    {
        $this->getProviderCodeALL();
        return view('livewire.gate.topup-telco-provider.addconfig3');
    }

    public function addnewConfig444(
        $telco,
        $providerCode,
        $telcoServiceType
    ){
        $params['providerCode'] = $providerCode;
        $params['telco'] = $telco;
        $params['telcoServiceType'] = $telcoServiceType;

        $TopupTelcoProviderConnection = new TopupTelcoProviderConnection();
        $result = $TopupTelcoProviderConnection->add($params);
        if($result->errorCode == 0){
            $this->messageResultC3 = "Add new successfully ! Please click reload list to check";
            $this->emit('loadDataConfig3');

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TOPUP_CONFIG4, "Thêm mới Topup Config4", compact('params')));

        }else{
            $this->messageResultC3 = $result->message;
        }
    }

    public function getProviderCodeALL(){
        $params = [];
        $TopupProviderConfigService = new TopupProviderConfigService();
        $data = $TopupProviderConfigService->getList($params);
        // dd($data);
        if(isset($data->data)){
            $data->data = ApplicationProvidersTransformer::transformCollection($data->data);
            $this->providerCodeALL3 = $data->data;
        }

    }

}
