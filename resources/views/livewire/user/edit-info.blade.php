<form class="kt-form kt-form--label-right" wire:submit.prevent="save">
    <div class="kt-form__body">
        <div class="kt-section kt-section--first">
            <div class="kt-section__body">
                <div class="row">
                    <label class="col-xl-3"></label>
                    <div class="col-lg-9 col-xl-6">
                        <h3 class="kt-section__title kt-section__title-sm">
                        </h3>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Avatar</label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="kt-avatar kt-avatar--outline kt-avatar--circle-" id="kt_user_edit_avatar">
                            <div class="kt-avatar__holder" style="background-image: url('{{ $user->avatar_url }}');"></div>
                        </div>

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Tên</label>
                    <div class="col-lg-9 col-xl-6">
                        <input class="form-control" type="text" wire:model="user.name">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Email</label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i
                                        class="la la-at"></i></span>
                            </div>
                            <input type="text" class="form-control" value="{{ $user->email }}" readonly
                                placeholder="Email" aria-describedby="basic-addon1">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">SĐT</label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i
                                        class="la la-phone"></i></span>
                            </div>
                            <input type="text" class="form-control" wire:model="user.phone" placeholder="SĐT"
                                aria-describedby="basic-addon1">
                        </div>
                    </div>
                </div>

                <div class="form-group form-group-sm row">
                    <label class="col-xl-3 col-lg-3 col-form-label">
                        Khả dụng
                    </label>
                    <div class="col-lg-9 col-xl-6">
                        <span class="kt-switch">
                            <label>
                                <input type="checkbox" checked="checked" wire:model="user.is_active">
                                <span></span>
                            </label>
                        </span>
                    </div>
                </div>
                <div class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-xl-3"></div>
                        <div class="col-lg-9 col-xl-6">
                            <button class="btn btn-brand btn-bold">{{ __('Save') }}</button>
                            <x-custom.action-message on="user-updated" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
