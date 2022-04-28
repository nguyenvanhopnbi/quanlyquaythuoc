<?php

namespace App\Http\Livewire\Gate\Lottery;

use Livewire\Component;
use App\Connection\LotteryConnection;
use App\Connection\PartnerConnection;

class ListLotteryWin extends Component
{
    protected $listeners = [
            'SearchLotteryWinPrize' => 'SearchLotteryWinPrize',
            'showDetailsLotteryWinPrize' => 'showDetailsLotteryWinPrize',
            'downloadCSVLotteryWin' => 'downloadCSVLotteryWin'
        ];

    public $loading = false;
    public function render()
    {

        $this->getListLotteryPrize();
        $this->getListLoaiVe();
        $this->getListPartner();
        $this->getLotteryPrizeOverview();

        return view('livewire.gate.lottery.list-lottery-win', [
            'lotteryTransactions' => $this->lotteryTransactions,
            'listLoaiVe' => $this->listLoaiVe,
            'partnerCodeList' => $this->partnerCodeList,
            'overviewDetailsPrize' => $this->overviewDetailsPrize
        ]);
    }

    public function downloadCSVLotteryWin(
        $startTimeSearch,
        $endTimeSearch,
        $phoneNumber,
        $fullName,
        $statusValue,
        $partnerCode,
        $lotteryCode,
        $loaive
    ){
        $this->loading = true;
        $params = [];
        $params['pageSize'] = 10000;
        $params['export'] = 1;

        if(isset($phoneNumber)){
            $params['filters']['phoneNumber'] = $phoneNumber;
        }
        if(isset($statusValue)){
            $params['filters']['status'] = $statusValue;
        }
        if(isset($fullName)){
            $params['filters']['fullName'] = $fullName;
        }
        if(isset($partnerCode)){
            $params['filters']['partnerCode'] = $partnerCode;
        }
        if(isset($lotteryCode)){
            $params['filters']['lotteryCode'] = $lotteryCode;
        }
        if(isset($providerBillCode)){
            $params['filters']['providerBillCode'] = $providerBillCode;
        }
        if(isset($startTimeSearch)){
            $params['filters']['startTime'] = strtotime($startTimeSearch);
        }
        if(isset($endTimeSearch)){
            $params['filters']['endTime'] = strtotime($endTimeSearch);
        }

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
        $handle = fopen($path, 'a');

        fputs($handle, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
        $titColum = [
            'ID',
            'Partner Code',
            'Loại vé',
            'Giá trị giải thưởng',
            'Thời gian tạo',
            'Nhà cung cấp',
            'Mã bill',
            'Mã giao dịch',
            'Kỳ mua',
            'Họ tên',
            'Số điện thoại',
            'Message',
            'Trạng thái',
            'Ngày trả thưởng'
        ];
        $data = LotteryConnection::getListLotteryPrize($params);
        $pages = 1;
        if(isset($data->meta->totalPage)){
            $pages = $data->meta->totalPage;
        }

        for ($i = 1; $i <= $pages; $i++) {
            $params['page'] = $i;
            $data = LotteryConnection::getListLotteryPrize($params);
            foreach($data->lotteryTransactions as $key => $data){
                $data->billCode = $data->bill->billCode;
                $data->lotteryTransactionId = $data->bill->lotteryTransactionId;
                $data->drawIndex = $data->bill->drawIndex;
                $data->fullName = $data->bill->fullName;
                $data->phoneNumber = $data->bill->phoneNumber;
                unset($data->bill);
                foreach($data->winTicketTransactions as $winTicketTransactions){
                    $data->message = $winTicketTransactions->message;
                    $data->status = $winTicketTransactions->status;
                    $data->ngaytrathuong = $winTicketTransactions->createdAt;
                }
                unset($data->winTicketTransactions);
                if($key == 0){
                    fputcsv($handle, $titColum);
                }
                $data = (array)$data;
                fputcsv($handle, $data);
            }
        }

        fclose($handle);
        ob_flush();
        flush();
        $this->loading = true;
        return response()->download($path)->deleteFileAfterSend(true);
        $end = microtime(true);


    }

    protected $overviewDetailsPrize;
    public $totalTransactionLotterPrize = 0;
    public $totalRevenueLotteryPrize = 0;
    public $totalWinTicketLotteryPrize = 0;

    public function getLotteryPrizeOverview(){
        $params = [];
        $data = LotteryConnection::getListLotteryPrizeOverview($params);
        if(isset($data->overview->totalTransaction)){
            $this->totalTransactionLotterPrize = $data->overview->totalTransaction;
        }
        if(isset($data->overview->totalRevenue)){
            $this->totalRevenueLotteryPrize = $data->overview->totalRevenue;
        }
        if(isset($data->overview->totalWinTicket)){
            $this->totalWinTicketLotteryPrize = $data->overview->totalWinTicket;
        }
    }


    public $countTrung = 0;
    public $soTrungKhopArr = [];

    public $giaTriGiaThuongPrize;
    public $fullNameDetails = '';
    public $phoneNumberDetails = '';
    public $statusDetails = '';

    public $numberTicket;
    public $Lon13 = false;
    public $Lon11vs12 = false;
    public $HoaLonNho10vs10 = false;
    public $Nho11vs12 = false;
    public $Nho13 = false;
    public $Chan15 = false;
    public $Chan13vs14 = false;
    public $Chan11vs12 = false;
    public $HoaChanLe10vs10 = false;
    public $Le11vs12 = false;
    public $Le13vs14 = false;
    public $Le15 = false;

    public $bacVe;
    public $playType;
    public $price;

    public function showDetailsLotteryWinPrize($id){
        $params = [];
        $data = LotteryConnection::getListLotteryPrizeDetails($params, $id);

        if(isset($data->winPrize->winTicketTransactions)){
            foreach($data->winPrize->winTicketTransactions as $winTicketTransactions){
                $this->statusDetails = $winTicketTransactions->status;
            }
        }

        if(isset($data->winPrize->bill->price)){
            $this->price = $data->winPrize->bill->price;
        }

        if(isset($data->winPrize->bill->playType)){
            $this->playType = $data->winPrize->bill->playType;
        }

        if(isset($data->winPrize->bill->fullName)){
            $this->fullNameDetails = $data->winPrize->bill->fullName;
        }

        if(isset($data->winPrize->bill->phoneNumber)){
            $this->phoneNumberDetails = $data->winPrize->bill->phoneNumber;
        }

        if(isset($data->winPrize->prize)){
            $this->giaTriGiaThuongPrize = $data->winPrize->prize;
        }


        if(isset($data->winPrize->numbers) and $data->errorCode == 0){
            $this->numberTicket = explode(",", $data->winPrize->numbers); ;
        }
        $countLon13 = 0;
        $countHoaLonNho1vs40 = 0;
        $countHoaLonNho41vs80 = 0;
        $countNho11vs12 = 0;
        $countChan15 = 0;
        $countLe11vs12 = 0;

        foreach($this->numberTicket as $Tiket){
            if($Tiket >= 41 and $Tiket <= 80){
                $countLon13++;
            }
            if($Tiket >= 1 and $Tiket <= 40){
                $countHoaLonNho1vs40++;
            }
            if($Tiket >= 41 and $Tiket <= 80){
                $countHoaLonNho41vs80++;
            }
            if($Tiket >= 1 and $Tiket <= 40){
                $countNho11vs12++;
            }
            if($Tiket % 2 == 0){
                $countChan15++;
            }else{
                $countLe11vs12++;
            }


        }
        if($countLe11vs12 >= 15){
            $this->Le15 = true;
        }
        if($countLe11vs12 >= 13 and $countLe11vs12 <= 14){
            $this->Le13vs14 = true;
        }
        if($countLe11vs12 >= 11 and $countLe11vs12 <= 12){
            $this->Le11vs12 = true;
        }
        if($countChan15 == 10){
            $this->HoaChanLe10vs10 = true;
        }
        if($countChan15 >= 11 and $countChan15 <= 12){
            $this->Chan11vs12 = true;
        }
        if($countChan15 >= 13 and $countChan15 <= 14){
            $this->Chan13vs14 = true;
        }
        if($countChan15 >= 15){
            $this->Chan15 = true;
        }

        if($countNho11vs12 >= 13){
            $this->Nho13 = true;
        }
        if($countNho11vs12 >= 11 and $countNho11vs12 <= 12){
            $this->Nho11vs12 = true;
        }

        if($countHoaLonNho1vs40 >= 10 and $countHoaLonNho41vs80 >= 10){
            $this->HoaLonNho10vs10 = true;
        }

        if($countLon13 >= 13){
                $this->Lon13 = true;
            }
            if($countLon13 >= 11 and $countLon13 <= 12){
                $this->Lon11vs12 = true;
        }

        $countTrungSo = 0;
        $soTrungKhop = [];
        if(isset($data->winPrize->tickets)){
            foreach($data->winPrize->tickets as $dataTicket){
                if(isset($dataTicket->numbers)){
                    $this->bacVe = explode(",", $dataTicket->numbers);
                    foreach($this->bacVe as $ticketNumber){
                        if(in_array($ticketNumber, $this->numberTicket)){
                            $countTrungSo++;
                            $soTrungKhop[] = $ticketNumber;
                        }
                    }
                }
            }
        }
        $this->countTrung = $countTrungSo;
        $this->soTrungKhopArr = $soTrungKhop;


        // dd($soTrungKhopArr);
    }



    protected $partnerCodeList;
    public function getListPartner(){
        $params = [];
        $params['pagination']['limit'] = 1000000;
        $data = PartnerConnection::getList($params);
        if(isset($data->data)){
            $this->partnerCodeList = $data->data;
        }

    }

    public function SearchLotteryWinPrize(
        $startTime,
        $endTime,
        $phoneNumber,
        $fullName,
        $statusValue,
        $partnerCode,
        $maBill,
        $maVe,
        $loaive
    ){
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

        if(isset($phoneNumber) and !empty($phoneNumber)){
            $this->phoneNumber = $phoneNumber;
        }else{
            unset($this->phoneNumber);
        }

        if(isset($fullName) and !empty($fullName)){
            $this->fullName = $fullName;
        }else{
            unset($this->fullName);
        }

        if(isset($statusValue) and !empty($statusValue)){
            $this->status = $statusValue;
        }else{
            unset($this->status);
        }

        if(isset($partnerCode) and !empty($partnerCode)){
            $this->partnerCode = $partnerCode;
        }else{
            unset($this->partnerCode);
        }

        if(isset($maBill) and !empty($maBill)){
            $this->providerBillCode = $maBill;
        }else{
            unset($this->providerBillCode);
        }

        if(isset($loaive) and !empty($loaive)){
            $this->lotteryCode = $loaive;
        }else{
            unset($this->lotteryCode);
        }


    }

    protected $listLoaiVe;

    public function getListLoaiVe(){
        $params = [];
        $data = LotteryConnection::getListLoaiVe($params);
        if(isset($data->lotteries)){
            $this->listLoaiVe = $data->lotteries;
        }

    }

    protected $lotteryTransactions;

    public $currentPage;
    public $totalPage;
    public $start;
    public $end;
    public $part = 10;

    public $pageCurrent;

    public $phoneNumber;
    public $status;
    public $fullName;
    public $partnerCode;
    public $lotteryCode;
    public $providerBillCode;
    public $startTime;
    public $endTime;

    public function getListLotteryPrize(){
        $params = [];
        $params['pageSize'] = 20;

        if(isset($this->phoneNumber)){
            $params['filters']['phoneNumber'] = $this->phoneNumber;
        }
        if(isset($this->status)){
            $params['filters']['status'] = $this->status;
        }
        if(isset($this->fullName)){
            $params['filters']['fullName'] = $this->fullName;
        }
        if(isset($this->partnerCode)){
            $params['filters']['partnerCode'] = $this->partnerCode;
        }
        if(isset($this->lotteryCode)){
            $params['filters']['lotteryCode'] = $this->lotteryCode;
        }
        if(isset($this->providerBillCode)){
            $params['filters']['providerBillCode'] = $this->providerBillCode;
        }
        if(isset($this->startTime)){
            $params['filters']['startTime'] = $this->startTime;
        }
        if(isset($this->endTime)){
            $params['filters']['endTime'] = $this->endTime;
        }



        if(isset($this->pageCurrent)){
            $params['page'] = $this->pageCurrent;
        }


        $data = LotteryConnection::getListLotteryPrize($params);
        // dd($data);
        if(isset($data->lotteryTransactions)){
            $this->lotteryTransactions = $data->lotteryTransactions;
            foreach($this->lotteryTransactions as $list){
                foreach($list->winTicketTransactions as $list2){
                    $list->ngaytrathuong = $list2->createdAt;
                    $list->trangthaitrathuong = $list2->status;
                    $list->message = $list2->message;
                }
            }
        }

        if(isset($data->meta->currentPage)){
            $this->currentPage = $data->meta->currentPage;
        }

        if(isset($data->meta->totalPage)){
            $this->totalPage = $data->meta->totalPage;
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
