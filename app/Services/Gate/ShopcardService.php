<?php
namespace App\Services\Gate;

use App\Connection\ShopcardConnection;
use Illuminate\Support\Str;

class ShopcardService
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
        $page = isset($params['pagination']['page']) ? $params['pagination']['page'] : 1;
        if ($page > 1) {
            $params['offset'] = ($page - 1) * $limit;
        }
        if (isset($params['query']['public']) && $params['query']['public'] === 'all') {
            unset($params['query']['public']);
        }
        if (isset($params['query']['value']) && $params['query']['value'] === 'all') {
            unset($params['query']['value']);
        }
        if (isset($params['query']['vendor']) && $params['query']['vendor'] === 'all') {
            unset($params['query']['vendor']);
        }
        $data = ShopcardConnection::getList($params);
        if (isset($data->data)) {
            $data->meta->perpage = $limit;
        }
        return $data;
    }

    public function add(array $params)
    {
        $params['productCode'] = Str::slug($params['productCode']);
        return ShopcardConnection::add($params);
    }

    public function getAll()
    {
        $params['pagination']['limit'] = 500;
        $data = ShopcardConnection::getList($params);
        if (isset($data->data)) {
            return $data->data;
        }
        return [];
    }

    public function edit(int $id, array $params)
    {
        return ShopcardConnection::edit($id, $params);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function detail(int $id)
    {
        return ShopcardConnection::detail($id);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function delete(int $id)
    {
        return ShopcardConnection::delete($id);
    }

    public function getListTransactionExport(array $params)
    {
        if (isset($params['query']['public']) && $params['query']['public'] === 'all') {
            unset($params['query']['public']);
        }
        if (isset($params['query']['value']) && $params['query']['value'] === 'all') {
            unset($params['query']['value']);
        }
        if (isset($params['query']['vendor']) && $params['query']['vendor'] === 'all') {
            unset($params['query']['vendor']);
        }
        $params['query']['export'] = true;
        $params['pagination']['limit'] = 100000;
        $data = ShopcardConnection::getList($params);
        return $data;
    }

    public function getListCardForLookUp()
    {
        $params['limit'] = 1000;
        $cards = ShopcardConnection::getList($params);
        if (isset($cards->data)) {
            $cardByProductCode = [];
            foreach ($cards->data as $card) {
                $cardByProductCode[$card->product_code] = $card;
            }
            return $cardByProductCode;
        } else {
            return [];
        }
    }
}
