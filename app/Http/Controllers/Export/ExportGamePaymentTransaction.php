<?php
namespace App\Http\Controllers\Export;

use App\Services\Game\GameService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportGamePaymentTransaction implements FromView
{
    private $statuses;
    private $paymentMethods;
    private $filter;

    public function __construct(array $filter = [],array $statuses, array $paymentMethods)
    {
        $this->statuses = $statuses;
        $this->paymentMethods = $paymentMethods;
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
        $res = app(GameService::class)->transactions($this->filter);
        $items = $res['data'] ?? [];
        return view('game.partials.transaction_list_export', [
            'items' => $items,
            'statuses' => $this->statuses,
            'paymentMethods' => $this->paymentMethods,
        ]);
    }
}
