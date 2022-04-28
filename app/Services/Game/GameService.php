<?php

namespace App\Services\Game;

use App\Connection\PaymentLinkConnection;
use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;

class GameService
{
    public function overview(array $filter = []): array
    {
        $url = env('GAME_SERVICE_API_URL') . '/api/v1/cms/game/overview';
        $result = Connection::sendRequest($url, $filter, 'GET', AuthenticationHelper::getHeaderGameService(), true);
        $resultBody = json_decode($result['body'], true);
        return $resultBody['data'] ?? [];
    }

    public function transactions(array $filter = []): array
    {
        $url = env('GAME_SERVICE_API_URL') . '/api/v1/cms/game/payments';
        $result = Connection::sendRequest($url, $filter, 'GET', AuthenticationHelper::getHeaderGameService(), true);
        $resultBody = json_decode($result['body'], true);
        return $resultBody['data'] ?? [];
    }

    public function settings(array $filter = []): array
    {
        $url = env('GAME_SERVICE_API_URL') . '/api/v1/cms/game/settings';
        $result = Connection::sendRequest($url, $filter, 'GET', AuthenticationHelper::getHeaderGameService(), true);
        $resultBody = json_decode($result['body'], true);
        return $resultBody['data'] ?? [];
    }

    public function settingApprove(string $settingId, string $status): array
    {
        $url = env('GAME_SERVICE_API_URL') . "/api/v1/cms/game/setting/$settingId/approve";
        $params = ['status' => $status];
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeaderGameService(), true);
        $resultBody = json_decode($result['body'], true);
        if (isset($resultBody['error'])) {
            return ['success' => false, 'message' => $resultBody['error']['message'] ?? 'Lỗi không thể duyệt'];
        }
        return ['success' => isset($resultBody['success']), 'message' => $resultBody['message'] ?? ''];
    }

    public function settingActive(string $settingId, bool $active): array
    {
        $url = env('GAME_SERVICE_API_URL') . "/api/v1/cms/game/setting/$settingId/active";
        $params = ['active' => $active];
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeaderGameService(), true);
        $resultBody = json_decode($result['body'], true);
        if (isset($resultBody['error'])) {
            return ['success' => false, 'message' => $resultBody['error']['message'] ?? 'Lỗi không thể thao tác'];
        }
        return ['success' => isset($resultBody['success']), 'message' => $resultBody['message'] ?? ''];
    }

    public function settingUpdate(string $settingId, array $params): array
    {
        $url = env('GAME_SERVICE_API_URL') . "/api/v1/cms/game/setting/$settingId/update";
        $result = Connection::sendRequest($url, $params, 'POST', AuthenticationHelper::getHeaderGameService(), true);
        $resultBody = json_decode($result['body'], true);
        if (isset($resultBody['error'])) {
            return ['success' => false, 'data' => $resultBody['error']['errors'] ?? [], 'message' => $resultBody['error']['message'] ?? 'Lỗi không thể thao tác'];
        }
        return ['success' => isset($resultBody['success']), 'message' => $resultBody['message'] ?? ''];
    }

}
