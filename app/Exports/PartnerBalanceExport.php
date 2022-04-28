<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class PartnerBalanceExport implements FromView
{
    use Exportable;

    protected $data;

    public function __construct($data = [])
    {
        $this->data = $data;
    }
    public function view(): View
    {
        return view('gate.partner-balance.export', [
            'transactions' => $this->data,
        ]);
    }
}
