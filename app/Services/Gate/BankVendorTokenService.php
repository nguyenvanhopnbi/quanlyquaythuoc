<?php

namespace App\Services\Gate;

use App\Connection\PartnerBankAccountConnection;
use App\Connection\PartnerConnection;
use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;
use App\Helpers\MailHelper;
use App\Helpers\Signature;
use App\Models\AuthOtp;
use App\Models\PartnerBankTransfer;
use App\Repositories\PartnerBankTransferRepository;
use App\Services\System\AuthOtpService;
use Illuminate\Support\Facades\Log;

class BankVendorTokenService
{

    public static function bankTokenList(array $filter = []): array
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/bank-vendor-tokens';
        $result = Connection::sendRequest($url, $filter, 'GET', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body'], true);
        return $resultBody['data'] ?? [];
    }

}
