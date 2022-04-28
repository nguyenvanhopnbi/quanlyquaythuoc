<?php

namespace App\Http\Livewire\Gate\Ebill;

use Livewire\Component;
use App\Connection\EbillConnection;
use App\Connection\PartnerConnection;
use Illuminate\Http\Request;

class EbillVAReconciliationData extends Component
{

    protected $listeners = [
        'SearchebillVa' => 'SearchebillVa',
        'changeConfirmVAEbill' => 'changeConfirmVAEbill',
        'changeRefuseVAEbill' => 'changeRefuseVAEbill',
        'SearchChodoisoatduyet' => 'SearchChodoisoatduyet',
        'Tuchoi' => 'Tuchoi',
        'Khongduyet' => 'Khongduyet',
        'Daduyet' => 'Daduyet',
        'Choxacnhan' => 'Choxacnhan',
        'Xacnhanthanhcong' => 'Xacnhanthanhcong',
        'Tatcastatus' => 'Tatcastatus',
        'getDetailsLogs' => 'getDetailsLogs',
        'changeStatusConfirm' => 'changeStatusConfirm',
        'changeStatusRefuse' => 'changeStatusRefuse',
        'loading' => 'loading',
        'selectTotalRecord' => 'selectTotalRecord'

    ];

    public $totalRecord;
    public $start;
    public $end;
    public $currentPage;
    public $totalPage;
    public $part = 10;
    public $limit = 10;

    public $pageCurrent;



    public $message;
    public $warning = false;
    public function render()
    {
        // $this->getDetailsLogs(6);
        return view('livewire.gate.ebill.ebill-v-a-reconciliation-data',[
            'dataList' => $this->getList(),
            'partnerCodeList' => $this->partnerCodeList()
        ]);
    }

    public function selectTotalRecord($limit){
        $this->limit = $limit;
    }


    public function Tatcastatus(){
        unset($this->status);
        // $this->status = 'all';
    }

    public function Xacnhanthanhcong(){
        $this->status = 'confirm_success';
    }

    public function Choxacnhan(){
        $this->status = 'wait_confirm';
    }
    public function Daduyet(){
        $this->status = 'processing';
    }

    public function Khongduyet(){
        $this->status = 'non_processing';
    }

    public function Tuchoi(){
        $this->status = 'confirm_fail';
    }

    public function SearchChodoisoatduyet(){
        $this->status = 'pending';
    }


