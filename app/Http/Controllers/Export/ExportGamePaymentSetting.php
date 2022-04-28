<?php

namespace App\Http\Controllers\Export;

use App\Services\Game\GameService;
use App\Transformers\Game\GameSettingTransformer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportGamePaymentSetting implements FromView
{
    private $applications;
    private $filter;

    public function __construct(array $filter = [], array $applications)
    {
        $this->applications = $applications;
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
        $res = app(GameService::class)->settings($this->filter);
        $items = $res['data'] ?? [];
        foreach ($items as &$item) {
            $item = GameSettingTransformer::convertSettingAttributes($item, $this->applications);
        }
        return view('game.partials.setting_list_export', [
            'items' => $items,
        ]);
    }
}
