<?php

namespace App\Exports;

use App\Connection\TransferMoneyCheckAccountTransactionConnection;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class TransferMoneyCheckAccountTransactionExport implements FromView
{
    use Exportable;

    protected $transactions;

    public function __construct($filter)
    {
        $filter = Collection::wrap($filter)
            ->put('export', true)
            ->toArray();
        [$this->transactions] = (new TransferMoneyCheckAccountTransactionConnection)->index([
            'filter' => $filter,
        ]);
    }

    public function view(): View
    {
        return view('gate.transfer-money-check-account-transaction.export', [
            'transactions' => $this->transactions
        ]);
    }
}
