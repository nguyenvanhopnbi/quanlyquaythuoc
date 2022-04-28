<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\PaymentAddBalanceOtpNotification;
use Erdemkeren\Otp\OtpFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;


class ConfirmOtpController extends Controller
{
    public function sendNewOtpToUser(Request $request)
    {

        $user = $request->user();
        $token = OtpFacade::create($user, 6);
        $token->extend(180);
        // $token->expiry_time = 300;

        $user->notify(new PaymentAddBalanceOtpNotification($token));
        $request->session()->put('otp_token', (string) $token);

        // if(env('APP_ENV') == 'local' || env('APP_ENV') == 'dev' || env('APP_ENV') == 'LOCAL' || env('APP_ENV') == 'DEV'){
        //     $details = [
        //         'otp' => $token->plainText(),
        //         'name' => $user->name,
        //     ];
        //     Mail::to($user->email)->send(new TestMail($details));
        // }


        return response()->json('', 204);
    }
}
