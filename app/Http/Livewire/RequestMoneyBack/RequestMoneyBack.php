<?php

namespace App\Http\Livewire\RequestMoneyBack;

use Livewire\Component;
use App\Connection\RequestMoneyBackConnection;

class RequestMoneyBack extends Component
{
    protected $listeners = [
        'RequestMoneyBack' => 'RequestMoneyBack'
    ];
    public function render()
    {
        return view('livewire.request-money-back.request-money-back');
    }

    public $message;
    public $warning = false;

    public function RequestMoneyBack($account_no, $transaction_number){
        $params = [];
        $params['account_no'] = $account_no;
        $params['transaction_number'] = $transaction_number;
        $result = RequestMoneyBackConnection::RequestMoneyBack($params);
        // dd($result);

        if(!$result){
            $this->message = "Yêu cầu thất bại, kiểm tra dũ liệu nhập vào.";
            $this->warning = true;
            return;
        }

        if(isset($result->success)){

            if($result->success == true){

                $this->message = "Yêu cầu thành công! Account No: " .$account_no . " and Transaction Number: " .$transaction_number;
                $this->warning = false;

                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::EBILL_BANK_REQUEST_MONEY_BACK, "Yêu cầu gửi lại thông báo đã nhận tiền #AccountNo: " . $account_no . " and #Transaction Number: " .$transaction_number , compact('params')));

                return;

            }else{
                $this->message = "Yêu cầu thất bại, kiểm tra dũ liệu nhập vào.";
                $this->warning = true;
                return;
            }
        }










    }
}
