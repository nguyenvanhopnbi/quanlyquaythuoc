<?php
namespace App\Connection;

use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;

class ApplicationConnection
{
    public static function getList(array $params, string $partnerCode = null)
    {
        $url = env('API_URL_PARTNER_SERVICE') . '/v1/applications';
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader($partnerCode));
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
        $url = env('API_URL_PARTNER_SERVICE') . '/v1/application/'.$id;

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
    public static function delete(int $id, string $partnerCode = null)
    {
        $url = env('API_URL_PARTNER_SERVICE') . '/v1/application/delete';
        $params = [
            'id'=> $id
        ];
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader($partnerCode));
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
    public static function add(array $params, string $partnerCode = null)
    {
        $url = env('API_URL_PARTNER_SERVICE') . '/v1/application/create';
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader($partnerCode));
        $resultBody = json_decode($result['body']);

        return $resultBody;
    }

    /**
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public static function edit(int $id, array $params, string $partnerCode = null)
    {
        $url = env('API_URL_PARTNER_SERVICE') . '/v1/application/update';
        $params['id'] = $id;
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader($partnerCode));
        $resultBody = json_decode($result['body']);

        return $resultBody;
    }
}
