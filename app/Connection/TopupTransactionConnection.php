<?php
namespace App\Connection;

use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;
use App\Helpers\Signature;

class TopupTransactionConnection
{
    public static function getList(array $params, string $partnerCode = null)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/topup/topup_transaction';
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader($partnerCode));

        $resultBody = json_decode($result['body']);
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
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/topup/topup_transaction/detail/'.$id;

        $result = Connection::sendRequest($url, [], 'GET', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function refund(string $transactionId = '')
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/v1/service/topup/transaction/refund';
        $params['transactionId'] = $transactionId; 
        $params['signature'] = Signature::generateAPISignature($params);
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
      
        return $resultBody;
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public static function getTotalTransaction(array $query, string $partnerCode = null)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/topup/topup_transaction/total';

        $result = Connection::sendRequest($url, $query, 'GET', AuthenticationHelper::getHeader($partnerCode));
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function getChartData(array $query, string $partnerCode = null)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/topup/topup_transaction/chart_data';

        $result = Connection::sendRequest($url, $query, 'GET', AuthenticationHelper::getHeader($partnerCode));
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }
}
