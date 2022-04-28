<?php

namespace App\Jobs;

use App\Connection\TransferTransactionConnection;
use App\Models\TransferLog;
use App\Models\TransferLogSchedule;
use App\Models\TransferTransaction;
use App\Services\System\TransferLogService;
use App\Services\System\TransferTransactionService;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TransferLogScheduleOnce
    implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $transferLogId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $transferLogId)
    {
        $this->transferLogId = $transferLogId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $todayDate = now()->format('Y-m-d');
        \Log::info('TransferLogScheduleOnce run at ' . now()->toDateTimeString());
        $transfer = TransferLog::where('id', $this->transferLogId)
            ->where('scheduled_date', $todayDate)
            ->first();
        if (!$transfer) {
            \Log::error('Not Found transaction Schedule :' . $this->transferLogId);
            return;
        } elseif ($transfer->status !== TransferLog::STATUS_SCHEDULE) {
            return; // Transaction was deactivate
        }
        ### check time valid, must greater than current time
        $scheduleAt = Carbon::createFromFormat('H:i:s', $transfer->schedule_at);
        if(now()->lessThan($scheduleAt)) {
            return;
        }

        ### if schedule log exist, what mean transaction was executed -> reject
        $scheduleLog = TransferLogSchedule::where('transfer_log_id', $transfer->id)
            ->whereRaw("DATE(created_at) = '{$todayDate}'")->first();
        if($scheduleLog) {
            return;
        }

        ### Log schedule init
        $schedule = TransferLogSchedule::create([
            'transfer_log_id' => $transfer->id,
            'times_success' => 0,
            'message' => 'Khởi tạo giao dịch',
        ]);

        $return = app(TransferLogService::class)->processTransferAndGetResult($transfer, $schedule->id);

        ### update status if transfer schedule once
        if($transfer->status === TransferLog::STATUS_SCHEDULE && $transfer->schedule_type === TransferLog::SCHEDULE_TYPE_ONCE) {
            $transfer->update(['status' => TransferLog::STATUS_DONE]);
        }

        ### Log schedule update
        $schedule->update([
            'times_success' => $return['times'],
            'message' => $return['message'],
        ]);
    }
}
