<?php

namespace App\Http\Controllers\Gate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Gate\EbillTransactionService;
use App\Transformers\EbillTransactionTransformer;
use App\Helpers\ArrayHelper;
use Illuminate\Support\Facades\Storage;

class ExportEbillTransaction extends Controller
{
    public function ExportEbillTransaction(Request $request){

        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        // dd($params);

        $params['query'] = $params;
        // $params['query']['export'] = true;
        $params['pagination']['perpage'] = 10000;

        $EbillTransactionService = new EbillTransactionService();
        $data = $EbillTransactionService->getList($params);

        $meta = $data->meta;
        $pages = $meta->pages;
        $page = $meta->page;
        $data = $data->data;

        $begin = microtime(true);
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $fileName = date('YmdHis', time());
        header('Content-Type: application/vnd.ms-execl');
        header('Content-Disposition: attachment;filename="' . $fileName . '.csv"');

        $handle = fopen("php://output", 'a');
        fputs($handle, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

        if($pages >= 1){
            for ($i=1; $i <= $pages ; $i++) {
                $params['pagination']['page'] = $i;

                $data = $EbillTransactionService->getList($params)->data;
                $data = EbillTransactionTransformer::transformCollection($data);
                // dump($data);
                foreach($data as $key=>$data){
                    if($i == 1 && $key == 0){
                        foreach($data as $tit=>$content){
                            $title[] = $tit;
                        }
                        $title[] = 'externalRefNo';
                        fputcsv($handle, $title);
                    }
                    $data = (array)$data;
                    if(isset($data['provider_callback_data'])){
                        $externalRefNo = json_decode($data['provider_callback_data']);
                        if(isset($externalRefNo->data->externalRefNo) and !empty($externalRefNo->data->externalRefNo)){
                            $externalRefNo = $externalRefNo->data->externalRefNo;
                            // array_unshift($data, $externalRefNo);
                            $data['externalRefNo'] = $externalRefNo;
                        }
                        else{
                            $data['externalRefNo'] = '';
                        }

                    }

                    $data['amount'] = str_replace('.', '', $data['amount']);
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
