<?php

namespace App\Jobs\PartnerTransfer;

use App\Connection\PartnerBankAccountConnection;
use App\Models\PartnerBankTransfer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TransferTransactionPartnerVerifyJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Log::info('TransferTransactionPartnerVerifyJob@handle' . now()->toDateTimeString());
        $codeMustRecheck = PartnerBankTransfer::getCodeApiMustReVerify();
        ### get list transaction status must recall api
        PartnerBankTransfer::select('partner_ref_id', 'id')
            ->where('status', '!=', PartnerBankTransfer::STATUS_ERROR)
            ->whereIn('status_code', $codeMustRecheck)
            ->orderByDesc('id')
            ->chunkById(10, function ($items) use ($codeMustRecheck) {
                if ($items->isNotEmpty()) {
                    foreach ($items as $index => $item) {
                        ### api get status
                        $res = PartnerBankAccountConnection::transferVerifyStatus($item->partner_ref_id);
                        $res = ['errorCode' => 0, 'message' => 'Thành công'];
                        if (isset($res['errorCode'])) {
                            $code = $res['errorCode'];
                            if ($code == 0) {
                                $update = [
                                    'status_code' => $code,
                                    'status_message' => $res['message'] ?? 'Lỗi',
                                    'status' => PartnerBankTransfer::STATUS_SUCCESS,
                                ];
                            } elseif (in_array($code, $codeMustRecheck)) {
                                $update = [
                                    'status_code' => $code,
                                    'status_message' => $res['message'] ?? 'Lỗi',
                                ];
                            } else {
                                $update = [
                                    'status_code' => $code,
                                    'status_message' => $res['message'] ?? 'Lỗi',
                                    'status' => PartnerBankTransfer::STATUS_ERROR,
                                ];
                            }
                            $item->update($update);
                        }
                    }
                }
            });
    }
}
