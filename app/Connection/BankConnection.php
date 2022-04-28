<?php
namespace App\Connection;

use App\Helpers\Connection;
use App\Helpers\AuthenticationHelper;
class BankConnection
{
    public static function getList(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/banks';
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
    public static function detail(int $id)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/bank/'.$id;

        $result = Connection::sendRequest($url, [], 'GET',  AuthenticationHelper::getHeader());
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
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/bank/delete';
        $params = [
            'id'=> $id
        ];
        $result = Connection::sendRequest($url, $params, 'POST',  AuthenticationHelper::getHeader());
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
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/bank/create';
        $result = Connection::sendRequest($url, $params, 'POST',  AuthenticationHelper::getHeader(), true);
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
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/bank/update';
        $params['id'] = $id;
        $result = Connection::sendRequest($url, $params, 'POST',  AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);

        return $resultBody;
    }
}
