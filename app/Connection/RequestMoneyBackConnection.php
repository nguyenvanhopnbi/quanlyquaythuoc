<?php

namespace App\Connection;

use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;
use Illuminate\Support\Facades\Log;

class RequestMoneyBackConnection
{

    public static function RequestMoneyBack(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/ebill/request_resend_callback';

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

}
