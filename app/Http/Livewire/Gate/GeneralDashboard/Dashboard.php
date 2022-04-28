<?php

namespace App\Http\Livewire\Gate\GeneralDashboard;

use Livewire\Component;
use App\Services\Gate\BankTransactionService;
use App\Services\Charging\ChargingService;
use App\Services\Gate\TopupTransactionService;
use App\Connection\BillTransactionConnection;
use App\Services\Gate\ShopcardDashboardService;
use App\Services\Gate\EbillDashboardService;
use App\Services\Gate\TransferMoneyTransactionService;
use App\Services\PaymentLink\PaymentLinkService;
use Carbon\Carbon;

class Dashboard extends Component
{

    protected $listeners = [
        'searchDashboard' => 'searchDashboard'
    ];

    public function render()
    {
        $this->getChartDichVuCongThanhToan();
        $this->getChartDVCharging();
        $this->getChartDVTopup();
        $this->getChartDVTTHoaDon();
        $this->getChartDVBanThe();
        $this->getChartDVThuHoaQuaVA();
        $this->getChartDVChiHo();

        $this->getChartPaymentLink();

        return view('livewire.gate.general-dashboard.dashboard');
    }


    function generateDateRange($start, $end){
        $result = [];
        $end = strtotime($end);
        $current = strtotime($start);

        while( $current <= $end ) {
             $result[] = date('Y-m-d', $current);
             $current = strtotime('+1 day', $current);
        }
        return $result;
    }

    public $params = [];
    public $valueChart;

    public $valueChartChargingHead;
    public $valueChartChargingValue;
    public $valueChartChargingCount;
    public $valueChartChargingSum;

    public $valueChartTopupHead;
    public $valueChartTopupValue;
    public $valueChartTopupCount;
    public $valueChartTopupSum;

    public $valueChartDVTTHoaDonHead = [];
    public $valueChartDVTTHoaDonValue = [];
    public $valueChartDVTTHoaDonCount;
    public $valueChartDVTTHoaDonSum = 0;

    public $valueChartDVBanTheHead = [];
    public $valueChartDVBanTheValue = [];
    public $valueChartDVBanTheCount;
    public $valueChartDVBanTheSum = 0;

    public $valueChartDVThuHoVAHead = [];
    public $valueChartDVThuHoVAValue = [];
    public $valueChartDVThuHoVACount;
    public $valueChartDVThuHoVASum = 0;

    public $valueChartDVChiHoHead = [];
    public $valueChartDVChiHoValue = [];
    public $valueChartDVChiHoCount;
    public $valueChartDVChiHoSum = 0;


    public $valueChartPaymentLinkHead = [];
    public $valueChartPaymentLinkValue = [];
    public $valueChartPaymentLinkCount;
    public $valueChartPaymentLinkSum = 0;


    public function mount(){

        $this->params['startDate'] = date('m/d/Y', strtotime( date('m/d/Y') . " -14 days"));
        $this->params['endDate'] = date('m/d/Y');

    }

    public $filter = 0;

    public function searchDashboard($startTime, $endTime){
        if(date('d', strtotime($startTime)) < date('d', strtotime($endTime))){

            $this->params['startDate'] = date('m/d/Y', strtotime($startTime));
            $this->params['endDate'] = date('m/d/Y', strtotime($endTime));

        }

        $this->filter = 1;
    }


    public $doanhThuTrongNgay_PaymentLink = 0;
    public $doanhThuHomQuaDV_PaymentLink = 0;
    public $phantramTangGiam_PaymentLink;
    public $tanggiamThongBao_PaymentLink = 1;

    public $dvPaymentLink_head;
    public $dvPaymentLink_value;
    public $total_paymentLink;

