<?php

namespace App\Services\Gate;

use App\Connection\TransferMoneyProviderConnection;

class TransferMoneyProviderService
{

    /**
     * @param array $params
     * @return bool|mixed
     */
    public static function getList(array $params)
    {
        $limit = isset($params['pagination']['perpage']) ? $params['pagination']['perpage'] : 10;
        $params['offset'] = 0;
        $params['pagination']['limit'] = $limit;
        $page = isset($params['pagination']['page']) ? $params['pagination']['page'] : 1;
        if ($page > 1) {
            $params['offset'] = ($page - 1) * $limit;
        }
        if (isset($params['query']['startTime'])) {
            $params['query']['startTime'] = strtotime($params['query']['startTime'] . ' 00:00:00');
        }
        if (isset($params['query']['endTime'])) {
            $params['query']['endTime'] = strtotime($params['query']['endTime'] . ' 23:59:59');
        }
        $data = TransferMoneyProviderConnection::getList($params);
        if (isset($data->data)) {
            $data->meta->perpage = $limit;
        }
        return $data;
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function add(array $params)
    {
        return TransferMoneyProviderConnection::add($params);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function edit(int $id, array $params)
    {
        return TransferMoneyProviderConnection::edit($id, $params);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function detail(int $id)
    {
        return TransferMoneyProviderConnection::detail($id);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function delete(array $params)
    {
        return TransferMoneyProviderConnection::delete($params);
    }

}
