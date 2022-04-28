<?php
namespace App\Http\Controllers\Export;

use App\Services\Gate\BankTransactionService;
use App\Services\PaymentLink\PaymentLinkService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportPaymentLinkTransaction implements FromView
{
    /**
     * Undocumented variable
     *
     * @var array
     */
    public $params = [];
    public function view(): View
    {
        $this->params['export'] = 1;
        $res = app(PaymentLinkService::class)->transactionList($this->params);
        $items = $res['data'] ?? [];
        return view('payment_link.partials.transaction_list_export', [
            'items' => $items
        ]);
    }
}
