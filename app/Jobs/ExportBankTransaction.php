<?php

namespace App\Jobs;

use App\Services\Gate\BankTransactionService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Rap2hpoutre\FastExcel\FastExcel;
use Rap2hpoutre\FastExcel\SheetCollection;
use Illuminate\Support\Collection;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Common\Entity\Style\CellAlignment;
use Box\Spout\Common\Entity\Style\Color;


use Str;
use Log;

use Illuminate\Queue\SerializesModels;
class ExportBankTransaction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    public $timeout = 1200;

    public $title = [];

    const AVAILABLE_COLUMNS = [
        'transaction_id',
        'order_id',
        'partner_code',
        'amount',
        'fee',
        'currency',
        'bank_code',
        'application_id',
        'application_name',
        'status',
        'payment_method',
        'payment_type',
        'request_time',
        'response_time',
        'vendor_code',
        'order_info',
        'client_ip',
        'error_message',
        'vendor_ref_id',
    ];

    private $name;
    private $params;
    private $bankTransactionService;

    public function __construct($name, $params)
    {
        $this->name = $name;
        $this->params = $params;
        $this->bankTransactionService = app(BankTransactionService::class);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public $result = [];
    public function handle()
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $begin = microtime(true);
        header('Pragma: public');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Content-Description: File Transfer');
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename=export.csv;');
        header('Content-Transfer-Encoding: binary');

        $fp = fopen($this->bankTransactionService->getExportPath($this->name), 'a');
        fputs($fp, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

        $headers = collect(self::AVAILABLE_COLUMNS)->intersect($this->params['columns'] ?? []);
        unset($this->params['_token']);
        unset($this->params['columns']);


        if(count($this->params['query']) > 1 || ($this->params['query']['status'] != 'all' && count($this->params['query']) == 1) ){
            // $this->params['query']['limit'] = 20;
            // dd($this->params);
            $rows = $this->bankTransactionService->getListTransactionExport($this->params)->data ?? [];
            // dd($rows);

            (new FastExcel($this->exportGenerator($headers, $rows)))->export($this->bankTransactionService->getExportPath($this->name));

        }else if(count($this->params['query']) == 1 && $this->params['query']['status'] == 'all'){
            $this->params['pagination']['limit'] = 10000;
            $count = 0;

            $rows = $this->bankTransactionService->getListTransactionExportAllLimit($this->params)->data ?? [];

            for ($i=1; $i <= $this->bankTransactionService->pages; $i++) {
                $this->params['pagination']['page'] = $i;
                $rows = $this->bankTransactionService->getListTransactionExportAllLimit($this->params)->data ?? [];
                foreach($rows as $key=>$row){
                    $row = (array)$row;
                    unset($row['vendor_callback_data']);
                    unset($row['error_code']);
                    unset($row['extra_data']);
                    unset($row['extra_info']);

                    $row['request_time'] = date('d-m-Y H:i:s', $row['request_time']);
                    $row['response_time'] = date('d-m-Y H:i:s', $row['response_time']);

                    $header = [];
                    foreach($headers as $keyheader=>$value){
                        $header[] = $value;
                    }

                    foreach($row as $keyrecord => $record){
                        if($keyrecord == 'transaction_fee'){
                            $keyrecord = 'fee';
                        }
                        if(!in_array($keyrecord, $header)){
                            if($keyrecord == 'fee'){
                                unset($row['transaction_fee']);
                            }
                            unset($row[$keyrecord]);
                        }
                    }

                    // dd($row);

                    if($key == 0){
                        foreach($row as $keys => $value){
                            $this->title[] = $keys;
                            // dump($this->title);
                        }
                        fputcsv($fp, $this->title);
                    }

                    fputcsv($fp, $row);
                    // fputcsv($fp, array_values(get_object_vars($row)));
                }
                unset($rows);
                $count++;
            }
        }
        fclose($fp);
        $end = microtime(true);

        dump($count);

    }



    function getSystemMemInfo()
    {
        exec("free -mtl", $output);
        return $output;
    }

    private function exportGenerator($headers, $rows)
    {
        yield collect($headers)
            ->map(fn ($column) => Str::of($column)->replace('_', ' ')->title()->__toString())
            ->toArray();
        foreach ($rows as $row) {
            $row = $this->prepareExportRow($row);
            $row = get_object_vars($row);
            $data = [];
            foreach ($headers as $header) {
                $data[] = $row[$header];
            }
            yield $data;
        }
    }

    private function prepareExportRow($item): object
    {
        $item->amount = number_format($item->amount, 0);
        $item->fee = isset($item->transaction_fee)
            ? number_format($item->transaction_fee, 0)
            : '';
        $item->request_time = date('d-m-Y H:i:s', $item->request_time);
        $item->response_time = date('d-m-Y H:i:s', $item->response_time);

        return $item;
    }
}
