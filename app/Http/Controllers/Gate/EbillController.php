<?php

namespace App\Http\Controllers\Gate;

use App\Helpers\ArrayHelper;
use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Services\ValidationService;
use App\Services\Gate\EbillService;
use App\Transformers\EbillTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Helpers\CheckIsAmUser;

class EbillController extends Controller
{
    protected $ebillService;
    protected $validator;
    protected $request;

    function __construct(ValidationService $validator, EbillService $ebillService, Request $request)
    {
        $this->validator = $validator;
        $this->ebillService = $ebillService;
        $this->request = $request;
    }

    public function index()
    {
        return view('gate.ebill.list');
    }

    public function manageBalanceThuHo(){
        return view('gate.ebill.QuanLySoDuThuHo');
    }

    /*
     *
     */
    public function ajaxGetList(Request $request)
    {
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $partnerCode = null;
        $partnerCode = CheckIsAmUser::checkIsAmUser();
        $data = $this->ebillService->getList($params, $partnerCode);

        $data->data = EbillTransformer::transformCollection($data->data);

        return response()->json($data);
    }

    public function detail($id)
    {
        $data = $this->ebillService->detail($id);
        return view('gate.ebill.detail-popup', ['detail' => EbillTransformer::transform($data->data)]);
    }
}