    public function getChartPaymentLink(){
        $params['fd'] = $this->params['startDate'];
        $params['td'] = $this->params['endDate'];

        $filter = [
            'fd' => $params['fd'] ? Carbon::createFromFormat('m/d/Y', $params['fd'])->startOfDay()->format('Y-m-d') : null,
            'td' => $params['td'] ? Carbon::createFromFormat('m/d/Y', $params['td'])->endOfDay()->format('Y-m-d') : null,
        ];



        $paymentLinkService = new PaymentLinkService();
        $overview = $paymentLinkService->overviewRevenue($filter);

        if(isset($overview['chart']['list_date'])){
            $this->dvPaymentLink_head = $overview['chart']['list_date'];
        }

        if(isset($overview['chart']['data_revenue'])){
            $this->dvPaymentLink_value = $overview['chart']['data_revenue'];
        }
        if($this->filter == 1){
            $this->total_paymentLink = array_sum($this->dvPaymentLink_value);
            return;
        }

        $last = count($overview['chart']['data_revenue']) - 1;

        if(isset($overview['chart']['data_revenue'][$last])){
            $this->doanhThuTrongNgay_PaymentLink = $overview['chart']['data_revenue'][$last];
        }
        if(isset($overview['chart']['data_revenue'][$last - 1])){
            $this->doanhThuHomQuaDV_PaymentLink = $overview['chart']['data_revenue'][$last -1];
        }

       if($this->doanhThuHomQuaDV_PaymentLink == 0){
                $this->tanggiamThongBao_PaymentLink = 0;
                return;
            }

            $this->phantramTangGiam_PaymentLink = $this->doanhThuTrongNgay_PaymentLink - $this->doanhThuHomQuaDV_PaymentLink;


            if($this->phantramTangGiam_PaymentLink < 0){
                $this->phantramTangGiam_PaymentLink
                = (($this->phantramTangGiam_PaymentLink * (-1))/$this->doanhThuHomQuaDV_PaymentLink) * 100;

                $this->tanggiamThongBao_PaymentLink = -1;

            }else{
                $this->phantramTangGiam_PaymentLink
                = ($this->phantramTangGiam_PaymentLink/$this->doanhThuHomQuaDV_PaymentLink) * 100;

                $this->tanggiamThongBao_PaymentLink = 1;
            }

            $this->phantramTangGiam_PaymentLink = round($this->phantramTangGiam_PaymentLink, 2);



    }

    public $doanhThuTrongNgay_DVChiHo = 0;
    public $doanhThuHomQuaDV_DVChiHo = 0;
    public $phantramTangGiam_DVChiHo;
    public $tanggiamThongBao_DVChiHo = 1;

    public $dvChiho_head;
    public $dvChiHo_value;
    public $total_ChiHo;


    public function getChartDVChiHo(){
        $transferMoneyTransactionService = new TransferMoneyTransactionService();
        $listTransaction
        = $transferMoneyTransactionService->getChartTransaction($this->params);

        if(isset($listTransaction['data']['value'])){
            $this->dvChiHo_value = $listTransaction['data']['value'];
        }

        if($this->filter == 1){
            $this->total_ChiHo = array_sum($this->dvChiHo_value);
            return;
        }

        if(isset($listTransaction['data']['head'])){
            $this->dvChiho_head = $listTransaction['data']['head'];
        }

        $last = count($listTransaction['data']['value']) - 1;

        if(isset($listTransaction['data']['value'][$last])){
            $this->doanhThuTrongNgay_DVChiHo = $listTransaction['data']['value'][$last];
        }

        if(isset($listTransaction['data']['value'][$last- 1])){
            $this->doanhThuHomQuaDV_DVChiHo = $listTransaction['data']['value'][$last - 1];
        }
        // dd($listTransaction);


       if($this->doanhThuHomQuaDV_DVChiHo == 0){
                $this->tanggiamThongBao_DVChiHo = 0;
                return;
            }

            $this->phantramTangGiam_DVChiHo = $this->doanhThuTrongNgay_DVChiHo - $this->doanhThuHomQuaDV_DVChiHo;


            if($this->phantramTangGiam_DVChiHo < 0){
                $this->phantramTangGiam_DVChiHo
                = (($this->phantramTangGiam_DVChiHo * (-1))/$this->doanhThuHomQuaDV_DVChiHo) * 100;

                $this->tanggiamThongBao_DVChiHo = -1;

            }else{
                $this->phantramTangGiam_DVChiHo
                = ($this->phantramTangGiam_DVChiHo/$this->doanhThuHomQuaDV_DVChiHo) * 100;

                $this->tanggiamThongBao_DVChiHo = 1;
            }

            $this->phantramTangGiam_DVChiHo = round($this->phantramTangGiam_DVChiHo, 2);

    }


