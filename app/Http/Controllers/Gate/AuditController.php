<?php

namespace App\Http\Controllers\Gate;

use App\Helpers\ArrayHelper;
use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Export\ExportAuditTransaction;
use App\Services\ValidationService;
use App\Services\Gate\BankTransactionService;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    protected $applicationService;
    protected $validator;
    protected $request;

    function __construct(
        ValidationService $validator,
        BankTransactionService $bankTransactionService,
        Request $request
    )
    {
        $this->validator = $validator;
        $this->bankTransactionService = $bankTransactionService;
        $this->request = $request;
    }

    public function index()
    {
        return view('gate.audit.list');
    }

    /*
     *
     */
    public function ajaxGetList(Request $request)
    {
        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $data = $this->bankTransactionService->getListAudit($params);

        return response()->json($data);
    }

    public function preview()
    {
        $params = $this->request->all('');
        $data = $this->bankTransactionService->getAuditForExport($params);
        if ($data) {
            return view('gate.audit.export')->with([
                'partnerCode'=> $params['query']['partner_code'],
                'startTime'=> date('d/m/Y', strtotime($params['query']['startTime'])),
                'endTime'=> date('d/m/Y', strtotime($params['query']['endTime'])),
                'audit'=> $data,
            ]);
        }
        return response()->json(Message::get(146));
    }

    public function export(Request $request)
    {
        // $paramFilter = $this->request->all('');
        // $params['query'] = $paramFilter;
        // $data = $this->bankTransactionService->getAuditForExport($params);
        // return view('gate.audit.export')->with([
        //     'partnerCode'=> $params['query']['partner_code'],
        //     'startTime'=> date('d/m/Y', strtotime($params['query']['startTime'])),
        //     'endTime'=> date('d/m/Y', strtotime($params['query']['endTime'])),
        //     'partnerName'=> $params['query']['partner_code'],
        //     'audit'=> $data,
        // ]);

        $params = $request->all();
        $params = ArrayHelper::removeArrayNull($params);
        $time = date('d-m-Y H:i:s');
        $objExport = new ExportAuditTransaction();
        $objExport->params = $params;
        $filepath = '/bbds-'. $time .'.xlsx';
        libxml_use_internal_errors(true);
        try {
            \Excel::store($objExport, $filepath, 'public');
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::GATE_MONEY_AUDIT, "Export Đối soát CTT", compact('params')));
        } catch (\Exception $ex) {
            return response()->json(Message::get(146));
        }
        return response()->json(['success'=> true, 'path'=> $filepath]);
    }

    public function download()
    {
        $file = $_GET['file'];
        libxml_use_internal_errors(true);
        return \Response::download(storage_path('app/public').$file)->deleteFileAfterSend(true);
    }
}
