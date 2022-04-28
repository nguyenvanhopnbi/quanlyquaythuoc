<?php
namespace App\Transformers;

class ShopCardTransactionTransformer
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
                $item->response_time = date("d-m-Y H:i:s", $item->response_time);
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
            'processing'=> 'badge-info',
            'pending'=> 'badge-warning',
            'error'=> 'badge-danger',
            'refund'=> 'badge-primary',
        ];

        if ($data) {
            $data->status_badge = $status[$data->status];
            $data->request_time = date("d-m-Y H:i:s", $data->request_time);
            $data->response_time = date("d-m-Y H:i:s", $data->response_time);
            $data->amount = number_format($data->amount, 0, ',', '.');
            $data->product_price = number_format($data->product_price, 0, ',', '.');
        }
        return $data;
    }
}
