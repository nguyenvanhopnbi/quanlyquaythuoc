<?php
namespace App\Services\Gate;

use App\Connection\IpnLogConnection;

class IpnLogService
{

    /**
     * @param array $params
     * @return bool|mixed
     */
    public function getList(array $params)
    {
        $limit = isset($params['pagination']['perpage']) ? $params['pagination']['perpage'] : 10;
        $params['offset'] = 0;
        $params['limit'] = $limit;
        $params['pagination']['limit'] = $limit;
        $page = isset($params['pagination']['page']) ? $params['pagination']['page'] : 1;
        if (isset($params['query']['status']) && $params['query']['status'] === 'all') {
            unset($params['query']['status']);
        }
        if (isset($params['query']['startTime'])) {
            $params['query']['startTime'] = strtotime($params['query']['startTime']);
        }
        if (isset($params['query']['endTime'])) {
            $params['query']['endTime'] = strtotime($params['query']['endTime']);
        }
        if ($page > 1) {
            $params['offset'] = ($page - 1) * $limit;
        }
        $data = IpnLogConnection::getList($params);
        $data->meta->perpage = $limit;
        return $data;
    }
    /**
     * @param string $id
     * @return bool|mixed
     */
    public function detail(string $id)
    {
        return IpnLogConnection::detail($id);
    }
}
