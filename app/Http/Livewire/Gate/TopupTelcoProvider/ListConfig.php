<?php

namespace App\Http\Livewire\Gate\TopupTelcoProvider;

use Livewire\Component;
use App\Connection\TopupTelcoProviderConnection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Services\Gate\PartnerService;
use Illuminate\Support\Facades\Log;

use App\Services\Gate\TopupProviderConfigService;
use App\Services\Gate\TopupDenominationService;

class ListConfig extends Component
{
    protected $listeners = [
        'deleteConfig1'=> 'deleteConfig1',
        'deleteConfig2' => 'deleteConfig2',
        'deleteConfig333' => 'deleteConfig333',
        'deleteConfig444' => 'deleteConfig444',
        'updateConfig1' => 'updateConfig1',
        'updateConfig2' => 'updateConfig2',
        'updateConfig444' => 'updateConfig444',
        'updateConfig333' => 'updateConfig333',
        'getListConfig1Filter' => 'getListConfig1Filter',
        'searchConfig3' => 'searchConfig3',
        'loadDataConfig1' => 'loadDataConfig1',
        'loadDataConfig2' => 'loadDataConfig2',
        'loadDataConfig3' => 'loadDataConfig3',
        'loadDataConfig4' => 'loadDataConfig4',
        'searchConfig4FilterConfig4' => 'searchConfig4FilterConfig4',
        'searchConfig2FilterConfig2' => 'searchConfig2FilterConfig2',
        'removeMessageUpdateDeleteConfig' => 'removeMessageUpdateDeleteConfig',
        'getTelcoValueConfig11111' => 'getTelcoValueConfig11111',
        'setIDEditConfig2' => 'setIDEditConfig2',
        'getTelcoValueConfig3333' => 'getTelcoValueConfig3333'

    ];

    public $message;

    protected $partnerCodeList;
    public $perpageList = 20;

    protected $listConfig1;
    protected $listConfig2;
    protected $listConfig3;
    protected $listConfig4;

    protected $success1 = 1;
    protected $success2 = 0;
    protected $success3 = 0;
    protected $success4 = 0;

    protected $message1;
    protected $message2;
    protected $message3;
    protected $message4;

    public $page1 = 1;
    public $pages1;
    public $limit1;
    public $total1;

    public $telcoSearchConfig1;
    public $providerCodeSearchConfig1;
    public $partnerCodeSearchConfig1;


    public $page2 = 1;
    public $pages2;
    public $limit2;
    public $total2;

    public $telcoFilter2;
    public $providerCodeFilter2;
    public $partnerCodeFilter2;


    public $page3 = 1;
    public $pages3;
    public $limit3;
    public $total3;
    public $telcoConfig3;
    public $providerCodeConfig3;

    public $errorCode1;

    public $messageUpdateConfig1;
    public $messageDeleteConfig1;

    public $errorCode2;
    public $messageUpdateConfig2;

    public $errorCode3;
    public $messageUpdateConfig3;

    public $errorCode4;
    public $messageUpdateConfig4;

    public $telcoFilter4 = '';
    public $providerCodeFilter4 = '';

    public $page4 = 1;
    public $pages4;
    public $limit4;
    public $total4;

    public $idEditConfig2;

    public function render()
    {

        $this->getListConfig4();
        $this->getListConfig1();
        $this->getListConfig2();
        $this->getListConfig3();
        $this->getPartnerCode();
        $this->getProviderCodeALL();

        // $this->getTelcoValueConfig1('viettel');

        return view('livewire.gate.topup-telco-provider.list-config', [
            'listConfig2' => $this->listConfig2,
            'listConfig4' => $this->listConfig4,
            'listConfig1' => $this->listConfig1,
            'listConfig3' => $this->listConfig3,
            'success2' => $this->success2,
            'success1' => $this->success1,
            'success4' => $this->success4,
            'partnerCodeList' => $this->partnerCodeList,
            'providerCodeALL' => $this->providerCodeALL,
            'success1' => $this->success1,
            'success2' => $this->success2,
            'success3' => $this->success3,
            'success4' => $this->success4,
            'message1' => $this->message1,
            'message2' => $this->message2,
            'message3' => $this->message3,
            'message4' => $this->message4,

        ]);
    }

