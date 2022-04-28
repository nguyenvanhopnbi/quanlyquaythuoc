<?php
namespace App\Transformers;

class EbillTransformer
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
                $item->amount = number_format($item->amount, 0, ',', '.');
                $item->paid_amount = number_format($item->paid_amount, 0, ',', '.');
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
            'new'=> 'badge-warning',
            'purchased'=> 'badge-success',
            'error'=> 'badge-danger',
            'processing'=> 'badge-primary',
            'cancelled'=> 'badge-dark',
            'refund'=> 'badge-dark',
            'pending'=> 'badge-primary',
        ];
        if ($item) {
            $item->status_badge =  array_key_exists($item->status,$status)?$status[$item->status]:'badge-dark';
            $item->createdAt = date("d-m-Y H:i:s", $item->createdAt);
            $item->amount = number_format($item->amount, 0, ',', '.');
            $item->updatedAt = date("d-m-Y H:i:s", $item->updatedAt);
        }
        return $item;
    }
}
