<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Services\Gate\BankTransactionService;
use App\Http\Controllers\Gate\ExportBankController;




class ExportFormSearch extends Component
{
    protected $listeners = ['ExportCSV' => 'ExportCSV'];

    public $Amount;
    public $transaction_id;
    public $order_id;
    public $partner_code;
    public $status;
    public $bank_code;
    public $startTime;
    public $endTime;
    public $application_id;
    public $payment_method;
    public $order_info;
    public $vendor_code;
    public $result;

    public $input_bank_holding_status;
    public $hasRefund;

    public function render()
    {
        return view('livewire.export-form-search');
    }
    public function mount(){

    }

    public function ExportCSV(
        $order_id,
        $transaction_id,
        $Amount,
        $status,
        $result,
        $vendor_code,
        $order_info,
        $client_ip,
        $payment_method,
        $partner_code,
        $bank_code,
        $application_id,
        $startTime,
        $endTime,
        $vendor_ref_id,
        $input_bank_holding_status,
        $hasRefund
    )
    {

        if(isset($input_bank_holding_status) and $input_bank_holding_status != 'all'){
            $this->input_bank_holding_status = $input_bank_holding_status;
        }
        if(isset($hasRefund) and $hasRefund != 'all'){
            $this->hasRefund = $hasRefund;
        }

        if(isset($Amount)){
            $this->Amount = $Amount;
        }
        if(isset($status)){
            $this->status = $status;
        }

        if(isset($result)){
            $this->result = $result;
        }
        if(isset($transaction_id)){
            $this->transaction_id = $transaction_id;
        }
        if(isset($startTime)){

            $this->startTime = $startTime;
        }
        if(isset($endTime)){
            $this->endTime = $endTime;
        }
        if(isset($partner_code)){
            $this->partner_code = $partner_code;
        }
        if(isset($bank_code)){
            $this->bank_code = $bank_code;
        }
        if(isset($application_id)){
            $this->application_id = $application_id;
        }
        if(isset($payment_method)){
            $this->payment_method = $payment_method;
        }
        if(isset($client_ip)){
            $this->client_ip = $client_ip;
        }
        if(isset($order_info)){
            $this->order_info = $order_info;
        }
        if(isset($vendor_code)){
            $this->vendor_code = $vendor_code;
        }
       return redirect()->action([ExportBankController::class, 'exportCSV'], [
        'order_id'=>$order_id,
        'transaction_id'=>$transaction_id,
        'Amount' => $this->Amount,
        'status' => $this->status,
        'bank_code' => $this->bank_code,
        'partner_code' => $this->partner_code,
        'startTime' => $this->startTime,
        'endTime' => $this->endTime,
        'application_id' => $this->application_id,
        'payment_method' => $this->payment_method,
        'client_ip' => $this->client_ip,
        'vendor_code' => $this->vendor_code,
        'order_info' => $this->order_info,
        'result' => $this->result,
        'vendor_ref_id' => $vendor_ref_id,
        'input_bank_holding_status' => $this->input_bank_holding_status,
        'hasRefund' => $this->hasRefund
    ]);

    }
}
