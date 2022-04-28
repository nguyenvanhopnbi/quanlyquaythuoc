<?php

namespace App\Http\Livewire\Gate\Tool;

use Livewire\Component;
use App\Services\Gate\BankVendorService;
use App\Connection\ToolConnection;
use Carbon\Carbon;
use App\Services\Gate\BankTransactionService;

class Tool extends Component
{
    protected $listeners = ['UpdateTool' => 'UpdateTool', 'resetMessage' => 'resetMessage'];

    public $message;
    public $transactionIDmessage;


    public function render()
    {
        // $this->getRequestTime('AP211237900276');
        $this->getVendor();
        return view('livewire.gate.tool.tool');
    }

    public $vendorData;
    public function getVendor(){
        $params = [];
        $BankVendorService = new BankVendorService();
        $data = $BankVendorService->getListSource($params);
        if(isset($data['items'])){
            $this->vendorData = $data['items'];
        }

        // dd($this->vendorData);
    }

    public function UpdateTool(
        $transaction_id,
        $bankrefID,
        $toolVendor,
        $today
    ){


        $ToolConnection = new ToolConnection();

        $mytime = Carbon::now();

        if(isset($bankrefID) && !empty($bankrefID)){
            $params['vendor_ref_id'] = $bankrefID;
        }


        $params['vendor_code'] = $toolVendor;
        // dd($today);

        if($today == "1"){
            $params['response_time'] = strtotime($mytime);
        }else{
            $mytime = $this->getRequestTime($transaction_id);
            $params['response_time'] = strtotime('+10 seconds', $mytime);
        }

        $result = $ToolConnection->updateTool($transaction_id, $params);

        if($result && $mytime != null){
            $this->message = "Update successfully!";
            $this->transactionIDmessage = $transaction_id;
            // dd('vao day');

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::GATE_TRANSACTION_TOOL, "Cập nhật trạng thái giao dịch thành công #" . $transaction_id, compact('params', 'transaction_id')));
        }else{
            $this->transactionIDmessage = $transaction_id;
            $this->message = "Please check your data ID ". $transaction_id ." or contact support!";
        }

        if($this->getRequestTime($transaction_id) == '00'){
            $this->transactionIDmessage = $transaction_id;
            $this->message = "Please check your data (Request Time) Transaction ID: ". $transaction_id ." or contact support!";
        }




    }
    public function resetMessage(){
        $this->message = '';
    }

    public function getRequestTime($transactionID){
        $params['query']['transaction_id'] = $transactionID;
        $BankTransactionService = new BankTransactionService();
        $data = $BankTransactionService->getList($params);
        if(empty($data->data)){
            $this->message = "Please check your data ID ". $transactionID ." or contact support!";
            return '00';
        }
        else{
            foreach($data->data as $data){
                $requestTime = $data->request_time;
            }
            return $requestTime;
        }

    }

}
