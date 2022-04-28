<?php
namespace App\Connection;

use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;

class ShopCardProviderConfigConnection
{
    public static function getList(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/shopcard/shopcard_provider_config';
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
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/shopcard/card/detail/'.$id;

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
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/shopcard/shopcard_provider_config/delete';
        $params = [
            'id'=> $id
        ];
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
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
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/shopcard/shopcard_provider_config/create';
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);

        return $resultBody;
    }

    /**
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public static function edit($id, array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/shopcard/shopcard_provider_config/update/'.$id;
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);

        return $resultBody;
    }
}
