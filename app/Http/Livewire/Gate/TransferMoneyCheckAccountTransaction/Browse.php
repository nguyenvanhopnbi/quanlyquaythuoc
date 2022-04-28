<?php

namespace App\Http\Livewire\Gate\TransferMoneyCheckAccountTransaction;

use App\Connection\TransferMoneyCheckAccountTransactionConnection;
use App\Exports\TransferMoneyCheckAccountTransactionExport;
use App\Services\Gate\PartnerService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class Browse extends Component
{
    use WithPagination, AuthorizesRequests;

    public $filter = [
        'partnerCode' => ''
    ];
    public $listPartnerCode = [];
    public $perPage = '25';
    public $transactions = [];
    public $transaction = [];

    protected $listeners = ['ExportTransferMoneyCheckAccountTransaction' => 'ExportTransferMoneyCheckAccountTransaction'];

    protected $paginationTheme = 'bootstrap';

    protected $queryString = ['filter'];

    public function mount(PartnerService $partnerService)
    {
        $this->authorize('transfer-money-check-account-transaction-browse');
        $this->listPartnerCode = collect($partnerService->getAll())
            ->reject(fn ($item) => !$item || !$item->partner_code)
            ->map(fn ($item) => $item->partner_code)
            ->values()
            ->toArray();
    }

    public function render(TransferMoneyCheckAccountTransactionConnection $transferMoneyCheckAccountTransactionConnection)
    {
        [$this->transactions, $meta] = $transferMoneyCheckAccountTransactionConnection->index([
            'filter' => $this->filter,
            'limit' => $this->perPage,
            'page' => $this->page,
        ]);

        $meta = collect(range(1, $meta->total))->paginate($meta->limit);
        return view('livewire.gate.transfer-money-check-account-transaction.browse', compact('meta'));
    }
    public function ExportTransferMoneyCheckAccountTransaction(
        $transaction_id,
        $partner_ref_id,
        $account_number,
        $partner_code,
        $status,
        $check_status,
        $bank_code,
        $startTime,
        $endTime
    ){
        return redirect()->route('transfer.money.check-account-transaction-exportcsv', [
            'transactionId'=>$transaction_id,
            'partnerRefId'=>$partner_ref_id,
            'accountNo'=>$account_number,
            'partnerCode'=>$partner_code,
            'status'=>$status,
            'checkAccountStatus'=>$check_status,
            'bankCode'=>$bank_code,
            'startTime'=>$startTime,
            'endTime'=>$endTime

        ]);
    }

    public function show($key)
    {
        $this->transaction = collect($this->transactions[$key])->toArray();
    }

    public function export()
    {
        $this->authorize('transfer-money-check-account-transaction-export');
        event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TRANSFER_MONEY_TRANSACTION, "Export Giao dịch Check Account Chi hộ", ['params' => $this->filter]));
        return (new TransferMoneyCheckAccountTransactionExport($this->filter))
            ->download('check_account_transaction_' . now()->format('dmYHis') . '.xlsx');
    }

    public function filter()
    {
        # code...
    }
}
