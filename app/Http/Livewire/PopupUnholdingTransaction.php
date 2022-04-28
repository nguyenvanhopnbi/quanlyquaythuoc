<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Connection\ShopcardHoldingConnection;
use Illuminate\Support\Facades\Gate;

class PopupUnholdingTransaction extends Component
{

    protected $listeners = [
        'unholding' => 'unholding'
    ];

    public $detail;
    public $message;
    public $warning = false;

    public function render()
    {
        return view('livewire.popup-unholding-transaction');
    }

    public function unholding($transactionID, $reason){

        if (!Gate::allows('unhold-action-gate-transaction')) {
            $this->emit('resultGateUnHoldingScript', [
                'success' => false, 'message' => 'Bạn chưa được cấp quyền Un-hold'
            ]);
            return;
        }



        $params = [];
        $params['transaction_id'] = $transactionID;
        $params['reason'] = $reason;

        $result = ShopcardHoldingConnection::unhold($params);
        if(isset($result->errorCode)){

            if($result->errorCode == '0'){
                $this->message = "Unhold Successfully! TransactionID : " .$transactionID;
                $this->warning = false;

                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::SHOPCARD_UNHOLDING, "Unholding Transaction thành công #" .$transactionID, compact('params')));
            }else{
                $this->message = "This transaction can not unHold, please check TransactionID: " . $transactionID;
                $this->warning = true;
            }


        }

    }


}
