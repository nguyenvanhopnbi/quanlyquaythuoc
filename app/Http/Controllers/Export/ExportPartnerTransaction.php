<?php
namespace App\Http\Controllers\Export;

use App\Services\Gate\PartnerTransactionService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportPartnerTransaction implements FromView
{
    /**
     * Undocumented variable
     *
     * @var array
     */
    public $params = [];
    public function view(): View
    {
        $partnerTransactionService = new PartnerTransactionService();
        unset( $this->params['_token']);
        $listTransaction = $partnerTransactionService->getListTransactionExport($this->params);
        return view('gate.partner-transaction.export', [
            'dataTransaction' => $listTransaction
        ]);
    }
}
