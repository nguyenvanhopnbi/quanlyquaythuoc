<?php

namespace App\Http\Controllers\Gate;

use App\Helpers\ArrayHelper;
use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Services\ValidationService;
use App\Services\Gate\CollectMoneyPartnerService;
use App\Transformers\CollectMoneyPartnerTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CollectMoneyPartnerController extends Controller
{
    protected $collectMoneyPartnerService;
    protected $validator;
    protected $request;

    function __construct(ValidationService $validator, CollectMoneyPartnerService $collectMoneyPartnerService, Request $request)
    {
        $this->validator = $validator;
        $this->collectMoneyPartnerService = $collectMoneyPartnerService;
        $this->request = $request;
    }

    public function index()
    {
        return view('gate.collect-money-partner.list');
    }

    /*
     *
     */
    public function ajaxGetList(Request $request)
    {
        $params = $request->all();
        Log::info('all param=' . json_encode($params));
        $data = $this->collectMoneyPartnerService->getList($params);
        Log::info('data CollectMoneyPartnerController = ' . json_encode($data));
        $data->data = CollectMoneyPartnerTransformer::transformCollection($data->data);

        return response()->json($data);
    }

    public function add()
    {

        return view('gate.collect-money-partner.add');
    }

    public function addAction()
    {
        $params = $this->request->only('providerCode', 'apiKey', 'secretKey', 'rsaPublicKey', 'systemRsaPrivateKey', 'status');
        $params = ArrayHelper::removeArrayNull($params);
        $validator = $this->validator->make($params, 'add_collect_money_partner_fields');

        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->messages()), 400);
        }
        $result = $this->collectMoneyPartnerService->add($params);

        if (isset($result->success) && $result->success === true) {
            $data['success'] = true;
            $data['message'] = "Thêm mới cấu hình Provider thành công !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::EBILL_VIRTUAL_ACCOUNT_COLLECT_MONEY, "Thêm Cấu hình Provider Ebill", compact('params')));
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
        $delete = $this->collectMoneyPartnerService->delete($id);
        if ($delete) {
            Message::alertFlash('Bạn đã xóa cấu hình Provider thành công', 'success');
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::EBILL_VIRTUAL_ACCOUNT_COLLECT_MONEY, "Xóa Cấu hình Provider Ebill #$id", compact('id')));
        } else {
            Message::alertFlash('Bạn đã xóa cấu hình Provider không thành công', 'danger');
        }

        return redirect()->route('gate.collect-money-partner.list');
    }

    public function edit($id)
    {
        $result = $this->collectMoneyPartnerService->detail($id);
        $result->id = $id;
        return view('gate.collect-money-partner.edit', ['detail' => $result->data]);
    }

    public function editAction($id)
    {
        $recordEdit = $this->collectMoneyPartnerService->detail($id);
        if (empty($recordEdit)) {
            return response()->json('Ban ghi khong con ton tai', 404);
        }

        $params = $this->request->only('apiKey', 'secretKey', 'rsaPublicKey', 'systemRsaPrivateKey', 'status');
        $params = ArrayHelper::removeArrayNull($params);
        $validator = $this->validator->make($params, 'edit_collect_money_partner_fields');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->messages()), 400);
        }
        $params['providerCode'] =  $recordEdit->data->provider_code;
        $result = $this->collectMoneyPartnerService->edit($id, $params);
        if (isset($result->success) && $result->success === true) {
            $data['success'] = true;
            $data['message'] = "Cập nhật cấu hình thành công !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::EBILL_VIRTUAL_ACCOUNT_COLLECT_MONEY, "Sửa Cấu hình Provider Ebill #$id", compact('id', 'params')));
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
