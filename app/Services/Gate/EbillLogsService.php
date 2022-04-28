<?php


namespace App\Services\Gate;


use App\Connection\EbillIpnLogsConnection;
use App\Connection\EbillTransactionConnection;
use Illuminate\Support\Facades\Log;

class EbillLogsService
{
    public const MAX_ROW = 100000;
    /**
     * [ ['value' => value_when_call_api, 'value_view'=> Value_show_to_view],[..],... ]
     * @return \string[][]
     */
    public function getAllStatusEbillLogs(){
        return [
            ['value'=>'success','value_view'=>'Success'],
            ['value'=>'error','value_view'=>'Error'],
        ];
    }


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
        if (isset($params['query']['status']) && $params['query']['status'] === 'all') {
            unset($params['query']['status']);
        }
        if (isset($params['query']['startTime'])) {
            $params['query']['startTime'] = strtotime($params['query']['startTime']. ' 00:00:00');
        }
        if (isset($params['query']['endTime'])) {
            $params['query']['endTime'] = strtotime($params['query']['endTime']. ' 23:59:59');
        }
        $data = EbillIpnLogsConnection::getList($params);
        if (isset($data->data)) {
            $data->meta->perpage = $limit;
        }
        return $data;
    }

    /**
     * @param string $id
     * @return bool|mixed
     */
    public function detail(string $id)
    {
        return EbillIpnLogsConnection::detail($id);
    }
}
