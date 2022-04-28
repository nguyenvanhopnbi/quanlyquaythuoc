<?php

namespace App\Services\File;

use App\Connection\PartnerBankAccountConnection;
use App\Connection\PartnerConnection;
use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;
use App\Helpers\Signature;
use App\Models\PartnerBankTransfer;
use App\Repositories\PartnerBankTransferRepository;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UploadFileService
{
    public function uploadImageToStaticServer($file)
    {
        $url = env('STATIC_APPOTAPAY_URL', 'https://static.appotapay.com');
        $return = [
            'success' => false,
            'path' => null,
        ];
        $uri = $url . '/api/upload_ep';
//        $url = 'https://static.appotapay.com/api/upload_ep';
        $client = new Client([]);
        try {
            $response = $client->request('post',
                $uri, [
                    'headers' => [
                        'Authorization' => 'a904498e9d47ff3f9fc0d390826f1934',
                    ],
                    'multipart' => [
                        [
                            'name' => 'pay_image',
                            'filename' => 'pay_image.jpg',
                            'contents' => file_get_contents($file),
                        ],
                        [
                            'name' => 'expires',
                            'contents' => 3600,
                        ]
                    ],
                ],
            );
            $content = $response->getBody()->getContents();
            $body = json_decode($content, true);
            if (isset($body['code']) && $body['code'] == 200) {
                $return['success'] = true;
                $return['path'] = $url . $body['path_image'];
            }

        } catch (\Exception $e) {
            Log::error('UploadFileService@uploadFile ', [$e]);
        }
        return $return;
    }

    public function saveLocalFile($file, $path = null)
    {
        $return = [
            'path' => null,
            'url' => null,
            'success' => false,
            'message' => null,
        ];
        try {
            $path = $path ? $path : date('d-m-Y');
            $return['path'] = \Storage::disk('public_folder')->putFileAs($path, $file, Str::random() . '.' . $file->getClientOriginalExtension());
            $return['path'] = '/file/public/' . $return['path'];
            $return['success'] = true;
            $return['url'] = \Storage::disk('public_folder')->url($return['path']);
        } catch (\Exception $e) {
            $return['message'] = $e->getMessage();
            Log::error('UploadFileService@saveFile', [$e]);
        }
        return $return;
    }

}
