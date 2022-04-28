<?php

namespace App\Http\Livewire\Gate\Lottery;

use Livewire\Component;
use App\Connection\LotteryConnection;
use App\Connection\PartnerConnection;

class Lottery extends Component
{
    protected $listeners = [
        'PageSize' => 'PageSize',
        'SearchLottery' => 'SearchLottery',
        'downloadCSV1' => 'downloadCSV1',
        'getDetails' => 'getDetails'
    ];
    protected $listTransaction;
    public function render()
    {
        $this->getList();
        $this->getListLoaiVe();
        $this->getListProviderCode();
        $this->getOverview();

        $this->getPartnerCodeList();
        // dd('vao day');

        return view('livewire.gate.lottery.lottery', [
            'listTransaction' => $this->listTransaction,
            'listLoaive' => $this->listLoaive,
            'providerCodeList' => $this->providerCodeList,
            'partnerCodeList' => $this->partnerCodeList
        ]);
    }


    public $fullnameLottery = '';
    public $phoneNumber = '';
    public $playType = '';
    public $drawIndex = '';
    public $drawDate = '';
    public $lotteryResultJackpot1 = '';
    public $lotteryResultJackpot2 = '';

    public $numbers = [];
    public $danhsachve = '';
    public $linkURL;

    public $resultNumber;
    public $extra;

    public $countLon13 = 0;

    public $textCountLon13;
    public $textCountLon11or12;
    public $textHoaLonNho10;
    public $textNho11hoac12;
    public $textNho13;
    public $textSoChan15;
    public $textSoChan13hoac14;
    public $textSoChan11hoac12;
    public $textHoaChanLe10;
    public $textLe11hoac12;
    public $textLe13hoac14;
    public $textLe15;


    public function getDetails($transactionID){
        $params = [];
        $data = LotteryConnection::getListDetails($params, $transactionID);
        // dd($data);
        if(isset($data->lotteryTransaction->bill->lotteryResult->numbers)){
            $this->resultNumber = $data->lotteryTransaction->bill->lotteryResult->numbers;
            // dd($this->resultNumber);
        }

        if(isset($data->lotteryTransaction->scans)){
            foreach($data->lotteryTransaction->scans as $extra){
                foreach($extra->tickets as $ext){
                    if(isset($ext->extra)){
                         $this->extra = $ext->extra;
                    }
                }
            }
        }

// Lớn 13 --------------------

        if(isset($this->extra)){
            if(isset($this->resultNumber)){
                $numResultArray = explode(",", $this->resultNumber);
                // dd($numResultArray);
                $countHoaLonNho10den40 = 0;
                $countHoaLonNho41den80 = 0;
                $countNho11hoac12tu1den40 = 0;
                $count13sotu1den40 = 0;
                $countSoChan = 0;
                $countSoLe = 0;

                foreach($numResultArray as $num){
                    if($num >= 41 and $num <= 80){
                        $this->countLon13 ++;
                        $countHoaLonNho41den80++;
                    }
                    if($num >= 1 and $num <= 40){
                        $countHoaLonNho10den40++;
                        $countNho11hoac12tu1den40++;
                        $count13sotu1den40++;
                    }

                    if($num % 2 == 0){
                        $countSoChan++;
                    }

                    if($num % 2 != 0){
                        $countSoLe++;
                    }


                }

                if($this->countLon13 >= 13 and $this->extra == 'Lớn'){
                    $this->textCountLon13 = "Lớn (13)";
                }
                if($this->countLon13 >= 11 and $this->countLon13 <= 12 and $this->extra == 'Lớn'){
                    $this->textCountLon11or12 = 'Lớn (11) hoặc (12)';
                }
                if($countHoaLonNho10den40 >= 10 and $countHoaLonNho41den80 >= 10 and $this->extra == 'Hòa Lớn Nhỏ'){
                    $this->textHoaLonNho10 = "Hòa Lớn - Nhỏ (10)";
                }
                if($countNho11hoac12tu1den40 >= 11 and $countNho11hoac12tu1den40 <= 12 and $this->extra == 'Nhỏ'){
                    $this->textNho11hoac12 = "Nhỏ (11) hoặc (12)";
                }
                if($count13sotu1den40 >= 13 and $this->extra == 'Nhỏ'){
                    $this->textNho13 = "Nhỏ (13)";
                }
                if($countSoChan >= 15 and $this->extra == 'Chẵn'){
                    $this->textSoChan15 = "Chẵn (15)";
                }
                if($countSoChan >= 13 and $countSoChan <= 14 and $this->extra == 'Chẵn'){
                    $this->textSoChan13hoac14 = "Chẵn (13) hoặc (14)";
                }
                if($countSoChan >= 11 and $countSoChan <= 12 and $this->extra == 'Chẵn 11-12'){
                    $this->textSoChan11hoac12 = "Chẵn (11) hoặc (12)";
                }

                if($countSoChan == 10 and $countSoLe == 10 and $this->extra == 'Hòa Chẵn Lẻ'){
                    $this->textHoaChanLe10 = "Hòa Chẵn Lẻ (10)";
                }
                if($countSoLe >= 11 and $countSoLe <= 12 and $this->extra == 'Lẻ 11-12'){
                    $this->textLe11hoac12 = "Lẻ (11) hoặc (12)";
                }
                if($countSoLe >= 13 and $countSoLe <= 14 and $this->extra == 'Lẻ'){
                    $this->textLe13hoac14 = "Lẻ (13) hoặc (14)";
                }
                // dump($countSoLe);
                // dd($this->extra);

                if($countSoLe >= 15 and $this->extra == 'Lẻ'){
                    $this->textLe15 = "Lẻ (15)";
                }

            }

        }

        // dd($this->textLe15);


        if(isset($data->lotteryTransaction->user->fullName)){
            $this->fullnameLottery = $data->lotteryTransaction->user->fullName;
        }

        if(isset($data->lotteryTransaction->user->phoneNumber)){
            $this->phoneNumber = $data->lotteryTransaction->user->phoneNumber;
        }

        if(isset($data->lotteryTransaction->bill->playType)){
            $this->playType = $data->lotteryTransaction->bill->playType;
        }

        if(isset($data->lotteryTransaction->bill->drawIndex)){
            $this->drawIndex = $data->lotteryTransaction->bill->drawIndex;
        }

        if(isset($data->lotteryTransaction->bill->drawDate)){
            $this->drawDate = $data->lotteryTransaction->bill->drawDate;
        }

        if(isset($data->lotteryTransaction->scans)){
            foreach($data->lotteryTransaction->scans as $url){
                $this->linkURL = $url->scanUrl;
            }
        }

        // dd($data->lotteryTransaction->bill->lotteryResult->jackpot1);
        // dd($data);

        if(isset($data->lotteryTransaction->bill->lotteryResult->jackpot1)){
            $this->lotteryResultJackpot1 = $data->lotteryTransaction->bill->lotteryResult->jackpot1;
        }

        if(isset($data->lotteryTransaction->bill->lotteryResult->jackpot2)){
            $this->lotteryResultJackpot2 = $data->lotteryTransaction->bill->lotteryResult->jackpot2;
        }

        foreach($data->lotteryTransaction->scans as $ticket){
            foreach($ticket->tickets as $number){
                $numbers = $number->numbers;
                $this->danhsachve = $numbers;
                // dd($numbers);
            }
        }

        $arrayNum = [];
        $num = '';

        $strCut = $numbers;

        if(isset($numbers)){
            for($i = 0; $i < strlen($numbers) ; $i++){
                $num = $num . $numbers[$i];
                if($numbers[$i] == ','){
                    $arrayNum[] = str_replace(',', '', $num);

                    $strCut = str_replace($num, '', $strCut);

                    $num = '';
                }

            }
        }
        $arrayNum[] = $strCut;
        $this->numbers = $arrayNum;

        // dd($this->numbers);
    }


