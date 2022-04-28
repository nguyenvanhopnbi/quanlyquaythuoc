<?php
namespace App\Transformers;

class TransferMoneyTransactionTransformer
{
    /**
     * @param $data
     * @return mixed
     */
    public static function transformCollection($data)
    {
        if ($data) {
            foreach ($data as &$item) {
                $item->requestTime = date("d-m-Y H:i:s", $item->requestTime);
                $item->responseTime = date("d-m-Y H:i:s", $item->responseTime);
                $item->amount = number_format($item->amount, 0, ',', '.');
                $item->transferAmount = number_format($item->transferAmount, 0, ',', '.');
                $item->fee = number_format($item->fee, 0, ',', '.');
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
        $status = [
            'success'=> 'badge-success',
            'error'=> 'badge-danger',
            'pending'=> 'badge-warning',
            'processing'=> 'badge-info',
            'refund'=> 'badge-primary',
            'cancel'=> 'badge-dark',
        ];
        $transfer_status = [
            'success'=> 'badge-success',
            'error'=> 'badge-danger',
            'pending'=> 'badge-warning',
            'processing'=> 'badge-info',
            'refund'=> 'badge-primary',
            'cancel'=> 'badge-dark',
        ];
  
        if ($data) {
            $data->status_badge = $status[$data->status];
            $data->transfer_status_badge = $transfer_status[$data->transferStatus];
            $data->requestTime = date("d-m-Y H:i:s", (int)$data->requestTime);
            $data->responseTime = date("d-m-Y H:i:s", (int)$data->responseTime);
            $data->amount = number_format($data->amount, 0, ',', '.');
            $data->transferAmount = number_format($data->transferAmount, 0, ',', '.');
        }
        return $data;
    }
}
