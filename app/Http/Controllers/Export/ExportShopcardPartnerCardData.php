<?php
namespace App\Http\Controllers\Export;

use App\Services\Gate\ShopcardPartnerCardDataService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportShopcardPartnerCardData implements FromView
{
    /**
     * Undocumented variable
     *
     * @var array
     */
    public $params = [];
    public function view(): View
    {
        $shopcardPartnerCardDataService = new ShopcardPartnerCardDataService();
        unset( $this->params['_token']);
        $listTransaction = $shopcardPartnerCardDataService->getListTransactionExport($this->params);
        return view('gate.shop-card-partner-card-data.export', [
            'dataTransaction' => $listTransaction
        ]);
    }
}
