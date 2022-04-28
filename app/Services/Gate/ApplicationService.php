<?php
namespace App\Services\Gate;

use App\Connection\ApplicationConnection;

class ApplicationService
{

    /**
     * @param array $params
     * @return bool|mixed
     */
    public function getList(array $params, string $partnerCode = null)
    {
        $limit = isset($params['pagination']['perpage']) ? $params['pagination']['perpage'] : 20;
        $params['limit'] = $limit;
        $params['pagination']['limit'] = $limit;
        $page = isset($params['pagination']['page']) ? $params['pagination']['page'] : 1;
        if (isset($params['query']['status']) && $params['query']['status'] === 'all') {
            unset($params['query']['status']);
        }
        if (isset($params['query']['name']) && is_numeric($params['query']['name'])) {
            $id = $params['query']['name'];
            unset($params['query']['name']);
            $params['query']['id'] = $id;
        }
        $data = ApplicationConnection::getList($params, $partnerCode);
        if (isset($data->data)) {
            $data->meta = [
                'limit'=> $limit,
                'page'=> $page,
                'pages'=> ceil($data->total / $limit),
                'total'=>  $data->total,
                'perpage'=> $limit
            ];
        }
        return $data;
    }

    public function getAll(string $partnerCode = '')
    {
        $params['pagination']['limit'] = 100;
        if ($partnerCode) {
            $params['query']['partner_code'] = $partnerCode;
        }
        $data = ApplicationConnection::getList($params);
        if (isset($data->data)) {
            return $data->data;
        }
        return [];
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
        if (isset($query['partnerCode'])) {
            $params['query']['partner_code'] = $query['partnerCode'];
        }
        $params['query']['status'] = 'active';
        $data = ApplicationConnection::getList($params);
        if (isset($data->data)) {
            $result['total'] = count($data->data);
            $result['items'] = $data->data;
        }
        return $result;
    }

    public function getApplicationLookUp()
    {
        $params['pagination']['limit'] = 100;
        $data = ApplicationConnection::getList($params);
        if (isset($data->data)) {
            $result = [];
            foreach ($data->data as $application) {
                $result[$application->id] = $application;
            }
            return $result;
        }
        return [];
    }

    public function add(array $params, string $partnerCode = null)
    {
        return ApplicationConnection::add($params, $partnerCode);
    }

    public function edit(int $id, array $params, string $partnerCode = null)
    {
        return ApplicationConnection::edit($id, $params, $partnerCode);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function detail(int $id)
    {
        return ApplicationConnection::detail($id);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function delete(int $id, string $partnerCode = null)
    {
        return ApplicationConnection::delete($id, $partnerCode);
    }
}
