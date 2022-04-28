<?php

namespace App\Http\Controllers\Bill;

use App\Helpers\ArrayHelper;
use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Services\ValidationService;
use App\Services\Bill\BillServicesService;
use App\Services\Bill\BillCategoryService;
use App\Services\UploadImageService;
use App\Transformers\BillServicesTransformer;
use Illuminate\Http\Request;
use App\Helpers\UploadImage;


class BillServicesController extends Controller
{

    protected $request;
    protected $billServicesService;
    protected $billCategoryService;
    protected $validator;

    function __construct(Request $request, ValidationService $validator, BillServicesService $billServicesService, BillCategoryService $billCategoryService)
    {
        $this->request = $request;
        $this->validator = $validator;
        $this->billServicesService = $billServicesService;
        $this->billCategoryService = $billCategoryService;
    }

    public function index()
    {
        $data['listAllCategory'] = [];

        $params['pagination']['limit'] = 20;
        $listAllCategory = $this->billCategoryService->getList($params);
        if (isset($listAllCategory->data) && $listAllCategory->data) {
            $data['listAllCategory'] = $listAllCategory->data;
        }

        return view('bill.services.list_bill_services')->with('data', $data);
    }

    /*
     *
     */

    public function ajaxGetList()
    {
        $params = $this->request->all();

        $data = $this->billServicesService->getList($params);
        if (isset($data->data) && $data->data) {
            $data->data = BillServicesTransformer::transformCollection($data->data);
        }

        return response()->json($data);
    }

       /*
     *
     */

    public function ajaxGetListSource()
    {
        $params = $this->request->all();

        $data = $this->billServicesService->getListSource($params);
        // dd($data);
        return response()->json($data);
    }


    public function add()
    {
        $data['listAllCategory'] = [];

        $params['pagination']['limit'] = 20;
        $listAllCategory = $this->billCategoryService->getList($params);
        if (isset($listAllCategory->data) && $listAllCategory->data) {
            $data['listAllCategory'] = $listAllCategory->data;
        }

        return view('bill.services.add_bill_services')->with('data', $data);
    }



    public function addAction()
    {
        $param = $this->request->only('serviceCode', 'serviceName', 'categoryCode', 'description', 'icon', 'public');
        $params = ArrayHelper::removeArrayNull($param);
        $validate = $this->validator->make($params, 'add_bill_service_fields');

        if ($validate->fails()) {
            return response()->json(Message::get(1, $lang = '', $validate->errors()->all()), 400);
        }

        /* UPLOAD IMAGE */
        $uploadImageInfo = UploadImage::upload($params['icon']);
        if (isset($uploadImageInfo['status']) && $uploadImageInfo['status']) {
            $params['icon'] = $uploadImageInfo['preview_image'];
        } else {
            $result['status'] = false;
            $result['msg'] = (isset($uploadImageInfo['msg'])) ? $uploadImageInfo['msg'] : 'Lỗi khi gọi API upload image!';
            return response()->json($result);
        }

        $result = $this->billServicesService->add($params);

        if (isset($result->success) && $result->success === true) {
            $data['success'] = true;
            $data['message'] = "Thêm mới Bill Service thành công !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::BILL_SERVICE, "Thêm Danh sách Dịch vụ Bill", compact('params')));
            return response()->json($data, 200);
        } else if (isset($result->errorCode) && $result->errorCode != 0) {
            $data = Message::getArray($result->errorCode, $result->message, []);
            return response()->json($data, 400);
        } else {
            $data = Message::get(36, $lang = '', $params);
            return response()->json($data, 400);
        }
    }

    public function delete($id)
    {
        $delete = $this->billServicesService->delete($id);
        if ($delete) {
            Message::alertFlash('Bạn đã xóa Bill Service thành công', 'success');
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::BILL_SERVICE, "Xóa Danh sách Dịch vụ Bill #$id", compact('id')));
        } else {
            Message::alertFlash('Bạn đã xóa Bill Service không thành công', 'danger');
        }

        return redirect()->route('bill.service.list');
    }

    public function edit($id)
    {
        $result = $this->billServicesService->detail($id);
        if (!isset($result->errorCode) || $result->errorCode !== 0) {
            abort(404);
        }

        $data['listAllCategory'] = [];
        $data['billServiceInfo'] = [];

        if (isset($result->data) && $result->data) {
            $data['billServiceInfo'] = $result->data;
        }

        $params['pagination']['limit'] = 1000;
        $listAllCategory = $this->billCategoryService->getList($params);
        if (isset($listAllCategory->data) && $listAllCategory->data) {
            $data['listAllCategory'] = $listAllCategory->data;
        }

        return view('bill.services.edit_bill_services', ['data' => $data]);
    }

    public function editAction($id)
    {
        if (!isset($id) || !$id || $id <= 0) {
            $data['success'] = false;
            $data['message'] = "Dữ liệu đầu vào không hợp lệ!";
            return response()->json($data);
        }

        $param = $this->request->only('serviceCode', 'serviceName', 'categoryCode', 'description', 'icon', 'url_icon', 'public');
        $params = ArrayHelper::removeArrayNull($param);
        $validator = $this->validator->make($params, 'edit_bill_service_fields');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->all()), 400);
        }

        if (!isset($params['icon']) && !isset($params['url_icon'])) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->all()), 400);
        }
        
        if(!isset($params['icon']) && $params['url_icon']){
            $params['icon'] = '';
        }

        if (isset($params['icon']) && $params['icon']) {
            /* UPLOAD IMAGE */
            $uploadImageInfo = UploadImage::upload($params['icon']);
            if (isset($uploadImageInfo['status']) && $uploadImageInfo['status']) {
                $params['icon'] = $uploadImageInfo['preview_image'];
            } else {
                $result['status'] = false;
                $result['msg'] = (isset($uploadImageInfo['msg'])) ? $uploadImageInfo['msg'] : 'Lỗi khi gọi API upload image!';
                return response()->json($result);
            }
        } else {
            $params['icon'] = $params['url_icon'];
        }
        unset($params['url_icon']);

        $result = $this->billServicesService->edit($id, $params);

        if (isset($result->success) && $result->success === true) {

            $data['success'] = true;
            $data['message'] = "Cập nhập Bill Service thành công !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::BILL_SERVICE, "Sửa Danh sách Dịch vụ Bill #$id", compact('id', 'params')));
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
