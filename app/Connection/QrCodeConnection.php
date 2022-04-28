<?php
namespace App\Connection;

use App\Helpers\Connection;
use App\Helpers\AuthenticationHelper;
class QrCodeConnection
{
    public static function getList(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/cms/virtual-accounts/';
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }


    public static function add(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/cms/virtual-accounts/';
        $result = Connection::sendRequest($url, $params, 'POST',  AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);

        return $resultBody;
    }

    /**
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public static function edit($accountID, array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/cms/virtual-accounts/' . $accountID;
        $result = Connection::sendRequest($url, $params, 'POST',  AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);

        return $resultBody;
    }
}
