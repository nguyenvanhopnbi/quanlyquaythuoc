<?php
namespace App\Http\Controllers\Export;

use App\Services\Gate\BankTransactionService;
use App\Services\PaymentLink\PaymentLinkService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportPaymentLinkCustomer implements FromView
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
        $res = app(PaymentLinkService::class)->customerList($this->params);
        if($res['errorCode'] === 0) {
            $items = $res['data'] ?? [];
        } else {
            $items = [];
        }
        return view('payment_link.partials.customer_list_export', [
            'items' => $items
        ]);
    }
}
