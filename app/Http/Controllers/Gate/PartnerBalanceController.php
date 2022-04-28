<?php

namespace App\Http\Controllers\Gate;

use App\Exports\PartnerBalanceExport;
use App\Helpers\ArrayHelper;
use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Services\ValidationService;
use App\Services\Gate\PartnerBalanceService;
use App\Transformers\PartnerBalanceTransformer;
use Cache;
use Erdemkeren\Otp\OtpFacade;
use Illuminate\Http\Request;
use Log;
use Response;

class PartnerBalanceController extends Controller
{
    protected $partnerBalanceService;
    protected $validator;
    protected $request;

    function __construct(ValidationService $validator, PartnerBalanceService $partnerBalanceService, Request $request)
    {
        $this->validator = $validator;
        $this->partnerBalanceService = $partnerBalanceService;
        $this->request = $request;
    }

    public function index()
    {
        return view('gate.partner-balance.list');
    }

    /*
     *
     */
    public function ajaxGetList(Request $request)
    {
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $data = $this->partnerBalanceService->getList($params);
        // dump($params);
        // dump($data);
        $data->data = PartnerBalanceTransformer::transformCollection($data->data);

        return response()->json($data);
    }


    public function add()
    {
        return view('gate.partner-balance.add');
    }

    public function sub()
    {
        return view('gate.partner-balance.sub');
    }

    public function addAction()
    {
        $params = $this->request->only('partnerCode', 'amount', 'reason', 'otp');
        $params = ArrayHelper::removeArrayNull($params);
        $validator = $this->validator->make($params, 'add_balance_partner_fields');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->messages()), 400);
        }
        $authId = $this->request->user()->getAuthIdentifier();

        $token = OtpFacade::retrieveByPlainText($authId, $params['otp']);
         // dd($token);
        $otpLimiter = Cache::remember('otpLimiter', now()->addMinutes(1), fn () => 1);
        Log::debug('otpLimiter', [$otpLimiter]);
        if ($otpLimiter > 5) {
            Cache::put('otpLimiter', 6, now()->addMinutes(1));
            $token = OtpFacade::retrieveByCipherText($authId, session('otp_token', ''));
            optional($token)->revoke();
            return response()->json(Message::get(1, $lang = '', ['otp' => ['Bị khóa do nhập sai OTP quá nhiều  lần']]), 400);
        }
        if (!$token || $token->expired() || !OtpFacade::check($authId, $token)) {
            Cache::increment('otpLimiter');
            return response()->json(Message::get(1, $lang = '', ['otp' => ['OTP không hợp lệ hoặc đã hết hạn']]), 400);
        }
        $result = $this->partnerBalanceService->add($params);
        $token->revoke();
        if (isset($result->success) && $result->success === true) {

            $data['success'] = true;
            $data['message'] = "Thêm số dư thành công !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_BALANCE, "Cộng tiền Partner #{$params['partnerCode']}", compact('params')));
            return response()->json($data, 200);
        } else if (isset($result->errorCode) && $result->errorCode != 0) {
            $data = Message::getArray($result->errorCode, $result->message, []);
            return response()->json($data, 400);
        } else {
            $data = Message::get(142, $lang = '', $params);
            return response()->json($data, 400);
        }
    }

    public function subAction()
    {
        $params = $this->request->only('partnerCode', 'amount', 'reason');
        $params = ArrayHelper::removeArrayNull($params);
        $validator = $this->validator->make($params, 'sub_balance_partner_fields');
        if ($validator->fails()) {
            return response()->json(Message::get(1, $lang = '', $validator->errors()->messages()), 400);
        }
        $result = $this->partnerBalanceService->sub($params);
        if (isset($result->success) && $result->success === true) {

            $data['success'] = true;
            $data['message'] = "Trừ số dư thành công !!!";
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_BALANCE, "Trừ tiền Partner #{$params['partnerCode']}", compact('params')));
            return response()->json($data, 200);
        } else if (isset($result->errorCode) && $result->errorCode != 0) {
            $data = Message::get($result->errorCode, $lang = '', []);
            return response()->json($data, 400);
        } else {
            $data = Message::get(141, $lang = '', $params);
            return response()->json($data, 400);
        }
    }

    public function detail($id)
    {
        $data = $this->partnerBalanceService->detail($id);
        return view('gate.partner-balance.detail-popup', ['detail' => PartnerBalanceTransformer::transform($data->data)]);
    }

    public function storeReport(Request $request)
    {
        $params = $request->validate([
            'partner_code' => '',
            'type' => '',
            'startTime' => '',
            'endTime' => '',
            'amount' => '',
            'admin_email' => '',
        ]);

        $params = ArrayHelper::removeArrayNull($params);
        $params['report'] = true;
        $response = $this->partnerBalanceService->getList(['query' => $params]);
        $data = $response ? $response->data : [];

        $fileName = "partner_balance_report_" . now()->format('dmyHis') . '.xlsx';
        (new PartnerBalanceExport($data))
            ->store($fileName, 'public');
        event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_BALANCE, "Export Partner Balance", compact('params')));
        return response()->json(['path' => route('gate.partner-balance.report.downloadReport', $fileName)]);
    }

    public function downloadReport($name)
    {
        return Response::download(storage_path('app/public/') . $name)->deleteFileAfterSend(true);
    }
}
