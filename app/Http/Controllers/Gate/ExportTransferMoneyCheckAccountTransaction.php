<?php

namespace App\Http\Controllers\Gate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Connection\TransferMoneyCheckAccountTransactionConnection;

class ExportTransferMoneyCheckAccountTransaction extends Controller
{
    public function ExportTransferMoneyCheckAccountTransaction(Request $request){
        $params = $request->all();
        $params['filter'] = $params;
        $TransferMoneyCheckAccountTransactionConnection = new TransferMoneyCheckAccountTransactionConnection();
        $data = $TransferMoneyCheckAccountTransactionConnection->getListExport($params);

        $data = $TransferMoneyCheckAccountTransactionConnection->getListExport($params);

        $meta = $data[1];
        $pages = $meta->pages;
        $page = $meta->page;

        unset($data);



        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $fileName = date('YmdHis', time());
        header('Content-Type: application/vnd.ms-execl');
        header('Content-Disposition: attachment;filename="' . $fileName . '.csv"');

        $begin = microtime(true);

        $handle = fopen("php://output", 'a');
        fputs($handle, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

        if($pages >= 1){
            for ($i=$page; $i <= $pages ; $i++) {
                $params['pagination']['page'] = $i;

                $data = $TransferMoneyCheckAccountTransactionConnection->getListExport($params)[0];

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
        }

        fclose($handle);
        ob_flush();
        flush();
        $end = microtime(true);
    }
}
