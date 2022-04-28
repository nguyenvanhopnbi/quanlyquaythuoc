<?php

namespace App\Http\Livewire\Gate\TransferMoneyConfig;

use App\Services\Gate\PartnerService;
use App\Services\Gate\TransferMoneyConfigFeeService;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;
use Livewire\Component;

class Edit extends Component
{
    use AuthorizesRequests;

    public $listPartnerCode = [];

    public $partnerCode;
    public $transactionFee;
    public $transactionFeePercent;
    public $checkAccountFee;
    public $configId = null;

    protected $rules = [
        'partnerCode' => 'required',
        'transactionFee' => 'required',
        'transactionFeePercent' => 'required',
        'checkAccountFee' => 'required',
    ];

    protected $listeners = [
        'edit' => 'initData',
        'refresh' => '$refresh',
    ];

    public function mount(PartnerService $partnerService)
    {
        $this->listPartnerCode = collect($partnerService->getAll())
            ->reject(fn ($item) => !$item || !$item->partner_code)
            ->map(fn ($item) => $item->partner_code)
            ->values()
            ->toArray();
    }

    public function initData($configId, TransferMoneyConfigFeeService $transferMoneyConfigFeeService)
    {
        try {
            $this->configId = $configId;
            [
                'partnerCode' => $this->partnerCode,
                'transactionFee' => $this->transactionFee,
                'transactionFeePercent' => $this->transactionFeePercent,
                'checkAccountFee' => $this->checkAccountFee,
            ] = collect($transferMoneyConfigFeeService->show($configId)->data)->toArray();
        } catch (Exception $e) {
            //
        }
        $this->emit('refresh');
    }

    public function render()
    {
        return view('livewire.gate.transfer-money-config.edit');
    }

    public function save(TransferMoneyConfigFeeService $transferMoneyConfigFeeService)
    {
        $this->authorize('transfer-money-config-edit');
        $this->validate();
        $params = [
            'partnerCode' => $this->partnerCode,
            'transactionFee' => Str::of($this->transactionFee)->remove('.')->__toString(),
            'transactionFeePercent' => Str::of((int) $this->transactionFeePercent)->remove('.')->__toString(),
            'checkAccountFee' => Str::of($this->checkAccountFee)->remove('.')->__toString(),
        ];
        $submit = $transferMoneyConfigFeeService->update($id = $this->configId, $params);

        $this->reset('configId');
        if ($submit['success']) {
            $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => __('Created.')]);
            $this->dispatchBrowserEvent('saved');
            $this->emit('saved');
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TRANSFER_MONEY_CONFIG, "Sửa Cấu hình Chi hộ #$id", compact('id', 'params')));
            return;
        }
        if ($submit['data']->errorCode == 15) {
            $this->addError('partnerCode', __($submit['data']->message));
            return;
        }
        $this->dispatchBrowserEvent('notify', ['type' => 'danger', 'message' => __($submit['data']->message)]);
    }
}
