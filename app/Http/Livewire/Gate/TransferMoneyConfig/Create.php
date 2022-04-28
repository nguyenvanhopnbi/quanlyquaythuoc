<?php

namespace App\Http\Livewire\Gate\TransferMoneyConfig;

use App\Services\Gate\PartnerService;
use App\Services\Gate\TransferMoneyConfigFeeService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;
use Livewire\Component;

class Create extends Component
{
    use AuthorizesRequests;

    public $listPartnerCode = [];
    public $partnerCode;
    public $transactionFee = 0;
    public $transactionFeePercent = 0;
    public $checkAccountFee = 0;

    protected $rules = [
        'partnerCode' => 'required',
        'transactionFee' => 'required',
        'transactionFeePercent' => 'required',
        'checkAccountFee' => 'required',
    ];

    public function mount(PartnerService $partnerService)
    {
        $this->listPartnerCode = collect($partnerService->getAll())
            ->reject(fn ($item) => !$item || !$item->partner_code)
            ->map(fn ($item) => $item->partner_code)
            ->values()
            ->toArray();
        $this->partnerCode = $this->listPartnerCode[0] ?? '';
    }

    public function render()
    {
        return view('livewire.gate.transfer-money-config.create');
    }

    public function save(TransferMoneyConfigFeeService $transferMoneyConfigFeeService)
    {
        $this->authorize('transfer-money-config-add');
        $this->validate();
        $params = [
            'partnerCode' => $this->partnerCode,
            'transactionFee' => Str::of($this->transactionFee)->remove('.')->__toString(),
            'transactionFeePercent' => Str::of((int) $this->transactionFeePercent)->remove('.')->__toString(),
            'checkAccountFee' => Str::of($this->checkAccountFee)->remove('.')->__toString(),
        ];
        $submit = $transferMoneyConfigFeeService->create($params);

        if ($submit['success']) {
            $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => __('Created.')]);
            $this->dispatchBrowserEvent('saved');
            $this->emit('saved');
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TRANSFER_MONEY_CONFIG, "Thêm Cấu hình Chi hộ", compact('params')));
            return;
        }
        if ($submit['data']->errorCode == 15) {
            $this->addError('partnerCode', __($submit['data']->message));
            return;
        }
        $this->dispatchBrowserEvent('notify', ['type' => 'danger', 'message' => __($submit['data']->message)]);
    }
}
