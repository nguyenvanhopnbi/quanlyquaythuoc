<?php
namespace App\Http\Controllers\Export;

use App\Services\Gate\BankTransactionService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportRefundTransaction implements FromView
{
    /**
     * Undocumented variable
     *
     * @var array
     */
    public $params = [];
    public function view(): View
    {
        $bankTransactionService = new BankTransactionService();
        unset( $this->params['_token']);
        $listTransaction = $bankTransactionService->getListRefundTransactionExport($this->params);
        return view('gate.bank-refund-transaction.export', [
            'dataTransaction' => $listTransaction
        ]);
    }
}
