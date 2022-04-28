<?php

namespace App\Http\Livewire\Gate\ShopcardItem;

use App\Services\Gate\ShopcardItemService;
use Illuminate\Support\LazyCollection;
use Livewire\Component;
use Livewire\WithFileUploads;
use Rap2hpoutre\FastExcel\FastExcel;
use Str;

class Extend extends Component
{
    use WithFileUploads;

    public $data = '';
    public $import;

    public function render()
    {
        return view('livewire.gate.shopcard-item.extend');
    }

    public function updatedImport()
    {
        $this->data = '';
        switch (Str::upper($this->import->getClientOriginalExtension())) {
            case 'TEXT':
            case 'TXT':
            case 'CSV':
                $this->readTextFile();
                break;
            case 'XLS';
            case 'XLSX':
                $this->readExcelFile();
            default:
                break;
        }
    }

    public function readTextFile()
    {
        LazyCollection::make(function () {
            $handle = fopen($this->import->getRealPath(), 'r');

            while (($line = fgets($handle)) !== false) {
                yield $line;
            }
        })->each(function ($line) {
            $this->data .= str_replace(',', ':', $line);
        });
    }

    public function readExcelFile()
    {
        $this->data = (new FastExcel())->withoutHeaders()->import($this->import->getRealPath())
            ->map(fn ($item) => implode(':', $item))
            ->implode(PHP_EOL);
    }

    public function save()
    {
        $this->validate([
            'data' => 'required'
        ]);

        $data = (new ShopcardItemService)->extend([
            'data' => $this->data
        ]);
        if (!property_exists($data, 'result')) {
            $this->dispatchBrowserEvent('notify', ['type' => 'danger', 'message' => 'Có lỗi xảy ra. Xin thử lại sau!']);
            return;
        }
        $result = collect($data->result);
        if ($result->contains(false)) {
            $lineError =  $result
                ->filter(fn ($item) => !$item)
                ->keys()
                ->map(fn ($item) => intval($item) + 1)
                ->implode(', ');

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::SHOPCARD_CARD_ITEM, "Gia hạn Danh sách Item Thẻ Shopcard", ['data' => $this->data]));
            $this->dispatchBrowserEvent('notify', ['type' => 'warning', 'message' => "Dòng $lineError bị lỗi"]);
            return;
        }
        event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::SHOPCARD_CARD_ITEM, "Gia hạn Danh sách Item Thẻ Shopcard", ['data' => $this->data]));
        $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Thành công']);
    }
}
