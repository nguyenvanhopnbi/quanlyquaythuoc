<?php

namespace App\Http\Controllers\Gate;

use App\Helpers\ArrayHelper;
use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Services\ValidationService;
use App\Services\Gate\ApplicationService;
use App\Transformers\ApplicationProvidersTransformer;
use Illuminate\Http\Request;
use App\Helpers\CheckIsAmUser;

class ApplicationController extends Controller
{
    protected $applicationService;
    protected $validator;
    protected $request;

    function __construct(ValidationService $validator, ApplicationService $applicationService, Request $request)
    {
        $this->validator = $validator;
        $this->applicationService = $applicationService;
        $this->request = $request;
    }

    public function index()
    {
        return view('gate.application.list_application');
    }

    /*
     *
     */
    public function ajaxGetList(Request $request)
    {
        $params = $request->all();
        $partnerCode = null;
        $partnerCode = CheckIsAmUser::checkIsAmUser();
        $data = $this->applicationService->getList($params, $partnerCode);
        $data->data = ApplicationProvidersTransformer::transformCollection($data->data);

        return response()->json($data);
    }

    /*
     *
     */
    public function ajaxGetListSource(Request $request)
    {
        $params = $request->all('q', 'partnerCode');
        $data = $this->applicationService->getListSource($params);

        return response()->json($data);
    }

    public function add()
    {

        return view('gate.application.add_gate_application');
    }

    public function addAction()
    {
        $params = $this->request->only('partner_code', 'allowed_ips', 'api_key', 'secret_key', 'ebill_notify_url', 'rsa_public_key', 'rsa_private_key', 'status', 'name', 'description', 'icon');
        $params = ArrayHelper::removeArrayNull($params);
        $validator = $this->validator->make($params, 'add_gate_application_fields');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->messages()), 400);
        }

        $partnerCode = CheckIsAmUser::checkIsAmUser();

        $result = $this->applicationService->add($params, $partnerCode);
        if (isset($result->success) && $result->success === true) {

            $data['success'] = true;
            $data['message'] = "Th??m m???i gate application th??nh c??ng !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_APPLICATION, "Th??m Gate Application Partner", compact('params')));
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
        $partnerCode = CheckIsAmUser::checkIsAmUser();
        $delete = $this->applicationService->delete($id, $partnerCode);
        if ($delete) {
            Message::alertFlash('B???n ???? x??a gate application th??nh c??ng', 'success');
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_APPLICATION, "X??a Gate Application Partner #$id", compact('id')));
        } else {
            Message::alertFlash('B???n ???? x??a gate application kh??ng th??nh c??ng', 'danger');
        }

        return redirect()->route('gate.application.list');
    }

    public function edit($id)
    {
        $result = $this->applicationService->detail($id);
        $result->id = $id;
        return view('gate.application.edit_gate_application', ['detail' => $result]);
    }

    public function detail($id)
    {
        $result = $this->applicationService->detail($id);
        $result->id = $id;
        $status = [
            'inactive' => 'badge-warning',
            'active' => 'badge-success',
            'blocked' => 'badge-danger',
        ];
        $result->status_badge = $status[$result->status];
        return view('gate.application.detail-popup', ['detail' => $result]);
    }

    public function editAction($id)
    {
        $params = $this->request->only('partner_code', 'allowed_ips', 'api_key', 'secret_key', 'ebill_notify_url', 'rsa_public_key', 'rsa_private_key', 'status', 'description', 'icon', 'name');
        $params = ArrayHelper::removeArrayNull($params);
        $validator = $this->validator->make($params, 'edit_gate_application_fields');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->messages()), 400);
        }

        $partnerCode = CheckIsAmUser::checkIsAmUser();

        $result = $this->applicationService->edit($id, $params, $partnerCode);
        if (isset($result->success) && $result->success === true) {

            $data['success'] = true;
            $data['message'] = "C???p nh???p Application th??nh c??ng !!!";

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_APPLICATION, "S???a Gate Application Partner", compact('id', 'params')));

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
