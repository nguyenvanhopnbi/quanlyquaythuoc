<?php

namespace App\Services\Gate;

use App\Connection\TransferMoneyCheckAccountBankConnection;

class TransferMoneyCheckAccountBankService
{

    public function search(array $filter)
    {
        $query = collect($filter)->only([
            'bankCode',
            'accountNo',
            'accountType',
            'accountName',
        ])
            ->reject(fn ($item) => !$item)
            ->toArray();

        $response = TransferMoneyCheckAccountBankConnection::search($query);

        if (isset($response->errorCode) && $response->errorCode === 0) {
            return $response->accountInfo;
        }

        return false;
    }
}
