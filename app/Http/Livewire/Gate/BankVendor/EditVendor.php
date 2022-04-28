<?php

namespace App\Http\Livewire\Gate\BankVendor;

use Livewire\Component;
use App\Services\Gate\BankVendorService;

class EditVendor extends Component
{

    public $paymentMethodArr;

    protected $listeners = [
        'deletePaymentmethod' => 'deletePaymentmethod',
        'edit' => 'edit',
        'addMorePaymentmethod' => 'addMorePaymentmethod'
    ];

    public $detail;

    public function render()
    {
        return view('livewire.gate.bank-vendor.edit-vendor', [
            'detail' => $this->detail
        ]);
    }

    public function mount(){
        $this->paymentMethodArr = explode(',', $this->detail['payment_method']);
    }

    public function deletePaymentmethod($pay){

        $key = array_search($pay, $this->paymentMethodArr);
        if ($key !== false) {
            unset($this->paymentMethodArr[$key]);
        }
    }

    public function addMorePaymentmethod($payment_method){

        if(!empty($payment_method)){

            $this->paymentMethodArr[] = $payment_method;
            $this->paymentMethodArr = array_unique($this->paymentMethodArr);

        }

        // dd($this->paymentMethodArr);

    }

    public function edit( $id, $vendor_code, $vendor_name, $public, $payment_method){

        if(isset($this->paymentMethodArr) and !empty($this->paymentMethodArr)){
            $key = array_search("", $this->paymentMethodArr);
            if($key !== false){
                unset($this->paymentMethodArr[$key]);
            }
        }



        $params['vendor_code'] = $vendor_code;
        $params['vendor_name'] = $vendor_name;
        $params['public'] = $public;
        $params['payment_method'] = implode(',', array_unique($this->paymentMethodArr));
        $bankVendorService = new BankVendorService();
        $result = $bankVendorService->edit($id, $params);

        if(isset($result->success)){
            if($result->success){
                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::GATE_VENDOR, "Sửa Bank Vendor CTT #$id", compact('id', 'params')));

                $this->emit('messageScript');
            }
        }



    }
}
