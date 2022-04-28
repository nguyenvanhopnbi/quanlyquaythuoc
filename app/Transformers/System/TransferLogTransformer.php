<?php

namespace App\Transformers\System;

use App\Models\TransferLog;

class TransferLogTransformer
{
    public static function convertAttributesForTable($logs)
    {
        if (!is_array($logs)) {
            $logs = [$logs];
        }
        foreach ($logs as &$log) {
            $log->total_amount_text = number_format($log->total_amount, 0, '.', '.') . 'đ';
            $log->amount_per_trans_text = number_format($log->amount_per_trans, 0, '.', '.') . 'đ';
            $transferred = $log->amount_per_trans * $log->success_times;
            $transferred = $log->total_amount <= $transferred ? $log->total_amount : $transferred;
            $log->amount_transferred = number_format($transferred, 0, '.', '.') . 'đ';
            $log->amount_transferred_number = $transferred;
            $log->schedule_type_text = self::getScheduleTypeText($log->schedule_type);
            $log->status_text = self::getStatusText($log->status);
        }
        return $logs;
    }

    public static function getStatusText(string $status)
    {
        $statuses = self::getStatuses();
        return $statuses[$status] ?? $status;
    }

    public static function getScheduleTypeText(string $scheduleType = null)
    {
        if ($scheduleType === null) {
            return 'Chuyển ngay';
        }
        $types = self::getScheduleTypes();
        return $types[$scheduleType] ?? $scheduleType;
    }

    public static function getStatuses()
    {
        $statuses = [
            TransferLog::STATUS_DONE => 'Hoàn thành',
            TransferLog::STATUS_PAUSED => 'Tạm dừng',
            TransferLog::STATUS_SCHEDULE => 'Hẹn lịch',
        ];
        return $statuses;
    }

    public static function getScheduleTypes()
    {
        $types = [
            TransferLog::SCHEDULE_TYPE_DAILY => 'Hàng ngày',
            TransferLog::SCHEDULE_TYPE_ONCE => 'Một lần',
        ];
        return $types;
    }


}
