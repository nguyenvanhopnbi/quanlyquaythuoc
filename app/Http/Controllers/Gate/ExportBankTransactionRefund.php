<?php

namespace App\Http\Controllers\Gate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Gate\BankTransactionService;
use App\Transformers\BankRefundTransactionTransformer;
use App\Helpers\ArrayHelper;
use App\Helpers\CheckIsAmUser;

class ExportBankTransactionRefund extends Controller
{
    public function ExportBankTransactionRefund(Request $request){
        $params = [];
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $params['query'] = $params;
        $params['pagination']['perpage'] = 10000;

         // dd($params);

        $BankTransactionService = new BankTransactionService();

        $partnerCode = CheckIsAmUser::checkIsAmUser();

        $data = $BankTransactionService->getListRefund($params, $partnerCode);
        $data->data = BankRefundTransactionTransformer::transformCollection($data->data);
        // dump($params);
        // dd($data);
        $meta = $data->meta;
        $pages = $meta->pages;
        $page = $meta->page;
        $data = $data->data;
        unset($data);
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $fileName = date('YmdHis', time());
        header('Content-Type: application/vnd.ms-execl');
        header('Content-Disposition: attachment;filename="' . $fileName . '.csv"');
        // $path = storage_path('app/') . $fileName .'.csv';

        $begin = microtime(true);

        // $handle = fopen($path, 'w');
        $handle = fopen("php://output", 'a');
        fputs($handle, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

        if($pages >= 1){
            for ($i=$page; $i <= $pages ; $i++) {
                $params['pagination']['page'] = $i;

                $partnerCode = CheckIsAmUser::checkIsAmUser();

                $data = $BankTransactionService->getListRefund($params, $partnerCode)->data;
                $data = BankRefundTransactionTransformer::transformCollection($data);

                foreach($data as $key=>$data){
                    unset($data->vendor_callback_data);
                    unset($data->extra_info);
                    if($i == 1 && $key == 0){
                        foreach($data as $tit=>$content){
                            $title[] = $tit;

                        }
                        fputcsv($handle, $title);
                    }
                    $data = (array)$data;
                    $data['amount'] = str_replace('.', '', $data['amount']);
                    $data['refund_amount'] = str_replace('.', '', $data['refund_amount']);
                    // dd($data);
                    fputcsv($handle, $data);
                }

            }
        }

        fclose($handle);
        ob_flush();
        flush();
        $end = microtime(true);
    }
}
