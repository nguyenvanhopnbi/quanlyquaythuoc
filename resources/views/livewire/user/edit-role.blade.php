<form class="kt-form kt-form--label-right" wire:submit.prevent="save">
    <div class="kt-form__body">
        <div class="kt-section kt-section--first">
            <div class="kt-section__body">
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Vai trò</label>
                    <div class="col-lg-9 col-xl-6" wire:ignore>
                        <x-widget.select2 class="form-control" multiple="multiple" wire:model="assignedRoles"
                            data-close-on-select="false">
                            @foreach ($roles as $item)
                            <option value="{{ $item->id }}">{{ $item->display_name }}</option>
                            @endforeach
                        </x-widget.select2>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg">
        </div>
        <div class="kt-section kt-section--first">
            <div class="kt-section__body">
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">
                        Quyền hạn
                    </label>
                    <div class="col-lg-9 col-xl-6">

                        <ul>
                            @foreach ($this->userPermissions as $item)
                            <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>
        <div class="kt-form__actions">
            <div class="row">
                <div class="col-xl-3"></div>
                <div class="col-lg-9 col-xl-6">
                    <button class="btn btn-brand btn-bold">{{ __('Save') }}</button>
                    <x-custom.action-message on="saved" />
                </div>
            </div>
        </div>
    </div>
</form>
