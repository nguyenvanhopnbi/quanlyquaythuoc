<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\{FromCollection, WithHeadings, WithTitle};

class ShopcardItemSold implements FromCollection, WithHeadings, WithTitle
{
    private $sold;

    public function __construct($sold)
    {
        $this->sold = collect($sold)->mapWithKeys(fn ($item) => [$item['vendor'] . $item['value'] => $item]);
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->sold->map(function ($item, $key) {
            $row = collect();
            $row->push($key, number_format($item['value']), $item['total']);
            return $row;
        });
    }

    public function headings(): array
    {
        return [
            'Tên thẻ',
            'Mệnh giá',
            'Tổng xuất',
        ];
    }

    public function title(): string
    {
        return 'Xuất';
    }
}
