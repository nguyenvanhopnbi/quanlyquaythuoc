<?php

namespace App\Connection;

use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;
use Illuminate\Support\Facades\Log;

class VirtualAccountConnection
{

    public static function getList(array $params, string $partnerCode = null)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/virtual/virtual_account';

        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader($partnerCode));
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
    public static function detail($id)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/virtual/virtual_account/detail/' . $id;

        $result = Connection::sendRequest($url, [], 'GET', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }
}
