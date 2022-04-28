<?php

namespace App\Http\Livewire;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BankTransactionExportH;
use App\Services\Gate\BankTransactionService;
use App\Http\Controllers\BankTransactionController;

use Livewire\Component;

class Export extends Component
{
    public $timeout = 1200;

    const AVAILABLE_COLUMNS = [
        'transaction_id',
        'order_id',
        'partner_code',
        'amount',
        'fee',
        'currency',
        'bank_code',
        'application_id',
        'application_name',
        'status',
        'payment_method',
        'payment_type',
        'request_time',
        'response_time',
        'vendor_code',
        'order_info',
        'client_ip',
        'error_message',
        'vendor_ref_id',
    ];

    private $name;
    private $params;
    private $bankTransactionService;


    public function render()
    {
        return view('livewire.export');
    }
    public function mount($name, $params){
        $BankTransactionController = new BankTransactionController();
        $this->name = $name;
        $this->params = $params;
        $this->bankTransactionService = app(BankTransactionService::class);
    }

    protected $listeners = [
        'ExportAllBankTransaction' => 'ExportAllBankTransaction'
    ];

    public function ExportAllBankTransaction(){
        $headers = collect(self::AVAILABLE_COLUMNS)->intersect($this->params['columns'] ?? []);
        unset($this->params['_token']);
        unset($this->params['columns']);
        $rows = $this->bankTransactionService->getListTransactionExport($this->params)->data ?? [];
        dd($rows);
    }

}
