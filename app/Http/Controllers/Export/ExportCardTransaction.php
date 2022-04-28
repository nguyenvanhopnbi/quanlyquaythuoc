<?php
namespace App\Http\Controllers\Export;

use App\Services\Charging\ChargingService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportCardTransaction implements FromView
{
    /**
     * Undocumented variable
     *
     * @var array
     */
    public $params = [];
    public function view(): View
    {
        $chargingService = new ChargingService();
        unset( $this->params['_token']);
        $listTransaction = $chargingService->getListTransactionExport($this->params);
        return view('charging.transaction.export', [
            'dataTransaction' => $listTransaction
        ]);
    }
}
