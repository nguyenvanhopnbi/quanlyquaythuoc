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

class TransferLogScheduleDailyJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Log::info('TransferLogScheduleDailyJob run at ' . now()->toDateTimeString());
        $dateToday = now()->format('Y-m-d');
        TransferLog::where('status', TransferLog::STATUS_SCHEDULE)
            ->where('schedule_type', TransferLog::SCHEDULE_TYPE_DAILY)
            ->where(function ($where) use ($dateToday) {
                $where->where('scheduled_date', '<', $dateToday)->orWhereNull('scheduled_date');
            })
            ->orderByDesc('id')
            ->chunkById(10, function ($transfers) use ($dateToday) {
                foreach ($transfers as $transfer) {
                    $delay = Carbon::createFromFormat('Y-m-d H:i:s', $dateToday . ' ' . $transfer->schedule_at);
                    if ($delay->greaterThanOrEqualTo(now())) {
                        $transfer->update(['scheduled_date' => $dateToday]);
                        dispatch(new TransferLogScheduleOnce($transfer->id))->delay($delay);
                    }
                }
            });
    }
}
