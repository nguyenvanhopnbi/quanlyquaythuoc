<?php

namespace App\Http\Livewire\Gate\TopupTelcoProvider;

use Livewire\Component;

use App\Services\Gate\PartnerService;
use App\Services\Gate\TopupProviderConfigService;
use App\Transformers\ApplicationProvidersTransformer;

class FilterConfig2 extends Component
{
    protected $listeners = ['searchConfig2' => 'searchConfig2'];

    public $partnerCodeList2;
    public $providerCodeALLConfig2;

    public $telcoFilter2 = '';
    public $providerCodeFilter2;
    public $partnerCodeFilter2;
    public function render()
    {
        $this->getPartnerCode();
        $this->getProviderCodeALL();
        return view('livewire.gate.topup-telco-provider.filter-config2');
    }
    public function getPartnerCode(){
        $partnerService = new PartnerService();
        $params = [];
        $params['pagination']['perpage'] = 100;
        $data = $partnerService->getList($params);

        if(isset($data->data)){
            $this->partnerCodeList2 = $data->data;
        }


    }
    public function getProviderCodeALL(){
        $params = [];
        $TopupProviderConfigService = new TopupProviderConfigService();
        $data = $TopupProviderConfigService->getList($params);

        // dd($data);
        if(isset($data->data)){
            $data->data = ApplicationProvidersTransformer::transformCollection($data->data);
            $this->providerCodeALLConfig2 = $data->data;
        }

    }
    public function searchConfig2(
        $telco,
        $providerCode,
        $partnerCode
    ){
        $this->telcoFilter2 = $telco;
        $this->providerCodeFilter2 = $providerCode;
        $this->partnerCodeFilter2 = $partnerCode;

        $this->emit('searchConfig2FilterConfig2', [
            'telcoFilter2' => $this->telcoFilter2,
            'providerCodeFilter2' => $this->providerCodeFilter2,
            'partnerCodeFilter2' => $this->partnerCodeFilter2
        ]);
    }
}
