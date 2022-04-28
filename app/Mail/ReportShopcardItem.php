<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class ReportShopcardItem extends Mailable
{
    use Queueable, SerializesModels;

    public $imported;
    public $sold;
    public $redundant;
    public $oldRedundant;
    public $start, $end;

    public function setImported($imported)
    {
        $this->imported = collect($imported)->mapToGroups(fn ($item) => [$item['vendor'] . $item['value'] => $item]);
        return $this;
    }

    public function setSold($sold)
    {
        $this->sold = collect($sold)->mapWithKeys(fn ($item) => [$item['vendor'] . $item['value'] => $item]);
        return $this;
    }

    public function setRedundant($redundant)
    {
        $this->redundant = collect($redundant)->mapWithKeys(fn ($item) => [$item['vendor'] . $item['value'] => $item]);
        return $this;
    }

    public function setOldRedundant($oldRedundant)
    {
        $this->oldRedundant = collect($oldRedundant)->mapWithKeys(fn ($item) => [$item['vendor'] . $item['value'] => $item]);
        return $this;
    }

    public function setRange(Carbon $start, Carbon $end)
    {
        $this->start = $start->format('F j, Y');
        $this->end = $end->format('F j, Y');
        return $this;
    }

    public function build()
    {
        $redundancies = $this->redundant
            ->union($this->oldRedundant)
            ->keys()
            ->mapWithKeys(function ($item) {
                return [$item => [
                    'current' => $this->redundant->get($item) ?? null,
                    'imported' => optional($this->imported->get($item))->sum('total') ?? null,
                    'sold' => $this->sold->get($item) ?? null,
                    'old' => $this->oldRedundant->get($item) ?? null,
                ]];
            });

        return $this->view('gate.shopcard-report.report', [
            'redundancies' => $redundancies
        ]);
    }
}
