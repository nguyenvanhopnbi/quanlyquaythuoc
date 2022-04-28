<?php
namespace App\Services\Gate;

use App\Connection\ApplicationServiceConfigConnection;

class ApplicationServiceConfigService
{

    /**
     * @param array $params
     * @return bool|mixed
     */
    public function getList(array $params, string $partnerCode = null)
    {
        $limit = isset($params['pagination']['perpage']) ? $params['pagination']['perpage'] : 20;
        $params['limit'] = $limit;
        $params['pagination']['limit'] = $limit;
        $page = isset($params['pagination']['page']) ? $params['pagination']['page'] : 1;
        if (isset($params['status']) && $params['status'] === 'all') {
            unset($params['stauts']);
        }
        $data = ApplicationServiceConfigConnection::getList($params, $partnerCode);
        if (isset($data->data)) {
            $data->meta = [
                'limit'=> $limit,
                'page'=> $page,
                'pages'=> ceil($data->total / $limit),
                'total'=>  $data->total,
                'perpage'=> $limit
            ];
        }
        return $data;
    }

    public function add(array $params, string $partnerCode = null)
    {
        return ApplicationServiceConfigConnection::add($params, $partnerCode);
    }

    public function edit(int $id, array $params, string $partnerCode = null)
    {
        return ApplicationServiceConfigConnection::edit($id, $params, $partnerCode);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function detail(int $id)
    {
        return ApplicationServiceConfigConnection::detail($id);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function delete(int $id, string $partnerCode = null)
    {
        return ApplicationServiceConfigConnection::delete($id, $partnerCode);
    }
}
