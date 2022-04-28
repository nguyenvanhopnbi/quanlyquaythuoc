<?php
namespace App\Connection;

use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;

class ToolConnection
{

    public static function updateTool($id, array $params)
    {
        $url = env('API_URL_GATE_SERVICE') . '/api/v1/bank-transaction/update/'.$id;
        // dd(AuthenticationHelper::getHeader());
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body']);

        return $resultBody;
    }


}
