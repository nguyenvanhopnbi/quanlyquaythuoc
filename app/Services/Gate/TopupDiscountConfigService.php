<?php
namespace App\Services\Gate;

use App\Connection\TopupDiscountConfigConnection;

class TopupDiscountConfigService
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
        if (isset($params['public']) && $params['public'] === 'all') {
            unset($params['public']);
        }
        $data = TopupDiscountConfigConnection::getList($params);
        if (isset($data->data)) {
            $data->meta->perpage = $limit;
        }
        return $data;
    }

    public function add(array $params)
    {
        $config['partnerCode'] = $params['partnerCode'];
        unset($params['partnerCode']);
        unset($params['getUser']);
        $config['config'] = json_encode(['discount'=>$params]);
        return TopupDiscountConfigConnection::add($config);
    }

    public function edit(int $id, array $params)
    {
        $config['partnerCode'] = $params['partnerCode'];
        unset($params['partnerCode']);
        unset($params['getUser']);
        $config['config'] = json_encode(['discount'=>$params]);
        return TopupDiscountConfigConnection::edit($id, $config);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function detail(int $id)
    {
        return TopupDiscountConfigConnection::detail($id);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function delete(int $id)
    {
        return TopupDiscountConfigConnection::delete($id);
    }
}
