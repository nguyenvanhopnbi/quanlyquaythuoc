<?php

namespace App\Services\Gate;

use App\Connection\TransferMoneyTransactionConnection;
use App\Jobs\ExportTransferMoneyTransaction;
use App\Jobs\NotifyUserOfCompletedExport;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Carbon;

class TransferMoneyTransactionService
{

    /**
     * @param array $params
     * @return bool|mixed
     */
    public function getList(array $params, string $partnerCode = null)
    {

        $query = collect($params['filter'])->only([
            'transactionId',
            'providerCode',
            'partnerRefId',
            'partnerCode',
            'applicationId',
            'customerPhoneNumber',
            'status',
            'transferStatus',
            'amount',
            'accountNo',
            'export',
            'startTime',
            'endTime',
            'providerRefId',
            'fee_type',
            'responseStartTime',
            'responseEndTime',
            'bankCode',

        ])
            ->reject(fn ($item) => !$item)
            ->toArray();
        if (!empty($query['startTime'])) {
            $query['startTime'] =
            Carbon::createFromFormat('Y-m-d H:i:s', $query['startTime'])->timestamp;
        }
        if (!empty($query['endTime'])) {
            $query['endTime'] =
            Carbon::createFromFormat('Y-m-d H:i:s', $query['endTime'])->timestamp;
        }

        if (!empty($query['responseStartTime'])) {
            $query['responseStartTime'] =
            Carbon::createFromFormat('Y-m-d H:i:s', $query['responseStartTime'])->timestamp;
        }
        if (!empty($query['responseEndTime'])) {
            $query['responseEndTime'] =
            Carbon::createFromFormat('Y-m-d H:i:s', $query['responseEndTime'])->timestamp;
        }

        $pagination['page'] = $params['page'] ?? 1;
        $pagination['limit'] = $params['limit'] ?? 1;

        // dump($params);

        $result = TransferMoneyTransactionConnection::getList(compact('query', 'pagination'), $partnerCode);


        if (isset($result->errorCode) && $result->errorCode === 0) {
            return [$result->data, $result->meta];
        } else {
            return [[], (object) [
                'page' => 1,
                'limit' => 1,
                'total' => 1,
                'pages' => 1,
                'total_amount' => 0
            ]];
        }
    }

    public function getListExport(array $params)
    {
        $query = collect($params['filter'])->only([
            'transactionId',
            'partnerRefId',
            'partnerCode',
            'applicationId',
            'customerPhoneNumber',
            'status',
            'transferStatus',
            'amount',
            'accountNo',
            'export',
            'startTime',
            'endTime',
            'providerCode',
            'responseStartTime',
            'responseEndTime',
            'bankCode'
        ])
            ->reject(fn ($item) => !$item)
            ->toArray();
        if (!empty($query['startTime'])) {
            $query['startTime']
            = Carbon::createFromFormat('Y-m-d H:i:s', $query['startTime'])->timestamp;
        }
        if (!empty($query['endTime'])) {
            $query['endTime']
            = Carbon::createFromFormat('Y-m-d H:i:s', $query['endTime'])->timestamp;
        }

        if (!empty($query['responseStartTime'])) {
            $query['responseStartTime']
            = Carbon::createFromFormat('Y-m-d H:i:s', $query['responseStartTime'])->timestamp;
        }
        if (!empty($query['responseEndTime'])) {
            $query['responseEndTime']
            = Carbon::createFromFormat('Y-m-d H:i:s', $query['responseEndTime'])->timestamp;
        }

        $pagination['page'] = $params['page'] ?? 1;
        $pagination['limit'] = $params['limit'] ?? 10000;


        // dd($params);

        $result = TransferMoneyTransactionConnection::getList(compact('query', 'pagination'));

        if (isset($result->errorCode) && $result->errorCode === 0) {
            return [$result->data, $result->meta];
        } else {
            return [[], (object) [
                'page' => 1,
                'limit' => 1,
                'total' => 1,
                'pages' => 1,
                'total_amount' => 0
            ]];
        }
    }

    /**
     * @param string $id
     * @return bool|mixed
     */
    public function detail(string $id)
    {
        // dd('vao dyyyy');
        return TransferMoneyTransactionConnection::detail($id);
    }

    public function getListTransactionExport($params)
    {
        $limit = 10000;
        $params['offset'] = 0;
        $params['pagination']['limit'] = $limit;
        $page = isset($params['pagination']['page']) ? $params['pagination']['page'] : 1;

        if (isset($params['query']['application_id']) && $params['query']['application_id'] === 'all') {
            unset($params['query']['application_id']);
        }
        if (isset($params['query']['status']) && $params['query']['status'] === 'all') {
            unset($params['query']['status']);
        }
        if (isset($params['query']['transferStatus']) && $params['query']['transferStatus'] === 'all') {
            unset($params['query']['transferStatus']);
        }
        if (isset($params['query']['providerCode']) && $params['query']['providerCode'] === 'all') {
            unset($params['query']['providerCode']);
        }
        if (isset($params['query']['startTime'])) {
            $params['query']['startTime'] = strtotime($params['query']['startTime'] . ' 00:00:00');
        }
        if (isset($params['query']['endTime'])) {
            $params['query']['endTime'] = strtotime($params['query']['endTime'] . ' 23:59:59');
        }
        if ($page > 1) {
            $params['offset'] = ($page - 1) * $limit;
        }
        $data = TransferMoneyTransactionConnection::getList($params);
        if (!empty($data->meta)) {
            $data->meta->perpage = $limit;
        }
        return $data;
    }

    public function getChartTransaction(array $params)
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
            $params['query']['partnerCode'] = $params['partner_code'];
        }
        $data = TransferMoneyTransactionConnection::getChartData($params['query']);
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
            $filter['query']['partnerCode'] = $params['partner_code'];
        }
        $transaction = TransferMoneyTransactionConnection::getTotalTransaction($filter, $partnerCode);
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


    public function export($params = [])
    {
        $secret = uniqid();
        $name = '/log-transfer-money-transaction-' . now()->format('dmYHis') . '.xlsx';
        ExportTransferMoneyTransaction::dispatch($name, $params)->chain([
            new NotifyUserOfCompletedExport(auth()->user(), route('gate.bank-transaction.export.download', ['file' => $name]), $secret)
        ]);
        event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::GATE_TRANSACTION, "Export Transaction CTT", compact('params')));
        return $secret;
    }

    public function getExportPath($name)
    {
        return public_path('media/exports/') . $name;
    }
}
