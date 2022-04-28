<?php

namespace App\Connection;

use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;

class BillCategoryConnection
{

    public static function getList(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/bill/bill_service_category';

        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

}