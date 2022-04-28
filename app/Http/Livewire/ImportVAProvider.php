<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Connection\BillServiceConnection;
use App\Services\Gate\CollectMoneyPartnerService;
use App\Jobs\ImportEbillProviderJob;

class ImportVAProvider extends Component
{
    protected $listeners = [
        'ImportVAProvider' => 'ImportVAProvider'
    ];
    public function render()
    {
        $this->getListProviderCode();
        return view('livewire.import-v-a-provider', [
            'providerCodeList' => $this->providerCodeList
        ]);
    }

    // public function ImportVAProviderTEST(){
    //     TestJob::dispatch();
    // }

    protected $providerCodeList = [];

    public function getListProviderCode(){
        $params = [];
        $params['pagination']['perpage'] = 10000;
        $data = CollectMoneyPartnerService::getList($params);
        if(isset($data->data)){
            $this->providerCodeList = $data->data;
        }
        // dd($this->providerCodeList);

    }

    public function checkListProviderCode($providerCode){
        $params = [];
        $params['pagination']['perpage'] = 10000;
        $data = CollectMoneyPartnerService::getList($params);
        if(isset($data->data)){
            foreach($data->data as $data){
                if($data->provider_code == $providerCode){
                    return true;
                }
            }
        }

        return false;

    }


    public $message;
    public $warning = false;

    public function ImportVAProvider($provider_code, $dataArray){

        $checkProviderCode = $this->checkListProviderCode($provider_code);

        if(!$checkProviderCode){
            $this->message = "Không tồn tại provider code " . $provider_code;
            $this->warning = true;
            return;
        }

        $dataArray = array_chunk($dataArray, 10000);
        $params = [];
        $params['provider_code'] = $provider_code;

        $count = 0;
        foreach($dataArray as $data){
            $count++;
            $params['data'] = $data;
            // ImportEbillProviderJob::dispatch($count, $params);

            $result = BillServiceConnection::ImportVAProvider($params);
            if(!$result or $result->errorCode != 0){
                $this->message = "Import thất bại!";
                $this->warning = true;
                return;
            }

        }
        // dd($count);

        if(!$result){
            $this->message = "Import thất bại!";
            $this->warning = true;
        }
        if(isset($result->errorCode)){
            if($result->errorCode == 0){
                $this->message = $result->message . ' ' .$provider_code;
                $this->warning = false;

                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::BILL_SERVICE, "Import ebill virtual account provider #".$provider_code, compact('params')));

            }else{
                $this->message = "Import thất bại!";
                $this->warning = true;
            }
        }

    }
}
