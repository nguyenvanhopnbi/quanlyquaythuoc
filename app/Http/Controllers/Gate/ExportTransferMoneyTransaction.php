<?php

namespace App\Http\Controllers\Gate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ArrayHelper;
use App\Services\Gate\TransferMoneyTransactionService;
use App\Transformers\TransferMoneyTransactionTransformer;

class ExportTransferMoneyTransaction extends Controller
{
    public function ExportTransferMoneyTransaction(Request $request){
        $params['filter'] = [];
        if(isset($request->transactionId) && $request->transactionId != ''){
            $params['filter']['transactionId'] = $request->transactionId;
        }
        if(isset($request->partnerRefId) && $request->partnerRefId != ''){
            $params['filter']['partnerRefId'] = $request->partnerRefId;
        }
        if(isset($request->partnerCode) && $request->partnerCode != ''){
            $params['filter']['partnerCode'] = $request->partnerCode;
        }
        if(isset($request->applicationId) && $request->applicationId != ''){
            $params['filter']['applicationId'] = $request->applicationId;
        }
        if(isset($request->customerPhoneNumber) && $request->customerPhoneNumber != ''){
            $params['filter']['customerPhoneNumber'] = $request->customerPhoneNumber;
        }
        if(isset($request->status) && $request->status != ''){
            $params['filter']['status'] = $request->status;

        }
        if(isset($request->transferStatus) && $request->transferStatus != ''){
            $params['filter']['transferStatus'] = $request->transferStatus;
        }
        if(isset($request->amount) && $request->amount != ''){
            $params['filter']['amount'] = $request->amount;
        }
        if(isset($request->accountNo) && $request->accountNo != ''){
            $params['filter']['accountNo'] = $request->accountNo;
        }
        if(isset($request->bankCode) && $request->bankCode != ''){
            $params['filter']['bankCode'] = $request->bankCode;
        }

        if($request->TimeType == 'requestTime'){
            unset($params['filter']['responseStartTime']);
            unset($params['filter']['responseEndTime']);
            if(isset($request->startTime) && $request->startTime != ''){
                $params['filter']['startTime'] = $request->startTime;
            }
            if(isset($request->endTime) && $request->endTime != ''){
                $params['filter']['endTime'] = $request->endTime;
            }
        }else{
            unset($params['filter']['startTime']);
            unset($params['filter']['endTime']);
            if(isset($request->startTime) && $request->startTime != ''){
                $params['filter']['responseStartTime'] = $request->startTime;
            }
            if(isset($request->endTime) && $request->endTime != ''){
                $params['filter']['responseEndTime'] = $request->endTime;
            }
        }

        if(isset($request->providerCode) && $request->providerCode != ''){
            $params['filter']['providerCode'] = $request->providerCode;
        }
        // $params['pagination'] = 10000;
        // $params = ArrayHelper::removeArrayNull($params);

        $TransferMoneyTransactionService = new TransferMoneyTransactionService();
        $params['page'] = 2;

        $data = $TransferMoneyTransactionService->getListExport($params);

        $meta = $data[1];
        $pages = $meta->pages;
        $page = $meta->page;
         // dd($meta);
        unset($data);

        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $fileName = date('YmdHis', time());
        header('Content-Type: application/vnd.ms-execl');
        header('Content-Disposition: attachment;filename="' . $fileName . '.csv"');

        $begin = microtime(true);

        $handle = fopen("php://output", 'a');
        fputs($handle, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));


            for ($i=1; $i <= $pages ; $i++) {
                $params['page'] = $i;

                $data = $TransferMoneyTransactionService->getListExport($params)[0];

                foreach($data as $key=>$data){

                    if($i == 1 && $key == 0){
                        unset($data->providerResponseData);
                        foreach($data as $tit=>$content){
                            $title[] = $tit;
                        }

                        fputcsv($handle, $title);
                    }
                    $data = (array)$data;
                    // dd($data);
                    unset($data['providerResponseData']);
                    $data['requestTime'] = date("d-m-Y H:i:s", $data['requestTime']);
                    $data['responseTime'] = date("d-m-Y H:i:s", $data['responseTime']);
                    fputcsv($handle, $data);
                }

            }


        fclose($handle);
        ob_flush();
        flush();
        $end = microtime(true);

    }
}