    public $doanhThuTrongNgay_DVThuHoQuaVA = 0;
    public $doanhThuHomQuaDV_DVThuHoQuaVA = 0;
    public $phantramTangGiam_DVThuHoQuaVA;
    public $tanggiamThongBao_DVThuHoQuaVA = 1;

    public $dvThuHoVA_head;
    public $dvThuHoVA_value;
    public $total_ThuHoQuaVA;

    public function getChartDVThuHoaQuaVA(){
        $ebillDashboardService = new EbillDashboardService();
        $params['query']= $this->params;
        $listTransaction = $ebillDashboardService->getChartTransaction($params['query']);

        if(isset($listTransaction['data']['head'])){
            $this->dvThuHoVA_head = $listTransaction['data']['head'];
        }

        if(isset($listTransaction['data']['value'])){
            $this->dvThuHoVA_value = $listTransaction['data']['value'];
        }

        if($this->filter == 1){
            $this->total_ThuHoQuaVA = array_sum($this->dvThuHoVA_value);
            return;
        }

        $last = count($listTransaction['data']['value']) - 1;

        if(isset($listTransaction['data']['value'][$last])){
            $this->doanhThuTrongNgay_DVThuHoQuaVA = $listTransaction['data']['value'][$last];
        }


        if(isset($listTransaction['data']['value'][$last - 1])){
            $this->doanhThuHomQuaDV_DVThuHoQuaVA = $listTransaction['data']['value'][$last - 1];
        }

        $this->phantramTangGiam_DVThuHoQuaVA = $this->doanhThuTrongNgay_DVThuHoQuaVA - $this->doanhThuHomQuaDV_DVThuHoQuaVA;

       if($this->doanhThuHomQuaDV_DVThuHoQuaVA == 0){
                $this->tanggiamThongBao_DVThuHoQuaVA = 0;
                return;
            }

            $this->phantramTangGiam_DVThuHoQuaVA = $this->doanhThuTrongNgay_DVThuHoQuaVA - $this->doanhThuHomQuaDV_DVThuHoQuaVA;


            if($this->phantramTangGiam_DVThuHoQuaVA < 0){
                $this->phantramTangGiam_DVThuHoQuaVA
                = (($this->phantramTangGiam_DVThuHoQuaVA * (-1))/$this->doanhThuHomQuaDV_DVThuHoQuaVA) * 100;

                $this->tanggiamThongBao_DVThuHoQuaVA = -1;

            }else{
                $this->phantramTangGiam_DVThuHoQuaVA
                = ($this->phantramTangGiam_DVThuHoQuaVA/$this->doanhThuHomQuaDV_DVThuHoQuaVA) * 100;

                $this->tanggiamThongBao_DVThuHoQuaVA = 1;
            }

            $this->phantramTangGiam_DVThuHoQuaVA = round($this->phantramTangGiam_DVThuHoQuaVA, 2);


    }


    public $doanhThuTrongNgay_DVBanThe = 0;
    public $doanhThuHomQuaDV_DVBanThe = 0;
    public $phantramTangGiam_DVBanThe;
    public $tanggiamThongBao_DVBanThe = 1;

    public $dvBanThe_head;
    public $dvBanThe_value;
    public $total_dvBanThe;

