<?php
namespace App\Transformers;

class IpnLogTransformer
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
     * @param $data
     * @return mixed
     */
    public static function transform($item)
    {
        $status = [
            'success'=> 'badge-success',
            'error'=> 'badge-danger',
        ];
        if ($item) {
            $item->status_badge = $status[$item->status];
            $item->timestamp = date("d-m-Y H:i:s", $item->timestamp);
        }
        return $item;
    }
}
