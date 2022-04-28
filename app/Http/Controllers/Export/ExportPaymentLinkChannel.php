<?php
namespace App\Http\Controllers\Export;

use App\Services\Gate\BankTransactionService;
use App\Services\PaymentLink\PaymentLinkService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportPaymentLinkChannel implements FromView
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
        $res = app(PaymentLinkService::class)->channelList($this->params);
        $items = $res['data'] ?? [];
        return view('payment_link.partials.channel_list_export', [
            'items' => $items
        ]);
    }
}
