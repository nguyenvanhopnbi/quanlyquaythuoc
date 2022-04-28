<?php

namespace App\Services\Gate;

use App\Connection\BankTransactionConnection;
use App\Connection\PartnerConnection;
use App\Connection\PartnerPayGateConfigConnection;
use App\Jobs\ExportBankTransaction;
use App\Jobs\NotifyUserOfCompletedExport;
use Illuminate\Support\Facades\Log;

class BankTransactionService
{
    /**
     * @param array $params
     * @return bool|mixed
     */
    public $metaData;
    public $page;
    public $pages;
    public $limit;

    public function getList(array $params, string $partnerCode = null)
    {
        $limit = isset($params['pagination']['perpage']) ? $params['pagination']['perpage'] : 20;
        $params['offset'] = 0;
        $params['pagination']['limit'] = $limit;
        $page = isset($params['pagination']['page']) ? $params['pagination']['page'] : 1;
        if (isset($params['query']['status']) && $params['query']['status'] === 'all') {
            unset($params['query']['status']);
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
        $data = BankTransactionConnection::getList($params, $partnerCode);
        if (!empty($data->meta)) {
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
        $transaction = BankTransactionConnection::detail($id);
        // dd($transaction);
        return $transaction;
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
            $params['query']['startTime'] = strtotime($params['query']['startTime'] . ' 00:00:00');
        }
        if (isset($params['query']['endTime'])) {
            $params['query']['endTime'] = strtotime($params['query']['endTime'] . ' 23:59:59');
        }
        if ($page > 1) {
            $params['offset'] = ($page - 1) * $limit;
        }
        // $params['query']['export'] = true;

        $data = BankTransactionConnection::getList($params);

        $data = $data ? $data : (object) ['data' => []];
        if (!empty($data->meta)) {
            $data->meta->perpage = $limit;
        }
        return $data;
    }
    public function getListTransactionExportAllLimit(array $params)
    {
        $limit = isset($params['pagination']['limit']) ? $params['pagination']['limit'] : 20;
        $params['offset'] = 0;
        $params['pagination']['limit'] = $limit;
        $page = isset($params['pagination']['page']) ? $params['pagination']['page'] : 1;
        if (isset($params['query']['status']) && $params['query']['status'] === 'all') {
            unset($params['query']['status']);
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
        // $params['query']['export'] = false;
        // dd($params);
        $data = BankTransactionConnection::getList($params);
        // dd($data);
        $data = $data ? $data : (object) ['data' => []];

        if (!empty($data->meta)) {
            $data->meta->perpage = $limit;
        }
        $this->metaData = $data->meta;
        $this->page = $data->meta->page;
        $this->pages = $data->meta->pages;
        $this->limit = $data->meta->limit;

        return $data;
    }



    public function resendIpn(string $transactionId = '')
    {
        $result = BankTransactionConnection::resendIpn($transactionId);
        if ($result->errorCode === 0) {
            return ['success' => true, 'message' => 'Resend ipn thành công'];
        } else {
            return ['success' => false, 'message' => 'Resend không thành công, vui lòng thử lại sau', 'code' => $result->errorCode];
        }
    }

    public function getListAudit(array $params)
    {
        $limit = isset($params['pagination']['perpage']) ? $params['pagination']['perpage'] : 20;
        $params['offset'] = 0;
        $params['pagination']['limit'] = $limit;
        $page = isset($params['pagination']['page']) ? $params['pagination']['page'] : 1;
        if (isset($params['query']['payment_method']) && $params['query']['payment_method'] === 'all') {
            unset($params['query']['payment_method']);
        }
        if (isset($params['query']['startTime'])) {
            $params['query']['startTime'] = strtotime($params['query']['startTime'] . ' 00:00:00');
        } else {
            $params['query']['startTime'] = strtotime('01/01/' . date('Y') . ' 00:00:00');
        }
        if (isset($params['query']['endTime'])) {
            $params['query']['endTime'] = strtotime($params['query']['endTime'] . ' 23:59:59');
        } else {
            $params['query']['endTime'] = strtotime(date('m/d/Y') . ' 23:59:59');
        }
        if ($page > 1) {
            $params['offset'] = ($page - 1) * $limit;
        }
        // $params['query']['report'] = true;
        $params['query']['audit'] = true;
        $data = BankTransactionConnection::getList($params);
        $audit = [];
        if (isset($data->data)) {
            $audit = $this->buildAuditList($data->data);
        }
        return $audit;
    }

    private function buildAuditList(array $transactions = [])
    {
        $auditByPartnerCode = [];
        foreach ($transactions as $transaction) {
            if (!isset($auditByPartnerCode[$transaction->partner_code]['total_success'])) {
                $auditByPartnerCode[$transaction->partner_code]['total_success'] = 0;
            }
            if (!isset($auditByPartnerCode[$transaction->partner_code]['total_refund'])) {
                $auditByPartnerCode[$transaction->partner_code]['total_refund'] = 0;
            }
            if ($transaction->status === 'success') {
                $auditByPartnerCode[$transaction->partner_code]['total_success'] += $transaction->amount;
            }
            if ($transaction->status === 'refund') {
                $auditByPartnerCode[$transaction->partner_code]['total_refund'] += $transaction->amount;
            }
        }
        if (!empty($auditByPartnerCode)) {
            $result = [];
            foreach ($auditByPartnerCode as $partnerCode => $auditAmount) {
                $result[] = [
                    'partner_code' => $partnerCode,
                    'total_amount' => number_format($auditAmount['total_success'] - $auditAmount['total_refund'], 0, ',', '.'),
                    'total_refund' => $auditAmount['total_refund'],
                    'total_success' => $auditAmount['total_success'],
                    // 'total_success_format'=> number_format($auditAmount['total_success'], 0 , ',', '.'),
                    // 'total_refund_format'=> number_format($auditAmount['total_refund'], 0 , ',', '.'),
                ];
            }
            return ['data' => $result, 'meta' => $this->getMeta($result)];
        }
        return ['data' => []];
    }

    private function getMeta($audit)
    {
        return [
            'limit' => 10000,
            'page' => 1,
            'pages' => 1,
            'total' => count($audit),
            'perpage' => count($audit)
        ];
    }

    public function getAuditForExport(array $params)
    {
        if (isset($params['query']['payment_method']) && $params['query']['payment_method'] === 'all') {
            unset($params['query']['payment_method']);
        }
        if (isset($params['query']['startTime'])) {
            $params['query']['startTime'] = strtotime($params['query']['startTime'] . ' 00:00:00');
        } else {
            $params['query']['startTime'] = strtotime('01/01/' . date('Y') . ' 00:00:00');
        }
        if (isset($params['query']['endTime'])) {
            $params['query']['endTime'] = strtotime($params['query']['endTime'] . ' 23:59:59');
        } else {
            $params['query']['endTime'] = strtotime(date('m/d/Y') . ' 23:59:59');
        }
        // $params['query']['report'] = true;
        $params['query']['audit'] = true;
        $data = BankTransactionConnection::getList($params);
        $audit = [];
        if (isset($data->data)) {
            $partner = $this->getPartner($params);
            $partnerPaygateConfig = $this->getPartnerPaygateConfig($params);
            if (!$partner || !$partnerPaygateConfig) {
                return false;
            }
            $audit = $this->buildAuditExport($data->data, $partnerPaygateConfig);
            $audit['name'] = $partner->name ? $partner->name : $partner->partner_code;
            $audit['contract_number'] = $partnerPaygateConfig->contract_number;
        }
        return $audit;
    }

    private function getPartner($params)
    {
        $partnerCode = $params['query']['partner_code'];
        $result = PartnerConnection::getByPartnerCode($partnerCode);
        Log::info('debug partner', [$result]);
        if (isset($result->data)) {
            return $result->data;
        }
        return false;
    }

    private function getPartnerPaygateConfig($params)
    {
        $filter['query']['partner_code'] = $params['query']['partner_code'];
        $result = PartnerPayGateConfigConnection::getList($filter);
        if (isset($result->data[0])) {
            return $result->data[0];
        }
        return false;
    }

    private function buildAuditExport($transactions, $partnerPaygateConfig)
    {
        $transactionAtm = [
            'transaction' => 0,
            'success' => 0, //5
            'refund' => 0, //6
            'total_success' => 0, //7
            'total_refund' => 0, //8
            'transaction_fee' => $partnerPaygateConfig->atm_transaction_fee, //9
            'payment_fee' => ($partnerPaygateConfig->atm_payment_fee / 100), //10
            'appotapay_income' => 0,
        ];
        $transactionCc = [
            'transaction' => 0,
            'success' => 0, //5
            'refund' => 0, //6
            'total_success' => 0, //7
            'total_refund' => 0, //8
            'transaction_fee' => $partnerPaygateConfig->cc_transaction_fee, //9
            'payment_fee' => ($partnerPaygateConfig->cc_payment_fee / 100), //10
            'appotapay_income' => 0,
        ];

        if ($this->ewalletConfigIsAvailable($partnerPaygateConfig)) {
            $transactionEwallet = [
                'transaction' => 0,
                'success' => 0, //5
                'refund' => 0, //6
                'total_success' => 0, //7
                'total_refund' => 0, //8
                'transaction_fee' => $partnerPaygateConfig->ewallet_transaction_fee, //9
                'payment_fee' => ($partnerPaygateConfig->ewallet_payment_fee / 100), //10
                'appotapay_income' => 0,
            ];
        }

        foreach ($transactions as $transaction) {
            if ($transaction->payment_method === 'ATM') {
                $transactionAtm['transaction']++;
                if ($transaction->status === 'success') {
                    $transactionAtm['success']++;
                    $transactionAtm['total_success'] += $transaction->amount;
                }
                if ($transaction->status === 'refund') {
                    $transactionAtm['refund']++;
                    $transactionAtm['total_refund'] += $transaction->amount;
                }
            }
            if ($transaction->payment_method === 'CC') {
                $transactionCc['transaction']++;
                if ($transaction->status === 'success') {
                    $transactionCc['success']++;
                    $transactionCc['total_success'] += $transaction->amount;
                }
                if ($transaction->status === 'refund') {
                    $transactionCc['refund']++;
                    $transactionCc['total_refund'] += $transaction->amount;
                }
            }
            if ($transaction->payment_method === 'EWALLET' && isset($transactionEwallet)) {
                $transactionEwallet['transaction']++;
                if ($transaction->status === 'success') {
                    $transactionEwallet['success']++;
                    $transactionEwallet['total_success'] += $transaction->amount;
                }
                if ($transaction->status === 'refund') {
                    $transactionEwallet['refund']++;
                    $transactionEwallet['total_refund'] += $transaction->amount;
                }
            }
        }

        $transactionAtm['success'] = $transactionAtm['success']  + $transactionAtm['refund'];
        $transactionCc['success'] = $transactionCc['success']  + $transactionCc['refund'];
        if (isset($transactionEwallet)) $transactionEwallet['success'] = $transactionEwallet['success']  + $transactionEwallet['refund'];


        $transactionAtm['total_success'] = $transactionAtm['total_success']  + $transactionAtm['total_refund'];
        $transactionCc['total_success'] = $transactionCc['total_success']  + $transactionCc['total_refund'];
        if (isset($transactionEwallet)) $transactionEwallet['total_success'] = $transactionEwallet['total_success']  + $transactionEwallet['total_refund'];

        $transactionCc['appotapay_income'] = round(($transactionCc['success'] + $transactionCc['refund']) * $transactionCc['transaction_fee'] + ($transactionCc['total_success'] - $transactionCc['total_refund']) * $transactionCc['payment_fee']); //11
        $transactionAtm['appotapay_income'] = round(($transactionAtm['success'] + $transactionAtm['refund']) * $transactionAtm['transaction_fee'] + ($transactionAtm['total_success'] - $transactionAtm['total_refund']) * $transactionAtm['payment_fee']); //11
        if (isset($transactionEwallet)) $transactionEwallet['appotapay_income'] = round(($transactionEwallet['success'] + $transactionEwallet['refund']) * $transactionEwallet['transaction_fee'] + ($transactionEwallet['total_success'] - $transactionEwallet['total_refund']) * $transactionEwallet['payment_fee']); //11

        $totalInCome = $transactionCc['appotapay_income'] + $transactionAtm['appotapay_income']; //15
        if (isset($transactionEwallet))  $totalInCome += $transactionEwallet['appotapay_income'];

        $transactionCc['payout'] = $transactionCc['total_success'] - $transactionCc['total_refund'] - $transactionCc['appotapay_income']; //12
        $transactionAtm['payout'] = $transactionAtm['total_success'] - $transactionAtm['total_refund'] - $transactionAtm['appotapay_income'];; //12
        if (isset($transactionEwallet))  $transactionEwallet['payout'] = $transactionEwallet['total_success'] - $transactionEwallet['total_refund'] - $transactionEwallet['appotapay_income'];; //12

        $totalPayout = $transactionCc['payout'] + $transactionAtm['payout']; //13
        if (isset($transactionEwallet)) $totalPayout += $transactionEwallet['payout'];

        $success = $transactionCc['success'] + $transactionAtm['success'];
        if (isset($transactionEwallet)) $success += $transactionEwallet['success'];

        $refund = $transactionCc['refund'] + $transactionAtm['refund'];
        if (isset($transactionEwallet)) $refund += $transactionEwallet['refund'];

        $total_success = $transactionCc['total_success'] + $transactionAtm['total_success'];
        if (isset($transactionEwallet)) $total_success += $transactionEwallet['total_success'];

        $total_refund = $transactionCc['total_refund'] + $transactionAtm['total_refund'];
        if (isset($transactionEwallet)) $total_refund += $transactionEwallet['total_refund'];

        $result = [
            'atm' => $transactionAtm,
            'cc' => $transactionCc,
            'success' => $success,
            'refund' => $refund,
            'total_success' => $total_success,
            'total_refund' => $total_refund,
            'totalInCome' => (int)ceil($totalInCome),
            'totalPayout' => (int)ceil($totalPayout),
            'totalInComeString' => $this->vndText($totalInCome),
            'totalPayoutString' => $this->vndText($totalPayout)
        ];
        if (isset($transactionEwallet)) $result['ewallet'] = $transactionEwallet;

        return $result;
    }

    protected function ewalletConfigIsAvailable($partnerPaygateConfig): bool
    {
        return isset($partnerPaygateConfig->ewallet_transaction_fee)
            && isset($partnerPaygateConfig->ewallet_payment_fee)
            && $partnerPaygateConfig->ewallet_transaction_fee != 0
            && $partnerPaygateConfig->ewallet_payment_fee != 0;
    }

    public function vndText($amount)
    {
        $textNegative = '';
        if ($amount <= 0) {
            $amount = $amount * -1;
            $textNegative = 'Âm ';
            // return $textnumber="Tiền phải là số nguyên dương lớn hơn số 0";
        }
        $Text = array("không", "một", "hai", "ba", "bốn", "năm", "sáu", "bảy", "tám", "chín");
        $TextLuythua = array("", "nghìn", "triệu", "tỷ", "ngàn tỷ", "triệu tỷ", "tỷ tỷ");
        $textnumber = "";
        $amount = (int)ceil($amount);
        $length = strlen($amount);

        for ($i = 0; $i < $length; $i++) {
            $unread[$i] = 0;
        }

        for ($i = 0; $i < $length; $i++) {
            $so = substr($amount, $length - $i - 1, 1);

            if (($so == 0) && ($i % 3 == 0) && ($unread[$i] == 0)) {
                for ($j = $i + 1; $j < $length; $j++) {
                    $so1 = substr($amount, $length - $j - 1, 1);
                    if ($so1 != 0) {
                        break;
                    }
                }

                if (intval(($j - $i) / 3) > 0) {
                    for ($k = $i; $k < intval(($j - $i) / 3) * 3 + $i; $k++) {
                        $unread[$k] = 1;
                    }
                }
            }
        }
        for ($i = 0; $i < $length; $i++) {
            $so = substr($amount, $length - $i - 1, 1);

            if ($unread[$i] == 1) {
                continue;
            }

            if (($i % 3 == 0) && ($i > 0)) {
                $textnumber = $TextLuythua[$i / 3] . " " . $textnumber;
            }

            if ($i % 3 == 2) {
                $textnumber = 'trăm ' . $textnumber;
            }

            if ($i % 3 == 1) {
                $textnumber = 'mươi ' . $textnumber;
            }

            $textnumber = $Text[$so] . " " . $textnumber;
        }

        //Phai de cac ham replace theo dung thu tu nhu the nay
        $textnumber = str_replace("không mươi", "lẻ", $textnumber);
        $textnumber = str_replace("lẻ không", "", $textnumber);
        $textnumber = str_replace("mươi không", "mươi", $textnumber);
        $textnumber = str_replace("một mươi", "mười", $textnumber);
        $textnumber = str_replace("mươi năm", "mươi lăm", $textnumber);
        $textnumber = str_replace("mươi một", "mươi mốt", $textnumber);
        $textnumber = str_replace("mười năm", "mười lăm", $textnumber);

        return ucfirst($textNegative . $textnumber . " đồng chẵn");
    }

    public function refund($params)
    {
        return BankTransactionConnection::refund($params);
    }

    /**
     * @param array $params
     * @return bool|mixed
     */
    public function getListRefund(array $params, string $partnerCode = null)
    {
        $limit = isset($params['pagination']['perpage']) ? $params['pagination']['perpage'] : 20;
        $params['offset'] = 0;
        $params['pagination']['limit'] = $limit;
        $page = isset($params['pagination']['page']) ? $params['pagination']['page'] : 1;
        if (isset($params['query']['status']) && $params['query']['status'] === 'all') {
            unset($params['query']['status']);
        }
        if (isset($params['query']['startTime'])) {
            $params['query']['startTime'] = strtotime($params['query']['startTime'] . ' 00:00:00');
        }
        if (isset($params['query']['endTime'])) {
            $params['query']['endTime'] = strtotime($params['query']['endTime'] . ' 23:59:59');
        }
        if (isset($params['query']['refund_type']) && $params['query']['refund_type'] === 'all') {
            unset($params['query']['refund_type']);
        }
        if ($page > 1) {
            $params['offset'] = ($page - 1) * $limit;
        }
        $data = BankTransactionConnection::getListRefund($params, $partnerCode);
        $data->meta->perpage = $limit;
        $data->meta->total_amount = number_format($data->meta->total_amount ?? 0, 0, ',', '.');
        return $data;
    }

    public function detailRefundTransaction($id)
    {
        $transaction = BankTransactionConnection::detailRefundTransaction($id);
        return $transaction;
    }

    public function getListRefundTransactionExport(array $params)
    {
        $limit = isset($params['pagination']['perpage']) ? $params['pagination']['perpage'] : 20;
        $params['offset'] = 0;
        $params['pagination']['limit'] = $limit;
        $page = isset($params['pagination']['page']) ? $params['pagination']['page'] : 1;
        if (isset($params['query']['status']) && $params['query']['status'] === 'all') {
            unset($params['query']['status']);
        }
        if (isset($params['query']['startTime'])) {
            $params['query']['startTime'] = strtotime($params['query']['startTime'] . ' 00:00:00');
        }
        if (isset($params['query']['endTime'])) {
            $params['query']['endTime'] = strtotime($params['query']['endTime'] . ' 23:59:59');
        }
        if (isset($params['query']['refund_type']) && $params['query']['refund_type'] === 'all') {
            unset($params['query']['refund_type']);
        }
        if ($page > 1) {
            $params['offset'] = ($page - 1) * $limit;
        }
        // $params['query']['export'] = true;
        $data = BankTransactionConnection::getListRefund($params);
        $data = $data ? $data : (object) ['data' => []];
        if (!empty($data->meta)) {
            $data->meta->perpage = $limit;
        }
        return $data;
    }

    public static function getChartTransaction(array $params, string $partnerCode = null)
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

        // dump(date('d-m-Y H:i:s', $params['query']['startTime']));
        // dd(date('d-m-Y H:i:s', $params['query']['endTime']));

        //them report true
        // $params['query']['report'] = true;

        $params['query']['status'] = 'success';
        if (isset($params['partner_code'])) {
            $params['query']['partner_code'] = $params['partner_code'];
        }
        $data = BankTransactionConnection::getListChartData($params, $partnerCode);

        // if (isset($data->data)) {
        //     $timeFilter['startTime'] = $params['query']['startTime'];
        //     $timeFilter['endTime'] = $params['query']['endTime'];
        //     $report = $this->buildLineChart($data->data, $timeFilter);
        // }

        // Log::info('11111111111Log', [$report]);
        return ['data' => $data];
    }

    private function buildLineChart(array $transactions, array $timeFilter)
    {
        if (is_null($transactions)) {
            return false;
        }
        $arrDayBySelect = $this->getDayByDateSelect($timeFilter);
        $arrResult = [];
        $count = 0;
        $sum = 0;
        foreach ($arrDayBySelect['timeStamp'] as $key => $day) {
            $arrResult[$arrDayBySelect['text'][$key]] = 0;

            foreach ($transactions as $keyTransaction => $transaction) {
                if ($transaction->response_time >= $day['startDay'] && $transaction->response_time <= $day['endDay']) {
                    $arrResult[$arrDayBySelect['text'][$key]] += $transaction->amount;
                    $count++;
                    $sum += $transaction->amount;
                }
            }
        }
        $arrHeader = array_keys($arrResult);
        $arrValues = array_values($arrResult);

        $arrDataResponse = ['head' => $arrHeader, 'value' => $arrValues, 'count' => number_format($count, 0, '.', '.'), 'sum' => number_format($sum, 0, ',', '.')];
        return $arrDataResponse;
    }


    /**
     * get day from startDay to endDay
     *
     * @return array
     */
    private function getDayByDateSelect($params)
    {
        $startDate = $params['startTime'];
        $endDate = $params['endTime'];
        $arrDateBySelect = [];
        if ($startDate == 0 || $endDate == 0) {
            $date = $this->buildDateSelect($params);
            $arrDateBySelect['timeStamp'][] = ['startDay' => $date['startDate'], 'endDay' => $date['endDate']];
            $arrDateBySelect['text'][] = $startDate != 0 ? $startDate : $endDate;
            return $arrDateBySelect;
        }

        // $current = $startDate;
        // $last = $endDate;
        while ($startDate <= $endDate) {
            $dates['timeStamp'][] = ['startDay' => strtotime(date('m/d/Y 00:00:00', $startDate)), 'endDay' => strtotime(date('m/d/Y 23:59:59', $startDate))];
            $dates['text'][] = date('j/n', $startDate);
            $startDate = strtotime('+1 day', $startDate);
        }

        return $dates;
    }

    private function buildDateSelect($params)
    {
        $result = [];
        $strStart = $params['startDate'] ? $params['startDate'] : $params['endDate'];
        $strEnd = $params['endDate'] ? $params['endDate'] : $params['startDate'];
        $result['startDate'] = strtotime($strStart . '00:00:00');
        $result['endDate'] = strtotime($strEnd . '23:59:59');
        return $result;
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
        $transaction = BankTransactionConnection::getTotalTransaction($filter, $partnerCode);
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

    public function getReportPartnerByDay2(array $params)
    {
        $filter['query'] = [];
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
        if (!empty($params['query']['vendor_code'])) {
            $filter['query']['vendor_code'] = $params['query']['vendor_code'];
        }
        if (!empty($params['query']['bank_code'])) {
            $filter['query']['bank_code'] = $params['query']['bank_code'];
        }
        if (!empty($params['query']['partner_code'])) {
            $filter['query']['partner_code'] = $params['query']['partner_code'];
        }
        // dump($filter);
        $transaction = BankTransactionConnection::getBankTransactionDashboard($filter);
        $transaction = $transaction ? (array)$transaction : [];
        $report = $this->buildFlashDashboard2($transaction, 'all');
        return $report;
    }

    private function buildFlashDashboard2(array $transactions, $partnerCode)
    {
        $data = [];
        if ($partnerCode === 'all') {
            $partnerCode = 'Tất cả';
            $data[$partnerCode] = [
                'total_error' => $transactions['total_error'],
                'total_success' => $transactions['total_success'],
                'total_amount_success' => $transactions['total_amount_success']
            ];
        }
        return ['data' => $transactions['data'], 'total' => $data];
    }

    public function export($params = [])
    {
        $secret = uniqid();
        $name = 'log_transaction_' . now()->format('dmYHis') . '.xlsx';
        ExportBankTransaction::dispatch($name, $params)->chain([
            new NotifyUserOfCompletedExport(auth()->user(), route('gate.bank-transaction.export.download', ['file' => $name]), $secret)
        ]);
        event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::GATE_TRANSACTION, "Export Transaction CTT", compact('params')));
        return $secret;

    }
    public function exportCSV($params = [])
    {
        $secret = uniqid();
        $name = 'log_transaction_' . now()->format('dmYHis') . '.csv';
        ExportBankTransaction::dispatch($name, $params)->chain([
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
