<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Services\Gate\ShopcardService;
use App\Transformers\ShopcardTransformer;

class ShopCard extends Component
{
    protected $listeners = ['exportShopCard' => 'exportShopCard'];
    public function render()
    {
        return view('livewire.shop-card');
    }

    public function exportShopCard(
        $name,
        $product_code,
        $price,
        $public,
        $value,
        $vendor,
        Request $request
    )
    {
        $params = [];

        if(isset($name) && $name != ''){
            $params['query']['name'] = $name;
        }
        if(isset($product_code) && $product_code != ''){
            $params['query']['product_code'] = $product_code;
        }
        if(isset($price) && $price != ''){
            $params['query']['price'] = $price;
        }
        if(isset($public) && $public != ''){
            $params['query']['public'] = $public;
        }
        if(isset($value) && $value != ''){
            $params['query']['value'] = $value;
        }
        if(isset($vendor) && $vendor != ''){
            $params['query']['vendor'] = $vendor;
        }
        $params['pagination']['perpage'] = 10000;

        $shopcardService = new ShopcardService();
        $data = $shopcardService->getList($params);
        $data->data = ShopcardTransformer::transformCollection($data->data);

        $meta = $data->meta;
        $pages = $meta->pages;
        $page = $meta->page;
        $data = $data->data;


        set_time_limit(0);
        ini_set('memory_limit', '128M');
        $fileName = date('YmdHis', time());
        header('Content-Type: application/vnd.ms-execl');
        header('Content-Disposition: attachment;filename="' . $fileName . '.csv"');
        $path = storage_path('app/') . $fileName .'.csv';

        $begin = microtime(true);

        // $handle = fopen('php://output', 'w');

        $handle = fopen($path, 'w');
        fputs($handle, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

        if($pages >= 1){
            for ($i=$page; $i <= $pages ; $i++) {
                $params['pagination']['page'] = $i;

                $data = $shopcardService->getList($params)->data;
                // dd($data);
                foreach($data as $key=>$data){

                    if($i == 1 && $key == 0){
                        foreach($data as $tit=>$content){
                            if($tit == 'createdAt'){
                                $tit = "Created time";
                            }
                            if($tit != 'updatedAt'){
                                $title[] = $tit;
                            }

                            // dd($title);
                        }
                        fputcsv($handle, $title);
                    }
                    $data = (array)$data;
                    $data['createdAt'] = date("Y-m-d H:i:s", $data['createdAt']);
                    // $data['updatedAt'] = date("Y-m-d H:i:s", $data['updatedAt']);
                    unset($data['updatedAt']);
                    fputcsv($handle, $data);
                }

            }
        }

        fclose($handle);
        ob_flush();
        flush();
        $end = microtime(true);

        $request->session()->put('key', $path);
        $path = $request->session()->get('key');

        // return response()->download($path);

        return \Response::download($path)->deleteFileAfterSend(true);
    }
}
