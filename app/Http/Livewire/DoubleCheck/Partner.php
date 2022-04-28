<?php

namespace App\Http\Livewire\DoubleCheck;

use Livewire\Component;
use App\Connection\DoubleCheckConnection;
use App\Connection\PartnerConnection;

class Partner extends Component
{

    protected $listeners = [
        'SearchDoisoattheoPartner' => 'SearchDoisoattheoPartner',
        'deleteCheckPartner' => 'deleteCheckPartner',
        'AddnewDoiSoatTheoPartner' => 'AddnewDoiSoatTheoPartner',
        'UpdateDoisoattheopartner' => 'UpdateDoisoattheopartner',
        'ExportDoisoatPartner' => 'ExportDoisoatPartner'
    ];
    public function render()
    {
        $this->getList();
        $this->getPartner();
        return view('livewire.double-check.partner', [
            'dataList' => $this->dataList,
            'partnerList' => $this->partnerList,
            'tongRecords' => $this->tongRecords
        ]);
    }

    public function ExportDoisoatPartner(
        $partner_code, $start_time, $end_time, $chukydoisoat
    ){
        $params = [];
        $params['sort']['id'] = 'desc';

        if(isset($this->chukydoisoat)){
            $params['filter']['schedule_code'] = $this->chukydoisoat;
        }

        if(isset($this->partner_code)){
            $params['filter']['partner_code'] = $this->partner_code;
        }
        if(isset($this->start_time)){
            $params['filter']['startTime'] = $this->start_time;
        }
        if(isset($this->end_time)){
            $params['filter']['endTime'] = $this->end_time;
        }


        if(isset($this->pageCurrent)){
            $params['pagination']['page'] = $this->pageCurrent;
        }

        $data = DoubleCheckConnection::getListDoiSoatvoiPartner($params);

        $begin = microtime(true);
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $fileName = date('YmdHis', time());
        header('Content-Type: application/json');
        header('Accept: application/json');
        header('Content-Type: application/vnd.ms-execl');
        header('Content-Disposition: attachment;filename="' . $fileName . '.csv"');

        // $handle = fopen("php://output", 'a');
        $path = storage_path('app/') . $fileName .'.csv';
        $handle = fopen($path, 'w');
        $titleCol = [];

        fputs($handle, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

            foreach($data->data as $key => $data){

                if($key == 0){
                    foreach($data as $title=>$content){
                        $titleCol[] = $title;
                    }
                    fputcsv($handle, $titleCol);
                }

                $data = (array)$data;

                ($data['schedule_code'] == 'every_day')?$data['schedule_code'] = 'Hằng ngày': '';
                ($data['schedule_code'] == 'every_week')?$data['schedule_code'] = 'Hằng Tuần': '';
                ($data['schedule_code'] == 'every_month')?$data['schedule_code'] = 'Hằng tháng': '';
                ($data['schedule_code'] == 'every_three_day')?$data['schedule_code'] = 'Ba ngày 1 lần': '';
                $data['created_at'] = date('d-m-Y H:i:s', $data['created_at']);
                $data['updated_at'] = date('d-m-Y H:i:s', $data['updated_at']);

                fputcsv($handle, $data);
            }


        fclose($handle);
        ob_flush();
        flush();
        return response()->download($path)->deleteFileAfterSend(true);
        $end = microtime(true);
    }

    public function UpdateDoisoattheopartner($id, $partnerCode, $scheduleCode){
        $params = [];
        $params['partner_code'] = $partnerCode;
        $params['schedule_code'] = $scheduleCode;
        $result = DoubleCheckConnection::updateScheduleCode($id, $params);
        if(isset($result->success)){
            if($result->success){
                $this->message = "Sửa đối soát theo partner thành công!";
                $this->warning = false;
                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_DOUBLE_CHECK_DOISOAT, "Sửa đối soát theo partner thành công", compact('params', 'id')));
            }else{
                $this->message = "Không thể sửa đối soát theo partner!";
                $this->warning = true;
            }
        }

    }


    public $message;
    public $warning = false;
    public $UpdateDoisoattheopartner;

    public function AddnewDoiSoatTheoPartner($partnerCode, $scheduleCode){
        if(!$this->checkPartner($partnerCode)){
            $this->message = "Partner không tồn tại";
            $this->warning = true;
            return;
        }


        $params = [];
        $params['partner_code'] = $partnerCode;
        $params['schedule_code'] = $scheduleCode;

        $result = DoubleCheckConnection::addDoisoatthePartner($params);
        if(!$result){
            $this->message = "Không thể mới đối soát theo partner! Hãy kiểm tra lại dữ liệu nhập vào!";
            $this->warning = true;
            return;
        }
        if($result->success){
            $this->message = "Thêm mới đối soát theo partner thành công";
            $this->warning = false;
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_DOUBLE_CHECK_DOISOAT, "Thêm mới đối soát theo partner thành công", compact('params')));
        }else{
            $this->message = "Không thêm thêm mới đối soát theo partner, hãy kiểm tra lại dữ liệu nhập!";
            $this->warning = true;
        }


    }

    public function deleteCheckPartner($id){
        $result = DoubleCheckConnection::deleteDoisoattheopartner($id);

        if($result){
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_DOUBLE_CHECK_DOISOAT, "Xoá đối soát theo partner thành công", compact('id')));
        }
    }

    public function SearchDoisoattheoPartner($partner_code, $start_time, $end_time, $chukydoisoat){
        $this->partner_code = $partner_code;

        if($chukydoisoat != "all"){
            $this->chukydoisoat = $chukydoisoat;
        }else{
            unset($this->chukydoisoat);
        }


        if(isset($start_time) and !empty($start_time)){
            $this->start_time = strtotime($start_time);
        }else{
            unset($this->start_time);
        }

        if(isset($end_time) and !empty($end_time)){
            $this->end_time = strtotime($end_time);
        }else{
            unset($this->end_time);
        }
    }

    public $partner_code;
    public $start_time;
    public $end_time;

    protected $dataList;
    public $currentPage;
    public $totalPage;

    public $pageCurrent;

    public $start;
    public $end;
    public $part = 10;

    public $chukydoisoat;

    protected $tongRecords;

    public function getList(){
        $params = [];
        $params['pagination']['limit'] = 20;
        $params['sort']['id'] = 'desc';

        if(isset($this->chukydoisoat)){
            $params['filter']['schedule_code'] = $this->chukydoisoat;
        }

        if(isset($this->partner_code)){
            $params['filter']['partner_code'] = $this->partner_code;
        }
        if(isset($this->start_time)){
            $params['filter']['startTime'] = $this->start_time;
        }
        if(isset($this->end_time)){
            $params['filter']['endTime'] = $this->end_time;
        }


        if(isset($this->pageCurrent)){
            $params['pagination']['page'] = $this->pageCurrent;
        }

        $data = DoubleCheckConnection::getListDoiSoatvoiPartner($params);
        // dd($data);
        if(isset($data->data)){
            foreach($data->data as $list){
                if($list->schedule_code == 'every_day'){
                    $list->schedule_code = 'Hằng ngày';
                }
                if($list->schedule_code == 'every_week'){
                    $list->schedule_code = 'Hằng tuần';
                }
                if($list->schedule_code == 'every_month'){
                    $list->schedule_code = 'Hằng tháng';
                }
                if($list->schedule_code == 'every_three_day'){
                    $list->schedule_code = 'Ba ngày 1 lần';
                }

            }
            $this->dataList = $data->data;
        }
        if(isset($data->meta->total_record)){
            $this->tongRecords = $data->meta->total_record;
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

    protected $partnerList;
    public function getPartner(){
        $params = [];
        $params['pagination']['limit'] = 1000000;
        $data = PartnerConnection::getList($params);
        if(isset($data->data)){
            $this->partnerList = $data->data;
        }
    }

    public function checkPartner($partnerCode){
        $params = [];
        $params['pagination']['limit'] = 1000000;
        $data = PartnerConnection::getList($params);
        if(isset($data->data)){
            $partnerList = $data->data;
            foreach($partnerList as $list){
                if($list->partner_code == $partnerCode){
                    return true;
                }
            }
        }

        return false;
    }

}
