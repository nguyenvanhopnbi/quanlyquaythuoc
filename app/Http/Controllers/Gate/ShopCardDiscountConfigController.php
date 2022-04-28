<?php

namespace App\Http\Controllers\Gate;

use App\Helpers\ArrayHelper;
use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Services\ValidationService;
use App\Services\Gate\ShopcardDiscountConfigService;
use App\Services\Gate\ShopcardService;
use App\Transformers\ShopcardDiscountConfigTransformer;
use Illuminate\Http\Request;

class ShopCardDiscountConfigController extends Controller
{
    protected $shopcardService;
    protected $validator;
    protected $request;

    function __construct(ValidationService $validator, ShopcardDiscountConfigService $shopcardDiscountConfigService, Request $request, ShopcardService $shopcardService)
    {
        $this->validator = $validator;
        $this->shopcardDiscountConfigService = $shopcardDiscountConfigService;
        $this->request = $request;
        $this->shopcardService = $shopcardService;
    }

    public function index()
    {
        return view('gate.shop-card-discount-config.list');
    }

    /*
     *
     */
    public function ajaxGetList(Request $request)
    {
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $data = $this->shopcardDiscountConfigService->getList($params);
        $data->data = ShopcardDiscountConfigTransformer::transformCollection($data->data);

        return response()->json($data);
    }


    public function add()
    {
        $cards = $this->shopcardService->getAll();
        $cardOrderByVendor = [];
        foreach($cards as $card){
            $cardOrderByVendor[$card->vendor][] = $card;
        }
        return view('gate.shop-card-discount-config.add', ['cards'=> $cardOrderByVendor]);
    }

    public function addAction()
    {
        $cards = $this->shopcardService->getAll();
        $getParams = [];
        foreach($cards as $card){
            $getParams[] = $card->product_code;
        }
        $getParams[] = 'partner_code';
        $params = $this->request->all($getParams);
        $params = ArrayHelper::removeArrayNull($params);
        $validator = $this->validator->make($params, 'add_shop_card_discount_config_fields');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->messages()), 400);
        }
        $result = $this->shopcardDiscountConfigService->add($params);
        if (isset($result->success) && $result->success === true) {

            $data['success'] = true;
            $data['message'] = "Thêm mới cấu hình giảm giá card thành công !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::SHOPCARD_DISCOUNT, "Thêm Cấu hình chiết khấu Shopcard", compact('params')));
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
        $delete = $this->shopcardDiscountConfigService->delete($id);
        if($delete) {
            Message::alertFlash('Bạn đã xóa cấu hình thành công', 'success');
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::SHOPCARD_DISCOUNT, "Xóa Cấu hình chiết khấu Shopcard #$id", compact('id')));
        } else {
            Message::alertFlash('Bạn đã xóa cấu hình không thành công', 'danger');
        }

        return redirect()->route('shopcard.discount-config.list');
    }

    public function edit($id)
    {
        $cards = $this->shopcardService->getAll();
        $result = $this->shopcardDiscountConfigService->detail($id);
        $result->data->config = json_decode($result->data->config);
        $cardOrderByVendor = [];
        foreach($cards as $card){
            $productCode = $card->product_code;
            $card->default_value = isset($result->data->config->discount->$productCode) ? $result->data->config->discount->$productCode : '';
            $cardOrderByVendor[$card->vendor][] = $card;
        }
        return view('gate.shop-card-discount-config.edit', ['detail' => $result->data, 'cards'=> $cardOrderByVendor]);
    }

    public function editAction($id)
    {
        $cards = $this->shopcardService->getAll();
        $getParams = [];
        foreach($cards as $card) {
            $getParams[] = $card->product_code;
        }

        $params = $this->request->only($getParams);
        if (isset($params['_token'])) {
            unset($params['_token']);
        }
        $params = ArrayHelper::removeArrayNullAndKeepValueKey($params);
        $result = $this->shopcardDiscountConfigService->edit($id, $params);

        if (isset($result->success) && $result->success === true) {
            $data['success'] = true;
            $data['message'] = "Cập nhập cấu hình thành công !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::SHOPCARD_DISCOUNT, "Sửa Cấu hình chiết khấu Shopcard #$id", compact('id', 'params')));
            return response()->json($data, 200);
        } else if (isset($result->errorCode) && $result->errorCode != 0) {
            $data = Message::getArray($result->errorCode, $result->message, []);
            return response()->json($data, 400);
        } else {
            $data = Message::get(13, $lang = '', $params);
            return response()->json($data, 400);
        }
    }
}
