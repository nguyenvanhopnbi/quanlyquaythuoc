<?php

namespace App\Http\Controllers\Gate;

use App\Helpers\ArrayHelper;
use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Services\ValidationService;
use App\Services\Gate\PartnerService;
use App\Transformers\PartnerTransformer;
use Illuminate\Http\Request;
use App\Helpers\CheckIsAmUser;
use App\Connection\PartnerConnection;

class PartnerController extends Controller
{
    protected $partnerService;
    protected $validator;
    protected $request;

    function __construct(ValidationService $validator, PartnerService $partnerService, Request $request)
    {
        $this->validator = $validator;
        $this->partnerService = $partnerService;
        $this->request = $request;
    }

    public function index()
    {
        return view('gate.partner.list');
    }

    public function exportPartner(Request $request){
        $params = [];
        if($request->all()){
            $params['query'] = $request->all();
        }

        $params['pagination']['perpage'] = 100;
        $data = PartnerService::getList($params);


        $meta = $data->meta;
        $pages = $meta->pages;
        $page = $meta->page;
        $data = $data->data;

        unset($data);

        set_time_limit(0);
        ini_set('memory_limit', '512M');
        $fileName = date('YmdHis', time());
        header('Content-Type: application/vnd.ms-execl');
        header('Content-Disposition: attachment;filename="' . $fileName . '.csv"');
        $begin = microtime(true);
        $handle = fopen("php://output", 'a');
        fputs($handle, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

        if($pages >= 1){
            for ($i=$page; $i <= $pages ; $i++) {
                $params['pagination']['page'] = $i;

                $data = PartnerService::getList($params)->data;

                foreach($data as $key=>$data){

                    if($i == 1 && $key == 0){
                        foreach($data as $tit=>$content){

                            $title[] = $tit;
                        }
                        fputcsv($handle, $title);
                    }
                    $data = (array)$data;
                    $data['created_at'] = date('Y-m-d H:i:s', $data['created_at']);
                    $data['updated_at'] = date('Y-m-d H:i:s', $data['updated_at']);
                    fputcsv($handle, $data);
                }

            }
        }

        fclose($handle);
        ob_flush();
        flush();
        $end = microtime(true);


    }

    /*
     *
     */
    public function ajaxGetList(Request $request)
    {
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $partnerCode = CheckIsAmUser::checkIsAmUser();
        $data = $this->partnerService->getList($params, $partnerCode);
        $data->data = PartnerTransformer::transformCollection($data->data);
        // dump($data);
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

        return view('gate.partner.add');
    }


    public function addAction()
    {
        $params = $this->request->only(['partnerCode', 'email', 'phoneNumber', 'password', 'name', 'status', 'accountType', 'address', 'emailReconciliation']);
        $params = ArrayHelper::removeArrayNull($params);
        $validator = $this->validator->make($params, 'add_partner_fields');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->messages()), 400);
        }
        // dd($params);
        $result = $this->partnerService->add($params);
        if (isset($result->success) && $result->success === true) {

            $data['success'] = true;
            $data['message'] = "Thêm mới partner thành công !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER, 'Thêm partner', compact('params')));
            return response()->json($data, 200);
        } else if (isset($result->errorCode) && $result->errorCode != 0) {
            $data = Message::getArray($result->errorCode, $result->message, []);
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
            Message::alertFlash('Bạn đã xóa partner thành công', 'success');
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER, "Xóa partner #$id", compact('id')));
        } else {
            Message::alertFlash('Bạn đã xóa partner không thành công', 'danger');
        }

        return redirect()->route('gate.partner.list');
    }

    public function edit($id)
    {
        $result = $this->partnerService->detail($id);
        // dump($result);
        return view('gate.partner.edit', ['detail' => $result->data]);
    }

    public function editAction($id)
    {
        $params = $this->request->only(['partnerCode', 'email', 'phoneNumber', 'password', 'name', 'status', 'accountType', 'address', 'emailReconciliation']);
        $params = ArrayHelper::removeArrayNull($params);
        $validator = $this->validator->make($params, 'edit_partner_fields');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->messages()), 400);
        }
        $result = $this->partnerService->edit($id, $params);
        if (isset($result->success) && $result->success === true) {

            $data['success'] = true;
            $data['message'] = "Cập nhập partner thành công !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER, "Sửa partner #$id", compact('id', 'params')));
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
        return view('gate.partner.detail-popup', ['detail' => PartnerTransformer::transform($data->data)]);
    }
}
