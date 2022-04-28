<?php
namespace App\Transformers;

class TopupTransactionTransformer
{
    /**
     * @param $data
     * @return mixed
     */
    public static function transformCollection($data)
    {
        if ($data) {
            foreach ($data as &$item) {
                $item->request_time = date("d-m-Y H:i:s", $item->request_time);
                $item->topup_time = date("d-m-Y H:i:s", $item->topup_time);
                $item->amount = number_format($item->amount, 0, ',', '.');
                $item->topup_value = number_format($item->topup_value, 0, ',', '.');
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
            'success'=> 'badge-success',
            'error'=> 'badge-danger',
            'pending'=> 'badge-warning',
            'processing'=> 'badge-info',
            'refund'=> 'badge-primary',
            'cancel'=> 'badge-dark',
        ];
        $statusTopup = [
            'success'=> 'badge-success',
            'error'=> 'badge-danger',
            'pending'=> 'badge-warning',
            'processing'=> 'badge-info',
            'refund'=> 'badge-primary',
            'cancel'=> 'badge-dark',
        ];
  
        if ($data) {
            $data->status_badge = $status[$data->status];
            $data->topup_status_badge = $statusTopup[$data->topup_status];
            $data->request_time = date("d-m-Y H:i:s", $data->request_time);
            $data->topup_time = date("d-m-Y H:i:s", $data->topup_time);
            $data->amount = number_format($data->amount, 0, ',', '.');
            $data->topup_value = number_format($data->topup_value, 0, ',', '.');
        }
        return $data;
    }
}
