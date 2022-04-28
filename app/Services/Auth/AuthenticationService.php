<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Http;

class AuthenticationService
{

    public function requestAuthentication()
    {

        $response = Http::withHeaders([
            'Authorization' => env('AUTHENTICATION_API_KEY')
        ])->post(env('URL_AUTHENICATION_SERVICE') . '/api/token', [
            'client_id' => env("AUTHENTICATION_CLIENT_ID"),
            'redirect_uri' => env('APP_URL') . '/callback',
            'response_type' => 'code',
        ]);
\Log::debug('--requestAuthentication@res ', [$response]);

        if ($response->failed()) {
            return [
                'status' => false,
                'message' => 'Có lỗi xảy ra trong quá trình đăng nhập'
            ];
        }
        if (!$redirectUri = $response->json('redirect_uri')) {
            return [
                'status' => false,
                'message' => 'Không tìm thấy redirect_uri.'
            ];
        }
        return [
            'status' => true,
            'redirect_uri' => $redirectUri,
        ];
    }


    public function requestAccessToken($authorizationCode)
    {
        $response = Http::withHeaders([
            'Authorization' => env('AUTHENTICATION_API_KEY')
        ])->post(env("URL_AUTHENICATION_SERVICE") . '/api/generate/access_token', [
            'client_id' => env("AUTHENTICATION_CLIENT_ID"),
            'client_secret' => env("AUTHENTICATION_CLIENT_SECRET"),
            'authorization_code' => $authorizationCode
        ]);

        \Log::debug('--requestAccessToken@res ', [$response]);

        if ($response->failed()) {
            return [
                'status' => false,
                'message' => 'Có lỗi xảy ra trong quá trình xác thực'
            ];
        }

        if (!$accessToken = $response->json('access_token')) {
            return [
                'status' => false,
                'message' => 'Không tìm thấy access_token.'
            ];
        }
        return [
            'status' => true,
            'access_token' => $accessToken,
        ];
    }


    public function checkValidAccessToken(string $accessToken)
    {
        $response = Http::withHeaders([
            'Authorization' => env('AUTHENTICATION_API_KEY')
        ])->post(env("URL_AUTHENICATION_SERVICE") . '/api/token/valid', [
            'access_token' => $accessToken,
            'client_id' => env('AUTHENTICATION_CLIENT_ID'),
        ]);
        \Log::debug('--$response@res ', [$response]);
        if ($response->failed()) {
            return [
                'status' => false,
                'message' => 'Có lỗi xảy ra trong quá trình xác thực.'
            ];
        }
        return [
            'status' => true,
            'data' => $response->json(),
        ];
    }
}