    public function loadDataConfig1(){
        $this->getListConfig1();
        $this->success2 = 0;
        $this->success1 = 1;
        $this->success4 = 0;
        $this->success3 = 0;
    }
    public function loadDataConfig2(){
        $this->getListConfig2();
        $this->success2 = 1;
        $this->success1 = 0;
        $this->success4 = 0;
        $this->success3 = 0;
    }
    public function loadDataConfig3(){
        $this->getListConfig3();
        $this->success2 = 0;
        $this->success1 = 0;
        $this->success4 = 0;
        $this->success3 = 1;
    }
    public function loadDataConfig4(){
        $this->getListConfig4();
        $this->success2 = 0;
        $this->success1 = 0;
        $this->success4 = 1;
        $this->success3 = 0;
    }

    public $message333;

    public function updateConfig333(
        $id,
        $providerCode,
        $telco,
        $telcoServiceType
    ){

        $this->idEditConfig3 = $id;

        $TopupTelcoProviderConnection = new TopupTelcoProviderConnection();
        $params['providerCode'] = $providerCode;
        $params['telco'] = $telco;
        $params['telcoServiceType'] = $telcoServiceType;
        $params['value'] = 0;

        $result = $TopupTelcoProviderConnection->editConfig333($this->idEditConfig3, $params);

        $this->message333 = '';
        if($result->errorCode == 0){
            $this->message333 = "You update successfully!! ID: ".$id." and Provider Code: ". $providerCode. " and Telco: ". $telco. " and Telco Service Type: " . $telcoServiceType. " ";

            $this->warning = false;


            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TOPUP_CONFIG3, "Sửa Topup config3", compact('id', 'params')));

        }else{
            $this->message333 = $result->message;
            $this->warning = true;
        }

            $this->success2 = 0;
            $this->success1 = 0;
            $this->success4 = 1;
            $this->success3 = 0;
    }

    public $idConfig444;
    public $message444;
    public function updateConfig444(
        $id,
        $providerCode,
        $telco,
        $telco_service_type,
        Request $request
    ){

        $this->idConfig444 = $id;

        // dd($this->idConfig444 . ' - '. $providerCode. '-' . $telco. '-'. $telco_service_type);

        $TopupTelcoProviderConnection = new TopupTelcoProviderConnection();
        $params['providerCode'] = $providerCode;
        $params['telco'] = $telco;
        $params['telcoServiceType'] = $telco_service_type;


        $result = $TopupTelcoProviderConnection->edit($id, $params);
        // dd($result);
        $this->message444 = '';
        if($result->errorCode == 0){
            $this->message444 = "You updated successfully!! ID: ". $id ." and Provider Code: ". $providerCode. " and Telco: ". $telco. " and Telco Service Type: ". $telco_service_type;

            $this->warning = false;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TOPUP_CONFIG4, "Sửa Topup Config4", compact('id', 'params')));

        }else{
            $this->message444 = $result->message . " May be your telco is existed!! Please check your input data again!";

            $this->warning = true;
        }
        $this->success2 = 0;
        $this->success1 = 0;
        $this->success4 = 0;
        $this->success3 = 1;
    }

    public function setIDEditConfig2($id){
        $this->idEditConfig2 = $id;
    }

    public function updateConfig2(
        $id,
        $providerCode,
        $telco,
        $telcoServiceType,
        $partnerCode,
        Request $request
    ){
        // $this->idEditConfig2 = $id;
        // dd($this->idEditConfig2);
        $TopupTelcoProviderConnection = new TopupTelcoProviderConnection();
        $params['providerCode'] = $providerCode;
        $params['partnerCode'] = $partnerCode;
        $params['telco'] = $telco;
        $params['telcoServiceType'] = $telcoServiceType;


        $result = $TopupTelcoProviderConnection->editConfig2($id, $params);

        // dd($result);

        $this->message2 = '';
        if($result->errorCode == 0){

            $this->message2 = "You update successfully ID: ". $id ." and Provider Code: ".$providerCode. " and Partner Code: ". $partnerCode . " and Telco: " . $telco. " and Telco Service Type: ". $telcoServiceType;
            $this->warning = false;


            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TOPUP_CONFIG2, "Sửa Topup config2", compact('id', 'params')));

            $this->success2 = 1;
            $this->success1 = 0;
            $this->success4 = 0;
            $this->success3 = 0;
        }else{
            $this->success2 = 1;
            $this->success1 = 0;
            $this->success4 = 0;
            $this->success3 = 0;
            $this->message2 = $result->message;

            $this->warning = true;
        }
        // dd($this->message2);
    }

    protected $providerCodeALL;
    public function getProviderCodeALL(){
        $params = [];
        $TopupProviderConfigService = new TopupProviderConfigService();
        $data = $TopupProviderConfigService->getList($params);

        // dd($data);
        if(isset($data->data)){
            // $data->data = ApplicationProvidersTransformer::transformCollection($data->data);
             $this->providerCodeALL = $data->data;
        }
        // dd($this->providerCodeALL);

    }


    public $telcoValueConfig3;
    public $telcoValueDatac3;
    public $idEditConfig3;

    public function getTelcoValueConfig3333($telco, $id){
        $this->idEditConfig3 = $id;
        $params = [];
        if(isset($telco)){
            $this->telcoValueConfig3 = $telco;
            $params['query']['telco'] = $this->telcoValueConfig3;
        }

        $TopupDenominationService = new TopupDenominationService();
        $data = $TopupDenominationService->getList($params);
        $this->telcoValueDatac3 = [];
        if(isset($data->data)){
            foreach($data->data as $data){
                $this->telcoValueDatac3[] = str_replace('.', '', $data->value);
            }
            // dd($this->telcoValueDatac3);
        }

        $this->success2 = 0;
        $this->success1 = 0;
        $this->success4 = 1;
        $this->success3 = 0;

    }



    public $telcoValueConfig1;
    public $telcoValueDatac1;
    public $idEditConfig1111;

    public function getTelcoValueConfig11111($telco, $id){
        $this->idEditConfig1111 = $id;
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


    // public $idEditConfig1111;
    public $warning = false;
    public function updateConfig1(
            $id,
            $partnerCode,
            $providerCode,
            $value,
            $telco,
            $telco_service_type,
            Request $request
    ){
        // dd($telco_service_type);
        $this->idEditConfig1111 = $id;
        $TopupTelcoProviderConnection = new TopupTelcoProviderConnection();
        $params['providerCode'] = $providerCode;
        $params['partnerCode'] = $partnerCode;
        $params['telco'] = $telco;
        $params['telcoServiceType'] = $telco_service_type;
        $params['value'] = $value;
        // dd($params);

        $result = $TopupTelcoProviderConnection->editConfig1($this->idEditConfig1111, $params);
        // dd($result);
        // $this->getListConfig1();

        $this->message1 = '';

        $this->messageUpdateConfig1 = $result->message;
        if($result->errorCode == 0){
            $resultSuccess = $result->success;
            if($resultSuccess){
                $this->success2 = 0;
                $this->success1 = 1;
                $this->success4 = 0;
                $this->success3 = 0;

                $this->warning = false;

                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TOPUP_CONFIG1, "Sửa Topup config1", compact('id', 'params')));


            }
             $this->message1 = "Update id ". $id . " config1 successfully! Provider Code: ". $providerCode. " and Partner Code: ".$partnerCode. " and Telco: ".$telco. " and Telco Service Type: " .$telco_service_type. " and Value: ".$value;
        }else{
            $this->warning = true;
            $this->message1 = $result->message;
        }



    }

    public function deleteConfig1($providerID){
        $TopupTelcoProviderConnection = new TopupTelcoProviderConnection();
        $result = $TopupTelcoProviderConnection->deleteConfig1($providerID);

        $this->message1  = '';

        if($result->errorCode == 0){
            // $this->getListConfig1();
            $this->success2 = 0;
            $this->success1 = 1;
            $this->success4 = 0;
            $this->success3 = 0;
            $this->message1 = "Delete id ". $providerID ." config 1 successfully";


            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TOPUP_CONFIG1, "Xoá Topup config1", compact('providerID')));

        }else{
            $this->message1 = $result->message;
        }


    }

    public function deleteConfig2($providerID){
        $TopupTelcoProviderConnection = new TopupTelcoProviderConnection();
        $result = $TopupTelcoProviderConnection->deleteConfig2($providerID);
        $this->getListConfig2();

        $this->message2 = '';

        if($result->errorCode == 0){
            $this->errorCode2 = $result->errorCode;
            $this->message2 = "Delete id ". $providerID ." successfully!";

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TOPUP_CONFIG2, "Xoá Topup config2", compact('providerID')));

        }else{
            $this->message2 = $result->message;
        }



        $this->success2 = 1;
        $this->success1 = 0;
        $this->success4 = 0;
        $this->success3 = 0;

    }

    public function deleteConfig444($providerID){
        $TopupTelcoProviderConnection = new TopupTelcoProviderConnection();
        $result = $TopupTelcoProviderConnection->deleteConfig444($providerID);

        event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TOPUP_CONFIG4, "Xoá topup config 4", compact('providerID')));

        $this->errorCode3 = $result->errorCode;
        $this->message3 = '';
        if($result->errorCode == 0){
            $this->message3 = "Delete id ". $providerID . " successfully!";
        }else{
            $this->message3 = $result->message;
        }

        $this->success1 = 0;
        $this->success2 = 0;
        $this->success4 = 0;
        $this->success3 = 1;

    }
    public function deleteConfig333($providerID){
        $TopupTelcoProviderConnection = new TopupTelcoProviderConnection();
        $result = $TopupTelcoProviderConnection->deleteConfig4($providerID);

        $this->getListConfig4();

        $this->errorCode4 = $result->errorCode;
        $this->message4 = '';

        if($result->errorCode == 0){
            $this->message4 = "Delete id ".$providerID. " successfully!";

        event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TOPUP_CONFIG3, "Xoá Topup config3", compact('providerID')));


        }else{
            $this->message4 = $result->message;
        }

        $this->success4 = 1;
        $this->success1 = 0;
        $this->success2 = 0;
        $this->success3 = 0;
    }

    public function getListConfig1(){
        $params = [];
        $params['pagination']['limit'] = $this->perpageList;
        $params['pagination']['page']  = $this->page1;
        if($this->telcoSearchConfig1){
            $params['query']['telco'] = $this->telcoSearchConfig1;
        }
        if($this->providerCodeSearchConfig1){
            $params['query']['providerCode'] = $this->providerCodeSearchConfig1;
        }
        if($this->partnerCodeSearchConfig1){
            $params['query']['partnerCode'] = $this->partnerCodeSearchConfig1;
        }

        $TopupTelcoProviderConnection = new TopupTelcoProviderConnection();
        $data = $TopupTelcoProviderConnection->getListConfig1($params);
        // dd($data);
        if(isset($data->meta)){
            $this->page1 = $data->meta->page;
            $this->pages1 = $data->meta->pages;
            $this->limit1 = $data->meta->limit;
            $this->total1 = $data->meta->total;
        }
        if(isset($data->data)){
            $this->listConfig1 = $data->data;
        }

        // dd($this->listConfig1);


    }

    public function getListConfig1Filter(
        $telco,
        $partnerCode,
        $providerCode
    ){
        if(isset($telco)){
            $this->telcoSearchConfig1 = $telco;
        }
        if(isset($partnerCode)){
            $this->partnerCodeSearchConfig1 = $partnerCode;
            // dd($this->partnerCodeSearchConfig1);
        }
        if(isset($providerCode)){
            $this->providerCodeSearchConfig1 = $providerCode;
        }

        $this->success2 = 0;
        $this->success1 = 1;
        $this->success4 = 0;
        $this->success3 = 0;
    }

    public function getPartnerCode(){
        $partnerService = new PartnerService();
        $params = [];
        $params['pagination']['perpage'] = 100;
        $data = $partnerService->getList($params);
        $this->partnerCodeList = $data->data;

    }


    public function getListConfig1Page1($page){
        $this->page1 = $page;
    }
    public function getListConfig1Page2($page){
        $this->page2 = $page;
    }
    public function getListConfig1Page3($page){
        $this->page2 = $page;
    }
    public function getListConfig1Page4($page){
        $this->page4 = $page;
    }
      // public $telcoFilter2;
    // public $providerCodeFilter2;
    // public $partnerCodeFilter2;

    public function getListConfig2(){
        $params = [];
        $params['pagination']['limit'] = 20;
        if($this->telcoFilter2){
            $params['query']['telco'] = $this->telcoFilter2;
        }
        if($this->providerCodeFilter2){
            $params['query']['providerCode'] = $this->providerCodeFilter2;
        }
        if($this->partnerCodeFilter2){
            $params['query']['partnerCode'] = $this->partnerCodeFilter2;
        }
        $TopupTelcoProviderConnection = new TopupTelcoProviderConnection();
        $data = $TopupTelcoProviderConnection->getListConfig2($params);
        // dd($data);
        if(isset($data->meta)){
            $this->page2 = $data->meta->page;
            $this->pages2 = $data->meta->pages;
            $this->limit2 = $data->meta->limit;
            $this->total2 = $data->meta->total;
        }
        if(isset($data->data)){
            $this->listConfig2 = $data->data;
        }


        // $logFile = 'laravel.log';
        // Log::useDailyFiles(storage_path().'/logs/'.$logFile);


    }

    public function getListConfig3(){
        $params = [];
        $params['pagination']['limit'] = 20;
        $params['pagination']['page']  = $this->page3;
        if(isset($this->telcoConfig3)){
            $params['query']['telco'] = $this->telcoConfig3;
        }
        if(isset($this->providerCodeConfig3)){
            $params['query']['providerCode'] = $this->providerCodeConfig3;
        }

        $TopupTelcoProviderConnection = new TopupTelcoProviderConnection();
        $data = $TopupTelcoProviderConnection->getListConfig3($params);

        if(isset($data->meta)){
            $this->page3 = $data->meta->page;
            $this->pages3 = $data->meta->pages;
            $this->limit3 = $data->meta->limit;
            $this->total3 = $data->meta->total;

        }
        if(isset($data->data)){
            $this->listConfig3 = $data->data;
        }



    }

    public function searchConfig3(
        $telco,
        $providerCode
    ){
        if(isset($telco)){
            $this->telcoConfig3 = $telco;
        }
        if(isset($providerCode)){
            $this->providerCodeConfig3 = $providerCode;
        }
        $this->success2 = 0;
        $this->success1 = 0;
        $this->success4 = 0;
        $this->success3 = 1;
    }

    public function getListConfig4(){
        $params = [];
        $params['pagination']['limit'] = 20;

        $params['query']['telco'] = '';
        if($this->telcoFilter4){
            $params['query']['telco'] = $this->telcoFilter4;
        }

        $params['query']['providerCode'] = '';
        if($this->providerCodeFilter4){
            $params['query']['providerCode'] = $this->providerCodeFilter4;
        }


        $TopupTelcoProviderConnection = new TopupTelcoProviderConnection();
        $data = $TopupTelcoProviderConnection->getListConfig4($params);
        // dd($data);
        if(isset($data->meta)){
            $this->page4 = $data->meta->page;
            $this->pages4 = $data->meta->pages;
            $this->limit4 = $data->meta->limit;
            $this->total4 = $data->meta->total;
        }
        if(isset($data->data)){
            $this->listConfig4 = $data->data;
        }



    }

    public function searchConfig4FilterConfig4($telcoFilter4){
        $params['query']['providerCode'] = '';
        $params['query']['telco'] = '';
        $this->telcoFilter4 = '';
        $this->providerCodeFilter4 = '';

        if($telcoFilter4['telcoFilter4']){
            $this->telcoFilter4 = $telcoFilter4['telcoFilter4'];
        }

        if($telcoFilter4['providerCodeFilter4']){
            $this->providerCodeFilter4 = $telcoFilter4['providerCodeFilter4'];
        }

        $this->success2 = 0;
        $this->success1 = 0;
        $this->success4 = 1;
        $this->success3 = 0;

    }

    public function searchConfig2FilterConfig2($data){
        $this->telcoFilter2 = '';
        $this->providerCodeFilter2 = '';
        $this->partnerCodeFilter2 = '';
        if($data['telcoFilter2']){
            $this->telcoFilter2 = $data['telcoFilter2'];
        }
        if($data['providerCodeFilter2']){
            $this->providerCodeFilter2 = $data['providerCodeFilter2'];
        }
        if($data['partnerCodeFilter2']){
            $this->partnerCodeFilter2 = $data['partnerCodeFilter2'];
        }
        $this->success2 = 1;
        $this->success1 = 0;
        $this->success4 = 0;
        $this->success3 = 0;
    }

    public function removeMessageUpdateDeleteConfig(){
        unset($this->message1);
        unset($this->message2);
        unset($this->message333);
        unset($this->message444);
    }
}
