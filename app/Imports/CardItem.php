<?php

namespace App\Imports;
use App\Jobs\CreateCardItem;
use Carbon\Carbon;

class CardItem
{
    public function model($row)
    {
        $cardItem = [
           'code'     => $this->clean($row[0]),
           'serial'    => $this->clean($row[1]),
           'value' => $this->clean($row[2]),
           'expiry' => $this->clean($row[3]),
           'vendor' => $this->clean($row[4]),
        ];
        dispatch((new CreateCardItem($cardItem, $this))->onQueue(env('QUEUE_NAME'))->delay(Carbon::now()->addSeconds(1))); //job queue
    }

    private function clean($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
     
        return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
    }
}
