<?php

namespace App\Connection;

use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Log;

class TransferMoneyCheckAccountTransactionConnection
{
    public static function index(array $params)
    {
        $query = collect($params['filter'])->only([
            'transactionId',
            'partnerRefId',
            'accountNo',
            'partnerCode',
            'status',
            'checkAccountStatus',
            'bankCode',
            'export',
            'startTime',
            'endTime',
        ])->toArray();
        if (!empty($query['startTime'])) {
            $query['startTime'] = Carbon::createFromFormat('Y-m-d', $query['startTime'])->startOfDay()->timestamp;
        }
        if (!empty($query['endTime'])) {
            $query['endTime'] = Carbon::createFromFormat('Y-m-d', $query['endTime'])->endOfDay()->timestamp;
        }

        $pagination['page'] = $params['page'] ?? 1;
        $pagination['limit'] = $params['limit'] ?? 1;

        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/transfer_money/check_account_transaction';
        $result = Connection::sendRequest($url, compact('query', 'pagination'), 'GET', AuthenticationHelper::getHeader());

        $result = json_decode($result['body']);

        if (isset($result->errorCode) && $result->errorCode === 0) {
            return [$result->data, $result->meta];
        } else {
            return [[], (object) [
                'page' => 1,
                'limit' => 1,
                'total' => 1,
                'pages' => 1,
            ]];
        }
    }
    public static function getListExport(array $params)
    {
        $query = collect($params['filter'])->only([
            'transactionId',
            'partnerRefId',
            'accountNo',
            'partnerCode',
            'status',
            'checkAccountStatus',
            'bankCode',
            'export',
            'startTime',
            'endTime',
        ])->toArray();
        if (!empty($query['startTime'])) {
            $query['startTime'] = Carbon::createFromFormat('Y-m-d', $query['startTime'])->startOfDay()->timestamp;
        }
        if (!empty($query['endTime'])) {
            $query['endTime'] = Carbon::createFromFormat('Y-m-d', $query['endTime'])->endOfDay()->timestamp;
        }

        $pagination['page'] = $params['page'] ?? 1;
        $pagination['limit'] = $params['limit'] ?? 10000;

        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/transfer_money/check_account_transaction';
        $result = Connection::sendRequest($url, compact('query', 'pagination'), 'GET', AuthenticationHelper::getHeader());

        $result = json_decode($result['body']);

        if (isset($result->errorCode) && $result->errorCode === 0) {
            return [$result->data, $result->meta];
        } else {
            return [[], (object) [
                'page' => 1,
                'limit' => 1,
                'total' => 1,
                'pages' => 1,
            ]];
        }
    }
}
