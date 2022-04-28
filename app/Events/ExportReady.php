<?php

namespace App\Events;

use App\Helpers\PusherHelper;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ExportReady implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private User $user;
    public string $exportPath;
    public string $secret;

    public function __construct(User $user, string $exportPath, string $secret)
    {
        $this->user = $user;
        $this->exportPath = $exportPath;
        $this->secret = $secret;
    }

    public function broadcastOn()
    {
        return new Channel(PusherHelper::getExportChannel($this->user->id));
    }


    public function broadcastAs()
    {
        return PusherHelper::getExportEven($this->secret);
    }
}
