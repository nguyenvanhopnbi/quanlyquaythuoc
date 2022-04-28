<?php

namespace App\Http\Controllers\Gate;

use App\Connection\ShopcardAutoImportCardConnection;
use App\Helpers\ArrayHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Export\ExportAutoImportCard;
use App\Services\Gate\ShopcardAutoImportCardService;
use App\Services\Gate\TopupProviderConfigService;
use App\Services\Gate\ShopcardService;
use Illuminate\Http\Request;

class ShopCardAutoImportCardController extends Controller
{
    protected $shopcardService;
    protected $request;
    protected $topupProviderConfigService;
    protected $shopcardAutoImportCardConnection;
    protected $shopcardAutoImportCardService;
    protected $provider = [
        'Appota' => 'appota',
        'Airpay' => 'airpay',
        'Zota' => 'zota',
        'Epay' => 'epay',
        'Imedia' => 'Imedia',
        'Octa' => 'octa',
        'VtcMobile' => 'vtcmobile',
        'Vtc' => 'vtc',
        'Gate' => 'gate',
    ];

    function __construct(ShopcardAutoImportCardService $shopcardAutoImportCardService, ShopcardService $shopcardService, ShopcardAutoImportCardConnection $shopcardAutoImportCardConnection, Request $request, TopupProviderConfigService $topupProviderConfigService)
    {
        $this->shopcardAutoImportCardConnection = $shopcardAutoImportCardConnection;
        $this->request = $request;
        $this->topupProviderConfigService = $topupProviderConfigService;
        $this->shopcardService = $shopcardService;
        $this->shopcardAutoImportCardService = $shopcardAutoImportCardService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $params = [];
        $data = $this->shopcardAutoImportCardConnection->getList($params);
        $params['pagination']['perpage'] = 1000;
        $vendors = $this->shopcardService->getList($params);
        $cardByVendors = $this->shopcardAutoImportCardService->getCardByVendor($vendors, $data);
        $params['limit'] = 1000;
        $paramProvider = [];
        $resultProviders = $this->shopcardAutoImportCardConnection->getListProvider($paramProvider);
        $providers = $resultProviders ? $resultProviders->data : [];


        return view('gate.shop-card-auto-import-card.list', compact('cardByVendors', 'providers'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxSaveConfig(Request $request)
    {
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $data = $this->shopcardAutoImportCardService->saveConfigAutoImportCard($params);

        return response()->json($data);
    }

    public function exportConfig(Request $request)
    {
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $time = date('dmYHis');
        $objExport = new ExportAutoImportCard();
        $objExport->params = $params;
        $filepath = '/log-auto-import-card-config-' . $time . '.xlsx';
        try {
            \Excel::store($objExport, $filepath, 'public');
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::SHOPCARD_CARD_CONFIG_AUTO_IMPORT_CARD, "Export Config auto import card", compact('params')));
        } catch (\Exception $ex) {
            return  response(['code' => 500, 'message' => 'error'])->header('Content-Type', 'json');
        }
        return response(['code' => 200, 'message' => 'success', 'path' => $filepath])->header('Content-Type', 'json');
    }

    public function downloadConfig()
    {
        $file = $_GET['file'];
        return \Response::download(storage_path('app/public') . $file)->deleteFileAfterSend(true);
    }
}
