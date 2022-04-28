<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Controllers\Gate\ExportShopCardItemController;

class ShopCardItem extends Component
{
    protected $listeners = ['ExportShopCardItem' => 'ExportShopCardItem'];
    public function render()
    {
        return view('livewire.shop-card-item');
    }

    public function ExportShopCardItem(
        $serial,
        $value,
        $vendor,
        $provider_code,
        $public,
        $sold,
        $startTime,
        $endTime,
        $createStartTime,
        $createEndTime
    ){
        // dd('vao day');
        return redirect()->route(
            'shopcard.card-item.ajax.getListExport',
            [
                'serial' => $serial,
                'value' => $value,
                'vendor' => $vendor,
                'provider_code' => $provider_code,
                'public' => $public,
                'sold' => $sold,
                'startTime' => $startTime,
                'endTime' => $endTime,
                'createStartTime' => $createStartTime,
                'createEndTime' => $createEndTime,
            ]

        );
    }
}