    public function getChartDVBanThe(){
        $shopCardDashboardService = new ShopcardDashboardService();
        $listTransaction = $shopCardDashboardService->getChartTransaction($this->params);

        if(isset($listTransaction['data']['head'])){
            $this->dvBanThe_head = $listTransaction['data']['head'];
        }

        if(isset($listTransaction['data']['value'])){
            $this->dvBanThe_value = $listTransaction['data']['value'];
        }

        if($this->filter == 1){
            $this->total_dvBanThe = array_sum($this->dvBanThe_value);
            return;
        }

        $last = count($listTransaction['data']['value']) - 1;

        if(isset($listTransaction['data']['value'][$last])){
            $this->doanhThuTrongNgay_DVBanThe = $listTransaction['data']['value'][$last];
        }

        if(isset($listTransaction['data']['value'][$last - 1])){
            $this->doanhThuHomQuaDV_DVBanThe = $listTransaction['data']['value'][$last - 1];
        }

        $this->phantramTangGiam_DVBanThe = $this->doanhThuTrongNgay_DVBanThe - $this->doanhThuHomQuaDV_DVBanThe;

       if($this->doanhThuHomQuaDV_DVBanThe == 0){
                $this->tanggiamThongBao_DVBanThe = 0;
                return;
            }

            $this->phantramTangGiam_DVBanThe = $this->doanhThuTrongNgay_DVBanThe - $this->doanhThuHomQuaDV_DVBanThe;


            if($this->phantramTangGiam_DVBanThe < 0){
                $this->phantramTangGiam_DVBanThe
                = (($this->phantramTangGiam_DVBanThe * (-1))/$this->doanhThuHomQuaDV_DVBanThe) * 100;

                $this->tanggiamThongBao_DVBanThe = -1;

            }else{
                $this->phantramTangGiam_DVBanThe
                = ($this->phantramTangGiam_DVBanThe/$this->doanhThuHomQuaDV_DVBanThe) * 100;

                $this->tanggiamThongBao_DVBanThe = 1;
            }

            $this->phantramTangGiam_DVBanThe = round($this->phantramTangGiam_DVBanThe, 2);

    }

    public $doanhThuTrongNgay_DVTTHoaDon = 0;
    public $doanhThuHomQuaDV_DVTTHoaDon = 0;
    public $phantramTangGiam_DVTTHoaDon;
    public $tanggiamThongBao_DVTTHoaDon = 1;
    public $total_dvTTHoaDon;


    public function getChartDVTTHoaDon(){
        $BillTransactionConnection = new BillTransactionConnection();
        $params['query']['startTime'] = strtotime($this->params['startDate'] . ' 00:00:00');
        $params['query']['endTime'] = strtotime($this->params['endDate'] . ' 11:59:59');
        $listTransaction = $BillTransactionConnection->getDayChart($params);

        $list2 = [];
        $rangeDate = $this->generateDateRange($this->params['startDate'], $this->params['endDate']);
        foreach($rangeDate as $date){
            $list2[] = (object)[
                'transaction_time' => $date,
                'countTransactions' => 0,
                'sumAmount' => 0
            ];
        }
        foreach($list2 as $list){
            foreach($listTransaction->data as $data){
                if($list->transaction_time == $data->transaction_time){
                    $list->transaction_time = $data->transaction_time;
                    $list->countTransactions = $data->countTransactions;
                    $list->sumAmount = $data->sumAmount;

                }
            }
        }

        if(isset($list2)){

            foreach($list2 as $list){
                $this->valueChartDVTTHoaDonHead[] = $list->transaction_time;
                $this->valueChartDVTTHoaDonValue[] = $list->sumAmount;
                $this->valueChartDVTTHoaDonSum = $this->valueChartDVTTHoaDonSum + $list->sumAmount;
            }

            if($this->filter == 1){
                $this->total_dvTTHoaDon = array_sum($this->valueChartDVTTHoaDonValue);
                return;
            }

            $last = count($this->valueChartDVTTHoaDonValue) - 1;

            $this->doanhThuTrongNgay_DVTTHoaDon = $this->valueChartDVTTHoaDonValue[$last];
            $this->doanhThuHomQuaDV_DVTTHoaDon = $this->valueChartDVTTHoaDonValue[$last - 1];

            if($this->doanhThuHomQuaDV_DVTTHoaDon == 0){
                $this->tanggiamThongBao_DVTTHoaDon = 0;
                return;
            }

            $this->phantramTangGiam_DVTTHoaDon = $this->doanhThuTrongNgay_DVTTHoaDon - $this->doanhThuHomQuaDV_DVTTHoaDon;


            if($this->phantramTangGiam_DVTTHoaDon < 0){
                $this->phantramTangGiam_DVTTHoaDon
                = (($this->phantramTangGiam_DVTTHoaDon * (-1))/$this->doanhThuHomQuaDV_DVTTHoaDon) * 100;

                $this->tanggiamThongBao_DVTTHoaDon = -1;

            }else{
                $this->phantramTangGiam_DVTTHoaDon
                = ($this->phantramTangGiam_DVTTHoaDon/$this->doanhThuHomQuaDV_DVTTHoaDon) * 100;

                $this->tanggiamThongBao_DVTTHoaDon = 1;
            }

            $this->phantramTangGiam_DVTTHoaDon = round($this->phantramTangGiam_DVTTHoaDon, 2);


        }else{
            $this->doanhThuTrongNgay_DVTTHoaDon = 0;
            $this->doanhThuHomQuaDV_DVTTHoaDon = 0;

            if($this->doanhThuHomQuaDV_DVTTHoaDon == 0){
                $this->tanggiamThongBao_DVTTHoaDon = 0;
                return;
            }

        }


    }

