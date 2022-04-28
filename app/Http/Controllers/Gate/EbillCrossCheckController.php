<?php

namespace App\Http\Controllers\Gate;

use App\Helpers\ArrayHelper;
use App\Helpers\Message;
use App\Helpers\PusherHelper;
use Illuminate\Http\Request;
use App\Services\ValidationService;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Export\ExportRefundTransaction;
use App\Services\Gate\BankTransactionService;
use App\Transformers\BankTransactionTransformer;
use App\Transformers\BankRefundTransactionTransformer;
use App\Http\Controllers\Export\ExportBankTransaction;
use Exception;
use App\Models\UserAMmodel;
use Illuminate\Support\Facades\Auth;
use App\Helpers\CheckIsAmUser;
use App\Connection\BankTransactionConnection;
use Illuminate\Support\Facades\Gate;

class EbillCrossCheckController extends Controller
{

    public function reconciliationSchedule(){
        return view('gate.ebill.ebillCrossCheck');
    }

    public function partnerVAfee(){
        return view('gate.ebill.ebillPartnerFeeVAConfig');
    }

    public function partnerReconciliationData(){
        return view('gate.ebill.partnerReconciliationData');
    }

    public function bienbandoisoat(){
        return view('gate.ebill.bienbandoisoatebill');
    }

    public function scheduleDetails(){
        return view('gate.ebill.scheduleDetails');
    }


}
