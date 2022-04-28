<?php
namespace App\Services\Gate;

use App\Connection\ShopcardPartnerCardDataConnection;

class ShopcardPartnerCardDataService
{

    /**
     * @param array $params
     * @return bool|mixed
     */
    public function getList(array $params)
    {
        $limit = isset($params['pagination']['perpage']) ? $params['pagination']['perpage'] : 20;
        $params['offset'] = 0;
        $params['pagination']['limit'] = $limit;
        $page = isset($params['pagination']['page']) ? $params['pagination']['page'] : 1;
        if ($page > 1) {
            $params['offset'] = ($page - 1) * $limit;
        }
        if (isset($params['query']['public']) && $params['query']['public'] === 'all') {
            unset($params['query']['public']);
        }
        if (isset($params['query']['startTime'])) {
            $params['query']['startTime'] = strtotime($params['query']['startTime']. ' 00:00:00');
        }
        if (isset($params['query']['endTime'])) {
            $params['query']['endTime'] = strtotime($params['query']['endTime']. ' 23:59:59');
        }
        $data = ShopcardPartnerCardDataConnection::getList($params);
        if (isset($data->data)) {
            $data->meta->perpage = $limit;
        }
        return $data;
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function detail(int $id)
    {
        return ShopcardPartnerCardDataConnection::detail($id);
    }

     /**
     * @param array $params
     * @return bool|mixed
     */
    public function getListTransactionExport(array $params)
    {
        $limit = isset($params['pagination']['perpage']) ? $params['pagination']['perpage'] : 20;
        $params['offset'] = 0;
        $params['pagination']['limit'] = $limit;
        $page = isset($params['pagination']['page']) ? $params['pagination']['page'] : 1;
        if ($page > 1) {
            $params['offset'] = ($page - 1) * $limit;
        }
        if (isset($params['query']['public']) && $params['query']['public'] === 'all') {
            unset($params['query']['public']);
        }
        if (isset($params['query']['startTime'])) {
            $params['query']['startTime'] = strtotime($params['query']['startTime']. ' 00:00:00');
        }
        if (isset($params['query']['endTime'])) {
            $params['query']['endTime'] = strtotime($params['query']['endTime']. ' 23:59:59');
        }
        $params['pagination']['limit'] = 100000;
        $params['query']['export'] = true;
        $data = ShopcardPartnerCardDataConnection::getList($params);
        if (isset($data->data)) {
            $data->meta->perpage = $limit;
        }
        return $data;
    }
}
