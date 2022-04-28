<?php

namespace App\Services\System;

use App\Models\TransferLog;
use App\Models\TransferTransaction;

class TransferTransactionService
{
    public function createFromResponse(int $transferTransactionId, array $response, int $logScheduleId = null)
    {
        $codeMustRecheck = TransferTransaction::getCodeApiMustReVerify();
        if ($response['errorCode'] == 0) {
            $status = TransferTransaction::STATUS_SUCCESS;
        } elseif (in_array($response['errorCode'], $codeMustRecheck)) {
            $status = TransferTransaction::STATUS_PENDING;
        } else {
            $status = TransferTransaction::STATUS_FAILED;
        }
        $data = [
            'partner_ref_id' => $response['partnerRefId'] ?? null,
            'transfer_log_id' => $transferTransactionId,
            'error_code' => $response['errorCode'] ?? null,
            'message' => $response['message'] ?? null,
            'amount' => $response['transaction']['amount'] ?? null,
            'transfer_amount' => $response['transaction']['transferAmount'] ?? null,
            'appotapay_trans_id' => $response['transaction']['appotapayTransId'] ?? null,
            'time' => $response['transaction']['time'] ?? null,
            'account_balance' => $response['account']['balance'] ?? null,
            'raw' => json_encode($response),
            'status' => $status,
            'log_schedule_id' => $logScheduleId,
        ];
        return TransferTransaction::create($data);
    }

    public function transactionList(int $page = 1, int $limit = 10, array $filter = [])
    {
        $transactions = TransferTransaction::select('*');
        if (isset($filter['log_id'])) {
            $transactions->where('transfer_log_id', $filter['log_id']);
        }
        if (isset($filter['fd'])) {
            $transactions->where('created_at', '>=', $filter['fd']);
        }
        if (isset($filter['td'])) {
            $transactions->where('created_at', '<=', $filter['td']);
        }
        $transactions = $transactions->orderByDesc('id')->paginate($limit, ['*'], 'page', $page);

        return $transactions;
    }

    public function getListTransactionMustReCallApiVerify(int $page = 1, int $limit = 10)
    {
        $offset = $limit * ($page - 1);
        $statusReCall = TransferTransaction::getCodeApiMustReVerify();
        $transactions = TransferTransaction::select('partner_ref_id', 'id')
            ->whereIn('error_code', $statusReCall)
            ->offset($offset)
            ->limit($limit)
            ->get();
        return $transactions;
    }
}
