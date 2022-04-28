<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DetailEbillTransaction extends Component
{

    protected $listeners = [
        'resendTransaction' => 'resendTransaction'
    ];

    public $transaction_id;
    public $bill_id;
    public $detail;
    public $nameButton = "resendIPN";
    public function render()
    {
        return view('livewire.detail-ebill-transaction');
    }

    public function submit(){
        dd('vao day');
    }
}
