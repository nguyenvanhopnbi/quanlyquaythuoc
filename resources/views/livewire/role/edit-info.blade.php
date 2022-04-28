<form class="kt-form kt-form--label-right" wire:submit.prevent="save">
    <div class="kt-form__body">
        <div class="kt-section kt-section--first">
            <div class="kt-section__body">
                <div class="row">
                    <label class="col-xl-3"></label>
                    <div class="col-lg-9 col-xl-6">
                        <h3 class="kt-section__title kt-section__title-sm">Thông tin chung:</h3>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Tên</label>
                    <div class="col-lg-9 col-xl-6">
                        <input class="form-control" type="text" wire:model.debounce.500ms="role.name">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Tên hiển thị</label>
                    <div class="col-lg-9 col-xl-6">
                        <input class="form-control" type="text" wire:model.debounce.500ms="role.display_name">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Mô tả</label>
                    <div class="col-lg-9 col-xl-6">
                        <input class="form-control" type="text" wire:model.debounce.500ms="role.description">
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
        </div>
    </div>
</form>
