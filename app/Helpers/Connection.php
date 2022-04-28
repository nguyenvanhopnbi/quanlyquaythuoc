<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Cache;

class Connection
{

    /**
     * function send request
     * url : string | url request
     * params : array | params request
     * method : string(POST, GET, PUT) | method request
     */


    public static function sendRequest($url, $params, $method = 'GET', $headers = [], $enableLog = true)
    {

        try {
            $start_time = microtime(true);
            $options = [
                // You can set any number of default request options.
                'connect_timeout' => 10,
                'timeout'  => 120,
                'http_errors' => false
            ];
            if ($headers) {
                $options['headers'] = $headers;
            }

            $client = new Client($options);
            if ($method === 'GET') {
                $response = $client->request('GET', $url, ['query' => http_build_query($params)]);
            } elseif ($method === 'POST') {
                $response = $client->request('POST', $url, ['form_params' => $params]);
            } elseif ($method === 'POST_RAW') {
                $response = $client->request('POST', $url, ['body' => $params]);
            } elseif ($method === 'POST_JSON') {
                $response = $client->request('POST', $url, ['body' => json_encode($params)]);
            }

            elseif ($method === 'PATCH') {
                // dd($client->request('PATCH', $url, ['body' => json_encode($params)]));
                $response = $client->request('PATCH', $url, ['form_params' => $params]);
            }

            $end_time = microtime(true);
            if ($enableLog) {
                Log::info('Log request', [
                    'url' => $url,
                    'params' => $params,
                    'options' => $options,
                    'code' => $response->getStatusCode(),
                    'body' => (string) $response->getBody(),
                    'request_time' => ($end_time - $start_time)
                    // 'count_requestCache' => $value
                ]);
            }
            // return response
            return array(
                'status_code' => $response->getStatusCode(),
                'body' => (string) $response->getBody()
            );
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $status_code = optional($e->getResponse())->getStatusCode() ?? 500;
            $error_message = ($e->getMessage() !== null) ? $e->getMessage() : 'Request Error';

            Log::warning('Request exception - ' . $error_message, ['url' => $url, 'params' => $params, 'method' => $method]);
            return [
                'status_code' => $status_code,
                'body' => $error_message
            ];
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            $error_message = ($e->getMessage() !== null) ? $e->getMessage() : 'Connect Error';

            Log::warning('Connect exception - ' . $error_message, ['url' => $url, 'params' => $params, 'method' => $method]);
            return [
                'status_code' => 500,
                'body' => $error_message
            ];
        }
    }
}
