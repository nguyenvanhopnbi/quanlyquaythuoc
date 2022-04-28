<?php

namespace App\Http\Controllers\Bill;

use App\Helpers\ArrayHelper;
use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Services\ValidationService;
use App\Services\Bill\BillProviderServiceMatchService;
use App\Transformers\BillProviderServiceMatchTransformer;
use App\Services\Bill\BillProvidersService;
use App\Transformers\BillProvidersTransformer;
use App\Services\Bill\BillServicesService;
use App\Transformers\BillServicesTransformer;
use Illuminate\Http\Request;
use App\Connection\PartnerConnection;
use App\Connection\BillProviderConnection;

class BillProviderServiceMatchController extends Controller
{
    protected $request;
    protected $billProviderServiceMatchService;
    protected $billProvidersService;
    protected $billServicesService;
    protected $validator;

    public $partnerCodelist = [];
    public $providerList = [];

    public function __construct(Request $request, ValidationService $validator, BillProviderServiceMatchService $billProviderServiceMatchService, BillProvidersService $billProvidersService, BillServicesService $billServicesService)
    {
        $this->request = $request;
        $this->validator = $validator;
        $this->billProviderServiceMatchService = $billProviderServiceMatchService;
        $this->billProvidersService = $billProvidersService;
        $this->billServicesService = $billServicesService;
        // dd($this->getBillProvider());
    }

    public function index()
    {
        return view('bill.providerServiceMatch.list_bill_provider_service_match', [
            'partnerCodelist' => $this->getPartnerCode()
        ]);
    }

    public function getBillProvider(){
        $params = [];
        $params['pagination']['perpage'] = 100000;
        $data = $this->billProvidersService->getList($params)->data;
        if(isset($data)){
            return $data;
        }
        return null;
    }

    public function getPartnerCode(){
        $params = [];
        $params['pagination']['limit'] = 1000;
        $data = PartnerConnection::getList($params);
        if(isset($data->data)){
            return $data->data;
        }
        return [];
    }

    /*
     *
     */

    public function ajaxGetList()
    {
        $params = $this->request->all();
        $data = $this->billProviderServiceMatchService->getList($params);
        // dd($data);
        if (isset($data->data) && $data->data) {
            $data->data = BillProviderServiceMatchTransformer::transformCollection($data->data);
        }

        return response()->json($data);
    }

