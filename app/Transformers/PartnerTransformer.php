<?php
namespace App\Transformers;

class PartnerTransformer
{
    /**
     * @param $data
     * @return mixed
     */
    public static function transformCollection($data)
    {
        if ($data) {
            foreach ($data as &$item) {
                $item->balance = number_format($item->balance, 0, ',', '.');
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
        $status = [
            'active'=> 'badge-success',
            'blocked'=> 'badge-danger',
            'inactive'=> 'badge-warning',
        ];
        if ($data) {
            $data->status_badge = $status[$data->status];
            $data->balance = number_format($data->balance, 0, ',', '.');
            $data->created_at = date("d-m-Y H:i:s", $data->created_at);
            $data->updated_at = date("d-m-Y H:i:s", $data->updated_at);
        }
        return $data;
    }
}
