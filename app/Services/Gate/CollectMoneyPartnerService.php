<?php
namespace App\Services\Gate;

use App\Connection\CollectMoneyPartnerConnection;

class CollectMoneyPartnerService
{

    /**
     * @param array $params
     * @return bool|mixed
     */
    public static function getList(array $params)
    {

        $limit = isset($params['pagination']['perpage']) ? $params['pagination']['perpage'] : 20;
        $params['limit'] = $limit;
        $page = isset($params['page']) ? $params['page'] : 1;
        $params['pagination']['limit'] = $limit;

        if (isset($params['query']['status']) && $params['query']['status'] === 'all') {
            unset($params['query']['status']);
        }
        $data = CollectMoneyPartnerConnection::getList($params);
        if (isset($data->data)) {
            $data->meta->perpage =  $limit;
        }
        return $data;
    }

    public function add(array $params)
    {
        return CollectMoneyPartnerConnection::add($params);
    }

    public function edit(int $id, array $params)
    {
        return CollectMoneyPartnerConnection::edit($id, $params);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function detail(int $id)
    {
        return CollectMoneyPartnerConnection::detail($id);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function delete(int $id)
    {
        return CollectMoneyPartnerConnection::delete($id);
    }
}
