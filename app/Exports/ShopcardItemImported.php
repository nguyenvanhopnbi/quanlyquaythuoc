<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\{FromCollection, WithHeadings, WithTitle};

class ShopcardItemImported implements FromCollection, WithHeadings, WithTitle
{
    private $imported;

    public function __construct($imported)
    {
        $this->imported = collect($imported)
            ->mapToGroups(fn ($item) => [$item['vendor'] . $item['value'] => $item]);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $providers = $this->imported->flatten(1)->pluck('provider_code')->unique()->toArray();

        return $this->imported->map(function ($item, $key) use ($providers) {
            $row = collect();
            $row->push($key, number_format($item->first()['value'])); // Tên thẻ, mệnh giá
            foreach ($providers as $provider) {
                $row->push($item->where('provider_code', $provider)->first()['total'] ?? '0'); // provider
            }
            $row->push($item->sum('total')); // Tổng nhập
            return $row;
        });
    }

    public function headings(): array
    {
        return [
            'Tên thẻ',
            'Mệnh giá',
            ...$this->imported->flatten(1)->pluck('provider_code')->unique()->toArray(), // provider
            'Tổng nhập',
        ];
    }

    public function title(): string
    {
        return 'Nhập';
    }
}
