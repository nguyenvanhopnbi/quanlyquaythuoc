<?php

namespace App\Connection;

use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;
use Log;

class TransferMoneyTransactionConnection
{
    public static function getList(array $params, string $partnerCode = null)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/transfer_money/transfer_transaction_money';

        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader($partnerCode), true);


        $resultBody = json_decode($result['body']);

        Log::info('transfer_money_transaction_list : ', ['url' => $url, 'params' => $params, 'response' => $resultBody]);

        if ($result['status_code'] != 200) {
            return false;
        }
        // dd($result);
        return $resultBody;
    }

    /**
     * @param string $id
     * @return bool|mixed
     */
    public static function detail(string $id)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/transfer_money/transfer_transaction_money/detail/' . $id;
        $result = Connection::sendRequest($url, [], 'GET',AuthenticationHelper::getHeader(), true);

        // dd($result);
        $resultBody = json_decode($result['body']);

        Log::info('transfer_money_transaction_list : ', ['url' => $url, 'transaction_id' => $id, 'response' => $resultBody]);

        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    public static function getTotalTransaction(array $query, string $partnerCode = null)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/transfer_money/transfer_transaction_money/total';

        $result = Connection::sendRequest($url, $query, 'GET', AuthenticationHelper::getHeader($partnerCode));
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function getChartData(array $query): array
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/transfer_money/transfer_transaction_money/chart_data';

        $result = Connection::sendRequest($url, $query, 'GET', AuthenticationHelper::getHeader());

        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }
}
