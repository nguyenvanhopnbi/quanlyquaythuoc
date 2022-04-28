<?php

namespace App\Services\PaymentLink;

use App\Connection\PaymentLinkConnection;
use App\Connection\TransferMoneyTransactionConnection;
use App\Jobs\ExportTransferMoneyTransaction;
use App\Jobs\NotifyUserOfCompletedExport;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

class PaymentLinkService
{
    public function overviewRevenue(array $filter = [], string $partnerCode = null)
    {
        $overview = PaymentLinkConnection::overviewRevenue($filter, $partnerCode);
        return $overview;
    }

    public function transactionList(array $filter = [], string $partnerCode = null): ?array
    {
        $res = PaymentLinkConnection::transactionList($filter, $partnerCode);
        if ($res['errorCode'] === 0) {
            return $res['data'];
        }
        return null;
    }

    public function partnerList(array $filter = [], string $partnerCode = null): array
    {
        $res = PaymentLinkConnection::partnerList($filter, $partnerCode);
        if ($res['errorCode'] === 0) {
            return $res['data'];
        }
        return [];
    }

    public function channelList(array $filter = [], string $partnerCode = null): ?array
    {
        $res = PaymentLinkConnection::channelList($filter, $partnerCode);
        if ($res['errorCode'] === 0) {
            return $res['data'];
        }
        return null;
    }

    public function customerList(array $filter = [], string $partnerCode = null): ?array
    {
        $res = PaymentLinkConnection::customerList($filter, $partnerCode);
        if ($res['errorCode'] === 0) {
            return $res['data'];
        }
        return null;
    }

}
