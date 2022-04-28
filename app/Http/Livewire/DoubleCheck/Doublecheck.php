<?php

namespace App\Http\Livewire\DoubleCheck;

use Livewire\Component;

use App\Connection\DoubleCheckConnection;
use App\Connection\PartnerConnection;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class Doublecheck extends Component
{
    protected $transactionList;

    protected $listeners = [
        'confirmDoubleCheck' => 'confirmDoubleCheck',
        'NoconfirmDoubleCheck' => 'NoconfirmDoubleCheck',
        'selectTotalRecord' => 'selectTotalRecord',
        'Search' => 'Search',
        'SearchChodoisoatduyet' => 'SearchChodoisoatduyet',
        'Tuchoi' => 'Tuchoi',
        'Khongduyet' => 'Khongduyet',
        'Daduyet' => 'Daduyet',
        'Choxacnhan' => 'Choxacnhan',
        'Xacnhanthanhcong' => 'Xacnhanthanhcong',
        'Tatcastatus' => 'Tatcastatus',
        'BienBanDoiSoat' => 'BienBanDoiSoat',
        'ExportTransactionCrossCheck' => 'ExportTransactionCrossCheck',
        'changeStatusConfirm' => 'changeStatusConfirm',
        'changeStatusRefuse' => 'changeStatusRefuse'
    ];



    public function render()
    {
        // $this->getListVAids();
        $this->getList();
        $this->getPartnerCodeList();
        return view('livewire.double-check.doublecheck', [
            'transactionList' => $this->transactionList,
            'partnerCodeList' => $this->partnerCodeList
        ]);
    }

    // public function getListVAids(){
    //     $params = [];
    //     $dataList = DoubleCheckConnection::getListVAids($params);
    //     dd($dataList);
    // }

    public $transactionListExport;
    public $idString;


    public function partnerVABankTransactionDataExport(Request $request){
        $params = [];
        if(isset($request->ids)){
            $params['filter']['id'] = $request->ids;
        }

        $data = DoubleCheckConnection::getList($params);

        if(isset($data->data)){
            $this->transactionListExport = $data->data;
            foreach($this->transactionListExport as $list){
                $j = json_decode($list->logs);
                $list->logs = $j;
            }
        }
        $idList = "";
        if(isset($data->data[0]->logs->logs->list_trans_ids_total)){
            $idList = $data->data[0]->logs->logs->list_trans_ids_total;
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
        fputs($handle, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));


        $countTitle = 1;


        $idArrChunk = array_chunk(explode(',', $idList), 100);
        foreach($idArrChunk as $idArr){
            $params = [];
            $params['ids'] = implode(',', $idArr);
            $data = DoubleCheckConnection::getListDataTransaction($params);
            if(!$data){
                return;
            }
            foreach($data->data as $key => $data){
                unset($data->application_name);
                unset($data->vendor_ref_id);
                unset($data->vendor_callback_data);
                unset($data->extra_info);
                unset($data->application_id);
                unset($data->vendor_code);
                unset($data->error_code);
                unset($data->error_message);
                unset($data->extra_data);
                unset($data->client_ip);
                unset($data->order_version);
                unset($data->token);
                unset($data->action);

                $tittleArr = [];
                if($key == 0 and $countTitle == 1){
                    foreach($data as $title=>$content){
                        $tittleArr[] = $title;
                    }

                    fputcsv($handle, $tittleArr);
                    $countTitle++;
                }

                if(isset($data->request_time)){
                    $data->request_time = date('d-m-Y H:i:s', $data->request_time);
                }
                if(isset($data->response_time)){
                    $data->response_time = date('d-m-Y H:i:s', $data->response_time);
                }

                if(isset($data->time_hold)){
                    $data->time_hold = date('d-m-Y H:i:s', $data->time_hold);
                }

                if(isset($data->time_un_hold)){
                    $data->time_un_hold = date('d-m-Y H:i:s', $data->time_un_hold);
                }

                if(isset($data->time_refund)){
                    $data->time_refund = date('d-m-Y H:i:s', $data->time_refund);
                }

                $data = (array)$data;

                fputcsv($handle, $data);
            }

        }



        fclose($handle);
        ob_flush();
        flush();
        $end = microtime(true);


    }

    public function partnerVABankTransactionDataExportVA(Request $request){

        $begin = microtime(true);
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $fileName = date('YmdHis', time()) . '-VA';
        header('Content-Type: application/json');
        header('Accept: application/json');
        header('Content-Type: application/vnd.ms-execl');
        header('Content-Disposition: attachment;filename="' . $fileName . '.csv"');
        $handle = fopen("php://output", 'a');
        fputs($handle, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

        $countTitle = 1;
        $idArrChunk = "";
        $params = [];
        $params['filter']['id'] = $request->id;
        $data = DoubleCheckConnection::getList($params);

        $data->data[0]->logs = json_decode($data->data[0]->logs);

        if(isset($data->data[0]->logs->logs->list_partner_tx_id)){
            $idArrChunk = array_chunk(explode(',', $data->data[0]->logs->logs->list_partner_tx_id), 1000);
        }else{
            $data = [];
        }
        // dd($idArrChunk);

        foreach($idArrChunk as $ids){
            $params = [];
            $params['ids'] = implode(',', $ids);
            $data = DoubleCheckConnection::getListVAidsExport($params);

            if(!$data){
                return;
            }

            foreach($data->data as $key => $data){
                $tittleArr = [];
                if($key == 0 and $countTitle == 1){
                    foreach($data as $title=>$content){
                        if($title != 'callback_data'){
                            $tittleArr[] = $title;
                        }

                    }
                    fputcsv($handle, $tittleArr);
                    $countTitle++;
                }

                if(isset($data->timestamp)){
                    $data->timestamp = date('d-m-Y H:i:s', $data->timestamp);
                }
                if(isset($data->callback_data)){
                    unset($data->callback_data);
                }

                $data = (array)$data;
                fputcsv($handle, $data);
            }

        }


        fclose($handle);
        ob_flush();
        flush();
        $end = microtime(true);
    }

    public $messageExport;

    public function ExportTransaction($id){
        if($this->idString == ''){
            $this->messageExport = "Không tìm thấy TransactionID nào.";
            return;
        }
        return redirect()->route('double-check.downloadCSV', [
            'id' => $id
        ]);



    }

    protected $partnerCodeList;
    public function getPartnerCodeList(){
        $params = [];
        $params['pagination']['limit'] = 10000000;
        $data = PartnerConnection::getList($params);
        // dd($data);
        if(isset($data->data)){
            $this->partnerCodeList = $data->data;
            // foreach($data->data as $partner){
            //     $this->partnerName = $partner->name;
            // }
        }

        // dump($this->partnerName);
    }

    public function BienBanDoiSoat($id, $partnerCode){
        return redirect()->route('double-check.bienbandoisoat', [
            'id' => $id,
            'partnerCode' => $partnerCode
        ]);
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

    public function Search($madoisoat, $partner_code_search, $startTime, $endTime, $statusChecked, $TimeSearchPerform, $schedule_code_search, $sum_receive){

        $this->madoisoat = $madoisoat;

        $this->sum_receive = $sum_receive;

        $this->partnerCode = $partner_code_search;

        if(isset($startTime) and !empty($startTime)){
            $this->startTimeSearch = strtotime($startTime);
        }else{
            $this->startTimeSearch = '';
        }
        if(isset($endTime) and !empty($endTime)){
            $this->endTimeSearch = strtotime($endTime);
        }else{
            $this->endTimeSearch = '';
        }

        $this->status = $statusChecked;

        if(isset($TimeSearchPerform) and !empty($TimeSearchPerform)){
            $this->ngaydoisoat = strtotime($TimeSearchPerform . " 00:00:00");
        }else{
            $this->ngaydoisoat = '';
        }

        if($schedule_code_search != 'all'){
            $this->chukydoisoat = $schedule_code_search;
        }else{
            $this->chukydoisoat = '';
        }


    }

    public function confirmDoubleCheck($id){

        $result = DoubleCheckConnection::confirm($id);
        // dd($result);
        if(!$result){
            session()->flash('message', 'Chỉ được confirm khi trạng thái giao dịch là pending!');
            $this->warning = true;

            $this->emit('messageConfirmScript', [
                'message' => 'Đã duyệt thất bại 1 đối soát ID '.$id,
                'warning' => $this->warning
            ]);

            return;
        }else{
            session()->flash('message', 'Confirm thành công!');
            $this->warning = false;
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_DOUBLE_CHECK, "Xác nhận đối soát thành công " . $id, compact('id')));


            $this->emit('messageConfirmScript', [
                'message' => 'Đã duyệt thành công 1 đối soát ID '.$id,
                'warning' => $this->warning
            ]);


            return;
        }
    }

    public function changeStatusConfirm($idArr){

        $count = 0;
        $error = [];

        $success = [];

        $idArr = (array_filter($idArr, function($v, $k) {
            return $v != 'check-all';
        }, ARRAY_FILTER_USE_BOTH));


        foreach($idArr as $id){
            $result = DoubleCheckConnection::confirm($id);
            if(!$result){

                $error[$count]['id'] = $id;
                $error[$count]['message'] = 'Confirm thất bại!';

                $count++;

            }else{
                $success[$count]['id'] = $id;
                $success[$count]['message'] = 'Confirm thành công!';
                $count++;

                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_DOUBLE_CHECK, "Xác nhận đối soát thành công #ID: " . $id, compact('id')));
            }
        }

        $this->emit('messageConfirmAllScript', [
            'success' => $success,
            'error' => $error,
            'countSuccess' => count($success),
            'countError' => count($error)
        ]);


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
                'id' => $idArr
            ]);
            return;
        }



        foreach($idArr as $id){

            $params['id'] = $id;

            $result = DoubleCheckConnection::Noconfirm($params);
            if(!$result){

                $error[$count]['id'] = $id;
                $error[$count]['message'] = 'Từ chối thất bại!';

                $count++;

            }else{
                $success[$count]['id'] = $id;
                $success[$count]['message'] = 'Từ chối thành công!';
                $count++;

                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_DOUBLE_CHECK, "Từ chối đối soát thành công #ID " .$id , compact('id', 'params')));
            }
        }

        $this->emit('messageRefuseAllScript', [
            'success' => $success,
            'error' => $error,
            'countSuccess' => count($success),
            'countError' => count($error)
        ]);
    }

    public function NoconfirmDoubleCheck($id , $reason){
        $params['reason'] = $reason;
        $params['id'] = $id;

        if($reason == ""){
            $this->emit('messageScript', [
                'message' => 'Bạn bắt buộc phải nhập lý do!',
                'id' => $id
            ]);
            return;
        }

        $result = DoubleCheckConnection::Noconfirm($params);
        // dd($result);
        if(!$result){
            session()->flash('messageNotConfirm', 'Trạng thái giao dịch phải ở trạng thái pending');
            // $this->message = 'Status must be pending!';

            $this->warning = true;

            $this->emit('messageConfirmScript', [
                'message' => 'Đã từ chối thất bại 1 đối soát ID '.$id,
                'warning' => $this->warning
            ]);

        }else{
            session()->flash('messageNotConfirm', 'Confirm thành công!');
            // $this->message = 'Status must be pending!';
            $this->warning = false;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_DOUBLE_CHECK, "Từ chối đối soát thành công", compact('id', 'params')));

            $this->emit('messageConfirmScript', [
                'message' => 'Đã từ chối thành công 1 đối soát ID '.$id,
                'warning' => $this->warning
            ]);

            return;
        }
    }

    protected $queryString = [
        'madoisoat' => ['except' => null],
        'startTimeSearch' => ['except' => ''],
        'endTimeSearch' => ['except' => ''],
        'ngaydoisoat' => ['except' => ''],
        'chukydoisoat' => ['except' => '']
    ];

    public $currentPage;
    public $totalPage;
    public $totalRecord;
    public $limit = 10;
    public $part = 10;
    public $start;
    public $end;
    public $partnerCode;
    public $status;
    public $startTimeSearch;
    public $endTimeSearch;
    public $message;
    public $warning = false;
    public $madoisoat;
    public $sum_receive;
    public $ngaydoisoat;
    public $chukydoisoat;
    public $pending;
    public $processing;
    public $non_processing;
    public $wait_confirm;
    public $confirm_success;
    public $confirm_fail;
    public $tatca = 0;
    public function getList(){

        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $params = [];
        $params['pagination']['limit'] = $this->limit;
        $params['pagination']['page'] = $this->pageCurrent;

        if(isset($this->madoisoat)){
            $params['filter']['id'] = $this->madoisoat;
        }

        if(isset($this->partnerCode)){
            $params['filter']['partner_code'] = $this->partnerCode;
        }
        if(isset($this->status)){
            $params['filter']['status'] = $this->status;
        }
        if(isset($this->startTimeSearch) and !empty($this->startTimeSearch)){
            $params['filter']['startTime'] = $this->startTimeSearch;
        }else{
            unset($params['filter']['startTime']);
        }
        // dump($this->startTime);
        if(isset($this->endTimeSearch) and !empty($this->endTimeSearch)){
            $params['filter']['endTime'] = $this->endTimeSearch;
        }else{
            unset($params['filter']['endTime']);
        }
        if(isset($this->ngaydoisoat) and !empty($this->ngaydoisoat)){
            $params['filter']['date_perform_reconciliation'] = $this->ngaydoisoat;
        }else{
            unset($params['filter']['date_perform_reconciliation']);
        }
        if(isset($this->chukydoisoat) and !empty($this->chukydoisoat)){
            $params['filter']['schedule_code'] = $this->chukydoisoat;
        }else{
            unset($params['filter']['schedule_code']);
        }

        $str = ['.', 'đ', ' '];

        if(isset($this->sum_receive)){
            $params['filter']['sum_receive'] = str_replace($str, "", $this->sum_receive);
        }

        // dd($params);

        $data = DoubleCheckConnection::getList($params);

        if(isset($data->data)){
            $this->transactionList = $data->data;
            foreach($this->transactionList as $list){
                $j = json_decode($list->logs);
                $json = Collection::make($j)->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                $list->logs = $json;
                $dataNewList = json_decode($list->logs);
                if(isset($dataNewList->system_auto_change_cf_success)){
                    $list->system_auto_change_cf_success = $dataNewList->system_auto_change_cf_success;
                }

                $list->log = json_decode($list->logs);
            }
        }

        // dd($data);

        if(isset($data->meta->group_by_data)){
            $this->pending = '0';
            $this->processing = '0';
            $this->non_processing = '0';
            $this->wait_confirm = '0';
            $this->confirm_success = '0';
            $this->confirm_fail = '0';

            foreach($data->meta->group_by_data as $countStatus){
                if($countStatus->status == 'pending'){
                    $this->pending = (isset($countStatus->count_total))?$countStatus->count_total:'0';
                }
                if($countStatus->status == 'processing'){
                    $this->processing = (isset($countStatus->count_total))?$countStatus->count_total:'0';
                }
                if($countStatus->status == 'non_processing'){
                    $this->non_processing = (isset($countStatus->count_total))?$countStatus->count_total:'0';
                }
                if($countStatus->status == 'wait_confirm'){
                    $this->wait_confirm = (isset($countStatus->count_total))?isset($countStatus->count_total):'0';
                }
                if($countStatus->status == 'confirm_success'){
                    $this->confirm_success = (isset($countStatus->count_total))?$countStatus->count_total:'0';
                }
                if($countStatus->status == 'confirm_fail'){
                    $this->confirm_fail = (isset($countStatus->count_total))?$countStatus->count_total:'0';
                }

            }
        }

        if(isset($data->meta->page_current)){
            $this->currentPage = $data->meta->page_current;
        }
        if(isset($data->meta->total_pages)){
            $this->totalPage = $data->meta->total_pages;
        }
        if(isset($data->meta->total_record)){
            $this->totalRecord = $data->meta->total_record;
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

    public $pageCurrent;
    public function gotoCurrentPage($page){
        if($page < 1){
            $page = 1;
        }
        if($page > $this->totalPage){
            $page = $this->totalPage;
        }
        $this->pageCurrent = $page;
    }

    public function selectTotalRecord($limit){
        $this->limit = $limit;
    }

    // public function loading(){
    //     if(isset($this->pageCurrent)){
    //         return true;
    //     }

    //     return false;
    // }


    public function ExportCSV(Request $request){
        // dd($request->all());
        $params = [];
        $params['pagination']['limit'] = 100;

        if(isset($request->madoisoat)){
            $params['filter']['id'] = $request->madoisoat;
        }

        if(isset($request->partner_code_search)){
            $params['filter']['partner_code'] = $request->partner_code_search;
        }
        if(isset($request->statusChecked)){
            $params['filter']['status'] = $request->statusChecked;
        }
        if(isset($request->startTime) and !empty($request->startTime)){
            $params['filter']['startTime'] = strtotime($request->startTime);
        }else{
            unset($params['filter']['startTime']);
        }
        // dump($this->startTime);
        if(isset($request->endTime) and !empty($request->endTime)){
            $params['filter']['endTime'] = strtotime($request->endTime);
        }else{
            unset($params['filter']['endTime']);
        }
        if(isset($request->TimeSearchPerform) and !empty($request->TimeSearchPerform)){
            $params['filter']['date_perform_reconciliation'] = strtotime($request->TimeSearchPerform);
        }else{
            unset($params['filter']['date_perform_reconciliation']);
        }
        if(isset($request->schedule_code_search) and !empty($request->schedule_code_search) and $request->schedule_code_search != 'all'){
            $params['filter']['schedule_code'] = $request->schedule_code_search;
        }else{
            unset($params['filter']['schedule_code']);
        }

        $data = DoubleCheckConnection::getList($params);

        // dd($data);

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
            'Tổng hoàn tiền',
            'Tổng hold',
            'Tổng unhold',
            'Tổng volume đối soát',
            'Tổng phí',
            'Tổng nhận',
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
                $params['pagination']['limit'] = 100;
                $data = DoubleCheckConnection::getList($params);
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
                    $dataCSV[] = $data->sum_refund;
                    $dataCSV[] = $data->sum_hold;
                    $dataCSV[] = $data->sum_unhold;
                    $dataCSV[] = $data->sum_revenue - $data->sum_refund - $data->sum_hold + $data->sum_unhold;

                    $dataCSV[] = $data->sum_cost;
                    $dataCSV[] = $data->sum_receive;
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
}
