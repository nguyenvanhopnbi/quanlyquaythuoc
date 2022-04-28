<?php


namespace App\Transformers;


class EbillIpnLogsTransformers
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
            }
        }
        return $data;
    }


    /**
     * @param $item
     * @return mixed
     */
    public static function transform($item)
    {
        $status = [
            'success'=> 'badge-success',
            'error'=> 'badge-danger',
        ];
        if ($item) {
            $item->status_badge = array_key_exists($item->status,$status)?$status[$item->status]:'badge-dark';
            $item->timestamp = date("d-m-Y H:i:s", $item->timestamp);
        }
        return $item;
    }
}
