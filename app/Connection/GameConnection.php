<?php

namespace App\Connection;

use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;

class GameConnection
{
    public static function overviewRevenue(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/payment-link/overview/revenue';
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body'], true);
        return $resultBody;
    }

    public static function transactionList(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/payment-link/transaction/list';
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body'], true);
        return $resultBody;
    }

    public static function channelList(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/payment-link/channel';
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body'], true);
        return $resultBody;
    }

    public static function customerList(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/payment-link/customer';
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body'], true);
        return $resultBody;
    }

    public static function partnerList(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/payment-link/partner/list';
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body'], true);
        return $resultBody;
    }

}
