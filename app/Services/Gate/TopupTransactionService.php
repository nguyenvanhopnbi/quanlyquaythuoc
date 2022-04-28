<?php

namespace App\Services\Gate;

use App\Connection\TopupTransactionConnection;
use DateInterval;
use DatePeriod;
use DateTime;
use Log;

class TopupTransactionService
{

    /**
     * @param array $params
     * @return bool|mixed
     */
    public function getList(array $params, string $partnerCode = null)
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
        if (isset($params['query']['provider_code']) && $params['query']['provider_code'] === 'all') {
            unset($params['query']['provider_code']);
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
            $params['query']['startTime'] = strtotime($params['query']['startTime'] . ' 00:00:00');
        }
        if (isset($params['query']['endTime'])) {
            $params['query']['endTime'] = strtotime($params['query']['endTime'] . ' 23:59:59');
        }
        $data = TopupTransactionConnection::getList($params, $partnerCode);
        if (isset($data->data)) {
            $data->meta->perpage = $limit;
            $data->meta->total_amount = number_format($data->meta->total_amount ?? 0, 0, ',', '.');
        }
        return $data;
    }

    /**
     * @param string $id
     * @return bool|mixed
     */
    public function detail(string $id)
    {
        return TopupTransactionConnection::detail($id);
    }

    public function getListTransactionExport($params)
    {
        if (isset($params['query']['status']) && $params['query']['status'] === 'all') {
            unset($params['query']['status']);
        }
        if (isset($params['query']['topup_status']) && $params['query']['topup_status'] === 'all') {
            unset($params['query']['topup_status']);
        }
        if (isset($params['query']['provider_code']) && $params['query']['provider_code'] === 'all') {
            unset($params['query']['provider_code']);
        }
        if (isset($params['query']['telco']) && $params['query']['telco'] === 'all') {
            unset($params['query']['telco']);
        }
        if (isset($params['query']['telco_service_type']) && $params['query']['telco_service_type'] === 'all') {
            unset($params['query']['telco_service_type']);
        }
        if (isset($params['query']['startTime'])) {
            $params['query']['startTime'] = strtotime($params['query']['startTime'] . ' 00:00:00');
        }
        if (isset($params['query']['endTime'])) {
            $params['query']['endTime'] = strtotime($params['query']['endTime'] . ' 23:59:59');
        }
        $params['query']['export'] = true;
        $data = TopupTransactionConnection::getList($params);
        return $data;
    }

    public function refund(string $transactionId = '')
    {
        $result = TopupTransactionConnection::refund($transactionId);
        if ($result->errorCode === 0) {
            return ['success' => true, 'message' => 'Refund ipn thành công'];
        } else {
            return ['success' => false, 'message' => 'Refund không thành công, vui lòng thử lại sau', 'code' => $result->errorCode];
        }
    }

    public function getChartTransaction(array $params, string $partnerCode = null)
    {
        $report = [];
        if (isset($params['startDate'])) {
            $params['query']['startTime'] = strtotime($params['startDate'] . ' 00:00:00');
        } else {
            $params['query']['startTime'] = strtotime('01/01/' . date('Y') . ' 00:00:00');
        }
        if (isset($params['endDate'])) {
            $params['query']['endTime'] = strtotime($params['endDate'] . ' 23:59:59');
        } else {
            $params['query']['endTime'] = strtotime(date('m/d/Y') . ' 23:59:59');
        }
        $params['query']['status'] = 'success';
        if (isset($params['partner_code'])) {
            $params['query']['partner_code'] = $params['partner_code'];
        }
        $data = TopupTransactionConnection::getChartData($params['query'], $partnerCode);
        if (isset($data)) {
            $timeFilter['startTime'] = $params['query']['startTime'];
            $timeFilter['endTime'] = $params['query']['endTime'];
            $report = $this->buildLineChart($data, $timeFilter);
        }
        return ['data' => $report];
    }

    private function buildLineChart(array $transactions, array $timeFilter)
    {
        if (is_null($transactions)) {
            return false;
        }
        $transactions = collect($transactions);
        $period = $this->getDayByDateSelect($timeFilter);

        return [
            'head' => $period->toArray(),
            'value' => $period
                ->mapWithKeys(fn ($item) => [$item => collect($transactions->firstWhere('requestTime', $item))])
                ->pluck('sumAmount')
                ->transform(fn ($item) => isset($item) ? ((int) $item) : 0)
                ->toArray(),
            'count' => number_format($transactions->sum('countTransactions'), 0, '.', '.'),
            'sum' => number_format($transactions->sum('sumAmount'), 0, ',', '.')
        ];
    }

    private function getDayByDateSelect($timeFilter)
    {
        $period = new DatePeriod(
            (new DateTime())->setTimestamp($timeFilter['startTime']),
            new DateInterval('P1D'),
            (new DateTime())->setTimestamp($timeFilter['endTime']),
        );
        return collect($period)->map(fn ($item) => $item->format('Y-m-d'));
    }

    public function getReportPartnerByDay(array $params, string $partnerCode = null)
    {
        $report = [];
        if (isset($params['query']['startDate'])) {
            $filter['query']['startTime'] = strtotime($params['query']['startDate'] . ' 00:00:00');
        } else {
            $filter['query']['startTime'] = strtotime('01/01/' . date('Y') . ' 00:00:00');
        }
        if (isset($params['query']['endDate'])) {
            $filter['query']['endTime'] = strtotime($params['query']['endDate'] . ' 23:59:59');
        } else {
            $filter['query']['endTime'] = strtotime(date('m/d/Y') . ' 23:59:59');
        }
        $filter['query']['status'] = 'success';
        if ($params['partner_code'] && $params['partner_code'] !== 'all') {
            $filter['query']['partner_code'] = $params['partner_code'];
        }
        $transaction = TopupTransactionConnection::getTotalTransaction($filter, $partnerCode);
        if (isset($transaction)) {
            $report = $this->buildFlashDashboard($transaction, $params['partner_code']);
        }
        return $report;
    }

    private function buildFlashDashboard(array $transactions, $partnerCode)
    {
        $data = [];
        if ($partnerCode === 'all') {
            $partnerCode = 'Tất cả';
            $data[$partnerCode] = ['totalTransaction' => 0, 'amount' => 0];
            foreach ($transactions as $transaction) {
                $data[$partnerCode]['totalTransaction'] += $transaction->totalTransaction;
                $data[$partnerCode]['amount'] += $transaction->ttamount;
            }
        }
        return ['data' => $transactions, 'total' => $data];
    }
}
