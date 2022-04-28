<?php
namespace App\Services\Gate;

use App\Connection\ShopcardAutoImportCardConnection;
use App\Connection\ShopcardConnection;
use App\Transformers\ShopcardTransformer;
use Illuminate\Support\Str;

class ShopcardAutoImportCardService
{

    /**
     * @param array $params
     * @return bool|mixed
     */
    public function getList(array $params)
    {
        $data = ShopcardAutoImportCardConnection::getList($params);
        return $data;
    }

    public function getCardByVendor($vendors, $data)
    {
        $cardByVendors = [];
        if (!empty($vendors->data)) {
            $vendors->data = ShopcardTransformer::transformCollection($vendors->data);
            foreach ($vendors->data as $k => $v) {
                $quantity = 0;
                $min_card = 0;
                $provider_id = '';

                $value = str_replace('.', '', $v->value);
                if (!empty($data->config) && isset($data->config->{$v->vendor}) && isset($data->config->{$v->vendor}->{$value})) {
                    $quantity = !empty($data->config->{$v->vendor}->{$value}->quantity) ? $data->config->{$v->vendor}->{$value}->quantity : 0;
                    $min_card = !empty($data->config->{$v->vendor}->{$value}->min_card) ? $data->config->{$v->vendor}->{$value}->min_card : 0;
                    $provider_id = !empty($data->config->{$v->vendor}->{$value}->provider_id) ? $data->config->{$v->vendor}->{$value}->provider_id : 0;
                }
                $cardByVendors[$v->vendor][$value] = [
                    'quantity' => $quantity,
                    'min_card' => $min_card,
                    'provider_id' => $provider_id,
                ];
            }
        }

        return $cardByVendors;
    }

    public function saveConfigAutoImportCard($params)
    {
        $config['config'] = [];
        if (!empty($params['config'])) {
            foreach ($params['config'] as $k => $v) {
                $vendor = explode('[', $k);
                $config['config'][$vendor[0]][$vendor[1]] = $v;
            }
        }
        $data = ShopcardAutoImportCardConnection::saveConfigAutoImportCard($config);
        if (isset($data->errorCode)) {
            return $data;
        }
        return [];
    }

    public function edit(int $id, array $params)
    {
        return ShopcardConnection::edit($id, $params);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function detail(int $id)
    {
        return ShopcardConnection::detail($id);
    }

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function delete(int $id)
    {
        return ShopcardConnection::delete($id);
    }

    public function getListTransactionExport(array $params)
    {
        if (isset($params['query']['public']) && $params['query']['public'] === 'all') {
            unset($params['query']['public']);
        }
        if (isset($params['query']['value']) && $params['query']['value'] === 'all') {
            unset($params['query']['value']);
        }
        if (isset($params['query']['vendor']) && $params['query']['vendor'] === 'all') {
            unset($params['query']['vendor']);
        }
        $params['query']['export'] = true;
        $params['pagination']['limit'] = 100000;
        $data = ShopcardConnection::getList($params);
        return $data;
    }

    public function getListCardForLookUp()
    {
        $params['limit'] = 1000;
        $cards = ShopcardConnection::getList($params);
        if (isset($cards->data)) {
            $cardByProductCode = [];
            foreach ($cards->data as $card) {
                $cardByProductCode[$card->product_code] = $card;
            }
            return $cardByProductCode;
        } else {
            return [];
        }
    }
}
