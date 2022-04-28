<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Helpers\ArrayHelper;
use App\Services\Gate\PartnerService;
use App\Services\Gate\PartnerTransactionService;
use App\Http\Controllers\Gate\ExportCSVPartnerTransaction;

class ExportPartnerTransaction extends Component
{
    protected $listeners = ['ExportPartnerTransaction' => 'ExportPartnerTransaction'];
    public function render()
    {
        return view('livewire.export-partner-transaction');
    }
    public function ExportPartnerTransactionController(
        $transaction_id,
        $startTime,
        $endTime,
        $partner_code,
        $amount,
        $reason,
        $type,
        Request $request)
    {
        $PartnerTransactionService = new PartnerTransactionService();
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);

        if(isset($transaction_id) && $transaction_id != ''){
            $params['query']['transaction_id'] = $transaction_id;
        }
        if(isset($startTime) && $startTime != ''){
            $params['query']['startTime'] = $startTime;
        }
        if(isset($endTime) && $endTime != ''){
            $params['query']['endTime'] = $endTime;
        }
        if(isset($partner_code) && $partner_code != ''){
            $params['query']['partner_code'] = $partner_code;
        }
        if(isset($amount) && $amount != ''){
            $params['query']['amount'] = $amount;
        }
        if(isset($reason) && $reason != ''){
            $params['query']['reason'] = $reason;
        }
        if(isset($type) && $type != ''){
            $params['query']['type'] = $type;
        }


        set_time_limit(0);
        ini_set('memory_limit', '128M');
        $fileName = date('YmdHis', time());
        header('Content-Type: application/vnd.ms-execl');
        header('Content-Disposition: attachment;filename="' . $fileName . '.csv"');

        $begin = microtime(true);

        $handle = fopen("php://output", 'a');
        fputs($handle, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));


        // dump($params);
        $data = $PartnerTransactionService->getList($params);
        // dd($data);
        $meta = $data->meta;
        $pages = $meta->pages;
        $page = $meta->page;
        $data = $data->data;

        if($pages > 1){
            for ($i=$page; $i <= $pages ; $i++) {
                $params['pagination']['page'] = $i;
                $data = $PartnerTransactionService->getList($params)->data;

                foreach($data as $data){
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

    public function ExportPartnerTransaction(
        $transaction_id,
        $startTime,
        $endTime,
        $partner_code,
        $amount,
        $reason,
        $type,
        Request $request)
    {

        return redirect()->route('partner-transaction-exportcsv', [
            'transaction_id' => $transaction_id,
            'startTime' => $startTime,
            'endTime' => $endTime,
            'partner_code' => $partner_code,
            'amount' => $amount,
            'reason' => $reason,
            'type' => $type
        ]);

    }
}
