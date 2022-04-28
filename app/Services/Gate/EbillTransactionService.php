<?php
namespace App\Services\Gate;

use App\Connection\EbillTransactionConnection;
use App\Connection\ShopcardConnection;
use Illuminate\Support\Facades\Log;

class EbillTransactionService
{
    public const MAX_ROW = 30000;
    /**
     * @param array $params
     * @return bool|mixed
     */
    public function getList(array $params, string $partnerCode = null)
    {
        $limit = isset($params['pagination']['perpage']) ? $params['pagination']['perpage'] : 20;
        $params['offset'] = 0;
        $params['pagination']['limit'] = $limit;
        $page = isset($params['pagination']['page']) ? $params['pagination']['page'] : 1;
        if ($page > 1) {
            $params['offset'] = ($page - 1) * $limit;
        }
        if (isset($params['query']['type']) && $params['query']['type'] === 'all') {
            unset($params['query']['type']);
        }
        if (isset($params['query']['status']) && $params['query']['status'] === 'all') {
            unset($params['query']['status']);
        }
        if (isset($params['query']['startTime'])) {
            $params['query']['startTime'] = strtotime($params['query']['startTime']);
        }
        if (isset($params['query']['endTime'])) {
            $params['query']['endTime'] = strtotime($params['query']['endTime']);
        }
//        dd($params, $partnerCode);
        $data = EbillTransactionConnection::getList($params, $partnerCode);
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
        return EbillTransactionConnection::detail($id);
    }


    /**
     * @param array $params
     * @return false|mixed
     */
    public function getListTransactionExport(array $params)
    {
        if (isset($params['query']['type']) && $params['query']['type'] === 'all') {
            unset($params['query']['type']);
        }
        if (isset($params['query']['status']) && $params['query']['status'] === 'all') {
            unset($params['query']['status']);
        }
        if (isset($params['query']['startTime'])) {
            $params['query']['startTime'] = strtotime($params['query']['startTime']. ' 00:00:00');
        }
        if (isset($params['query']['endTime'])) {
            $params['query']['endTime'] = strtotime($params['query']['endTime']. ' 23:59:59');
        }

        $params['query']['export'] = true;
        $params['pagination']['limit'] = self::MAX_ROW;
        $data = EbillTransactionConnection::getList($params);


        return $data;
    }
}
