<?php

namespace App\Http\Controllers\Bill;

use App\Helpers\ArrayHelper;
use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Services\ValidationService;
use App\Services\Bill\BillProvidersConfigService;
use App\Services\Bill\BillProvidersService;
use App\Transformers\BillProvidersConfigTransformer;
use App\Transformers\BillProvidersTransformer;
use Illuminate\Http\Request;

class BillProvidersConfigController extends Controller
{

    protected $request;
    protected $billProviderConfigService;
    protected $billProvidersService;
    protected $validator;

    function __construct(Request $request, ValidationService $validator, BillProvidersConfigService $billProviderConfigService, BillProvidersService $billProvidersService)
    {
        $this->request = $request;
        $this->validator = $validator;
        $this->billProviderConfigService = $billProviderConfigService;
        $this->billProvidersService = $billProvidersService;
    }

    public function index()
    {
        $data['listBillProvider'] = [];
        $params['pagination']['limit'] = 1000;
        $listBillProvider = $this->billProvidersService->getList($params);
        if (isset($listBillProvider->data) && $listBillProvider->data) {
            $data['listBillProvider'] = BillProvidersTransformer::transformCollection($listBillProvider->data);
        }
        
        return view('bill.providerConfig.list_bill_providers_config', ['data' => $data]);
    }

    /*
     *
     */

    public function ajaxGetList()
    {
        $params = $this->request->all();

        $data = $this->billProviderConfigService->getList($params);
        if (isset($data->data) && $data->data) {
            $data->data = BillProvidersConfigTransformer::transformCollection($data->data);
        }

        return response()->json($data);
    }

    public function add()
    {
        $data['listBillProvider'] = [];
        $params['pagination']['limit'] = 1000;
        $listBillProvider = $this->billProvidersService->getList($params);
        if (isset($listBillProvider->data) && $listBillProvider->data) {
            $data['listBillProvider'] = BillProvidersTransformer::transformCollection($listBillProvider->data);
        }
        
        return view('bill.providerConfig.add_bill_providers_config', ['data' => $data]);
    }

    public function addAction()
    {
        $param = $this->request->only('providerCode', 'secretKey', 'rsaPublicKey', 'rsaPrivateKey');
        $params = ArrayHelper::removeArrayNull($param);
        $validator = $this->validator->make($params, 'add_bill_provider_config_fields');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->all()), 400);
        }

        $result = $this->billProviderConfigService->add($params);

        if (isset($result->success) && $result->success === true) {

            $data['success'] = true;
            $data['message'] = "Thêm mới Bill Provider Config thành công !!!";
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
        if(!isset($id) || !$id || $id <= 0){
            Message::alertFlash('Dữ liệu đầu vào không hợp lệ!', 'danger');
            return redirect()->route('bill.providerConfig.list');
        }
        
        $params['id'] = $id;
        $delete = $this->billProviderConfigService->delete($params);
        if ($delete) {
            Message::alertFlash('Bạn đã xóa Bill Provider Config thành công', 'success');
        } else {
            Message::alertFlash('Bạn đã xóa Bill Provider Config không thành công', 'danger');
        }

        return redirect()->route('bill.providerConfig.list');
    }

    public function edit($id)
    {
        $result = $this->billProviderConfigService->detail($id);
        
        if (!isset($result->errorCode) || $result->errorCode !== 0) {
            abort(404);
        }
        
        return view('bill.providerConfig.edit_bill_providers_config', ['providerConfigInfo' => $result->data]);
    }

    public function editAction($id)
    {
        $param = $this->request->only('secretKey', 'rsaPublicKey', 'rsaPrivateKey');
        $params = ArrayHelper::removeArrayNull($param);
        $validator = $this->validator->make($params, 'edit_bill_provider_config_fields');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->all()), 400);
        }

        $result = $this->billProviderConfigService->edit($id, $params);

        if (isset($result->success) && $result->success === true) {

            $data['success'] = true;
            $data['message'] = "Cập nhập Bill Provider Config thành công !!!";
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
