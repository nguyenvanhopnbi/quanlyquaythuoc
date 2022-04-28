<?php
namespace App\Connection;

use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;

class HistoryRiskManagerConnection
{
    public static function getList(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/cc-history-manager-risk';
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }
    public static function detail($id)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/cc-rule-special/'.$id;

        $result = Connection::sendRequest($url, [], 'GET', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function add(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/cc-rule-special/create';
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }
    public static function delete(int $id)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/cc-rule-special/delete';
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

    public static function edit(int $id, array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/cc-rule-special/update';
        $params['id'] = $id;
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

}
