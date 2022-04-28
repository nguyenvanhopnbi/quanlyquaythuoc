<?php
namespace App\Services\Bill;

use App\Connection\BillTransactionConnection;

class BillTransactionService
{
    const PERPAGE = 2;

    /**
     * @param array $params
     * @return bool|mixed
     */
    public function getList(array $params, string $partnerCode = null)
    {
        $limit = isset($params['pagination']['perpage']) ? $params['pagination']['perpage'] : 20;
        $params['pagination']['limit'] = $limit;
        if (isset($params['query']['status']) && $params['query']['status'] === 'all') {
            unset($params['query']['status']);
        }
        if (isset($params['query']['startTime'])) {
            $params['query']['startTime'] = strtotime($params['query']['startTime']. ' 00:00:00');
        }
        if (isset($params['query']['endTime'])) {
            $params['query']['endTime'] = strtotime($params['query']['endTime']. ' 23:59:59');
        }
        $result = BillTransactionConnection::getList($params, $partnerCode);
        if($result){
            $result->meta->perpage = $result->meta->limit;
            $result->meta->total_amount = number_format($result->meta->total_amount ?? 0, 0, ',', '.');
            unset($result->meta->limit);
        }

        return $result;
    }


    /**
     * @param int $id
     * @return bool|mixed
     */
    public function detail($transaction_id)
    {
        return BillTransactionConnection::detail($transaction_id);
    }

}