    public function changeStatusConfirm($id){

        $idArr = (array_filter($id, function($v, $k) {
            return $v != 'check-all';
        }, ARRAY_FILTER_USE_BOTH));

        $count = 0;
        $error = [];

        $success = [];

        foreach($idArr as $id){
            // $result = DoubleCheckConnection::confirm($id);
            $params['id'] = $id;
            $result = EbillConnection::ConfirmVAReconciliationData($params);

            if(!$result){

                $error[$count]['id'] = $id;
                $error[$count]['message'] = 'Confirm thất bại!';

                $count++;

            }else{
                $success[$count]['id'] = $id;
                $success[$count]['message'] = 'Confirm thành công!';
                $count++;

                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_DOUBLE_CHECK, "Xác nhận đối soát VA thành công #ID: " . $id, compact('id')));
            }
        }

        $this->emit('messageConfirmAllScript', [
            'success' => $success,
            'error' => $error,
            'countSuccess' => count($success),
            'countError' => count($error)
        ]);


    }

    public $result_changeStatusRefuse = null;

    public function loading(){

        if(isset($this->result_changeStatusRefuse)){
            return true;
        }

        return false;
    }


    public function changeStatusRefuse($idArr, $reason){
        $count = 0;
        $error = [];
        $success = [];

        $params = [];
        $params['reason'] = $reason;

        if($reason == ""){
            $this->emit('messageScript', [
                'message' => 'Bạn bắt buộc phải nhập lý do!',
                'id' => $idArr,
                'warning' => true
            ]);

            return;
        }

        foreach($idArr as $id){

            $params['id'] = $id;

            // $result = DoubleCheckConnection::Noconfirm($params);
            $result = EbillConnection::RefuseVAReconciliationData($params);
            // $this->result_changeStatusRefuse = $result;
            if(!$result){

                $error[$count]['id'] = $id;
                $error[$count]['message'] = 'Từ chối thất bại!';

                $count++;

            }else{
                $success[$count]['id'] = $id;
                $success[$count]['message'] = 'Từ chối thành công!';
                $count++;

                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_DOUBLE_CHECK, "Từ chối đối soát VA thành công #ID " .$id , compact('id', 'params')));
            }
        }

        // $this->result_changeStatusRefuse = null;

        $this->emit('messageRefuseAllScript', [
            'success' => $success,
            'error' => $error,
            'countSuccess' => count($success),
            'countError' => count($error)
        ]);
    }

    public function changeRefuseVAEbill($id, $reason){
        $params['id'] = $id;
        $params['reason'] = $reason;


        if($reason == ""){
            $this->emit('messageScript', [
                'message' => 'Bạn bắt buộc phải nhập lý do!',
                'id' => $id,
                'warning' => true
            ]);

            return;
        }


        $result = EbillConnection::RefuseVAReconciliationData($params);
        if(isset($result->success) and $result->success){
            $this->message = "Từ chối thành công!";
            $this->warning = false;


            $this->emit('messageScript', [
                'message' => $this->message,
                'warning' => $this->warning
            ]);

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_DOUBLE_CHECK, "Từ chối đối soát VA thành công" . json_encode($params), compact('id')));
        }
    }

    public function changeConfirmVAEbill($id){
        $params['id'] = $id;
        // $params['reason'] = $reason;
        $result = EbillConnection::ConfirmVAReconciliationData($params);
        if(isset($result->success) and $result->success){
            $this->message = "Xác nhận thành công!";
            $this->warning = false;


            $this->emit('messageScript', [
                'message' => $this->message,
                'warning' => $this->warning
            ]);

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_DOUBLE_CHECK, "Xác nhận đối soát VA thành công" . json_encode($params), compact('id')));
        }

    }

    public function partnerCodeList(){
        $params['pagination']['limit'] = 10000;
        $data = PartnerConnection::getList($params);
        return $data;
    }

    public $partner_code;
    public $startTime;
    public $endTime;
    public $date_perform_reconciliation;
    public $schedule_code;
    public $status;
    public $sum_recieve;

    public function SearchebillVa(
        $partner_code,
        $startTime,
        $endTime,
        $date_perform_reconciliation,
        $schedule_code,
        $sum_recieve
    ){

        $this->partner_code = $partner_code;

        if(isset($startTime) and !empty($startTime)){
            $this->startTime = strtotime($startTime);
        }else{
            unset($this->startTime);
        }

        if(isset($endTime) and !empty($endTime)){
            $this->endTime = strtotime($endTime);
        }else{
            unset($this->endTime);
        }

        if(isset($date_perform_reconciliation) and !empty($date_perform_reconciliation)){
            $this->date_perform_reconciliation = strtotime($date_perform_reconciliation);
        }else{
            unset($this->date_perform_reconciliation);
        }

        $this->schedule_code = $schedule_code;

        $this->sum_recieve = $sum_recieve;

    }

    public $pending;
    public $confirm_fail;
    public $non_processing;
    public $processing;
    public $wait_confirm;
    public $confirm_success;

    public function getList(){

        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $params = [];
        // $params['pagination']['limit'] = 10;
        if(isset($this->limit)){
            $params['pagination']['limit'] = $this->limit;
        }



        if(isset($this->pageCurrent)){
            $params['pagination']['page'] = $this->pageCurrent;
        }

        if(isset($this->partner_code)){
            $params['filter']['partner_code'] = $this->partner_code;
        }

        if(isset($this->startTime)){
            $params['filter']['startTime'] = $this->startTime;
        }

        if(isset($this->endTime)){
            $params['filter']['endTime'] = $this->endTime;
        }

        if(isset($this->date_perform_reconciliation)){
            $params['filter']['date_perform_reconciliation'] = $this->date_perform_reconciliation;
        }
        if(isset($this->schedule_code) and $this->schedule_code != 'all'){
            $params['filter']['schedule_code'] = $this->schedule_code;
        }

        if(isset($this->status) and $this->status != ''){
            $params['filter']['status'] = $this->status;
        }

        $str = ['.', 'đ', ' '];

        if(isset($this->sum_recieve) and $this->sum_recieve != ''){
            $params['filter']['sum_receive'] = str_replace($str, "", $this->sum_recieve);
        }

        $dataList = EbillConnection::getListVAReconciliationData($params);

        if(isset($dataList->meta->group_by_data)){

            foreach($dataList->meta->group_by_data as $metaData){
                if($metaData->status == 'pending'){
                    $this->pending = $metaData->count_total;
                }

                if($metaData->status == 'confirm_fail'){
                    $this->confirm_fail = $metaData->count_total;
                }

                if($metaData->status == 'non_processing'){
                    $this->non_processing = $metaData->count_total;
                }

                if($metaData->status == 'processing'){
                    $this->processing = $metaData->count_total;
                }

                if($metaData->status == 'wait_confirm'){
                    $this->wait_confirm = $metaData->count_total;
                }

                if($metaData->status == 'confirm_success'){
                    $this->confirm_success = $metaData->count_total;
                }
            }

        }

        // if(isset($dataList->data)){
        //     foreach($dataList->data as $data){
        //         $data->logs2 = json_decode($data->logs);
        //         if(isset($data->logs2->logs->list_trans_ids_total)){
        //             $data->ids = $data->logs2->logs->list_trans_ids_total;
        //         }else{
        //             $data->ids = "";
        //         }
        //     }
        // }


        if(isset($dataList->meta->page_current)){
            $this->currentPage = $dataList->meta->page_current;
        }

        if(isset($dataList->meta->total_pages)){
            $this->totalPage = $dataList->meta->total_pages;
        }

        if(isset($dataList->meta->total_record)){
            $this->totalRecord = $dataList->meta->total_record;
        }

        if(isset($dataList->meta->limit)){
            $this->limit = $dataList->meta->limit;
        }

        $this->start = $this->currentPage - $this->part;
        if($this->start < 1){
            $this->start = 1;
        }
        $this->end = $this->currentPage + $this->part;

        if($this->end > $this->totalPage){
            $this->end = $this->totalPage;
        }

        return $dataList;
    }

    public function ExportCSV(Request $request){

        $params = [];

        $params['pagination']['limit'] = 30;

        if(isset($request->partner_code)){
            $params['filter']['partner_code'] = $request->partner_code;
        }

        if(isset($request->startTime)){
            $params['filter']['startTime'] = $request->startTime;
        }

        if(isset($request->endTime)){
            $params['filter']['endTime'] = $request->endTime;
        }

        if(isset($request->date_perform_reconciliation)){
            $params['filter']['date_perform_reconciliation'] = $request->date_perform_reconciliation;
        }
        if(isset($request->search_schedule_code) and $request->search_schedule_code != 'all'){
            $params['filter']['schedule_code'] = $request->search_schedule_code;
        }

        // if(isset($this->status) and $this->status != ''){
        //     $params['filter']['status'] = $this->status;
        // }

        $str = ['.', 'đ', ' '];

        if(isset($request->sum_recieve) and $request->sum_recieve != ''){
            $params['filter']['sum_receive'] = str_replace($str, "", $request->sum_recieve);
        }

        $data = EbillConnection::getListVAReconciliationData($params);

        if(!$data){
            return 'Không tìm thấy dữ liệu';
        }

        $page = $data->meta->page_current;
        $pages = $data->meta->total_pages;

        $header = [
            'ID',
            'Partner Code',
            'Kỳ đối soát',
            'Ngày gửi đối soát',
            'Chu kỳ đối soát',
            'Tổng doanh thu',
            // 'Tổng hoàn tiền',
            // 'Tổng hold',
            // 'Tổng unhold',
            // 'Tổng volume đối soát',
            'Tổng phí',
            'Tổng nhận',
            'TTCKTT',
            'Trạng thái'
        ];


        $begin = microtime(true);
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $fileName = date('YmdHis', time()) . '-cross-check';
        header('Content-Type: application/json');
        header('Accept: application/json');
        header('Content-Type: application/vnd.ms-execl');
        header('Content-Disposition: attachment;filename="' . $fileName . '.csv"');

        $handle = fopen("php://output", 'a');

        fputs($handle, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
        fputcsv($handle, $header);

        if($pages >= 1){
            for($i = 1; $i<= $pages; $i++){
                $params['pagination']['page'] = $i;
                $params['pagination']['limit'] = 30;
                $data = EbillConnection::getListVAReconciliationData($params);
                $num = 1;
                foreach($data->data as $data){

                    $dataCSV[] = $data->id;
                    $dataCSV[] = $data->partner_code;
                    $dataCSV[] = date('d-m-Y H:i:s', $data->start_date) . ' - ' . date('d-m-Y H:i:s', $data->end_date);
                    $dataCSV[] = date('d-m-Y H:i:s', $data->date_perform_reconciliation);
                    if($data->schedule_code == 'every_day') $schedule_code = "Hằng ngày";
                    if($data->schedule_code == 'every_week') $schedule_code = "Hằng tuần";
                    if($data->schedule_code == 'every_month') $schedule_code = "Hằng tháng";
                    if($data->schedule_code == 'every_three_day') $schedule_code = "Ba ngày 1 lần";
                    $dataCSV[] = $schedule_code;
                    $dataCSV[] = $data->sum_revenue;
                    // $dataCSV[] = $data->sum_refund;
                    // $dataCSV[] = $data->sum_hold;
                    // $dataCSV[] = $data->sum_unhold;
                    // $dataCSV[] = $data->sum_revenue - $data->sum_refund - $data->sum_hold + $data->sum_unhold;

                    $dataCSV[] = $data->sum_cost;
                    $dataCSV[] = $data->sum_receive;
                    $dataCSV[] = $data->sum_transfer_direct;
                    if($data->status == 'pending'){
                        $status = 'Chờ xử lý';
                    }
                    if($data->status == 'processing'){
                        $status = 'Duyệt';
                    }
                    if($data->status == 'non_processing'){
                        $status = 'Không duyệt';
                    }
                    if($data->status == 'wait_confirm'){
                        $status = 'Chờ xác nhận';
                    }
                    if($data->status == 'confirm_success'){
                        $status = 'Xác nhận';
                    }
                    if($data->status == 'confirm_fail'){
                        $status = 'Từ chối';
                    }
                    $dataCSV[] = $status;

                    fputcsv($handle, $dataCSV);
                    $dataCSV = [];

                }


            }
        }




        fclose($handle);
        ob_flush();
        flush();
        $end = microtime(true);

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

    public $logsData;

    public function getDetailsLogs($id){
        $params = [];
        $dataList = EbillConnection::getDetailsLogs($id);
        if(isset($dataList->logs)){
            $this->logsData = $dataList->logs;
        }else{
            $this->logsData = "";
        }
    }
    public function partnerReconciliationDataExport(Request $request){

        // $ids = implode(',', array_unique(explode(',', $request->ids)));
        $params['ids'] = "";

        $dataList = EbillConnection::getListVAReconciliationDataDetails($request->id);

        if(!$dataList){
            return;
        }
        $dataList->logs = json_decode($dataList->logs);

        if(isset($dataList->logs->logs->list_trans_ids_total)){
            $params['ids'] = $dataList->logs->logs->list_trans_ids_total;
        }

        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $fileName = date('YmdHis', time());
        header('Content-Type: application/vnd.ms-execl');
        header('Content-Disposition: attachment;filename="' . $fileName . '.csv"');

        $handle = fopen("php://output", 'a');
        fputs($handle, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

            $data = EbillConnection::ExportVAReconciliationData($params);
            $firstTime = 1;
            foreach($data->data as $key => $data){
                $data = (array)$data;

                if($firstTime == 1){
                    foreach($data as $title=>$content){
                        $tit[] = $title;
                    }
                    fputcsv($handle, $tit);
                    $firstTime++;
                }

                if(isset($data['created_at'])){
                    $data['created_at'] = date('d-m-Y H:i:s', $data['created_at']);
                }

                if(isset($data['updated_at'])){
                    $data['updated_at'] = date('d-m-Y H:i:s', $data['updated_at']);
                }
                if(isset($data['transaction_time'])){
                    $data['transaction_time'] = date('d-m-Y H:i:s', $data['transaction_time']);
                }

                fputcsv($handle, $data);
            }


        unset($data);

        fclose($handle);
        ob_flush();
        flush();
        $end = microtime(true);
    }




}
