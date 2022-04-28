<?php
namespace App\Services\Gate;

use App\Connection\TopupTelcoProviderConnection;

class TopupTelcoProviderService
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
        if (isset($params['public']) && $params['public'] === 'all') {
            unset($params['public']);
        }
        $data = TopupTelcoProviderConnection::getList($params);
        if (isset($data->data)) {
            $data->meta->perpage = $limit;
        }
        return $data;
    }

    public function add(array $params)
    {
        return TopupTelcoProviderConnection::add($params);
    }

    public function edit(int $id, array $params)
    {
        return TopupTelcoProviderConnection::edit($id, $params);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function detail(int $id)
    {
        return TopupTelcoProviderConnection::detail($id);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function delete(int $id)
    {
        return TopupTelcoProviderConnection::delete($id);
    }
}
