<?php
namespace App\Http\Controllers\Export;

use App\Services\Gate\BankTransactionService;
use Exception;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportAuditTransaction implements FromView
{
    /**
     * Undocumented variable
     *
     * @var array
     */
    public $params = [];
    public function view(): View
    {
        $bankTransactionService = new BankTransactionService();
        $data = $bankTransactionService->getAuditForExport($this->params);
        if ($data) {
            return view('gate.audit.export')->with([
                'partnerCode'=> $this->params['query']['partner_code'],
                'startTime'=> date('d/m/Y', strtotime($this->params['query']['startTime'])),
                'endTime'=> date('d/m/Y', strtotime($this->params['query']['endTime'])),
                'audit'=> $data,
            ]);
        }
        throw new Exception("Chưa cấu hình partner paygate", 1);
    }
}
