<?php

namespace App\Http\Controllers\Export;

use App\Services\Gate\BankTransactionService;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomChunkSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportBankTransaction implements FromCollection, WithHeadings, WithMapping, WithCustomChunkSize
{
    use Exportable;

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
        'holding_status',
        'has_refund'
    ];

    private array $params;
    private Collection $columns;


    public function __construct($params = [])
    {
        $this->columns = collect(self::AVAILABLE_COLUMNS)->intersect($params['columns']);
        unset($params['_token']);
        unset($params['columns']);
        $this->params = $params;
    }

    public function map($row): array
    {
        $data = [];
        $row = get_object_vars($row);
        foreach ($this->columns as $value) {
            $data[] = $row[$value];
        }
        return $data;
    }

    public function headings(): array
    {
        return $this->columns
            ->map(fn ($column) => Str::of($column)->replace('_', ' ')->title())
            ->toArray();
    }

    public function prepareRows($rows): array
    {
        return array_map(function ($item) {
            $item->amount = number_format($item->amount, 0);
            $item->fee = isset($item->transaction_fee)
                ? number_format($item->transaction_fee, 0)
                : '';
            $item->request_time = date('d-m-Y H:i:s', $item->request_time);
            $item->response_time = date('d-m-Y H:i:s', $item->response_time);

            return $item;
        }, $rows);
    }

    public function collection()
    {
        $bankTransactionService = new BankTransactionService();
        $listTransaction = $bankTransactionService->getListTransactionExport($this->params);
        return Collection::wrap($listTransaction->data);
    }

    public function chunkSize(): int
    {
        return 1;
    }
}
