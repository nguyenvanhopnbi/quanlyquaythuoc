<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;


class TransferLog extends Model
{
    use HasFactory;

    protected $table = 'transfer_logs';
    protected $guarded = [];

    const STATUS_DONE = 'done';
    const STATUS_SCHEDULE = 'schedule';
    const STATUS_PAUSED = 'paused';
    const SCHEDULE_TYPE_ONCE = 'once';
    const SCHEDULE_TYPE_DAILY = 'daily';

    const ACCOUNT_TYPE_CARD = 'card';
    const ACCOUNT_TYPE_ACCOUNT = 'account';

    public function transactions()
    {
        return $this->hasMany(TransferTransaction::class, 'transfer_log_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
