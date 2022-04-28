<?php
namespace App\Connection;

use App\Helpers\Connection;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\Log;

class ChargingConnection
{


    public static function getListSandbox(array $params, string $partnerCode = null)
    {

        $cipher = 'AES-256-CBC';
        $key = md5(env('APPOTACARD_CHARGING_SERVICE_KEY'));
        $crypt = new Encrypter($key, $cipher);

        $url = env('API_URL_APPOTACARD_CHARGING_SERVICE') . '/v1/cms/card/sandbox/transactions';
        if($partnerCode == null){
            $header = [
                'Authorization'=> md5(env('APPOTACARD_CHARGING_SERVICE_KEY'))
            ];
        }else{
            $header = [
                'Authorization'=> md5(env('APPOTACARD_CHARGING_SERVICE_KEY')),
                'X-PARTNER' => $crypt->encrypt($partnerCode)
            ];
        }

        $result = Connection::sendRequest($url, $params, 'GET', $header);

        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }
        return $resultBody;
    }


    public static function getList(array $params, string $partnerCode = null)
    {

        $cipher = 'AES-256-CBC';
        $key = md5(env('APPOTACARD_CHARGING_SERVICE_KEY'));
        $crypt = new Encrypter($key, $cipher);

        $url = env('API_URL_APPOTACARD_CHARGING_SERVICE') . '/v1/cms/card/transactions';
        if($partnerCode == null){
            $header = [
                'Authorization'=> md5(env('APPOTACARD_CHARGING_SERVICE_KEY'))
            ];
        }else{
            $header = [
                'Authorization'=> md5(env('APPOTACARD_CHARGING_SERVICE_KEY')),
                'X-PARTNER' => $crypt->encrypt($partnerCode)
            ];
        }

        $result = Connection::sendRequest($url, $params, 'GET', $header);

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
    public static function detail(string $id, string $partnerCode = null)
    {

        $cipher = 'AES-256-CBC';
        $key = md5(env('APPOTACARD_CHARGING_SERVICE_KEY'));
        $crypt = new Encrypter($key, $cipher);

        if($partnerCode == null){
            $header = [
                'Authorization'=> md5(env('APPOTACARD_CHARGING_SERVICE_KEY')),
                'X-PARTNER' => $crypt->encrypt($partnerCode)
            ];
        }else{
            $header = [
                'Authorization'=> md5(env('APPOTACARD_CHARGING_SERVICE_KEY')),
                'X-PARTNER' => $crypt->encrypt($partnerCode)
            ];
        }


        $url = env('API_URL_APPOTACARD_CHARGING_SERVICE') . '/v1/cms/card/transaction/'.$id;

        $result = Connection::sendRequest($url, [], 'GET', $header);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function getChartTransaction($params, string $partnerCode = null)
    {

        $cipher = 'AES-256-CBC';
        $key = md5(env('APPOTACARD_CHARGING_SERVICE_KEY'));
        $crypt = new Encrypter($key, $cipher);

        if($partnerCode == null){
            $header = [
                'Authorization'=> md5(env('APPOTACARD_CHARGING_SERVICE_KEY'))
            ];
        }else{
            $header = [
                'Authorization'=> md5(env('APPOTACARD_CHARGING_SERVICE_KEY')),
                'X-PARTNER' => $crypt->encrypt($partnerCode)
            ];
        }


        $url = env('API_URL_APPOTACARD_CHARGING_SERVICE') . '/v1/cms/chart/axis';

        $result = Connection::sendRequest($url, $params, 'GET', $header);

        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function getChartPieTransaction($params, string $partnerCode = null)
    {

        $cipher = 'AES-256-CBC';
        $key = md5(env('APPOTACARD_CHARGING_SERVICE_KEY'));
        $crypt = new Encrypter($key, $cipher);

        if($partnerCode == null){
            $header = [
                'Authorization'=> md5(env('APPOTACARD_CHARGING_SERVICE_KEY'))
            ];
        }else{
            $header = [
                'Authorization'=> md5(env('APPOTACARD_CHARGING_SERVICE_KEY')),
                'X-PARTNER' => $crypt->encrypt($partnerCode)
            ];
        }


        $url = env('API_URL_APPOTACARD_CHARGING_SERVICE') . '/v1/cms/chart/pie';

        $result = Connection::sendRequest($url, $params, 'GET', $header);
        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }

    public static function getReportPartnerByDay($params, string $partnerCode = null)
    {

        $cipher = 'AES-256-CBC';
        $key = md5(env('APPOTACARD_CHARGING_SERVICE_KEY'));
        $crypt = new Encrypter($key, $cipher);

        if($partnerCode == null){
            $header = [
                'Authorization'=> md5(env('APPOTACARD_CHARGING_SERVICE_KEY'))
            ];
        }else{
            $header = [
                'Authorization'=> md5(env('APPOTACARD_CHARGING_SERVICE_KEY')),
                'X-PARTNER' => $crypt->encrypt($partnerCode)
            ];
        }


        $url = env('API_URL_APPOTACARD_CHARGING_SERVICE') . '/v1/cms/report/flash';

        $result = Connection::sendRequest($url, $params, 'GET', $header);

        // Log::info('1111111', ['result'=>$result, 'partnerCode'=>$partnerCode, 'params'=>$params]);

        $resultBody = json_decode($result['body']);
        if ($result['status_code'] != 200) {
            return false;
        }

        return $resultBody;
    }
}
