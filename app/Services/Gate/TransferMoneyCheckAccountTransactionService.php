<?php

namespace App\Services\Gate;

use App\Connection\TransferMoneyCheckAccountTransactionConnection;

class TransferMoneyCheckAccountTransactionService
{

    public function index(array $filter): array
    {
        $query = collect($filter)->only([
            'partnerCode',
        ])
            ->reject(fn ($item) => !$item)
            ->toArray();

        $pagination = collect($filter)->only([
            'limit',
            'page'
        ])->toArray();

        $response = TransferMoneyCheckAccountTransactionConnection::index(compact('query', 'pagination'));

        if (isset($response->errorCode) && $response->errorCode === 0) {
            return [$response->data, $response->meta];
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
