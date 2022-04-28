<?php

namespace App\Jobs;

use App\Services\Gate\BankTransactionService;
use App\Services\Gate\LogImportCardService;
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
class ExportLogImportCard implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    public $timeout = 1200;

    public $title = [];

    const AVAILABLE_COLUMNS = [
        'id',
        'transaction_id',
        'vendor',
        'value',
        'quantity',
        'discount_percent',
        'provider_id',
        'provider_name',
        'method',
        'status',
        'timestamp',
    ];

    private $name;
    private $params;
    private $logImportCardService;

    public function __construct($name, $params)
    {
        $this->name = $name;
        $this->params = $params;
        $this->logImportCardService = app(LogImportCardService::class);
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

        $fp = fopen($this->logImportCardService->getExportPath($this->name), 'a');
        fputs($fp, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

        $headers = collect(self::AVAILABLE_COLUMNS);
        unset($this->params['_token']);
        unset($this->params['columns']);
        $header = [];
        foreach($headers as $keyheader => $value){
            $header[] = $value;
        }
        fputcsv($fp, (array) $header);

        $page = 1;
        $next = 1;
        while ($next > 0) {
            $this->params['pagination']['page'] = $page;
            $data = $this->logImportCardService->getList($this->params);
            if (empty($data->data)) {
                break;
            }
            $next = $data->meta->pages - $page;
            $page ++;
            foreach ($data->data as $key => $item) {
                $row_csv = [];
                foreach($headers as $keyheader => $value){
                    $row_csv[$value] = isset($item->{$value}) ? $item->{$value} : '';
                }
                fputcsv($fp, $row_csv);
            }
        }
        fclose($fp);
    }
}
