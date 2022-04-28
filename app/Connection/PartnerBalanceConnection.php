<?php
namespace App\Connection;

use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;

class PartnerBalanceConnection
{
    public static function getList(array $params)
    {
        $url = env('API_URL_PARTNER_SERVICE') . '/api/cms/service/partner_balance';
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader(), true);
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
        $url = env('API_URL_PARTNER_SERVICE') . '/api/cms/service/partner_balance/detail/'.$id;

        $result = Connection::sendRequest($url, [], 'GET', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    /**
     * @param array $params
     * @return bool|mixed
     */
    public static function add(array $params)
    {
        $url = env('API_URL_PARTNER_SERVICE') . '/api/cms/service/partner_balance/add';

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        } 
        return $resultBody;
    }

    /**
     * @param array $params
     * @return bool|mixed
     */
    public static function sub(array $params)
    {
        $url = env('API_URL_PARTNER_SERVICE') . '/api/cms/service/partner_balance/sub';

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200 && $result['status_code'] != 400) {
            return false;
        }

        return $resultBody;
    }
}
