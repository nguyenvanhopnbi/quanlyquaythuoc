<?php

namespace App\Transformers\Partner;

use Carbon\Carbon;

class PartnerBankAccountTransformer
{

    public static function convertAttributes($item)
    {
        $bankAccountTypes = self::getBankAccountTypes();
        if (isset($bankAccountTypes[$item['bank_account_type']])) {
            $item['bank_account_type_text'] = $bankAccountTypes[$item['bank_account_type']];
        } else {
            $item['bank_account_type_text'] = $item['bank_account_type'];
        }
        $item['created_at'] = Carbon::createFromTimestamp($item['created_at'])->format('Y-m-d H:i:s');
        return $item;
    }

    public static function getBankAccountTypes()
    {
        return [
            'account' => 'Số tài khoản',
            'card' => 'Số thẻ',
        ];
    }

}
