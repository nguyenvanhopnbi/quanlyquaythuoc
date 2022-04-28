<?php
namespace App\Http\Controllers\Export;

use App\Connection\ShopcardAutoImportCardConnection;
use App\Services\Gate\ShopcardAutoImportCardService;
use App\Services\Gate\ShopcardService;
use App\Services\Gate\TopupProviderConfigService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportAutoImportCard implements FromView
{
    /**
     * Undocumented variable
     *
     * @var array
     */
    public $params = [];
    public function view(): View
    {
        $shopcardAutoImportCardConnection = new ShopcardAutoImportCardConnection();
        $shopcardService = new ShopcardService();
        $topupProviderConfigService = new TopupProviderConfigService();
        $shopcardAutoImportCardService = new ShopcardAutoImportCardService();
        $data = $shopcardAutoImportCardConnection->getList($this->params);
        $params['pagination']['perpage'] = 1000;
        $vendors = $shopcardService->getList($params);
        $cardByVendors = $shopcardAutoImportCardService->getCardByVendor($vendors, $data);
        $params['limit'] = 1000;
        $data_provider = $topupProviderConfigService->getListSource($params);
        $providers = $data_provider['items'] ? $data_provider['items'] : [];
        return view('gate.shop-card-auto-import-card.export', compact('cardByVendors', 'providers'));
    }
}
