<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ConfirmScheduleExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public $dataExport;
    public function __construct($dataExport){
        $this->dataExport = $dataExport;
        echo "vao day";
    }

    public function view(): View
    {
        return view('exports.ConfirmScheduleExport', [
            // 'dataExport' => $this->dataExport
        ]);
    }
}
