<?php
namespace App\Connection;

use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;

class ApplicationServiceConfigConnection
{
    public static function getList(array $params, string $partnerCode = null)
    {

        $url = env('API_URL_PARTNER_SERVICE') . '/v1/application-services-configs';
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
        $url = env('API_URL_PARTNER_SERVICE') . '/v1/application-services-config/'.$id;

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
        $url = env('API_URL_PARTNER_SERVICE') . '/v1/application-services-config/delete';
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
        $url = env('API_URL_PARTNER_SERVICE') . '/v1/application-services-config/create';
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
        $url = env('API_URL_PARTNER_SERVICE') . '/v1/application-services-config/update';
        $params['id'] = $id;
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader($partnerCode));
        $resultBody = json_decode($result['body']);

        return $resultBody;
    }
}
