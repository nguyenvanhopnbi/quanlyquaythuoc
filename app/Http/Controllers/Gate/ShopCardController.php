<?php

namespace App\Http\Controllers\Gate;

use App\Helpers\ArrayHelper;
use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Export\ExportShopcard;
use App\Services\ValidationService;
use App\Services\Gate\ShopcardService;
use App\Transformers\ShopcardTransformer;
use Illuminate\Http\Request;

class ShopCardController extends Controller
{
    protected $shopcardService;
    protected $validator;
    protected $request;

    function __construct(ValidationService $validator, ShopcardService $shopcardService, Request $request)
    {
        $this->validator = $validator;
        $this->shopcardService = $shopcardService;
        $this->request = $request;
    }

    public function index()
    {
        return view('gate.shop-card.list');
    }

    /*
     *
     */
    public function ajaxGetList(Request $request)
    {
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $data = $this->shopcardService->getList($params);
        $data->data = ShopcardTransformer::transformCollection($data->data);

        return response()->json($data);
    }


    public function add()
    {

        return view('gate.shop-card.add');
    }

    public function addAction()
    {
        $params = $this->request->only(['name', 'productCode', 'vendor', 'value', 'price', 'public']);
        $params = ArrayHelper::removeArrayNull($params);
        $validator = $this->validator->make($params, 'add_shopcard_card_fields');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->messages()), 400);
        }
        $result = $this->shopcardService->add($params);
        if (isset($result->success) && $result->success === true) {

            $data['success'] = true;
            $data['message'] = "Thêm mới card thành công !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::SHOPCARD_CARD, "Thêm Danh sách Thẻ Shopcard", compact('params')));
            return response()->json($data, 200);
        } else if (isset($result->errorCode) && $result->errorCode != 0) {
            $data = Message::getArray($result->errorCode, $result->message, []);
            return response()->json($data, 400);
        } else {
            $data = Message::get(34, $lang = '', $params);
            return response()->json($data, 400);
        }
    }

    public function delete($id)
    {
        $delete = $this->shopcardService->delete($id);
        if ($delete) {
            Message::alertFlash('Bạn đã xóa thẻ thành công', 'success');
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::SHOPCARD_CARD, "Xóa Danh sách Thẻ Shopcard #$id", compact('id')));
        } else {
            Message::alertFlash('Bạn đã xóa thẻ không thành công', 'danger');
        }

        return redirect()->route('shopcard.card.list');
    }

    public function edit($id)
    {
        $result = $this->shopcardService->detail($id);
        return view('gate.shop-card.edit', ['detail' => $result->data]);
    }

    public function editAction($id)
    {
        $params = $this->request->only(['name', 'productCode', 'vendor', 'value', 'price', 'public']);
        $params = ArrayHelper::removeArrayNull($params);
        $validator = $this->validator->make($params, 'edit_shopcard_card_fields');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->messages()), 400);
        }
        $result = $this->shopcardService->edit($id, $params);
        if (isset($result->success) && $result->success === true) {

            $data['success'] = true;
            $data['message'] = "Cập nhật card thành công !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::SHOPCARD_CARD, "Sửa Danh sách Thẻ Shopcard #$id", compact('id', 'params')));
            return response()->json($data, 200);
        } else if (isset($result->errorCode) && $result->errorCode != 0) {
            $data = Message::getArray($result->errorCode, $result->message, []);
            return response()->json($data, 400);
        } else {
            $data = Message::get(13, $lang = '', $params);
            return response()->json($data, 400);
        }
    }

    public function exportTransaction(Request $request)
    {
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $time = date('d-m-Y H:i:s');
        $objExport = new ExportShopcard();
        $objExport->params = $params;
        $filepath = '/log-shop-card-' . $time . '.xlsx';
        try {
            \Excel::store($objExport, $filepath, 'public');
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::SHOPCARD_CARD, "Export Danh sách Thẻ Shopcard", compact('params')));
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
