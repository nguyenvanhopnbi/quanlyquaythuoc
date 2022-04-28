<?php

namespace App\Http\Controllers\Gate;

use App\Helpers\ArrayHelper;
use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Services\ValidationService;
use App\Services\Gate\TopupProviderConfigService;
use App\Transformers\ApplicationProvidersTransformer;
use Illuminate\Http\Request;

class TopupProviderConfigController extends Controller
{
    protected $topupProviderConfigService;
    protected $validator;
    protected $request;

    function __construct(ValidationService $validator, TopupProviderConfigService $topupProviderConfigService, Request $request)
    {
        $this->validator = $validator;
        $this->topupProviderConfigService = $topupProviderConfigService;
        $this->request = $request;
    }

    public function index()
    {
        return view('gate.topup-provider-config.list');
    }

    /*
     *
     */
    public function ajaxGetList(Request $request)
    {
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $data = $this->topupProviderConfigService->getList($params);
        $data->data = ApplicationProvidersTransformer::transformCollection($data->data);

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
        // dd($params);
        $data = $this->topupProviderConfigService->getListSource($params);
        // dd($data);
        return response()->json($data);
    }

    public function add()
    {

        return view('gate.topup-provider-config.add');
    }

    public function addAction()
    {
        $params = $this->request->only(['providerCode', 'secretKey', 'rsaPublicKey', 'rsaPrivateKey']);
        $params = ArrayHelper::removeArrayNull($params);
        $validator = $this->validator->make($params, 'add_topup_provider_config');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->messages()), 400);
        }
        $result = $this->topupProviderConfigService->add($params);
        if (isset($result->success) && $result->success === true) {

            $data['success'] = true;
            $data['message'] = "Thêm mới topup provider config thành công !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TOPUP_PROVIDER, "Thêm Cấu hình Provider Topup", compact('params')));
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
        $delete = $this->topupProviderConfigService->delete($id);
        if ($delete) {
            Message::alertFlash('Bạn đã xóa provider config thành công', 'success');
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TOPUP_PROVIDER, "Xóa Cấu hình Provider Topup #$id", compact('id')));
        } else {
            Message::alertFlash('Bạn đã xóa provider config không thành công', 'danger');
        }

        return redirect()->route('topup.provider-config.list');
    }

    public function edit($id)
    {
        $result = $this->topupProviderConfigService->detail($id);
        return view('gate.topup-provider-config.edit', ['detail' => $result->data]);
    }

    public function detail($id)
    {
        $result = $this->topupProviderConfigService->detail($id);
        $result->data->created_at = date("d-m-Y H:i:s", $result->data->updated_at);
        $result->data->updated_at = date("d-m-Y H:i:s", $result->data->updated_at);

        return view('gate.topup-provider-config.detail-popup', ['detail' => $result->data]);
    }

    public function editAction($id)
    {
        $params = $this->request->only(['providerCode', 'secretKey', 'rsaPublicKey', 'rsaPrivateKey']);
        $params = ArrayHelper::removeArrayNull($params);
        $validator = $this->validator->make($params, 'edit_topup_provider_config_fields');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->messages()), 400);
        }
        $result = $this->topupProviderConfigService->edit($id, $params);
        if (isset($result->success) && $result->success === true) {

            $data['success'] = true;
            $data['message'] = "Cập nhập provider config thành công !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TOPUP_PROVIDER, "Sửa Cấu hình Provider Topup #$id", compact('id', 'params')));
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
