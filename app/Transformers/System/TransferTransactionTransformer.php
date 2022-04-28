<?php

namespace App\Transformers\System;


class TransferTransactionTransformer
{
    public static function convertAttributesForTable($logs)
    {
        if (!is_array($logs)) {
            $logs = [$logs];
        }
        foreach ($logs as &$log) {
            $log->amount_text = number_format($log->amount, 0, '.', '.') . 'đ';
            $log->transfer_amount_text = number_format($log->transfer_amount, 0, '.', '.') . 'đ';
        }
        return $logs;
    }

}
