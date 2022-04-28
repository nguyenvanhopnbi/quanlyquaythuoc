<?php
namespace App\Transformers;

class BankRefundTransactionTransformer
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
                $item->refund_amount = number_format($item->refund_amount, 0, ',', '.');
                $item->amount = number_format($item->amount, 0, ',', '.');
                // $item->payment_method = isset($paymentMethod[$item->payment_method]) ? $paymentMethod[$item->payment_method] : $item->payment_method;
                $item->request_time = date("d-m-Y H:i:s", $item->request_time);
                $item->time_refund = date("d-m-Y H:i:s", $item->time_refund);
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
            $data->refund_amount = number_format($data->refund_amount, 0, ',', '.');
            $data->time_refund = date("d-m-Y H:i:s", $data->time_refund);
            $data->default_amount = $data->amount;
            $data->amount = number_format($data->amount, 0, ',', '.');
            $data->status_badge = $status[$data->status];
            $data->request_time = date("d-m-Y H:i:s", $data->request_time);
            $data->response_time = date("d-m-Y H:i:s", $data->response_time);
        }
        return $data;
    }
}
