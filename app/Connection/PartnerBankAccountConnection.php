<?php

namespace App\Connection;

use App\Helpers\AuthPartnerHelper;
use App\Helpers\Connection;

class PartnerBankAccountConnection
{

    public static function transferMake(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/v1/service/transfer/make';
        $signature = AuthPartnerHelper::generateSignature($params);
        $params['signature'] = $signature;
        $result = Connection::sendRequest($url, $params, 'POST', AuthPartnerHelper::getHeader());
        $resultBody = json_decode($result['body'], true) ?? [];
        return $resultBody;
    }

    public static function transferVerifyStatus(string $partnerRefId)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/v1/service/transfer/transaction/' . $partnerRefId;
        $result = Connection::sendRequest($url, [], 'GET', AuthPartnerHelper::getHeader(), true);
        $resultBody = json_decode($result['body'], true) ?? [];

        return $resultBody;
    }

}
