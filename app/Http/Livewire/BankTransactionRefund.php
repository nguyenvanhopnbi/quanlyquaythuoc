<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Services\Gate\BankTransactionService;
use App\Transformers\BankRefundTransactionTransformer;
use Illuminate\Http\Request;
use App\Connection\BankTransactionConnection;
use Illuminate\Support\Facades\Http;


class BankTransactionRefund extends Component
{
    protected $listeners = [
        'ExportBankTranSactionRefund' => 'ExportBankTranSactionRefund',
        'changeStatusrefundID' => 'changeStatusrefundID',
        'resetMessage' => 'resetMessage'
    ];

    public function render()
    {
        return view('livewire.bank-transaction-refund');
    }

    public function resetMessage(){
        unset($this->message);
        unset($this->warning);
    }

    public $message;
    public $warning = true;

    public function changeStatusrefundID($refundID, $VendorRefID, $StatusChange, $reject_reason){

        $params = [];
        $params['status'] = $StatusChange;
        $params['vendor_ref_id'] = $VendorRefID;
        $params['reject_reason'] = $reject_reason;

        $result = BankTransactionConnection::refundChangeStatus($refundID, $params);
        if(isset($result->errorCode) and $result->errorCode == 0){
            $this->message = "Thay đổi trạng thái thành công.";
            $this->warning = false;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::GATE_TRANSACTION_REFUND_STATUS, "Đổi status refund giao dịch thành công #Params" . json_encode($params), compact('params')));

        }else{
            $this->message = "Thay đổi trạng thái thất bại. Trạng thái phải là pending hoặc proccessing..";
            $this->warning = true;
        }
    }

    public function ExportBankTranSactionRefund(
        $transaction_id,
        $order_id,
        $parner_code,
        $refund_type,
        // $amount,
        $bank_code,
        $startTime,
        $endTime,
        $application_id,
        $payment_method,
        $vendor_ref_id,
        $status
    )
    {
        return redirect()->route('gate.transaction.refund.listExportCSV', [
            'transaction_id'=>$transaction_id,
            'order_id'=>$order_id,
            'parner_code'=>$parner_code,
            'refund_type'=>$refund_type,
            // 'amount'=>$amount,
            'bank_code'=>$bank_code,
            'startTime'=>$startTime,
            'endTime'=>$endTime,
            'application_id'=>$application_id,
            'payment_method'=>$payment_method,
            'vendor_ref_id'=>$vendor_ref_id,
            'status' => $status

        ]);
    }
}