    public $doanhThuTrongNgay_DVTopup = 0;
    public $doanhThuHomQuaDV_DVTopup = 0;
    public $phantramTangGiam_DVTopup;
    public $tanggiamThongBao_DVTopup = 1;
    public $total_dvTopup;

    public function getChartDVTopup(){
        $topupTransactionService = new topupTransactionService();
        $listTransaction = $topupTransactionService->getChartTransaction($this->params);

        if(isset($listTransaction['data']['head'])){
            $this->valueChartTopupHead = $listTransaction['data']['head'];
        }

        if(isset($listTransaction['data']['value'])){
            $this->valueChartTopupValue = $listTransaction['data']['value'];

            if($this->filter == 1){
                $this->total_dvTopup = array_sum($this->valueChartTopupValue);
                return;
            }

            $last = count($this->valueChartTopupValue) - 1;

            $this->doanhThuTrongNgay_DVTopup = $this->valueChartTopupValue[$last];
            $this->doanhThuHomQuaDV_DVTopup = $this->valueChartTopupValue[$last - 1];

            if($this->doanhThuHomQuaDV_DVTopup == 0){
                $this->tanggiamThongBao_DVTopup = 0;
                return;
            }

            $this->phantramTangGiam_DVTopup = $this->doanhThuTrongNgay_DVTopup - $this->doanhThuHomQuaDV_DVTopup;

            if($this->phantramTangGiam_DVTopup < 0){
                $this->phantramTangGiam_DVTopup
                = (($this->phantramTangGiam_DVTopup * (-1))/$this->doanhThuHomQuaDV_DVTopup) * 100;

                $this->tanggiamThongBao_DVTopup = -1;

            }else{
                $this->phantramTangGiam_DVTopup
                = ($this->phantramTangGiam_DVTopup/$this->doanhThuHomQuaDV_DVTopup) * 100;

                $this->tanggiamThongBao_DVTopup = 1;
            }

            $this->phantramTangGiam_DVTopup = round($this->phantramTangGiam_DVTopup, 2);



        }

        if(isset($listTransaction['data']['count'])){
            $this->valueChartTopupCount = $listTransaction['data']['count'];
        }

        if(isset($listTransaction['data']['sum'])){
            $this->valueChartTopupSum = $listTransaction['data']['sum'];

        }
    }


    public $doanhThuTrongNgay_DVCharging = 0;
    public $doanhThuHomQuaDV_Charging = 0;
    public $phantramTangGiam_DVCharging = 0;
    public $tanggiamThongBao_DVCharging = 1;
    public $total_dvCharging;

    public $dvCharging_value;
    public $dvCharging_date;

    public function getChartDVCharging(){

        $chargingService = new ChargingService();

        $listTransaction = $chargingService->getChartTransaction($this->params);

        if(isset($listTransaction->data->head)){
            $this->valueChartChargingHead = $listTransaction->data->head;
        }

        if(isset($listTransaction->data->value)){
            $this->valueChartChargingValue = $listTransaction->data->value;

            if($this->filter == 1){
                $this->total_dvCharging = array_sum($this->valueChartChargingValue);
                return;
            }

            $last = count($this->valueChartChargingValue) - 1;


            $this->doanhThuTrongNgay_DVCharging = $this->valueChartChargingValue[$last];
            $this->doanhThuHomQuaDV_Charging = $this->valueChartChargingValue[$last - 1];
            $this->phantramTangGiam_DVCharging = $this->doanhThuTrongNgay_DVCharging - $this->doanhThuHomQuaDV_Charging;

            if($this->doanhThuHomQuaDV_Charging == 0){
                $this->tanggiamThongBao_DVCharging = 0;
                return;
            }


            if($this->phantramTangGiam_DVCharging < 0){
                $this->phantramTangGiam_DVCharging
                = (($this->phantramTangGiam_DVCharging * (-1))/$this->doanhThuHomQuaDV_Charging) * 100;

                $this->tanggiamThongBao_DVCharging = -1;

            }else{
                $this->phantramTangGiam_DVCharging
                = ($this->phantramTangGiam_DVCharging/$this->doanhThuHomQuaDV_Charging) * 100;

                $this->tanggiamThongBao_DVCharging = true;
            }

            $this->phantramTangGiam_DVCharging = round($this->phantramTangGiam_DVCharging, 2);

        }else{
            if($this->filter == 1){
                $this->total_dvCharging = 0;
                return;
            }
        }

        if(isset($listTransaction->data->count)){
            $this->valueChartChargingCount = $listTransaction->data->count;
        }

        if(isset($listTransaction->data->sum)){
            $this->valueChartChargingSum = $listTransaction->data->sum;
        }



    }

