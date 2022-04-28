<?php

namespace App\Http\Livewire\Gate\BillService;

use Livewire\Component;
use App\Services\Gate\PartnerService;
use App\Services\Bill\BillTransactionService;
use App\Transformers\BillTransactionTransformer;
use App\Connection\BillTransactionConnection;
use App\Helpers\CheckIsAmUser;

class Dashboard extends Component
{
    protected $listeners = [
        'searchBillDashboard' => 'searchBillDashboard',
        'getBillChart' => 'getBillChart',
        'getDayArray' => 'getDayArray',
        'getXY' => 'getXY',
        'getBillChart1' => 'getBillChart1'
    ];

    public $totalBill = 0;
    public $totalAmount = 0;
    public $paramsPartnerCode = [];
    public $paramsBill = [];

    public $totalTransaction = 0;
    public $ttamount = 0;
    public $paramsBillChart = [];
    public $partnerCodeChart;
    public $startTimeChart;
    public $endTimeChart;


    public $partnerCodeBillservice;
    public $partner_code = 'All';
    public $startTime;
    public $endTime;

    protected $dayChart = '';
    public $paramChart = [];
    public $dayArrayX = [];
    public $sumAmountY = [];

    public $dayArray = [];
    public $dayArrayValue = [];
    public $sumArray = [];

    public function render()
    {
        $this->getReportChartDashboard1();
        $this->getReportChartDashboard();
        $this->getPartnerCode();
        $this->getBillTransactionService();
        $this->getDayArray();


        return view('livewire.gate.bill-service.dashboard');
    }
    public function mount(){

    }

    public function getDayChart(){
        $BillTransactionConnection = new BillTransactionConnection();
        $dayChart = $BillTransactionConnection->getDayChart($this->paramsBillChart);
    }
    public $partnerCodeChart1;
    public $paramsBillChart1 = [];
    public $startTimeChart1;
    public $endTimeChart1;
    public $totalTransaction1;


    public function getBillChart1(
        $partner_code,
        $startTime,
        $endTime
    ){
        if(isset($partner_code)){
            $this->partnerCodeChart1 = $partner_code;
            $this->paramsBillChart1['query']['partner_code'] = $this->partnerCodeChart1;
        }
        if(isset($startTime)){
            $this->startTimeChart1 = $startTime;
            $this->paramsBillChart1['query']['startTime'] = strtotime($this->startTimeChart1 . ' 00:00:00');
        }
        if(isset($endTime)){
            $this->endTimeChart1 = $endTime;
            $this->paramsBillChart1['query']['endTime'] = strtotime($this->endTimeChart1 . ' 23:59:59');
        }

    }
    public function getReportChartDashboard1(){
        $BillTransactionConnection = new BillTransactionConnection();
        if(!isset($this->startTimeChart1)){
            $this->paramsBillChart1['query']['startTime'] = strtotime(date("Y/m/d") . ' 00:00:00');
        }
        if(!isset($this->endTimeChart1)){
            $this->paramsBillChart1['query']['endTime'] = strtotime(date("Y/m/d") . ' 23:59:59');
        }
        $partnerCode = null;
        $partnerCode = CheckIsAmUser::checkIsAmUser();

        $data = $BillTransactionConnection->getReportDashboard($this->paramsBillChart1, $partnerCode);
        $this->totalTransaction1 = [];
        if(isset($data->data)){
            $this->totalTransaction1 = $data->data;
        }
    }
    public function getBillChart(
        $partner_code,
        $startTime,
        $endTime
    ){
        if(isset($partner_code)){
            $this->partnerCodeChart = $partner_code;
            $this->paramsBillChart['query']['partner_code'] = $this->partnerCodeChart;
        }
        if(isset($startTime)){
            $this->startTimeChart = $startTime;
            $this->paramsBillChart['query']['startTime'] = strtotime($this->startTimeChart . ' 00:00:00');
        }
        if(isset($endTime)){
            $this->endTimeChart = $endTime;
            $this->paramsBillChart['query']['endTime'] = strtotime($this->endTimeChart . ' 23:59:59');
        }



        $begin = new \DateTime($startTime);
        $end = new \DateTime($endTime);
        $begin->setTime(0,0,0);
        $end->setTime(0,0,1);

        $interval = new \DateInterval('P1D');
        $date_range = new \DatePeriod($begin, $interval ,$end);

        $this->dayArray = [];

        foreach($date_range as $date){
            $this->dayArray[] = ($date->format("Y-m-d"));
        }
        $BillTransactionConnection = new BillTransactionConnection();
        $partnerCode = null;
        $partnerCode = CheckIsAmUser::checkIsAmUser();

        $dayChart = $BillTransactionConnection->getDayChart($this->paramsBillChart, $partnerCode);

        $objChart = [];
        foreach($dayChart->data as $dataC){
            $this->dayArrayValue[] = $dataC->transaction_time;
            $objChart[] = $dataC;
        }

        foreach($this->dayArray as $dayAll){
            if(!in_array($dayAll, $this->dayArrayValue)){
                $objChart[] = (object)[
                    'transaction_time' => $dayAll,
                    'countTransactions' => '0',
                    'sumAmount' => '0'
                ];
            }
        }
        $result = usort($objChart, function($a, $b){
            return strtotime($a->transaction_time) - strtotime($b->transaction_time);
        });


        if($result){
            $this->dayArray = [];
            $this->sumArray = [];
            foreach($objChart as $dataXY){
                $this->dayArray[] = $dataXY->transaction_time;
                $this->sumArray[] = $dataXY->sumAmount;
            }
        }
    }
    public function currency_format2($number, $suffix = 'đ') {
        if (!empty($number)) {
            return number_format($number, 0, ',', '.') . "{$suffix}";
        }
    }

