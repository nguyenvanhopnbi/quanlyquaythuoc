<?php

namespace App\Http\Livewire\Gate\Ebill;

use Livewire\Component;
use App\Connection\EbillConnection;
use Illuminate\Http\Request;
use App\Connection\DoubleCheckConnection;
use Illuminate\Support\Facades\Auth;

class ScheduleDetails extends Component
{


    protected $listeners = [
        'search' => 'search',
        'addnew' => 'addnew',
        'update' => 'update',
        'deleteScheduleDetailsVA' => 'deleteScheduleDetailsVA',
        'ExportScheduleVACSV' => 'ExportScheduleVACSV',
        'confirmSchedule' => 'confirmSchedule'
    ];

    public function render()
    {
        return view('livewire.gate.ebill.schedule-details', [
            'dataList' => $this->getList()
        ]);
    }

    public $message;
    public $success;
    public $warning;


    public function confirmSchedule($scheduleCode, $yearPerform){

        $params = [];
        $params['reconciliation_schedule_code'] = $scheduleCode;
        $params['year_perform'] = $yearPerform;
        $params['updated_by'] = Auth::user()->email;
        $result = DoubleCheckConnection::ConfirmLichDoiSoatVA($params);
        // dd($result);
        if(isset($result->success)){
            if($result->success){
                $this->message = "Confirm lịch đối soát VA thành công!";
                $this->warning = false;
                $this->emit('messageScript', [
                    'message' => $this->message,
                    'warning' => $this->warning,
                ]);

                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_DOUBLE_CHECK_SCHEDULE_CONFIRM, "Confirm lịch đối soát VA thành công", compact('params')));
            }else{
                $this->message = "Không thể confirm lịch đối soát!";
                $this->warning = true;

                $this->emit('messageScript', [
                    'message' => $this->message,
                    'warning' => $this->warning,
                ]);
            }
        }
    }


    public function exportCSV(Request $request){
        $params = [];
        $params['pagination']['limit'] = 10000;

        if(isset($request->startTime)){
            $params['filter']['updated_at']['start_time'] = strtotime($request->startTime);
        }

        if(isset($request->endTime)){
            $params['filter']['updated_at']['end_time'] = strtotime($request->endTime);
        }

        if(isset($request->dateTime)){
            $params['filter']['date_perform'] = strtotime($request->dateTime);
        }
        if(isset($request->createdBy)){
            $params['filter']['created_by'] = $request->createdBy;
        }
        if(isset($request->isUsed)){
            $params['filter']['is_used'] = $request->isUsed;
        }
        if(isset($request->isConfirmed)){
            $params['filter']['is_confirm'] = $request->isConfirmed;
        }

        if($request->search_schedule_code != 'all'){
            $params['filter']['reconciliation_schedule_code'] = $request->search_schedule_code;
        }

        if(isset($request->yearPerform)){
            $params['filter']['year_perform'] = $request->yearPerform;
        }

        $dataList = EbillConnection::getListScheduleDetails($params);

        if(isset($dataList->data->meta->total_pages)){
            $pages = $dataList->data->meta->total_pages;
        }

        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $fileName = date('YmdHis', time());
        header('Content-Type: application/vnd.ms-execl');
        header('Content-Disposition: attachment;filename="' . $fileName . '.csv"');

        $handle = fopen("php://output", 'a');
        fputs($handle, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

        $firstTime = 1;
        for ($i=1; $i <=$pages ; $i++) {
            $params['pagination']['page'] = $i;

            $data = EbillConnection::getListScheduleDetails($params);

            foreach($data->data->data as $key => $data){
                $data = (array)$data;
                unset($data['logs']);


                $data['start_date'] = date('d-m-Y H:i:s', $data['start_date']);
                $data['end_date'] = date('d-m-Y H:i:s', $data['end_date']);
                $data['start_time'] = date('d-m-Y H:i:s', $data['start_time']);
                $data['end_time'] = date('d-m-Y H:i:s', $data['end_time']);
                $data['created_at'] = date('d-m-Y H:i:s', $data['created_at']);
                $data['updated_at'] = date('d-m-Y H:i:s', $data['updated_at']);
                $data['date_perform'] = date('d-m-Y H:i:s', $data['date_perform']);

                if($data['is_confirm'] == 1){
                    $data['is_confirm'] = 'TRUE';
                }else{
                    $data['is_confirm'] = 'FALSE';
                }

                if($data['is_used'] == 1){
                    $data['is_used'] = 'YES';
                }else{
                    $data['is_used'] = 'NO';
                }

                if($key == 0 and $firstTime == 1){
                    foreach($data as $title=>$content){
                        $tit[] = $title;
                    }
                    fputcsv($handle, $tit);
                    $firstTime++;
                }

                fputcsv($handle, $data);
            }

        }
        unset($data);

        fclose($handle);
        ob_flush();
        flush();
        $end = microtime(true);
    }


    public function update
    ($id, $startTime, $endTime, $datePerform, $createdBy, $yearPerform, $updatedBy, $scheduleCode, $isConfirm, $update_logs)
    {
        $params['id'] = $id;
        $params['start_time'] = strtotime($startTime);
        $params['end_time'] = strtotime($endTime);
        $params['date_perform'] = strtotime($datePerform);
        $params['created_by'] = $createdBy;
        $params['year_perform'] = $yearPerform;
        $params['updated_by'] = $updatedBy;
        $params['reconciliation_schedule_code'] = $scheduleCode;
        $params['is_confirm'] = $isConfirm;
        $params['logs'] = $update_logs;

        $result = EbillConnection::updateScheduleVADetails($params);

        if(isset($result->success) and $result->success){
            $this->message = "Update lịch đối soát VA thành công!";
            $this->success =  true;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::EBILL_CROSS_CHECK, "Update lịch đối soát thành công!, params: ". json_encode($params) , compact('params')));
        }else{
            $this->message = "Update lịch đối soát VA thất bại!";
            $this->success =  false;
        }

        $this->emit('messageScript', [
            'message' => $this->message,
            'success' => $this->success
        ]);
    }

    public function deleteScheduleDetailsVA($id){
        $params['id'] = $id;
        $result = EbillConnection::deleteScheduleVADetails($params);

        if(isset($result->success) and $result->success){
            $this->message = "Xóa lịch đối soát VA thành công!";
            $this->success =  true;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::EBILL_CROSS_CHECK, "Xóa lịch đối soát thành công!, params: ". json_encode($params) , compact('params')));
        }else{
            $this->message = "Xóa lịch đối soát VA thất bại!";
            $this->success =  false;
        }

        $this->emit('messageScript', [
            'message' => $this->message,
            'success' => $this->success
        ]);
    }


    public function addnew
    (
        $addnew_startTime, $addnew_endTime, $addnew_date_perform, $created_by, $year_perform, $updated_by, $reconciliation_schedule_code, $is_confirm, $is_used
    )
    {
        $params['start_time'] = strtotime($addnew_startTime);
        $params['end_time'] = strtotime($addnew_endTime);
        $params['date_perform'] = strtotime($addnew_date_perform);

        $params['created_by'] = $created_by;
        $params['year_perform'] = $year_perform;
        $params['updated_by'] = $updated_by;
        $params['reconciliation_schedule_code'] = $reconciliation_schedule_code;
        $params['is_confirm'] = $is_confirm;
        $params['is_used'] = $is_used;

        $result = EbillConnection::createScheduleVADetails($params);

        if(isset($result->success) and $result->success){
            $this->message = "Thêm mới lịch đối soát VA thành công!";
            $this->success =  true;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::EBILL_CROSS_CHECK, "Thêm mới lịch đối soát thành công!, params: ". json_encode($params) , compact('params')));
        }else{
            $this->message = "Thêm mới lịch đối soát VA thất bại!";
            $this->success =  false;
        }

        $this->emit('messageScript', [
            'message' => $this->message,
            'success' => $this->success
        ]);

    }


    public $start_time;
    public $end_time;
    public $date_perform;
    public $created_by;
    public $is_used;
    public $is_confirm;
    public $reconciliation_schedule_code;
    public $year_perform;


    public $currentPage;
    public $totalPage;
    public $part = 10;
    public $start;
    public $end;

    public $pageCurrent;


    public function getList(){
        $params = [];
        $params['pagination']['limit'] = 20;

        if(isset($this->pageCurrent)){
            $params['pagination']['page'] = $this->pageCurrent;
        }

        if(isset($this->start_time)){
            $params['filter']['updated_at']['start_time'] = $this->start_time;
        }

        if(isset($this->end_time)){
            $params['filter']['updated_at']['end_time'] = $this->end_time;
        }

        if(isset($this->date_perform)){
            $params['filter']['date_perform'] = $this->date_perform;
        }
        if(isset($this->created_by)){
            $params['filter']['created_by'] = $this->created_by;
        }
        if(isset($this->is_used)){
            $params['filter']['is_used'] = $this->is_used;
        }
        if(isset($this->is_confirm)){
            $params['filter']['is_confirm'] = $this->is_confirm;
        }

        if(isset($this->reconciliation_schedule_code)){
            $params['filter']['reconciliation_schedule_code'] = $this->reconciliation_schedule_code;
        }

        if(isset($this->year_perform)){
            $params['filter']['year_perform'] = $this->year_perform;
        }

        $dataList = EbillConnection::getListScheduleDetails($params);

        if(isset($dataList->data)){

            if(isset($dataList->data->meta->page_current)){
                $this->currentPage = $dataList->data->meta->page_current;
            }

            if(isset($dataList->data->meta->total_pages)){
                $this->totalPage = $dataList->data->meta->total_pages;
            }

            $this->start = $this->currentPage - $this->part;
            if($this->start < 1){
                $this->start = 1;
            }
            $this->end = $this->currentPage + $this->part;

            if($this->end > $this->totalPage){
                $this->end = $this->totalPage;
            }

            return $dataList->data->data;
        }
        return null;
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

    public function search($start_time, $end_time, $date_perform, $created_by, $is_used, $is_confirm, $reconciliation_schedule_code, $year_perform){

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

        if(isset($date_perform) and !empty($date_perform)){
            $this->date_perform = strtotime($date_perform);
        }else{
            unset($this->date_perform);
        }

        if(isset($created_by) and !empty($created_by)){
            $this->created_by = $created_by;
        }else{
            unset($this->created_by);
        }

        if(!empty($is_used)){
            $this->is_used = $is_used;
        }else{
            unset($this->is_used);
        }

        if($is_used == ""){
            unset($this->is_used);
        }


        if($is_confirm == 1){
            $this->is_confirm = true;
        }
        else if($is_confirm == 0){
            $this->is_confirm = false;
        }else{
            unset($this->is_confirm);
        }
        if($is_confirm == ""){
            unset($this->is_confirm);
        }

        if(isset($reconciliation_schedule_code) and !empty($reconciliation_schedule_code) and $reconciliation_schedule_code != 'all'){
            $this->reconciliation_schedule_code = $reconciliation_schedule_code;
        }else{
            unset($this->reconciliation_schedule_code);
        }

        if(isset($year_perform) and !empty($year_perform)){
            $this->year_perform = $year_perform;
        }else{
            unset($this->year_perform);
        }

    }
}
