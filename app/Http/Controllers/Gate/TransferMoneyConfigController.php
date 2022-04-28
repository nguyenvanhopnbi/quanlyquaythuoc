<?php

namespace App\Http\Controllers\Gate;

use App\Http\Controllers\Controller;

class TransferMoneyConfigController extends Controller
{
    public function __invoke()
    {
        return view('gate.transfer-money-config.index');
    }

    public function updateTransaction(){
        return view('gate.transfer-money-config.updateTransaction');
    }

    public function partnerConfigProvider(){
        return view('gate.partnerDocumentReport.partnerConfigProvider');
    }

    public function ebillBank(){
        return view('gate.ebill.ebillBank');
    }

    public function transferPartnerebillBank(){
        return view('gate.ebill.ebillTransferPartnerBank');
    }

}
