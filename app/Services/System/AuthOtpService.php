<?php

namespace App\Services\System;


use App\Connection\TransferTransactionConnection;
use App\Helpers\AuthEbillPartnerHelper;
use App\Helpers\MailHelper;
use App\Helpers\SmsHelper;
use App\Models\AuthOtp;
use App\Models\TransferLog;
use App\Models\TransferTransaction;
use Illuminate\Support\Str;

class AuthOtpService
{
    public function sendMailOtp(string $to, string $code): bool
    {
        $mailData = \View::make('system.otp.mail_otp', ['code' => $code])->render();
        try {
            \Log::info('AuthOtpService@sendMailOtp trigger: ' . json_encode($to));
            $from = config('mail.from.address');
            return MailHelper::sendViaRQ($from, [$to], 'Mã xác thực OTP', $mailData);
        } catch (\Exception $e) {
            \Log::error('AuthOtpService@sendMailOtp error: ' . json_encode($to), [$e]);
        }
        return false;
    }

    public function sendMailOtpWithParams(string $to, string $view, array $params = []): bool
    {
        $mailData = \View::make($view, $params)->render();
        try {
            \Log::info('AuthOtpService@sendMailOtpWithParams trigger: ' . json_encode($to));
            $from = config('mail.from.address');
            $subject = "[VẬN HÀNH] Yêu cầu xác nhận chi tiền kỳ đối soát {$params['bbds_id']} cho đối tác {$params['partner_name']}";
            return MailHelper::sendViaRQ($from, [$to], $subject, $mailData);
        } catch (\Exception $e) {
            \Log::error('AuthOtpService@sendMailOtpWithParams error: ' . json_encode($to), [$e]);
        }
        return false;
    }

    public function sendMailOtpWithInfo(string $to, string $view, string $subject, array $params = []): bool
    {
        $mailData = \View::make($view, $params)->render();
        try {
            \Log::info('AuthOtpService@sendMailOtpWithInfo trigger: ' . json_encode($to));
            $from = config('mail.from.address');
            return MailHelper::sendViaRQ($from, [$to], $subject, $mailData);
        } catch (\Exception $e) {
            \Log::error('AuthOtpService@sendMailOtpWithParams error: ' . json_encode($to), [$e]);
        }
        return false;
    }

    public function sendSmsOtp(string $phone, string $code)
    {
        $message = 'Ban dang thuc hien giao dich tren Appota Pay. Ma co hieu luc trong vong 10 phut. Ma xac thuc cua ban la ' . $code;
        $data = [
            'phone_number' => $phone,
            'message' => $message,
            'request_id' => (string)time(),
            'branch_name' => 'APPOTA',
        ];
        return SmsHelper::sendOTP($data);
    }

    public function getByPhone(string $phone, bool $checkExpiredAt = true): ?AuthOtp
    {
        $auth = AuthOtp::where('phone', $phone)
            ->where('is_used', 0);
        if ($checkExpiredAt) {
            $auth->where(function ($where) {
                $where->whereNull('expired_at')->orWhere('expired_at', '>=', now());
            });
        }
        $auth = $auth->first();
        return $auth;
    }

    public function getByEmail(string $email, bool $checkExpiredAt = true): ?AuthOtp
    {
        $auth = AuthOtp::where('email', $email)
            ->where('is_used', 0);
        if ($checkExpiredAt) {
            $auth->where(function ($where) {
                $where->whereNull('expired_at')->orWhere('expired_at', '>=', now());
            });
        }
        $auth = $auth->first();
        return $auth;
    }

    public function isOtpValid(string $code, AuthOtp $otp): array
    {
        $return = ['is_valid' => false, 'message' => null];

        ### check code
        $isCodeValid = AuthOtp::validateOtp($code, $otp->secure_code);

        ### check expire time
        if ($otp->expired_at) {
            $isTimeValid = AuthOtp::validateExpireTime($otp->expired_at);
        } else {
            $isTimeValid = true;
        }

        $isRetryValid = false;
        ### check times retry
        if ($otp->max_retry == 0 || $otp->times_retry < $otp->max_retry) {
            $isRetryValid = true;
            $otp->update(['times_retry' => $otp->times_retry + 1]);
        }

        $return['is_valid'] = $isCodeValid && $isTimeValid && $isRetryValid;
        if ($return['is_valid']) {
            $return['message'] = 'Code hợp lệ';
        } elseif (!$isCodeValid) {
            if($otp->max_retry == $otp->times_retry) {
                $return['message'] = 'Mã xác thực không còn hiệu lực';
            } else {
                $return['message'] = 'Mã xác thực không hợp lệ, còn ' . ($otp->max_retry - $otp->times_retry + 1) . ' lần thử';
            }
        } elseif (!$isTimeValid) {
            $return['message'] = 'Mã xác thực đã hết hạn, vui lòng tạo lại mã mới';
        } elseif (!$isRetryValid) {
            $return['message'] = $return['message'] ?? 'Mã xác thực không còn hiệu lực';
        } else {
            $return['message'] = 'Mã xác thực không hợp lệ';
        }

        return $return;
    }

    public function createOtp(array $data)
    {
        ### remove all other otp
        AuthOtp::where('email', $data['email'])
            ->orWhere('phone', $data['phone'])
            ->where('is_used', 0)
            ->update([
                'is_used' => 1
            ]);

        return AuthOtp::create($data);
    }

    public function markAsUsed(string $id)
    {
        return AuthOtp::where('id', $id)->update(['is_used' => 1]);
    }

    public function setExpireTime(int $seconds = 60, string $channel = '')
    {
        $userId = \Auth::id();
        \Cache::set('OTP_EXPIRE_AT_' . $userId . $channel, now()->addSeconds($seconds));
    }

    public function getOtpCountTime(string $channel = '')
    {
        $userId = \Auth::id();
        $expiredAt = \Cache::get('OTP_EXPIRE_AT_' . $userId . $channel, now());
        if (now()->greaterThanOrEqualTo($expiredAt)) return 0;
        return now()->diffInSeconds($expiredAt);
    }

    public function resetCountTime(string $channel = '')
    {
        $userId = \Auth::id();
        \Cache::forget('OTP_EXPIRE_AT_' . $userId . $channel);
    }

}
