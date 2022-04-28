<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LogImportCardSearch extends Component
{
    public $page;
    public $pageMax;
    public $parameter;
    public $link;
    public $pageSize;
    public $total;
    public $part;
    public $startPage;
    public $endPage;


    public function render()
    {
        return view('livewire.log-import-card-search');
    }
}
