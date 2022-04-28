<?php
namespace App\Transformers;

class ShopcardPartnerCardDataTransformer
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
                $item->expiry = self::fomatExpiryDate($item->expiry);
                $item->value = number_format($item->value, 0, ',', '.');
            }
        }
        return $data;
    }
    public static function transformCollectionExport($data)
    {
        if ($data) {
            foreach ($data as &$item) {
                $item->timestamp = date("Y-m-d H:i:s", $item->timestamp);
                $item->expiry = self::fomatExpiryDateExport($item->expiry);
                $item->value = number_format($item->value, 0, ',', '.');
            }
        }
        return $data;
    }
    private static function fomatExpiryDateExport($expiry)
    {
        $year = substr($expiry, 0, 4);
        $month = substr($expiry, 4, 2);
        $day = substr($expiry, 6, 2);
        return $year.'-'.$month.'-'.$day;
    }


    /**
     * @param $data
     * @return mixed
     */
    public static function transform($data)
    {
        if ($data) {
            $data->timestamp = date("d-m-Y H:i:s", $data->timestamp);
            $data->expiry = self::fomatExpiryDate($data->expiry);
            $data->value = number_format($data->value, 0, ',', '.');
        }
        return $data;
    }

    private static function fomatExpiryDate($expiry)
    {
        $year = substr($expiry, 0, 4);
        $month = substr($expiry, 4, 2);
        $day = substr($expiry, 6, 2);
        return $day.'-'.$month.'-'.$year;
    }


}
