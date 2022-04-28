<?php

namespace App\Http\Controllers\Gate;

use App\Helpers\ArrayHelper;
use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Services\ValidationService;
use App\Services\Gate\PartnerVendorService;
use App\Transformers\ApplicationProvidersTransformer;
use Illuminate\Http\Request;

class PartnerVendorController extends Controller
{
    protected $partnerVendorService;
    protected $validator;
    protected $request;

    function __construct(ValidationService $validator, PartnerVendorService $partnerVendorService, Request $request)
    {
        $this->validator = $validator;
        $this->partnerVendorService = $partnerVendorService;
        $this->request = $request;
    }

    public function index()
    {
        return view('gate.partner-vendor.list_vendor');
    }

    /*
     *
     */
    public function ajaxGetList(Request $request)
    {
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $data = $this->partnerVendorService->getList($params);
        $data->data = ApplicationProvidersTransformer::transformCollection($data->data);

        return response()->json($data);
    }


    public function add()
    {

        return view('gate.partner-vendor.add_vendor');
    }

    public function addAction()
    {
        $params = $this->request->only('partner_code', 'vendor_code');
        $params = ArrayHelper::removeArrayNull($params);
        $validator = $this->validator->make($params, 'add_partner_vendor_fields');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->messages()), 400);
        }
        $result = $this->partnerVendorService->add($params);
        if (isset($result->success) && $result->success === true) {

            $data['success'] = true;
            $data['message'] = "Thêm mới cấu hình vendor theo partner thành công !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::GATE_PARTNER_VENDOR, "Thêm Cấu hình Vendor theo Partner CTT", compact('params')));
            return response()->json($data, 200);
        } else if (isset($result->errorCode) && $result->errorCode != 0) {
            $data = Message::getArray($result->errorCode, $result->message, []);
            return response()->json($data, 400);
        } else {
            $data = Message::get(10, $lang = '', $params);
            return response()->json($data, 400);
        }
    }

    public function delete($id)
    {
        $delete = $this->partnerVendorService->delete($id);
        if ($delete) {
            Message::alertFlash('Bạn đã xóa cấu hình vendor theo partner thành công', 'success');
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::GATE_PARTNER_VENDOR, "Xóa Cấu hình Vendor theo Partner CTT #$id", compact('id')));
        } else {
            Message::alertFlash('Bạn đã xóa cấu hình vendor theo partner không thành công', 'danger');
        }

        return redirect()->route('gate.partner-vendor.list');
    }

    public function edit($id)
    {
        $result = $this->partnerVendorService->detail($id);
        $result->id = $id;
        return view('gate.partner-vendor.edit_vendor', ['detail' => $result]);
    }

    public function editAction($id)
    {
        $params = $this->request->only('partner_code', 'vendor_code');
        $params = ArrayHelper::removeArrayNull($params);
        $validator = $this->validator->make($params, 'edit_partner_vendor_fields');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->messages()), 400);
        }
        $result = $this->partnerVendorService->edit($id, $params);
        if (isset($result->success) && $result->success === true) {

            $data['success'] = true;
            $data['message'] = "Cập nhập partner vendor thành công !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::GATE_PARTNER_VENDOR, "Sửa Cấu hình Vendor theo Partner CTT", compact('id', 'params')));
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
