<?php

namespace App\Connection;

use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;
use App\Helpers\Signature;

class BankTransactionConnection
{

    public static function editPartnerServiceTypeConfig(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/partner-service-type-config/update';
        $result = Connection::sendRequest($url, $params, 'POST',  AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        return $resultBody;
    }

    public static function deletePartnerServiceTypeConfig(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/partner-service-type-config/delete';
        $result = Connection::sendRequest($url, $params, 'POST',  AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        return $resultBody;
    }

    public static function createPartnerServiceTypeConfig(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/partner-service-type-config/create';
        $result = Connection::sendRequest($url, $params, 'POST',  AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        return $resultBody;
    }

    public static function listPartnerServiceTypeConfig(array $params)
    {

        $url = env('API_URL_GATE_SERVICE') . '/api/v1/partner-service-type-config';
        $result = Connection::sendRequest($url, $params, 'GET',  AuthenticationHelper::getHeader(), true);

        $resultBody = json_decode($result['body']);

        if ($result['status_code'] != 200) {
            return $result;
        }
        return $resultBody;
    }


    public static function vaTransactionList(array $params)
    {

        $url = env('API_URL_GATE_SERVICE') . '/api/v1/cms/va-transactions';
        $result = Connection::sendRequest($url, $params, 'GET',  AuthenticationHelper::getHeader(), true);

        $resultBody = json_decode($result['body']);

        if ($result['status_code'] != 200) {
            return $result;
        }
        return $resultBody;
    }


    public static function refundChangeStatus($refundID, array $params)
    {

        $url = env('API_URL_GATE_SERVICE') . '/api/v1/bank-transaction/refund/' . $refundID;
        $result = Connection::sendRequest($url, $params, 'PATCH',  AuthenticationHelper::getHeader(), true);

        $resultBody = json_decode($result['body']);

        if ($result['status_code'] != 200) {
            return $result;
        }
        return $resultBody;
    }

    public static function refundMoca(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/moca/refund';
        $result = Connection::sendRequest($url, $params, 'POST',  AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);

        if ($result['status_code'] != 200) {
            return $result;
        }
        return $resultBody;
    }

    public static function getListVATransaction(array $params, $id)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/va-transaction/' . $id;
        $result = Connection::sendRequest($url, $params, 'GET',  AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }


    public static function getListUnHold(array $params, string $partnerCode = null)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/bank-transactions/un-hold';
        $result = Connection::sendRequest($url, $params, 'GET',  AuthenticationHelper::getHeader($partnerCode), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    public static function HoldTransaction(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/bank-transactions/hold';
        $result = Connection::sendRequest($url, $params, 'POST',  AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }


    public static function getListHold(array $params, string $partnerCode = null)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/bank-transactions/hold';
        $result = Connection::sendRequest($url, $params, 'GET',  AuthenticationHelper::getHeader($partnerCode), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    public static function getList(array $params, string $partnerCode = null)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/bank-transactions';
        // dd(AuthenticationHelper::getHeader($partnerCode));
        $result = Connection::sendRequest($url, $params, 'GET',  AuthenticationHelper::getHeader($partnerCode), true);
//        dd($result);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }



    public static function getListChartData(array $params, string $partnerCode = null)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/bank-transaction-chart-data';
        $result = Connection::sendRequest($url, $params, 'GET',  AuthenticationHelper::getHeader($partnerCode), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public static function detail(string $id)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/bank-transaction/' . $id;

        $result = Connection::sendRequest($url, [], 'GET',  AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    public static function resendIpn(string $transactionId = '')
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/transaction/bank/resend_ipn';
        $params['transactionId'] = $transactionId;
        $params['signature'] = Signature::generateAPISignature($params);
        $result = Connection::sendRequest($url, $params, 'POST',  AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);

        return $resultBody;
    }

    public static function refund(array $params)
    {
        $partnerCode = null;
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/bank-transaction/refund';
        $params['signature'] = Signature::generateAPISignature($params);
        $result = Connection::sendRequest($url, $params, 'POST',  AuthenticationHelper::getHeader($partnerCode));

        // dd($result);
        $resultBody = json_decode($result['body']);

        return $resultBody;
    }

    public static function getListRefund(array $params, string $partnerCode = null)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/bank-transactions/refund';
        // dd(AuthenticationHelper::getHeader());
        $result = Connection::sendRequest($url, $params, 'GET',  AuthenticationHelper::getHeader($partnerCode), true);
        $resultBody = json_decode($result['body']);

        return $resultBody;
    }

    public static function getDetailRefund(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/bank-transaction/refund/' . $params['transaction_id'];
        $result = Connection::sendRequest($url, $params, 'GET',  AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);

        return $resultBody;
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public static function detailRefundTransaction(string $id)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/bank-transaction/refund/' . $id;

        $result = Connection::sendRequest($url, [], 'GET',  AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }


    /**
     * @param int $id
     * @return bool|mixed
     */
    public static function getTotalTransaction(array $query, string $partnerCode = null)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/bank-transaction/dashboard/total';

        $result = Connection::sendRequest($url, $query, 'GET',  AuthenticationHelper::getHeader($partnerCode), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public static function getBankTransactionDashboard(array $query)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/bank-transaction-dashboard';

        $result = Connection::sendRequest($url, $query, 'GET',  AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }
}
