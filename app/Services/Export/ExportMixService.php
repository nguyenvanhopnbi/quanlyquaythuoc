<?php

namespace App\Services\Export;

use App\Services\Gate\BankTransactionService;
use App\Services\Gate\EbillTransactionService;
use App\Services\Gate\ShopcardTransactionService;
use App\Services\Gate\TopupTransactionService;
use App\Services\Gate\TransferMoneyTransactionService;
use App\Transformers\EbillTransactionTransformer;
use App\Transformers\ShopCardTransactionTransformer;
use App\Transformers\TopupTransactionTransformer;

class ExportMixService
{
    public function exportGateTransaction(array $filter): string
    {
        $BankTransactionService = new BankTransactionService();
        $filter['pagination']['perpage'] = 30000;
        $data = $BankTransactionService->getList($filter);
        $this->pages = $data->meta->pages;
        unset($data);

        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $exportPath = public_path('file/public/export');
        if (!is_dir($exportPath)) {
            mkdir($exportPath, 0777);
        }
        $filePath = public_path('file/public/export/Gate_Transaction.csv');
        $handle = fopen($filePath, 'w');
        fputs($handle, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));

        $firstTime = 1;
        for ($i = 1; $i <= $this->pages; $i++) {
            $this->params['pagination']['page'] = $i;

            $data = $BankTransactionService->getList($this->params);

            foreach ($data->data as $key => $data) {
                $data = (array)$data;
                unset($data['vendor_callback_data']);
                unset($data['error_code']);
                unset($data['extra_data']);
                unset($data['extra_info']);

                $data['request_time'] = date('d-m-Y H:i:s', $data['request_time']);
                $data['response_time'] = date('d-m-Y H:i:s', $data['response_time']);

                if ($key == 0 and $firstTime == 1) {
                    foreach ($data as $title => $content) {
                        $this->tit[] = $title;
                    }
                    fputcsv($handle, $this->tit);
                    $firstTime++;
                }

                if (isset($data['has_refund'])) {
                    if ($data['has_refund'] == '0') {
                        $data['has_refund'] = 'Không';
                    } else {
                        $data['has_refund'] = 'Có';
                    }
                }

                fputcsv($handle, $data);
            }

        }
        unset($data);

