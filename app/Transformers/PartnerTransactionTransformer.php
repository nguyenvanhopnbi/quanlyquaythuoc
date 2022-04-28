<?php
namespace App\Transformers;

class PartnerTransactionTransformer
{
    /**
     * @param $data
     * @return mixed
     */
    public static function transformCollection($data)
    {
        if ($data) {
            foreach ($data as &$item) {
                $item->timestamp = date("d-m-Y H:i:s", $item->timestamp);
                $item->amount = number_format($item->amount, 0, ',', '.');
                $item->balance = number_format($item->balance, 0, ',', '.');
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
        if ($data) {
            $data->timestamp = date("d-m-Y H:i:s", $data->timestamp);
            $data->amount = number_format($data->amount, 0, ',', '.');
            $data->balance = number_format($data->balance, 0, ',', '.');
        }
        return $data;
    }
}
