<?php
namespace App\Http\Controllers\Export;

use App\Repositories\PartnerBankTransferRepository;
use App\Services\Game\GameService;
use App\Services\Partner\PartnerBankAccountService;
use App\Transformers\Partner\PartnerAccountTransferTransformer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportPartnerBankAccountTransfer implements FromView
{
    private $filter;

    public function __construct(array $filter = [])
    {
        $this->filter = $filter;
    }

    /**
     * Undocumented variable
     *
     * @var array
     */
    public $params = [];
    public function view(): View
    {
        $this->filter['export'] = 1;
        $res = app(PartnerBankTransferRepository::class)->transactions(1, 15, $this->filter);
        $items = $res['data'] ?? [];
        foreach ($items as &$item) {
            $item = PartnerAccountTransferTransformer::convertAttributes($item);
        }
        return view('partner.partials.bank_account_transfer_transaction_list_export', [
            'items' => $items,
        ]);
    }
}
