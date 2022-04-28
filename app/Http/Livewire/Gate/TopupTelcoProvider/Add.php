<?php

namespace App\Http\Livewire\Gate\TopupTelcoProvider;

use Livewire\Component;
use App\Services\Gate\TopupDenominationService;
use App\Transformers\TopupDenominationTransformer;
use App\Services\Gate\TopupProviderConfigService;
use App\Connection\TopupTelcoProviderConnection;
use Illuminate\Http\Request;

class Add extends Component
{
    public $telcoValueData = [];
    public $telcoValue4Data = [];
    public $telcoValue;
    public $telcoValue4;
    public $providerCode = "";
    public $providerCodeData = [];
    public $value;
    public $message1;
    public $erroCode1;

    public $message2;
    public $erroCode2;

    public $message3;
    public $erroCode3;

    public $message4;
    public $erroCode4;

    protected $listeners = [
        'getTelcoValue' => 'getTelcoValue',
        'getProviderCode' => 'getProviderCode',
        'SaveConfig1' => 'SaveConfig1',
        'SaveConfig2' => 'SaveConfig2',
        'SaveConfig3' => 'SaveConfig3',
        'getTelcoValue4' => 'getTelcoValue4',
        'SaveConfig4' => 'SaveConfig4'

    ];
    public function render()
    {
        // $this->getListConfig1();
        $this->getProviderCode();
        return view('livewire.gate.topup-telco-provider.add', [
            'telcoValueData2' => $this->telcoValueData,
            'providerCodeData' => $this->providerCodeData,
            'telcoValue4Data' =>$this->telcoValue4Data
        ]);
    }

    public function mount(){

        $this->getTelcoValue();
        $this->getTelcoValue4();
    }



    public function SaveConfig4(
        $telco,
        $providerCode,
        $telcoServiceType,
        $value,
        Request $request
    ){

        $params['providerCode'] = $providerCode;
        $params['telco'] = $telco;
        $params['telcoServiceType'] = $telcoServiceType;
        $params['value'] = $value;

        $TopupTelcoProviderConnection = new TopupTelcoProviderConnection();
        $result = $TopupTelcoProviderConnection->add_config4($params);
        if($result){
            $this->message4 = $result->message;
            $this->erroCode4 = $result->errorCode;
        }
    }

    public function SaveConfig3(
        $telco,
        $providerCode,
        $telcoServiceType,
        Request $request
    ){
        $params['providerCode'] = $providerCode;
        $params['telco'] = $telco;
        $params['telcoServiceType'] = $telcoServiceType;

        $TopupTelcoProviderConnection = new TopupTelcoProviderConnection();
        $result = $TopupTelcoProviderConnection->add($params);
        if($result){
            $this->message3 = $result->message;
            $this->erroCode3 = $result->errorCode;
        }
    }

    public function SaveConfig2(
        $telco,
        $providerCode,
        $telcoServiceType,
        $partnerCode,
        Request $request

    ){
        $params['providerCode'] = $providerCode;
        $params['telco'] = $telco;
        $params['telcoServiceType'] = $telcoServiceType;
        $params['partnerCode'] = $partnerCode;
        $TopupTelcoProviderConnection = new TopupTelcoProviderConnection();
        $result = $TopupTelcoProviderConnection->add_config2($params);
        if($result){
            $this->message2 = $result->message;
            $this->erroCode2 = $result->errorCode;
        }

    }




    public function SaveConfig1(
        $telco,
        $providerCode,
        $value,
        $telco_service_type,
        $parner_code_value,
        Request $request

    ){

        $params['providerCode'] = $providerCode;
        $params['partnerCode'] = $parner_code_value;
        $params['telco'] = $telco;
        $params['telcoServiceType'] = $telco_service_type;
        $params['value'] = $value;
        $TopupTelcoProviderConnection = new TopupTelcoProviderConnection();
        $result = $TopupTelcoProviderConnection->add_config_value($params);
        if($result){
            $this->message1 = $result->message;
            $this->erroCode1 = $result->errorCode;
        }
    }

    public function getTelcoValue(){
        $params = [];
        if(isset($this->telcoValue)){
            $params['query']['telco'] = $this->telcoValue;
        }else{
            $params['query']['telco'] = 'viettel';
        }
        // dd($params);

        $TopupDenominationService = new TopupDenominationService();
        $data = $TopupDenominationService->getList($params);
        $data->data = TopupDenominationTransformer::transformCollection($data->data);
        // dd($data);
        $this->telcoValueData = [];
        foreach($data->data as $data){
            $this->telcoValueData[] = $data->value;
        }
    }

    public function getTelcoValue4(){
        $params = [];
        if(isset($this->telcoValue4)){
            $params['query']['telco'] = $this->telcoValue4;
        }else{
            $params['query']['telco'] = 'viettel';
        }
        // dd($params);

        $TopupDenominationService = new TopupDenominationService();
        $data = $TopupDenominationService->getList($params);
        $data->data = TopupDenominationTransformer::transformCollection($data->data);
        // dd($data);
        $this->telcoValue4Data = [];
        foreach($data->data as $data){
            $this->telcoValue4Data[] = $data->value;
        }
    }

    public function getProviderCode(){
        // dd($providerCodeLivewire);
        if(isset($providerCodeLivewire)){
            $this->providerCode = $providerCodeLivewire;
        }
        $params = [];
        // $params['query']['providerCode'] = $this->providerCode;
        // dd($params);
        $TopupProviderConfigService = new TopupProviderConfigService();
        $data = $TopupProviderConfigService->getListSource($params);
        $this->providerCodeData = [];
        foreach($data['items'] as $data){
            $this->providerCodeData[] = $data->providerCode;
        }

    }
}
