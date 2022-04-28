<?php

namespace App\Http\Livewire\Element;

use Livewire\Component;

use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Container\Container;
use App\Models\ActivityLog;
use App\Models\group_permission;
use App\Models\Permission;
use App\Connection\DoubleCheckConnection;
use Illuminate\Http\Request;

class Pagination extends Component
{

    public $pagination;
    public $currentUrl;
    public $params;

    public function render()
    {
        return view('livewire.element.pagination');
    }


    public static function paginate(Collection $collection, $pageSize){
        // $page = Paginator::resolveCurrentPage('page');
        $page = 1;
        $total = $collection->count();

        return self::paginator($collection->forPage($page, $pageSize), $total, $pageSize, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);
    }

    protected static function paginator($items, $total, $perPage, $currentPage, $options){
        return Container::getInstance()->makeWith(LengthAwarePaginator::class, compact('items', 'total', 'perPage', 'currentPage', 'options'));
    }
}
