<?php

namespace App\Http\Controllers\Traits;

use Exception;
use Request;

trait ConfirmOtp
{
    protected function confirmOtp(Request $request)
    {
        $this->validateOtp();

        if ($this->hasTooManyOtpAttempts()) {
            throw new Exception();
        }

        if (!$this->verifyOtp()) {
            $this->incrementAttempts($request);
            return $this->sendFailedOtpResponse($request);
        }
    }


    protected function validateOtp()
    {
    }
}
