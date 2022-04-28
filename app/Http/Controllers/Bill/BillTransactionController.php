<?php

namespace App\Http\Controllers\Bill;

use App\Helpers\ArrayHelper;
use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Services\ValidationService;
use App\Services\Bill\BillTransactionService;
use App\Transformers\BillTransactionTransformer;
use App\Transformers\BillServicesTransformer;
use App\Services\Bill\BillServicesService;
use Illuminate\Http\Request;
use App\Helpers\CheckIsAmUser;

class BillTransactionController extends Controller
{

    protected $request;
    protected $billTransactionService;
    protected $validator;

    function __construct(Request $request, ValidationService $validator, BillTransactionService $billTransactionService)
    {
        $this->request = $request;
        $this->validator = $validator;
        $this->billTransactionService = $billTransactionService;
    }

    public function index()
    {
        return view('bill.transaction.list_bill_transaction');
    }

    public function exportcsv(Request $request){

        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $fileName = date('YmdHis', time());
        header('Content-Type: application/vnd.ms-execl');
        header('Content-Disposition: attachment;filename="' . $fileName . '.csv"');
        $handle = fopen("php://output", 'a');
        fputs($handle, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

        $params2 = [];
        $params2['pagination']['perpage'] = 1000000;
        $BillServicesService = new BillServicesService();

        $params = [];
        $params['pagination']['limit'] = 10000;
        if(isset($request->transaction_id)){
            $params['query']['transaction_id'] = $request->transaction_id;
        }

        if(isset($request->partner_ref_id)){
            $params['query']['partner_ref_id'] = $request->partner_ref_id;
        }

        if(isset($request->startTime)){
            $params['query']['startTime'] = $request->startTime;
        }

        if(isset($request->endTime)){
            $params['query']['endTime'] = $request->endTime;
        }

        if(isset($request->partner_code)){
            $params['query']['partner_code'] = $request->partner_code;
        }
        if(isset($request->status)){
            $params['query']['status'] = $request->status;
        }

        $partnerCode = null;
        $partnerCode = CheckIsAmUser::checkIsAmUser();
        $data = $this->billTransactionService->getList($params, $partnerCode);

        if (isset($data->data) && $data->data) {
            $data->data = BillTransactionTransformer::transformCollection($data->data);
        }
        // dd($data);

        if(isset($data->meta->page)){
            $page = $data->meta->page;
        }

        if(isset($data->meta->pages)){
            $pages = $data->meta->pages;
        }

        $tit = [
            'Mã giao dịch',
            'Mã đối tác',
            'Mã Bill',
            'Service name',
            'Mệnh giá Bill',
            'Trạng Thái',
            'Trạng thái hoá đơn',
            'Thời gian yêu cầu',
            'Mã giao dịch đối tác',
            'Mã dịch vụ',
            'Mã nhà cung cấp'
        ];
        fputcsv($handle, $tit);
        // $firstTime = 1;
        $datacsv = [];
        for ($i=1; $i <= $pages ; $i++) {
            $params['pagination']['page'] = $i;

            $partnerCode = null;
            $partnerCode = CheckIsAmUser::checkIsAmUser();
            $data = $this->billTransactionService->getList($params, $partnerCode);

            if (isset($data->data) && $data->data) {
                $data->data = BillTransactionTransformer::transformCollection($data->data);
            }


            // $data2 = $BillServicesService->getList($params2);
            // if (isset($data2->data) && $data2->data) {
            //     $data2->data = BillServicesTransformer::transformCollection($data2->data);
            // }
            // $service_name_array = [];
            // foreach($data2->data as $key2=>$data2){

            //     foreach($data->data as $key => $data3){

            //         if($data3->service_code === $data2->serviceCode){
            //             $data3->service_name = $data2->serviceName;
            //         }
            //     }
            // }

            foreach($data->data as $key => $data){
                $data = (array)$data;
                // dd($data['service_name ']);
                $datacsv[] = $data['transaction_id'];
                $datacsv[] = $data['partner_code'];
                $datacsv[] = $data['bill_code'];

                if(isset($data['service_name '])){
                    $datacsv[] = $data['service_name '];
                }else{
                    $datacsv[] = "";
                }
                $datacsv[] = $data['bill_amount'];
                $datacsv[] = $data['status'];
                $datacsv[] = $data['bill_status'];
                $datacsv[] = $data['request_time'];
                $datacsv[] = $data['partner_ref_id'];
                $datacsv[] = $data['service_code'];
                $datacsv[] = $data['provider_code'];


                fputcsv($handle, $datacsv);

                $datacsv = [];
            }

        }
        unset($data);

        fclose($handle);
        ob_flush();
        flush();
        $end = microtime(true);
    }

    /*
     *
     */

    public function ajaxGetList()
    {
        $params = $this->request->all();
        $partnerCode = null;
        $partnerCode = CheckIsAmUser::checkIsAmUser();
        $data = $this->billTransactionService->getList($params, $partnerCode);

        if (isset($data->data) && $data->data) {
            $data->data = BillTransactionTransformer::transformCollection($data->data);
        }
        // dd($data);
        $params2 = [];
        $params2['pagination']['perpage'] = 1000000;
        $BillServicesService = new BillServicesService();
        $data2 = $BillServicesService->getList($params2);
        if (isset($data2->data) && $data2->data) {
            $data2->data = BillServicesTransformer::transformCollection($data2->data);
        }
        $service_name_array = [];
        foreach($data2->data as $key2=>$data2){

            foreach($data->data as $key => $data3){

                if($data3->service_code === $data2->serviceCode){
                    $data3->service_name = $data2->serviceName;

                }
            }
        }
        return response()->json($data);
    }

    public function detail($transaction_id)
    {
        $result = $this->billTransactionService->detail($transaction_id);
        $status = [
            'success'=> 'badge-success',
            'error'=> 'badge-danger',
            'pending'=> 'badge-warning',
            'processing'=> 'badge-info',
            'refund'=> 'badge-primary',
            'cancel'=> 'badge-dark',
            'new'=> 'badge-secondary',
        ];
        $statusBill = [
            'success'=> 'badge-success',
            'error'=> 'badge-danger',
            'pending'=> 'badge-warning',
            'processing'=> 'badge-info',
            'refund'=> 'badge-primary',
            'cancel'=> 'badge-dark',
            'new'=> 'badge-secondary',
        ];
        if (isset($result->data) && $result->data) {
            $result->data->status_badge = $status[$result->data->status];
            $result->data->status_bill_badge = $statusBill[$result->data->bill_status];
            $result->data->bill_amount = number_format($result->data->bill_amount, 0, ',', '.');
            $result->data->amount = number_format($result->data->amount, 0, ',', '.');
            $result->data->request_time = date("d-m-Y H:i:s", $result->data->request_time);
            $result->data->response_time = date("d-m-Y H:i:s", $result->data->response_time);
        } else {
            abort(404);
        }

        return view('bill.transaction.detail-popup', ['detail' => $result->data]);
    }

}
