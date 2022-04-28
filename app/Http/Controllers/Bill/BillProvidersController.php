<?php

namespace App\Http\Controllers\Bill;

use App\Helpers\ArrayHelper;
use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Services\ValidationService;
use App\Services\Bill\BillProvidersService;
use App\Transformers\BillProvidersTransformer;
use Illuminate\Http\Request;

class BillProvidersController extends Controller
{
    protected $request;
    protected $billProviderService;
    protected $validator;

    function __construct(Request $request, ValidationService $validator, BillProvidersService $billProviderService)
    {
        $this->request = $request;
        $this->validator = $validator;
        $this->billProviderService = $billProviderService;
    }

    public function index()
    {
        return view('bill.providers.list_bill_providers');
    }


    /*
     *
     */
    public function ajaxGetList()
    {
        $params = $this->request->all();

        $data = $this->billProviderService->getList($params);
        $data->data = BillProvidersTransformer::transformCollection($data->data);

        return response()->json($data);
    }

    public function add()
    {

        return view('bill.providers.add_bill_providers');
    }

    public function addAction()
    {
        $params = $this->request->only('providerName', 'providerCode', 'secretKey', 'rsaPublicKey', 'rsaPrivateKey');
        $params = ArrayHelper::removeArrayNull($params);
        $validator = $this->validator->make($params, 'add_bill_provider_fields');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->all()), 400);
        }

        $result = $this->billProviderService->add($params);

        if (isset($result->success) && $result->success === true) {

            $data['success'] = true;
            $data['message'] = "Thêm mới Bill Provider thành công !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::BILL_PROVIDER, "Thêm Cấu hình Provider Bill", compact('params')));
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
        $delete = $this->billProviderService->delete($id);
        if($delete) {
            Message::alertFlash('Bạn đã xóa Bill Provider thành công', 'success');
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::BILL_PROVIDER, "Xóa Cấu hình Provider Bill #$id", compact('id')));
        } else {
            Message::alertFlash('Bạn đã xóa Bill Provider không thành công', 'danger');
        }

        return redirect()->route('bill.provider.list');
    }

    public function edit($id)
    {
        $result = $this->billProviderService->detail($id);
        if(!isset($result->errorCode) || $result->errorCode !== 0) {
            abort(404);
        }


        return view('bill.providers.edit_bill_providers', ['detail' => $result->data]);
    }

    public function editAction($id)
    {
        $params = $this->request->only('providerName', 'providerCode',  'secretKey', 'rsaPublicKey', 'rsaPrivateKey');
        $params = ArrayHelper::removeArrayNull($params);
        $validator = $this->validator->make($params, 'edit_bill_provider_fields');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->all()), 400);
        }

        $result = $this->billProviderService->edit($id, $params);

        if (isset($result->success) && $result->success === true) {

            $data['success'] = true;
            $data['message'] = "Cập nhập Bill Provider thành công !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::BILL_PROVIDER, "Sửa Cấu hình Provider Bill #$id", compact('id', 'params')));
            return response()->json($data, 200);
        } else if (isset($result->errorCode) && $result->errorCode != 0) {
            $data = Message::getArray($result->errorCode, $result->message, []);
            return response()->json($data, 400);
        } else {
            $data = Message::get(35, $lang = '', $params);
            return response()->json($data, 400);
        }
    }

}
