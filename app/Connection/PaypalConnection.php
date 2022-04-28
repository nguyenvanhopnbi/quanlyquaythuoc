<?php

namespace App\Connection;

use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;
use App\Helpers\Signature;

class PaypalConnection
{

    public static function getList(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/paypal/v1/partner-paypal';
        $result = Connection::sendRequest($url, $params, 'GET',  AuthenticationHelper::getHeaderPaypal(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    public static function getListDetails(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/paypal/v1/partner-paypal/' . $params['id'];
        $result = Connection::sendRequest($url, $params, 'GET',  AuthenticationHelper::getHeaderPaypal(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }


}
