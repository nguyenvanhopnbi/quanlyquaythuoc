<?php
namespace App\Transformers;

class PartnerBalanceTransformer
{
    /**
     * @param $data
     * @return mixed
     */
    public static function transformCollection($data)
    {
        if ($data) {
            foreach ($data as &$item) {
                $item->timestamp = date("d-m-Y H:i:s", $item->timestamp);
                $item->amount = number_format($item->amount, 0, ',', '.');
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
        $type = [
            "credited"=> ['title'=> 'Cộng tiền', 'class'=> 'badge-success'],
            "debited"=> ['title'=> 'Trừ tiền', 'class'=> 'badge-warning'],
        ];
        if ($data) {
            $data->type_badge = $type[$data->type]['class'];
            $data->type_text = $type[$data->type]['title'];
            $data->timestamp = date("d-m-Y H:i:s", $data->timestamp);
            $data->amount = number_format($data->amount, 0, ',', '.');
        }
        return $data;
    }
}
