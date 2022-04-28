<?php

namespace App\Http\Controllers\Gate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Gate\TopupTransactionService;
use App\Transformers\TopupTransactionTransformer;
use App\Helpers\ArrayHelper;

class ExportTopupTransaction extends Controller
{
    public function ExportTopupTransaction(Request $request){
        $params = [];
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $params['query'] = $params;

        $TopupTransactionService = new TopupTransactionService();


        $params['pagination']['perpage'] = 10000;
        $data = $TopupTransactionService->getList($params);
        $data->data = TopupTransactionTransformer::transformCollection($data->data);
        // dd($data);
        $meta = $data->meta;
        $pages = $meta->pages;
        $page = $meta->page;
        $data = $data->data;


        set_time_limit(0);
        ini_set('memory_limit', '512M');
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

                $data = $TopupTransactionService->getList($params)->data;
                $data = TopupTransactionTransformer::transformCollection($data);

                // $data = $partnerBalanceService->getList($params)->data;

                foreach($data as $key=>$data){

                    if($i == 1 && $key == 0){
                        foreach($data as $tit=>$content){

                            $title[] = $tit;
                        }
                        fputcsv($handle, $title);
                    }
                    $data = (array)$data;
                    $data['amount'] = str_replace('.', '', $data['amount']);
                    $data['topup_value'] = str_replace('.', '', $data['topup_value']);
                    // $data['discount_percent'] = str_replace('.', '', $data['discount_percent']);

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
