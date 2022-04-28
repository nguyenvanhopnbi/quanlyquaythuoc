<?php
namespace App\Services\Gate;

use App\Connection\PartnerBankVendorConnection;

class PartnerBankVendorService
{

    /**
     * @param array $params
     * @return bool|mixed
     */
    public function getList(array $params)
    {
        $limit = isset($params['pagination']['perpage']) ? $params['pagination']['perpage'] : 10;
        $params['offset'] = 0;
        $params['limit'] = $limit;
        $params['pagination']['limit'] = $limit;
        $page = isset($params['pagination']['page']) ? $params['pagination']['page'] : 1;
        if ($page > 1) {
            $params['offset'] = ($page - 1) * $limit;
        }
        if (isset($params['public']) && $params['public'] === 'all') {
            unset($params['public']);
        }
        $data = PartnerBankVendorConnection::getList($params);
        $data->meta->perpage = $limit;
        return $data;
    }

    public function add(array $params)
    {
        return PartnerBankVendorConnection::add($params);
    }

    public function edit(int $id, array $params)
    {
        return PartnerBankVendorConnection::edit($id, $params);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function detail(int $id)
    {
        return PartnerBankVendorConnection::detail($id);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function delete(int $id)
    {
        return PartnerBankVendorConnection::delete($id);
    }
}
