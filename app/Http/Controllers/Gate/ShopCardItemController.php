<?php

namespace App\Http\Controllers\Gate;

use App\Helpers\ArrayHelper;
use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Export\ExportShopcardItem;
use App\Services\ValidationService;
use App\Services\Gate\ShopcardItemService;
use App\Services\Gate\ShopcardService;
use App\Transformers\ShopcardItemTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ShopCardItemController extends Controller
{
    protected $shopcardItemService;
    protected $shopcardService;
    protected $validator;
    protected $request;

    public function __construct(ValidationService $validator, ShopcardItemService $shopcardItemService, Request $request, ShopcardService $shopcardService)
    {
        $this->validator = $validator;
        $this->shopcardItemService = $shopcardItemService;
        $this->request = $request;
        $this->shopcardService = $shopcardService;
    }



    public function index()
    {
        return view('gate.shop-card-item.list');
    }

    /*
     *
     */
    public function ajaxGetList(Request $request)
    {
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $data = $this->shopcardItemService->getList($params);
        $data->data = ShopcardItemTransformer::transformCollection($data->data);
        // dd($data);
        return response()->json($data);
    }

    public function exportcard(){
        return view('gate.shop-card-item.exportcard');
    }


    public function add()
    {
        $cards = $this->shopcardService->getAll();
        $vendor = [];
        foreach ($cards as $card) {
            if (!in_array($card->vendor, $vendor)) $vendor[] = $card->vendor;
        }
        return view('gate.shop-card-item.add', ['vendors' => $vendor]);
    }

    public function addAction()
    {
        $params = $this->request->only(['data', 'vendor', 'provider_code']);

        $params = ArrayHelper::removeArrayNull($params);
        $validator = $this->validator->make($params, 'add_shop_card_item_fields');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->messages()), 400);
        }
        Redis::set('process-create-card-item', 0);
        Redis::set('processed-create-card-item', 0);

        $results = $this->shopcardItemService->add($params);
        $data['success'] = true;
        $data['message'] = "Thêm mới card item thành công!!!";
        if (in_array(false, $results->success)) {
            $row = [];
            foreach ($results->success as $key => $result) {
                $row[] = ++$key;
            }
            $data['success'] = false;
            $data['message'] = "Dòng " . implode(',', $row) . " bị lỗi!";
        }
        event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::SHOPCARD_CARD_ITEM, "Thêm Danh sách Item Thẻ Shopcard", compact('params')));
        return response()->json($data, 200);
    }

    public function extend()
    {
        return view('gate.shop-card-item.extend');
    }

    public function detail($id)
    {
        $result = $this->shopcardItemService->detail($id);
        return view('gate.shop-card-item.detail-popup', ['detail' => ShopcardItemTransformer::transform($result->data)]);
    }

    public function progress()
    {
        $progress = Redis::get('process-create-card-item');
        $progressed = Redis::get('processed-create-card-item');
        $data['sucess'] = true;
        $data['progress'] = $progress;
        $data['progressed'] = $progressed;
        return response()->json($data);
    }

    public function import(Request $request)
    {
        $validator = $this->validator->make($request->all(), 'import_card_data_file');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->messages()), 400);
        }
        if ($this->checkExtensionFile($request->file('file')->getClientOriginalExtension()) == false) {
            //return validator with error by file input name
            return response()->json(Message::get(38, $lang = '', $validator->errors()->messages()), 400);
        }
        $results = $this->shopcardItemService->import($request->file('file'), $request['vendor']);
        $data['success'] = true;
        $data['message'] = "Thêm mới card item thành công!!!";
        if (property_exists($results, 'success')) {
            $row = [];
            foreach ($results->success as $key => $result) {
                $row[] = ++$key;
            }
            $data['success'] = false;
            $data['message'] = "Dòng " . implode(',', $row) . " bị lỗi!";
        }
        event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::SHOPCARD_CARD, "Import Danh sách Item Thẻ Shopcard"));
        return response()->json($data, 200);
    }

    private function checkExtensionFile($file_ext)
    {
        $valid = [
            'xls',
            'xlsx',
            'txt'
        ];
        return in_array($file_ext, $valid) ? true : false;
    }

    public function exportTransaction(Request $request)
    {
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $time = date('dmYHis');
        $objExport = new ExportShopcardItem();
        $objExport->params = $params;
        $filepath = '/log-shop-card-' . $time . '.xlsx';
        try {
            \Excel::store($objExport, $filepath, 'public');
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::SHOPCARD_CARD, "Export Danh sách Item Thẻ Shopcard", compact('params')));
        } catch (\Exception $ex) {
            return response(['code' => 500, 'message' => 'error'])->header('Content-Type', 'json');
        }
        return response(['code' => 200, 'message' => 'success', 'path' => $filepath])->header('Content-Type', 'json');
    }

    public function downloadTransaction()
    {
        $file = $_GET['file'];
        return \Response::download(storage_path('app/public') . $file)->deleteFileAfterSend(true);
    }
}