        fclose($handle);
        return $filePath;
    }

    public function exportEbillTransaction(array $filter): string
    {
        $filter['pagination']['perpage'] = 10000;
        $filter['query']['startTime'] .= ' 00:00:00';
        $filter['query']['endTime'] .= ' 23:59:59';
        unset($filter['query']['fd']);
        unset($filter['query']['td']);
        $filter['query']['partnerCode'] = $filter['query']['partner_code'];
        $filter['partnerCode'] = $filter['query']['partner_code'];
        $filter['startTime'] = $filter['query']['startTime'];
        $filter['endTime'] = $filter['query']['endTime'];
        $filter['type'] = 'all';
        $filter['status'] = 'all';
        $EbillTransactionService = new EbillTransactionService();
        $data = $EbillTransactionService->getList($filter);

        $meta = $data->meta;
        $pages = $meta->pages;

        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $exportPath = public_path('file/public/export');
        if (!is_dir($exportPath)) {
            mkdir($exportPath, 0777);
        }
        $filePath = public_path('file/public/export/Ebill_Transaction.csv');
        $handle = fopen($filePath, 'w');
        fputs($handle, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));

        if ($pages >= 1) {
            for ($i = 1; $i <= $pages; $i++) {
                $filter['pagination']['page'] = $i;
                $data = $EbillTransactionService->getList($filter)->data;
                $data = EbillTransactionTransformer::transformCollection($data);
                foreach ($data as $key => $data) {
                    if ($i == 1 && $key == 0) {
                        foreach ($data as $tit => $content) {
                            $title[] = $tit;
                        }
                        $title[] = 'externalRefNo';
                        fputcsv($handle, $title);
                    }
                    $data = (array)$data;
                    if (isset($data['provider_callback_data'])) {
                        $externalRefNo = json_decode($data['provider_callback_data']);
                        if (isset($externalRefNo->data->externalRefNo) and !empty($externalRefNo->data->externalRefNo)) {
                            $externalRefNo = $externalRefNo->data->externalRefNo;
                            // array_unshift($data, $externalRefNo);
                            $data['externalRefNo'] = $externalRefNo;
                        } else {
                            $data['externalRefNo'] = '';
                        }

                    }

                    $data['amount'] = str_replace('.', '', $data['amount']);
                    fputcsv($handle, $data);
                }

            }
        }
        fclose($handle);
        return $filePath;
    }

    public function exportTransferMoneyTransaction(array $filter)
    {
        $filter['query']['startTime'] .= ' 00:00:00';
        $filter['query']['endTime'] .= ' 23:59:59';
        $params['filter'] = [
            'startTime' => $filter['query']['startTime'],
            'endTime' => $filter['query']['endTime'],
            'partnerCode' => $filter['query']['partner_code'],
        ];
        $TransferMoneyTransactionService = new TransferMoneyTransactionService();

        $data = $TransferMoneyTransactionService->getListExport($params);
        $meta = $data[1];
        $pages = $meta->pages;
        unset($data);

        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $exportPath = public_path('file/public/export');
        if (!is_dir($exportPath)) {
            mkdir($exportPath, 0777);
        }
        $filePath = public_path('file/public/export/Transfer_Money_Transaction_' . time() . '.csv');
        $handle = fopen($filePath, 'w');
        fputs($handle, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));

        for ($i = 1; $i <= $pages; $i++) {
            $params['page'] = $i;

            $data = $TransferMoneyTransactionService->getListExport($params)[0];

            foreach ($data as $key => $data) {

                if ($i == 1 && $key == 0) {
                    unset($data->providerResponseData);
                    foreach ($data as $tit => $content) {
                        $title[] = $tit;
                    }

                    fputcsv($handle, $title);
                }
                $data = (array)$data;
                // dd($data);
                unset($data['providerResponseData']);
                $data['requestTime'] = date("d-m-Y H:i:s", $data['requestTime']);
                $data['responseTime'] = date("d-m-Y H:i:s", $data['responseTime']);
                fputcsv($handle, $data);
            }

        }
        fclose($handle);
        return $filePath;
    }

    public function exportShopCardTransaction(array $filter)
    {
        $ShopcardTransactionService = new ShopcardTransactionService();
        $data = $ShopcardTransactionService->getList($filter);
        $data->data = ShopCardTransactionTransformer::transformCollection($data->data);

        $meta = $data->meta;
        $pages = $meta->pages;
        $page = $meta->page;

        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $exportPath = public_path('file/public/export');
        if (!is_dir($exportPath)) {
            mkdir($exportPath, 0777);
        }
        $filePath = public_path('file/public/export/Shop_Card_Transaction.csv');
        $handle = fopen($filePath, 'w');
        fputs($handle, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));

        if ($pages >= 1) {
            for ($i = $page; $i <= $pages; $i++) {
                $filter['pagination']['page'] = $i;

                $data = $ShopcardTransactionService->getList($filter)->data;
                $data = ShopCardTransactionTransformer::transformCollection($data);
                foreach ($data as $key => $data) {

                    if ($i == 1 && $key == 0) {
                        foreach ($data as $tit => $content) {
                            $title[] = $tit;
                        }
                        fputcsv($handle, $title);
                    }
                    $data = (array)$data;
                    $data['amount'] = str_replace('.', '', $data['amount']);
                    // dd($data);
                    fputcsv($handle, $data);
                }

            }
        }
        fclose($handle);
        return $filePath;
    }

    public function exportTopupTransaction(array $filter)
    {
        $TopupTransactionService = new TopupTransactionService();

        $data = $TopupTransactionService->getList($filter);
        $data->data = TopupTransactionTransformer::transformCollection($data->data);
        $meta = $data->meta;
        $pages = $meta->pages;
        $page = $meta->page;

        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $exportPath = public_path('file/public/export');
        if (!is_dir($exportPath)) {
            mkdir($exportPath, 0777);
        }
        $filePath = public_path('file/public/export/Topup_Transaction.csv');
        $handle = fopen($filePath, 'w');
        fputs($handle, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));

        if ($pages >= 1) {
            for ($i = $page; $i <= $pages; $i++) {
                $filter['pagination']['page'] = $i;

                $data = $TopupTransactionService->getList($filter)->data;
                $data = TopupTransactionTransformer::transformCollection($data);

                foreach ($data as $key => $data) {

                    if ($i == 1 && $key == 0) {
                        foreach ($data as $tit => $content) {

                            $title[] = $tit;
                        }
                        fputcsv($handle, $title);
                    }
                    $data = (array)$data;
                    $data['amount'] = str_replace('.', '', $data['amount']);
                    $data['topup_value'] = str_replace('.', '', $data['topup_value']);

                    fputcsv($handle, $data);
                }
            }
        }
        fclose($handle);
        return $filePath;
    }

}
