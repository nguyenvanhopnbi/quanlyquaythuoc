<?php
namespace App\Http\Controllers\Export;

use App\Services\Gate\ShopcardItemService;
use App\Transformers\ShopcardItemTransformer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportShopcardItem implements FromView
{
    /**
     * Undocumented variable
     *
     * @var array
     */
    public $params = [];
    public function view(): View
    {
        $shopcardItemService = new ShopcardItemService();
        unset( $this->params['_token']);
        $listTransaction = $shopcardItemService->getListTransactionExport($this->params);
        $listTransaction->data = ShopcardItemTransformer::transformCollection($listTransaction->data);
        return view('gate.shop-card-item.export', [
            'dataTransaction' => $listTransaction
        ]);
    }
}
