<?php

namespace App\Http\Controllers\Gate;

use App\Helpers\ArrayHelper;
use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Services\ValidationService;
use App\Services\Gate\BankService;
use App\Transformers\ApplicationProvidersTransformer;
use Illuminate\Http\Request;

class BankController extends Controller
{
    protected $applicationServiceConfigService;
    protected $validator;
    protected $request;

    function __construct(ValidationService $validator, BankService $bankService, Request $request)
    {
        $this->validator = $validator;
        $this->bankService = $bankService;
        $this->request = $request;
    }
    public function index()
    {
        return view('gate.bank.list_bank');
    }

    /*
     *
     */
    public function ajaxGetList(Request $request)
    {
        $params = $request->all();
        $data = $this->bankService->getList($params);
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
        $data = $this->bankService->getListSource($params);
        // dd($data);
        return response()->json($data);
    }

    public function add()
    {

        return view('gate.bank.add_bank');
    }

    public function addAction()
    {
        $params = $this->request->only('bank_code', 'bank_name', 'type', 'public', 'vendor_code', 'enable_token', 'maintenance');

        if( isset($params['enable_token']) and $params['enable_token'] == 'on'){
            $params['enable_token'] = 1;
        }else{
            $params['enable_token'] = 0;
        }

        if( isset($params['maintenance']) and $params['maintenance'] == 'on'){
            $params['maintenance'] = 'yes';
        }else{
            $params['enable_token'] = 'no';
        }


        $params = ArrayHelper::removeArrayNull($params);
        $validator = $this->validator->make($params, 'add_bank_fields');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->messages()), 400);
        }
        $result = $this->bankService->add($params);

        if (isset($result->success) && $result->success === true) {

            $data['success'] = true;
            $data['message'] = "Th??m m???i bank th??nh c??ng !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::GATE_BANK, "Th??m Bank CTT", compact('params')));
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
        $delete = $this->bankService->delete($id);
        if ($delete) {
            Message::alertFlash('B???n ???? x??a bank th??nh c??ng', 'success');
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::GATE_BANK, "X??a Bank CTT #$id']}", compact('id')));
        } else {
            Message::alertFlash('B???n ???? x??a bank kh??ng th??nh c??ng', 'danger');
        }

        return redirect()->route('gate.bank.list');
    }

    public function edit($id)
    {
        $result = $this->bankService->detail($id);
        $result->id = $id;
        return view('gate.bank.edit_bank', ['detail' => $result]);
    }

    public function editAction($id)
    {
        $params = $this->request->only('bank_code', 'bank_name', 'type', 'public', 'vendor_code', 'enable_token', 'maintenance');

        if( isset($params['enable_token']) and $params['enable_token'] == 'on'){
            $params['enable_token'] = 1;
        }else{
            $params['enable_token'] = 0;
        }

        if( isset($params['maintenance']) and $params['maintenance'] == 'on'){
            $params['maintenance'] = 'yes';
        }else{
            $params['maintenance'] = 'no';
        }


        $params = ArrayHelper::removeArrayNull($params);
        $validator = $this->validator->make($params, 'edit_bank_fields');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->messages()), 400);
        }
        $result = $this->bankService->edit($id, $params);
        if (isset($result->success) && $result->success === true) {

            $data['success'] = true;
            $data['message'] = "C???p nh???p bank th??nh c??ng !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::GATE_BANK, "S???a Bank CTT #$id']}", compact('id', 'params')));
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
