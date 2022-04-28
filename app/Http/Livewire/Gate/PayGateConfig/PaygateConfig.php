<?php

namespace App\Http\Livewire\Gate\PayGateConfig;

use Livewire\Component;
use App\Services\Gate\PartnerPayGateConfigService;
use App\Transformers\PartnerPaygateConfigTransformer;

class PaygateConfig extends Component
{

    protected $listeners = ['ExportPaygateConfig' => 'ExportPaygateConfig'];

    public function render()
    {
        return view('livewire.gate.pay-gate-config.paygate-config');
    }

    public function ExportPaygateConfig($partner_code, $contract_number){
        $params = [];
        $params['query']['partner_code'] = $partner_code;
        $params['query']['contract_number'] = $contract_number;
        $params['pagination']['perpage'] = 10000;

        $data = PartnerPayGateConfigService::getList($params);
        // $data->data = PartnerPaygateConfigTransformer::transformCollection($data->data);

        $begin = microtime(true);
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $fileName = date('YmdHis', time());
        header('Content-Type: application/json');
        header('Accept: application/json');
        header('Content-Type: application/vnd.ms-execl');
        header('Content-Disposition: attachment;filename="' . $fileName . '.csv"');

        // $handle = fopen("php://output", 'a');
        $path = storage_path('app/') . $fileName .'.csv';
        $handle = fopen($path, 'w');
        $titleCol = [];

        fputs($handle, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

            foreach($data->data as $key => $data){

                if($key == 0){
                    foreach($data as $title=>$content){
                        $titleCol[] = $title;
                    }

                    $titleCol[11] = "Phí thanh toán Ví Appota (%)";
                    $titleCol[12] = "Phí xử lý GD Ví Appota (VNĐ)";
                    $titleCol[13] = "Phí thanh toán JCB (%)";
                    $titleCol[14] = "Phí xử lý GD JCB (VNĐ)";
                    $titleCol[] = "Ngày tạo";
                    $titleCol[] = "Ngày cập nhật";
                    unset($titleCol[9]);
                    unset($titleCol[10]);
                    // dd($titleCol);
                    fputcsv($handle, $titleCol);
                }

                $data = (array)$data;
                // $data['created_at'] = date('d-m-Y H:i:s', $data['created_at']);
                // $data['updated_at'] = date('d-m-Y H:i:s', $data['updated_at']);
                $data['Ngày tạo'] = date('d-m-Y H:i:s', $data['created_at']);
                $data['Ngày cập nhật'] = date('d-m-Y H:i:s', $data['updated_at']);
                unset($data['created_at']);
                unset($data['updated_at']);
                fputcsv($handle, $data);
            }


        fclose($handle);
        ob_flush();
        flush();
        return response()->download($path)->deleteFileAfterSend(true);
        $end = microtime(true);
    }
}
