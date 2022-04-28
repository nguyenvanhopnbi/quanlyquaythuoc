<?php

namespace App\Http\Livewire\Gate\TransferMoneyConfig;

use Livewire\Component;
use App\Connection\updateTransactionMoneyConnection;

class UpdateTransaction extends Component
{
    protected $listeners = [

        'updateTransaction' => 'updateTransaction'
    ];
    public function render()
    {
        return view('livewire.gate.transfer-money-config.update-transaction');
    }

    public $message;
    public $warning = false;
    public $TransactionIDsuccess;
    public $TransactionIDerror;

    public function updateTransaction($transactionList){
        foreach($transactionList as $list){
            if(str_contains($list, "\n")){
                $data = preg_split('/\r\n|[\r\n]/', $list);
                $transactionList = array_merge($data, $transactionList);

            }else{
                $data = $transactionList;
            }
            // dd($transactionList);

        }


        $params = [];

        $params['transaction_id'] = $data;

        $result = updateTransactionMoneyConnection::update($params);
         // dd($params);
        if($result['success']){
            // dd('1111');
            $this->warning = false;
            $this->TransactionIDsuccess = $result['data']->result->success;
            $this->TransactionIDerror = $result['data']->result->error;
            $this->message = "Cập nhật trạng thái giao dịch thành công! Số lượng cập nhật: " . count($result['data']->result->success);
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TRANSFER_MONEY_UPDATE, "Sửa trạng thái giao dịch thành công", compact('transactionList')));
        }else{
            $this->TransactionIDsuccess = $result['data']->result->success;
            $this->TransactionIDerror = $result['data']->result->error;
            $this->warning = true;
            $this->message = "Hãy kiểm tra lại danh sách nhập mã giao dịch của bạn hoặc liên hệ với lập trình viên để được giải quyết! ";
        }
    }
    public function resetMessage(){
        unset($this->message);
        unset($this->warning);
    }


    public $placeholder = '01FFP62JABHWN74J8FSTAN312W  01FFP5SMPM36C457T1SRSW59CR  01FFP5MJEG3D4A6FXRXZP04ZMG  01FFMFA47AYQSMK0PX255JVPST  01FFMBZC82ACWZ5H9TB8E9328J ';
}
