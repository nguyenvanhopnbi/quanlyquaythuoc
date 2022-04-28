<?php

namespace App\Http\Livewire\DoubleCheck;

use Livewire\Component;
use App\Connection\DoubleCheckConnection;
use Illuminate\Support\Facades\Auth;
use App\Exports\ConfirmScheduleExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;


class ConfirmScheduleDoubleCheck extends Component
{
    protected $listeners = [
        'AddnewScheduleConfirm' => 'AddnewScheduleConfirm',
        'deleteScheduleConfirm' => 'deleteScheduleConfirm',
        'updateConfirmSchedule' => 'updateConfirmSchedule',
        'SearchConfirmlichdoisoat' => 'SearchConfirmlichdoisoat',
        'ConfirmLichDoiSoat' => 'ConfirmLichDoiSoat',
        'ExportConfirmSchedule' => 'ExportConfirmSchedule'
    ];
    protected $listScheduleConfirm;

    public $currentPage;
    public $totalPage;
    public $pageCurrent;

    public $start;
    public $end;
    public $part = 10;

    public $message;
    public $warning = false;

    public function render()
    {
        $this->getList();
        return view('livewire.double-check.confirm-schedule-double-check', [
            'listScheduleConfirm' => $this->listScheduleConfirm
        ]);
    }

