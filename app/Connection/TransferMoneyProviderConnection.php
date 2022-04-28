<?php

namespace App\Connection;

use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;
use Log;

class TransferMoneyProviderConnection
{

    public static function getList(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/transfer_money/transfer_money_provider';
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        
//        Log::info('transfer_money_provider_list : ', ['$url' => $url, '$params' => $params, 'response' => $resultBody]);
        
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
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/transfer_money/transfer_money_provider/detail/' . $id;

        $result = Connection::sendRequest($url, [], 'GET', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        
//        Log::info('transfer_money_provider_detail : ', ['$url' => $url, 'id' => $id, 'response' => $resultBody]);
        
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }
    
    /**
     * @param string $id
     * @return bool|mixed
     */
    public static function add(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/transfer_money/transfer_money_provider/create';
        
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        
//        Log::info('transfer_money_provider_add : ', ['$url' => $url, '$params' => $params, 'response' => $resultBody]);
        
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }
    
    /**
     * @param string $id
     * @return bool|mixed
     */
    public static function edit(string $id, array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/transfer_money/transfer_money_provider/update/'. $id;

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        
//        Log::info('transfer_money_provider_edit : ', ['$url' => $url, '$params' => $params, 'response' => $resultBody]);
        
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    /**
     * @param string $id
     * @return bool|mixed
     */
    public static function delete(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/transfer_money/transfer_money_provider/delete';

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        
//        Log::info('transfer_money_provider_delete : ', ['$url' => $url, '$params' => $params, 'response' => $resultBody]);
        
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }
}
