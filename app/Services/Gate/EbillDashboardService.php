<?php


namespace App\Services\Gate;
use App\Connection\EbillDashboardTransactionConnection;
use App\Connection\TransferMoneyTransactionConnection;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Facades\Log;
use phpDocumentor\Reflection\Types\Collection;

class EbillDashboardService
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
        if (isset($params['query']['application_id']) && $params['query']['application_id'] === 'all') {
            unset($params['query']['application_id']);
        }
        if (isset($params['query']['status']) && $params['query']['status'] === 'all') {
            unset($params['query']['status']);
        }
        if (isset($params['query']['transferStatus']) && $params['query']['transferStatus'] === 'all') {
            unset($params['query']['transferStatus']);
        }
        if (isset($params['query']['startTime'])) {
            $params['query']['startTime'] = strtotime($params['query']['startTime'] . ' 00:00:00');
        }
        if (isset($params['query']['endTime'])) {
            $params['query']['endTime'] = strtotime($params['query']['endTime'] . ' 23:59:59');
        }

        $data = TransferMoneyTransactionConnection::getList($params);
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
        return TransferMoneyTransactionConnection::detail($id);
    }

    public function getListTransactionExport($params)
    {
        $limit = 1000000;
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
        $params['query']['export'] = true;
        $data = TransferMoneyTransactionConnection::getList($params);
        $data->meta->perpage = $limit;
        return $data;
    }

    public function getChartTransaction(array $params, string $partnerCode = null)
    {
        if (isset($params['startDate'])) {
            $params['startTime'] = strtotime($params['startDate'] . ' 00:00:00');
        } else {
            $params['startTime'] = strtotime('01/01/' . date('Y') . ' 00:00:00');
        }
        if (isset($params['endDate'])) {
            $params['endTime'] = strtotime($params['endDate'] . ' 23:59:59');
        } else {
            $params['endTime'] = strtotime(date('m/d/Y') . ' 23:59:59');
        }
        $params['status'] = 'success';
        if (isset($params['partner_code'])) {
            $params['partnerCode'] = $params['partner_code'];
        }
        unset($params['partner_code']);
        unset($params['startDate']);
        unset($params['endDate']);

        $data = EbillDashboardTransactionConnection::getChartData($params, $partnerCode);
        if (isset($data)) {
            $timeFilter['startTime'] = $params['startTime'];
            $timeFilter['endTime'] = $params['endTime'];
            $report = $this->buildLineChart($data, $timeFilter);
            return ['data' => $report];
        }

        return false;
    }


    private function buildLineChart( $transactions, array $timeFilter)
    {
        if (is_null($transactions)) {
            return false;
        }

        $transactions = collect($transactions);
        $period = $this->getDayByDateSelect($timeFilter);
        $headChart = $period->toArray();
        $valueChart = [];
        $sumChart = 0;
        $countTransaction = 0;

        //merge all key for valueChart
        foreach ($headChart as $key=>$value) {
            $valueChart[$value] = 0;
        }

        $dataSearch = collect($transactions['data']);
        //merge all value for valueChart
        foreach ($valueChart as $key=>$value ){
            $oneTrans = $dataSearch->firstWhere('transaction_time','=', $key);
            if(!empty($oneTrans)){
                $valueChart[$key] = (int)$oneTrans->sumAmount;
                $sumChart += (int)$oneTrans->sumAmount;
                $countTransaction += (int)$oneTrans->countTransactions;
            } else {
                $valueChart[$key] = 0;
            }
        }

        $valueChart = array_values($valueChart);

        $allData =  [
            'head' => $headChart,
            'value' => $valueChart,
            'count' => number_format($countTransaction, 0, '.', '.'),
            'sum' => number_format($sumChart, 0, ',', '.')
        ];

        Log::info('all data chart Ebill Dashboard = '.json_encode($allData));
        return $allData;
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
        $filter = [];
        if (isset($params['query']['startTime'])) {
            $filter['query']['startTime'] = strtotime($params['query']['startTime'] . ' 00:00:00');
        } else {
            $filter['query']['startTime'] = strtotime('01/01/' . date('Y') . ' 00:00:00');
        }
        if (isset($params['query']['endTime'])) {
            $filter['query']['endTime'] = strtotime($params['query']['endTime'] . ' 23:59:59');
        } else {
            $filter['query']['endTime'] = strtotime(date('m/d/Y') . ' 23:59:59');
        }
        $filter['query']['status'] = 'success';
        if (isset($params['query']['partnerCode']) && $params['query']['partnerCode'] !== 'all') {
            $filter['query']['partnerCode'] =$params['query']['partnerCode'];
        }
        $transactionEbill = EbillDashboardTransactionConnection::getTotalTransaction($filter, $partnerCode);
        if (!empty($transactionEbill)) {
            $report = $this->buildFlashDashboard($transactionEbill, isset($params['query']['partnerCode'])?$params['query']['partnerCode']:null);
            return $report;
        }
        return false;

    }

    private function buildFlashDashboard( $transactions, $partnerCode)
    {
        $dataTotal = ['totalTransaction' => 0, 'amount' => 0];
        if ($partnerCode === 'all' or empty($partnerCode)) {
            foreach ($transactions->data as $transaction) {
                $dataTotal['totalTransaction'] += $transaction->totalTransaction;
                $dataTotal['amount'] += $transaction->ttamount;
            }
        }

        return ['data' => $transactions, 'total' => $dataTotal];
    }

}
