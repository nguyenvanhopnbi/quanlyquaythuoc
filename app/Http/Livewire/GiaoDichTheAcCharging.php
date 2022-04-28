<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Transformers\ChargingTransformer;
use App\Services\Charging\ChargingService;
use App\Helpers\CheckIsAmUser;

class GiaoDichTheAcCharging extends Component
{
    public function render()
    {
        return view('livewire.giao-dich-the-ac-charging');
    }

    public function exportCSV(Request $request){
        $params['query'] = $request->all();
        $params['pagination']['perpage'] = 10000;
        $partnerCode = null;
        $partnerCode = CheckIsAmUser::checkIsAmUser();
        $data = ChargingService::getList($params, $partnerCode);

        if(isset($data->meta->pages)){
            $pages = $data->meta->pages;
        }

        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $fileName = date('YmdHis', time());
        header('Content-Type: application/vnd.ms-execl');
        header('Content-Disposition: attachment;filename="' . $fileName . '.csv"');
        $begin = microtime(true);
        $handle = fopen("php://output", 'a');
        fputs($handle, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

        $title = [
            'Transaction ID',
            'Partner Transaction Id',
            'Application Id',
            'Application Name',
            'Code',
            'Serial',
            'Amount',
            'Partner Code',
            'Percent',
            'Target',
            'Service Name',
            'Status',
            'Error code',
            'Message',
            'Request time',
            'Response time'
        ];

        fputcsv($handle, $title);


        if($pages >= 1){
            for ($i=1; $i <= $pages ; $i++) {
                $params['pagination']['page'] = $i;
                $data = ChargingService::getList($params, $partnerCode);

                foreach($data->data as $data){
                    $data = (array)$data;
                    $data['request_time'] = date('d-m-Y H:i:s', $data['request_time']);
                    $data['response_time'] = date('d-m-Y H:i:s', $data['response_time']);
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
