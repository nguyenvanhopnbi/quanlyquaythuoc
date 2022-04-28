<?php
namespace App\Transformers;

class LogsUserTransformer
{
    /**
     *
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
}