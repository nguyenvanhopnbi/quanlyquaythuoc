<?php

namespace App\Transformers;

class TransferMoneyProviderTransformer
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

    /**
     * @param $data
     * @return mixed
     */
    public static function transform($data)
    {
        $status = [
            'success' => 'badge-success',
            'error' => 'badge-danger',
            'pending' => 'badge-warning',
            'processing' => 'badge-info',
            'refund' => 'badge-primary',
            'cancel' => 'badge-dark',
        ];
        $statusTopup = [
            'success' => 'badge-success',
            'error' => 'badge-danger',
            'pending' => 'badge-warning',
            'processing' => 'badge-info',
            'refund' => 'badge-primary',
            'cancel' => 'badge-dark',
        ];

        if ($data) {
            $data->createdAt = date("d-m-Y H:i:s", $data->createdAt);
            $data->updatedAt = date("d-m-Y H:i:s", $data->updatedAt);
        }
        return $data;
    }

}
