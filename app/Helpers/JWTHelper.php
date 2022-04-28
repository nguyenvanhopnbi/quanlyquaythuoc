<?php namespace App\Helpers;

use Firebase\JWT\JWT;

class JWTHelper
{

    /**
     * @param string $secret_key
     * @return string
     */
    public static function generateJWT($secret_key = '')
    {
        $secretKey = $secret_key === '' ? env('PAYMENT_AUTH_SECRET_KEY') : $secret_key;

        $token = [
            "exp" => time() + 15
        ];

        return JWT::encode($token, $secretKey);
    }

    public static function generateJWTWithData(array $data, string $secretKey = null)
    {
        // $secretKey = env('PAYMENT_AUTH_SECRET_KEY');
        // $payload = array_merge(["exp" => time() + 86400], $data);

        $secretKey = $secretKey ?? env('PAYMENT_AUTH_SECRET_KEY');
        $payload = array_merge(["exp" => time() + 86400], $data);


        return JWT::encode($payload, $secretKey);
    }

}
