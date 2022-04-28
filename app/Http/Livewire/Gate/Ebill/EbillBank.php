<?php

namespace App\Http\Livewire\Gate\Ebill;

use Livewire\Component;
use App\Connection\EbillConnection;
use App\Services\Gate\TransferMoneyProviderService;
use App\Transformers\TransferMoneyProviderTransformer;

class EbillBank extends Component
{

    protected $listeners = [
        'saveNewEbillBank' => 'saveNewEbillBank',
        'deleteEbillBLank' => 'deleteEbillBLank',
        'updateEbillBank' => 'updateEbillBank',
        'searchEbillBank' => 'searchEbillBank'
    ];

    public function render()
    {
        $this->getListProvider();
        $this->getList();
        return view('livewire.gate.ebill.ebill-bank', [
            'getListEbillBank' => $this->getListEbillBank,
            'listProvider' => $this->listProvider
        ]);
    }

    protected $listProvider;

    public function getListProvider(){
        $params = [];
        $params['pagination']['perpage'] = 20000000;
        $data = TransferMoneyProviderService::getList($params);
        $data->data = TransferMoneyProviderTransformer::transformCollection($data->data);
        if(isset($data->data)){
            $this->listProvider = $data->data;
        }

    }

    protected $getListEbillBank;
    public $currentPage;
    public $totalPage;
    public $start;
    public $end;
    public $part = 10;

    public $pageCurrent = 1;

    public function getList(){
        $params = [];
        $params['pagination']['page'] = $this->pageCurrent;

        if(isset($this->bank_code)){
            $params['filter']['bank_code'] = $this->bank_code;
        }
        if(isset($this->bank_name)){
            $params['filter']['bank_name'] = $this->bank_name;
        }
        if(isset($this->transfer_provider_code)){
            $params['filter']['transfer_provider_code'] = $this->transfer_provider_code;
        }
        if(isset($this->ebill_provider_code)){
            $params['filter']['ebill_provider_code'] = $this->ebill_provider_code;
        }
        if(isset($this->active)){
            $params['filter']['active'] = $this->active;
        }
        if(isset($this->startTime)){
            $params['filter']['updated_at']['start_time'] = $this->startTime;
        }
        if(isset($this->endTime)){
            $params['filter']['updated_at']['end_time'] = $this->endTime;
        }

        // dump($params);
        $data = EbillConnection::getListEbillBank($params);

        if(isset($data->data)){
            $this->getListEbillBank = $data->data;
        }

        if(isset($data->meta->page_current)){
            $this->currentPage = $data->meta->page_current;
        }

        if(isset($data->meta->total_pages)){
            $this->totalPage = $data->meta->total_pages;
        }

        $this->start = $this->currentPage - $this->part;
        if($this->start < 1){
            $this->start = 1;
        }
        $this->end = $this->currentPage + $this->part;
        if($this->end > $this->totalPage){
            $this->end = $this->totalPage;
        }

    }

    public function gotoCurrentPage($page){
        if($page < 1){
            $page = 1;
        }
        if($page > $this->totalPage){
            $page = $this->totalPage;
        }

        $this->pageCurrent = $page;
    }

    public $bank_code;
    public $bank_name;
    public $transfer_provider_code;
    public $ebill_provider_code;
    public $active;
    public $startTime;
    public $endTime;

    public function searchEbillBank(
        $bank_code,
        $bank_name,
        $active,
        $transer_provider_code_search,
        $ebill_provider_code_search,
        $startTimeSearch,
        $endTimeSearch
    ){
        if(!empty($bank_code)){
            $this->bank_code = $bank_code;
        }else{
            unset($this->bank_code);
        }

        if(!empty($bank_name)){
            $this->bank_name = $bank_name;
        }else{
            unset($this->bank_name);
        }

        if($active != 'all'){
            $this->active = $active;
        }else{
            unset($this->active);
        }
        if(!empty($transer_provider_code_search)){
            $this->transfer_provider_code = $transer_provider_code_search;
        }else{
            unset($this->transfer_provider_code);
        }

        if(!empty($ebill_provider_code_search)){
            $this->ebill_provider_code = $ebill_provider_code_search;
        }else{
            unset($this->ebill_provider_code);
        }


        if(isset($startTimeSearch) and !empty($startTimeSearch)){
            $this->startTime = strtotime($startTimeSearch);
        }else{
            unset($this->startTime);
        }

        if(isset($endTimeSearch) and !empty($endTimeSearch)){
            $this->endTime = strtotime($endTimeSearch);
        }else{
            unset($this->endTime);
        }

    }

    public $message;
    public $warning = false;
    public $idUpdate;

    public function updateEbillBank(
        $id,
        $ebill_bank_code,
        $ebill_bank_name,
        $ebill_active,
        $ebill_transfer_provider_code,
        $ebill_provider_code
    ){
        $this->idUpdate = $id;

        $params = [];
        $params['id'] = $this->idUpdate;
        $params['bank_code'] = $ebill_bank_code;
        $params['bank_name'] = $ebill_bank_name;
        $params['active'] = $ebill_active;
        $params['transfer_provider_code'] = $ebill_transfer_provider_code;
        $params['ebill_provider_code'] = $ebill_provider_code;

        $result = EbillConnection::editEbillBank($params);
        if(!$result){
            $this->message = "Sửa thất bại.";
            $this->warning = true;
            return;
        }
        if(isset($result->errorCode)){
            if($result->errorCode == 0){
                $this->message = "Sửa thành công. Bank Code: ". $ebill_bank_code;
                $this->warning = false;

                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::EBILL_BANK, "Sửa Ebill Bank thành công", compact('params')));
            }else{
                $this->message = "Sửa thất bại. Bank Code: ". $ebill_bank_code;
                $this->warning = true;
            }
        }
    }

    public function deleteEbillBLank($id){
        $params = [];
        $params['id'] = $id;
        $result = EbillConnection::deleteEbillBank($params);
        if(isset($result->errorCode)){
            if($result->errorCode == 0){
                $this->message = "Xóa thành công ID: ". $id;
                $this->warning = false;
                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::EBILL_BANK, "Xóa Ebill Bank thành công", compact('id','params')));
            }
        }
    }

    public function saveNewEbillBank(
        $ebill_bank_code,
        $ebill_bank_name,
        $ebill_active,
        $ebill_transfer_provider_code,
        $ebill_provider_code
    ){
        $params = [];
        $params['bank_code'] = $ebill_bank_code;
        $params['bank_name'] = 'no value';
        $params['active'] = $ebill_active;
        $params['transfer_provider_code'] = $ebill_transfer_provider_code;
        if(isset($ebill_provider_code) and !empty($ebill_provider_code)){
            $params['ebill_provider_code'] = $ebill_provider_code;
        }else{
            $params['ebill_provider_code'] = 'No value';
        }



        $result = EbillConnection::saveNewEbillBank($params);
        if(!$result){
            $this->message = "Thêm mới thất bại. Bank Code.";
            $this->warning = true;
            return;
        }
        if($result->errorCode == 0){

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::EBILL_BANK, "Thêm mới Ebill Bank thành công", compact('params')));

            $this->message = "Thêm mới thành công. Bank Code: ". $ebill_bank_code;
            $this->warning = false;
        }else{
            $this->message = "Thêm mới thất bại. Bank Code: ". $result->message;
            $this->warning = true;
        }

    }
}
