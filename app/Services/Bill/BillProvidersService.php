<?php
namespace App\Services\Bill;

use App\Connection\BillProviderConnection;

class BillProvidersService
{
    const PERPAGE = 2;

    /**
     * @param array $params
     * @return bool|mixed
     */
    public function getList(array $params)
    {
        $limit = isset($params['pagination']['perpage']) ? $params['pagination']['perpage'] : 20;
        $params['pagination']['limit'] = $limit;
        $result = BillProviderConnection::getList($params);
        if($result){
            $result->meta->perpage = $result->meta->limit;
            unset($result->meta->limit);
        }

        return $result;
    }

    public function add(array $params)
    {
        return BillProviderConnection::add($params);
    }

    public function edit(int $id, array $params)
    {
        return BillProviderConnection::edit($id, $params);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function detail(int $id)
    {
        return BillProviderConnection::detail($id);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function delete(int $id)
    {
        return BillProviderConnection::delete($id);
    }

}