    public function getDataArrayX(){
        return $this->dayArrayX;
    }
    public function getDataArrayY(){
        return $this->sumAmountY;
    }

    public function getDayArray(){
        $BillTransactionConnection = new BillTransactionConnection();
        $partnerCode = null;
        $partnerCode = CheckIsAmUser::checkIsAmUser();
        $this->dayChart = $BillTransactionConnection->getDayChart($this->paramsBillChart, $partnerCode);

        $this->dayArrayX = [];
        $this->sumAmountY = [];

        if(isset($this->dayChart->data)){
            foreach($this->dayChart->data as $dayTime){
                $this->dayArrayX[] = $dayTime->transaction_time;
                $this->sumAmountY[] = $dayTime->sumAmount;
            }
        }



    }

    public $startTimeChartTTHoaDon;
    public function getReportChartDashboard(){
        $BillTransactionConnection = new BillTransactionConnection();
        if(!isset($this->startTimeChart)){
            $this->paramsBillChart['query']['startTime'] = strtotime(date("Y/m/1") . ' 00:00:00');
        }
        if(!isset($this->endTimeChart)){
            $this->paramsBillChart['query']['endTime'] = strtotime(date("Y/m/d") . ' 23:59:59');
        }

        $partnerCode = null;
        $partnerCode = CheckIsAmUser::checkIsAmUser();

        $data = $BillTransactionConnection->getReportDashboard($this->paramsBillChart, $partnerCode);

        $this->totalTransaction = [];

        if(isset($data->data)){
            $this->totalTransaction = $data->data;
        }
    }

    public function getPartnerCode(){
        $partnerService = new PartnerService();
        $this->paramsPartnerCode = [];
        $this->paramsPartnerCode['pagination']['perpage'] = 100;
        $data = $partnerService->getList($this->paramsPartnerCode);
        if(isset($data->data)){
            $this->partnerCodeBillservice = $data->data;
        }

        // dd($this->partnerCodeBillservice);
    }

    public function getBillTransactionService(){

        // $BillTransactionService = new BillTransactionService();
        // $data = $BillTransactionService->getList($this->paramsBill);

        // if (isset($data->data) && $data->data) {
        //     $data->data = BillTransactionTransformer::transformCollection($data->data);
        // }
        // if($data->meta){
        //     $this->totalBill = $data->meta->total;
        //     $this->totalAmount = $data->meta->total_amount;
        // }
        // // dump($this->paramsBill);
        // dump($data);


    }
    public function searchBillDashboard($partner_code, $startTime, $endTime){
        if(isset($partner_code)){
             $this->partner_code = $partner_code;
             $this->paramsBill['query']['partner_code'] = $this->partner_code;
        }
        if(isset($startTime)){
            $this->startTime = $startTime;
            // $this->paramsBill['query']['startTime'] = $startTime;
            $this->paramsBill['query']['startTime'] = strtotime($startTime . ' 00:00:00');
        }
        if(isset($endTime)){
            $this->endTime = $endTime;
            // $this->paramsBill['query']['endTime'] = $endTime;
            $this->paramsBill['query']['endTime'] = strtotime($endTime . ' 23:59:59');
        }

    }
}
