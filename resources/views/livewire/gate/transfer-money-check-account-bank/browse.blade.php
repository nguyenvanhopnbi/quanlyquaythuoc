<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon2-line-chart"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                Tìm kiếm tài khoản
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
            </div>
        </div>
    </div>
    <div class="kt-portlet__body">
        <!--begin: Search Form -->
        <form class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10 mx-auto">
            <div class="row align-items-center">
                <div class="col-xl-12 order-2 order-xl-1">
                    <div class="row align-items-center">
                        <div class="col-md-12 kt-margin-b-20-tablet-and-mobile mt-2">
                            <label>Bank Code:</label>
                            <div class="kt-input-icon kt-input-icon--left">
                                <input type="text" class="form-control" wire:model.defer="bankCode">
                                <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                    <span><i class="la la-search"></i></span>
                                </span>
                            </div>
                            @error('bankCode')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 kt-margin-b-20-tablet-and-mobile mt-2">
                            <label>Account No:</label>
                            <div class="kt-input-icon kt-input-icon--left">
                                <input type="text" class="form-control" wire:model.defer="accountNo">
                                <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                    <span><i class="la la-search"></i></span>
                                </span>
                            </div>
                            @error('accountNo')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 kt-margin-b-20-tablet-and-mobile mt-2">
                            <label>Account Type:</label>
                            <div class="kt-input-icon kt-input-icon--left">
                                <select class="form-control" wire:model.defer="accountType">
                                    <option value="account">Account</option>
                                    <option value="card">Card</option>
                                </select>
                                <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                    <span><i class="la la-search"></i></span>
                                </span>
                            </div>
                            @error('accountType')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 kt-margin-b-20-tablet-and-mobile mt-2">
                            <label>Account Name:</label>
                            <div class="kt-input-icon kt-input-icon--left">
                                <input type="text" class="form-control" wire:model.defer="accountType">
                                <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                    <span><i class="la la-search"></i></span>
                                </span>
                            </div>
                            @error('accountType')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-12 kt-margin-b-20-tablet-and-mobile mt-2">
                            <button type="button" class="btn btn-primary mt-4" wire:click.prevent="search"
                                wire:loading.attr="disabled">
                                Tìm kiếm
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
            x-data="{
            'open': @entangle('showingModal'),
            'account': @entangle('account')
        }" x-init="
            $watch('open', value => {
                if (value) $($el).modal('show')
                else $($el).modal('hide')
            })
            $($el).on('hidden.bs.modal', function (e) {
                open = false
            })
        ">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <template x-if="!account">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <b>Không tìm thấy</b>
                                </div>
                            </div>
                        </template>
                        <template x-if="account">
                            <div class="row">
                                <div class="col-8">
                                    <label>Account Name:</label>
                                    <b x-text="account.accountName"></b>
                                </div>
                                <div class="col-8">
                                    <label>Account No:</label>
                                    <b x-text="account.accountNo"></b>
                                </div>
                                <div class="col-8">
                                    <label>Account Type:</label>
                                    <b x-text="account.accountType"></b>
                                </div>
                                <div class="col-8">
                                    <label>Bank Code:</label>
                                    <b x-text="account.bankCode"></b>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>