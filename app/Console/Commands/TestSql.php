<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Storage;

class TestSql extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:sql';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $content = '';
        for ($i = 0; $i < 10000; $i++) {
            $id = 'AP' . date('y') . Str::random(5) . random_int(10, 99);
            $order = Str::random(14);
            $content .= "INSERT INTO `bank_transaction` VALUES ('$id', '$order', 'test thanh toan', 'TEST', 1, 'Test', 10000, 'processing', 'VISA', 'CC', 'WEB', 'VPBANK', NULL, '{\"status\":\"success\",\"error_code\":0}', 35, 'Giao dịch đang chờ thanh toán', '', '{\"notifyUrl\":\"http:\\/\\/yourwebsite.com\\/ipn\",\"redirectUrl\":\"http:\\/\\/yourwebsite.com\\/redirect\"}', '103.53.171.140', 1620615201, 1620615281);\n";
        }
        
        Storage::disk('local')->put('insert.sql', $content);
    }
}
