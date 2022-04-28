<?php

namespace App\Mail;

use Firebase\JWT\JWT;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailOtp extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $payload = [
            'headers' => ['Authorization' => $this->generateJWT()],
            'form_params' => [
                'from' => config('mail.from.address'),
                'to' => json_encode(['minhmq@appota.com']),
                'subject' => 'subject',
                'content' => base64_encode('123'),
                'content_type' => 'html',
                'cc' => json_encode([]),
                'bcc' => json_encode([]),
            ],
        ];

        Log::debug('email payload', $payload);

        try {
            $start = microtime(true);
            $response = $this->client->request(
                'POST',
                "{$this->domain}/api/v1/email/send",
                $payload
            );
            $duration = microtime(true) - $start;
            Log::notice('api outgoing: ', [
                'url' => "{$this->domain}/api/v1/email/send",
                'request' => $payload,
                'response' => $response->getBody(),
                'duration' => $duration,
            ]);
        } catch (Exception $e) {
            Log::error('Gateway Request failed: ' . $e->getMessage());
        }
        return $this->to('minhmq@appota.com')->view('system.mail.mail_otp');
    }


    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set the API key being used by the transport.
     *
     * @param  string  $key
     * @return string
     */
    public function setKey($key)
    {
        return $this->key = $key;
    }

    /**
     * Get the domain being used by the transport.
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Set the domain being used by the transport.
     *
     * @param  string  $domain
     * @return string
     */
    public function setDomain($domain)
    {
        return $this->domain = $domain;
    }

    /**
     * Generate the token to use during the transport
     */
    private function generateJWT()
    {
        $payload = [
            "exp" => time() + 120
        ];
        return JWT::encode($payload, $this->secret);
    }
}
