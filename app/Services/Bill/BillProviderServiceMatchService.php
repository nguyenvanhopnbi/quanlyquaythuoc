<?php
namespace App\Services\Bill;

use App\Connection\BillProviderServiceMatchConnection;

class BillProviderServiceMatchService
{
    const PERPAGE = 2;
    const ERR_SERVICE_CODE_WAS_EXIST = 140;

    /**
     * @param array $params
     * @return bool|mixed
     */
    public function getList(array $params)
    {
        $limit = isset($params['pagination']['perpage']) ? $params['pagination']['perpage'] : 20;
        $params['pagination']['limit'] = $limit;
        $result = BillProviderServiceMatchConnection::getList($params);
        if ($result) {
            $result->meta->perpage = $result->meta->limit;
            unset($result->meta->limit);
        }

        return $result;
    }

    public function add(array $params, array $providers)
    {
        $result = [];
        $response = ['success'=> true, 'provide_success'=> [], 'provider_error'=> []];
        foreach ($providers as $provider) {
            $providerMatch['serviceCode'] = $params['serviceCode'];
            $providerMatch['partnerCode'] = $params['partnerCode'];
            // $providerMatch['providerCode'] = $params['providerCode'];
            $providerMatch['providerCode'] = $provider->providerCode;
            $providerMatch['providerPublisherCode'] = $params['providerPublisherCode'];
            $providerMatch['providerServiceCode'] = $params['providerServiceCode'];
            $public = 'public_'.$provider->providerCode;
            $providerMatch['public'] = isset($public) ? 'yes' : 'no';
            $result = BillProviderServiceMatchConnection::add($providerMatch);
            if (isset($result->errorCode) && $result->errorCode === self::ERR_SERVICE_CODE_WAS_EXIST) {
                $response['success'] = false;
                $response['provider_error'][] = $result->message. ' '.$provider->providerCode;
            } else {
                $response['provide_success'][] = 'Thêm mới config provider '.$provider->providerCode. ' thành công !!';
            }
        }
        return $response;
    }

    public function edit(int $id, array $params)
    {
        return BillProviderServiceMatchConnection::edit($id, $params);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function detail(int $id)
    {
        return BillProviderServiceMatchConnection::detail($id);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function delete($params)
    {
        return BillProviderServiceMatchConnection::delete($params);
    }
}
