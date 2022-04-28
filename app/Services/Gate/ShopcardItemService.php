<?php
namespace App\Services\Gate;

use App\Connection\ShopcardItemConnection;

// use Maatwebsite\Excel\Facades\Excel;
class ShopcardItemService
{

    /**
     * @param array $params
     * @return bool|mixed
     */
    public function getList(array $params)
    {
        $limit = isset($params['pagination']['perpage']) ? $params['pagination']['perpage'] : 20;
        $params['offset'] = 0;
        $params['pagination']['limit'] = $limit;
        $page = isset($params['pagination']['page']) ? $params['pagination']['page'] : 1;
        if ($page > 1) {
            $params['offset'] = ($page - 1) * $limit;
        }
        if (isset($params['query']['public']) && $params['query']['public'] === 'all') {
            unset($params['query']['public']);
        }
        if (isset($params['query']['provider_code']) && $params['query']['provider_code'] === 'all') {
            unset($params['query']['provider_code']);
        }
        if (isset($params['query']['sold']) && $params['query']['sold'] === 'all') {
            unset($params['query']['sold']);
        }
        if (isset($params['query']['vendor']) && $params['query']['vendor'] === 'all') {
            unset($params['query']['vendor']);
        }
        if (isset($params['query']['value']) && $params['query']['value'] === 'all') {
            unset($params['query']['value']);
        }
        if (isset($params['query']['startTime'])) {
            $params['query']['startTime'] = date('Ymd',strtotime($params['query']['startTime']. ' 00:00:00'));
        }
        if (isset($params['query']['endTime'])) {
            $params['query']['endTime'] = date('Ymd', strtotime($params['query']['endTime']. ' 23:59:59'));
        }

        if (isset($params['query']['createStartTime'])) {
            $params['query']['createStartTime'] =  strtotime($params['query']['createStartTime']. ' 00:00:00');
        }
        if (isset($params['query']['createEndTime'])) {
            $params['query']['createEndTime'] =  strtotime($params['query']['createEndTime']. ' 23:59:59');
        }

        $data = ShopcardItemConnection::getList($params);
        if (isset($data->data)) {
            $data->meta->perpage = $limit;
        }
        return $data;
    }

    public function add(array $params)
    {
        return ShopcardItemConnection::add($params);
    }
    
    public function extend(array $params)
    {
        return ShopcardItemConnection::extend($params);
    }

    // public function edit(int $id, array $params)
    // {
    //     return ShopcardItemConnection::edit($id, $params);
    // }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function detail(int $id)
    {
        return ShopcardItemConnection::detail($id);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    // public function delete(int $id)
    // {
    //     return ShopcardItemConnection::delete($id);
    // }

    public function createCardItemByJob($params)
    {
        return ShopcardItemConnection::add($params);
    }

    public function import($file, $vendor)
    {
        //Excel
        // $data = Excel::toArray( null, $fileExcel);
        // $cards = $data[0];
        // $total = count($cards);
        // Redis::set('process-create-card-item', $total);
        // foreach($cards as $row){
        //     $cardItem['code'] = $this->clean($row[0]);
        //     $cardItem['serial'] = $this->clean($row[1]);
        //     $cardItem['value'] = $this->clean($row[2]);
        //     $cardItem['expiry'] = $this->clean($row[3]);
        //     $cardItem['vendor'] = $this->clean($row[4]);
        //     ShopcardItemConnection::add($cardItem); //normal request
        //     // dispatch((new CreateCardItem($cardItem, $this))->onQueue(env('QUEUE_NAME'))->delay(Carbon::now()->addSeconds(1))); //job queue
        // }

        //text
        $data['data'] = file_get_contents($file);
        $data['vendor'] = $vendor;
        return ShopcardItemConnection::add($data);
    }

    public function getListTransactionExport($params)
    {
        if (isset($params['query']['provider_code']) && $params['query']['provider_code'] === 'all') {
            unset($params['query']['provider_code']);
        }
        if (isset($params['query']['public']) && $params['query']['public'] === 'all') {
            unset($params['query']['public']);
        }
        if (isset($params['query']['sold']) && $params['query']['sold'] === 'all') {
            unset($params['query']['sold']);
        }
        if (isset($params['query']['vendor']) && $params['query']['vendor'] === 'all') {
            unset($params['query']['vendor']);
        }
        if (isset($params['query']['value']) && $params['query']['value'] === 'all') {
            unset($params['query']['value']);
        }
        if (isset($params['query']['startTime'])) {
            $params['query']['startTime'] = date('Ymd',strtotime($params['query']['startTime']. ' 00:00:00'));
        }
        if (isset($params['query']['endTime'])) {
            $params['query']['endTime'] = date('Ymd', strtotime($params['query']['endTime']. ' 23:59:59'));
        }

        if (isset($params['query']['createStartTime'])) {
            $params['query']['createStartTime'] =  strtotime($params['query']['createStartTime']. ' 00:00:00');
        }
        if (isset($params['query']['createEndTime'])) {
            $params['query']['createEndTime'] =  strtotime($params['query']['createEndTime']. ' 23:59:59');
        }
        $params['pagination']['limit'] = 100000;
        $params['query']['export'] = true;
        $data = ShopcardItemConnection::getList($params);
        return $data;
    }
}
