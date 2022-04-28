<?php

namespace App\Connection;

use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;
use Log;

class updateTransactionMoneyConnection
{



    public static function update($params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/transfer_money/transfer_transaction_money/update';
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());

        $resultBody = json_decode($result['body']);

        // Log::info('transfer_money_config_update: ', ['url' => $url, 'params' => $params, 'response' => $resultBody]);

        if ($result['status_code'] == 200) {
            return [
                'success' => true,
                'data' => $resultBody,
            ];
        }
        return [
            'success' => false,
            'data' => $resultBody,
        ];
    }
}
