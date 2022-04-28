<?php

namespace App\Http\Controllers\Export;

use App\Services\Game\GameService;
use App\Services\Gate\BankVendorTokenService;
use App\Services\Partner\PartnerBankAccountService;
use App\Transformers\Game\GameSettingTransformer;
use App\Transformers\Partner\PartnerBankAccountTransformer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportBankVendorTokenList implements FromView
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
        $res = app(BankVendorTokenService::class)->bankTokenList($this->filter);
        $items = $res['data'] ?? [];
        return view('gate.bank-vendor-token.partials.bank_vendor_token_list_export', [
            'items' => $items,
        ]);
    }
}
