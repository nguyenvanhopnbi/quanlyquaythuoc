<?php

namespace App\Connection;

use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;

class PaymentLinkConnection
{
    public static function overviewRevenue(array $params, string $partnerCode = null)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/payment-link/overview/revenue';
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader($partnerCode), true);
        $resultBody = json_decode($result['body'], true);
        return $resultBody;
    }

    public static function transactionList(array $params, string $partnerCode = null)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/payment-link/transaction/list';
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader($partnerCode), true);
        $resultBody = json_decode($result['body'], true);
        return $resultBody;
    }

    public static function channelList(array $params, string $partnerCode = null)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/payment-link/channel';
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader($partnerCode), true);
        $resultBody = json_decode($result['body'], true);
        return $resultBody;
    }

    public static function customerList(array $params, string $partnerCode = null)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/payment-link/customer';
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader($partnerCode), true);
        $resultBody = json_decode($result['body'], true);
        return $resultBody;
    }

    public static function partnerList(array $params, string $partnerCode = null)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/payment-link/partner/list';
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader($partnerCode), true);
        $resultBody = json_decode($result['body'], true);
        return $resultBody;
    }

}
