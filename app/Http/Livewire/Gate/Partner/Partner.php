<?php

namespace App\Http\Livewire\Gate\Partner;

use Livewire\Component;
use App\Services\Gate\PartnerService;

class Partner extends Component
{
    protected $listeners = [
        'exportPartnerCSV' => 'exportPartnerCSV'
    ];
    public function render()
    {
        // $this->getListPartner();
        return view('livewire.gate.partner.partner');
    }
    public function exportPartnerCSV(
        $name,
        $partner_code,
        $email,
        $phone_number,
        $status,
        $accountType
    ){
        return redirect()->route('gate.partner.exportCSV', [
            'name' => $name,
            'partner_code' => $partner_code,
            'email' => $email,
            'phone_number' => $phone_number,
            'status' => $status,
            'account_type' => $accountType
        ]);
    }
}
