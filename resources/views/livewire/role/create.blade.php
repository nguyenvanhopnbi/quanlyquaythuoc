<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Tạo mới vai trò
                </h3>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="{{ route('roles.index') }}" class="btn btn-default btn-bold">
                    {{ __('Back') }}
                </a>
            </div>
        </div>
    </div>

    <!-- end:: Content Head -->

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <!--Begin:: Portlet-->
        <div class="kt-portlet kt-portlet--tabs">
            <div class="kt-portlet__body">
                <form class="kt-margin-t-20" wire:submit.prevent="save">
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
                                        <div class="col-12">
                                            <div class="row">
                                                <label class="col-xl-3"></label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <h3 class="kt-section__title kt-section__title-sm">Thông tin chung:
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Tên</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control" type="text"
                                                        wire:model.debounce.500ms="role.name">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Tên hiển thị</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control" type="text"
                                                        wire:model.debounce.500ms="role.display_name">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Mô tả</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control" type="text"
                                                        wire:model.debounce.500ms="role.description">
                                                </div>
                                            </div>

                                            {{-- <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Nhóm quyền</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control" type="text"
                                                        wire:model.debounce.500ms="role.ID_group_permission">
                                                </div>
                                            </div> --}}

                                        </div>
                                    </div>
                                    <div
                                        class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-9 col-xl-6">
                                            <h3 class="kt-section__title kt-section__title-sm">
                                                Các tài khoản sở hữu vai trò này:
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            @foreach ($permissions ?? [] as $groupName => $groupItem)
                                            <div>
                                                <div class="row">
                                                    <label class="col-sm-1 col-md-1 col-xl-2 col-lg-2"></label>
                                                    <div class="col-lg-10 col-xl-10">
                                                        <h3 class="kt-section__title kt-section__title-sm">
                                                            <!-- TODO: add group checkbox -->
                                                            @php
                                                            $groupSelectedCount = collect($groupItem)
                                                            ->pluck('id')->intersect($this->assignedValue)->count();
                                                            $groupCheckboxIcon = [
                                                            $groupSelectedCount === collect($groupItem)->count() => 'far
                                                            fa-check-square',
                                                            $groupSelectedCount === 0 => 'far fa-square',
                                                            ][true] ?? 'far fa-minus-square';
                                                            @endphp
                                                            <p role="button" class="kt-font-brand"
                                                                wire:click.prevent="groupSelect({{ collect($groupItem) }})">
                                                                <i class="{{ $groupCheckboxIcon }}"
                                                                    style="font-size: 1.5rem"></i>
                                                                &nbsp;Chọn tất cả
                                                            </p>
                                                        </h3>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-last row">
                                                    <label
                                                        class="col-sm-1 col-md-1 col-xl-2 col-lg-2 col-form-label pr-5">
                                                        {{ Str::ucfirst($groupName) }}
                                                    </label>
                                                    <div class="col-10">
                                                        @foreach($groupItem ?? [] as $item)
                                                        <label
                                                            class="kt-checkbox kt-checkbox--brand col-sm-6 col-md-4 col-lg-3">
                                                            <input wire:model="assignedPermissions.{{ $item['id'] }}"
                                                                value="{{ intval($item['id']) }}" type="checkbox">
                                                            {{ $item['display_name'] }}
                                                            <span></span>
                                                        </label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            @if (!$loop->last)
                                            <div
                                                class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg">
                                            </div>
                                            @endif
                                            @endforeach
                                            <div
                                                class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid">
                                            </div>
                                            <div class="kt-form__actions">
                                                <div class="row">
                                                    <div class="col-xl-2"></div>
                                                    <div class="col-lg-10 col-xl-10">
                                                        <button type="submit" class="btn btn-brand btn-bold">{{ __('Save') }}</button>
                                                        <x-custom.action-message on="saved" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!--End:: Portlet-->
    </div>

    <!-- end:: Content -->
</div>
