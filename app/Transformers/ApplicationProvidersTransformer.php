<?php
namespace App\Transformers;

class ApplicationProvidersTransformer
{
    /**
     * @param $data
     * @return mixed
     */
    public static function transformCollectionApplication($data, $applications)
    {
        if ($data) {
            foreach ($data as &$item) {
                $item->application_name = isset($applications[$item->application_id]) ? $applications[$item->application_id]->name : '';
                $item->created_at = date("d-m-Y H:i:s", $item->created_at);
                $item->updated_at = date("d-m-Y H:i:s", $item->updated_at);
            }
        }
        return $data;
    }

    public static function transformApplication($data, $applications)
    {
        if ($data) {
            $data->application_name = isset($applications[$data->application_id]) ? $applications[$data->application_id]->name : '';
            $data->created_at = date("d-m-Y H:i:s", $data->created_at);
            $data->updated_at = date("d-m-Y H:i:s", $data->updated_at);
        }
        return $data;
    }

    /**
     * @param $data
     * @return mixed
     */
    public static function transformCollection($data)
    {
        if ($data) {
            foreach ($data as &$item) {
                $item->created_at = date("d-m-Y H:i:s", $item->created_at);
                $item->updated_at = date("d-m-Y H:i:s", $item->updated_at);
            }
        }
        return $data;
    }
}
