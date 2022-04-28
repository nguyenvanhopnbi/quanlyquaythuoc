<?php

namespace App\Console\Commands\PartnerTransfer;

use App\Jobs\PartnerTransfer\TransferTransactionPartnerVerifyJob;
use App\Jobs\TransferTransactionVerifyJob;
use Illuminate\Console\Command;

class TransferTransactionVerifyStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'partner-transfer:verify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kiểm tra trạng thái cuối của giao dịch chuyển tiền CMS, job cập nhật lại số tiền đã chuyển nếu status ok';

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
        \Log::info('TransferTransactionVerifyStatus@handle'. now()->toDateTimeString());
        dispatch(new TransferTransactionPartnerVerifyJob());

        $this->info('Done!');
    }
}
