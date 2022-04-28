<?php
namespace App\Connection;

use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;

class ShopcardPartnerCardDataConnection
{
    public static function getList(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/shopcard/shopcard_partner_card_data';
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
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/shopcard/shopcard_partner_card_data/detail/'.$id;

        $result = Connection::sendRequest($url, [], 'GET', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }
}
