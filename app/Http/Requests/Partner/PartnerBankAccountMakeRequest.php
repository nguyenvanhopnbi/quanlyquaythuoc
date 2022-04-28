<?php

namespace App\Http\Requests\Partner;

use App\Rules\AmountValid;
use App\Rules\FileValid;
use App\Services\System\TransferAccountService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\ValidationException;

class PartnerBankAccountMakeRequest extends FormRequest
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
            'account_id' => 'required',
            'bbds_id' => 'required|string|max:30',
            'content' => 'required|string|max:60|regex:/^[a-zA-Z0-9\s]+$/',
            'amount' => ['required', 'integer', 'min:100000', new AmountValid()],
            'otp_sms_code' => 'required',
            'file_attach' => ['required', 'file', new FileValid()],
        ];
    }


    public function attributes()
    {
        return [
            'account_id' => 'tài khoản nhận tiền',
            'amount' => 'tổng số tiền',
            'bbds_id' => 'biên bản đối soát id',
            'otp_method' => 'phương thức nhận otp',
            'otp_sms_code' => 'mã otp',
            'content' => 'nội dung chuyển tiền',
            'file_attach' => 'file đối soát',
        ];
    }

    public function messages()
    {
        return [
            'file_url.required' => 'Bạn chưa tải lên file đối soát đính kèm trên email',
            'otp_sms_code.required' => 'OTP không được để trống',
            'content.regex' => 'Chỉ được nhập chữ không dấu, số và tối đa 60 ký tự',
        ];
    }
}
