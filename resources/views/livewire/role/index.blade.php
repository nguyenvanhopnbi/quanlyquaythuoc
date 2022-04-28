<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Content -->
    <x-bootstrap.alert-on-init :active="session()->has('success')" :type="'success'">
        <x-slot name="icon">
            <i class="fas fa-check"></i>
        </x-slot>
        {{ session()->get('success') }}
    </x-bootstrap.alert-on-init>
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col">
            </div>
        </div>
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
                        <div class="kt-portlet__head-actions">
                            @can('create', \App\Models\Role::class)
                            <a href="{{ route('roles.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                Vai trò mới
                            </a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
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
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Tên hiển thị</th>
                            <th>Mô tả</th>
                            <th>Ngày tạo</th>
                            <th class="text-right">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $role)
                        <tr wire:key="{{ $role->id }}">
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->display_name }}</td>
                            <td>{{ $role->description }}</td>
                            <td>{{ $role->created_at }}</td>
                            <td class="text-right">
                                @can('update', $role)
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-icon btn-primary btn-sm">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                @endcan
                                @can('delete', $role)
                                <button class="btn btn-icon btn-danger btn-sm" type="button" x-data x-on:click="
                                swal.fire({
                                    title: 'Xác nhận',
                                    text: 'Bạn chắc chắn muốn xóa vai trò này chứ?',
                                    type: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Xóa!',
                                    cancelButtonText: 'Hủy'
                                }).then(function(result) {
                                    if (result.value) {
                                        $wire.delete({{ $role->id }})
                                    }
                                    swal.close();
                                });
                                ">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                @endcan
                            </td>
                        </tr>
                        @empty

                        @endforelse

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Tên hiển thị</th>
                            <th>Mô tả</th>
                            <th>Ngày tạo</th>
                            <th class="text-right">#</th>
                        </tr>
                    </tfoot>
                </table>

                <!--end: Datatable -->
                {{ $roles->links() }}
            </div>
        </div>
    </div>
</div>
