<div class="kt-form kt-form--label-right">
    <div class="kt-form__body">
        <div class="kt-section">
            <div class="kt-section__body">
                <div class="row">
                    <div class="col-lg-9 col-xl-6">
                        <h3 class="kt-section__title kt-section__title-sm">
                            Các tài khoản sở hữu vai trò này:
                        </h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_1">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Vai trò</th>
                                    <th class="text-right">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->roles->pluck('display_name')->implode(', ') }}
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ route('users.edit', $user->id) }}"
                                            class="btn btn-icon btn-primary btn-sm">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <button class="btn btn-icon btn-danger btn-sm" type="button" x-data>
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty

                                @endforelse

                            </tbody>
                        </table>

                        <!--end: Datatable -->
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
