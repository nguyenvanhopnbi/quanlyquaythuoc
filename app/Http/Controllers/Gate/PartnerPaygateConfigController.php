<?php

namespace App\Http\Controllers\Gate;

use App\Helpers\ArrayHelper;
use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Services\ValidationService;
use App\Services\Gate\PartnerPayGateConfigService;
use App\Transformers\PartnerPaygateConfigTransformer;
use Illuminate\Http\Request;

class PartnerPaygateConfigController extends Controller
{
    protected $partnerService;
    protected $validator;
    protected $request;

    function __construct(ValidationService $validator, PartnerPayGateConfigService $partnerService, Request $request)
    {
        $this->validator = $validator;
        $this->partnerService = $partnerService;
        $this->request = $request;
    }

    public function index()
    {
        return view('gate.partner-paygate-config.list');
    }

    /*
     *
     */
    public function ajaxGetList(Request $request)
    {
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $data = $this->partnerService->getList($params);
        $data->data = PartnerPaygateConfigTransformer::transformCollection($data->data);
        // dd($data);
        return response()->json($data);
    }

    /*
     *
     */
    public function ajaxGetListSource(Request $request)
    {
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $data = $this->partnerService->getListSource($params);
        return response()->json($data);
    }

    public function add()
    {

        return view('gate.partner-paygate-config.add');
    }

    public function addAction()
    {
        $params = $this->request->only([
            'partner_code',
            'contract_number',
            'atm_payment_fee',
            'atm_transaction_fee',
            'cc_payment_fee',
            'cc_transaction_fee',
            'ewallet_payment_fee',
            'ewallet_transaction_fee',
            'ewallet_appota_fee',
            'ewallet_transaction_appota_fee',
            'cc_payment_jcb_fee',
            'cc_transaction_jcb_fee',
        ]);
        $params = ArrayHelper::removeArrayNull($params);
        // dd($params);
        $validator = $this->validator->make($params, 'add_partner_pay_gate_config_fields');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->messages()), 400);
        }

        $result = $this->partnerService->add($params);
        // dd($result);
        if (isset($result->success) && $result->success === true) {

            $data['success'] = true;
            $data['message'] = "Thêm mới config thành công !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_PAYGATE_CONFIG, "Thêm Phí Cổng TT", compact('params')));
            return response()->json($data, 200);
        } else if (isset($result->errorCode) && $result->errorCode != 0) {
            $data = Message::getArray($result->errorCode, $result->message, [$result->message]);
            return response()->json($data, 400);
        } else {
            $data = Message::get(143, $lang = '', []);
            return response()->json($data, 400);
        }
    }

    public function delete($id)
    {
        $delete = $this->partnerService->delete($id);
        if ($delete) {
            Message::alertFlash('Bạn đã xóa config thành công', 'success');
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_PAYGATE_CONFIG, "Xóa Phí Cổng TT #$id", compact('id')));
        } else {
            Message::alertFlash('Bạn đã xóa config không thành công', 'danger');
        }

        return redirect()->route('gate.partner.paygate.congfig.list');
    }

    public function edit($id)
    {
        $result = $this->partnerService->detail($id);
        return view('gate.partner-paygate-config.edit', ['detail' => $result->data]);
    }

    public function editAction($id)
    {
        $params = $this->request->only([
            '_id',
            'partner_code',
            'contract_number',
            'atm_payment_fee',
            'atm_transaction_fee',
            'cc_payment_fee',
            'cc_transaction_fee',
            'ewallet_payment_fee',
            'ewallet_transaction_fee',
            'ewallet_appota_fee',
            'ewallet_transaction_appota_fee',
            'cc_payment_jcb_fee',
            'cc_transaction_jcb_fee',
        ]);
        $params = ArrayHelper::removeArrayNull($params);
        $validator = $this->validator->make($params, 'update_partner_pay_gate_config_fields');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->messages()), 400);
        }

        $result = $this->partnerService->edit($id, $params);

        if ($result->errorCode == '0') {
            // dd('1111111111');
            $data['success'] = true;
            $data['message'] = "Cập nhập config thành công !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_PAYGATE_CONFIG, "Sửa Phí Cổng TT #$id", compact('id', 'params')));
            return response()->json($data, 200);
        } else if (isset($result->errorCode) && $result->errorCode != 0) {
            $data = Message::getArray($result->errorCode, $result->message, []);            
            return response()->json($data, 400);
        } else {
            $data = Message::get(144, $lang = '', []);
            return response()->json($data, 400);
        }
    }

    public function detail($id)
    {
        $data = $this->partnerService->detail($id);
        return view('gate.partner-paygate-config.detail-popup', ['detail' => $data->data]);
    }
}
