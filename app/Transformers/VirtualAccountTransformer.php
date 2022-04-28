<?php
namespace App\Transformers;

class VirtualAccountTransformer
{
    /**
     * @param $data
     * @return mixed
     */
    public static function transformCollection($data)
    {
        if ($data) {
            foreach ($data as &$item) {
                $item->created_at = date("d-m-Y H:i:s", $item->created_at);
                $item->updated_at = date("d-m-Y H:i:s", $item->updated_at);
                $item->paid_amount = number_format($item->paid_amount, 0, ',', '.');
                $item->payment_expiry_time = date("d-m-Y H:i:s", $item->expiry_time);
                /** todo keep comment await update api */
//                $item->collect_min_amount = number_format($item->collect_min_amount, 0, ',', '.');
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
//            $data->created_at = date("d-m-Y H:i:s", $data->created_at);
            /** todo keep comment await update api */
//            $data->payment_expiry_time = date("d-m-Y H:i:s", $data->payment_expiry_time);
//            $data->paid_amount = number_format($data->paid_amount, 0, ',', '.');
//            $data->collect_min_amount = number_format($data->collect_min_amount, 0, ',', '.');
//            $data->collect_max_amount = number_format($data->collect_max_amount, 0, ',', '.');            $data->collect_max_amount = number_format($data->collect_max_amount, 0, ',', '.');
        }
        return $data;
    }
}
