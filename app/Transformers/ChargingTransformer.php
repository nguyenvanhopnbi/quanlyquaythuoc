<?php
namespace App\Transformers;

class ChargingTransformer
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
                $item->amount = number_format($item->amount, 0, ',', '.');
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
            $data->request_time = date("d-m-Y H:i:s", $data->request_time);
            $data->response_time = date("d-m-Y H:i:s", $data->response_time);
            $data->amount = number_format($data->amount, 0, ',', '.');
        }
        return $data;
    }
}
