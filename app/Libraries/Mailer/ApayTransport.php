<?php

namespace App\Libraries\Mailer;

use Exception;
use Firebase\JWT\JWT;
use GuzzleHttp\ClientInterface;
use Illuminate\Mail\Transport\Transport;
use Illuminate\Support\Facades\Log;
use Swift_Mime_SimpleMessage;

class ApayTransport extends Transport
{
    /**
     * Guzzle client instance.
     *
     * @var \GuzzleHttp\ClientInterface
     */
    protected $client;

    /**
     * The mailer API secret.
     *
     * @var string
     */
    protected $secret;

    /**
     * The mailer email domain.
     *
     * @var string
     */
    protected $domain;

    public function __construct(ClientInterface $clientInterface, $secret, $domain)
    {
        $this->client = $clientInterface;
        $this->secret = $secret;
        $this->domain = $domain;
    }

    /**
     * {@inheritdoc}
     */
    public function send(Swift_Mime_SimpleMessage $message, &$failedRecipients = null)
    {
        $this->beforeSendPerformed($message);

        $payload = [
            'headers' => ['Authorization' => $this->generateJWT()],
            'form_params' => [
                'from' => config('mail.from.address'),
                'to' => json_encode(collect($message->getTo())->keys()),
                'subject' => $message->getSubject(),
                'content' => base64_encode($message->getBody()),
                'content_type' => 'html',
                'cc' => json_encode($message->getCc() ?? []),
                'bcc' => json_encode($message->getBcc() ?? []),
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

        return $this->numberOfRecipients($message);
    }

    /**
     * Get the API key being used by the transport.
     *
     * @return string
     */
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
