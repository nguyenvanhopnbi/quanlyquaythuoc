<?php
namespace App\Connection;

use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;
use Log;

class EbillDashboardTransactionConnection
{
    public static function getList(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/transfer_money/transfer_transaction_money';
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader());

        $resultBody = json_decode($result['body']);

        Log::info('ebill_transaction_list_dashboard : ', ['url' => $url, 'params' => $params, 'response' => $resultBody]);

        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    /**
     * @param string $id
     * @return bool|mixed
     */
    public static function detail(string $id)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/transfer_money/transfer_transaction_money/detail/'.$id;
        $result = Connection::sendRequest($url, [], 'GET', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);

        Log::info('ebill_transaction_list_dashboard : ', ['url' => $url, 'transaction_id' => $id, 'response' => $resultBody]);

        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    public static function getTotalTransaction(array $query, string $partnerCode = null)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/bill/ebill_transaction/total';

        $result = Connection::sendRequest($url, $query, 'GET', AuthenticationHelper::getHeader($partnerCode));
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function getChartData(array $query, string $partnerCode = null)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/bill/ebill_transaction/chart_data';
        Log::info('query chart data Ebill Doashboard='.json_encode($query));
        $result = Connection::sendRequest($url, $query, 'GET', AuthenticationHelper::getHeader($partnerCode));
        Log::info('result send request Ebill Doashboard = '.json_encode($result));
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }
}
