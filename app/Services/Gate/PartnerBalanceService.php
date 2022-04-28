<?php
namespace App\Services\Gate;

use App\Connection\PartnerBalanceConnection;

class PartnerBalanceService
{

    /**
     * @param array $params
     * @return bool|mixed
     */
    public function getList(array $params)
    {
        $limit = isset($params['pagination']['perpage']) ? $params['pagination']['perpage'] : 10;
        $params['offset'] = 0;
        $params['pagination']['limit'] = $limit;
        if (isset($params['query']['type']) && $params['query']['type'] === 'all') {
            unset($params['query']['type']);
        }
        if (isset($params['query']['startTime'])) {
            $params['query']['startTime'] = strtotime($params['query']['startTime']. ' 00:00:00');
        }
        if (isset($params['query']['endTime'])) {
            $params['query']['endTime'] = strtotime($params['query']['endTime']. ' 23:59:59');
        }
        $data = PartnerBalanceConnection::getList($params);
        if (isset($data->data)) {
            $data->meta->perpage = $limit;
        }
        return $data;
    }

    public function add(array $params)
    {
        if (auth()->check()) {
            $params['adminEmail'] = auth()->user()->email;
            return PartnerBalanceConnection::add($params);
        }
        // Log::error('user not login');
        return ['success'=> false, 'errorCode'=> 403, 'message'=> 'Thông tin user không đúng'];
    }

    public function sub(array $params)
    {
        if (auth()->check()) {
            $params['adminEmail'] = auth()->user()->email;
            return PartnerBalanceConnection::sub($params);
        }
        // Log::error('user not login');
        return ['success'=> false, 'errorCode'=> 403, 'message'=> 'Thông tin user không đúng'];
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function detail(int $id)
    {
        return PartnerBalanceConnection::detail($id);
    }
}
