<?php

namespace App\Libraries\Mailer;

use Illuminate\Mail\MailManager;

class ApayMailManager extends MailManager
{
    protected function createApayTransport()
    {
        $config = $this->app['config']->get('services.apay_mail', []);
        return new ApayTransport(
            $this->guzzle($config),
            $config['secret'],
            $config['domain']
        );
    }
}
