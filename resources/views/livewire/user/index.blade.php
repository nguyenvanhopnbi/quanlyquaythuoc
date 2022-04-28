<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-line-chart"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">

                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions"></div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">

                <!--begin: Search Form -->
                <div class="kt-pagination kt-pagination--brand">
                    <div class="kt-pagination__toolbar">
                        <select class="form-control kt-font-brand" style="width: 60px" wire:model="perPage">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                    <div class="kt-margin-b-10-tablet-and-mobile">
                        <input type="text" class="form-control kt-input" placeholder="Tìm kiếm nhanh" data-col-index="0"
                            wire:model.debounce="search">
                    </div>
                </div>

                <!--begin: Datatable -->
                <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>
                <table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead class="kt-font-boldest">
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>SĐT</th>
                            <th>Trạng thái</th>
                            <th class="text-right">Ngày tạo</th>
                            <th class="text-right">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr wire:key="{{ $user->id }}">
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>
                                <span class="badge badge-{{ $user->is_active ? 'success' : 'danger' }}">
                                    {{ $user->is_active ? 'Hoạt động' : 'Khóa' }}
                                </span>
                            </td>
                            <td class="text-right">{{ $user->created_at }}</td>
                            <td class="text-right">
                                @can('update', $user)
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-icon btn-primary btn-sm">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!--end: Datatable -->
            </div>
        </div>
    </div>

    <!-- end:: Content -->
</div>
