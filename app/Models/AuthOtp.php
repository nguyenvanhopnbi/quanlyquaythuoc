<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;
use Illuminate\Support\Str;

class AuthOtp extends Model
{
    use HasFactory;
    protected $table = 'auth_otp';
    protected $guarded = [];

    public static function generateOtpCode()
    {
        $code = rand(100000,999999);
        return [
            'code' => $code,
            'secure_code' => hash_hmac('sha256', $code, env('APP_KEY'))
        ];
    }

    public static function validateOtp($code, $secureCode)
    {
        return hash_hmac('sha256', $code, env('APP_KEY')) === $secureCode;
    }

    public static function validateExpireTime(string $expireTime)
    {
        return Carbon::createFromTimeString($expireTime)->greaterThanOrEqualTo(now());
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
