<?php

namespace App\Http\Livewire\Gate\PartnerDocumentReport;

use Livewire\Component;
use App\Connection\partnerDocumentReportConnection;
use App\Connection\PartnerConnection;
use App\Services\Gate\TransferMoneyProviderService;

class PartnerConfigProvider extends Component
{
    protected $totalPage;
    protected $start;
    protected $end;
    protected $part = 10;

    public $providerCode;
    public $partnerCode;
    public $startTime;
    public $endTime;

    protected $currentPage;
    protected $message;
    protected $warning = false;
    protected $IDUPdate;
    protected $partnerCodeList;
    protected $providerList;
    protected $pageCurrent;
    protected $DataList;

    protected $listeners = [
        'searchPartnerConfigProvider' => 'searchPartnerConfigProvider',
        'addnewPartnerCodeConfig' => 'addnewPartnerCodeConfig',
        'deletePartnerProviderConfig' => 'deletePartnerProviderConfig',
        'PartnerProviderConfigUpdate' => 'PartnerProviderConfigUpdate',
        'resetMessage' => 'resetMessage'
    ];
    public function render()
    {
        $this->getList();
        $this->getPartnerCode();
        $this->getProvider();
        return view('livewire.gate.partner-document-report.partner-config-provider', [
            'partnerCodeList' => $this->partnerCodeList,
            'currentPage' => $this->currentPage,
            'message' => $this->message,
            'warning' => $this->warning,
            'IDUPdate' => $this->IDUPdate,
            'providerList' => $this->providerList,
            'pageCurrent' => $this->pageCurrent,
            'DataList' => $this->DataList,
            'totalPage' => $this->totalPage,
            'start' => $this->start,
            'end' => $this->end
        ]);
    }

    public function getProvider(){
        $TransferMoneyProviderService = new TransferMoneyProviderService();
        $params = [];
        $params['pagination']['perpage'] = 1000000000000;
        $data = $TransferMoneyProviderService->getList($params);
        if(isset($data->data)){
            $this->providerList = $data->data;
        }
    }

    public $providerCodeArray = [];

    public function checkProviderCode($providerCode){
        $TransferMoneyProviderService = new TransferMoneyProviderService();
        $params = [];
        $params['pagination']['perpage'] = 1000000000000;
        $data = $TransferMoneyProviderService->getList($params);
        if(isset($data->data)){
            foreach($data->data as $pro){
                $this->providerCodeArray[] = $pro->providerCode;
            }

            if(in_array($providerCode, $this->providerCodeArray)){
                return true;
            }
        }
        return false;
    }

    public function checkPartnerCode($partnerCode){
        // dd('vao day');
        $partnerCodeArray = [];
        $params = [];
        $params['pagination']['limit'] = 100000000;
        $data = PartnerConnection::getList($params);

        if(isset($data->data)){
            foreach($data->data as $partner){
                $partnerCodeArray[] = $partner->partner_code;
            }
            if(in_array($partnerCode, $partnerCodeArray)){
                return true;
            }
        }

        return false;
    }

    public function getList(){
        $params = [];
        $params['pagination']['limit'] = 20;
        if(isset($this->pageCurrent)){
            $params['pagination']['page'] = $this->pageCurrent;
        }

        if(isset($this->providerCode)){
            $params['query']['providerCode'] = $this->providerCode;
        }
        if(isset($this->partnerCode)){
            $params['query']['partnerCode'] = $this->partnerCode;
        }

        if(isset($this->startTime)){
            $params['query']['startTime'] = $this->startTime;
        }

        if(isset($this->endTime)){
            $params['query']['endTime'] = $this->endTime;
        }

        $data = partnerDocumentReportConnection::getListPartnerProvider($params);
        // dd($data);
        if(isset($data->data)){
            $this->DataList = $data->data;

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
        $this->end = $this->currentPage + $this->part;
        if($this->end > $this->totalPage){
            $this->end = $this->totalPage;
        }
        // dd($data);
    }



    public function resetMessage(){
        unset($this->message);
        unset($this->warning);
    }

    public function PartnerProviderConfigUpdate($id, $providerCode, $partnerCode){


        if(!$this->checkPartnerCode($partnerCode)){
            $this->message = "Partner Code ".$partnerCode." không tồn tại!";
            $this->warning = true;
            return;
        }

        if(!$this->checkProviderCode($providerCode)){
            $this->message = "Provider Code ".$providerCode." không tồn tại!";
            $this->warning = true;
            return;
        }

        $this->IDUPdate = $id;
        $params = [];
        $params['providerCode'] = $providerCode;
        $params['partnerCode'] = $partnerCode;

        $result = partnerDocumentReportConnection::editPartnerProvider($id, $params);
        if(!$result){
            $this->warning = true;
            $this->message = "Provider đã tồn tại, chú ý là một provider chỉ được cấu hình với 1 partner";
            return;
        }
        if($result->errorCode == 0){
            $this->message = "Update successfully! Provider Code: " . $providerCode . " Partner Code: " .$partnerCode;
            $this->warning = false;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TRANSFER_MONEY_CONFIG_PROVIDER_PARTNER, "Sửa cấu hình provider theo partner thành công", compact('id', 'params')));

        }
    }

    public function deletePartnerProviderConfig($id){
        if(!empty($id)){
            $result = partnerDocumentReportConnection::deletePartnerProvider($id);
            if(!$result){
                return;
            }

            if($result->errorCode == 0){
                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TRANSFER_MONEY_CONFIG_PROVIDER_PARTNER, "Xoá cấu hình provider theo partner thành công", compact('id')));
            }
        }

    }

    public function addnewPartnerCodeConfig($providerCode, $partnerCode){

        if(!$this->checkProviderCode($providerCode)){
            $this->message = "Provider Code ".$providerCode." không tồn tại!";
            $this->warning = true;
            return;
        }

        if(!$this->checkPartnerCode($partnerCode)){
            $this->message = "Partner Code ".$partnerCode." không tồn tại!";
            $this->warning = true;
            return;
        }


        $params = [];
        if(!empty($providerCode)){
            $params['providerCode'] = $providerCode;
        }

        if(!empty($partnerCode)){
            $params['partnerCode'] = $partnerCode;
        }

        $result = partnerDocumentReportConnection::addPartnerProvider($params);
        if(!$result){
            $this->warning = true;
            $this->message = "Provider Code: ". $providerCode . ' and Partner Code: '. $partnerCode . ' are existed already!';
            return;
        }
        if($result->errorCode == 0){
            $this->message = "Add new successfully! PartnerCode: ". $partnerCode . " Provider Code: ".$providerCode;
            $this->warning = false;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TRANSFER_MONEY_CONFIG_PROVIDER_PARTNER, "Thêm mới cấu hình provider theo partner thành công", compact('params')));

        }
        else{
            $this->warning = true;
            $this->message = "Please check your input data or contact dev!";
        }

    }

    public function searchPartnerConfigProvider($providerCode, $partnerCode, $startTime, $endTime){
        $this->providerCode = $providerCode;
        $this->partnerCode = $partnerCode;

        if(!empty($startTime)){
            $this->startTime = strtotime($startTime);
        }else{
            unset($this->startTime);
        }
        if(!empty($endTime)){
            $this->endTime = strtotime($endTime);
        }else{
            unset($this->endTime);
        }
    }


    public function getPartnerCode(){
        $params = [];
        $params['pagination']['limit'] = 100000000;
        $data = PartnerConnection::getList($params);
        if(isset($data->data)){
            $this->partnerCodeList = $data->data;
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
}
