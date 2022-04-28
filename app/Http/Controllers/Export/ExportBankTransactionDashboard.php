<?php
namespace App\Http\Controllers\Export;

use App\Services\Gate\BankTransactionService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportBankTransactionDashboard implements FromView
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
        $listTransaction = $bankTransactionService->getReportPartnerByDay2($this->params);
        return view('gate.dashboard.export', [
            'dataTransaction' => $listTransaction
        ]);
    }
}
