<?php

namespace App\Http\Controllers\Export;

use App\Services\Gate\TransferMoneyTransactionService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class ExportTransferMoneyTransaction implements FromView
{
    use Exportable;

    private $params = [];

    public function __construct($params = null)
    {
        $this->params = $params;
    }

    public function view(): View
    {
        $topupTransactionService = new TransferMoneyTransactionService();
        $listTransaction = $topupTransactionService->getListTransactionExport(['query' => $this->params]);
        return view('gate.transfer-money-transaction.export', [
            'dataTransaction' => $listTransaction
        ]);
    }
}
