<?php

namespace App\Services\System;


use App\Connection\TransferTransactionConnection;
use App\Helpers\AuthEbillPartnerHelper;
use App\Jobs\TransferLogScheduleOnce;
use App\Models\TransferLog;
use App\Models\TransferLogSchedule;
use App\Models\TransferTransaction;
use Carbon\Carbon;

class TransferLogService
{
    protected $transferLogService;

    public function __construct(TransferTransactionService $transferLogService)
    {
        $this->transferLogService = $transferLogService;
    }

    public function transactionList(int $page = 1, int $limit = 10, array $filter = [])
    {
        $transactions = TransferLog::select('*');
        if (isset($filter['id'])) {
            $transactions->where('id', $filter['id']);
        }
        if (isset($filter['account_no_from'])) {
            $transactions->where('account_no_from', $filter['account_no_from']);
        }
        if (isset($filter['account_no_to'])) {
            $transactions->where('account_no_to', $filter['account_no_to']);
        }
        if (isset($filter['fd'])) {
            $transactions->where('created_at', '>=', $filter['fd']);
        }
        if (isset($filter['td'])) {
            $transactions->where('created_at', '<=', $filter['td']);
        }
        if (isset($filter['status'])) {
            $transactions->where('status', $filter['status']);
        }
        if (isset($filter['schedule_type'])) {
            if($filter['schedule_type'] === 'now') {
                $transactions->whereNull('schedule_type');
            } else {
                $transactions->where('schedule_type', $filter['schedule_type']);
            }
        }
        if(isset($filter['get_transaction'])) {
            $transactions->with(['transactions' => function($query) {
                $query->select('id', 'transfer_log_id', 'status', 'error_code', 'message', 'amount', 'transfer_amount', 'appotapay_trans_id', 'created_at');
            }]);
        }
        $transactions = $transactions->orderByDesc('id')->paginate($limit, ['*'], 'page', $page);

        return $transactions;
    }

    public function transactionCreate(array $data)
    {
        $return = ['success' => false, 'message' => null];

        if (!$data['is_schedule']) {
            $status = TransferLog::STATUS_DONE;
        } elseif ($data['schedule_type'] === TransferLog::SCHEDULE_TYPE_ONCE || $data['schedule_type'] === TransferLog::SCHEDULE_TYPE_DAILY) {
            $status = TransferLog::STATUS_SCHEDULE;
        } else {
            $return['message'] = 'Chưa chọn tần suất thực hiện';
            return $return;
        }

        $transfer = TransferLog::create([
            'email_otp' => $data['otp_email'],
            'sms_otp' => $data['otp_sms'],
            'total_amount' => $data['total_amount'],
            'amount_per_trans' => $data['amount_per_trans'],
            'content' => $data['content'],
            'success_times' => 0,
            'account_no_from' => $data['account_no_from'],
            'account_no_to' => $data['account_no_to'],
            'account_name_from' => $data['account_name_from'],
            'account_name_to' => $data['account_name_to'],
            'bank_code_from' => $data['bank_code_from'],
            'bank_code_to' => $data['bank_code_to'],
            'status' => $status,
            'schedule_type' => $data['is_schedule'] ? $data['schedule_type'] : null,
            'schedule_at' => $data['is_schedule'] ? $data['schedule_at'] : null,
            'scheduled_date' => $data['is_schedule'] && $data['schedule_type'] === TransferLog::SCHEDULE_TYPE_ONCE ? $data['scheduled_date'] : null,
        ]);
        if ($status === TransferLog::STATUS_DONE) {
            $return = $this->processTransferAndGetResult($transfer);
        } elseif ($status === TransferLog::STATUS_SCHEDULE) {
            if ($data['schedule_type'] === TransferLog::SCHEDULE_TYPE_ONCE) {
                $delay = Carbon::createFromFormat('Y-m-d H:i', $data['scheduled_date'] . ' ' . $data['schedule_at']);
                ### set job run when schedule type = once
                if ($delay->lessThan(now())) {
                    return;
                }
                dispatch(new TransferLogScheduleOnce($transfer->id))->delay($delay);
                $transfer->update(['scheduled_date' => now()->format('Y-m-d')]);
                $return['message'] = 'Giao dịch đã được lên lịch';
            } elseif ($data['schedule_type'] === TransferLog::SCHEDULE_TYPE_DAILY) {
                $delay = Carbon::createFromFormat('H:i', $data['schedule_at']);
                ### set job if time greater than now on today
                if ($delay->greaterThanOrEqualTo(now())) {
                    dispatch(new TransferLogScheduleOnce($transfer->id))->delay($delay);
                    $transfer->update(['scheduled_date' => now()->format('Y-m-d')]);
                }
            }
            $return['success'] = true;
            $return['message'] = 'Giao dịch đã được lên lịch';
        }
        return $return;
    }

