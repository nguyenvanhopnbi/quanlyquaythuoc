<?php

namespace App\Http\Controllers\Gate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Gate\PartnerTransactionService;
use App\Http\Controllers\Gate\ExportCSVPartnerTransaction;
use App\Helpers\ArrayHelper;

class ExportCSVPartnerTransaction extends Controller
{
    public $title = [];
    public function exportcsv(Request $request){
        $PartnerTransactionService = new PartnerTransactionService();
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $params['query'] = $params;
        $params['pagination']['perpage'] = 10000;

        $data = $PartnerTransactionService->getList($params);
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

                $data = $PartnerTransactionService->getList($params)->data;
                // dd($data);
                foreach($data as $key=>$data){

                    if($i == 1 && $key == 0){
                        foreach($data as $tit=>$content){
                            if($tit == 'timestamp'){
                                $tit = 'Transaction Time';
                            }
                            $title[] = $tit;
                        }
                        fputcsv($handle, $title);
                    }
                    $data = (array)$data;
                    $data['timestamp'] = date("Y-m-d H:i:s", $data['timestamp']);
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
