<?php
namespace App\Services\Gate;

use App\Connection\BankConnection;

class BankService
{

    /**
     * @param array $params
     * @return bool|mixed
     */
    public function getList(array $params)
    {
        $limit = isset($params['pagination']['perpage']) ? $params['pagination']['perpage'] : 20;
        $params['pagination']['limit'] = $limit;
        if (isset($params['query']['type']) && $params['query']['type'] === 'all') {
            unset($params['query']['type']);
        }
        if (isset($params['query']['public']) && $params['query']['public'] === 'all') {
            unset($params['query']['public']);
        }
        $data = BankConnection::getList($params);

        foreach($data->data as $data2){
            if($data2->enable_token == 1){
                $data2->enable_token = '<a class="badge badge-primary enable_token enable_tokenYES" style="">Yes</a>';
            }else{
                $data2->enable_token = '<a class="badge badge-warning enable_token enable_tokenNO" style="">No </a>';
            }
        }
        $data->meta->perpage = $limit;

        // dd($data);
        return $data;
    }

    public function getListSource($query)
    {
        $result = [
            'total'=> 0,
            'items'=> [],
        ];
        $params['pagination']['limit'] = 100;
        if (isset($query['q'])) {
            $params['query']['bank_name'] = $query['q'];
            $params['query']['bank_code'] = $query['q'];
            $params['query']['or'] = 'true';
        }
        $params['query']['public'] = 'yes';
        $data = BankConnection::getList($params);
        if (isset($data->data)) {
            foreach ($data->data as $bankvendor) {
                $bankvendor->id = $bankvendor->bank_code;
                $bankvendor->text = $bankvendor->bank_code;
            }
            $result['total'] = count($data->data);
            $result['items'] = $data->data;
        }
        // dd($result);
        return $result;
    }
    public function add(array $params)
    {
        return BankConnection::add($params);
    }

    public function edit(int $id, array $params)
    {
        return BankConnection::edit($id, $params);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function detail(int $id)
    {
        return BankConnection::detail($id);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function delete(int $id)
    {
        return BankConnection::delete($id);
    }
}
