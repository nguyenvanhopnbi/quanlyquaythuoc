<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class TransferTransaction extends Model
{
    use HasFactory;

    protected $table = 'transfer_transactions';
    protected $guarded = [];
    protected $hidden = ['raw'];

    const STATUS_PENDING = 'pending';
    const STATUS_SUCCESS = 'success';
    const STATUS_FAILED = 'failed';

    public static function getCodeApiMustReVerify()
    {
        return ['35', '169', '91', '99', '500'];
    }

//    public function getStatusText()
//    {
//        return number_format($this->amount, 0, ',', '.') . 'đ';
//    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
