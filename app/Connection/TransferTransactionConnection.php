<?php

namespace App\Connection;

use App\Helpers\AuthEbillPartnerHelper;
use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;

class TransferTransactionConnection
{
    public static function transferMake(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/v1/service/internal/transfer/make';
        $signature = AuthEbillPartnerHelper::generateSignature($params);
        $params['signature'] = $signature;
        $result = Connection::sendRequest($url, $params, 'POST', AuthEbillPartnerHelper::getHeader());
        $resultBody = json_decode($result['body'], true) ?? [];
        return $resultBody;
    }

    public static function transferVerifyStatus(string $partnerRefId)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/transfer_money/transfer_money_internal_transaction/detail/' . $partnerRefId;
        $result = Connection::sendRequest($url, [], 'GET', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body'], true) ?? [];

        return $resultBody;
    }

}
