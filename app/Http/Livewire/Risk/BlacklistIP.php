<?php

namespace App\Http\Livewire\Risk;

use Livewire\Component;
use App\Connection\blackListIPConnection;

class BlacklistIP extends Component
{
    protected $listeners = [
        'searchBlacklistiP' => 'searchBlacklistiP',
        'addNewBlacklistIP' => 'addNewBlacklistIP',
        'deleteBlacklistIP' => 'deleteBlacklistIP',
        'UpdateBlacklistIP' => 'UpdateBlacklistIP',
        'resetMessage' => 'resetMessage'
    ];
    public function render()
    {
        $this->getBlacklistIP();
        return view('livewire.risk.blacklist-i-p');
    }

    public $BlacklistIP;

    public $currentPage;
    public $totalPage;

    public $pageCurrent;

    public $ip;
    public $startTime;
    public $endTime;

    public function getBlacklistIP(){
        $params = [];
        $params['sort']['id'] = 'desc';
        $params['pagination']['limit'] = 20;
        if(isset($this->pageCurrent)){
            $params['pagination']['page'] = $this->pageCurrent;
        }
        if(isset($this->ip)){
            $params['filter']['ip'] = $this->ip;
        }

        if(isset($this->startTime)){
            $params['filter']['start_time'] = strtotime($this->startTime);
        }

        if(isset($this->endTime)){
            $params['filter']['end_time'] = strtotime($this->endTime);
        }


        $dataIP = blackListIPConnection::getList($params);


        if(isset($dataIP->data)){
            $this->BlacklistIP = $dataIP->data;
        }
        if(isset($dataIP->meta->page_current)){
            $this->currentPage = $dataIP->meta->page_current;

        }
        if(isset($dataIP->meta->total_pages)){
            $this->totalPage = $dataIP->meta->total_pages;
        }
    }

    public function searchBlacklistiP($ip, $startTime, $endTime){

        $this->ip = $ip;
        if(isset($startTime) && !empty($startTime)){
            $this->startTime = $startTime;
        }
        if(isset($endTime) && !empty($endTime)){
            $this->endTime = $endTime;
        }
    }

    public function deleteBlacklistIP($id){
        $result = blackListIPConnection::delete($id);
        if($result){
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::RISK_MANAGEMENT_BLACKLIST_IP, "Xoá blacklist IP", compact('id')));
        }
    }

    public $message;
    public $messageUpdate;
    public function addNewBlacklistIP($ip){
        if(isset($ip) and !empty($ip)){
            $params['ip'] = $ip;
            $result = blackListIPConnection::add($params);
            if($result){
                $this->message = "Add new successfully! IP: ". $ip;

                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::RISK_MANAGEMENT_BLACKLIST_IP, "Thêm mới blacklist IP", compact('params')));
            }
        }
    }

    public function UpdateBlacklistIP($id, $ip){
        if(isset($ip) and !empty($ip)){
            $params['ip'] = $ip;
        }
        if(isset($id) and !empty($id)){
            $result = blackListIPConnection::edit($id, $params);
            if($result){
                $this->messageUpdate = "Update successfully! IP: ". $ip;

                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::RISK_MANAGEMENT_BLACKLIST_IP, "Sửa blacklist IP", compact('id', 'params')));
            }
        }
    }

    public function resetMessage(){
        unset($this->message);
        unset($this->messageUpdate);
    }

    public function gotoPageCurrent($page){
        if($page < 1){
            $page = 1;
        }
        if($page > $this->totalPage){
            $page = $this->totalPage;
        }
        $this->pageCurrent = $page;
    }
}
