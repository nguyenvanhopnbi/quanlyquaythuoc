<?php

namespace App\Services\Gate;

use App\Connection\LogImportCardConnection;
use App\Connection\TopupTransactionConnection;
use App\Jobs\ExportLogImportCard;
use App\Jobs\NotifyUserOfCompletedExport;
use DateInterval;
use DatePeriod;
use DateTime;
use Log;

class LogImportCardService
{

    /**
     * @param array $params
     * @return bool|mixed
     */
    public function getList(array $params)
    {
        $limit = isset($params['pagination']['limit']) ? $params['pagination']['limit'] : 20;
        $params['offset'] = 0;
        $params['pagination']['limit'] = $limit;
        $page = isset($params['pagination']['page']) ? $params['pagination']['page'] : 1;
        if ($page > 1) {
            $params['offset'] = ($page - 1) * $limit;
        }
        $data = LogImportCardConnection::getList($params);
        if (isset($data->data)) {
            $data->meta->perpage = $limit;
            $data->meta->total_amount = number_format($data->meta->total_amount ?? 0, 0, ',', '.');
        }
        return $data;
    }

    public function exportCSV($params = [])
    {
        $secret = uniqid();
        $name = 'log_transaction_' . now()->format('dmYHis') . '.csv';
        ExportLogImportCard::dispatch($name, $params)->chain([
            new NotifyUserOfCompletedExport(auth()->user(), route('shopcard.auto-import-card.download-log-config', ['file' => $name]), $secret)
        ]);
        event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::GATE_TRANSACTION, "Export Transaction CTT", compact('params')));
        return $secret;

    }

    public function getExportPath($name)
    {
        return public_path('media/exports/') . $name;
    }
}
