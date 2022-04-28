<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Connection\EbillConnection;
use App\Models\AuthOtp;
use App\Helpers\MailHelper;
use App\Helpers\SmsHelper;
use App\Services\System\AuthOtpService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;


class ResendTransaction extends Component
{

    protected $listeners = [
        'ResendTransaction' => 'ResendTransaction',
        'sendOtpTool' => 'sendOtpTool',
        'resetButtonSMS' => 'resetButtonSMS',
        'resetButtonEmail' => 'resetButtonEmail'
    ];

    public function render()
    {
        return view('livewire.resend-transaction');
    }



    public $message;
    public $waring = false;




    public function ResendTransaction($account_no, $amount, $provider_ref_id, $transaction_time, $provider, $memo, $emailCode, $phoneCode){

        $user = Auth::user();
        if(!isset($user->email)){
            return;
        }

        if(Cache::get($user->email) == null){
            $this->message = "Chưa khởi tạo được code cho email";
            $this->waring = true;
            return;
        }

        if(Cache::get($user->email."phone") == null){
            $this->message = "Chưa khởi tạo được code cho sms";
            $this->waring = true;
            return;
        }

        if($emailCode != Cache::get($user->email)){
            $this->message = "Email code không hợp lệ hoặc đã hết hạn.";
            $this->waring = true;
            return;
        }

        if($phoneCode != Cache::get($user->email."phone")){
            $this->message = "Phone code không hợp lệ hoặc đã hết hạn.";
            $this->waring = true;
            return;
        }


        $params = [];
        $params['account_no'] = $account_no;
        $params['amount'] = $amount;
        $params['provider_ref_id'] = $provider_ref_id;
        $params['transaction_time'] = strtotime($transaction_time);
        $params['provider_code'] = $provider;
        $params['memo'] = $memo;

        $result = EbillConnection::resendTransactionEbill($params);

        if(!$result){

            $this->message = "Resend thất bại! Account No: ". $account_no;
            $this->waring = true;
            return;

        }

        if(isset($result)){
            if($result->errorCode == '0'){
                $this->message = "Resend thành công! Account No: ". $account_no;
                $this->waring = false;

                Cache::forget($user->email);
                Cache::forget($user->email."phone");

                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::EBILL_TRANSACTION, "Resend Transaction VA thành công #Account No" .$account_no, compact('params')));

            }else{
                $this->message = "Resend thất bại! Account No: ". $account_no;
                $this->waring = true;
            }
        }else{
            $this->message = "Resend thất bại! Account No: ". $account_no;
            $this->waring = true;
        }

        // $this->emit('ResendMessageScript');
    }

    public function resetButtonSMS(){

        unset($this->phoneCode);
    }

    public function resetButtonEmail(){
        // dd('vao day');
        unset($this->emailCode);
    }


    public $otpCountTime;
    public $emailCode;
    public $phoneCode;

    public function sendOtpTool($smsMethod, $emailMethod)
    {
        $user = Auth::user();
        if(!isset($user->email)){
            return;
        }


        $authOtpService = new AuthOtpService();

        $genCode = AuthOtp::generateOtpCode();
        $code = $genCode['code'];
        $data = [
            'email' => $emailMethod === 'email' ? MailHelper::getDefaultEmailForOtpCode() : null,
            'phone' => $smsMethod === 'sms' ? SmsHelper::getDefaultPhoneForOtpCode() : null,
            'secure_code' => $genCode['secure_code'],
            'expired_at' => now()->addMinutes(10),
            'max_retry' => 5,
            'times_retry' => 0,
        ];

        $channel = '';
        if($emailMethod == 'email' and $smsMethod == 'no'){
            $channel = $emailMethod;
        }
        if($smsMethod == 'sms' and $emailMethod == 'no'){
            $channel = $smsMethod;
        }

        if (!$data['email'] && !$data['phone']) {
            return response(['success' => false, 'message' => 'Vui lòng nhập thông tin sms/email nhận OTP']);
        }
        $otpCountTime = $authOtpService->getOtpCountTime($channel);
        if ($otpCountTime) {
            return response(['success' => false, 'message' => 'Vui lòng gửi lại sau ' . $otpCountTime . ' giây']);
        }

        if ($data['email']) {
            $success = $authOtpService->sendMailOtp($data['email'], $code);
            Cache::put($user->email, $code, 300);
            $this->emailCode = Cache::get($user->email);
        } elseif ($data['phone']) {
            $success = $authOtpService->sendSmsOtp($data['phone'], $code);
            Cache::put($user->email."phone", $code, 300);
            $this->phoneCode = Cache::get($user->email."phone");
        } else {
            $success = false;
        }

        if (!$success) {
            return response(['success' => false]);
        }
        $authOtpService->setExpireTime(300, $channel);
        $authOtpService->createOtp($data);
        $otpCountTime = $authOtpService->getOtpCountTime($channel);
        $expiredAt = now()->addSeconds($otpCountTime)->getTimestamp();
        Log::info('111111111SMSEmail11111111', ['email' => $data['email'], 'phone' => $data['phone'], 'code' => $code, 'otpCountTime' => $otpCountTime, 'expiredAt' => $expiredAt, 'emailCode' => $this->emailCode, 'phoneCode' => $this->phoneCode]);
        return response(['success' => true, 'expiredAt' => $expiredAt]);
    }


}
