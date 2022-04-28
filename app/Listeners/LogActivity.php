<?php

namespace App\Listeners;

use App\Events\ActivityOccur;
use App\Models\Activity;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogActivity implements ShouldQueue
{
    public function handle(ActivityOccur $event)
    {
        activity()
            ->by($event->causedBy)
            ->withProperties([
                'data' => $event->data,
            ])
            ->tap(function (Activity $activity) use ($event) {
                $activity->category = $event->performedOn;
            })
            ->log($event->description);
    }
}
