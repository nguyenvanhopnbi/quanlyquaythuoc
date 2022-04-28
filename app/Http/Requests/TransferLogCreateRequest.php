<?php

namespace App\Http\Requests;

use App\Services\System\TransferAccountService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class TransferLogCreateRequest extends FormRequest
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
            'account_from_id' => 'required',
            'account_to_id' => 'required|different:account_from_id',
            'total_amount' => 'required|numeric|min:50000',
            'amount_per_trans' => 'required|numeric|min:50000|lte:total_amount',
            'content' => 'required|string|max:150|regex:/^[a-zA-Z0-9\s]+$/',
            'otp_sms_code' => 'required',
            'otp_email_code' => 'required',
            'is_schedule' => 'nullable|in:1',
            'schedule_type' => 'nullable|required_if:is_schedule,1|in:once,daily',
            'schedule_at' => 'nullable|required_if:is_schedule,1|date_format:G:i',
            'scheduled_date' => 'nullable|required_if:schedule_type,once|date_format:d/m/Y',
        ];
    }

    public function messages()
    {
        return [
            'account_from_id.required' => 'Vui lòng chọn tài khoản chuyển tiền',
            'account_to_id.required' => 'Vui lòng chọn tài khoản nhận tiền',
            'total_amount.required' => 'Vui lòng nhập tổng số tiền cần chuyển',
            'total_amount.min' => 'Số tiền phải lớn hơn :min đ',
            'amount_per_trans.min' => 'Số tiền phải lớn hơn :min đ',
            'amount_per_trans.lte' => 'Số tiền mỗi lần chuyển trong 1 giao dịch phải nhỏ hơn hoặc bằng tổng tiền chuyển',
            'otp_sms.required_if' => 'Vui lòng nhập số điện nhận OTP',
            'otp_email.required_if' => 'Vui lòng nhập email nhận OTP',
            'amount_per_trans.required' => 'Vui lòng nhập số tiền cần chuyển trong 1 giao dịch',
            'otp_code.required' => 'Vui lòng nhập mã OTP đã gửi về sms/email',
            'content.max' => 'Vui lòng nhập mã OTP đã gửi về sms/email',
            'content.regex' => 'Nội dung chỉ phép nhập tiếng việt không dấu, bao gồm chữ cái, chữ số, dấu cách',
        ];
    }

    public function attributes()
    {
        return [
            'account_id' => 'tài khoản',
            'total_amount' => 'tổng số tiền',
            'amount_per_trans' => 'số tiền chuyển trong 1 giao dịch',
            'otp_method' => 'phương thức nhận otp',
            'otp_sms' => 'số điện thoại nhận otp',
            'otp_email' => 'email nhận otp',
            'content' => 'nội dung chuyển tiền',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $accFromId = \Request::input('account_from_id');
        $accToId = \Request::input('account_to_id');
        if($accFromId) {
            $account = app(TransferAccountService::class)->getById($accFromId);
            \Session::flash('account_from', $account);
        }
        if($accToId) {
            $account = app(TransferAccountService::class)->getById($accToId);
            \Session::flash('account_to', $account);
        }

        throw (new ValidationException($validator))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
