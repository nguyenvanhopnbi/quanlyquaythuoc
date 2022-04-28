<?php
namespace App\Connection;

use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;

class PartnerConnection
{

    public static function getList(array $params, string $partnerCode = null)
    {
        $url = env('API_URL_PARTNER_SERVICE') . '/api/cms/service/partner/partner';
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader($partnerCode), true);
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
        $url = env('API_URL_PARTNER_SERVICE') . '/api/cms/service/partner/detail/'.$id;

        $result = Connection::sendRequest($url, [], 'GET', AuthenticationHelper::getHeader());
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
    public static function getByPartnerCode(string $partnerCode)
    {
        $url = env('API_URL_PARTNER_SERVICE') . '/api/cms/service/partner/detail/partner_code/'.$partnerCode;
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
        $url = env('API_URL_PARTNER_SERVICE') . '/api/cms/service/partner/partner/delete';
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
        $url = env('API_URL_PARTNER_SERVICE') . '/api/cms/service/partner/partner/create';
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
        $url = env('API_URL_PARTNER_SERVICE') . '/api/cms/service/partner/partner/update/'.$id;
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);

        return $resultBody;
    }
}
