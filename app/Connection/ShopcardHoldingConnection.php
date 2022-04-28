<?php

namespace App\Connection;

use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;

class ShopcardHoldingConnection
{
    public static function getList(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/shopcard/card_item';
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public static function detail(int $id)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/shopcard/card_item/detail/' . $id;

        $result = Connection::sendRequest($url, [], 'GET', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public static function hold(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/bank-transactions/hold';
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);

        return $resultBody;
    }

    public static function unhold(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/bank-transactions/un-hold';
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);

        return $resultBody;
    }

    public static function extend(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/shopcard/card_item/extend';
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);

        return $resultBody;
    }

    public static function getReportData(string $start, string $end)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/shopcard/report';
        $result = Connection::sendRequest($url, compact('start', 'end'), 'POST', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body'], true);
        return $resultBody;
    }
}
