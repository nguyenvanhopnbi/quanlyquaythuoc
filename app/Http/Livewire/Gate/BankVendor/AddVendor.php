<?php

namespace App\Http\Livewire\Gate\BankVendor;

use Livewire\Component;
use App\Services\Gate\BankVendorService;

class AddVendor extends Component
{

    public $payment_method = [];

    protected $listeners = [
        'save' => 'save',
        'addMorePaymentmethod' => 'addMorePaymentmethod',
        'deletePaymentmethod' => 'deletePaymentmethod'
    ];

    public function render()
    {
        return view('livewire.gate.bank-vendor.add-vendor');
    }

    public function addMorePaymentmethod($payment_method){
        if(!empty($payment_method)){
            $this->payment_method[] = $payment_method;
        }
    }

    public function deletePaymentmethod($pay){
        $key = array_search($pay, $this->payment_method);
        if ($key !== false) {
            unset($this->payment_method[$key]);
        }
    }


    public function save($vendor_code, $vendor_name, $public, $payment_method){
        $params['vendor_code'] = $vendor_code;
        $params['vendor_name'] = $vendor_name;
        $params['public'] = $public;
        $params['payment_method'] = implode(',', array_unique($this->payment_method));

        $BankVendorService = new BankVendorService();
        $result = $BankVendorService->add($params);
        if(isset($result->success)){
            if($result->success){
                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::GATE_VENDOR, "Thêm Bank Vendor CTT", compact('params')));

                $this->emit('messageScript', $result);
            }
        }

    }
}
