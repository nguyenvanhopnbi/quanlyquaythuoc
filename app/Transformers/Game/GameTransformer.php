<?php

namespace App\Transformers\Game;

class GameTransformer
{

    public static function convertTransactionAttributes($item, $applications)
    {
        $statuses = self::getStatuses();
        $colors = self::getStatusesColor();
        foreach ($applications as $application) {
            if ($application->id == $item['application_id']) {
                $item['application_name'] = $application->name;
            }
        }
        if (isset($statuses[$item['status']])) {
            $item['status_text'] = $statuses[$item['status']];
        } else {
            $item['status_text'] = $item['status'];
        }
        $item['status_color'] = isset($colors[$item['status']]) ? $colors[$item['status']] : 'default';

        return $item;
    }

    public static function getStatuses()
    {
        return [
            'pending' => 'Chờ thanh toán',
            'error' => 'Thất bại',
            'success' => 'Thành công',
        ];
    }
    public static function getStatusesColor()
    {
        return [
            'pending' => 'info',
            'success' => 'success',
            'error' => 'danger',
        ];
    }


    public static function getActives()
    {
        return [
            0 => 'Chưa hoạt động',
            1 => 'Đang hoạt động',
        ];
    }


}
