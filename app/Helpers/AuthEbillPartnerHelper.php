<?php

namespace App\Helpers;
use \Firebase\JWT\JWT;

class AuthEbillPartnerHelper
{
    public static function getSecretKey()
    {
        return env('EBILL_SECRET_KEY');
    }

    public static function generateSignature($params)
    {
        ksort($params);
        array_walk($params, function(&$item, $key) {
            $item = $key.'='.$item;
        });
        $signData = implode('&', $params);
        return hash_hmac('sha256', $signData, self::getSecretKey());
    }

    public static function generateJWT($partnerCode, $apiKey, $secretKey)
    {
        $now = time();
        $exp = $now + 3600;
        $header = array(
            'typ' => 'JWT',
            'alg' => 'HS256',
            'cty' => "appotapay-api;v=1"
        );
        $payload = array(
            'iss' => $partnerCode,
            'api_key' => $apiKey,
            'exp' => $exp
        );
        return JWT::encode($payload, $secretKey, 'HS256', null, $header);
    }

    public static function getHeader()
    {
        $partnerCode = env('EBILL_PARTNER_CODE');
        $apiKey = env('EBILL_API_KEY');
        $secretKey = self::getSecretKey();

        return [
            'X-APPOTAPAY-AUTH' => 'Bearer ' . self::generateJWT($partnerCode, $apiKey, $secretKey),
            'Content-Type' => 'application/json',
            'X-AUTH' => env('EBILL_TRANSFER_HEADER_API_KEY', 'X-AUTH'),
        ];
    }
}
