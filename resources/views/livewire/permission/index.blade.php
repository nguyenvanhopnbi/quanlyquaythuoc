<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col">
                <x-bootstrap.alert :active="session()->has('success')" :type="'success'">
                    <x-slot name="icon">
                        <i class="fas fa-check"></i>
                    </x-slot>
                    {{ session()->get('success') }}
                </x-bootstrap.alert>
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
                            @can('create', \App\Models\Permission::class)
                            <livewire:permission.create />
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
                            <th>Nhóm quyền</th>
                            <th>Ngày tạo</th>
                            <th class="text-right">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($permissions as $permission)
                        <tr wire:key="{{ $permission->id }}">
                            <td>{{ $permission->id }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->display_name }}</td>
                            <td>{{ $permission->description }}</td>
                            <td>{{ (isset($permission->id_group_permission))?$permission->id_group_permission:'' }}</td>
                            <td>{{ $permission->created_at }}</td>
                            <td class="text-right">
                                @can('update', $permission)
                                <button data-toggle="modal" data-target="#update-permission-modal"
                                    wire:click="$emit('edit', {{ $permission->id }})"
                                    class="btn btn-icon btn-primary btn-sm">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                @endcan
                                @can('delete', $permission)
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
                                            $wire.delete({{ $permission->id }})
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
                {{ $permissions->links() }}
            </div>
        </div>
    </div>
    <livewire:permission.edit />
</div>