    public function add()
    {
        $data['listBillProvider'] = [];
        $data['listBillService'] = [];
        $params['pagination']['limit'] = 1000;
        
        //list provider
        $listBillProvider = $this->billProvidersService->getList($params);
        if (isset($listBillProvider->data) && $listBillProvider->data) {
            $data['listBillProvider'] = BillProvidersTransformer::transformCollection($listBillProvider->data);
        }
        
        //list service
        $listBillService = $this->billServicesService->getList($params);
        if (isset($listBillService->data) && $listBillService->data) {
            $data['listBillService'] = BillServicesTransformer::transformCollection($listBillService->data);
        }
        
        return view('bill.providerServiceMatch.add_bill_provider_service_match', [
            'data' => $data,
            'partnerCodelist' => $this->getPartnerCode(),
            'providerCodeList' => $this->getBillProvider(),
        ]);
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

    public function addAction()
    {

        $getParams = [
            'serviceCode',
            'providerServiceCode',
            'providerPublisherCode'
        ];
        $params['pagination']['limit'] = 1000;
        $listBillProvider = $this->billProvidersService->getList($params);
        foreach ($listBillProvider->data as $provider) {
            $getParams[] = $provider->providerCode;
            $getParams[] = 'public_'.$provider->providerCode;
        }
        $param = $this->request->only($getParams);
        $params = ArrayHelper::removeArrayNull($param);



        // // // kiem tra partner code exist
        // if(!$this->checkPartnerCodeAPI($params['partnerCode'])){
        //     $data['success'] = true;
        //     $data['message'] = "Partner Code không tồn tại !!!";
        //     return response()->json($data, 200);
        // }


        $validator = $this->validator->make($params, 'add_bill_provider_service_match_fields');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->all()), 400);
        }

        $result = $this->billProviderServiceMatchService->add($params, $listBillProvider->data);

        if (isset($result['success']) && $result['success'] === true) {
            $data['success'] = true;
            $data['message'] = implode(" ",  $result['provide_success']);
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::BILL_PROVIDER_SERVICE_MATCH, "Thêm Cấu hình Dịch vụ Bill", compact('params')));
            return response()->json($data, 200);
        } elseif (isset($result['success']) && $result['success'] === false) {
            $data = Message::getArray(140, implode(" ",  $result['provider_error']), []);
            return response()->json($data, 400);
        } else {
            $data = Message::get(34, $lang = '', $params);
            return response()->json($data, 400);
        }
    }

    public function delete($id)
    {
        if (!isset($id) || !$id || $id <= 0) {
            Message::alertFlash('Dữ liệu đầu vào không hợp lệ!', 'danger');
            return redirect()->route('bill.providerServiceMatch.list');
        }
        
        $params['id'] = $id;
        $delete = $this->billProviderServiceMatchService->delete($params);
        if ($delete) {
            Message::alertFlash('Bạn đã xóa Bill Provider Service Match thành công', 'success');
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::BILL_PROVIDER_SERVICE_MATCH, "Xóa Cấu hình Dịch vụ Bill #$id", compact('id')));
        } else {
            Message::alertFlash('Bạn đã xóa Bill Provider Service Match không thành công', 'danger');
        }

        return redirect()->route('bill.providerServiceMatch.list');
    }

    public function edit($id)
    {
        $data['listBillProvider'] = [];
        $data['listBillService'] = [];
        $data['billProviderServiceMatch'] = [];
        $params['pagination']['limit'] = 1000;
        
        //list provider
        $listBillProvider = $this->billProvidersService->getList($params);
        if (isset($listBillProvider->data) && $listBillProvider->data) {
            $data['listBillProvider'] = BillProvidersTransformer::transformCollection($listBillProvider->data);
        }
        
        //list service
        $listBillService = $this->billServicesService->getList($params);
        if (isset($listBillService->data) && $listBillService->data) {
            $data['listBillService'] = BillServicesTransformer::transformCollection($listBillService->data);
        }
        
        $result = $this->billProviderServiceMatchService->detail($id);
        
        if (!isset($result->data) || !$result->data) {
            abort(404);
        } else {
            $data['billProviderServiceMatch'] = $result->data;
        }
        
        return view('bill.providerServiceMatch.edit_bill_provider_service_match', [
            'data' => $data,
            'partnerCodelist' => $this->getPartnerCode(),
        ]);
    }

    public function editAction($id)
    {
        $param = $this->request->only('serviceCode', 'providerCode', 'providerServiceCode', 'providerPublisherCode', 'public');
        $params = ArrayHelper::removeArrayNull($param);

        // dd($params);
        $validator = $this->validator->make($params, 'edit_bill_provider_service_match_fields');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->all()), 400);
        }

        // if(!$this->checkPartnerCodeAPI($params['partnerCode'])){
        //     $data['success'] = true;
        //     $data['message'] = "Partner Code không tồn tại !!!";
        //     return response()->json($data, 200);
        // }

        $result = $this->billProviderServiceMatchService->edit($id, $params);

        if (isset($result->success) && $result->success === true) {
            $data['success'] = true;
            $data['message'] = "Cập nhập Bill Provider Service Match thành công !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::BILL_PROVIDER_SERVICE_MATCH, "Sửa Cấu hình Dịch vụ Bill #$id", compact('id', 'params')));
            return response()->json($data, 200);
        } elseif (isset($result->errorCode) && $result->errorCode != 0) {
            $data = Message::getArray($result->errorCode, $result->message, []);
            return response()->json($data, 400);
        } else {
            $data = Message::get(35, $lang = '', $params);
            return response()->json($data, 400);
        }

    }
}
