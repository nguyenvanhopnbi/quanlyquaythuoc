<?php

namespace App\Services\Gate;

use App\Connection\ShopcardTransactionConnection;

class ShopcardTransactionService
{

    /**
     * @param array $params
     * @return bool|mixed
     */
    public function getList(array $params, string $partnerCode = null)
    {
        $limit = isset($params['pagination']['perpage']) ? $params['pagination']['perpage'] : 10;
        $params['offset'] = 0;
        $params['pagination']['limit'] =  $limit;
        $page = isset($params['pagination']['page']) ? $params['pagination']['page'] : 1;
        if ($page > 1) {
            $params['offset'] = ($page - 1) * $limit;
        }
        if (isset($params['query']['status']) && $params['query']['status'] === 'all') {
            unset($params['query']['status']);
        }
        if (isset($params['query']['vendor']) && $params['query']['vendor'] === 'all') {
            unset($params['query']['vendor']);
        }
        if (isset($params['query']['topup_status']) && $params['query']['topup_status'] === 'all') {
            unset($params['query']['topup_status']);
        }
        if (isset($params['query']['startTime'])) {
            $params['query']['startTime'] = strtotime($params['query']['startTime'] . ' 00:00:00');
        }
        if (isset($params['query']['endTime'])) {
            $params['query']['endTime'] = strtotime($params['query']['endTime'] . ' 23:59:59');
        }
        $data = ShopcardTransactionConnection::getList($params, $partnerCode);
        if (isset($data->data)) {
            $data->meta->perpage = $limit;
            $data->meta->total_amount = number_format($data->meta->total_amount ?? 0, 0, ',', '.');
        }
        return $data;
    }

    /**
     * @param string $id
     * @return bool|mixed
     */
    public function detail(string $id)
    {
        return ShopcardTransactionConnection::detail($id);
    }

    public function getListTransactionExport(array $params)
    {
        $limit = isset($params['pagination']['perpage']) ? $params['pagination']['perpage'] : 10;
        $params['offset'] = 0;
        $params['pagination']['limit'] =  $limit;
        $page = isset($params['pagination']['page']) ? $params['pagination']['page'] : 1;
        if ($page > 1) {
            $params['offset'] = ($page - 1) * $limit;
        }
        if (isset($params['query']['vendor']) && $params['query']['vendor'] === 'all') {
            unset($params['query']['vendor']);
        }
        if (isset($params['query']['status']) && $params['query']['status'] === 'all') {
            unset($params['query']['status']);
        }
        if (isset($params['query']['topup_status']) && $params['query']['topup_status'] === 'all') {
            unset($params['query']['topup_status']);
        }
        if (isset($params['query']['startTime'])) {
            $params['query']['startTime'] = strtotime($params['query']['startTime'] . ' 00:00:00');
        }
        if (isset($params['query']['endTime'])) {
            $params['query']['endTime'] = strtotime($params['query']['endTime'] . ' 23:59:59');
        }
        $params['pagination']['limit'] = 100000;
        $params['query']['export'] = true;
        $data = ShopcardTransactionConnection::getList($params);
        if (isset($data->data)) {
            $data->meta->perpage = $limit;
        }
        return $data;
    }
}
