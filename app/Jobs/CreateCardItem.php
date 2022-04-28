<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;

class CreateCardItem implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $cardItem;
    protected $shopcardItemService;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($cardItem, $shopcardItemService)
    {
        //
        $this->cardItem = $cardItem;
        $this->shopcardItemService = $shopcardItemService;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $progress = Redis::get('processed-create-card-item');
        Redis::set('processed-create-card-item', ++$progress);
        $this->shopcardItemService->createCardItemByJob($this->cardItem);
    }
}
