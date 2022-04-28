<?php
namespace App\Services\Bill;

use App\Connection\BillServiceConnection;

class BillServicesService
{

    /**
     * @param array $params
     * @return bool|mixed
     */
    public function getList(array $params)
    {
        $limit = isset($params['pagination']['perpage']) ? $params['pagination']['perpage'] : 20;
        $params['pagination']['limit'] = $limit;
        $result = BillServiceConnection::getList($params);
        if($result){
            $result->meta->perpage = $result->meta->limit;
            unset($result->meta->limit);
        }
        return $result;
    }

    public function getListSource($query)
    {
        $result = [
            'total'=> 0,
            'items'=> [],
        ];
        $params['pagination']['limit'] = 100;
        if(isset($query['q'])) $params['query']['serviceName'] = $query['q'];
        $params['query']['public'] = 'yes';
        $data = BillServiceConnection::getList($params);
        if (isset($data->data)) {
            foreach ($data->data as $category) {
                $category->id = $category->serviceCode;
            }
            $result['total'] = count($data->data);
            $result['items'] = $data->data;
        }
        return $result;
    }

    public function add(array $params)
    {
        return BillServiceConnection::add($params);
    }

    public function edit(int $id, array $params)
    {
        return BillServiceConnection::edit($id, $params);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function detail(int $id)
    {
        return BillServiceConnection::detail($id);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function delete(int $id)
    {
        return BillServiceConnection::delete($id);
    }

}
