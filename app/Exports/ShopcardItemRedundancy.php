<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\{FromCollection, WithHeadings, WithTitle};

class ShopcardItemRedundancy implements FromCollection, WithTitle, WithHeadings
{
    private $imported;
    private $sold;
    private $redundant;
    private $oldRedundant;

    public function __construct($imported, $sold, $redundant, $oldRedundant)
    {
        $this->imported = collect($imported)->mapToGroups(fn ($item) => [$item['vendor'] . $item['value'] => $item]);
        $this->sold = collect($sold)->mapWithKeys(fn ($item) => [$item['vendor'] . $item['value'] => $item]);
        $this->redundant = collect($redundant)->mapWithKeys(fn ($item) => [$item['vendor'] . $item['value'] => $item]);
        $this->oldRedundant = collect($oldRedundant)->mapWithKeys(fn ($item) => [$item['vendor'] . $item['value'] => $item]);
    }

    public function collection()
    {
        return $this->redundant
            ->union($this->oldRedundant)
            ->map(function ($item, $key) {
                return [
                    $key,
                    $item['value'],                
                    optional($this->oldRedundant->get($key))['total'] ?? '0',
                    optional($this->imported->get($key))->sum('total') ?? '0',
                    optional($this->sold->get($key))['total'] ?? '0',
                    optional($this->redundant->get($key))['total'] ?? '0',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Tên thẻ',
            'Mệnh giá',
            'Tồn đầu kỳ',
            'Tổng nhập trong kỳ',
            'Tổng bán trong kỳ',
            'Tồn cuối kỳ',
        ];
    }

    public function title(): string
    {
        return 'Tồn';
    }
}
