<?php
namespace App\Services\Gate;

use App\Connection\PartnerConnection;
use Illuminate\Support\Facades\Log;

class PartnerService
{

    /**
     * @param array $params
     * @return bool|mixed
     */
    public static function getList(array $params, string $partnerCode = null)
    {
        $limit = isset($params['pagination']['perpage']) ? $params['pagination']['perpage'] : 10;
        $params['offset'] = 0;
        $params['limit'] = $limit;
        $params['pagination']['limit'] = $limit;
        $page = isset($params['pagination']['page']) ? $params['pagination']['page'] : 1;
        if ($page > 1) {
            $params['offset'] = ($page - 1) * $limit;
        }
        if (isset($params['query']['status']) && $params['query']['status'] === 'all') {
            unset($params['query']['status']);
        }
        if (isset($params['query']['account_type']) && $params['query']['account_type'] === 'all') {
            unset($params['query']['account_type']);
        }
        $data = PartnerConnection::getList($params, $partnerCode);
        if (isset($data->data)) {
            $data->meta->perpage = $limit;
        }
        return $data;
    }

    public static function getAll()
    {
        $params['pagination']['limit'] = 10000;
        $params['query']['status'] = 'active';
        $data = PartnerConnection::getList($params);
        if ($data && $data->errorCode === 0) {
            return $data->data;
        }
        return (object) ['data'=> []];
    }

    public function getListSource($query)
    {
        $result = [
            'total'=> 0,
            'items'=> [],
        ];
        $params['pagination']['limit'] = 10000;
        if (isset($query['q'])) {
            $params['query']['name'] = $query['q'];
            $params['query']['partner_code'] = $query['q'];
            $params['query']['or'] = 'true';
        }
        if (!isset($query['b'])) {
            $params['query']['status'] = 'active';
        }else{
            $params['query']['all'] = 'true';
        }
        $data = PartnerConnection::getList($params);

        if (isset($data->data)) {
            foreach ($data->data as $bankvendor) {
                if($bankvendor->partner_code != null and !empty($bankvendor->partner_code)){
                    $bankvendor->id = $bankvendor->partner_code;
                    $bankvendor->text = $bankvendor->partner_code;
                }else{
                    unset($bankvendor);
                }

            }
            $result['total'] = count($data->data);
            $result['items'] = $data->data;
        }
        // Log::info('PartnerConnection->getList1111111111', [$result]);
        return $result;
    }

    public function add(array $params)
    {
        $params['balance'] = 0;
        $params['verifyBalance'] = 0;
        $params['partnerCode'] = str_replace(' ', '', $params['partnerCode']);
        return PartnerConnection::add($params);
    }

    public function edit(int $id, array $params)
    {
        if (isset($params['partnerCode'])) {
            $params['partnerCode'] = str_replace(' ', '', $params['partnerCode']);
        }
        return PartnerConnection::edit($id, $params);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function detail(int $id)
    {
        return PartnerConnection::detail($id);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function delete(int $id)
    {
        return PartnerConnection::delete($id);
    }
}
