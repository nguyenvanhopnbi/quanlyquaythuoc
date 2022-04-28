<?php
namespace App\Transformers;

class TopupTelcoProviderTransformer
{
    /**
     * @param $data
     * @return mixed
     */
    public static function transformCollection($data)
    {
        $serviceType = [
            'prepaid'=> 'Trả trước',
            'postpaid'=> 'Trả sau',
        ];
        if ($data) {
            foreach ($data as &$item) {
                $item->telco_service_type = $serviceType[$item->telco_service_type];
                $item->created_at = date("d-m-Y H:i:s", $item->created_at);
                $item->updated_at = date("d-m-Y H:i:s", $item->updated_at);
            }
        }
        return $data;
    }


    /**
     * @param $data
     * @return mixed
     */
    public static function transform($data)
    {
        if ($data) {
            $serviceType = [
                'prepaid'=> 'Trả trước',
                'postpaid'=> 'Trả sau',
            ];
            $data->telco_service_type = $serviceType[$data->telco_service_type];
            $data->created_at = date("d-m-Y H:i:s", $data->created_at);
            $data->updated_at = date("d-m-Y H:i:s", $data->updated_at);
        }
        return $data;
    }
}
