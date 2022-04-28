<?php

namespace App\Http\Controllers\Gate;

use App\Helpers\ArrayHelper;
use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Services\ValidationService;
use App\Services\Gate\BankVendorService;
use App\Transformers\ApplicationProvidersTransformer;
use Illuminate\Http\Request;

class BankVendorController extends Controller
{
    protected $bankVendorService;
    protected $validator;
    protected $request;

    public function __construct(ValidationService $validator, BankVendorService $bankVendorService, Request $request)
    {
        $this->validator = $validator;
        $this->bankVendorService = $bankVendorService;
        $this->request = $request;
    }

    public function index()
    {
        return view('gate.bank-vendor.list_vendor');
    }

    /*
     *
     */
    public function ajaxGetList(Request $request)
    {
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $data = $this->bankVendorService->getList($params);
        $data->data = ApplicationProvidersTransformer::transformCollection($data->data);
        return response()->json($data);
    }

    /*
     *
     */
    public function ajaxGetListSource(Request $request)
    {
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $data = $this->bankVendorService->getListSource($params);

        return response()->json($data);
    }


    public function add()
    {
        return view('gate.bank-vendor.add_vendor');
    }

    public function addAction()
    {

        $params = $this->request->only('vendor_code', 'vendor_name', 'public');
        $params = ArrayHelper::removeArrayNull($params);
        $validator = $this->validator->make($params, 'add_bank_vendor_fields');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->messages()), 400);
        }
        $result = $this->bankVendorService->add($params);

        if (isset($result->success) && $result->success === true) {
            $data['success'] = true;
            $data['message'] = "Thêm mới bank vendor thành công !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::GATE_VENDOR, "Thêm Bank Vendor CTT", compact('params')));
            return response()->json($data, 200);
        } elseif (isset($result->errorCode) && $result->errorCode != 0) {
            $data = Message::getArray($result->errorCode, $result->message, []);
            return response()->json($data, 400);
        } else {
            $data = Message::get(34, $lang = '', $params);
            return response()->json($data, 400);
        }
    }

    public function delete($id)
    {
        $delete = $this->bankVendorService->delete($id);
        if ($delete) {
            Message::alertFlash('Bạn đã xóa bank vendor thành công', 'success');
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::GATE_VENDOR, "Xóa Bank Vendor CTT #$id", compact('id')));
        } else {
            Message::alertFlash('Bạn đã xóa bank vendor không thành công', 'danger');
        }

        return redirect()->route('gate.bank-vendor.list');
    }

    public function edit($id)
    {
        $details = [];
        $result = $this->bankVendorService->detail($id);
        $result->id = $id;

        $details['vendor_code'] = $result->vendor_code;
        $details['vendor_name'] = $result->vendor_name;
        $details['payment_method'] = $result->payment_method;
        $details['public'] = $result->public;
        $details['created_at'] = $result->created_at;
        $details['updated_at'] = $result->updated_at;
        $details['id'] = $result->id;

        return view('gate.bank-vendor.edit_vendor', ['detail' => $details]);
    }

    public function editAction($id)
    {
        $params = $this->request->only('vendor_code', 'vendor_name', 'public');
        $params = ArrayHelper::removeArrayNull($params);
        $validator = $this->validator->make($params, 'edit_bank_vendor_fields');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->messages()), 400);
        }
        $result = $this->bankVendorService->edit($id, $params);
        if (isset($result->success) && $result->success === true) {
            $data['success'] = true;
            $data['message'] = "Cập nhập bank vendor thành công !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::GATE_VENDOR, "Sửa Bank Vendor CTT #$id", compact('id', 'params')));
            return response()->json($data, 200);
        } elseif (isset($result->errorCode) && $result->errorCode != 0) {
            $data = Message::getArray($result->errorCode, $result->message, []);
            return response()->json($data, 400);
        } else {
            $data = Message::get(13, $lang = '', $params);
            return response()->json($data, 400);
        }
    }
}