    public function processTransferAndGetResult(TransferLog $transfer, int $logScheduleId = null)
    {
        $return = ['success' => false, 'message' => null, 'times' => 0, 'transfer_trans_id' => []];
        $resAmount = $transfer['total_amount'];
        $times = 0;
        while ($resAmount > 0) {
            ### request api create transfer
            $amount = $resAmount >= $transfer['amount_per_trans'] ? $transfer['amount_per_trans'] : $resAmount;
            $resAmount -= $transfer['amount_per_trans'];
            $partnerRefId = uniqid('TS');

            $req = [
                'fromAccountNo' => $transfer['account_no_from'],
                'toAccountNo' => $transfer['account_no_to'],
                'amount' => $amount,
                'transactionId' => $partnerRefId,
                'accountType' => TransferLog::ACCOUNT_TYPE_ACCOUNT,
                'memo' => $transfer['content'],
            ];

            $response = TransferTransactionConnection::transferMake($req);
            $response = array_merge([
                'partnerRefId' => $partnerRefId,
                'transaction' => [
                    'amount' => $amount,
                    'transferAmount' => 0,
                ]
            ], $response);
            $trans = app(TransferTransactionService::class)->createFromResponse($transfer->id, $response, $logScheduleId);
            $return['transfer_trans_id'][] = $trans->id;
            if (!isset($response['errorCode'])) {
                if ($times > 0) {
                    $return['message'] = "Đã chuyển khoản thành thành công $times lần với tổng số tiền " . number_format($times * $transfer['amount_per_trans']) . 'đ';
                } else {
                    $return['message'] = 'Hệ thống bị lỗi, vui lòng thử lại';
                }
                break;
            } elseif ($response['errorCode'] !== 0) {
                if ($times > 0) {
                    $return['message'] = "Đã chuyển khoản thành thành công $times lần với tổng số tiền " . number_format($times * $transfer['amount_per_trans']) . 'đ';
                } else {
                    $return['message'] = $response['message'] ?? 'Tạo giao dịch bị lỗi, vui lòng thử lại';
                }
                break;
            } else {
                $transfer->update(['success_times' => $transfer->success_times + 1]);
                $return['success'] = true;
                $transferred = ($times + 1) * $transfer['amount_per_trans'];
                $transferred = $transferred > $transfer['total_amount'] ? $transfer['total_amount'] : $transferred;
                $return['message'] = "Đã chuyển khoản thành thành công " . ($times + 1) . " lần với tổng số tiền " . number_format($transferred) . 'đ';
            }
            $times++;
            usleep(500000); // sleep 0,5s to prevented from bank block request
        }
        $return['times'] = $times;

        return $return;
    }

    public function logListAccount(int $page = 1, int $limit = 10, array $filter = [])
    {
        if (isset($filter['account_no_type']) && $filter['account_no_type'] === 'from') {
            $columns = ["account_no_from as id", 'account_name_from as account_name', "account_no_from as account_no", 'bank_code_from as bank_code'];
        } else {
            $columns = ["account_no_to as id", 'account_name_to as account_name', "account_no_to as account_no", 'bank_code_to as bank_code'];
        }
        $accounts = TransferLog::select($columns)
            ->distinct();
        if (isset($filter['account_id'])) {
            $accounts->where('id', $filter['account_id']);
        }
        if (isset($filter['account_no'])) {
            if ($filter['account_no_type'] === 'from') {
                $accounts->where('account_no_from', $filter['account_no']);
            } else {
                $accounts->where('account_no_to', $filter['account_no']);
            }
        }
        if (isset($filter['query'])) {
            $accounts->where(function ($where) use ($filter) {
                if ($filter['account_no_type'] === 'from') {
                    $where->where('account_name_from', 'like', '%' . $filter['query'] . '%')
                        ->orWhere('bank_code_from', '=', $filter['query'])
                        ->orWhere('account_no_from', 'like', '%' . $filter['query'] . '%');
                } else {
                    $where->where('account_name_to', 'like', '%' . $filter['query'] . '%')
                        ->orWhere('bank_code_to', '=', $filter['query'])
                        ->orWhere('account_no_to', 'like', '%' . $filter['query'] . '%');
                }
            });
        }
        $accounts = $accounts->paginate($limit);
        return $accounts;
    }


    public function getById(string $id)
    {
        return TransferLog::where('id', $id)->first();
    }

    public function update(string $id, array $data)
    {
        return TransferLog::where('id', $id)->update($data);
    }

}
