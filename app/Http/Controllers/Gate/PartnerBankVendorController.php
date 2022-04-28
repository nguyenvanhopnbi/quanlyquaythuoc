<?php

namespace App\Http\Controllers\Gate;

use App\Helpers\ArrayHelper;
use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Services\ValidationService;
use App\Services\Gate\PartnerBankVendorService;
use App\Transformers\ApplicationProvidersTransformer;
use Illuminate\Http\Request;
use App\Services\Gate\BankService;

class PartnerBankVendorController extends Controller
{
    protected $partnerBankVendorService;
    protected $validator;
    protected $request;

    function __construct(ValidationService $validator, PartnerBankVendorService $partnerBankVendorService, Request $request)
    {
        $this->validator = $validator;
        $this->partnerBankVendorService = $partnerBankVendorService;
        $this->request = $request;
    }

    public function bankVendorPaymentMethod(){
        return view('gate.partner-bank-vendor.list_vendor_payment_method');
    }

    public function index()
    {
        return view('gate.partner-bank-vendor.list_vendor');
    }

    /*
     *
     */
    public function ajaxGetList(Request $request)
    {
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $data = $this->partnerBankVendorService->getList($params);
        $data->data = ApplicationProvidersTransformer::transformCollection($data->data);

        return response()->json($data);
    }


    public function add()
    {

        return view('gate.partner-bank-vendor.add_vendor');
    }

    public function addAction()
    {
        $params = $this->request->only('partner_code', 'bank_code', 'vendor_code');
        $params = ArrayHelper::removeArrayNull($params);
        $validator = $this->validator->make($params, 'add_partner_bank_vendor_fields');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->messages()), 400);
        }
        $result = $this->partnerBankVendorService->add($params);
        if (isset($result->success) && $result->success === true) {

            $data['success'] = true;
            $data['message'] = "Thêm mới partner bank vendor thành công !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::GATE_PARTNER_BANK_VENDOR, "Thêm Cấu hình Bank Vendor theo Partner CTT", compact('params')));
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
        $delete = $this->partnerBankVendorService->delete($id);
        if ($delete) {
            Message::alertFlash('Bạn đã xóa partner bank vendor thành công', 'success');
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::GATE_PARTNER_BANK_VENDOR, "Xóa Cấu hình Bank Vendor theo Partner CTT #$id", compact('id')));
        } else {
            Message::alertFlash('Bạn đã xóa partner bank vendor không thành công', 'danger');
        }

        return redirect()->route('gate.partner-bank-vendor.list');
    }

    public function edit($id)
    {
        $result = $this->partnerBankVendorService->detail($id);
        $BankService = new BankService();
        $params = [];
        $bankcode = $BankService->getList($params)->data;

        $result->id = $id;
        return view('gate.partner-bank-vendor.edit_vendor', [
            'detail' => $result,
            'bankcode' => $bankcode
        ]);
    }


    public function editAction($id)
    {
        $params = $this->request->only('partner_code', 'bank_code', 'vendor_code');
        $params = ArrayHelper::removeArrayNull($params);
        $validator = $this->validator->make($params, 'edit_partner_bank_vendor_fields');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->messages()), 400);
        }
        $result = $this->partnerBankVendorService->edit($id, $params);
        if (isset($result->success) && $result->success === true) {

            $data['success'] = true;
            $data['message'] = "Cập nhập partner bank vendor thành công !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::GATE_PARTNER_BANK_VENDOR, "Sửa Cấu hình Bank Vendor theo Partner CTT #$id", compact('id', 'params')));
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
