<?php

namespace App\Http\Controllers\Bill;

use App\Helpers\ArrayHelper;
use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Services\ValidationService;
use App\Services\Bill\BillServicesCategoryService;
use App\Transformers\BillServicesCategoryTransformer;
use Illuminate\Http\Request;
use App\Connection\PartnerConnection;
use App\Connection\BillProviderConnection;

class BillServicesCategoryController extends Controller
{

    protected $request;
    protected $billServicesCategoryService;
    protected $validator;

    function __construct(Request $request, ValidationService $validator, BillServicesCategoryService $billServicesCategoryService)
    {
        $this->request = $request;
        $this->validator = $validator;
        $this->billServicesCategoryService = $billServicesCategoryService;
    }

    public function dashboard(){
        return view('bill.serviceCategory.list_bill_services_dashboard');
    }

    public function index()
    {
        return view('bill.serviceCategory.list_bill_services_category', [
            'partnerCodeList' => $this->getPartnerCode()
        ]);
    }

    /*
     *
     */

    public function ajaxGetList()
    {
        $params = $this->request->all();
        $data = $this->billServicesCategoryService->getList($params);

        if (isset($data->data) && $data->data) {
            //$data->data = BillServicesCategoryTransformer::transformCollection($data->data);
        }

        return response()->json($data);
    }

     /*
     *
     */

    public function ajaxGetListSource()
    {
        $params = $this->request->all();

        $data = $this->billServicesCategoryService->getListSource($params);

        return response()->json($data);
    }

    public function getPartnerCode(){
        $params = [];
        $data = PartnerConnection::getList($params);
        if(isset($data->meta->total)){
            $params['pagination']['limit'] = $data->meta->total;
            $data = PartnerConnection::getList($params);
            return $data->data;
        }
        return [];
    }

    public function getProviderCode(){
        $params = [];
        $params['pagination']['limit'] = 10000;
        $data = BillProviderConnection::getList($params);
        if(isset($data->data)){
            return $data->data;
        }
        return [];
    }

    public function checkPartnerCodeAPI($partnerCode){
        $partnerCodeArray = [];

        $params = [];
        $data = PartnerConnection::getList($params);
        if($data->meta->total){
            $params['pagination']['limit'] = $data->meta->total;
            $data = PartnerConnection::getList($params);
            if(isset($data->data)){
                foreach($data->data as $data){
                    $partnerCodeArray[] = $data->partner_code;
                }
                $partnerCodeArray = ArrayHelper::removeArrayNull($partnerCodeArray);
                if(in_array($partnerCode, $partnerCodeArray)){
                    return true;
                }
            }
        }

        return false;
    }


    public function add()
    {
        return view('bill.serviceCategory.add_bill_services_category', [
            'partnerCodeListAll' => $this->getPartnerCode(),
            'providerCodelistAll' => $this->getProviderCode()
        ]);
    }

    public function addAction()
    {
        // $param = $this->request->only('providerCode', 'partnerCode', 'categoryCode', 'categoryName', 'description', 'public');

        $param = $this->request->only('providerCode', 'partnerCode', 'categoryCode', 'categoryName', 'description', 'public');
        $params = ArrayHelper::removeArrayNull($param);
        $validator = $this->validator->make($params, 'add_bill_service_category_fields');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->all()), 400);
        }

        // if(!$this->checkPartnerCodeAPI($params['partnerCode'])){
        //     $data['success'] = true;
        //     $data['message'] = "Partner Code: ". $params['partnerCode']  ." không tồn tại !!!";
        //     return response()->json($data, 200);
        // }
        $params['partnerCode'] = strtotime(date('d-m-y H:i:s'));
        $params['providerCode'] = strtotime(date('d-m-y H:i:s'));


        $result = $this->billServicesCategoryService->add($params);

        if (isset($result->success) && $result->success === true) {

            $data['success'] = true;
            $data['message'] = "Thêm mới Bill Service Category thành công !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::BILL_SERVICE_CATEGORY, "Thêm Danh mục Dịch vụ Bill", compact('params')));
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
        if(!isset($id) || !$id || $id <= 0){
            Message::alertFlash('Dữ liệu đầu vào không hợp lệ!', 'danger');
            return redirect()->route('bill.serviceCategory.list');
        }
        
        $params['id'] = $id;
        $delete = $this->billServicesCategoryService->delete($params);
        if ($delete) {
            Message::alertFlash('Bạn đã xóa Bill Service Category thành công', 'success');
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::BILL_SERVICE_CATEGORY, "Xóa Danh mục Dịch vụ Bill #$id", compact('id')));
        } else {
            Message::alertFlash('Bạn đã xóa Bill Service Category không thành công', 'danger');
        }

        return redirect()->route('bill.serviceCategory.list');
    }

    public function edit($id)
    {
        $result = $this->billServicesCategoryService->detail($id);
        if (!isset($result->data) || !$result->data) {
            abort(404);
        }
        
        return view('bill.serviceCategory.edit_bill_service_category', [
            'serviceCategoryInfo' => $result->data,
            'partnerCodeListAll' => $this->getPartnerCode(),
            'providerCodelistAll' => $this->getProviderCode()
        ]);
    }

    public function editAction($id)
    {
        $param = $this->request->only('partnerCode', 'providerCode', 'categoryCode', 'categoryName', 'description', 'public');

        // $param = $this->request->only('categoryCode', 'categoryName', 'description', 'public');

        $params = ArrayHelper::removeArrayNull($param);
        $validator = $this->validator->make($params, 'edit_bill_service_category_fields');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->all()), 400);
        }

        // if(!$this->checkPartnerCodeAPI($params['partnerCode'])){
        //     $data['success'] = true;
        //     $data['message'] = "Partner Code: ". $params['partnerCode']  ." không tồn tại !!!";
        //     return response()->json($data, 200);
        // }

        $result = $this->billServicesCategoryService->edit($id, $params);

        if (isset($result->success) && $result->success === true) {

            $data['success'] = true;
            $data['message'] = "Cập nhập Bill Service Category thành công !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::BILL_SERVICE_CATEGORY, "Sửa Danh mục Dịch vụ Bill #$id", compact('id', 'params')));
            return response()->json($data, 200);
        } else if (isset($result->errorCode) && $result->errorCode != 0) {
            $data = Message::getArray($result->errorCode, $result->message, []);
            return response()->json($data, 400);
        } else {
            $data = Message::get(35, $lang = '', $params);
            return response()->json($data, 400);
        }
    }

}
