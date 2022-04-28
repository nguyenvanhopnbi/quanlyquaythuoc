<?php

namespace App\Http\Livewire\Gate\TopupTelcoProvider;

use Livewire\Component;
use App\Services\Gate\TopupDenominationService;
use App\Transformers\TopupDenominationTransformer;
use App\Services\Gate\PartnerService;
use App\Services\Gate\TopupProviderConfigService;
use App\Transformers\ApplicationProvidersTransformer;
use App\Connection\TopupTelcoProviderConnection;
// use Illuminate\Support\Facades\Log;

class Addconfig1 extends Component
{
    protected $listeners=[
        'getTelcoValueConfig1' => 'getTelcoValueConfig1',
        'addnewConfig1' => 'addnewConfig1'
    ];

    public $telcoValueDatac1;
    public $telcoValueConfig1;
    public $partnerCodeListAddConfig1;
    public $providerCodeALL;
    public $messageResultC1;

    public function render()
    {

        $this->getPartnerCode();
        $this->getProviderCodeALL();
        return view('livewire.gate.topup-telco-provider.addconfig1');
    }
    public function mount(){
        $this->getTelcoValueConfig1('viettel');
    }

    public $resultTimeout = false;

    public function addnewConfig1(
        $telco,
        $providerCode,
        $value,
        $telcoServiceType,
        $partnerCode
    ){
        // dd('vao day');
        $params['providerCode'] = $providerCode;
        $params['partnerCode'] = $partnerCode;
        $params['telco'] = $telco;
        $params['telcoServiceType'] = $telcoServiceType;
        $params['value'] = $value;
        $TopupTelcoProviderConnection = new TopupTelcoProviderConnection();
        $result = $TopupTelcoProviderConnection->add_config_value($params);
        $this->message2 = '';
        if($result->errorCode == 0){
            $this->messageResultC1 = "Add new successfully ! Please click reload list to check";
            $this->emit('loadDataConfig1');

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TOPUP_CONFIG1, "Thêm mới Topup config1", compact('params')));


            $this->resultTimeout = "1";
        }else{
            $this->messageResultC1 = $result->message;
            $this->resultTimeout = "0";
        }
        // Log::info('1111111111111 ' . $this->messageResultC1);
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

    public function getTelcoValueConfig1($telco){

        $params = [];
        if(isset($telco)){
            $this->telcoValueConfig1 = $telco;
            $params['query']['telco'] = $this->telcoValueConfig1;
        }

        $TopupDenominationService = new TopupDenominationService();
        $data = $TopupDenominationService->getList($params);
        $this->telcoValueDatac1 = [];
        if(isset($data->data)){
            foreach($data->data as $data){
                $this->telcoValueDatac1[] = str_replace('.', '', $data->value);
            }
            // dd($this->telcoValueDatac1);
        }

    }

    public function getPartnerCode(){
        $partnerService = new PartnerService();
        $params = [];
        $params['pagination']['perpage'] = 100;
        $data = $partnerService->getList($params);
        if(isset($data->data)){
            $this->partnerCodeListAddConfig1 = $data->data;
        }

        // dd($this->partnerCodeList);
    }
}
