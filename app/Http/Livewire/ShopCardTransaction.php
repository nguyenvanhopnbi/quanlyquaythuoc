<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShopCardTransaction extends Component
{
    protected $listeners = ['ExportShopCardTransaction' => 'ExportShopCardTransaction'];
    public function render()
    {
        return view('livewire.shop-card-transaction');
    }
    public function ExportShopCardTransaction(
        $transaction_id,
        $partner_ref_id,
        $partner_code,
        $application_id,
        $amount,
        $status,
        $vendor,
        $startTime,
        $endTime

    ){
        return redirect()->route('shopcard.transaction.ajax.getListexport', [

            'transaction_id' => $transaction_id,
            'partner_ref_id' => $partner_ref_id,
            'partner_code' => $partner_code,
            'application_id' => $application_id,
            'amount' => $amount,
            'status' => $status,
            'vendor' => $vendor,
            'startTime' => $startTime,
            'endTime' => $endTime,

        ]);
    }
}
