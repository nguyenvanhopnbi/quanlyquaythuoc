<?php

namespace App\Http\Livewire\Gate\ShopcardItem;

use Livewire\Component;
use App\Services\Gate\TopupDenominationService;
use App\Transformers\TopupDenominationTransformer;
use App\Services\Gate\TopupProviderConfigService;
use Illuminate\Support\Facades\Auth;
use App\Connection\exportcardConnection;
use App\Connection\ShopcardItemConnection;

class Exportcard extends Component
{
    protected $listeners = [
        'getValue' => 'getValue',
        'exportcardItem' => 'exportcardItem',
        'searchExportItem' => 'searchExportItem',
        'getDataTable' => 'getDataTable',
        'ShowCode' => 'ShowCode'
    ];
    protected $queryString = [
        'nhamang' => ['except' => ''],
        'menhgia' => ['except' => ''],
        'soluong' => ['except' => ''],
        'startTime' => ['except' => ''],
        'endTime' => ['except' => ''],
        'emailAdmin' => ['except' => ''],
    ];
    public function render()
    {
        $this->getTelcoValue();
        $this->getProviderCode();
        $this->getList();
        // $this->getListDetail();
        return view('livewire.gate.shopcard-item.exportcard', [
            'listCardItemDetail' => $this->listCardItemDetail,
            'listCardItemLog' => $this->listCardItemLog,
            'loading' => $this->loading
        ]);
    }

    protected $loading;
    public $codeCard;
    public $idCard;

    public $codeCardVisible = '';

    public function ShowCode($id){

        $user = Auth::user();
        $params['email'] = $user->email;
        $codeCard = ShopcardItemConnection::checkuser($id, $params);
         $this->codeCard = '';
        if(isset($codeCard->data->code)){
            $this->codeCard = $codeCard->data->code;
            $this->idCard = $id;

        }
        // dd($codeCard);
    }

    public function getCode($id){

        $user = Auth::user();

        $params['email'] = $user->email;
        $codeCard = ShopcardItemConnection::checkuser($id, $params);
         $this->codeCard = '';
        if(isset($codeCard->data->code)){
            // dd(date('y'));
            // dump(date('Y-m-d H:i:s', $codeCard->data->expiry));
            return $codeCard->data->code;
        }
        return false;
    }

    protected $listCardItemDetail;
    public $count = 0;
    public function getDataTable($card_item){
        $this->codeCard = '';
        $this->listCardItemDetail = '';
        $this->count = 0;
        if(!isset($card_item)){
            $card_item = '';
        }
        $params = [];
        $params['query']['ids'] = $card_item;
        $params['pagination']['limit'] = 200000000000000;
        $data = ShopcardItemConnection::getList($params);
        // $datacard->codecard = $this->getCode('2851');
        // dd($datacard);
        if(isset($data->data) and !empty($data->data)){

            foreach($data->data as $datacard){
                if($this->getCode($datacard->id) != false){
                    $datacard->codecard = $this->getCode($datacard->id);
                }else{
                    $datacard->codecard = "";
                }

            }
            // dump($data);
            // dd($datacard);

            $this->listCardItemDetail = $data->data;
            $this->loading = $data->data;
            $this->count = count($data->data);
        }
    }

    protected $listCardItemLog = [];

    public $totalPage;
    public $currentPage;

    public $part = 10;
    public $startPage;
    public $endPage;

    public $pageCurrent;

    public $nhamang;
    public $menhgia;
    public $soluong;
    public $startTime;
    public $endTime;
    public $emailAdmin;

    public function getList(){
        $params = [];
        if(isset($this->pageCurrent)){
            $params['pagination']['page'] = $this->pageCurrent;
        }
        if(isset($this->nhamang)){
            $params['query']['vendor'] = $this->nhamang;
        }

        if(isset($this->menhgia)){
            $params['query']['amount'] = $this->menhgia;
        }
        if(isset($this->soluong)){
            $params['query']['quantity'] = $this->soluong;
        }

        if(isset($this->startTime)){
            $params['query']['startTime'] = $this->startTime;
        }
        if(isset($this->endTime)){
            $params['query']['endTime'] = $this->endTime;
        }

        if(isset($this->emailAdmin)){
            $params['query']['email_admin'] = $this->emailAdmin;
        }

        $data = exportcardConnection::getList($params);
        if(isset($data->data)){
            $this->listCardItemLog = $data->data;

        }
        if(isset($data->meta->pages)){
            $this->totalPage = $data->meta->pages;
        }
        if(isset($data->meta->page)){
            $this->currentPage = $data->meta->page;
        }
        $this->startPage = $this->currentPage - $this->part;
        if($this->startPage < 1){
            $this->startPage = 1;
        }

        $this->endPage = $this->currentPage + $this->part;
        if($this->endPage > $this->totalPage){
            $this->endPage = $this->totalPage;
        }
    }

