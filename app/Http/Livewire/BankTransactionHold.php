<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Connection\BankTransactionConnection;
use App\Helpers\CheckIsAmUser;

class BankTransactionHold extends Component
{
    protected $listeners = [
        'SearchTransactionHold' => 'SearchTransactionHold',
        'HoldTransaction' => 'HoldTransaction',
        'exportTransactionHold' => 'exportTransactionHold'
    ];
    public function render()
    {
        $this->getList();

        return view('livewire.bank-transaction-hold', [
            'listTransaction' => $this->listTransaction
        ]);
    }

    protected $listTransaction;

    public $currentPage;
    public $totalPage;
    public $start;
    public $end;
    public $part = 10;
    public $partner_code;
    public $start_time;
    public $end_time;
    public $pageCurrent;

    public $transaction_id;

    public function exportTransactionHold
    ($partnerCode, $startTimeSearch, $endTimeSearch, $TransactionID)
    {
        $params = [];
        $params['pagination']['limit'] = 10000;
        $params['sort']['id'] = 'desc';


        if(!empty($partnerCode)){
            $params['query']['partner_code'] = $partnerCode;
        }else{
            unset($params['query']['partner_code']);
        }

        if(!empty($startTimeSearch)){
            $params['query']['start_time'] = strtotime($startTimeSearch);
        }else{
            unset($params['query']['start_time']);
        }
        if(!empty($endTimeSearch)){
            $params['query']['end_time'] = strtotime($endTimeSearch);
        }else{
            unset($params['query']['end_time']);
        }

        if(isset($TransactionID)){
            $params['query']['transaction_id'] = $TransactionID;
        }else{
            unset($params['query']['transaction_id']);
        }

        $partnerCode = CheckIsAmUser::checkIsAmUser();

        $data = BankTransactionConnection::getListHold($params, $partnerCode);


        if(isset($data->meta->page)){
            $page = $data->meta->page;
        }
        if(isset($data->meta->pages)){
            $pages = $data->meta->pages;
        }



        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $fileName = date('YmdHis', time());
        header('Content-Type: application/vnd.ms-execl');
        header('Content-Disposition: attachment;filename="' . $fileName . '.csv"');
        $path = storage_path('app/') . $fileName .'.csv';

        $begin = microtime(true);

        // $handle = fopen('php://output', 'w');

        $handle = fopen($path, 'w');
        fputs($handle, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

        if($pages >= 1){
            for ($i=$page; $i <= $pages ; $i++) {
                $params['pagination']['page'] = $i;
                $partnerCode = CheckIsAmUser::checkIsAmUser();
                $data = BankTransactionConnection::getListHold($params, $partnerCode)->data;
                $title = [];
                foreach($data as $key=>$data){

                    if($i == 1 && $key == 0){
                        foreach($data as $tit=>$content){
                            $title[] = $tit;

                        }
                        fputcsv($handle, $title);
                    }
                    $data = (array)$data;
                    $data['created_at'] = date('d-m-Y H:i:s', $data['created_at']);
                    fputcsv($handle, $data);
                }

            }
        }


        fclose($handle);
        ob_flush();
        flush();

        return \Response::download($path)->deleteFileAfterSend(true);
        $end = microtime(true);
    }


    // public function HoldTransaction($transactionID, $reason){
    //     $params = [];
    //     $params['transaction_id'] = $transactionID;
    //     $params['reason'] = $reason;
    //     $result = BankTransactionConnection::HoldTransaction($params);
    //     dd($result);
    // }


    public function SearchTransactionHold($partnerCodeSearch, $startTimeSearch, $endTimeSearch, $transactionID){

        if(isset($transactionID)){
            $this->transaction_id = $transactionID;
        }

        if(!empty($partnerCodeSearch)){
            $this->partner_code = $partnerCodeSearch;
        }else{
            unset($this->partner_code);
        }
        if(!empty($startTimeSearch)){
            $this->start_time = strtotime($startTimeSearch);
        }else{
            unset($this->start_time);
        }

        if(!empty($endTimeSearch)){
            $this->end_time = strtotime($endTimeSearch);
        }else{
            unset($this->end_time);
        }
    }

    public function getList(){
        $params = [];
        $params['pagination']['limit'] = 20;
        $params['sort']['id'] = 'desc';
        $params['pagination']['page'] = $this->pageCurrent;

        if(isset($this->transaction_id)){
            $params['query']['transaction_id'] = $this->transaction_id;
        }

        if(isset($this->start_time)){
            $params['query']['start_time'] = $this->start_time;
        }

        if(isset($this->end_time)){
            $params['query']['end_time'] = $this->end_time;
        }

        if(isset($this->partner_code)){
            $params['query']['partner_code'] = $this->partner_code;
        }

        $partnerCode = CheckIsAmUser::checkIsAmUser();

        $data = BankTransactionConnection::getListHold($params, $partnerCode);

        if(isset($data->data)){
            $this->listTransaction = $data->data;
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
