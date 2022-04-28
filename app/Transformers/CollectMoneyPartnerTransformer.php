<?php
namespace App\Transformers;

class CollectMoneyPartnerTransformer
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
            }
        }
        return $data;
    }
}
