<?php

namespace App\Http\Controllers\Export;

use App\Services\Game\GameService;
use App\Services\Partner\PartnerBankAccountService;
use App\Transformers\Game\GameSettingTransformer;
use App\Transformers\Partner\PartnerBankAccountTransformer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportPartnerBankAccount implements FromView
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
        $res = app(PartnerBankAccountService::class)->listBankAccount($this->filter);
        $items = $res['data'] ?? [];
        foreach ($items as &$item) {
            $item = PartnerBankAccountTransformer::convertAttributes($item);
        }
        return view('partner.partials.account_list_export', [
            'items' => $items,
        ]);
    }
}
