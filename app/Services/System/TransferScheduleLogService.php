<?php

namespace App\Services\System;

use App\Models\TransferLog;
use App\Models\TransferLogSchedule;

class TransferScheduleLogService
{

    public function scheduleLogListAjax(int $page = 1, int $limit = 10, array $filter = [])
    {
        $transactions = TransferLogSchedule::select('*');
        if (isset($filter['transfer_log_id'])) {
            $transactions->where('transfer_log_id', $filter['transfer_log_id']);
        }

        $transactions = $transactions->orderByDesc('id')->paginate($limit, ['*'], 'page', $page);

        return $transactions;
    }

    public function getByTransferLogId(int $transferLogId)
    {
        $log = TransferLogSchedule::where('transfer_log_id', $transferLogId)->first();
        return $log;
    }
}
