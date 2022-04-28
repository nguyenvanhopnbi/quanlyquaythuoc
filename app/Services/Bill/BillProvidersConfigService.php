<?php
namespace App\Services\Bill;

use App\Connection\BillProviderConfigConnection;

class BillProvidersConfigService
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
        $result = BillProviderConfigConnection::getList($params);
        if($result){
            $result->meta->perpage = $result->meta->limit;
            unset($result->meta->limit);
        }

        return $result;
    }

    public function add(array $params)
    {
        return BillProviderConfigConnection::add($params);
    }

    public function edit(int $id, array $params)
    {
        return BillProviderConfigConnection::edit($id, $params);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function detail(int $id)
    {
        return BillProviderConfigConnection::detail($id);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function delete($params)
    {
        return BillProviderConfigConnection::delete($params);
    }

}
