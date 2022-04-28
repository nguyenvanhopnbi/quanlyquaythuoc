<?php

namespace App\Jobs;

use App\Services\Gate\BankTransactionService;
use App\Services\Gate\TransferMoneyTransactionService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Rap2hpoutre\FastExcel\FastExcel;
use Str;

class ExportTransferMoneyTransaction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    public $timeout = 1200;

    const AVAILABLE_COLUMNS = [
        'transactionId',
        'partnerRefId',
        'partnerCode',
        'applicationId',
        'applicationName',
        'customerPhoneNumber',
        'amount',
        'transferAmount',
        'status',
        'transferStatus',
        'requestTime',
    ];

    private $name;
    private $params;
    private $transferMoneyTransactionService;

    public function __construct($name, $params)
    {
        $this->name = $name;
        $this->params = $params;
        $this->transferMoneyTransactionService = app(TransferMoneyTransactionService::class);
    }

    /**
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Common\Exception\InvalidArgumentException
     * @throws \Box\Spout\Common\Exception\UnsupportedTypeException
     * @throws \Box\Spout\Writer\Exception\WriterNotOpenedException
     */
    public function handle()
    {
        $headers = self::AVAILABLE_COLUMNS;
        unset($this->params['_token']);
        unset($this->params['columns']);
        $rows = $this->getListRow() ?? [];
        (new FastExcel($this->exportGenerator($headers, $rows)))->export($this->transferMoneyTransactionService->getExportPath($this->name));
    }

    public function getListRow()
    {
        $page = 1;
        $next = 1;
        $dataFinal = [];
        while ($next > 0) {
            $data = $this->transferMoneyTransactionService->getListTransactionExport(['query' => $this->params, 'pagination' => ['page' => $page] ]);
            if (empty($data->data)) {
                break;
            }
            $next = $data->meta->pages - $page;
            $page ++;
            $dataFinal = $data->data ? array_merge($dataFinal, $data->data) : $dataFinal;
        }
        return $dataFinal;
    }

    private function exportGenerator($headers, $rows)
    {
        yield $headers;
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
        $item->amount = number_format($item->amount, 0, ',', ',');
        $item->transferAmount = number_format($item->transferAmount, 0, ',', ',');
        $item->requestTime = date('d-m-Y H:i:s', $item->requestTime);

        return $item;
    }

}
