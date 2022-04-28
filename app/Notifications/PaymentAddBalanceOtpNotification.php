<?php

namespace App\Notifications;

use Erdemkeren\Otp\TokenInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class PaymentAddBalanceOtpNotification extends Notification implements ShouldQueue
{
    use Queueable;


    public $token;

    public function __construct(TokenInterface $token)
    {
        $this->token = $token;
        Log::info('log_token_plain_text', [$this->token->plainText()]);
        dump($this->token->plainText());
    }

    public function via($notifiable)
    {

        $channels = !is_null($notifiable) && method_exists($notifiable, 'otpChannels') && !empty($notifiable->otpChannels())
            ? $notifiable->otpChannels()
            : config('otp.default_channels');


        return \is_array($channels)
            ? $channels
            : array_map('trim', explode(',', $channels));
    }

    public function toMail(): MailMessage
    {
        return (new MailMessage())
            ->subject('[APPOTAPAY] - Xác nhận nạp tiền')
            ->line('Mã OTP xác nhận giao dịch nạp tiền: ' . $this->token->plainText());
    }
}
