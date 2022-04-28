<?php

namespace App\Http\Livewire\Activity;

use App\Enums\LogCategoryEnum;
use App\Models\Activity;
use App\Models\User;
use Cache;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Str;

class Browse extends Component
{
    use WithPagination;

    public $perPage = '25';

    public $filter = [];
    public $categories = [];
    public $users = [];

    protected $queryString = [
        'filter' => ['except' => []]
    ];

    public function mount()
    {
        // dd('vao day');
        $this->categories = Cache::remember('logCategories', 3810, function () {
            $categories = [];
            foreach (LogCategoryEnum::VALUE as $key => $item) {
                $category = collect(LogCategoryEnum::GROUP)
                    ->filter(fn ($groupItem, $groupKey) => Str::of($key)->startsWith($groupKey))
                    ->first();
                $categories[$category][$key] = $item;
            }
            return $categories;
        });

        // dd($this->categories);
        $this->users = Cache::remember('users', 3810, fn () => User::all(['id', 'email', 'name']));
    }

    public function updatedFilter()
    {
        $this->page = 1;
    }

    public function render()
    {

        return view('livewire.activity.browse', [
            'activities' => $this->loadData()
        ]);
    }

    public function loadData()
    {
        $causer = isset($this->filter['causer'])
            ? User::find($this->filter['causer'])
            : null;
        return Activity::query()
            ->with('causer')
            ->when($this->filter['description'] ?? null, function ($query, $description) {
                $query->where('description', 'like', "%$description%");
            })
            ->when($this->filter['category'] ?? null, function ($query, $category) {
                $query->whereCategory($category);
            })
            ->when($causer ?? null, function ($query, $causer) {
                $query->causedBy($causer);
            })
            ->when($this->filter['startTime'] ?? null, function ($query, $startTime) {
                $time = Carbon::createFromFormat('Y-m-d', $startTime)->startOfDay();
                $query->where('created_at', '>=', $time);
            })
            ->when($this->filter['endTime'] ?? null, function ($query, $endTime) {
                $time = Carbon::createFromFormat('Y-m-d', $endTime)->endOfDay();
                $query->where('created_at', '<=', $time);
            })
            ->latest('id')
            ->simplePaginate($this->perPage);
    }

    public function showData($id)
    {
        dd(Activity::findOrFail($id)->getExtraProperty('data'));
    }
}
