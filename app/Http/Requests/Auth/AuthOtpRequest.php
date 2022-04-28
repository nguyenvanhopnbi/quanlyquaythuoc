<?php

namespace App\Http\Requests\Auth;

use App\Services\System\TransferAccountService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class AuthOtpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'otp_email' => 'required|string|email',
        ];
    }

    public function messages()
    {
        return [
            'account_id.required' => 'Vui lòng chọn tài khoản cần chuyển',
            'total_amount.required' => 'Vui lòng nhập tổng số tiền cần chuyển',
            'total_amount.min' => 'Số tiền phải lớn hơn :min đ',
            'amount_per_trans.min' => 'Số tiền phải lớn hơn :min đ',
            'otp_email.required_if' => 'Vui lòng nhập email nhận OTP',
            'amount_per_trans.required' => 'Vui lòng nhập số tiền cần chuyển trong 1 giao dịch',
        ];
    }

    public function attributes()
    {
        return [
            'account_id' => 'tài khoản',
            'total_amount' => 'tổng số tiền',
            'amount_per_trans' => 'số tiền chuyển trong 1 giao dịch',
            'otp_email' => 'email nhận otp',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $accountId = \Request::input('account_id');
        if($accountId) {
            $account = app(TransferAccountService::class)->getById($accountId);
            \Session::flash('account', $account);
        }

        throw (new ValidationException($validator))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
