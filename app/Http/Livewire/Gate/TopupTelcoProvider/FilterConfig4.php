<?php

namespace App\Http\Livewire\Gate\TopupTelcoProvider;

use Livewire\Component;
use App\Services\Gate\PartnerService;
use App\Services\Gate\TopupProviderConfigService;
use App\Transformers\ApplicationProvidersTransformer;

class FilterConfig4 extends Component
{
    protected $listeners = ['searchConfig4' => 'searchConfig4'];
    public $partnerCodeList4;
    public $providerCodeALLConfig4;

    public $telcoFilter4 = '';
    public $providerCodeFilter4;
    public $partnerCodeFilter4;

    public function render()
    {
        // $this->getPartnerCode();
        $this->getProviderCodeALL();
        return view('livewire.gate.topup-telco-provider.filter-config4');
    }

    public function getPartnerCode(){
        $partnerService = new PartnerService();
        $params = [];
        $params['pagination']['perpage'] = 100;
        $data = $partnerService->getList($params);

        if(isset($data->data)){
            $this->partnerCodeList4 = $data->data;
        }


    }
    public function getProviderCodeALL(){
        $params = [];
        $TopupProviderConfigService = new TopupProviderConfigService();
        $data = $TopupProviderConfigService->getList($params);

        // dd($data);
        if(isset($data->data)){
            $data->data = ApplicationProvidersTransformer::transformCollection($data->data);
            $this->providerCodeALLConfig4 = $data->data;
        }

    }
    public function searchConfig4(
        $telco,
        $providerCode
    ){
        $this->telcoFilter4 = $telco;
        $this->providerCodeFilter4 = $providerCode;

        $this->emit('searchConfig4FilterConfig4', [
            'telcoFilter4' => $this->telcoFilter4,
            'providerCodeFilter4' => $this->providerCodeFilter4

        ]);
    }


}
