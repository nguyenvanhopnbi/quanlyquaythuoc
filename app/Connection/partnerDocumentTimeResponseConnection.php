<?php
namespace App\Connection;

use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;

class partnerDocumentTimeResponseConnection
{
    public static function getList(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/partner-document-time-response';
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
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/partner-document-time-response/'.$id;

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
        $url = env('API_URL_GATE_SERVICE') . '/api/cms/service/partner/detail/partner_code/'.$partnerCode;
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
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/partner-document-time-response/delete';
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
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/partner-document-time-response/create';
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    /**
     * @param int $id
     * @param array $params
     * @return mixed
     */
    // public static function edit(int $id, array $params)
    // {
    //     $url = env('API_URL_GATE_SERVICE') . '/api/v1/partner-co-operate/update';
    //     $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
    //     $resultBody = json_decode($result['body']);
    //     if ($result['status_code'] != 200) {
    //         return false;
    //     }
    //     return $resultBody;
    // }

    public static function edit($id, array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/partner-document-time-response/update';
        $params['id'] = $id;
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }
}
