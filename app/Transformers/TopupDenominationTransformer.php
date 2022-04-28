<?php
namespace App\Transformers;

class TopupDenominationTransformer
{
    /**
     * @param $data
     * @return mixed
     */
    public static function transformCollection($data)
    {
        if ($data) {
            foreach ($data as &$item) {
                $item->value = number_format($item->value, 0, ',', '.');
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
            $data->value = number_format($data->value, 0, ',', '.');
        }
        return $data;
    }
}
