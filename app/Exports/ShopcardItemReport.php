<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\{Exportable, WithMultipleSheets};

class ShopcardItemReport implements WithMultipleSheets
{
    use Exportable;

    private $imported, $sold, $redundant, $oldRedundant;

    public function setImported($imported)
    {
        $this->imported = $imported;
        return $this;
    }

    public function setSold($sold)
    {
        $this->sold = $sold;
        return $this;
    }

    public function setRedundant($redundant)
    {
        $this->redundant = $redundant;
        return $this;
    }

    public function setOldRedundant($oldRedundant)
    {
        $this->oldRedundant = $oldRedundant;
        return $this;
    }

    public function sheets(): array
    {
        return [
            new ShopcardItemImported($this->imported),
            new ShopcardItemSold($this->sold),
            new ShopcardItemRedundancy($this->imported, $this->sold, $this->redundant, $this->oldRedundant),
        ];
    }
}
