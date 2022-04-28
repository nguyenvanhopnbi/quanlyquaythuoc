<?php

namespace App\Http\Controllers\PaymentLink;

use App\Helpers\ArrayHelper;
use App\Http\Controllers\Export\ExportBankTransactionDashboard;
use App\Http\Controllers\Export\ExportPaymentLinkChannel;
use App\Http\Controllers\Export\ExportPaymentLinkCustomer;
use App\Http\Controllers\Export\ExportPaymentLinkTransaction;
use App\Services\PaymentLink\PaymentLinkService;
use App\Transformers\System\TransferLogTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\ValidationService;
use App\Http\Controllers\Controller;
use App\Services\Gate\BankTransactionService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Helpers\CheckIsAmUser;

// use App\Connection\BankTransactionConnection;

class PaymentLinkController extends Controller
{
    protected $bankTransactionService;
    protected $validator;
    protected $request;
    protected $paymentLinkService;

    public function __construct(
        ValidationService $validator,
        BankTransactionService $bankTransactionService,
        PaymentLinkService $paymentLinkService,
        Request $request
    )
    {
        $this->validator = $validator;
        $this->bankTransactionService = $bankTransactionService;
        $this->request = $request;
        $this->paymentLinkService = $paymentLinkService;

    }

    public function overview(Request $request)
    {
        $filter = [
            'id' => $request->id,
            'partner_code' => $request->partner_code,
            'fd' => $request->fd ? Carbon::createFromFormat('m/d/Y', $request->fd)->startOfDay()->format('m/d/Y') : now()->subDays(7)->format('m/d/Y'),
            'td' => $request->td ? Carbon::createFromFormat('m/d/Y', $request->td)->endOfDay()->format('m/d/Y') : now()->format('m/d/Y'),
        ];
        return view('payment_link.index', ['filter' => $filter]);
    }

    public function overviewAjax(Request $request)
    {

        $partnerCode = CheckIsAmUser::checkIsAmUser();

        $req = $request->all();

        $limit = isset($req['pagination']) ? $req['pagination']['perpage'] ?? 10 : 10;
        $page = isset($req['pagination']) ? $req['pagination']['page'] ?? 1 : 1;
        $limit = is_numeric($limit) && $limit > 0 && $limit <= 100 ? $limit : 10;
        $page = is_numeric($page) && $page > 0 ? $page : 1;
        $filter = [
            'id' => $request->id,
            'partner_code' => $request->partner_code,
            'fd' => $request->fd ? Carbon::createFromFormat('m/d/Y', $request->fd)->startOfDay()->format('Y-m-d') : null,
            'td' => $request->td ? Carbon::createFromFormat('m/d/Y', $request->td)->endOfDay()->format('Y-m-d') : null,
        ];



        $overview = $this->paymentLinkService->overviewRevenue($filter, $partnerCode);
        Log::info('message_1111111_overview', [$overview, $partnerCode]);
        $paginate = [
            'chart' => $overview['chart'] ?? [],
            'data' => $overview['data'] ?? [],
            'meta' => [
                'page' => $page,
                'limit' => $limit,
                'total' => $overview['total'] ?? 0,
                'pages' => $limit,
                'perpage' => $limit
            ]
        ];

        return response($paginate);
    }

