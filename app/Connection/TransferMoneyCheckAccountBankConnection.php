<?php

namespace App\Connection;

use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;
use Log;

class TransferMoneyCheckAccountBankConnection
{
    public static function search(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/transfer_money/check_account_info';
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader());

        $resultBody = json_decode($result['body']);

        Log::info('transfer_money_config_index : ', ['url' => $url, 'params' => $params, 'response' => $resultBody]);

        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    public static function show($id)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/transfer_money/transfer_money_fee_config/detail/' . $id;
        $result = Connection::sendRequest($url, [], 'GET', AuthenticationHelper::getHeader());

        $resultBody = json_decode($result['body']);

        Log::info('transfer_money_config_show : ', ['url' => $url, 'response' => $resultBody]);

        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    public static function create(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/transfer_money/transfer_money_fee_config/create';
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());

        $resultBody = json_decode($result['body']);

        Log::info('transfer_money_config_create: ', ['url' => $url, 'params' => $params, 'response' => $resultBody]);

        if ($result['status_code'] == 200) {
            return [
                'success' => true,
                'data' => $resultBody,
            ];
        }
        return [
            'success' => false,
            'data' => $resultBody,
        ];
    }

    public static function update($id, array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/transfer_money/transfer_money_fee_config/update/' . $id;
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());

        $resultBody = json_decode($result['body']);

        Log::info('transfer_money_config_update: ', ['url' => $url, 'params' => $params, 'response' => $resultBody]);

        if ($result['status_code'] == 200) {
            return [
                'success' => true,
                'data' => $resultBody,
            ];
        }
        return [
            'success' => false,
            'data' => $resultBody,
        ];
    }

    public static function delete($id)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/transfer_money/transfer_money_fee_config/delete';
        $result = Connection::sendRequest($url, compact('id'), 'POST', AuthenticationHelper::getHeader());

        $resultBody = json_decode($result['body']);

        Log::info('transfer_money_config_delete: ', ['url' => $url, 'response' => $resultBody]);

        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }
}