    public function searchExportItem($nhamang, $menhgia, $soluong, $startTime, $endTime, $email){
        // dd($nhamang. '-'.$menhgia.'-'.$soluong.'-'.$startTime.'-'.$endTime.'-'.$email);

        $this->nhamang = $nhamang;
        $this->menhgia = $menhgia;
        $this->soluong = $soluong;
        if(isset($startTime) and !empty($startTime)){
            $this->startTime = strtotime($startTime);
        }
        if(isset($endTime) and !empty($endTime)){
            $this->endTime = strtotime($endTime);
        }
        $this->emailAdmin = $email;
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


    public $message;
    public function exportcardItem($nhamang, $value, $quantity){

        $value = str_replace('.', '', $value);
        $params['vendor'] = $nhamang;
        $params['amount'] = $value;
        $params['quantity'] = $quantity;
        $params['email'] = Auth::user()->email;

        // dd($nhamang. '-'.$value. '-'.$quantity);
        $result = exportcardConnection::exportcard($params);

        if(!$result){
            $this->message = "Xuất card item thất bại!!!";
            return;
        }
        if($result->errorCode != 0 or empty($result->data)){
            $this->message = "Xuất card item thất bại!!! Hoặc không có dữ liệu card items";
            return;
        }

        $data = $result->data;
        // dd($data);
        set_time_limit(0);
        ini_set('memory_limit', '512M');
        $fileName = date('YmdHis', time());
        header('Content-Type: application/vnd.ms-execl');
        header('Content-Disposition: attachment;filename="' . $fileName . '.csv"');
        $path = storage_path('app/') . $fileName .'.csv';
        $begin = microtime(true);
        $handle = fopen($path, 'w');
        // $handle = fopen("php://output", 'a');

        $count = 1;
        fputs($handle, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
                foreach($data as $key=>$data){
                    if($count == 1){
                        foreach($data as $tit=>$content){
                            $title[] = $tit;
                        }
                        fputcsv($handle, $title);
                    }
                    $count++;
                    $data = (array)$data;
                    $data['created_at'] = date('Y-m-d H:i:s', $data['created_at']);
                    $data['updated_at'] = date('Y-m-d H:i:s', $data['updated_at']);
                    fputcsv($handle, $data);
                }

        fclose($handle);
        ob_flush();
        flush();

        return response()->download($path)->deleteFileAfterSend(true);
        $end = microtime(true);

    }


    public function getEmail(){
        $email = Auth::user()->email;
        return $email;
    }

    public function getValue($nhamang){
        $this->telcoValue = $nhamang;
    }

    public $telcoValueData;

    public $telcoValue;

    public function getTelcoValue(){
        $params = [];
        if(isset($this->telcoValue)){
            $params['query']['telco'] = $this->telcoValue;
        }else{
            $params['query']['telco'] = 'viettel';
        }
        // dd($params);

        $TopupDenominationService = new TopupDenominationService();
        $data = $TopupDenominationService->getList($params);

        // dd($data);
        $this->telcoValueData = [];
        if(isset($data->data) and !empty($data->data)){
            $data->data = TopupDenominationTransformer::transformCollection($data->data);
            foreach($data->data as $data){
                $this->telcoValueData[] = $data->value;
            }
        }

    }


    public function getProviderCode(){
        if(isset($providerCodeLivewire)){
            $this->providerCode = $providerCodeLivewire;
        }
        $params = [];
        $TopupProviderConfigService = new TopupProviderConfigService();
        $data = $TopupProviderConfigService->getListSource($params);
        $this->providerCodeData = [];
        foreach($data['items'] as $data){
            $this->providerCodeData[] = $data->providerCode;
        }
        // dd($this->providerCodeData);
    }
}
