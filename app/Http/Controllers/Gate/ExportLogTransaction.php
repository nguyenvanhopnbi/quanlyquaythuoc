<?php

namespace App\Http\Controllers\Gate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Gate\LogImportCardService;
use App\Helpers\ArrayHelper;

class ExportLogTransaction extends Controller
{
    public function LogsExport(Request $request){
        $param = $request->all();
        $param = ArrayHelper::removeArrayNull($param);
        if($param['status'] == 'all'){
            unset($param['status']);
        }
        if(isset($param['startTime'])){
            $param['startTime'] = strtotime($param['startTime'] . " 00:00:00");
        }
        if(isset($param['endTime'])){
            $param['endTime'] = strtotime($param['endTime'] . " 11:59:59");
        }


        $params['query'] = $param;
        // dd($params);
        $params['pagination']['limit'] = 10000;
        $LogImportCardService = new LogImportCardService();
        $data = $LogImportCardService->getList($params);

        $pages = $data->meta->pages;

        set_time_limit(0);
        ini_set('memory_limit', '512M');
        $fileName = date('YmdHis', time());

        header('Content-Type: application/vnd.ms-execl');
        header('Content-Disposition: attachment;filename="' . $fileName . '.csv"');

        $begin = microtime(true);
        $handle = fopen("php://output", 'a');
        fputs($handle, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

        if($pages >= 1){
            for ($i=1; $i <= $pages ; $i++) {

                $params['pagination']['page'] = $i;
                $dataLogs = $LogImportCardService->getList($params)->data;
                // dd($data);
                foreach($dataLogs as $key=>$data){
                    if($i == 1 && $key == 0){
                        foreach($data as $tit=>$content){
                            $title[] = $tit;
                        }
                        fputcsv($handle, $title);
                    }
                    $data = (array)$data;
                    // dump($data);
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
