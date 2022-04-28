<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;


class TransferLogSchedule extends Model
{
    use HasFactory;

    protected $table = 'transfer_log_schedule';
    protected $guarded = [];




    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
