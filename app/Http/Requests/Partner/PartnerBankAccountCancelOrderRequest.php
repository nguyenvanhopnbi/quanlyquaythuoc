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

class PartnerBankAccountCancelOrderRequest extends FormRequest
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
            'reason' => 'required|string|max:150',
        ];
    }

    public function attributes()
    {
        return [
            'reason' => 'Lí do huỷ',
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}
