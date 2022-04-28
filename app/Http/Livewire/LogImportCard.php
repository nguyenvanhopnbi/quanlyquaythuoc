<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LogImportCard extends Component
{
    public $page;
    public $pageMax;
    public $pageSize;
    public $total;
    public $part;
    public $startPage;
    public $endPage;
    public $link;


    public function render()
    {
        return view('livewire.log-import-card');
    }
}
