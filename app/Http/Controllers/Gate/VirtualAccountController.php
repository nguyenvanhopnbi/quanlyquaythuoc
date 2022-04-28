<?php

namespace App\Http\Controllers\Gate;

use App\Helpers\ArrayHelper;
use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Services\ValidationService;
use App\Services\Gate\VirtualAccountService;
use App\Transformers\VirtualAccountTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Helpers\CheckIsAmUser;

class VirtualAccountController extends Controller
{
    protected $virtualAccountService;
    protected $validator;
    protected $request;

    function __construct(ValidationService $validator, VirtualAccountService $virtualAccountService, Request $request)
    {
        $this->validator = $validator;
        $this->virtualAccountService = $virtualAccountService;
        $this->request = $request;
    }

    public function index()
    {
        return view('gate.virtual-account.list');
    }

    /*
     *
     */
    public function ajaxGetList(Request $request)
    {
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $partnerCode = CheckIsAmUser::checkIsAmUser();
        $data = $this->virtualAccountService->getList($params, $partnerCode);
        $data->data = VirtualAccountTransformer::transformCollection($data->data);
        return response()->json($data);
    }

    public function detail($id)
    {
        $data = $this->virtualAccountService->detail($id);
        return view('gate.virtual-account.detail-popup', ['detail' => VirtualAccountTransformer::transform($data->data)]);

    }

    public function exportCSV(Request $request){

        $params = [];
        $params['pagination']['perpage'] = 30000;

        if(isset($request->partnerCode) and !empty($request->partnerCode)){
            $params['query']['partnerCode'] = $request->partnerCode;
        }else{
            unset($params['query']['partnerCode']);
        }

        if(isset($request->endTime) and !empty($request->endTime)){
            $params['query']['endTime'] = $request->endTime;
        }else{
            unset($params['query']['endTime']);
        }

        if(isset($request->startTime) and !empty($request->startTime)){
            $params['query']['startTime'] = $request->startTime;
        }else{
            unset($params['query']['startTime']);
        }

        if(isset($request->paid_amount) and !empty($request->paid_amount)){
            $params['query']['paid_amount'] = $request->paid_amount;
        }else{
            unset($params['query']['paid_amount']);
        }

        if(isset($request->accountName) and !empty($request->accountName)){
            $params['query']['accountName'] = $request->accountName;
        }else{
            unset($params['query']['accountName']);
        }

        if(isset($request->accountNo) and !empty($request->accountNo)){
            $params['query']['accountNo'] = $request->accountNo;
        }else{
            unset($params['query']['accountNo']);
        }


        if(isset($request->billId) and !empty($request->billId)){
            $params['query']['billId'] = $billId;
        }else{
            unset($params['query']['billId']);
        }

        if(isset($request->providerCode) and !empty($request->providerCode)){
            $params['query']['providerCode'] = $request->providerCode;
        }else{
            unset($params['query']['providerCode']);
        }

        if(isset($request->account_id) and !empty($request->account_id)){
            $params['query']['account_id'] = $request->account_id;
        }else{
            unset($params['query']['account_id']);
        }


        $data = VirtualAccountService::getList($params);
        $data->data = VirtualAccountTransformer::transformCollection($data->data);

        // dump($params);
        // dd($data);

        if(isset($data->meta->page)){
            $page = $data->meta->page;
        }
        if(isset($data->meta->pages)){
            $pages = $data->meta->pages;
        }



        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $fileName = date('YmdHis', time());
        header('Content-Type: application/vnd.ms-execl');
        header('Content-Disposition: attachment;filename="' . $fileName . '.csv"');
        // $path = storage_path('app/') . $fileName .'.csv';

        $begin = microtime(true);

        $handle = fopen('php://output', 'a');
        fputs($handle, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

        if($pages >= 1){
            for ($i=$page; $i <= $pages ; $i++) {
                $params['pagination']['page'] = $i;

                $data = VirtualAccountService::getList($params);
                $data->data = VirtualAccountTransformer::transformCollection($data->data);
                // dd($data);
                $title = [];

                foreach($data->data as $key=>$data){
                    if($i == 1 && $key == 0){
                        foreach($data as $tit=>$content){
                            if($tit != 'expiry_time'){
                                $title[] = $tit;
                            }
                        }
                        fputcsv($handle, $title);
                    }
                    $data = (array)$data;
                    $data['expiry_time'] = date('d-m-Y H:i:s', $data['expiry_time']);
                    if(isset($data['expiry_time'])){
                        unset($data['expiry_time']);
                    }

                    fputcsv($handle, $data);
                }

            }
        }


        fclose($handle);
        ob_flush();
        flush();


        $end = microtime(true);
        // return \Response::download($path)->deleteFileAfterSend(true);
    }
}
