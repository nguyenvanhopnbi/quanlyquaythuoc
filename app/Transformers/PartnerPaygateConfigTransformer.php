<?php

namespace App\Transformers;

use Illuminate\Support\Str;

class PartnerPaygateConfigTransformer
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
                $item->atm_transaction_fee = number_format($item->atm_transaction_fee, 0, ',', '.');
                $item->cc_transaction_fee = number_format($item->cc_transaction_fee, 0, ',', '.');
                $item->ewallet_transaction_fee = number_format($item->ewallet_transaction_fee ?? 0, 0, ',', '.');
                $item->atm_payment_fee = Str::of($item->atm_payment_fee)->replace('.', ',');
                $item->cc_payment_fee = Str::of($item->cc_payment_fee)->replace('.', ',');
                $item->ewallet_payment_fee = Str::of($item->ewallet_payment_fee)->replace('.', ',');
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
            'active' => 'badge-success',
            'blocked' => 'badge-danger',
            'inactive' => 'badge-warning',
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
