<?php

namespace App\Services\Gate;

use App\Connection\ShopcardDashboardConnection;
use DateInterval;
use DatePeriod;
use DateTime;
use Log;

class ShopcardDashboardService
{
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
        $data = ShopcardDashboardConnection::getChartData($params, $partnerCode);
        $data = $data ? $data->data : [];
        $timeFilter['startTime'] = $params['query']['startTime'];
        $timeFilter['endTime'] = $params['query']['endTime'];
        $report = $this->buildLineChart($data, $timeFilter);
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
        $transaction = ShopcardDashboardConnection::getTotalTransaction($filter, $partnerCode);
        $transaction = $transaction ? $transaction->data : [];
        $report = $this->buildFlashDashboard($transaction, $params['partner_code']);

        return $report;
    }

    private function buildFlashDashboard(array $transactions, $partnerCode)
    {
        $data = [];
        if ($partnerCode === 'all') {
            $partnerCode = 'Tất cả';
            $data[$partnerCode] = ['totalTransaction' => 0, 'amount' => 0];
            foreach ($transactions as $transaction) {
                $data[$partnerCode]['totalTransaction'] += $transaction->total_transaction;
                $data[$partnerCode]['amount'] += $transaction->total_amount;
            }
        }
        return ['data' => $transactions, 'total' => $data];
    }
}
