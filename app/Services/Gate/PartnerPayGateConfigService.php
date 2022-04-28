<?php
namespace App\Services\Gate;

use App\Connection\PartnerPayGateConfigConnection;

class PartnerPayGateConfigService
{

    /**
     * @param array $params
     * @return bool|mixed
     */
    public static function getList(array $params)
    {
        $limit = isset($params['pagination']['perpage']) ? $params['pagination']['perpage'] : 10;
        $params['offset'] = 0;
        $params['limit'] = $limit;
        $params['pagination']['limit'] = $limit;
        $page = isset($params['pagination']['page']) ? $params['pagination']['page'] : 1;
        if ($page > 1) {
            $params['offset'] = ($page - 1) * $limit;
        }
        if (isset($params['query']['status']) && $params['query']['status'] === 'all') {
            unset($params['query']['status']);
        }
        if (isset($params['query']['account_type']) && $params['query']['account_type'] === 'all') {
            unset($params['query']['account_type']);
        }
        $data = PartnerPayGateConfigConnection::getList($params);
        if (isset($data->data)) {
            $data->meta->perpage = $limit;
        }
        return $data;
    }

    public function getAll()
    {
        $params['pagination']['limit'] = 100;
        $data = PartnerPayGateConfigConnection::getList($params);
        if ($data && $data->errorCode === 0) {
            return $data->data;
        }
        return (object) ['data'=> []];
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
            $params['query']['partner_code'] = $query['q'];
            $params['query']['or'] = 'true';
        }
        $params['query']['status'] = 'active';
        $data = PartnerPayGateConfigConnection::getList($params);
        if (isset($data->data)) {
            foreach ($data->data as $bankvendor) {
                $bankvendor->id = $bankvendor->partner_code;
                $bankvendor->text = $bankvendor->partner_code;
            }
            $result['total'] = count($data->data);
            $result['items'] = $data->data;
        }
        return $result;
    }

    public function add(array $params)
    {
        return PartnerPayGateConfigConnection::add($params);
    }

    public function edit(int $id, array $params)
    {
        return PartnerPayGateConfigConnection::edit($id, $params);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function detail(int $id)
    {
        return PartnerPayGateConfigConnection::detail($id);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function delete(int $id)
    {
        return PartnerPayGateConfigConnection::delete($id);
    }
}
