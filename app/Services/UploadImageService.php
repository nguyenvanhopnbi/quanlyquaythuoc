<?php

namespace App\Services;
use Log;
use App\Helpers\JWTHelper;
use App\Helpers\Connection;
use App\Helpers\AuthenticationHelper;


class UploadImageService
{

    public static function requestUpdateImage($params, $json_token){

        if(!isset($params) || !$params || $params == "" || !isset($json_token) || !$json_token || $json_token == ""){
            return array();
        }
        $header = array(
            "Authorization:$json_token",
            "Content-Type:multipart/form-data"
        );

        //gọi api
        $service_url = "https://static.appotapay.com/api/upload_ufr";
        $curl = curl_init($service_url);
        // dd($curl);
        if (function_exists('curl_file_create')) { // For PHP 5.5+
            $file = curl_file_create($params['image']);
        } else {
            $file = '@' . realpath($params['image']);
        }
        $postfields["pay_image"] = $file;
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postfields);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10); //Time out 5s
        $exec = curl_exec($curl);
        if (curl_error($curl)) {
            die(curl_error($curl));
        }
        curl_close($curl);
        $decoded = json_decode($exec);

        Log::info('upload_image_static_appota : ', ['header' => $header, 'param' => $params, 'data' => $decoded]);

        if (isset($decoded->msg) && $decoded->msg === "success") {
            $result['status'] = true;
            $result['url'] = $decoded->path_image;
            $result['width'] = $decoded->width;
            $result['height'] = $decoded->height;
            $result['size'] = $decoded->size;
            $result['preview_image'] = env('STATIC_IMAGE_URL') . $decoded->path_image;
            $result['data'] = $decoded;
        }else{
            $result['status'] = false;
        }

        return $result;
    }



    public static function UpdateImage($image){
        if(!isset($image) || !$image || $image == ""){
            return array();
        }

        $header = array(
            "Authorization:".JWTHelper::generateJWT(env('STATIC_AUTH_SECRET_KEY')),
            "Content-Type:multipart/form-data"
        );

        //gọi api
        $service_url = "https://static.appotapay.com/api/upload_ufr";
        $curl = curl_init($service_url);
        if (function_exists('curl_file_create')) { // For PHP 5.5+
            $file = curl_file_create($image);
        } else {
            $file = '@' . realpath($image);
        }
        $postfields["pay_image"] = $file;
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postfields);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10); //Time out 5s
        $exec = curl_exec($curl);
        //$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if (curl_error($curl)) {
            Log::info('curl_error : ', ['header' => $header, 'param' => $image, 'data' => $exec]);
            return ['status' => false];
        }
        curl_close($curl);
        $decoded = json_decode($exec);
        Log::info('upload_image_static_appota : ', ['header' => $header, 'param' => $image, 'data' => $decoded]);

        if (isset($decoded->msg) && $decoded->msg === "success") {
            $result['success'] = true;
            $result['url'] = $decoded->path_image;
            $result['width'] = $decoded->width;
            $result['height'] = $decoded->height;
            $result['size'] = $decoded->size;
            $result['preview_image'] = env('STATIC_IMAGE_URL') . $decoded->path_image;
            $result['data'] = $decoded;
        }else{
            $result['status'] = false;
        }

        return $result;
    }

    public static function callUpload($image){
        if(!isset($image) || !$image || $image == ""){
            return array();
        }

        $token = AuthenticationHelper::getHeaderImages();

        $header = [
            "Authorization" => $token['authorization'],
            "Content-Type" => "multipart/form-data"
        ];

        $params["pay_image"] = curl_file_create($image);
        //gọi api



        $service_url = "https://static.appotapay.com/api/upload_ufr";
        $result = Connection::sendRequest($service_url, $params, 'POST', $header);
        dd($result);

        return $result;

        if (isset($decoded->msg) && $decoded->msg === "success") {
            $result['success'] = true;
            $result['url'] = $decoded->path_image;
            $result['width'] = $decoded->width;
            $result['height'] = $decoded->height;
            $result['size'] = $decoded->size;
            $result['preview_image'] = env('STATIC_IMAGE_URL') . $decoded->path_image;
            $result['data'] = $decoded;
        }else{
            $result['status'] = false;
        }
        return $result;
    }

}

?>
