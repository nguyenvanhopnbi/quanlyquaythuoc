<?php

namespace App\Http\Controllers\Gate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transformers\ShopCardTransactionTransformer;
use App\Services\Gate\ShopcardTransactionService;
use App\Helpers\ArrayHelper;

class ExportShopCardTransaction extends Controller
{
    public function ExportShopCardTransaction(Request $request){
        $params = $request->all();
        $params['query'] = $params;
        $params['pagination']['perpage'] = 10000;
        $params = ArrayHelper::removeArrayNull($params);
        $ShopcardTransactionService = new ShopcardTransactionService();
        $data = $ShopcardTransactionService->getList($params);
        $data->data = ShopCardTransactionTransformer::transformCollection($data->data);

        $meta = $data->meta;
        $pages = $meta->pages;
        $page = $meta->page;
        $data = $data->data;

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

                $data = $ShopcardTransactionService->getList($params)->data;
                $data = ShopCardTransactionTransformer::transformCollection($data);
                // dd($data);
                foreach($data as $key=>$data){

                    if($i == 1 && $key == 0){
                        foreach($data as $tit=>$content){
                            $title[] = $tit;
                        }
                        fputcsv($handle, $title);
                    }
                    $data = (array)$data;
                    $data['amount'] = str_replace('.', '', $data['amount']);
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
