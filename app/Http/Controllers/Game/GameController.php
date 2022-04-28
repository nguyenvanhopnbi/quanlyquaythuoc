<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Export\ExportGamePaymentSetting;
use App\Http\Controllers\Export\ExportGamePaymentTransaction;
use App\Http\Controllers\Export\ExportPaymentLinkChannel;
use App\Http\Controllers\Export\ExportPaymentLinkCustomer;
use App\Services\Game\GameService;
use App\Services\Gate\ApplicationService;
use App\Services\Gate\PartnerService;
use App\Transformers\Game\GameTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\ValidationService;
use App\Http\Controllers\Controller;
use App\Services\Gate\BankTransactionService;
use Illuminate\Support\Facades\Log;
use App\Transformers\Game\GameSettingTransformer;

// use App\Connection\BankTransactionConnection;

class GameController extends Controller
{
    protected $bankTransactionService;
    protected $validator;
    protected $request;
    protected $gameService;
    protected $applicationService;
    protected $partnerService;

    private $methods = [
        'ALL' => 'Tất cả',
        'ATM' => 'Thẻ ATM',
        'CC' => 'Visa/Credit Card',
        'EWALLET' => 'Ví Appota'
    ];
    private $statuses = [
        '' => 'Tất cả',
        'success' => 'Thành công',
        'error' => 'Thất bại',
        'pending' => 'Chờ thanh toán'
    ];


    public function __construct(
        ValidationService $validator,
        BankTransactionService $bankTransactionService,
        GameService $gameService,
        Request $request,
        ApplicationService $applicationService,
        PartnerService $partnerService
    )
    {
        $this->validator = $validator;
        $this->bankTransactionService = $bankTransactionService;
        $this->request = $request;
        $this->gameService = $gameService;
        $this->applicationService = $applicationService;
        $this->partnerService = $partnerService;
    }

    public function overview(Request $request)
    {
        $filter = [
            'id' => $request->id,
            'partner_code' => $request->partner_code,
            'fd' => $request->fd ? Carbon::createFromFormat('m/d/Y', $request->fd)->startOfDay()->format('Y-m-d') : now()->subDays(7)->format('m/d/Y'),
            'td' => $request->td ? Carbon::createFromFormat('m/d/Y', $request->td)->endOfDay()->format('Y-m-d') : now()->format('m/d/Y'),
        ];
        if ($request->isXmlHttpRequest()) {
            $req = $request->all();
            $limit = isset($req['pagination']) ? $req['pagination']['perpage'] ?? 10 : 10;
            $page = isset($req['pagination']) ? $req['pagination']['page'] ?? 1 : 1;
            $limit = is_numeric($limit) && $limit > 0 && $limit <= 100 ? $limit : 10;
            $page = is_numeric($page) && $page > 0 ? $page : 1;
            $overview = $this->gameService->overview($filter);
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
        return view('game.index', ['filter' => $filter]);
    }

    public function transaction(Request $request)
    {
        if (!$request->request_type) {
            $data = [
                'methods' => $this->methods,
                'statuses' => $this->statuses
            ];
            return view('game.transaction', $data);
        } elseif ($request->request_type === 'download') {
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
            'application_id' => $request->application_id,
            'order_id' => $request->order_id,
            'status' => $request->status,
            'transaction_id' => $request->transaction_id,
            'fd' => $request->fd ? Carbon::createFromFormat('m/d/Y', $request->fd)->startOfDay()->format('Y-m-d') : null,
            'td' => $request->td ? Carbon::createFromFormat('m/d/Y', $request->td)->endOfDay()->format('Y-m-d') : null,
        ];
        if ($request->request_type === 'export') {
            $objExport = new ExportGamePaymentTransaction($filter, $this->statuses, $this->methods);
            $name = 'Danh sách giao dịch_' . now()->format('dmYHis') . '.xlsx';
            try {
                \Excel::store($objExport, $name, 'exports');
                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PAYMENT_LINK_EXPORT_TRANSACTION, "Xuất file danh sách giao dịch", compact('filter')));
            } catch (\Exception $ex) {
                Log::error('+++Error: export GameController@transaction ', [$ex]);
                return response(['code' => 500, 'message' => 'error'])->header('Content-Type', 'json');
            }
            return response(['code' => 200, 'message' => 'success', 'path' => $name])->header('Content-Type', 'json');
        }
        $applications = $this->applicationService->getAll();
        $overview = $this->gameService->transactions($filter);
        $items = $overview['data'] ?? [];
        foreach ($items as &$item) {
            $item = GameTransformer::convertTransactionAttributes($item, $applications);
        }
        $paginate = [
            'data' => $items,
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

    public function partnerList()
    {
        $partners = $this->partnerService->getAll();
        if (!empty($partners)) {
            foreach ($partners as &$partner) {
                $partner->id = $partner->partner_code;
            }
        }
        $res = ['results' => $partners ?? []];
        return response($res);
    }

    public function applications()
    {
        $partners = $this->applicationService->getAll();
        $res = ['results' => $partners ?? []];
        return response($res);
    }


}
