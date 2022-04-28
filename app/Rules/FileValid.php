<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class FileValid implements Rule
{
    public $message = null;
    public $maxSizeInMegabyte = 25;
    public $allowExtensions = ['jpg', 'jpeg', 'png', 'doc', 'docx', 'xlsx', 'xls', 'pdf', 'csv'];

    /**
     * @param string $attribute
     * @param mixed $value
     * @return bool
     * @throws Exception
     */
    public function passes($attribute, $value): bool
    {
        $size = $value->getSize();
        $maxSize = $this->maxSizeInMegabyte * 1000 * 1000; // max 5M
        ## check file
        if (!$value->isFile()) {
            $this->message = 'File tải lên không hợp lệ';
            return false;
        }

        ## check size
        if ($size > $maxSize) {
            $this->message = 'Lỗi tải file. Kích thước file tối đa là: ' . $this->maxSizeInMegabyte . 'M';
            return false;
        }

        ## check extension
        $extension = strtolower($value->getClientOriginalExtension());
        if (!in_array($extension, $this->allowExtensions)) {
            $this->message = 'File không hợp lệ. Định dạng cho phép bao gồm: ' . implode(',', $this->allowExtensions);
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return $this->message;
    }
}
