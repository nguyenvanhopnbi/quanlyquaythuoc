<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ActivityOccur
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $performedOn;
    public $description;
    public $data;
    public $causedBy;

    public function __construct($performedOn, $description, $data = [])
    {
        $this->performedOn = $performedOn;
        $this->description = $description;
        $this->data = $data;
        $this->causedBy = auth()->id();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
