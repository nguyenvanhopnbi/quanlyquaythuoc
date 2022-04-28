<?php

namespace App\Rules;

use App\Helpers\Message;
use Illuminate\Contracts\Validation\Rule;

class AmountValid implements Rule
{
    const MIN_AMOUNT = 10000;
    const MAX_AMOUNT = 500000000;

    /**
     * @param string $attribute
     * @param mixed $value
     * @return bool
     * @throws Exception
     */
    public function passes($attribute, $value): bool
    {
        if ($value >= self::MIN_AMOUNT && $value <= self::MAX_AMOUNT) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return __('Số tiền thanh toán không hơp lệ');
    }
}
