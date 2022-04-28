<?php

namespace App\Services\System;


use App\Models\TransferAccount;

class TransferAccountService
{
    public function accountList(int $page = 1, int $limit = 10, array $filter = [])
    {
        $accounts = TransferAccount::select('*');
        if (isset($filter['account_id'])) {
            $accounts->where('id', $filter['account_id']);
        }
        if (isset($filter['query'])) {
            $accounts->where(function ($where) use ($filter) {
                $where->where('account_name', 'like', '%' . $filter['query'] . '%')
                    ->orWhere('bank_code', '=', $filter['query'])
                    ->orWhere('account_no', 'like', '%' . $filter['query'] . '%');
            });
        }
        $accounts = $accounts->paginate($limit);
        return $accounts;
    }

    public function getById(int $id)
    {
        $account = TransferAccount::where('id', $id)->first();

        return $account;
    }

}
