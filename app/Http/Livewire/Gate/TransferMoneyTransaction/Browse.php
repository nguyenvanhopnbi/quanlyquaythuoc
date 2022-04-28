<?php

namespace App\Http\Livewire\Gate\TransferMoneyTransaction;

use App\Connection\BillServiceConnection;
use App\Services\Gate\ApplicationService;
use App\Services\Gate\PartnerService;
use App\Services\Gate\TransferMoneyTransactionService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;
use App\Helpers\PusherHelper;
use App\Helpers\CheckIsAmUser;
use Log;

class Browse extends Component
{

    use WithPagination, AuthorizesRequests;

    public $filter = [
        'partnerCode',
        'applicationId'
    ];

    protected $listPartnerCode = [];
    protected $listApplicationId = [];
    public $perPage = '25';
    public $transactions = [];
    public $transaction = [];
    protected $totalAmount = 0;
    public $channelName = '';
    public $channelEven = '';
    public $key = '';
    public $cluster = '';
    public $fileName = '';

    public $startTime;
    public $endTime;

    public $responseStartTime;
    public $responseEndTime;

    protected $paginationTheme = 'bootstrap';

    // protected $queryString = [
    //     'filter' =>[
    //         'transactionId' => ['except' => ''],
    //         'applicationId' => ['except' => ''],
    //     ]
    // ];

    protected $listeners = [
        'saved' => '$refresh',
        'ExportTransferMoneyTransaction' => 'ExportTransferMoneyTransaction',
        'search' => 'search',
        'refund' => 'refund'
    ];

    public function mount(PartnerService $partnerService, ApplicationService $applicationService)
    {
        $this->key = env('PUSHER_APP_KEY');
        $this->cluster = env('PUSHER_APP_CLUSTER');
        $this->authorize('transfer-money-transaction-browse');
        $this->listPartnerCode = collect($partnerService->getAll())
            ->reject(fn ($item) => !$item || !$item->partner_code)
            ->map(fn ($item) => $item->partner_code)
            ->values()
        ->toArray();
        $this->loadListApplicationId($this->filter['partnerCode'] ?? '');
    }

    public $transactionIdSearch;
    public $providerRefIdSearch;
    public $bankCode;

    public $start;
    public $end;
    public $part = 10;
    public $currentPage;
    public $totalPage;

    public function render(TransferMoneyTransactionService $transferMoneyTransactionService)
    {

        $params['filter'] = $this->filter;
        $params['limit'] = $this->perPage;
        $params['page'] = $this->page;
        if(isset($this->startTime)){
            $params['filter']['startTime'] = $this->startTime;
        }

        if(isset($this->endTime)){
            $params['filter']['endTime'] = $this->endTime;
        }

        if(isset($this->responseStartTime)){
            $params['filter']['responseStartTime'] = $this->responseStartTime;
        }

        if(isset($this->bankCode)){
            $params['filter']['bankCode'] = $this->bankCode;
        }

        if(isset($this->responseEndTime)){
            $params['filter']['responseEndTime'] = $this->responseEndTime;
        }

        $partnerCode = null;
        $partnerCode = CheckIsAmUser::checkIsAmUser();

        [$this->transactions, $meta] = $transferMoneyTransactionService->getList($params, $partnerCode);

        if(isset($meta->page)){
            $this->currentPage = $meta->page;
        }

        if(isset($meta->pages)){
            $this->totalPage = $meta->pages;
        }

        $this->start = $this->currentPage - $this->part;
        if($this->start < 0){
            $this->start = 1;
        }
        $this->end = $this->currentPage + $this->part;
        if($this->end > $this->totalPage){
            $this->end = $this->totalPage;
        }

        $this->totalAmount = number_format($meta->total_amount ?? 0, 0, ',', '.');
        $meta = collect(range(1, $meta->total))->paginate($meta->limit);
        return view('livewire.gate.transfer-money-transaction.browse',[
            'meta' => $meta,
            'transactions' => $this->transactions,
            'totalAmount' => $this->totalAmount,
            'transaction' => $this->transaction,
            'listApplicationId' => $this->listApplicationId,
            'listPartnerCode' => $this->listPartnerCode
        ]);
    }

    public function gotoCurrentPage($page){
        if($page < 1){
            $page = 1;
        }
        if($page > $this->totalPage){
            $page = $this->totalPage;
        }

        $this->page = $page;
    }

