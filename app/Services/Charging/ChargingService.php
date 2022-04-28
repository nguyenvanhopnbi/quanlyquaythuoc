<?php
namespace App\Services\Charging;

use App\Connection\ChargingConnection;

class ChargingService
{

    /**
     * @param array $params
     * @return bool|mixed
     */
    public static function getList(array $params, string $partnerCode = null)
    {
        $limit = isset($params['pagination']['perpage']) ? $params['pagination']['perpage'] : 10;
        $params['offset'] = 0;
        $params['pagination']['limit'] = $limit;
        $page = isset($params['pagination']['page']) ? $params['pagination']['page'] : 1;
        if ($page > 1) {
            $params['offset'] = ($page - 1) * $limit;
        }
        if (isset($params['query']['status']) && $params['query']['status'] === 'all') {
            unset($params['query']['status']);
        }
        if (isset($params['query']['telco']) && $params['query']['telco'] === 'all') {
            unset($params['query']['telco']);
        }
        if (isset($params['query']['telco_service_type']) && $params['query']['telco_service_type'] === 'all') {
            unset($params['query']['telco_service_type']);
        }
        if (isset($params['query']['topup_status']) && $params['query']['topup_status'] === 'all') {
            unset($params['query']['topup_status']);
        }
        if (isset($params['query']['startTime'])) {
            $params['query']['startTime'] = strtotime($params['query']['startTime']. ' 00:00:00');
        }
        if (isset($params['query']['endTime'])) {
            $params['query']['endTime'] = strtotime($params['query']['endTime']. ' 23:59:59');
        }
        $data = ChargingConnection::getList($params, $partnerCode);
        if (isset($data->data)) {
            $data->meta->perpage = $limit;
            $data->meta->total_amount = number_format($data->meta->total_amount ?? 0, 0, ',', '.');
        }
        return $data;
    }

    public function getListTransactionExport(array $params)
    {
        $limit = isset($params['pagination']['perpage']) ? $params['pagination']['perpage'] : 20;
        $params['offset'] = 0;
        $params['pagination']['limit'] = $limit;
        $page = isset($params['pagination']['page']) ? $params['pagination']['page'] : 1;
        if (isset($params['query']['status']) && $params['query']['status'] === 'all') {
            unset($params['query']['status']);
        }
        if (isset($params['query']['startTime'])) {
            $params['query']['startTime'] = strtotime($params['query']['startTime']. ' 00:00:00');
        }
        if (isset($params['query']['endTime'])) {
            $params['query']['endTime'] = strtotime($params['query']['endTime']. ' 23:59:59');
        }
        if ($page > 1) {
            $params['offset'] = ($page - 1) * $limit;
        }
        $params['query']['export'] = true;
        $data = ChargingConnection::getList($params);
        $data->meta->perpage = $limit;
        return $data;
    }

    /**
     * @param string $id
     * @return bool|mixed
     */
    public function detail(string $id, string $partnerCode = null)
    {
        return ChargingConnection::detail($id, $partnerCode);
    }

    public function getListTtTransaction($params, string $partnerCode = null)
    {
        return ChargingConnection::getListTtTransaction($params, $partnerCode);
    }

    public function getChartTransaction($params, string $partnerCode = null)
    {
        return ChargingConnection::getChartTransaction($params, $partnerCode);
    }

    public function getChartPieTransaction($params, string $partnerCode = null)
    {
        return ChargingConnection::getChartPieTransaction($params, $partnerCode);
    }

    public function getReportPartnerByDay($params, string $partnerCode = null)
    {
        return ChargingConnection::getReportPartnerByDay($params, $partnerCode);
    }

}