    public $currentPage;
    public $totalPage;
    public $totalRecord;
    public $pageSize = 10;

    public $pageCurrent;

    public $start;
    public $end;
    public $part = 10;

    public function SearchLottery(
        $startTimeSearch,
        $endTimeSearch,
        $magiaodich,
        $mabill,
        $status,
        $partnerCode,
        $providerCode,
        $Ketqua,
        $Loaive
    ){
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
        if(!empty($partnerCode)){
            $this->partnerCode = $partnerCode;
        }else{
            unset($this->partnerCode);
        }

        if(!empty($providerCode)){
            $this->providerCode = $providerCode;
        }else{
            unset($this->providerCode);
        }

        if(!empty($magiaodich)){
            $this->magiaodich = $magiaodich;
        }else{
            unset($this->magiaodich);
        }

        if(!empty($mabill)){
            $this->mabill = $mabill;
        }else{
            unset($this->mabill);
        }

        if(!empty($status) and $status != 'all'){
            $this->status = $status;
        }else{
            unset($this->status);
        }

        if(!empty($Ketqua)){
            $this->Ketqua = $Ketqua;
        }else{
            unset($this->Ketqua);
        }

        if(!empty($Loaive)){
            $this->Loaive = $Loaive;
        }else{
            unset($this->Loaive);
        }

    }


    public $startTime;
    public $endTime;
    public $partnerCode;
    public $providerCode;

    public $magiaodich;
    public $mabill;
    public $status;
    public $Ketqua;
    public $Loaive;


