<?php
namespace App\Services\Gate;

use App\Connection\VirtualAccountConnection;
use Illuminate\Support\Facades\Log;

class VirtualAccountService
{

    /**
     * @param array $params
     * @return bool|mixed
     */
    public static function getList(array $params, string $partnerCode = null)
    {
        Log::info('params in get List ='.json_encode($params));
        $limit = isset($params['pagination']['perpage']) ? $params['pagination']['perpage'] : 20;
        $params['offset'] = 0;
        $params['pagination']['limit'] =  $limit;
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
            $params['query']['startTime'] = strtotime($params['query']['startTime']. ' 00:00:00');
        }
        if (isset($params['query']['endTime'])) {
            $params['query']['endTime'] = strtotime($params['query']['endTime']. ' 23:59:59');
        }

        $data = VirtualAccountConnection::getList($params, $partnerCode);
        if (isset($data->data)) {
            $data->meta->perpage = $limit;
        }
        return $data;
    }

    /**
     * @param string $id
     * @return bool|mixed
     */
    public function detail(string $id)
    {
        return VirtualAccountConnection::detail($id);
    }
}
