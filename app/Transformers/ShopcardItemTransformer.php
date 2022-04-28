<?php
namespace App\Transformers;

class ShopcardItemTransformer
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
                $item->updatedAt = date("d-m-Y H:i:s", $item->updatedAt);
                // $item->expiry = date("d-m-Y", $item->expiry);
                $item->expiry = self::fomatExpiryDate($item->expiry);
                $item->value = number_format($item->value, 0, ',', '.');
            }
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

    /**
     * @param $data
     * @return mixed
     */
    public static function transform($data)
    {
        $public = [
            'no'=> 'badge-warning',
            'yes'=> 'badge-success',
        ];
        $sold = [
            'no'=> 'badge-success',
            'yes'=> 'badge-warning',
        ];
        if ($data) {
            $data->createdAt = date("d-m-Y H:i:s", $data->createdAt);
            $data->public_badge = $public[$data->public];
            $data->sold_badge = $sold[$data->sold];
            $data->updatedAt = date("d-m-Y H:i:s", $data->updatedAt);
            // $data->expiry = date("d-m-Y", $data->expiry);
            $data->expiry = self::fomatExpiryDate($data->expiry);
            $data->value = number_format($data->value, 0, ',', '.');
        }
        return $data;
    }
}
