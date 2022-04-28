<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EbillTransaction extends Component
{
    protected $listeners = ['ExportEbillTransaction' => 'ExportEbillTransaction'];

    public $partnerCodeList;

    public $providerCodeList;

    public function render()
    {
        return view('livewire.ebill-transaction');
    }
    public function ExportEbillTransaction(
        $ebill_id,
        $transaction_id,
        $amount,
        $partner_code,
        $billCode,
        $type,
        $status,
        $provider_ref_id,
        $startTime,
        $endTime,
        $providerCode,
        $account_no
    ){
        // dd('vao day');
        return redirect()->route('gate.ebill-transaction.getListexport', [
            'billId' => $ebill_id,
            'transactionId' => $transaction_id,
            'amount' => $amount,
            'partnerCode' => $partner_code,
            'billCode' => $billCode,
            'type' => $type,
            'status' => $status,
            'collectPartnerRefId' => $provider_ref_id,
            'startTime' => $startTime,
            'endTime' => $endTime,
            'providerCode' => $providerCode,
            'accountNo' => $account_no,
        ]);
    }
}
