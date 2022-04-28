<?php

namespace App\Http\Livewire\Gate\TransferMoneyConfig;

use App\Services\Gate\PartnerService;
use App\Services\Gate\TransferMoneyConfigFeeService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class Browse extends Component
{
    use WithPagination, AuthorizesRequests;

    public $partnerCode = '';
    public $listPartnerCode = [];
    public $totalPage = 5;
    public $perPage = '25';

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'saved' => '$refresh',
    ];

    protected $queryString = [
        'partnerCode' => ['except' => ''],
    ];

    public function mount(PartnerService $partnerService)
    {
        $this->listPartnerCode = collect($partnerService->getAll())
            ->reject(fn ($item) => !$item || !$item->partner_code)
            ->map(fn ($item) => $item->partner_code)
            ->values()
            ->toArray();
    }

    public function render(TransferMoneyConfigFeeService $transferMoneyConfigFeeService)
    {
        $this->authorize('transfer-money-config-browse');
        [$configs, $meta] = $transferMoneyConfigFeeService->index([
            'partnerCode' => $this->partnerCode,
            'limit' => $this->perPage,
            'page' => $this->page,
        ]);

        $meta = collect(range(1, $meta->total))->paginate($meta->limit);

        return view('livewire.gate.transfer-money-config.browse', compact('configs', 'meta'));
    }

    public function delete($id, TransferMoneyConfigFeeService $transferMoneyConfigFeeService)
    {
        $this->authorize('transfer-money-config-delete');
        if ($transferMoneyConfigFeeService->destroy($id)) {
            $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => __('Deleted.')]);
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::TRANSFER_MONEY_CONFIG, "Xóa Cấu hình Chi hộ #$id", compact('id')));
        } else {
            $this->dispatchBrowserEvent('notify', ['type' => 'danger', 'message' => __('Error.')]);
        }

        $this->emit('saved');
    }
}
