<?php
namespace App\Http\Controllers\Export;

use App\Services\Gate\TopupTransactionService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportTopupTransaction implements FromView
{
    /**
     * Undocumented variable
     *
     * @var array
     */
    public $params = [];
    public function view(): View
    {
        $topupTransactionService = new TopupTransactionService();
        unset( $this->params['_token']);
        $listTransaction = $topupTransactionService->getListTransactionExport($this->params);
        return view('gate.topup-transaction.export', [
            'dataTransaction' => $listTransaction
        ]);
    }
}
