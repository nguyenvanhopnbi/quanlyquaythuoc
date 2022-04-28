<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;

class TopupTransaction extends Component
{
    public $providers;
    protected $listeners = ['ExportTopUpTransaction' => 'ExportTopUpTransaction'];
    public function render()
    {
        return view('livewire.topup-transaction');
    }

    public function ExportTopUpTransaction(
        $transaction_id,
        $partner_ref_id,
        $partner_code,
        $application_id,
        $phone_number,
        $telco,
        $telco_service_type,
        $status,
        $topup_status,
        $topup_amount,
        $startTime,
        $endTime,
        $provider,
        $provider_ref_id
    )
    {

        return redirect()->route('topup.transaction.listExportcsv', [
        'transaction_id'=>$transaction_id,
        'partner_ref_id'=>$partner_ref_id,
        'partner_code'=>$partner_code,
        'application_id'=>$application_id,
        'phone_number'=>$phone_number,
        'telco'=>$telco,
        'telco_service_type'=>$telco_service_type,
        'status'=>$status,
        'topup_status'=>$topup_status,
        'amount'=>$topup_amount,
        'startTime'=>$startTime,
        'endTime'=>$endTime,
        'provider_code'=>$provider,
        'provider_ref_id'=>$provider_ref_id

        ]);


    }
}
