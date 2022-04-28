<?php
namespace App\Connection;

use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;

class TopupTelcoProviderConnection
{
    // get list config 1
    public static function getListConfig1(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/topup/topup_partner_provider_value_config';

        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        // dump($url);
        // dd($resultBody);
        return $resultBody;
    }

    // get list config 2
    public static function getListConfig2(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/topup/topup_partner_provider_config';
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    public static function getListConfig4(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/topup/topup_provider_value_config';
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }


    // get list config 3
    public static function getListConfig3(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/topup/topup_telco_provider';
        // dd($url);
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader());

        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    public static function getList(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/topup/topup_telco_provider';
        // dd($url);
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
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/topup/topup_telco_provider/detail/'.$id;

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
    public static function deleteConfig1(int $id)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/topup/topup_partner_provider_value_config/delete';
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
    public static function deleteConfig2(int $id)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/topup/topup_partner_provider_config/delete';
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

    public static function deleteConfig4(int $id)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/topup/topup_provider_value_config/delete';
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

    public static function deleteConfig444(int $id)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/topup/topup_telco_provider/delete';
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



    public static function delete(int $id)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/topup/topup_telco_provider/delete';
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
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/topup/topup_telco_provider/create';
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);

        return $resultBody;
    }
    public static function add_config2(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/topup/topup_partner_provider_config/create';
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);

        return $resultBody;
    }
    public static function add_config4(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/topup/topup_provider_value_config/create';
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader(), true);

        $resultBody = json_decode($result['body']);

        return $resultBody;
    }


    public static function add_config_value(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/topup/topup_partner_provider_value_config/create';
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader(), true);
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
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/topup/topup_telco_provider/update/'.$id;
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);

        return $resultBody;
    }

    public static function editConfig1(int $id, array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/topup/topup_partner_provider_value_config/update/'.$id;

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);

        return $resultBody;
    }
    public static function editConfig2(int $id, array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/topup/topup_partner_provider_config/update/'.$id;

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);

        return $resultBody;
    }
    public static function editConfig333(int $id, array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/topup/topup_provider_value_config/update/'.$id;

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);

        return $resultBody;
    }
}
