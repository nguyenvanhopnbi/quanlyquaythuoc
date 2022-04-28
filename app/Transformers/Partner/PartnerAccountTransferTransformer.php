<?php

namespace App\Transformers\Partner;

use App\Models\PartnerBankTransfer;
use Carbon\Carbon;

class PartnerAccountTransferTransformer
{

    public static function convertAttributes($item)
    {
        $bankAccountTypes = self::getBankAccountTypes();
        if (isset($bankAccountTypes[$item['bank_account_type']])) {
            $item['bank_account_type_text'] = $bankAccountTypes[$item['bank_account_type']];
        } else {
            $item['bank_account_type_text'] = $item['bank_account_type'];
        }
        $item['status_text'] = self::getStatusText($item['status']);
        return $item;
    }

    public static function getStatusText($status)
    {
        $statuses = PartnerBankTransfer::getStatuses();
        return isset($statuses[$status]) ? $statuses[$status] : $status;
    }

    public static function getBankAccountTypes()
    {
        return [
            'account' => 'Số tài khoản',
            'card' => 'Số thẻ',
        ];
    }

}
