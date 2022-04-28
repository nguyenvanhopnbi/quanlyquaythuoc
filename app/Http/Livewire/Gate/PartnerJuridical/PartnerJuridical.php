<?php

namespace App\Http\Livewire\Gate\PartnerJuridical;

use Livewire\Component;
use App\Connection\partnerJuridicalConnection;
use App\Connection\PartnerConnection;

class PartnerJuridical extends Component
{

    protected $listeners = [
        'searchPartnerJuridical' => 'searchPartnerJuridical',
        'savePartnerJuridical' => 'savePartnerJuridical',
        'resetMessage' => 'resetMessage',
        'deletePartnerCooperate' => 'deletePartnerCooperate',
        'UpdatePartnerJuridical' => 'UpdatePartnerJuridical'
    ];

    public function render()
    {
        $this->getList();
        $this->getPartnerCodeList();
        return view('livewire.gate.partner-juridical.partner-juridical');
    }

    public $listPartnerJuridical;
    public $currentPage;
    public $totalPage;

    public $pageCurrent;


    public $partnerCode;
    public $startTime;
    public $endTime;

    public function getList(){
        $params = [];
        $params['sort']['id'] = 'desc';
        $params['pagination']['limit'] = 20;

        if(isset($this->partnerCode)){
            $params['filter']['partner_code'] = $this->partnerCode;
        }

        if(isset($this->startTime)){
            $params['filter']['start_time'] = $this->startTime;
        }

        if(isset($this->endTime)){
            $params['filter']['end_time'] = $this->endTime;
        }

        if(isset($this->pageCurrent)){
            $params['pagination']['page'] = $this->pageCurrent;
        }

        $data = partnerJuridicalConnection::getList($params);
        if(isset($data->data)){
            $this->listPartnerJuridical = $data->data;
        }
        if(isset($data->meta->page_current)){
            $this->currentPage = $data->meta->page_current;
        }
        if(isset($data->meta->total_pages)){
            $this->totalPage = $data->meta->total_pages;
        }
    }

    protected $queryString = [
        'partnerCode' => ['except' => ''],
        'startTime' => ['except' => ''],
        'endTime' => ['except' => '']
    ];

    public function searchPartnerJuridical($partnerCode, $startTime, $endTime){
        $this->partnerCode = $partnerCode;
        if(isset($startTime) and !empty($startTime)){
            $this->startTime = strtotime($startTime);
        }else{
            $this->startTime = '';
        }

        if(isset($endTime) and !empty($endTime)){
            $this->endTime = strtotime($endTime);
        }else{
            $this->endTime = '';
        }
    }

    public $IDPartnerCo;
    public function UpdatePartnerJuridical($id, $partner_code, $title, $details, $point){
        $this->IDPartnerCo = $id;

        if(!$this->checkPartnerCode($partner_code)){
            $this->message = "PartnerCode: ".$partner_code. " is not existed!";
            return;
        }

        if(!is_numeric($point)){
            $this->message = "Point must be numberic!";
            return;
        }

        $params['partner_code'] = $partner_code;
        $params['title'] = $title;
        $params['detail'] = $details;
        $params['point'] = $point;

        $result = partnerJuridicalConnection::edit($id, $params);
        if($result){
            $this->message = "Update successfully! PartnerCode: ". $partner_code." and Title: ".$title. " Details: ".$details." and Point: ".$point;
            $this->warning = false;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_JRIDICAL, "Sửa Partner Juridical", compact('id', 'params')));

        }else{
            $this->message = $result. " Please check your input data or contact dev!";
            $this->warning = true;
        }

    }

    public $message;
    public $warning = true;

    public function resetMessage(){
        unset($this->message);
        unset($this->warning);
    }

    public function deletePartnerCooperate($id){
        $result = partnerJuridicalConnection::delete($id);
        if($result){
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_JRIDICAL, "Xoá Partner Juridical", compact('id')));
        }
    }

    public function savePartnerJuridical($partnerCode, $title, $detail, $point){

        if(!$this->checkPartnerCode($partnerCode)){
            $this->message = "PartnerCode: ".$partnerCode. " is not existed!";
            return;
        }

        if(!is_numeric($point)){
            $this->message = "Point must be numberic!";
            return;
        }

        $params['partner_code'] = $partnerCode;
        $params['title'] = $title;
        $params['detail'] = $detail;
        $params['point'] = $point;

        $result = partnerJuridicalConnection::add($params);
        if($result){
            $this->message = "Add successfully! PartnerCode: ". $partnerCode." and Title: ".$title. " Details: ".$detail." and Point: ".$point;
            $this->warning = false;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_JRIDICAL, "Thêm mới Partner Juridical", compact('params')));

        }else{
            $this->message = $result. " Please check your input data or contact dev!";
            $this->warning = true;
        }

    }

    public function checkPartnerCode($partnerCode){
        $params = [];
        $data = PartnerConnection::getList($params);
        $list = [];
        if($data->meta->total){
            $params['pagination']['limit'] = $data->meta->total;
            $data = PartnerConnection::getList($params);
            if(isset($data->data)){
                foreach($data->data as $data){
                    $list[] = $data->partner_code;
                }
                if(in_array($partnerCode, $list)){
                    return true;
                }
            }
        }
        return false;
    }

    public $partnerCodeList;

    public function getPartnerCodeList()
    {
        $params = [];
        $data = PartnerConnection::getList($params);
        if(isset($data->meta->total)){
            $params['pagination']['limit'] = $data->meta->total;
            $data = PartnerConnection::getList($params);
            if(isset($data->data)){
                $this->partnerCodeList = $data->data;
            }
        }
        // dd($data);
    }

    public function gotoCurrentpage($page){
        if($page < 1){
            $page = 1;
        }
        if($page > $this->totalPage){
            $page = $this->totalPage;
        }

        $this->pageCurrent = $page;
    }
}
