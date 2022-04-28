<?php

namespace App\Http\Controllers\Gate;

use App\Helpers\ArrayHelper;
use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Services\ValidationService;
use App\Services\Gate\IpnLogService;
use App\Transformers\IpnLogTransformer;
use Illuminate\Http\Request;

class IpnLogsController extends Controller
{
    protected $ipnLogService;
    protected $validator;
    protected $request;

    function __construct(ValidationService $validator, IpnLogService $ipnLogService, Request $request)
    {
        $this->validator = $validator;
        $this->ipnLogService = $ipnLogService;
        $this->request = $request;
    }

    public function index()
    {
        return view('gate.ipn-log.list');
    }

    /*
     *
     */
    public function ajaxGetList(Request $request)
    {
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $data = $this->ipnLogService->getList($params);

        $data->data = IpnLogTransformer::transformCollection($data->data);



        return response()->json($data);
    }

    public function detail($id)
    {
        $data = $this->ipnLogService->detail($id);
        return view('gate.ipn-log.detail-popup', ['detail' => IpnLogTransformer::transform($data)]);
    }
}
