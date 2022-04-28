<?php

namespace App\Http\Controllers\Gate;

use App\Helpers\ArrayHelper;
use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Services\ValidationService;
use App\Services\Gate\TopupDenominationService;
use App\Transformers\TopupDenominationTransformer;
use Illuminate\Http\Request;

class TopupDenominationConfigController extends Controller
{
    protected $topupDenominationService;
    protected $validator;
    protected $request;

    function __construct(ValidationService $validator, TopupDenominationService $topupDenominationService, Request $request)
    {
        $this->validator = $validator;
        $this->topupDenominationService = $topupDenominationService;
        $this->request = $request;
    }

    public function index()
    {
        return view('gate.topup-denomination.list');
    }

    /*
     *
     */
    public function ajaxGetList(Request $request)
    {
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        // $params['query']['telco'] = 'viettel';
        $data = $this->topupDenominationService->getList($params);
        // dd($data);
        $data->data = TopupDenominationTransformer::transformCollection($data->data);
        return response()->json($data);
    }


    public function add()
    {

        return view('gate.topup-denomination.add');
    }

    public function addAction()
    {
        $params = $this->request->only(['telco', 'value', 'public']);
        $params = ArrayHelper::removeArrayNull($params);
        $validator = $this->validator->make($params, 'add_topup_denomination_config');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->messages()), 400);
        }
        $result = $this->topupDenominationService->add($params);
        if (isset($result->success) && $result->success === true) {

            $data['success'] = true;
            $data['message'] = "Thêm mới cấu hình mệnh giá topup thành công !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TOPUP_DENOMINATION, "Thêm Cấu hình mệnh giá Topup", compact('params')));
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
        $delete = $this->topupDenominationService->delete($id);
        if($delete) {
            Message::alertFlash('Bạn đã xóa cấu hình mệnh giá topup thành công', 'success');
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TOPUP_DENOMINATION, "Xóa Cấu hình mệnh giá Topup #$id", compact('id')));
        } else {
            Message::alertFlash('Bạn đã xóa cấu hình mệnh giá topup không thành công', 'danger');
        }

        return redirect()->route('topup.denomination.list');
    }

    public function edit($id)
    {
        $result = $this->topupDenominationService->detail($id);
        return view('gate.topup-denomination.edit', ['detail' => $result->data]);
    }

    public function editAction($id)
    {
        $params = $this->request->only(['telco', 'value', 'public']);
        $params = ArrayHelper::removeArrayNull($params);
        $validator = $this->validator->make($params, 'edit_topup_denomination_config');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->messages()), 400);
        }
        $result = $this->topupDenominationService->edit($id, $params);
        if (isset($result->success) && ($result->success > 0 || $result->success === true)) {

            $data['success'] = true;
            $data['message'] = "Cập nhập cấu hình mệnh giá topup thành công !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TOPUP_DENOMINATION, "Sửa Cấu hình mệnh giá Topup #$id", compact('id', 'params')));
            return response()->json($data, 200);
        } else if (isset($result->errorCode) && $result->errorCode != 0) {
            $data = Message::getArray($result->errorCode, $result->message, []);
            return response()->json($data, 400);
        } else {
            $data = Message::get(13, $lang = '', $params);
            return response()->json($data, 400);
        }
    }

    public function detail($id)
    {
        $result = $this->topupDenominationService->detail($id);
        return view('gate.topup-denomination.detail-popup', ['detail' => $result->data]);
    }
}
