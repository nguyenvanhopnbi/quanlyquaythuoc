<?php
namespace App\Connection;

use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;

class PartnerTransactionConnection
{
    public static function getList(array $params)
    {
        $url = env('API_URL_PARTNER_SERVICE') . '/api/cms/service/partner/partner_transaction';
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader());
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
    public static function detail(string $id)
    {
        $url = env('API_URL_PARTNER_SERVICE') . '/api/cms/service/partner/partner_transaction/detail/'.$id;

        $result = Connection::sendRequest($url, [], 'GET', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

}
