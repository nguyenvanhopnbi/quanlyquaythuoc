<?php
namespace App\Transformers;

class ShopcardDiscountConfigTransformer
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
            $data->created_at = date("d-m-Y H:i:s", $data->created_at);
            $data->updated_at = date("d-m-Y H:i:s", $data->updated_at);
        }
        return $data;
    }
}
