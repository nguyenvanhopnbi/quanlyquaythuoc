<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Controllers\Gate\PartnerBalanceExportCSVController;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Services\Gate\PartnerBalanceService;
use App\Transformers\PartnerBalanceTransformer;
use App\Helpers\ArrayHelper;

class PartnerBalance extends Component
{
    public $result = false;
    public $checkPath;

    protected $listeners = [
        'ExportPartnerBalance' => 'ExportPartnerBalance',
        'download' => 'download'
];

    public function render()
    {
        return view('livewire.partner-balance');
    }
    public function ExportPartnerBalance($partner_code, $type, $startTime, $endTime, $amount, $adminEmail){

        $PartnerBalanceExportCSVController = new PartnerBalanceExportCSVController($partner_code, $type, $startTime, $endTime, $amount, $adminEmail);
        return redirect()->route('partner-balance-exportcsv', [
            'partner_code' => $partner_code,
            'type' => $type,
            'startTime' => $startTime,
            'endTime' => $endTime,
            'amount' => $amount,
            'admin_email' => $adminEmail
        ]);
    }

    public function download($partner_code, $type, $startTime, $endTime, $amount, $adminEmail, Request $request){

        $partnerBalanceService = new PartnerBalanceService();

        $params = [];
        $params['pagination']['limit'] = 10000;

        if(isset($partner_code) && $partner_code != ''){
            $params['query']['partner_code'] = $partner_code;
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
        ini_set('memory_limit', '-1');
        $fileName = date('YmdHis', time());
        header('Content-Type: application/vnd.ms-execl');
        header('Content-Disposition: attachment;filename="' . $fileName . '.csv"');
        $path = storage_path('app/') . $fileName .'.csv';

        $begin = microtime(true);

        $handle = fopen($path, 'w');
        // $handle = fopen('php://temp/maxmemory:'. (5*1024*1024), 'r+');
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
                    fputcsv($handle, $data);
                }

            }
        }

        fclose($handle);
        ob_flush();
        flush();

        $request->session()->put('key', $path);
        $path = $request->session()->get('key');
        return \Response::download($path)->deleteFileAfterSend(true);

        $end = microtime(true);

    }

}
