<?php

namespace App\Helpers;

use App\Services\UploadImageService;
use \Firebase\JWT\JWT;
use Validator;

class UploadImage
{

    public static function upload($image)
    {

        // getting all of the post data
        $file = array('image' => $image);

        // setting up rules
        $rules = array(
            'image' => 'mimes:jpeg,jpg,png|required|max:10000' // max 10000kb
        );
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            $result['status'] = false;
            $result['msg'] = "File không hợp lệ !";
            return $result;
        } else {
            // checking file is valid.
            if ($image->isValid()) {
                $params_upload['image'] = $image;
                $token = array(
                    "exp" => time() + 15
                );

                $json_token = JWT::encode($token, env('JWT_SECRET'));
                $response = UploadImageService::requestUpdateImage($params_upload, $json_token);
                if ($response['status']) {
                    $result['status'] = true;
                    $result['url'] = $response['url'];
                    $result['width'] = $response['width'];
                    $result['height'] = $response['height'];
                    $result['size'] = $response['size'];
                    $result['preview_image'] = $response['preview_image'];
                    return $result;
                } else {
                    $result['status'] = false;
                    $result['msg'] = "Lỗi khi Upload Image !";
                    return $result;
                }
            }
        }
    }

}