    public $doanhThuTrongNgayDVCongThanhToan = 0;
    public $doanhThuHomQuaDVCongThanhToan = 0;
    public $phantramTangGiamDVCongThanhToan;
    public $tanggiamThongBao = 1;

    public $dvCongTT_value;
    public $dvCongTT_date;
    public $total_dvCongTT;

    public function getChartDichVuCongThanhToan(){
        $listTransaction = BankTransactionService::getChartTransaction($this->params);
        if($listTransaction['data'] == false){
            $this->doanhThuTrongNgayDVCongThanhToan = 0;
            $this->doanhThuHomQuaDVCongThanhToan = 0;
            $this->phantramTangGiamDVCongThanhToan = 0;
            $this->tanggiamThongBao = 0;
            return;
        }
        $list2 = [];
            $rangeDate = $this->generateDateRange($this->params['startDate'], $this->params['endDate']);
            foreach($rangeDate as $date){
                $list2[] = (object)[
                    'response_time' => $date,
                    'countTransactions' => 0,
                    'sumAmount' => 0
                ];
            }
            foreach($list2 as $list){
                foreach($listTransaction['data'] as $data){
                    if($list->response_time == $data->response_time){
                        $list->response_time = $data->response_time;
                        $list->countTransactions = $data->countTransactions;
                        $list->sumAmount = $data->sumAmount;

                    }
                }
            }


        if($listTransaction['data'] != false){
            $valueChart = [];
            $valueChart['data']['sum'] = 0;
            $valueChart['data']['count'] = 0;

            foreach($list2 as $data){
                $valueChart['data']['head'][] = date('m/d', strtotime($data->response_time));
                $valueChart['data']['value'][] = $data->sumAmount;
                $valueChart['data']['sum'] = $valueChart['data']['sum'] + $data->sumAmount;
                $valueChart['data']['count']++;
            }

            $this->dvCongTT_value = $valueChart['data']['value'];
            $this->dvCongTT_date = $valueChart['data']['head'];

            if($this->filter == 1){
                $this->total_dvCongTT = array_sum($this->dvCongTT_value);
                return;
            }

            $last = count($valueChart['data']['value']) - 1;

            $this->doanhThuTrongNgayDVCongThanhToan
                = $valueChart['data']['value'][$last];
            $this->doanhThuHomQuaDVCongThanhToan = $valueChart['data']['value'][$last - 1];


            if($this->doanhThuHomQuaDVCongThanhToan == 0){
                $this->phantramTangGiamDVCongThanhToan = 0;
                $this->tanggiamThongBao = 0;
                return;
            }

            $phantramTangGiam = $this->doanhThuTrongNgayDVCongThanhToan - $this->doanhThuHomQuaDVCongThanhToan;

            if($phantramTangGiam < 0){
                $this->phantramTangGiamDVCongThanhToan = (($phantramTangGiam * (-1))/$this->doanhThuHomQuaDVCongThanhToan) * 100;

                $this->tanggiamThongBao = -1;

            }else{
                $this->phantramTangGiamDVCongThanhToan = ($phantramTangGiam/$this->doanhThuHomQuaDVCongThanhToan) * 100;

                $this->tanggiamThongBao = 1;
            }

            $this->phantramTangGiamDVCongThanhToan = round($this->phantramTangGiamDVCongThanhToan, 2);

            // dd($this->phantramTangGiamDVCongThanhToan);

            }


    }
}