    public function ExportTransferMoneyTransaction(
        $transaction_id,
        $partner_ref_id,
        $partner_code,
        $application_id,
        $customer_phone_number,
        $status,
        $transfer_status,
        $amount,
        $account_number,
        $startTime,
        $endTime,
        $providerCode,
        $TimeType,
        $bankCode
    ){
        return redirect()->route("transfer.money.transaction.listExport", [
            'transactionId' => $transaction_id,
            'partnerRefId'=>$partner_ref_id,
            'partnerCode'=>$partner_code,
            'applicationId'=>$application_id,
            'customerPhoneNumber'=>$customer_phone_number,
            'status'=>$status,
            'transferStatus'=>$transfer_status,
            'amount'=>$amount,
            'accountNo'=>$account_number,
            'startTime'=>$startTime,
            'endTime'=>$endTime,
            'providerCode' => $providerCode,
            'TimeType' => $TimeType,
            'bankCode' => $bankCode

        ]);
    }

    public function show($key)
    {
        $this->transaction = collect($this->transactions[$key])->toArray();
        // $this->transaction = json_decode(json_encode($this->transaction),true);
    }

    public function export()
    {
        $this->authorize('transfer-money-transaction-export');
        $secret = new TransferMoneyTransactionService();
        $secret = $secret->export($this->filter);
        event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TRANSFER_MONEY_TRANSACTION, "Export Giao dịch Chi hộ", ['params' => $this->filter]));

        $this->channelName = PusherHelper::getExportChannel(auth()->id());
        $this->channelEven = PusherHelper::getExportEven($secret);
        $this->fileName = '/log-transfer-money-transaction-' . now()->format('dmYHis') . '.xlsx';
        $dataEmit = [
            'channelName' => PusherHelper::getExportChannel(auth()->id()),
            'channelEven' => PusherHelper::getExportEven($secret),
            'key' => env('PUSHER_APP_KEY'),
            'cluster' => env('PUSHER_APP_CLUSTER')
        ];
        $this->emit('eventPusherDownloadExcel', $dataEmit);
    }

    public $providerRefId;

    public function search(
        $transaction_id,
        $partner_ref_id,
        $partner_code,
        $application_id,
        $customer_phone_number,
        $status,
        $transfer_status,
        $amount,
        $account_number,
        $startTime,
        $endTime,
        $Tm_providerRefId,
        $TimeType,
        $bankCode
    )
    {
        if($TimeType == 'requestTime'){
            unset($this->responseStartTime);
            unset($this->responseEndTime);
            $this->startTime = $startTime;
            $this->endTime = $endTime;
        }else{
            unset($this->startTime);
            unset($this->endTime);
            $this->responseStartTime = $startTime;
            $this->responseEndTime = $endTime;
        }
        $this->bankCode = $bankCode;
    }

    public function download()
    {
        event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TRANSFER_MONEY_TRANSACTION, "Export Giao dịch Chi hộ", ['params' => $this->filter]));
        return \Response::download(storage_path('app/public') . $this->fileName)->deleteFileAfterSend(true);

    }

    public function updatedFilterPartnerCode($value)
    {
        $this->loadListApplicationId($value);
    }

    public function loadListApplicationId($partnerCode)
    {
        $applicationService = new ApplicationService;
        $listApplicationId = collect($applicationService->getListSource(['partnerCode' => $partnerCode]))
            ->values()
            ->last();
        $this->listApplicationId = Collection::wrap($listApplicationId)
            ->mapWithKeys(fn ($item) => [$item->id => $item->name])
            ->toArray();
        $this->filter['applicationId'] = '';
    }

    public function refund()
    {
        if ($this->transaction['status'] !== 'success' || $this->transaction['transferStatus'] !== 'pending') {
            return;
        }

        $refundStatus = BillServiceConnection::refund($transactionId = $this->transaction['transactionId']);

        if (!isset($refundStatus->errorCode) || $refundStatus->errorCode !== 0) {
            $this->dispatchBrowserEvent('refund-failed');
            $this->emit('saved');
            return;
        }
        event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TRANSFER_MONEY_TRANSACTION, "Refund Giao dịch Chi hộ #" . $transactionId, compact('transactionId')));
        $this->transaction['status'] = 'refund';
        $this->dispatchBrowserEvent('refund-successfully');
    }
}
