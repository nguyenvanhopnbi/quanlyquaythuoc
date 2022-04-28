<?php

namespace App\Jobs;

use App\Events\ExportReady;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Log;

class NotifyUserOfCompletedExport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public User $user;
    public string $exportPath;
    public string $secret;

    public function __construct(User $user, string $exportPath, string $secret)
    {
        $this->user = $user;
        $this->exportPath = $exportPath;
        $this->secret = $secret;
    }

    public function handle()
    {
        Log::debug('exportDone, data: ', ['user' => $this->user, 'exportPath' => $this->exportPath, 'secrect' => $this->secret]);
        ExportReady::dispatch($this->user, $this->exportPath, $this->secret);
    }
}
