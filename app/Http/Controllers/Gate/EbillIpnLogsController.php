<?php

namespace App\Http\Controllers\Gate;

use App\Helpers\ArrayHelper;
use App\Http\Controllers\Controller;
use App\Services\Gate\EbillLogsService;
use App\Services\Gate\EbillTransactionService;
use App\Services\ValidationService;
use App\Transformers\EbillIpnLogsTransformers;
use App\Transformers\EbillTransactionTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EbillIpnLogsController extends Controller
{

    protected $validator;


    function __construct(ValidationService $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(EbillLogsService $ebillLogsService )
    {
        $allStatus = $ebillLogsService->getAllStatusEbillLogs();
        return view('gate.ebill-ipn-logs.list',compact('allStatus'));
    }


    public function ajaxGetList(Request $request, EbillLogsService $ebillLogsService)
    {
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $data = $ebillLogsService->getList($params);
        Log::info('data Ebill Log query = '.json_encode($data));
        $data->data = EbillIpnLogsTransformers::transformCollection($data->data);

        return response()->json($data);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function detail($id,EbillLogsService $ebillLogsService)
    {
        $data = $ebillLogsService->detail($id);
        Log::info('data detail ebill Log = '.json_encode($data));
        return view('gate.ebill-ipn-logs.detail-popup', ['detail' => EbillIpnLogsTransformers::transform($data->data)]);
    }


}