    public function getList(){
        $params = [];
        $params['pageSize'] = $this->pageSize;
        $params['page'] = $this->pageCurrent;

        if(isset($this->Loaive)){
            $params['filters']['lotteryCode'] = $this->Loaive;
        }

        if(isset($this->Ketqua)){
            $params['filters']['status'] = $this->Ketqua;
        }

        if(isset($this->status)){
            $params['filters']['status'] = $this->status;
        }

        if(isset($this->mabill)){
            $params['filters']['billCode'] = $this->mabill;
        }

        if(isset($this->magiaodich)){
            $params['filters']['lotteryTransactionId'] = $this->magiaodich;
        }

        if(isset($this->startTime)){
            $params['filters']['startTime'] = $this->startTime;
        }

        if(isset($this->partnerCode)){
            $params['filters']['partnerCode'] = $this->partnerCode;
        }

        if(isset($this->providerCode)){
            $params['filters']['providerCode'] = $this->providerCode;
        }

        if(isset($this->endTime)){
            $params['filters']['endTime'] = $this->endTime;
        }

        $data = LotteryConnection::getList($params);

        if(isset($data->lotteryTransactions)){
            $this->listTransaction = $data->lotteryTransactions;
        }
        if(isset($data->meta->totalPage)){
            $this->totalPage = $data->meta->totalPage;
        }

        if(isset($data->meta->totalRecord)){
            $this->totalRecord = $data->meta->totalRecord;
        }

        if(isset($data->meta->currentPage)){
            $this->currentPage = $data->meta->currentPage;
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

    public function PageSize($pageSize){
        $this->pageSize = $pageSize;
    }

    protected $listLoaive;

    public function getListLoaiVe(){
        $params = [];
        $data = LotteryConnection::getListLoaiVe($params);
        if(isset($data->lotteries)){
            $this->listLoaive = $data->lotteries;
        }
    }

    protected $providerCodeList;

    public function getListProviderCode(){
        $params = [];
        $data = LotteryConnection::getListProviderCode($params);
        if(isset($data->providers)){
            $this->providerCodeList = $data->providers;
        }
    }

    protected $partnerCodeList;

    public function getPartnerCodeList(){
        $params = [];
        $params['pagination']['limit'] = 1000000;
        $data = PartnerConnection::getList($params);
        if(isset($data->data)){
            $this->partnerCodeList = $data->data;
            // dd($this->partnerCodeList);
        }
    }

    // public $overview;
    public $totalTransaction;
    public $totalRevenue;
    public $totalWinTicket;
    public $totalPartnerCommission;
    public $totalProviderCommission;

    public function getOverview(){
        $params = [];
        $data = LotteryConnection::getOverview($params);
        if(isset($data->overview)){
            foreach($data->overview as $key => $overview){
                // dump($key . '-' .$overview);
                if($key == 'totalTransaction'){
                    $this->totalTransaction = $overview;
                }
                if($key == 'totalRevenue'){
                    $this->totalRevenue = $overview;
                }
                if($key == 'totalWinTicket'){
                    $this->totalWinTicket = $overview;
                }
                if($key == 'totalPartnerCommission'){
                    $this->totalPartnerCommission = $overview;
                }
                if($key == 'totalProviderCommission'){
                    $this->totalProviderCommission = $overview;
                }
            }
        }

        // dd($this->totalTransaction);
    }

    public function downloadCSV1(
        $startTimeSearch,
        $endTimeSearch,
        $magiaodich,
        $mabill,
        $status,
        $partnerCode,
        $providerCode,
        $Ketqua,
        $Loaive
    ){
        $params = [];
        $params['pageSize'] = 10000;

        $params['export'] = 1;
        if(isset($this->Loaive)){
            $params['filters']['lotteryCode'] = $this->Loaive;
        }

        if(isset($this->Ketqua)){
            $params['filters']['status'] = $this->Ketqua;
        }

        if(isset($this->status)){
            $params['filters']['status'] = $this->status;
        }

        if(isset($this->mabill)){
            $params['filters']['billCode'] = $this->mabill;
        }

        if(isset($this->magiaodich)){
            $params['filters']['lotteryTransactionId'] = $this->magiaodich;
        }

        if(isset($this->startTime)){
            $params['filters']['startTime'] = $this->startTime;
        }

        if(isset($this->partnerCode)){
            $params['filters']['partnerCode'] = $this->partnerCode;
        }

        if(isset($this->providerCode)){
            $params['filters']['providerCode'] = $this->providerCode;
        }

        if(isset($this->endTime)){
            $params['filters']['endTime'] = $this->endTime;
        }

        $data = LotteryConnection::getList($params);


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

        fputs($handle, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
            $titColum = [
                'Mã giao dịch',
                'Tổng tiền',
                'Trạng thái',
                'Ngày mua',
                'Tên vé',
                'Kênh',
                'Mã Bill',
                'Số lượng',
                'Kết quả',
                'Ngày xổ số',
                'Partner Code',
                'Phí Partner',
                'Nhà cung cấp',
                'Phí Provider',



            ];
            foreach($data->lotteryTransactions as $key => $data){

                $data->billCode = $data->bill->code;
                $data->billamountTickets = $data->bill->amountTickets;
                $data->billisWinTicket = $data->bill->isWinTicket;
                $data->billdrawTime = $data->bill->drawTime;

                $data->partnerCode = $data->partner->code;
                $data->partnerFee = $data->partner->price;

                $data->providerCode = $data->provider->code;
                $data->providerFee = $data->provider->price;
                // dd($data);
                unset($data->bill);
                unset($data->partner);
                unset($data->provider);
                unset($data->lotteryCode);
                if($key == 0){
                    fputcsv($handle, $titColum);
                }
                $data = (array)$data;

                fputcsv($handle, $data);
            }


        fclose($handle);
        ob_flush();
        flush();
        return response()->download($path)->deleteFileAfterSend(true);
        $end = microtime(true);

    }
}