    public function transactionList(Request $request)
    {
        $partnerCode = CheckIsAmUser::checkIsAmUser();
        if (!$request->request_type) {
            $data = [
                'methods' => [
                    'ALL' => 'Tất cả',
                    'ATM' => 'Thẻ ATM',
                    'CC' => 'Visa/Credit Card',
                    'EWALLET' => 'Ví Appota'
                ],
                'statuses' => [
                    '' => 'Tất cả',
                    'success' => 'Thành công',
                    'error' => 'Thất bại',
                    'pending' => 'Chờ thanh toán'
                ]
            ];
            return view('payment_link.transaction_list', $data);
        } elseif($request->request_type === 'download') {
            return \Response::download(public_path('/media/exports/') . $request->file)->deleteFileAfterSend(true);
        }
        $req = $request->all();
        $limit = isset($req['pagination']) ? $req['pagination']['perpage'] ?? 10 : 10;
        $page = isset($req['pagination']) ? $req['pagination']['page'] ?? 1 : 1;
        $limit = is_numeric($limit) && $limit > 0 && $limit <= 100 ? $limit : 10;
        $page = is_numeric($page) && $page > 0 ? $page : 1;
        $filter = [
            'page' => $page,
            'limit' => $limit,
            'partner_code' => $request->partner_code,
            'payment_method' => $request->payment_method,
            'status' => $request->status,
            'transaction_id' => $request->transaction_id,
            'bank_code' => $request->bank_code,
            'vendor_code' => $request->vendor_code,
            'fd' => $request->fd ? Carbon::createFromFormat('m/d/Y', $request->fd)->startOfDay()->format('Y-m-d') : null,
            'td' => $request->td ? Carbon::createFromFormat('m/d/Y', $request->td)->endOfDay()->format('Y-m-d') : null,
        ];
        if ($request->request_type === 'export') {
            $objExport = new ExportPaymentLinkTransaction();
            $objExport->params = $filter;
            $name = 'Danh sách giao dịch_' . now()->format('dmYHis') . '.xlsx';
            try {
                \Excel::store($objExport, $name, 'exports');
                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PAYMENT_LINK_EXPORT_TRANSACTION, "Xuất file danh sách giao dịch", compact('filter')));
            } catch (\Exception $ex) {
                Log::error('+++Error: export PaymentLinkController@transactionList ', [$ex]);
                return response(['code' => 500, 'message' => 'error'])->header('Content-Type', 'json');
            }
            return response(['code' => 200, 'message' => 'success', 'path' => $name])->header('Content-Type', 'json');
        }


        $overview = $this->paymentLinkService->transactionList($filter, $partnerCode);
        $paginate = [
            'data' => $overview['data'] ?? [],
            'meta' => [
                'page' => $page,
                'limit' => $limit,
                'total' => $overview['total'] ?? 0,
                'pages' => $limit,
                'perpage' => $limit
            ]
        ];

        return response($paginate);
    }

    public function partnerList(Request $request)
    {
        $partnerCode = CheckIsAmUser::checkIsAmUser();
        $filter = [
            'partner_code' => $request->q,
            'page' => 1,
            'limit' => 1000000
        ];
        $partners = $this->paymentLinkService->partnerList($filter, $partnerCode);
        if (isset($partners['data']) && !empty($partners['data'])) {
            foreach ($partners['data'] as &$partner) {
                $partner['id'] = $partner['partner_code'];
            }
        }
        $res = ['results' => $partners['data'] ?? []];
        return response($res);
    }

    public function channelList(Request $request)
    {
        $partnerCode = CheckIsAmUser::checkIsAmUser();
        if (!$request->request_type) {
            return view('payment_link.channel_list');
        } elseif($request->request_type === 'download') {
            return \Response::download(public_path('/media/exports/') . $request->file)->deleteFileAfterSend(true);
        }
        $req = $request->all();
        $limit = isset($req['pagination']) ? $req['pagination']['perpage'] ?? 10 : 10;
        $page = isset($req['pagination']) ? $req['pagination']['page'] ?? 1 : 1;
        $limit = is_numeric($limit) && $limit > 0 && $limit <= 100 ? $limit : 10;
        $page = is_numeric($page) && $page > 0 ? $page : 1;
        $filter = [
            'page' => $page,
            'limit' => $limit,
            'partner_code' => $request->partner_code,
            'application_id' => $request->application_id,
            'status' => $request->status,
            'fd' => $request->fd ? Carbon::createFromFormat('m/d/Y', $request->fd)->startOfDay()->format('Y-m-d') : null,
            'td' => $request->td ? Carbon::createFromFormat('m/d/Y', $request->td)->endOfDay()->format('Y-m-d') : null,
        ];
        if ($request->request_type === 'export') {
            $objExport = new ExportPaymentLinkChannel();
            $objExport->params = $filter;
            $name = 'Danh sách kênh bán_' . now()->format('dmYHis') . '.xlsx';
            try {
                \Excel::store($objExport, $name, 'exports');
                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PAYMENT_LINK_EXPORT_CHANNEL, "Xuất file danh sách kênh bán", compact('filter')));
            } catch (\Exception $ex) {
                Log::error('+++Error: export PaymentLinkController@channelList ', [$ex]);
                return response(['code' => 500, 'message' => 'error'])->header('Content-Type', 'json');
            }
            return response(['code' => 200, 'message' => 'success', 'path' => $name])->header('Content-Type', 'json');
        }
        $overview = $this->paymentLinkService->channelList($filter, $partnerCode);
        $paginate = [
            'data' => $overview['data'] ?? [],
            'meta' => [
                'page' => $page,
                'limit' => $limit,
                'total' => $overview['total'] ?? 0,
                'pages' => $limit,
                'perpage' => $limit
            ]
        ];

        return response($paginate);
    }

    public function customerList(Request $request)
    {
        $partnerCode = CheckIsAmUser::checkIsAmUser();
        if (!$request->request_type) {
            return view('payment_link.customer_list');
        } elseif($request->request_type === 'download') {
            $file = $_GET['file'];
            return \Response::download(public_path('/media/exports/') . $file)->deleteFileAfterSend(true);
        }
        $req = $request->all();
        $limit = isset($req['pagination']) ? $req['pagination']['perpage'] ?? 10 : 10;
        $page = isset($req['pagination']) ? $req['pagination']['page'] ?? 1 : 1;
        $limit = is_numeric($limit) && $limit > 0 && $limit <= 100 ? $limit : 10;
        $page = is_numeric($page) && $page > 0 ? $page : 1;
        $filter = [
            'page' => $page,
            'limit' => $limit,
            'partner_code' => $request->partner_code,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'fd' => $request->fd ? Carbon::createFromFormat('m/d/Y', $request->fd)->startOfDay()->format('Y-m-d') : null,
            'td' => $request->td ? Carbon::createFromFormat('m/d/Y', $request->td)->endOfDay()->format('Y-m-d') : null,
        ];
        if ($request->request_type === 'export') {
            $objExport = new ExportPaymentLinkCustomer();
            $objExport->params = $filter;
            $name = 'Danh sách khách hàng_' . now()->format('dmYHis') . '.xlsx';
            try {
                \Excel::store($objExport, $name, 'exports');
                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PAYMENT_LINK_EXPORT_CUSTOMER, "Xuất file danh sách khách hàng", compact('filter')));
            } catch (\Exception $ex) {
                Log::error('+++Error: export PaymentLinkController@customerList ', [$ex]);
                return response(['code' => 500, 'message' => 'error'])->header('Content-Type', 'json');
            }
            return response(['code' => 200, 'message' => 'success', 'path' => $name])->header('Content-Type', 'json');
        }
        $overview = $this->paymentLinkService->customerList($filter, $partnerCode);
        $paginate = [
            'data' => $overview['data'] ?? [],
            'meta' => [
                'page' => $page,
                'limit' => $limit,
                'total' => $overview['total'] ?? 0,
                'pages' => $limit,
                'perpage' => $limit
            ]
        ];

        return response($paginate);
    }

}
