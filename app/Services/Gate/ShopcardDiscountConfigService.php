<?php
namespace App\Services\Gate;

use App\Connection\ShopcardDiscountConfigConnection;

class ShopcardDiscountConfigService
{

    /**
     * @param array $params
     * @return bool|mixed
     */
    public function getList(array $params)
    {
        $limit = isset($params['pagination']['perpage']) ? $params['pagination']['perpage'] : 20;
        $params['offset'] = 0;
        $params['pagination']['limit'] = $limit;
        $page = isset($params['pagination']['page']) ? $params['pagination']['page'] : 1;
        if ($page > 1) {
            $params['offset'] = ($page - 1) * $limit;
        }
        if (isset($params['query']['public']) && $params['query']['public'] === 'all') {
            unset($params['query']['public']);
        }
        $data = ShopcardDiscountConfigConnection::getList($params);
        if (isset($data->data)) {
            $data->meta->perpage = $limit;
        }
        return $data;
    }

    public function add(array $params)
    {
        $cardConfig['partner_code'] = $params['partner_code'];
        unset($params['partner_code']);
        $cardConfig['config'] = json_encode(['discount'=> $params]);
        return ShopcardDiscountConfigConnection::add($cardConfig);
    }

    public function edit(int $id, array $params)
    {
        // $cardConfig['partner_code'] = $params['partner_code'];
        // unset($params['partner_code']);
        $cardConfig['config'] = json_encode(['discount'=> $params]);
        return ShopcardDiscountConfigConnection::edit($id, $cardConfig);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function detail(int $id)
    {
        return ShopcardDiscountConfigConnection::detail($id);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function delete(int $id)
    {
        return ShopcardDiscountConfigConnection::delete($id);
    }
}
