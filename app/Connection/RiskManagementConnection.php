<?php
namespace App\Connection;

use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;

class RiskManagementConnection
{
    public static function getList(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/cc-accounts-whitelist';
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    public static function getListAccountBypassRule(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/cc-accounts-bypass-rule-risk';
        // dd($url);
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    public static function getBlackList(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/cc-accounts-blacklist';
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
    public static function detail($id)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/cc-accounts-whitelist/'.$id;

        $result = Connection::sendRequest($url, [], 'GET', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }
    public static function detailBlacklist($id)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/cc-accounts-blacklist/'.$id;

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
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/cc-accounts-whitelist/delete';
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
    public static function deleteCCAccountBypass(int $id)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/cc-accounts-bypass-rule-risk/delete';
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
    public static function deleteBlackList(int $id)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/cc-accounts-blacklist/delete';
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
    public function add(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/cc-accounts-whitelist/create';
        // dd($url);
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    public static function addNewAccountByPass(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/cc-accounts-bypass-rule-risk/create';
        // dd($url);
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);

        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function addBlacklist(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/cc-accounts-blacklist/create';
        // dd($url);
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
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
    public static function edit(int $id, array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/cc-accounts-whitelist/update';
        $params['id'] = $id;
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);

        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }
    public static function editCCAcountBypass(int $id, array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/cc-accounts-bypass-rule-risk/update';
        $params['id'] = $id;
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);

        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }
    public static function editblacklist(int $id, array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/cc-accounts-blacklist/update';
        $params['id'] = $id;
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);

        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }
}
