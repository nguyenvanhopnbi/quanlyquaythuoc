<?php

namespace App\Http\Controllers\Gate;

use App\Helpers\ArrayHelper;
use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Services\ValidationService;
use App\Services\Gate\ApplicationServiceConfigService;
use App\Services\Gate\PartnerService;
use App\Services\Gate\ApplicationService;
use App\Transformers\ApplicationProvidersTransformer;
use Illuminate\Http\Request;
use App\Helpers\CheckIsAmUser;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;

class ApplicationServiceConfigController extends Controller
{
    protected $applicationServiceConfigService;
    protected $validator;
    protected $request;
    protected $partnerService;
    protected $applicationService;

    function __construct(ValidationService $validator, ApplicationServiceConfigService $applicationServiceConfigService, Request $request, PartnerService $partnerService, ApplicationService $applicationService)
    {
        $this->validator = $validator;
        $this->applicationServiceConfigService = $applicationServiceConfigService;
        $this->partnerService = $partnerService;
        $this->applicationService = $applicationService;
        $this->request = $request;
    }

    public function index()
    {
        return view('gate.application-service-config.list_application_service_config');
    }

    /*
     *
     */
    public function ajaxGetList(Request $request)
    {
        $params = $request->all();

        $partnerCode = null;
        $partnerCode = CheckIsAmUser::checkIsAmUser();

        $data = $this->applicationServiceConfigService->getList($params, $partnerCode);
        $applications = $this->applicationService->getApplicationLookUp();
        $data->data = ApplicationProvidersTransformer::transformCollectionApplication($data->data, $applications);

        return response()->json($data);
    }

    public function add()
    {
        $partnerCode = $this->partnerService->getAll();
        $applications = $this->applicationService->getAll();

        return view('gate.application-service-config.add_gate_application_service_config', ['partnerCodes'=> $partnerCode, 'applicationIds'=> $applications]);

    }

    public function addAction()
    {

        $params = $this->request->only('partner_code', 'service_code', 'service_name', 'application_id', 'description');
        $params = ArrayHelper::removeArrayNull($params);
        $validator = $this->validator->make($params, 'add_gate_application_service_config_fields');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->messages()), 400);
        }

        $partnerCode = CheckIsAmUser::checkIsAmUser();

        $result = $this->applicationServiceConfigService->add($params, $partnerCode);

        if (isset($result->success) && $result->success === true) {

            $data['success'] = true;
            $data['message'] = "Thêm mới gate application service config thành công !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_APPLICATION_SERVICE_CONFIG, "Thêm Gate Application Service Config Partner", compact('params')));
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
        $delete = $this->applicationServiceConfigService->delete($id, $partnerCode);
        Log::info('Application delete log 11111111111', $delete);
        if($delete) {
            Message::alertFlash('Bạn đã xóa gate application service config thành công', 'success');
                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_APPLICATION_SERVICE_CONFIG, "Xóa Gate Application Service Config Partner #$id", compact('id')));
        } else {
            Message::alertFlash('Bạn đã xóa gate application service config không thành công', 'danger');
        }

        return redirect()->route('gate.application-service-config.list');


    }

    public function edit($id)
    {
        $result = $this->applicationServiceConfigService->detail($id);
        $partnerCode = $this->partnerService->getAll();
        $applications = $this->applicationService->getAll($result->partner_code);
        $result->id = $id;
        return view('gate.application-service-config.edit_gate_application_service_config', ['detail' => ApplicationProvidersTransformer::transformApplication($result, $applications), 'partnerCodes'=>  $partnerCode, 'applications'=> $applications]);


    }

    public function editAction($id)
    {

        $params = $this->request->only('partner_code', 'service_code', 'service_name', 'application_id', 'description');
        $params = ArrayHelper::removeArrayNull($params);
        $validator = $this->validator->make($params, 'edit_gate_application_service_config_fields');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->messages()), 400);
        }

        $partnerCode = CheckIsAmUser::checkIsAmUser();

        $result = $this->applicationServiceConfigService->edit($id, $params, $partnerCode);


        Log::info('Application edit log 11111111111', $result);

        if (isset($result->success) && $result->success === true) {

            $data['success'] = true;
            $data['message'] = "Cập nhập Application service config thành công !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_APPLICATION_SERVICE_CONFIG, "Sửa Gate Application Service Config Partner #$id", compact('id', 'params')));
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
