<?php

namespace App\Jobs;

use App\Connection\TransferTransactionConnection;
use App\Models\TransferLog;
use App\Models\TransferTransaction;
use App\Services\System\TransferTransactionService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TransferTransactionVerifyJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Log::info('TransferTransactionVerifyJob run at ' . now()->toDateTimeString());
        $codeMustRecheck = TransferTransaction::getCodeApiMustReVerify();
        ### get list transaction status must recall api
        TransferTransaction::select('partner_ref_id', 'id', 'error_code', 'transfer_log_id')
            ->whereIn('error_code', $codeMustRecheck)
            ->orderByDesc('id')
            ->chunkById(10, function ($transactions) use ($codeMustRecheck) {
                if ($transactions->isNotEmpty()) {
                    foreach ($transactions as $index => $transaction) {
                        ### api get status
                        $res = TransferTransactionConnection::transferVerifyStatus($transaction->partner_ref_id);
                        $data = $res['data'];
                        if (isset($res['errorCode'])) {
                            $code = $res['errorCode'];
                            if ($code == 0) {
                                $update = [
                                    'error_code' => $code,
                                    'message' => $res['message'] ?? 'Lỗi',
                                    'status' => TransferTransaction::STATUS_SUCCESS,
                                    'transfer_amount' => $data['amount'],
                                    'appotapay_trans_id' => $data['transaction_id'],
                                ];
                            } elseif (in_array($code, $codeMustRecheck)) {
                                $update = [
                                    'error_code' => $code,
                                    'message' => $res['message'] ?? 'Lỗi',
                                ];
                            } else {
                                $update = [
                                    'error_code' => $code,
                                    'message' => $res['message'] ?? 'Lỗi',
                                    'status' => TransferTransaction::STATUS_FAILED,
                                ];
                            }
                            $transaction->update($update);
                            if ($code == 0) {
                                ## get detail
                                $transfer = TransferLog::where('id', $transaction->transfer_log_id)->first();
                                if ($transfer) {
                                    $transfer->update(['success_times' => $transfer->success_times + 1]);
                                }
                            }
                        }
                    }
                }
            });
    }
}
