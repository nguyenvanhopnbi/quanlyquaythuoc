<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Services\Gate\BankTransactionService;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Database\Eloquent\Collection;
use App\Connection\BankTransactionConnection;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Http;

use Str;

class BankTransactionExportH implements FromCollection, ShouldAutoSize, WithMapping, WithHeadings
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */

    public $datafull = [];
    public function collection()
    {

        for ($i=0; $i < 5; $i++) {
            $data = Http::timeout(30)->retry(3, 100)->get('https://payment.dev.appotapay.com/api/v1/bank-transactions');



            $this->datafull = array_merge($data['data'], $this->datafull);
        }

        // dd($this->datafull);
        $collect = new Collection($this->datafull);
        return $collect;
    }

    public $transaction_id = 'transaction_id';
    public $order_info = 'order_info';
    public $amount = 'amount';
    public $partner_code = 'partner_code';
    public $bank_code = 'bank_code';
    public $payment_method = 'payment_method';
    public $payment_type = 'payment_type';
    public $vendor_code = 'vendor_code';
    public $request_time = 'request_time';
    public $status = 'status';


    public function map($map):array{
        // return $this->maparray;
        return [
            $map[$this->transaction_id],
            $map[$this->order_info],
            $map[$this->amount],
            $map[$this->partner_code],
            $map[$this->bank_code],
            $map[$this->payment_method],
            $map[$this->payment_type],
            $map[$this->vendor_code],
            $map[$this->request_time],
            $map[$this->status]
        ];
    }

    public $transaction_id_heading = 'Transaction ID';
    public $order_info_heading = 'Order Info';
    public $amount_heading = 'Amount';
    public $partner_code_heading = 'Parner Code';
    public $bank_code_heading = 'Bank Code';
    public $payment_method_heading = 'Payment Method';
    public $payment_type_heading = 'Payment Type';
    public $vendor_code_heading = 'Vendor Code';
    public $request_time_heading = 'Request Time';
    public $status_heading = 'Status';


    public function headings(): array
    {
        return [
            $this->transaction_id_heading,
            $this->order_info_heading,
            $this->amount_heading,
            $this->partner_code_heading,
            $this->bank_code_heading,
            $this->payment_method_heading,
            $this->payment_type_heading,
            $this->vendor_code_heading,
            $this->request_time_heading,
            $this->status_heading
        ];
    }

}
