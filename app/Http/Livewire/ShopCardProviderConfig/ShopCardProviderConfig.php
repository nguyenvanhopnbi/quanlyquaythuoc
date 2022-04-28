<?php

namespace App\Http\Livewire\ShopCardProviderConfig;

use Livewire\Component;
use App\Connection\ShopCardProviderConfigConnection;

class ShopCardProviderConfig extends Component
{
    protected $listeners = [
        'searchShopCardProviderConfig' => 'searchShopCardProviderConfig',
        'addNewShopCardProviderConfig' => 'addNewShopCardProviderConfig',
        'deleteShopCardProviderConfig' => 'deleteShopCardProviderConfig',
        'updateShopCardProviderConfig' => 'updateShopCardProviderConfig',
        'resetMessage' => 'resetMessage'
    ];
    public function render()
    {
        $this->getList();
        return view('livewire.shop-card-provider-config.shop-card-provider-config');
    }

    public function resetMessage(){
        unset($this->message);
        unset($this->warning);
    }

    public $message;
    public $warning = false;
    public $IDproviderConfigUpdate;

    public function deleteShopCardProviderConfig($id){
        $result = ShopCardProviderConfigConnection::delete($id);
        if($result->errorCode == 0){
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::SHOPCARD_PROVIDERCONFIG, "Xoá shop card provider config", compact('id')));
        }
    }

    public function updateShopCardProviderConfig($id, $secretKey, $rsaPublicKey, $rsaPrivateKey){

        $this->IDproviderConfigUpdate = $id;
        $params = [];
        $params['secretKey'] = $secretKey;
        $params['rsaPublicKey'] = $rsaPublicKey;
        $params['rsaPrivateKey'] = $rsaPrivateKey;

        $result = ShopCardProviderConfigConnection::edit($id, $params);
        if($result->errorCode == 0){
            $this->message = "Update successfully!";
            $this->warning = false;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::SHOPCARD_PROVIDERCONFIG, "Sửa shop card provider config", compact('id', 'params')));

        }else{
            $this->message = "Please check your input again! ";
            $this->warning = true;
        }
    }

    public function addNewShopCardProviderConfig($providerCode, $secretKey, $rsaPublicKey, $rsaPrivateKey){
        $params = [];
        $params['providerCode'] = $providerCode;
        $params['secretKey'] = $secretKey;
        $params['rsaPublicKey'] = $rsaPublicKey;
        $params['rsaPrivateKey'] = $rsaPrivateKey;

        $result = ShopCardProviderConfigConnection::add($params);
        if($result->errorCode == 0){
            $this->message = "Add new successfully! Provider Code: ".$providerCode;
            $this->warning = false;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::SHOPCARD_PROVIDERCONFIG, "Thêm mới shop card provider config", compact('params')));

        }else{
            $this->message = "Please check your input again! Provider Code: ".$providerCode;
            $this->warning = true;
        }

    }

    public function searchShopCardProviderConfig($providerCode){
        $this->providerCode = $providerCode;
    }

    public $providerShopCardList;
    public $currentPage = 1;
    public $totalPage = 1;
    public $part = 10;
    public $start;
    public $end;

    public $pageCurrent;

    public $providerCode;

    public function getList(){
        $params = [];
        $params['pagination']['limit'] = 20;
        $params['sort']['id'] = 'desc';
        if(isset($this->pageCurrent)){
            $params['pagination']['page'] = $this->pageCurrent;
        }
        if(isset($this->providerCode)){
            $params['query']['providerCode'] = $this->providerCode;
        }
        $data = ShopCardProviderConfigConnection::getList($params);
        // dd($data);

        if(isset($data->data)){
            $this->providerShopCardList = $data->data;
        }
        if(isset($data->meta->page)){
            $this->currentPage = $data->meta->page;
        }
        if(isset($data->meta->pages)){
            $this->totalPage = $data->meta->pages;
        }

        $this->start = $this->currentPage - $this->part;
        if($this->start < 1){
            $this->start = 1;
        }

        // dump($this->totalPage);
        $this->end = $this->currentPage + $this->part;
        if($this->end > $this->totalPage){
            $this->end = $this->totalPage;
        }
    }

    public function getCurrentPage($page){
        if($page < 1){
            $page = 1;
        }
        if($page > $this->totalPage){
            $page = $this->totalPage;
        }

        $this->pageCurrent = $page;
    }
}
