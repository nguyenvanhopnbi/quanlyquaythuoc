<?php

namespace App\Console\Commands\Transfer;

use App\Jobs\TransferLogScheduleDailyJob;
use App\Jobs\TransferTransactionVerifyJob;
use Illuminate\Console\Command;

class TransferTransactionScheduleDaily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Quét các đơn ở trạng thái daily và đẩy vào queue xử lý';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        \Log::info('TransferTransactionScheduleDaily Command run at '. now()->toDateTimeString());
        dispatch(new TransferLogScheduleDailyJob());
    }
}
