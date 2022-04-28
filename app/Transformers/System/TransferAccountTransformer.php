<?php
namespace App\Transformers\System;

use App\Models\TransferAccount;

class TransferAccountTransformer
{
    /**
     * @param $data
     * @return mixed
     */
    public static function convertAttributes($accounts)
    {
        if(!is_array($accounts)) {
            $accounts = [$accounts];
        }
//        foreach ($accounts as &$account) {
//
//        }
        return $accounts;
    }

}
