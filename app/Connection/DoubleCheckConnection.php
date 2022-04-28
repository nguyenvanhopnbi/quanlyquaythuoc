<?php
namespace App\Connection;

use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;

class DoubleCheckConnection
{

    public static function getListEbillTransByAccount(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/ebill/get-transaction-by-account';
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }


    public static function getListVAidsExport(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/report-va-logs/partner-reconciliation-data';
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    public static function getListVAids(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/v1/partner-va-reconciliation-data';
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }


    public static function DoiSoatThuHoVoiPartner(array $params, $providerCode)
    {
        $url = env('API_URL_GATE_SERVICE_CROSSCHECK_PROVIDER') . '/api/cms/service/ebill/transaction/' . $providerCode;
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    public static function ConfirmLichDoiSoat(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/reconciliation-schedule-detail/confirm-exactly';
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    public static function ConfirmLichDoiSoatVA(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/v1/va-reconciliation-schedule-detail/confirm-exactly';
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    public static function updateScheduleReconciliation($id, array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/reconciliation-schedule-detail/update';
        $params['id'] = $id;
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    public static function updateScheduleCode($id, array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/partner-reconciliation-schedule/update';
        $params['id'] = $id;
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    public static function addDoisoatthePartner(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/partner-reconciliation-schedule/create';
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }


    public static function deleteDoisoattheopartner($id)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/partner-reconciliation-schedule/delete';
        $params['id'] = $id;
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    public static function deleteScheduleReconciliation($id)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/reconciliation-schedule-detail/delete';
        $params['id'] = $id;
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }


    public static function createScheduleReconciliation(array $params){
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/reconciliation-schedule-detail/create';
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }


    public static function getListSchedule(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/reconciliation-schedule-detail';
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    public static function getListDoiSoatProviderCode(array $params, $providerCode)
    {
        // $url = env('API_URL_GATE_SERVICE_DOISOAT_PROVIDER') . '/api/cms/service/transfer_money/transaction/' . $providerCode;
        // http://develop-ebill-reconciliation-service

        $url = env('API_URL_GATE_DOISOAT_PROVIDER_SERVICE') . '/api/cms/service/transfer_money/transaction/' . $providerCode;
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    public static function getListDoiSoatvoiPartner(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/partner-reconciliation-schedule';
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }


    public static function getList(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/partner_reconciliation_data';

        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    public static function getListDataTransaction(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/report/partner_reconciliation_data';
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    public static function confirm(int $id)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/reconciliation/controller-appota-confirm';
        $params = [
            'id'=> $id
        ];
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function Noconfirm(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/reconciliation/controller-appota-not-confirm';

        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }


    /**
     * @param array $params
     * @return mixed
     */
    public static function add(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/partner-co-operate/create';
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }


    /**
     * @param int $id
     * @param array $params
     * @return mixed
     */
    // public static function edit(int $id, array $params)
    // {
    //     $url = env('API_URL_GATE_SERVICE') . '/api/v1/partner-co-operate/update';
    //     $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
    //     $resultBody = json_decode($result['body']);
    //     if ($result['status_code'] != 200) {
    //         return false;
    //     }
    //     return $resultBody;
    // }

    public static function edit($id, array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/partner-co-operate/update';
        $params['id'] = $id;
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }
}
