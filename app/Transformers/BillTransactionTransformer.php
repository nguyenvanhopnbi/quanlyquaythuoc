<?php
namespace App\Transformers;

class BillTransactionTransformer
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
                $item->bill_amount = number_format($item->bill_amount, 0, ',', '.');
                $item->amount = number_format($item->amount, 0, ',', '.');
            }
        }
        return $data;
    }
}
