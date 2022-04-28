<div>
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Danh sách giao dịch
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">

            <!--begin: Search Form -->
            <form class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10" method="GET">
                <div class="row align-items-center">
                    <div class="col-xl-12 order-2 order-xl-1">
                        <div class="row align-items-center">
                            <div class="col-xl-12 order-2 order-xl-1">
                                <div class="row align-items-center">

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Description:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input type="text" class="form-control"
                                                wire:model.defer="filter.description">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Category:</label>
                                        <x-widget.selectpicker class="form-control" data-live-search="true"
                                            wire:model.defer="filter.category">
                                            <option value="">&nbsp;</option>
                                            @foreach ($categories as $category => $group)
                                                <optgroup label="{{ $category }}">
                                                    @foreach ($group as $key => $item)
                                                        <option value="{{ $key }}">
                                                            {{ $item }}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </x-widget.selectpicker>
                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Causer:</label>
                                        <x-widget.selectpicker class="form-control" data-live-search="true"
                                            wire:model.defer="filter.causer">
                                            <option value="">&nbsp;</option>
                                            @foreach ($users as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->email }} - {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </x-widget.selectpicker>
                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                        <div class="form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Ngày bắt đầu:</label>
                                            </div>
                                            <x-widget.flatpickr wire:model.defer="filter.startTime" class="form-control"
                                                readonly placeholder="Chọn thời gian bắt đầu" />
                                        </div>
                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                        <div class="form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Ngày kết thúc:</label>
                                            </div>
                                            <x-widget.flatpickr class="form-control" wire:model.defer="filter.endTime"
                                                readonly placeholder="Chọn thời gian kết thúc" />
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                        <div class="form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>&nbsp;</label>
                                            </div>
                                            <button class="btn btn-primary" wire:click.prevent="$refresh"
                                                wire:loading.attr="disabled">Tìm Kiếm</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="kt-portlet__body kt-portlet__body--fit">
            <div class="kt-section__content m-5">
                <div class="kt-pagination kt-pagination--brand">
                    <div class="kt-pagination__toolbar">
                        <select class="form-control kt-font-brand" style="width: 60px" wire:model="perPage">
                            <option value="1">1</option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Caused By</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($activities ?? [] as $key => $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->description }}</td>
                                <td>
                                    {{ \App\Enums\LogCategoryEnum::VALUE[$item->category] }}
                                </td>
                                <td>{{ $item->causer->email }}</td>
                                <td>{{ $item->created_at }}</td>
                            </tr>
                        @empty
                            <td colspan="5" class="text-center">Không tìm thấy kết quả</td>
                        @endforelse
                    </tbody>
                </table>

                {{ $activities->links() }}
            </div>
        </div>
    </div>
</div>
