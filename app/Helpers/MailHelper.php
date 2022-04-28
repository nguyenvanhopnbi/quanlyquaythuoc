<?php

namespace App\Helpers;

use Firebase\JWT\JWT;
use Log;

class MailHelper
{

    /**
     * @param string $from
     * @param array $to
     * @param string $subject
     * @param string $content
     * @param string $type
     * @param array $cc
     * @param array $bcc
     * @return bool
     */
    public static function sendViaRQ(string $from, array $to, string $subject, string $content, string $type = 'html', string $linkAttackFile = '', string $nameFileAttack = '', array $cc = [], array $bcc = []): bool
    {
        Log::debug('MailHelper@sendViaRQ start send mail ', ['to' => $to, 'subject' => $subject, 'content' => $content]);
        if (!$to or !$from)
            return false;

        $type = ($type == 'html') ? $type : 'plain';

        $params = [
            'from' => $from,
            'to' => json_encode($to),
            'subject' => $subject,
            'content' => base64_encode($content),
            'content_type' => $type,
            'cc' => json_encode($cc),
            'bcc' => json_encode($bcc)
        ];

        if (!empty($linkAttackFile) and !empty($nameFileAttack)) {
            $params['attachment_file'] = $linkAttackFile;
            $params['attachment_filename'] = $nameFileAttack;
        }
        $headers = [
            'Authorization' => self::generateJWT()
        ];

        $url = env('MAIL_SERVICE_API_URL') . '/api/v1/email/send';
        $result = Connection::sendRequest($url, $params, 'POST', $headers);
        $resBody = json_decode($result['body']);
        Log::info('MailHelper@sendViaRQ result send email : ', ['$url' => $url, '$params' => $params, 'res' => $resBody]);

        if (isset($resBody->success) && $resBody->success === true) {
            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    private static function generateJWT(): string
    {
        $payload = [
            "exp" => time() + 120
        ];
        return JWT::encode($payload, env('MAIL_SERVICE_SECRET_KEY'));
    }

    public static function getDefaultEmailForOtpCode()
    {
        return \Auth::user()->email;
    }

    public static function getDefaultEmailForOtpCodePartnerBankAccountTransfer()
    {
        return env('PARTNER_BANK_ACCOUNT_EMAIL_OTP') ?: 'thoantk@appota.com';
    }

}
