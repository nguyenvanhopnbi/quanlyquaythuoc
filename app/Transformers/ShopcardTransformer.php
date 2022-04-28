<?php
namespace App\Transformers;

class ShopcardTransformer
{
    /**
     * @param $data
     * @return mixed
     */
    public static function transformCollection($data)
    {
        if ($data) {
            foreach ($data as &$item) {
                $item->createdAt = date("d-m-Y H:i:s", $item->createdAt);
                $item->price = number_format($item->price, 0, ',', '.');
                $item->value = number_format($item->value, 0, ',', '.');
                $item->updatedAt = date("d-m-Y H:i:s", $item->updatedAt);
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
            $data->createdAt = date("d-m-Y H:i:s", $data->createdAt);
            $data->price = number_format($data->price, 0, ',', '.');
            $data->value = number_format($data->value, 0, ',', '.');
            $data->updatedAt = date("d-m-Y H:i:s", $data->updatedAt);
        }
        return $data;
    }
}
