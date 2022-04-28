<?php
namespace App\Connection;

use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;

class PartnerVendorConnection
{

    public static function getListVendorMethod(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/partner-payment-method-vendors';
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    public static function addnewtVendorMethod(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/partner-payment-method-vendor/create';
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);

        // if ($result['status_code'] != 200) {
        //     return false;
        // }

        return $resultBody;
    }

    public static function updateVendorMethod(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/partner-payment-method-vendor/update';
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        // if ($result['status_code'] != 200) {
        //     return false;
        // }

        return $resultBody;
    }

    public static function deleteVendorMethod(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/partner-payment-method-vendor/delete';
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function getList(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/cms/service/partner/paygate/vendor-configs';
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
        $url = env('API_URL_GATE_SERVICE') . '/api/cms/service/partner/paygate/vendor-config/'.$id;

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
        $url = env('API_URL_GATE_SERVICE') . '/api/cms/service/partner/paygate/vendor-config/delete';
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
        $url = env('API_URL_GATE_SERVICE') . '/api/cms/service/partner/paygate/vendor-config/create';
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
        $url = env('API_URL_GATE_SERVICE') . '/api/cms/service/partner/paygate/vendor-config/update';
        $params['id'] = $id;
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);

        return $resultBody;
    }
}
