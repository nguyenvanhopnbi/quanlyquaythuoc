<?php

namespace App\Services\Gate;

use App\Connection\TransferMoneyConfigFeeConnection;

class TransferMoneyConfigFeeService
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

        $response = TransferMoneyConfigFeeConnection::index(compact('query', 'pagination'));

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

    public function create(array $params)
    {
        return TransferMoneyConfigFeeConnection::create($params);
    }

    public function show($id)
    {
        return TransferMoneyConfigFeeConnection::show($id);
    }

    public function update($id, array $params)
    {
        return TransferMoneyConfigFeeConnection::update($id, $params);
    }

    public function destroy($id)
    {
        return TransferMoneyConfigFeeConnection::delete($id);
    }
}
