<?php

namespace App\Connection;

use App\Helpers\{AuthenticationHelper, Connection, Signature};

class BillServiceConnection
{


    public static function getListIpnLogs(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/transfer_money/firm_banking_ipn_logs';

        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }


    public static function getListTransferInternalMoney(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/transfer_money/transfer_money_internal_transaction';

        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }


    public static function ImportVAProvider(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/bill/ebill_virtual_account_providers/create';

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());

        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function getList(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/bill/bill_service';

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
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/bill/bill_service/detail/' . $id;

        $result = Connection::sendRequest($url, [], 'GET', AuthenticationHelper::getHeader());
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
    public static function delete(int $id)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/bill/bill_service/delete/' . $id;

        $result = Connection::sendRequest($url, [], 'POST', AuthenticationHelper::getHeader());
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
    public static function add(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/bill/bill_service/create';

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);

        return $resultBody;
    }

    /**
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public static function edit(int $id, array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/bill/bill_service/update/' . $id;

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);

        return $resultBody;
    }

    public static function refund($transactionId)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/v1/service/transfer/transaction/refund';

        $result = Connection::sendRequest($url, [
            'transactionId' => $transactionId,
            'signature' => Signature::generateAPISignature(['transactionId' => $transactionId]),
        ], 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);

        return $resultBody;
    }
}
