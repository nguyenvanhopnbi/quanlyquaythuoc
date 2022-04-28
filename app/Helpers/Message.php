<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Session;

class Message
{
    /*
     * function get notice with message
     */
    public static function get($error_code = '16', $lang = '', $errors = array())
    {
//        $lang =  $lang ? $lang : (app('translator')->getLocale());
        $lang =  'vi';
        $messages = Message::getMessage($error_code);
        return Message::getArray($error_code, $messages[$lang], $errors);
    }

    /*
     * function get message by error code
     */
    public static function getMessage($error_code)
    {
        $errors = [
            1 => [
                'vi' => 'Thông tin yêu cầu thiếu hoặc không hợp lệ.',
                'en' => 'Parameters are Missing or Invalid.'
            ],
            10 => [
                'vi'    => 'Insert không thành công',
                'en'    => 'Insert Unsuccessful'
            ],

            11 => [
                'vi'    => 'Update không thành công',
                'en'    => 'Update Unsuccessful'
            ],

            12 => [
                'vi'    => 'Số tiền trừ đang lớn hơn số dư Partner còn',
                'en'    => 'Số tiền trừ đang lớn hơn số dư Partner còn'
            ],

            13 => [
                'vi'    => 'Cập nhật không thành công',
                'en'    => 'Upload Unsuccessful'
            ],

            20 => [
                'vi' => 'Mật khẩu không hợp lệ',
                'en' => 'Password not valid'
            ],

            21 => [
                'vi' => 'Xác nhận mật khẩu không khớp',
                'en' => 'Confirm password does not match'
            ],

            22 => [
                'vi' => 'Mật khẩu không đúng',
                'en' => 'Password is valid'
            ],

            30 => [
                'vi' => 'Email đã tồn tại trong hệ thống',
                'en' => 'Email was exist'
            ],

            31 => [
                'vi' => 'User đã tồn tại trong hệ thống',
                'en' => 'User was exist'
            ],

            32 => [
                'vi' => 'Email này đã tồn tại trong hệ thống',
                'en' => 'Email was exist'
            ],

            33 => [
                'vi' => 'Email này đã đăng ký nhận ưu đãi trước đó rồi',
                'en' => 'Email này đã đăng ký nhận ưu đãi trước đó rồi'
            ],

            34 => [
                'vi' => 'Thêm mới bill provider không thành công',
                'en' => 'Thêm mới bill provider không thành công'
            ],

            35 => [
                'vi' => 'Cập nhật bill provider không thành công',
                'en' => 'Cập nhật bill provider không thành công'
            ],
            36 => [
                'vi' => 'Thêm mới bill service không thành công',
                'en' => 'Thêm mới bill service không thành công'
            ],

            37 => [
                'vi' => 'Cập nhật bill service không thành công',
                'en' => 'Cập nhật bill service không thành công'
            ],

            38 => [
                'vi' => 'Định dạng file không đúng.',
                'en' => 'Định dạng file không đúng.'
            ],
            140 => [
                'vi' => 'Mã dịch vụ cho provider đã tồn tại',
                'en' => 'Mã dịch vụ cho provider đã tồn tại'
            ],
            141 => [
                'vi' => 'Trừ số dư của partner không thành công',
                'en' => 'Trừ số dư của partner không thành công'
            ],
            142 => [
                'vi' => 'Thêm số dư cho partner không thành công',
                'en' => 'Thêm số dư của partner không thành công'
            ],
            143=> [
                'vi' => 'Thêm mới partner không thành công',
                'en' => 'Thêm mới partner không thành công'
            ],
            144=> [
                'vi' => 'Cập nhật partner không thành công',
                'en' => 'Cập nhật partner không thành công'
            ],
            145=> [
                'vi' => 'Thêm mới Provider không thành công',
                'en' => 'Thêm mới Provider không thành công'
            ],

            146=> [
                'vi' => 'Chưa cấu hình phí cổng thanh toán',
                'en' => 'Chưa cấu hình phí cổng thanh toán'
            ]

        ];

        return isset($errors[$error_code]) ? $errors[$error_code] : ['vi'=> 'Lỗi không xác định', 'en'=> 'Lỗi không xác định'];
    }


    /*
     * function get error object
     */
    public static function getArray($error_code, $message, $errors)
    {
        return [
            'error' => [
                'code' => $error_code,
                'message' => $message,
                'errors' => $errors
            ]
        ];
    }

    public static function alertFlash($message, $flash)
    {
        Session::flash('message', $message);
        Session::flash('alert-class', $flash);
    }

}
