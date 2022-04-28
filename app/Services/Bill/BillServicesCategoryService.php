<?php
namespace App\Services\Bill;

use App\Connection\BillServicesCategoryConnection;

class BillServicesCategoryService
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
        $result = BillServicesCategoryConnection::getList($params);
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
        if(isset($query['q'])) $params['query']['categoryName'] = $query['q'];
        $params['query']['public'] = 'yes';
        $data = BillServicesCategoryConnection::getList($params);
        if (isset($data->data)) {
            foreach ($data->data as $category) {
                $category->id = $category->categoryCode;
            }
            $result['total'] = count($data->data);
            $result['items'] = $data->data;
        }
        return $result;
    }

    public function add(array $params)
    {
        return BillServicesCategoryConnection::add($params);
    }

    public function edit(int $id, array $params)
    {
        return BillServicesCategoryConnection::edit($id, $params);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function detail(int $id)
    {
        return BillServicesCategoryConnection::detail($id);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function delete($params)
    {
        return BillServicesCategoryConnection::delete($params);
    }

}
