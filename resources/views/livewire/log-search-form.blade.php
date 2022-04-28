<div>
    <!--begin: Search Form -->

        <form action="/shopcard-card-auto-import-logs-card-search" class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10" method="GET">
            <div class="row align-items-center">
                <div class="col-xl-12 order-2 order-xl-1">
                    <div class="row align-items-center">
                        <div class="col-xl-12 order-2 order-xl-1">
                            <div class="row align-items-center">
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <label>Value:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input id="LogsValues" type="text" class="form-control" name="value" value="{{ request()->input('value') }}">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>

                                </div>

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <label>Provider Name:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input id="LogsProviderName" type="text" class="form-control" name="provider"
                                            value="{{ request()->input('provider') }}">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>

                                </div>

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <label>Method:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input id="LogsMethod" type="text" class="form-control" name="method" wire:model.defer="filter.method"
                                            value="{{ request()->input('method') }}">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>

                                </div>


                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <label>Status:</label>
                                    <div class="kt-input-icon">
                                        <select id="LogsStatus" type="text" class="form-control" name="status"
                                            value="{{ request()->input('status') }}">
                                            <option value="all" @if (request()->input('status') === 'all') selected
                                                @endif>All</option>
                                            <option value="pending" @if (request()->input('status') === 'pending')
                                                selected @endif>Pending</option>
                                            <option value="success" @if (request()->input('status') === 'success')
                                                selected @endif>Success</option>
                                            <option value="error" @if (request()->input('status') === 'error') selected
                                                @endif>Error</option>
                                            <option value="processing" @if (request()->input('status') === 'processing')
                                                selected @endif>Processing</option>
                                            <option value="refund" @if (request()->input('status') === 'refund')
                                                selected @endif>Refund</option>
                                            <option value="cancelled" @if (request()->input('status') === 'cancelled')
                                                selected @endif>Canceled</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <div class="form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>Ngày bắt đầu:</label>
                                        </div>
                                        <x-widget.flatpickr
                                        name="startTime"
                                        value="{{request()->input('startTime') }}"
                                        id="LogsStartTime"
                                        class="form-control"
                                        readonly placeholder="Chọn thời gian bắt đầu" />
                                    </div>
                                </div>

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <div class="form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>Ngày kết thúc:</label>
                                        </div>
                                        <x-widget.flatpickr
                                        name="endTime"
                                        value="{{request()->input('endTime') }}"
                                        id="LogsendTime"
                                        class="form-control"
                                        readonly placeholder="Chọn thời gian kết thúc" />

                                    </div>
                                </div>

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <div class="form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>Vendor:</label>
                                        </div>
                                        <input id="LogsVender" type="text" class="form-control" name="vendor" value="{{ request()->input('vendor') }}">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                    </div>
                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <div class="form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>&nbsp;</label>
                                        </div>
                                        <button class="btn btn-primary" method="submit">
                                        Tìm Kiếm
                                        </button>
                                        {{-- <button class="btn btn-success" type="button" wire:click.prevent="export" wire:loading.attr="disabled"
                                                wire:loading.class="kt-spinner kt-spinner--right kt-spinner--md kt-spinner--light">
                                            Export
                                        </button> --}}
                                        <a wire:click.prevent="$emit('exportLogImportCardScript')" class="btn btn-success" style="color: #FFFFFF">Export</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        {{-- End Form Search --}}
</div>
