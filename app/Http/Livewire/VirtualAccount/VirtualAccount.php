<?php

namespace App\Http\Livewire\VirtualAccount;

use Livewire\Component;

use App\Services\Gate\VirtualAccountService;
use App\Transformers\VirtualAccountTransformer;

class VirtualAccount extends Component
{

    protected $listeners = [

        'ExportVirtualAccount' => 'ExportVirtualAccount'
    ];

    public function render()
    {
        return view('livewire.virtual-account.virtual-account');
    }



    public function ExportVirtualAccount(

        $billId,
        $providerCode,
        $account_id,
        $accountNo,
        $accountName,
        $paid_amount,
        $startTime,
        $endTime,
        $partnerCode
    ){

        return redirect()->route('gate.virtual-account.list.export', [
            'billId' => $billId,
            'providerCode' => $providerCode,
            'account_id' => $account_id,
            'accountName'=> $accountName,
            'accountNo' => $accountNo,
            'paid_amount' => $paid_amount,
            'startTime' => $startTime,
            'endTime' => $endTime,
            'partnerCode' => $partnerCode

        ]);




    }


}
