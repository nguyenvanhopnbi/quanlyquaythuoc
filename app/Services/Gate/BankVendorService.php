<?php
namespace App\Services\Gate;

use App\Connection\BankVendorConnection;

class BankVendorService
{

    /**
     * @param array $params
     * @return bool|mixed
     */
    public function getList(array $params)
    {
        $limit = isset($params['pagination']['perpage']) ? $params['pagination']['perpage'] : 20;
        $params['offset'] = 0;
        $params['limit'] = $limit;
        $params['pagination']['limit'] = $limit;
        $page = isset($params['pagination']['page']) ? $params['pagination']['page'] : 1;
        if ($page > 1) {
            $params['offset'] = ($page - 1) * $limit;
        }
        if (isset($params['query']['public']) && $params['query']['public'] === 'all') {
            unset($params['query']['public']);
        }
        $data = BankVendorConnection::getList($params);
        $data->meta->perpage = $limit;
        return $data;
    }

    public function add(array $params)
    {
        return BankVendorConnection::add($params);
    }

    public function edit(int $id, array $params)
    {
        return BankVendorConnection::edit($id, $params);
    }

    public function getListSource($query)
    {
        $result = [
            'total'=> 0,
            'items'=> [],
        ];
        $params['pagination']['limit'] = 100;
        if (isset($query['q'])) {
            $params['query']['vendor_name'] = $query['q'];
            $params['query']['vendor_code'] = $query['q'];
            $params['query']['or'] = true;
        }
        $params['query']['public'] = 'yes';
        $data = BankVendorConnection::getList($params);
        if (isset($data->data)) {
            foreach ($data->data as $bankvendor) {
                $bankvendor->id = $bankvendor->vendor_code;
                $bankvendor->text = $bankvendor->vendor_code;
            }
            $result['total'] = count($data->data);
            $result['items'] = $data->data;
        }
        return $result;
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function detail(int $id)
    {
        return BankVendorConnection::detail($id);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function delete(int $id)
    {
        return BankVendorConnection::delete($id);
    }
}
