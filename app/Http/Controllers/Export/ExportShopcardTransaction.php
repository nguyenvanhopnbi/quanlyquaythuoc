<?php
namespace App\Http\Controllers\Export;

use App\Services\Gate\ShopcardTransactionService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportShopcardTransaction implements FromView
{
    /**
     * Undocumented variable
     *
     * @var array
     */
    public $params = [];
    public function view(): View
    {
        $shopcardTransactionService = new ShopcardTransactionService();
        unset( $this->params['_token']);
        $listTransaction = $shopcardTransactionService->getListTransactionExport($this->params);
        return view('gate.shopcard-transaction.export', [
            'dataTransaction' => $listTransaction,
        ]);
    }
}
