<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;

class ShopCardPartnerCardData extends Component
{
    protected $listeners = ['ExportShopCardPartnerCardData' => 'ExportShopCardPartnerCardData'];
    public function render()
    {
        return view('livewire.shop-card-partner-card-data');
    }
    public function ExportShopCardPartnerCardData(
        $ref_transaction_id,
        $partner_ref_id,
        $vendor,
        $value,
        $serial,
        $startTime,
        $endTime,
        Request $request
    ){
        return redirect()->route('shopcard.partner-card-data.ajax.getListexport', [
            'ref_transaction_id' => $ref_transaction_id,
            'partner_ref_id' => $partner_ref_id,
            'vendor' => $vendor,
            'value' => $value,
            'serial' => $serial,
            'startTime' => $startTime,
            'endTime' => $endTime,
        ]);
    }
}
