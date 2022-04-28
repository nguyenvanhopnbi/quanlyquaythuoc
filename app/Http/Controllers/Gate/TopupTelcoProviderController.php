<?php

namespace App\Http\Controllers\Gate;

use App\Helpers\ArrayHelper;
use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Services\ValidationService;
use App\Services\Gate\TopupTelcoProviderService;
use App\Transformers\TopupTelcoProviderTransformer;
use Illuminate\Http\Request;

class TopupTelcoProviderController extends Controller
{
    protected $topupTelcoProviderService;
    protected $validator;
    protected $request;

    function __construct(ValidationService $validator, TopupTelcoProviderService $topupTelcoProviderService, Request $request)
    {
        $this->validator = $validator;
        $this->topupTelcoProviderService = $topupTelcoProviderService;
        $this->request = $request;
    }

    public function index()
    {
        return view('gate.topup-telco-provider.list');
    }

    /*
     *
     */
    public function ajaxGetList(Request $request)
    {
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $data = $this->topupTelcoProviderService->getList($params);
        $data->data = TopupTelcoProviderTransformer::transformCollection($data->data);

        return response()->json($data);
    }


    public function add()
    {
        return view('gate.topup-telco-provider.add');
    }

    public function addAction()
    {
        // dd('vao day');
        $params = $this->request->only(['telco', 'providerCode', 'telcoServiceType']);
        // dd($params);
        $params = ArrayHelper::removeArrayNull($params);
        $validator = $this->validator->make($params, 'add_topup_telco_provider_config');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->messages()), 400);
        }
        $result = $this->topupTelcoProviderService->add($params);
        if (isset($result->success) && $result->success === true) {

            $data['success'] = true;
            $data['message'] = "Thêm mới topup provider config thành công !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TOPUP_TELCO_PROVIDER, "Thêm Cấu hình Telco Provider Topup", compact('params')));
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
        $delete = $this->topupTelcoProviderService->delete($id);
        if ($delete) {
            Message::alertFlash('Bạn đã xóa topup telco provider thành công', 'success');
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TOPUP_TELCO_PROVIDER, "Xóa Cấu hình Telco Provider Topup #$id", compact('id')));
        } else {
            Message::alertFlash('Bạn đã xóa topup telco provider không thành công', 'danger');
        }

        return redirect()->route('topup.telco-provider.list');
    }

    public function edit($id)
    {
        $result = $this->topupTelcoProviderService->detail($id);
        return view('gate.topup-telco-provider.edit', ['detail' => $result->data]);
    }

    public function editAction($id)
    {
        $params = $this->request->only(['telco', 'telcoServiceType', 'providerCode']);
        $params = ArrayHelper::removeArrayNull($params);
        $validator = $this->validator->make($params, 'edit_topup_telco_provider_fields');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->messages()), 400);
        }
        $result = $this->topupTelcoProviderService->edit($id, $params);
        if (isset($result->success) && $result->success === true) {

            $data['success'] = true;
            $data['message'] = "Cập nhập provider config thành công !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TOPUP_TELCO_PROVIDER, "Sửa Cấu hình Telco Provider Topup #$id", compact('id', 'params')));
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
