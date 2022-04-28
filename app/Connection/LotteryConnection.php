<?php
namespace App\Connection;

use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;

class LotteryConnection
{

    static $key1111 = ['x-api-key' => 'PWads7JpBONYSUWEzopEuP6DrGu1OVwX'];


    public static function getListLotteryPrizeOverview(array $params)
    {
        $url = env('LOTTERY_SERVICE') . '/api/v1/cms/lottery-win-overview';
        $result = Connection::sendRequest($url, $params, 'GET', self::$key1111, true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    public static function getListLotteryPrizeDetails(array $params, $id)
    {
        $url = env('LOTTERY_SERVICE') . '/api/v1/cms/lottery-win/' . $id;
        // $url = 'https://lottery.dev.appotapay.com/api/v1/cms/lottery-transaction';
        $result = Connection::sendRequest($url, $params, 'GET', self::$key1111, true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }


    public static function getListLotteryPrize(array $params)
    {
        $url = env('LOTTERY_SERVICE') . '/api/v1/cms/lottery-win';
        // $url = 'https://lottery.dev.appotapay.com/api/v1/cms/lottery-transaction';
        $result = Connection::sendRequest($url, $params, 'GET', self::$key1111, true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    public static function getListProviderLottery(array $params)
    {
        $url = env('LOTTERY_SERVICE') . '/api/v1/cms/provider';
        // $url = 'https://lottery.dev.appotapay.com/api/v1/cms/lottery-transaction';
        $result = Connection::sendRequest($url, $params, 'GET', self::$key1111, true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }


    public static function getList(array $params)
    {
        $url = env('LOTTERY_SERVICE') . '/api/v1/cms/lottery-transaction';
        // $url = 'https://lottery.dev.appotapay.com/api/v1/cms/lottery-transaction';
        $result = Connection::sendRequest($url, $params, 'GET', self::$key1111, true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    public static function getListDetails(array $params, $id)
    {
        $url = env('LOTTERY_SERVICE') . '/api/v1/cms/lottery-transaction/' .$id;
        // $url = 'https://lottery.dev.appotapay.com/api/v1/cms/lottery-transaction';
        $result = Connection::sendRequest($url, $params, 'GET', ['x-api-key' => 'PWads7JpBONYSUWEzopEuP6DrGu1OVwX'], true);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    public static function getListLoaiVe(array $params)
    {
        $url = env('LOTTERY_SERVICE') . '/api/v1/cms/lottery';
        $result = Connection::sendRequest($url, $params, 'GET', ['x-api-key' => 'PWads7JpBONYSUWEzopEuP6DrGu1OVwX']);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    public static function getListProviderCode(array $params)
    {
        $url = env('LOTTERY_SERVICE') . '/api/v1/cms/provider';
        $result = Connection::sendRequest($url, $params, 'GET', ['x-api-key' => 'PWads7JpBONYSUWEzopEuP6DrGu1OVwX']);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    public static function getOverview(array $params)
    {
        $url = env('LOTTERY_SERVICE') . '/api/v1/cms/lottery-transaction-overview';
        $result = Connection::sendRequest($url, $params, 'GET', ['x-api-key' => 'PWads7JpBONYSUWEzopEuP6DrGu1OVwX']);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

    // public static function getList(array $params)
    // {
    //     $url = env('LOTTERY_SERVICE') . '/api/v1/cms/lottery-transaction';
    //     $result = Connection::sendRequest($url, $params, 'GET', AuthenticationHelper::getHeader());
    //     $resultBody = json_decode($result['body']);
    //     if ($result['status_code'] != 200) {
    //         return false;
    //     }
    //     return $resultBody;
    // }


    public static function detail($id)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/cc-rule-special/'.$id;

        $result = Connection::sendRequest($url, [], 'GET', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function add(array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/partner-appota-service/create';
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }
    public static function delete(int $id)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/partner-appota-service/delete';
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

    public static function edit(int $id, array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/partner-appota-service/update';
        $params['id'] = $id;
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader());
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }

}
