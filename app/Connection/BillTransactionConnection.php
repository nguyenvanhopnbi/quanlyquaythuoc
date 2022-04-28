<?php

namespace App\Connection;

use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;

class BillTransactionConnection
{

    public static function getList(array $params, string $partnerCode = null)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/bill/bill_transaction';

        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader($partnerCode), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function getReportDashboard(array $params, string $partnerCode = null)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/bill/bill_transaction/total';

        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader($partnerCode));

        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }
    public static function getDayChart(array $params, string $partnerCode = null)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/bill/bill_transaction/chart_data';

        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader($partnerCode));
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
    public static function detail($transaction_id)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/bill/bill_transaction/detail/' . $transaction_id;

        $result = Connection::sendRequest($url, [], 'GET', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

}
