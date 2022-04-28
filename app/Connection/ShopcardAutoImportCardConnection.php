<?php
namespace App\Connection;

use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;

class ShopcardAutoImportCardConnection
{
    public static function getList(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/shopcard/auto_import_card/config';
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200 || empty($resultBody->config)) {
            return false;
        }
        return $resultBody;
    }

    public static function getListProvider(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/shopcard/shopcard_provider_config';
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200 || empty($resultBody->data)) {
            return false;
        }
        return $resultBody;
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public static function saveConfigAutoImportCard($params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/shopcard/auto_import_card/config/update';

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }
}
