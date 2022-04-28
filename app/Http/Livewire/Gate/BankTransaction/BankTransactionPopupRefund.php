<?php

namespace App\Http\Livewire\Gate\BankTransaction;

use Livewire\Component;
use App\Connection\BankTransactionConnection;

class BankTransactionPopupRefund extends Component
{
    protected $listeners = [
        'refundMoca' => 'refundMoca'
    ];

    public $detail;
    public $message;
    public $warning = false;

    public function render()
    {
        // $this->getListVATransaction();
        return view('livewire.gate.bank-transaction.bank-transaction-popup-refund');
    }

    // public function getListVATransaction(){
    //     $params = [];
    //     $data = BankTransactionConnection::getListVATransaction($params, "AP211344882488");
    //     dd($data);
    // }

    public function refundMoca($transaction_id, $amount, $reason){
        $params = [];
        $params['transaction_id'] = $transaction_id;
        $params['amount'] = $amount;
        $params['reason'] = $reason;
        $result = BankTransactionConnection::refundMoca($params);
        if(isset($result->code)){
            if($result->code == 0){
                $this->message = "Bạn đã refund thành công TransactionID: " . $transaction_id;
                $this->warning = false;
                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::GATE_TRANSACTION_REFUND, "Confirm lịch đối soát thành công #" . $transaction_id, compact('params')));
                $this->emit('refreshNumberFormat');
                return;
            }
        }

        if(isset($result['status_code'])){
            if($result['status_code'] != 200 ){
                // $this->message = "Bạn đã refund thất bại TransactionID: " . $transaction_id . " and code: " . $result['status_code'];
                $this->warning = true;
                $msg = json_decode($result['body']);
                $this->message = $msg->message;
                // dd($msg);
                $this->emit('refreshNumberFormat');
                return;
            }
        }



    }
}
