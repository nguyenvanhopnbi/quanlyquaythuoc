<?php
namespace App\Connection;

use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;
use App\Helpers\Signature;

class ShopcardDashboardConnection
{
    /**
     * @param int $id
     * @return bool|mixed
     */
    public static function getTotalTransaction(array $query, string $partnerCode = null)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/shopcard/shopcard_transaction/total';

        $result = Connection::sendRequest($url, $query, 'GET', AuthenticationHelper::getHeader($partnerCode));

        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200 || empty($resultBody->data)) {
            return false;
        }

        return $resultBody;
    }

    public static function getChartData(array $query, string $partnerCode = null)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/shopcard/shopcard_transaction/chart_data';

        $result = Connection::sendRequest($url, $query, 'GET', AuthenticationHelper::getHeader($partnerCode));
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200 || empty($resultBody->data)) {
            return false;
        }

        return $resultBody;
    }
}
