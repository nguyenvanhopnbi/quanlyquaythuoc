<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;


class PartnerBankTransfer extends Model
{
    use HasFactory;

    protected $table = 'partner_bank_transfer';
    protected $guarded = [];

    const STATUS_PENDING = 'pending';
    const STATUS_SUCCESS = 'success';
    const STATUS_ERROR = 'error';

    public static function getCodeApiMustReVerify()
    {
        return ['35', '169', '91', '99', '500'];
    }

    public static function getStatuses()
    {
        return [
            self::STATUS_PENDING => 'Chờ xử lý',
            self::STATUS_SUCCESS => 'Thành công',
            self::STATUS_ERROR => 'Thất bại',
        ];
    }

    public static function getBankAccountType()
    {
        return [
            'account' => 'Số tài khoản',
            'card' => 'Số thẻ',
        ];
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
