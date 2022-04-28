<?php

namespace App\Providers;

use App\Libraries\Mailer\ApayMailManager;
use Illuminate\Mail\MailServiceProvider as ServiceProvider;

class MailServiceProvider extends ServiceProvider
{
    /**
     * Register the Illuminate mailer instance.
     *
     * @return void
     */
    protected function registerIlluminateMailer()
    {
        $this->app->singleton('mail.manager', function ($app) {
            return new ApayMailManager($app);
        });

        $this->app->bind('mailer', function ($app) {
            return $app->make('mail.manager')->mailer();
        });
    }
}
