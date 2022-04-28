<?php
namespace App\Connection;

use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;

class partnerDocumentReportConnection
{
    public static function updatePaymentBankcodeConfig(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/partner-payment-method-config/update';
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    public static function deletePaymentBankcodeConfig(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/partner-payment-method-config/delete';
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }


    public static function addPaymentBankcodeConfig(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/partner-payment-method-config/create';
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }


    public static function getListPaymentBankcodeConfig(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/all-payment-method-and-bankcode';
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }


    public static function getListPaymentMethodConfig(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/partner-payment-method-config';
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }


    public static function editPartnerProvider($id, array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/transfer_money/transfer_money_partner_provider/update/' . $id;
        // $params['id'] = $id;
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    public static function addPartnerProvider(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/transfer_money/transfer_money_partner_provider/create';
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    public static function deletePartnerProvider($id)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/transfer_money/transfer_money_partner_provider/delete';
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

    public static function getListPartnerProvider(array $params)
    {
        $url = env('API_URL_EBILL_SERVICE') . '/api/cms/service/transfer_money/transfer_money_partner_provider';
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }



    public static function getList(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/partner-document-report';
        $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader());
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
    public static function detail(int $id)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/partner-document-report/'.$id;

        $result = Connection::sendRequest($url, [], 'GET', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

  /**
     * @param string $id
     * @return bool|mixed
     */
    public static function getByPartnerCode(string $partnerCode)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/cms/service/partner/detail/partner_code/'.$partnerCode;
        $result = Connection::sendRequest($url, [], 'GET', AuthenticationHelper::getHeader());
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
    public static function delete(int $id)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/partner-document-report/delete';
        $params = [
            'id'=> $id
        ];
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
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
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/partner-document-report/create';
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader(), true);
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
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/partner-document-report/update';
        $params['id'] = $id;
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }
}
