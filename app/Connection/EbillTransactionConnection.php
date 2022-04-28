<?php

namespace App\Connection;

use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;

class EbillTransactionConnection
{

    /**
     * @param array $params
     * @return false|mixed
     */

    public static function resendTransaction(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/ebill/ebill-resend-ipn';

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }


    public static function getList(array $params, string $partnerCode = null)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/bill/ebill_transaction';

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
    public static function detail($transaction_id)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/bill/ebill_transaction/detail/' . $transaction_id;

        $result = Connection::sendRequest($url, [], 'GET', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

}
