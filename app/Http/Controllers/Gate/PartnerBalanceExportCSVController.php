<?php

namespace App\Http\Controllers\Gate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Gate\PartnerBalanceService;
use App\Transformers\PartnerBalanceTransformer;
use App\Helpers\ArrayHelper;

class PartnerBalanceExportCSVController extends Controller
{
    public $partner_code;
    public function exportcsv(Request $request){
        $params = $request->all();

        $params = ArrayHelper::removeArrayNull($params);

        $params['query'] = $params;
        // dump($params);

        $partnerBalanceService = new PartnerBalanceService();

        // if(isset($partner_code) && $partner_code != ''){
        //     $params['query']['partner_code'] = $partner_code;
        // }

        // if(isset($type) && $type != ''){
        //     $params['query']['type'] = $type;
        // }
        // if(isset($type) && $type != ''){
        //     $params['query']['type'] = $type;
        // }
        // if(isset($startTime) && $startTime != ''){
        //     $params['query']['startTime'] = $startTime;
        // }
        // if(isset($endTime) && $endTime != ''){
        //     $params['query']['endTime'] = $endTime;
        // }
        // if(isset($amount) && $amount != ''){
        //     $params['query']['amount'] = $amount;
        // }
        // if(isset($adminEmail) && $adminEmail != ''){
        //     $params['query']['admin_email'] = $adminEmail;
        // }



        $data = $partnerBalanceService->getList($params);
        // dd($data);
        $data->data = PartnerBalanceTransformer::transformCollection($data->data);
        $meta = $data->meta;
        $pages = $meta->pages;
        $page = $meta->page;
        $data = $data->data;

        set_time_limit(0);
        ini_set('memory_limit', '128M');
        $fileName = date('YmdHis', time());
        header('Content-Type: application/vnd.ms-execl');
        header('Content-Disposition: attachment;filename="' . $fileName . '.csv"');

        $begin = microtime(true);

        $handle = fopen("php://output", 'a');
        fputs($handle, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

        if($pages >= 1){
            for ($i=$page; $i <= $pages ; $i++) {
                $params['pagination']['page'] = $i;

                $data = $partnerBalanceService->getList($params)->data;

                foreach($data as $key=>$data){

                    if($i == 1 && $key == 0){
                        foreach($data as $tit=>$content){
                            if($tit == 'timestamp'){
                                $tit = "Created time";
                            }
                            $title[] = $tit;
                        }

                        fputcsv($handle, $title);
                    }
                    $data = (array)$data;
                    $data['timestamp'] = date("Y-m-d H:i:s", $data['timestamp']);
                    // dd($data['timestamp']);
                    fputcsv($handle, $data);
                }

            }
        }

        fclose($handle);
        ob_flush();
        flush();
        $end = microtime(true);

    }
    public function ddddd($partner_code, $type, $startTime, $endTime, $amount, $adminEmail){

        $partnerBalanceService = new PartnerBalanceService();
        $params = [];
        if(isset($partner_code) && $partner_code != ''){
            $params['query']['partner_code'] = $partner_code;
        }

        if(isset($type) && $type != ''){
            $params['query']['type'] = $type;
        }
        if(isset($type) && $type != ''){
            $params['query']['type'] = $type;
        }
        if(isset($startTime) && $startTime != ''){
            $params['query']['startTime'] = $startTime;
        }
        if(isset($endTime) && $endTime != ''){
            $params['query']['endTime'] = $endTime;
        }
        if(isset($amount) && $amount != ''){
            $params['query']['amount'] = $amount;
        }
        if(isset($adminEmail) && $adminEmail != ''){
            $params['query']['admin_email'] = $adminEmail;
        }



        $data = $partnerBalanceService->getList($params);
        $data->data = PartnerBalanceTransformer::transformCollection($data->data);
        $meta = $data->meta;
        $pages = $meta->pages;
        $page = $meta->page;
        $data = $data->data;

        set_time_limit(0);
        ini_set('memory_limit', '128M');
        $fileName = date('YmdHis', time());
        header('Content-Type: application/vnd.ms-execl');
        header('Content-Disposition: attachment;filename="' . $fileName . '.csv"');

        $begin = microtime(true);

        $handle = fopen("php://output", 'a');
        fputs($handle, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

        if($pages >= 1){
            for ($i=$page; $i <= $pages ; $i++) {
                $params['pagination']['page'] = $i;

                $data = $partnerBalanceService->getList($params)->data;

                foreach($data as $key=>$data){

                    if($i == 1 && $key == 0){
                        foreach($data as $tit=>$content){
                            $title[] = $tit;
                        }

                        fputcsv($handle, $title);
                    }
                    $data = (array)$data;

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
