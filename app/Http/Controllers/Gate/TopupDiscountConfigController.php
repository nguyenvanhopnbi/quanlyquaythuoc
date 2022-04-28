<?php

namespace App\Http\Controllers\Gate;

use App\Helpers\Message;
use Illuminate\Http\Request;
use App\Helpers\ArrayHelper;
use App\Services\ValidationService;
use App\Http\Controllers\Controller;
use App\Services\Gate\TopupDenominationService;
use App\Services\Gate\TopupDiscountConfigService;
use App\Transformers\ApplicationProvidersTransformer;

class TopupDiscountConfigController extends Controller
{
    protected $topupDiscountConfigService;
    protected $validator;
    protected $request;
    protected $topupDenominationService;

    public function __construct(
        ValidationService $validator,
        TopupDiscountConfigService $topupDiscountConfigService,
        Request $request,
        TopupDenominationService $topupDenominationService
    ) {
        $this->validator = $validator;
        $this->topupDiscountConfigService = $topupDiscountConfigService;
        $this->topupDiscountConfigService = $topupDiscountConfigService;
        $this->request = $request;
        $this->topupDenominationService = $topupDenominationService;
    }

    public function index()
    {
        return view('gate.topup-discount-config.list');
    }

    /*
     *
     */
    public function ajaxGetList(Request $request)
    {
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $data = $this->topupDiscountConfigService->getList($params);
        $data->data = ApplicationProvidersTransformer::transformCollection($data->data);

        return response()->json($data);
    }


    public function add()
    {
        $condition['query']['public'] = 'yes';
        $condition['pagination']['perpage'] = 1000;
        $denominations = $this->topupDenominationService->getList($condition);
        $telco = [];
        $checkTelco = [];
        if (isset($denominations->data)) {
            foreach ($denominations->data as $denomination) {
                if (!in_array($denomination->telco, $checkTelco)) {
                    $telco[] = ['key' => $denomination->telco, 'name' => $denomination->telco];
                }
                $amount[$denomination->telco][] = ['key' => $denomination->value, 'name' => number_format($denomination->value, 0, ',', '.')];
                $checkTelco[] = $denomination->telco;
            }
        }
        return view('gate.topup-discount-config.add')->with(['telco' => $telco, 'amount' => $amount]);
    }

    public function addAction()
    {
        $condition['query']['public'] = 'yes';
        $condition['pagination']['perpage'] = 1000;
        $denominations = $this->topupDenominationService->getList($condition);
        $telco = [];
        if (isset($denominations->data)) {
            foreach ($denominations->data as $denomination) {
                $telco[] = ['key' => $denomination->telco, 'name' => $denomination->telco];
            }
        }
        $getParams[] = 'partnerCode';

        foreach ($telco as $tel) {
            $getParams[] = $tel['key'];
        }
        $params = $this->request->all($getParams);
        $validator = $this->validator->make($params, 'add_topup_discount_config');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->messages()), 400);
        }
        $result = $this->topupDiscountConfigService->add($params);
        if (isset($result->success) && $result->success === true) {
            $data['success'] = true;
            $data['message'] = "Thêm mới discount config thành công !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TOPUP_DISCOUNT, "Thêm Cấu hình Discount Topup", compact('params')));
            return response()->json($data, 200);
        } elseif (isset($result->errorCode) && $result->errorCode != 0) {
            $data = Message::getArray($result->errorCode, $result->message, []);
            return response()->json($data, 400);
        } else {
            $data = Message::get(34, $lang = '', $params);
            return response()->json($data, 400);
        }
    }

    public function delete($id)
    {
        $delete = $this->topupDiscountConfigService->delete($id);
        if ($delete) {
            Message::alertFlash('Bạn đã xóa discount config thành công', 'success');
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TOPUP_DISCOUNT, "Xóa Cấu hình Discount Topup #$id", compact('id',)));
        } else {
            Message::alertFlash('Bạn đã xóa discount config không thành công', 'danger');
        }

        return redirect()->route('topup.discount-config.list');
    }

    public function edit($id)
    {
        $condition['query']['public'] = 'yes';
        $condition['pagination']['perpage'] = 1000;
        $denominations = $this->topupDenominationService->getList($condition);
        $telco = [];
        $checkTelco = [];
        if (isset($denominations->data)) {
            foreach ($denominations->data as $denomination) {
                if (!in_array($denomination->telco, $checkTelco)) {
                    $telco[] = ['key' => $denomination->telco, 'name' => $denomination->telco];
                }
                $amount[$denomination->telco][] = ['key' => $denomination->value, 'name' => number_format($denomination->value, 0, ',', '.')];
                $checkTelco[] = $denomination->telco;
            }
        }

        $result = $this->topupDiscountConfigService->detail($id);
        $result->data->config = $this->buildTopupDiscountConfig($telco, $amount, $result->data->config);
        return view('gate.topup-discount-config.edit', ['detail' => $result->data, 'telco' => $telco, 'amount' => $amount, 'config' => $result->data->config, 'defaultValue' => 0]);
    }

    private function buildTopupDiscountConfig($telco, $amount, $config)
    {
        $result = [];
        $config = (array)json_decode($config)->discount;
        foreach ($telco as $telcoArr) {
            foreach ($amount as $a) {
                if (isset($config[$telcoArr['key']])) {
                    $result[$telcoArr['key']] = (array) $config[$telcoArr['key']];
                }
            }
        }
        return $result;
    }

    public function editAction($id)
    {
        $condition['query']['public'] = 'yes';
        $condition['pagination']['perpage'] = 1000;
        $denominations = $this->topupDenominationService->getList($condition);
        $telco = [];
        if (isset($denominations->data)) {
            foreach ($denominations->data as $denomination) {
                $telco[] = ['key' => $denomination->telco, 'name' => $denomination->telco];
            }
        }
        $getParams[] = 'partnerCode';

        foreach ($telco as $tel) {
            $getParams[] = $tel['key'];
        }

        $params = $this->request->only($getParams);
        $validator = $this->validator->make($params, 'edit_topup_discount_config_fields');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->messages()), 400);
        }
        if (isset($params['_token'])) {
            unset($params['_token']);
        }
        $result = $this->topupDiscountConfigService->edit($id, $params);
        if (isset($result->success) && ($result->success > 0 || $result->success === true)) {
            $data['success'] = true;
            $data['message'] = "Cập nhập discount config thành công !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TOPUP_DISCOUNT, "Sửa Cấu hình Discount Topup #$id", compact('id', 'params')));
            return response()->json($data, 200);
        } elseif (isset($result->errorCode) && $result->errorCode != 0) {
            $data = Message::getArray($result->errorCode, $result->message, []);
            return response()->json($data, 400);
        } else {
            $data = Message::get(13, $lang = '', $params);
            return response()->json($data, 400);
        }
    }

    public function detail($id)
    {
        $result = $this->topupDiscountConfigService->detail($id);
        return view('gate.topup-discount-config.detail-popup', ['detail' => $result->data]);
    }
}
