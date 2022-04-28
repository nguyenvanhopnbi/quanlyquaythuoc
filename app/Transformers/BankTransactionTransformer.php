<?php
namespace App\Transformers;

class BankTransactionTransformer
{
    /**
     * @param $data
     * @return mixed
     */
    public static function transformCollection($data)
    {
        // $paymentMethod = [
        //     'CC'=> 'Quốc Tế',
        //     'ATM'=> 'Nội Địa'
        // ];
        if ($data) {
            foreach ($data as &$item) {
                $item->amount = number_format($item->amount, 0, ',', '.');
                // $item->payment_method = isset($paymentMethod[$item->payment_method]) ? $paymentMethod[$item->payment_method] : $item->payment_method;
                $item->request_time = date("d-m-Y H:i:s", $item->request_time);
                $item->response_time = date("d-m-Y H:i:s", $item->response_time);
            }
        }
        return $data;
    }
     /**
     * @param $data
     * @return mixed
     */
    public static function transform($data)
    {
        $status = [
            'pending'=> 'badge-warning',
            'success'=> 'badge-success',
            'error'=> 'badge-danger',
            'processing'=> 'badge-primary',
            'refund'=> 'badge-dark',
            'cancelled'=> 'badge-brown',
        ];
        if ($data) {
            $data->default_amount = $data->amount;
            $data->amount = number_format($data->amount, 0, ',', '.');
            $data->status_badge = $status[$data->status];
            $data->request_time = date("d-m-Y H:i:s", $data->request_time);
            $data->response_time = date("d-m-Y H:i:s", $data->response_time);
            if(isset($data->refund_transactions)){
                if (count($data->refund_transactions) > 0) {
                    foreach ($data->refund_transactions as $key => $refund_transaction) {
                        $refund_transaction->status_badge = $status[$refund_transaction->status];
                        $refund_transaction->time_refund = date("d-m-Y H:i:s", $refund_transaction->time_refund);
                        $refund_transaction->refund_amount = number_format($refund_transaction->refund_amount, 0, ',', '.');
                        $data->refund_transactions[$key] = $refund_transaction;
                    }
                }
            }

        }
        return $data;
    }
}
