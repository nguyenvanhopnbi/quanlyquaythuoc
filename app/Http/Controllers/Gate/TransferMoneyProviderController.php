<?php

namespace App\Http\Controllers\Gate;

use App\Helpers\ArrayHelper;
use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Services\ValidationService;
use App\Services\Gate\TransferMoneyProviderService;
use App\Transformers\TransferMoneyProviderTransformer;
use Illuminate\Http\Request;

class TransferMoneyProviderController extends Controller
{

    protected $transferMoneyProviderService;
    protected $validator;
    protected $request;

    function __construct(ValidationService $validator, TransferMoneyProviderService $transferMoneyProviderService, Request $request)
    {
        $this->validator = $validator;
        $this->transferMoneyProviderService = $transferMoneyProviderService;
        $this->request = $request;
    }

    public function index()
    {
        return view('gate.transfer-money-provider.list');
    }

    /*
     *
     */

    public function ajaxGetList(Request $request)
    {
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $data = $this->transferMoneyProviderService->getList($params);
        $data->data = TransferMoneyProviderTransformer::transformCollection($data->data);
        // dd($data->data);
        return response()->json($data);
    }

    public function detail($id)
    {
        $result = $this->transferMoneyProviderService->detail($id);
        return view('gate.transfer-money-provider.detail-popup', ['detail' => TransferMoneyProviderTransformer::transform($result->data)]);
    }
    
    public function add()
    {
        return view('gate.transfer-money-provider.add');
    }

    public function addAction()
    {
        $params = $this->request->only(['providerCode', 'providerName', 'secretKey', 'rsaPublicKey', 'rsaPrivateKey']);
        $params = ArrayHelper::removeArrayNull($params);
        $validator = $this->validator->make($params, 'add_transfer_money_provider_fields');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->messages()), 400);
        }
        $result = $this->transferMoneyProviderService->add($params);
        if (isset($result->success) && $result->success === true) {
            $data['success'] = true;
            $data['message'] = "Thêm mới Provider thành công !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TRANSFER_MONEY_PROVIDER, "Thêm Provider Chi hộ", compact('params')));
            return response()->json($data, 200);
        } else if (isset($result->errorCode) && $result->errorCode != 0) {
            $data = Message::getArray($result->errorCode, $result->message, []);
            return response()->json($data, 400);
        } else {
            $data = Message::get(145, $lang = '', $params);
            return response()->json($data, 400);
        }
    }

    public function edit($id)
    {
        if(!isset($id) || !is_numeric($id) || $id <= 0){
            return redirect()->route('transfer.money.provider.list');
        }
        
        $result = $this->transferMoneyProviderService->detail($id);
        return view('gate.transfer-money-provider.edit', ['detail' => $result->data]);
    }
    
    public function editAction($id)
    {
        $params = $this->request->only(['secretKey', 'rsaPublicKey', 'rsaPrivateKey']);
        $params = ArrayHelper::removeArrayNull($params);
        $validator = $this->validator->make($params, 'edit_transfer_money_provider_fields');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->messages()), 400);
        }
        $result = $this->transferMoneyProviderService->edit($id, $params);
        if (isset($result->success) && $result->success === true) {

            $data['success'] = true;
            $data['message'] = "Cập nhập Provider config thành công !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TRANSFER_MONEY_PROVIDER, "Sửa Provider Chi hộ #$id", compact('id', 'params')));
            return response()->json($data, 200);
        } else if (isset($result->errorCode) && $result->errorCode != 0) {
            $data = Message::getArray($result->errorCode, $result->message, []);
            return response()->json($data, 400);
        } else {
            $data = Message::get(13, $lang = '', $params);
            return response()->json($data, 400);
        }
    }
    
    public function delete($id)
    {
        if(!isset($id) || !is_numeric($id) || $id <= 0){
            return redirect()->route('transfer.money.provider.list');
        }
        $params['id'] = $id;
        $delete = $this->transferMoneyProviderService->delete($params);
        if($delete) {
            Message::alertFlash('Bạn đã xóa Provider thành công', 'success');
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TRANSFER_MONEY_PROVIDER, "Xóa Provider Chi hộ #$id", compact('id')));
        } else {
            Message::alertFlash('Bạn đã xóa Provider không thành công', 'danger');
        }

        return redirect()->route('transfer.money.provider.list');
    }
}
