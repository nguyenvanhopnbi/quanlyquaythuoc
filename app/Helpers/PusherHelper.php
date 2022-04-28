<?php


namespace App\Helpers;


class PusherHelper
{

    public const PUSHER_CHANNEL_EXPORT_READY  = 'file-export-transaction-ready-';
    public const PUSHER_EVENT_EXPORT_READY  = 'file-export-transaction-ready-';

    public static function getExportChannel(int $userId): string
    {
        return self::PUSHER_CHANNEL_EXPORT_READY.$userId;
    }

    public static function getExportEven(string $secret): string
    {
        return self::PUSHER_EVENT_EXPORT_READY.$secret;
    }
}
