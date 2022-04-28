<?php

namespace App\Helpers;
use \Firebase\JWT\JWT;

class AuthenticationHelper
{
    public static function getJwt(string $partnerCode = null)
    {

        $payload = $partnerCode?[
            'exp'=> time() + 86400,
            'partners' => $partnerCode
        ] : [
            'exp'=> time() + 86400
        ];

        return 'Bearer '.JWT::encode(
            $payload, env("JWT_SECRET_KEY"), 'HS256');
    }
    public static function getHeader(string $partnerCode = null)
    {

        return ['authorization'=> AuthenticationHelper::getJwt($partnerCode)];
    }

    public static function getHeaderGameService()
    {
        $payload = [
            'exp'=> time() + 86400,
        ];

        return ['authorization'=> JWT::encode($payload, env("GAME_SERVICE_AUTH_SECRECT_KEY"), 'HS256')];
    }


    public static function getHeaderPaypal(){

        $payload = [
            'exp'=> time() + 86400,
        ];

        return ['Authorization'=> 'Bearer '.JWT::encode($payload, env("AUTH_SECRET_KEY_PAYPAL"), 'HS256')];
    }

    public static function getHeaderImages()
    {
        $payload = [
            'exp'=> time() + 86400,
        ];


        return ['authorization'=> JWT::encode($payload, env("STATIC_AUTH_SECRET_KEY"), 'HS256')];
    }
}
