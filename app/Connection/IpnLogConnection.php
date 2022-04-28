<?php
namespace App\Connection;

use App\Helpers\Connection;
use App\Helpers\AuthenticationHelper;

class IpnLogConnection
{
    public static function getList(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/ipn-logs';
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
    public static function detail(string $id)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/ipn-log/'.$id;

        $result = Connection::sendRequest($url, [], 'GET', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }
}
