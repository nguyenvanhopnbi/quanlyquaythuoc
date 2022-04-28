<?php

namespace App\Connection;

use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;
use Illuminate\Support\Facades\Log;
use App\Helpers\Signature;

class EbillConnection
{


    public static function updateScheduleVADetails(array $params){
        $url = env('API_URL_EBILL_SERVICE') . '/api/v1/va-reconciliation-schedule-detail/update';

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }


    public static function deleteScheduleVADetails(array $params){
        $url = env('API_URL_EBILL_SERVICE') . '/api/v1/va-reconciliation-schedule-detail/delete';

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }


    public static function createScheduleVADetails(array $params){
        $url = env('API_URL_EBILL_SERVICE') . '/api/v1/va-reconciliation-schedule-detail/create';

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function getListScheduleDetails(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/v1/va-reconciliation-schedule-detail';

        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }


    public static function getListBienBanDoiSoat($id)
    {
        $params = [];
        $url = env('API_URL_EBILL_SERVICE') . '/api/v1/partner-va-reconciliation-data/' . $id;

        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function getListBienBanDoiSoatDetails($id)
    {
        $params = [];
        $url = env('API_URL_EBILL_SERVICE') . '/api/v1/partner-va-reconciliation-data/' . $id;

        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function RefuseVAReconciliationData(array $params){
        $url = env('API_URL_EBILL_SERVICE') . '/api/v1/reconciliation/controller-appota-not-confirm-va';

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function ConfirmVAReconciliationData(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/v1/reconciliation/controller-appota-confirm-va';

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function ExportVAReconciliationData(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/v1/report-cms/partner-va-reconciliation-data';

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function getListVAReconciliationData(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/v1/partner-va-reconciliation-data';

        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }
    public static function getDetailsLogs($id)
    {
        $params = [];
        $url = env('API_URL_EBILL_SERVICE') . '/api/v1/partner-va-reconciliation-data/' . $id;

        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function getListVAReconciliationDataDetails($id)
    {
        $params = [];
        $url = env('API_URL_EBILL_SERVICE') . '/api/v1/partner-va-reconciliation-data/' . $id;

        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function getListVAEbillFeeConfig(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/v1/partner-va-fee-config';

        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function addnewFeeConfigVA(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/v1/partner-va-fee-config/create';

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function editFeeConfigVA(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/v1/partner-va-fee-config/update';

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function deleteFeeConfigVA(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/v1/partner-va-fee-config/delete';

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }


    public static function DeleteReconciliationSchedule(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/v1/partner-va-reconciliation-schedule/delete';

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }


    public static function UpdateReconciliationSchedule(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/v1/partner-va-reconciliation-schedule/update';

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }


    public static function AddNewReconciliationSchedule(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/v1/partner-va-reconciliation-schedule/create';

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function getListReconciliationSchedule(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/v1/partner-va-reconciliation-schedule';

        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);

        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    /*
      * function generate api signature
      */
      public static function generateAPISignature($params = array(), $algo = 'SHA256', $secretKey = '')
      {
        if (!$params)
          return false;

        ksort($params);
        $string = implode('', $params);
        $secretKey = ($secretKey) ? $secretKey : env('JWT_SECRET_KEY');
        return hash($algo, $string . $secretKey);
      }

    public static function verifyAPISignature($params, $signature, $algo = 'SHA256', $secretKey = '')
    {
        $secretKey = ($secretKey) ? $secretKey : env('JWT_SECRET_KEY');
        $checkSignature = self::generateAPISignature($params, $algo, $secretKey);
        return $checkSignature === $signature;
    }



    public static function resendTransactionEbill(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/ebill/ebill_resend_transaction';
        $paramVerify = $params;
        $params['signature'] = self::generateAPISignature($params);

        $verify = self::verifyAPISignature($paramVerify, $params['signature']);
        if(!$verify){
            return;
        }
        // Log::info('verify_signiture_111111', [$verify]);

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function UpdateConfigPartnerBankProvider(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/ebill/ebill-partner-bank-provider/update';

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function DeleteConfigPartnerBankProvider(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/ebill/ebill-partner-bank-provider/delete';

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function AddnewConfigPartnerBankProvider(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/ebill/ebill-partner-bank-provider/create';

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function ConfigPartnerBankProvider(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/ebill/ebill-partner-bank-provider';

        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function UpdateConfigPartnerProvider(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/ebill/ebill-partner-provider/update';

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function DeleteConfigPartnerProvider(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/ebill/ebill-partner-provider/delete';

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function AddnewConfigPartnerProvider(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/ebill/ebill-partner-provider/create';

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function ConfigPartnerProvider(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/ebill/ebill-partner-provider';

        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function listDanhSachSoDuThuHo(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/bill/ebill/get_balance';

        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function updateTransferParnerBankProvider(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/transfer-money/transfer-partner-bank-provider/update';

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function deleteTransferParnerBankProvider($params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/transfer-money/transfer-partner-bank-provider/delete';

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function addNewTransferParnerBankProvider(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/transfer-money/transfer-partner-bank-provider/create';

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }


    public static function getListTransferParnerBankProvider(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/transfer-money/transfer-partner-bank-provider';

        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }


    public static function editEbillBank(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/transfer-money/banks/update';

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function deleteEbillBank(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/transfer-money/banks/delete';

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }


    public static function getListEbillBank(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/transfer-money/banks';

        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }


    public static function saveNewEbillBank(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/transfer-money/banks/create';

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }


    public static function getList(array $params, string $partnerCode = null)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/bill/ebill';

        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader($partnerCode));
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
    public static function detail($transaction_id)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/bill/ebill/detail/' . $transaction_id;

        $result = Connection::sendRequest($url, [], 'GET', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

}
