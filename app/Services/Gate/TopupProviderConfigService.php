<?php
namespace App\Services\Gate;

use App\Connection\TopupProviderConfigConnection;

class TopupProviderConfigService
{

    /**
     * @param array $params
     * @return bool|mixed
     */
    public function getList(array $params)
    {
        $limit = isset($params['pagination']['perpage']) ? $params['pagination']['perpage'] : 20;
        $params['offset'] = 0;
        $params['pagination']['limit'] =  $limit;
        $page = isset($params['pagination']['page']) ? $params['pagination']['page'] : 1;
        if ($page > 1) {
            $params['offset'] = ($page - 1) * $limit;
        }
        if (isset($params['public']) && $params['public'] === 'all') {
            unset($params['public']);
        }
        $data = TopupProviderConfigConnection::getList($params);
        if (isset($data->data)) {
            $data->meta->perpage = $limit;
        }
        return $data;
    }

    public function getListSource($query)
    {
        $result = [
            'total'=> 0,
            'items'=> [],
        ];
        $params['pagination']['limit'] = 100;
        if (isset($query['q'])) {
            $params['query']['name'] = $query['q'];
        }
        $params['query']['status'] = 'active';
        $data = TopupProviderConfigConnection::getList($params);
        if (isset($data->data)) {
            foreach ($data->data as $providerConfig) {
                $providerConfig->id = $providerConfig->providerCode;
            }
            $result['total'] = count($data->data);
            $result['items'] = $data->data;
        }
        return $result;
    }

    public function add(array $params)
    {
        return TopupProviderConfigConnection::add($params);
    }

    public function edit(int $id, array $params)
    {
        return TopupProviderConfigConnection::edit($id, $params);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function detail(int $id)
    {
        return TopupProviderConfigConnection::detail($id);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function delete(int $id)
    {
        return TopupProviderConfigConnection::delete($id);
    }
}
