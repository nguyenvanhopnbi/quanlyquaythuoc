<?php
namespace App\Transformers;

class BillProvidersConfigTransformer
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
}
