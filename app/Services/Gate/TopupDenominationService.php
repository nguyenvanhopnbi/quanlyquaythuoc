<?php
namespace App\Services\Gate;

use App\Connection\TopupDenominationConnection;

class TopupDenominationService
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
        if (isset($params['query']['telco']) && $params['query']['telco'] === 'all') {
            unset($params['query']['telco']);
        }
        $data = TopupDenominationConnection::getList($params);
        if (isset($data->data)) {
            $data->meta->perpage = $limit;
        }
        return $data;
    }

    public function add(array $params)
    {
        $params['public'] = isset($params['public']) ? 'yes' : 'no';
        return TopupDenominationConnection::add($params);
    }

    public function edit(int $id, array $params)
    {
        $params['public'] = isset($params['public']) ? 'yes' : 'no';
        return TopupDenominationConnection::edit($id, $params);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function detail(int $id)
    {
        return TopupDenominationConnection::detail($id);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function delete(int $id)
    {
        return TopupDenominationConnection::delete($id);
    }
}
