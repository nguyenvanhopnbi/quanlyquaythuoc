<?php

namespace App\Http\Controllers\Gate;

use App\Enums\LogCategoryEnum;
use App\Events\ActivityOccur;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Export\ExportBankVendorTokenList;
use App\Http\Controllers\Export\ExportPartnerBankAccount;
use App\Services\Gate\BankVendorTokenService;
use App\Transformers\Partner\PartnerBankAccountTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BankVendorTokenController extends Controller
{
    private $bankVendorTokenService;

    public function __construct(BankVendorTokenService $bankVendorTokenService)
    {
        $this->bankVendorTokenService = $bankVendorTokenService;
    }

    public function tokenList(Request $request)
    {
        $req = $request->all();
        $limit = isset($req['pagination']) ? $req['pagination']['perpage'] ?? 10 : 10;
        $page = isset($req['pagination']) ? $req['pagination']['page'] ?? 1 : 1;
        $limit = is_numeric($limit) && $limit > 0 && $limit <= 100 ? $limit : 10;
        $page = is_numeric($page) && $page > 0 ? $page : 1;
        $filter = [
            'page' => $page,
            'limit' => $limit,
            'partner_code' => $request->partner_code,
            'bank_code' => $request->bank_code,
            'vendor_code' => $request->vendor_code,
            'status' => $request->status,
            'status_3ds' => $request->status_3ds,
            'card_number' => $request->card_number,
            'card_name' => $request->card_name,
            'card_type' => $request->card_type,
            'fd' => $request->fd ? Carbon::createFromFormat('m/d/Y', $request->fd)->startOfDay()->format('m/d/Y') : now()->subDays(30)->format('m/d/Y'),
            'td' => $request->td ? Carbon::createFromFormat('m/d/Y', $request->td)->endOfDay()->format('m/d/Y') : now()->format('m/d/Y'),
        ];
        if (!$request->request_type) {
            $statuses = [
                '' => 'Tất cả',
                'active' => 'Active',
                'inactive' => 'Inactive'
            ];
            $statuses3ds = [
                '' => 'Tất cả',
                'true' => 'True',
                'false' => 'False'
            ];
            $data = [
                'filter' => $filter,
                'statuses' => $statuses,
                'statuses3ds' => $statuses3ds,
            ];
            return view('gate.bank-vendor-token.bank_vendor_token_list', $data);
        } elseif ($request->request_type === 'download') {
            return \Response::download(public_path('/media/exports/') . $request->file)->deleteFileAfterSend(true);
        }
        if ($filter['fd']) {
            $filter['fd'] = Carbon::createFromFormat('m/d/Y', $filter['fd'])->format('Y-m-d');
        }
        if ($filter['td']) {
            $filter['td'] = Carbon::createFromFormat('m/d/Y', $filter['td'])->format('Y-m-d');
        }
        if ($request->request_type === 'export') {
            $objExport = new ExportBankVendorTokenList($filter);
            $name = 'Danh sách token_' . now()->format('dmYHis') . '.xlsx';
            try {
                \Excel::store($objExport, $name, 'exports');
                event(new ActivityOccur(LogCategoryEnum::BANK_VENDOR_TOKEN_LIST_EXPORT, "Xuất file danh sách tài tokens", compact('filter')));
            } catch (\Exception $ex) {
                Log::error('+++Error: export PartnerBankAccountController@accounts ', [$ex]);
                return response(['code' => 500, 'message' => 'error'])->header('Content-Type', 'json');
            }
            return response(['code' => 200, 'message' => 'success', 'path' => $name])->header('Content-Type', 'json');
        }
        $overview = $this->bankVendorTokenService->bankTokenList($filter);
        $items = $overview['data'] ?? [];
//        foreach ($items as &$item) {
//            $item = PartnerBankAccountTransformer::convertAttributes($item);
//        }
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

}
