<?php

namespace App\Services\Bill;

use App\Connection\BillCategoryConnection;

class BillCategoryService
{

    /**
     * @param array $params
     * @return bool|mixed
     */
    public function getList(array $params)
    {
        $limit = isset($params['pagination']['perpage']) ? $params['pagination']['perpage'] : 20;
        $params['pagination']['limit'] = $limit;
        $result = BillCategoryConnection::getList($params);
        if ($result) {
            $result->meta->perpage = $result->meta->limit;
            unset($result->meta->limit);
        }
        return $result;
    }

}
