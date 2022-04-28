<?php

namespace App\Helpers;

class SmsHelper
{
    public static function sendOTP(array $params): bool
    {
        $signData = self::generateSignData($params);
        $params['signature'] = self::generateSignature($signData, env('NOTICE_SERVICE_SECRET_KEY'));
        $apiURL = env('NOTICE_SERVICE_URL') . '/api/sms/send';
        $response = Connection::sendRequest($apiURL, $params, 'POST', [
            'xxx-authentication-key' => env('NOTICE_SERVICE_API_KEY')
        ], true);

        $body = json_decode($response['body'], true);

        if ($response['status_code'] != 200 || !$body['success']) {
//            \Log::error('SmsHelper@sendOTP send otp fail ', [$response, $body]);
            return false;
        }
        return true;

    }

    public static function generateSignature(string $data, string $secretKey)
    {
        return hash_hmac('sha256', $data, $secretKey);
    }

    public static function generateSignData(array $params): string
    {
        ksort($params);
        array_walk($params, function (&$item, $key) {
            $item = is_string($item) ? $key . '=' . $item : $key . '=' . json_encode($item);
        });
        return implode('&', $params);
    }

    public static function getDefaultPhoneForOtpCode()
    {
        return env('EBILL_TRANSFER_OTP_PHONE', '0984848639');
    }

    public static function getDefaultPhoneForOtpCodePartnerBankAccountTransfer()
    {
        return env('PARTNER_BANK_ACCOUNT_SMS_OTP') ?: '0987826124';
    }

}


