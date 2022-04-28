<?php

namespace App\Transformers\Game;

class GameSettingTransformer
{

    public static function convertSettingAttributes($item, $applications)
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
        $item['active_text'] = $item['active'] ? 'Hoạt động' : 'Chưa hoạt động';

        return $item;
    }

    public static function getStatuses()
    {
        return [
            'pending' => 'Chưa xét duyệt',
            'approved' => 'Đã duyệt',
            'rejected' => 'Đã từ chối',
        ];
    }

    public static function getStatusesColor()
    {
        return [
            'pending' => 'info',
            'approved' => 'success',
            'rejected' => 'danger',
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
