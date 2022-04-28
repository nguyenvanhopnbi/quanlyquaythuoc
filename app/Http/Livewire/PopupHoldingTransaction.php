<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Connection\ShopcardHoldingConnection;
use Illuminate\Support\Facades\Gate;

class PopupHoldingTransaction extends Component
{
    public $detail;
    public $reason;

    protected $listeners = [
        'holding' => 'holding'
    ];
    public function render()
    {
        return view('livewire.popup-holding-transaction');
    }

    public $message;
    public $warning = false;

    public function holding($transactionid, $reason){

        if (!Gate::allows('hold-action-gate-transaction')) {
            $this->emit('resultGateHoldingScript', [
                'success' => false, 'message' => 'Bạn chưa được cấp quyền hold'
            ]);
            return;
        }


        $params = [];
        $params['transaction_id'] = $transactionid;
        $params['reason'] = $reason;

        $result = ShopcardHoldingConnection::hold($params);
        if(isset($result->errorCode)){
            if($result->errorCode == '0'){
                $this->message = "Holding successfully! Transaction ID: " . $transactionid;
                $this->warning = false;

                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::SHOPCARD_HOLDING, "Holding Transaction thành công #" .$transactionid , compact('params', 'reason')));

            }else{
                $this->message = "Holding false! Please check transaction ID again: " .$transactionid;
                $this->warning = true;
            }
        }


    }
}
