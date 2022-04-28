<?php
namespace App\Http\Controllers\Export;

use App\Services\Gate\ShopcardService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportShopcard implements FromView
{
    /**
     * Undocumented variable
     *
     * @var array
     */
    public $params = [];
    public function view(): View
    {
        $shopcardService = new ShopcardService();
        unset( $this->params['_token']);
        $listTransaction = $shopcardService->getListTransactionExport($this->params);
        return view('gate.shop-card.export', [
            'dataTransaction' => $listTransaction
        ]);
    }
}
