<?php

namespace App\Http\Controllers\Gate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Gate\ShopcardItemService;
use App\Transformers\ShopcardItemTransformer;
use App\Helpers\ArrayHelper;


class ExportShopCardItemController extends Controller
{
    public function ExportShopCardItemController(Request $request){
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $params['query'] = $params;
        $params['pagination']['perpage'] = 10000;

        $ShopcardItemService = new ShopcardItemService();
        $data = $ShopcardItemService->getList($params);
        $data->data = ShopcardItemTransformer::transformCollection($data->data);
        // dd($data);
        $meta = $data->meta;
        $pages = $meta->pages;
        $page = $meta->page;
        $data = $data->data;

        // dd($data);

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

                $data = $ShopcardItemService->getList($params)->data;
                $data = ShopcardItemTransformer::transformCollection($data);
                // dd($data);
                foreach($data as $key=>$data){

                    if($i == 1 && $key == 0){
                        foreach($data as $tit=>$content){
                            $title[] = $tit;
                        }
                        fputcsv($handle, $title);
                    }
                    $data = (array)$data;
                    $data['value'] = str_replace('.', '', $data['value']);
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