    public function ExportConfirmSchedule(
        // $startTimeSearch,
        // $endTimeSearch,
        // $createdBy,
        // $dateperform,
        // $isUsed,
        // $isConfirmSearch,
        // $scheduleCode,
        // $yearPerform
        Request $request
    ){

        // dd($request->all());

        $params = [];
        $params['pagination']['limit'] = 10000;
        $params['sort']['id'] = 'desc';
        // if(isset($this->pageCurrent)){
        //     $params['pagination']['page'] = $this->pageCurrent;
        // }

        if(isset($request->createdBy) and !empty($request->createdBy)){
            $params['filter']['created_by'] = $request->createdBy;
        }

        if($request->isUsed != ""){
            $params['filter']['is_used'] = $request->isUsed;
        }else{
            unset($params['filter']['is_used']);
        }

        if(isset($request->dateperform) and !empty($request->dateperform)){
            $params['filter']['date_perform'] = strtotime($request->dateperform);
        }

        if($request->isConfirmSearch != ""){
            $params['filter']['is_confirm'] = $request->isConfirmSearch;
        }else{
            unset($params['filter']['is_confirm']);
        }



        if(isset($request->startTimeSearch) and !empty($request->startTimeSearch)){
            $params['filter']['updated_at']['start_time'] = strtotime($request->startTimeSearch);
        }

        if(isset($request->endTimeSearch) and !empty($request->endTimeSearch)){
            $params['filter']['updated_at']['end_time'] = strtotime($request->endTimeSearch);
        }
        if(isset($request->scheduleCode) and $request->scheduleCode != 'all'){
            $params['filter']['reconciliation_schedule_code'] = $request->scheduleCode;
        }

        if(isset($request->yearPerform) and !empty($request->year_perform)){
            $params['filter']['year_perform'] = $request->yearPerform;
        }

        $dataExport = '';
        $data = DoubleCheckConnection::getListSchedule($params);
        if(isset($data->data)){
            $data = $data->data;
        }

        $begin = microtime(true);
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $fileName = date('YmdHis', time());
        header('Content-Type: application/json');
        header('Accept: application/json');
        header('Content-Type: application/vnd.ms-execl');
        header('Content-Disposition: attachment;filename="' . $fileName . '.csv"');

        $handle = fopen("php://output", 'a');
        // $path = storage_path('app/') . $fileName .'.csv';
        // $handle = fopen($path, 'w');
        $titleCol = [];

        fputs($handle, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

            foreach($data->data as $key => $data){

                if($key == 0){
                    foreach($data as $title=>$content){
                        if($title != 'logs'){
                            $titleCol[] = $title;
                        }

                    }

                    fputcsv($handle, $titleCol);
                }

                $data = (array)$data;
                $data['start_date'] = date('d-m-Y H:i:s', $data['start_date']);
                $data['end_date'] = date('d-m-Y H:i:s', $data['end_date']);
                $data['start_time'] = date('d-m-Y H:i:s', $data['start_time']);
                $data['end_time'] = date('d-m-Y H:i:s', $data['end_time']);
                $data['date_perform'] = date('d-m-Y', $data['date_perform']);
                ($data['reconciliation_schedule_code'] == 'every_day')?$data['reconciliation_schedule_code'] = 'Hằng ngày': '';
                ($data['reconciliation_schedule_code'] == 'every_week')?$data['reconciliation_schedule_code'] = 'Hằng Tuần': '';
                ($data['reconciliation_schedule_code'] == 'every_month')?$data['reconciliation_schedule_code'] = 'Hằng tháng': '';
                ($data['reconciliation_schedule_code'] == 'every_three_day')?$data['reconciliation_schedule_code'] = 'Ba ngày 1 lần': '';

                ($data['is_confirm'] == '1')?$data['is_confirm'] = 'Confirmed': $data['is_confirm'] = 'Not confirm';

                ($data['is_used'])?$data['is_used'] = 'YES': $data['is_used'] = 'NO';
                $data['created_at'] = date('d-m-Y H:i:s', $data['created_at']);
                $data['updated_at'] = date('d-m-Y H:i:s', $data['updated_at']);

                unset($data['logs']);

                fputcsv($handle, $data);
            }


        fclose($handle);
        ob_flush();
        flush();
        // return response()->download($path)->deleteFileAfterSend(true);
        $end = microtime(true);



        // return Excel::download(new ConfirmScheduleExport($dataExport), 'ConfirmScheduleExport.xlsx');
    }

    public function ConfirmLichDoiSoat($scheduleCode, $yearPerform){
        $params = [];
        $params['reconciliation_schedule_code'] = $scheduleCode;
        $params['year_perform'] = $yearPerform;
        $params['updated_by'] = Auth::user()->email;

        $result = DoubleCheckConnection::ConfirmLichDoiSoat($params);
        // dd($result);
        if(isset($result->success)){
            if($result->success){
                $this->message = "Confirm lịch đối soát thành công!";
                $this->warning = false;
                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_DOUBLE_CHECK_SCHEDULE_CONFIRM, "Confirm lịch đối soát CTT thành công", compact('params')));
            }else{
                $this->message = "Không thể confirm lịch đối soát!";
                $this->warning = true;
            }
        }
    }

    public $startTime;
    public $endTime;
    public $created_by;
    public $date_perform;
    public $is_used;
    public $is_confirm;
    public $reconciliation_schedule_code;
    public $year_perform;

    public function SearchConfirmlichdoisoat(
        $startTimeSearch,
        $endTimeSearch,
        $createdBy,
        $dateperform,
        $isUsed,
        $isConfirmSearch,
        $scheduleCode,
        $yearPerform

    ){


        if(isset($yearPerform) and !empty($yearPerform)){
            $this->year_perform = $yearPerform;
        }else{
            unset($this->year_perform);
        }

        if($scheduleCode != 'all'){
            $this->reconciliation_schedule_code = $scheduleCode;
        }else{
            unset($this->reconciliation_schedule_code);
        }

        if(isset($createdBy) and !empty($createdBy)){
            $this->created_by = $createdBy;
        }else{
            unset($this->created_by);
        }

        if(isset($isUsed) and !empty($isUsed)){
            $this->is_used = $isUsed;
        }else{
            unset($this->is_used);
        }

        if($isConfirmSearch != ""){
            $this->is_confirm = $isConfirmSearch;
        }else{
            unset($this->is_confirm);
        }


        if(isset($dateperform) and !empty($dateperform)){
            $this->date_perform = strtotime($dateperform . ' 00:00:00');
        }else{
            unset($this->date_perform);
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

    public $idUpdate;
    public $logUpdate;

    public function updateConfirmSchedule(
        $id,
        $startTime,
        $endTime,
        $datePerform,
        $yearPerform,
        $kieudoisoatupdate,
        $isConfirmedUpdate,
        $log
    ){
        $this->idUpdate = $id;
        $this->logUpdate = $log;
        $params = [];
        $params['id'] = $id;
        $params['start_time'] = strtotime($startTime);
        $params['end_time'] = strtotime($endTime);
        $params['date_perform'] = strtotime($datePerform);
        $params['year_perform'] = $yearPerform;
        $params['reconciliation_schedule_code'] = $kieudoisoatupdate;
        $params['is_confirm'] = $isConfirmedUpdate;
        $params['created_by'] = Auth::user()->email;
        $params['updated_by'] = Auth::user()->email;
        $params['logs'] = $log;

        $result = DoubleCheckConnection::updateScheduleReconciliation($this->idUpdate, $params);

        if($result == false){
            $this->message = "Không thể cập nhật đối soát, hãy kiểm tra lại dữ liệu nhập vào!";
            $this->warning = true;
            return;
        }

        if($result->success == true){
            $this->message = "Bạn đã cập nhật đối soát thành công!";
            $this->warning = false;
            $id = $this->idUpdate;
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_DOUBLE_CHECK_SCHEDULE_CONFIRM, "Sửa confirm lịch đối soát thành công", compact('params', 'id')));
        }else{
            $this->message = "Không thể cập nhật đối soát, hãy kiểm tra lại dữ liệu nhập vào!";
            $this->warning = true;
        }

    }

    public function deleteScheduleConfirm($id){
        $result = DoubleCheckConnection::deleteScheduleReconciliation($id);
        if($result){
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_DOUBLE_CHECK_SCHEDULE_CONFIRM, "Xoá confirm lịch đối soát thành công", compact('id')));
        }


    }

    public function AddnewScheduleConfirm(
        $startTimeSearchAddnew,
        $endTimeSearchAddnew,
        $TimeDatePerform,
        $namdoisoat,
        $kieudoisoat,
        $isConfirmed
    ){
        $params = [];
        $params['start_time'] = strtotime($startTimeSearchAddnew);
        $params['end_time'] = strtotime($endTimeSearchAddnew);
        $params['date_perform'] = strtotime($TimeDatePerform . '00:00:00');
        $params['year_perform'] = $namdoisoat;
        $params['reconciliation_schedule_code'] = $kieudoisoat;
        $params['is_confirm'] = $isConfirmed;
        $params['created_by'] = Auth::user()->email;
        $params['updated_by'] = Auth::user()->email;

        $result = DoubleCheckConnection::createScheduleReconciliation($params);
        if($result->success == true){
            $this->message = "Bạn vừa thêm mới đối soát thành công!";
            $this->warning = false;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_DOUBLE_CHECK_SCHEDULE_CONFIRM, "Thêm mới confirm lịch đối soát thành công", compact('params')));
        }else{
            $this->warning = true;
            $this->message = "Thêm mới thất bại, hãy check lại dữ liệu chuẩn!";
        }
    }



    public function getList(){
        $params = [];
        $params['pagination']['limit'] = 10;
        $params['sort']['id'] = 'desc';
        if(isset($this->pageCurrent)){
            $params['pagination']['page'] = $this->pageCurrent;
        }

        if(isset($this->created_by)){
            $params['filter']['created_by'] = $this->created_by;
        }

        if(isset($this->is_used)){
            $params['filter']['is_used'] = $this->is_used;
        }

        if(isset($this->date_perform)){
            $params['filter']['date_perform'] = $this->date_perform;
        }

        if(isset($this->is_confirm)){
            $params['filter']['is_confirm'] = $this->is_confirm;
        }

        if(isset($this->startTime)){
            $params['filter']['updated_at']['start_time'] = $this->startTime;
        }

        if(isset($this->endTime)){
            $params['filter']['updated_at']['end_time'] = $this->endTime;
        }
        if(isset($this->reconciliation_schedule_code)){
            $params['filter']['reconciliation_schedule_code'] = $this->reconciliation_schedule_code;
        }

        if(isset($this->year_perform)){
            $params['filter']['year_perform'] = $this->year_perform;
        }

        $data = DoubleCheckConnection::getListSchedule($params);

        if(isset($data->data)){

            foreach($data->data->data as $list){
                if($list->reconciliation_schedule_code == 'every_day'){
                    $list->reconciliation_schedule_code = 'Hằng ngày';
                }
                if($list->reconciliation_schedule_code == 'every_week'){
                    $list->reconciliation_schedule_code = "Hằng tuần";
                }
                if($list->reconciliation_schedule_code == 'every_month'){
                    $list->reconciliation_schedule_code = "Hằng tháng";
                }
                if($list->reconciliation_schedule_code == 'every_three_day'){
                    $list->reconciliation_schedule_code = "Ba ngày 1 lần";
                }
            }

            $this->listScheduleConfirm = $data->data;
            // dd($data);
        }

        if(isset($data->data->meta->page_current)){
            $this->currentPage = $data->data->meta->page_current;
        }
        if(isset($data->data->meta->total_pages)){
            $this->totalPage = $data->data->meta->total_pages;
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
}
