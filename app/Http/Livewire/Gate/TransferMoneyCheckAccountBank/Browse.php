<?php

namespace App\Http\Livewire\Gate\TransferMoneyCheckAccountBank;

use App\Services\Gate\TransferMoneyCheckAccountBankService;
use Livewire\Component;

class Browse extends Component
{
    public $bankCode = '';
    public $accountNo = '';
    public $accountType = '';
    public $accountName = '';
    public $showingModal = false;
    public $account = false;

    protected $rules = [
        'bankCode' => 'required',
        'accountNo' => 'required',
        'accountType' => 'required',
        'accountName' => 'required',
    ];

    public function render()
    {
        return view('livewire.gate.transfer-money-check-account-bank.browse');
    }

    public function search(TransferMoneyCheckAccountBankService $transferMoneyCheckAccountBankService)
    {
        $this->validate();

        $this->account = $transferMoneyCheckAccountBankService->search([
            'bankCode' => $this->bankCode,
            'accountNo' => $this->accountNo,
            'accountType' => $this->accountType,
            'accountName' => $this->accountName,
        ]);

        if ($this->account) {
            $this->account = collect($this->account)->toArray();
        }

        $this->showingModal = true;
    }
}
