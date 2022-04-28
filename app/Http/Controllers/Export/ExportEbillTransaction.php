<?php


namespace App\Http\Controllers\Export;

use App\Services\Gate\EbillTransactionService;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ExportEbillTransaction implements FromView
{

    public $params = [];

    /**
     * @return View
     */
    public function view(): View
    {
        $ebillTransactionService = new EbillTransactionService();
        unset( $this->params['_token']);
        $listTransaction = $ebillTransactionService->getListTransactionExport($this->params);
        return view('gate.ebill-transaction.export', [
            'dataTransaction' => $listTransaction
        ]);
    }
}
