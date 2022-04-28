<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon2-line-chart"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                Danh sách giao dịch
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="dropdown dropdown-inline" style="display: none;">
                    <a href="" class="btn btn-brand btn-icon-sm"><i class="flaticon2-plus"></i> add new</a>
                </div>
            </div>
        </div>
    </div>
    <div class="kt-portlet__body">

        <!--begin: Search Form -->
        <form class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10" method="GET">
            <div class="row align-items-center">
                <div class="col-xl-12 order-2 order-xl-1">
                    <div class="row align-items-center">
                        <div class="col-xl-12 order-2 order-xl-1">
                            <div class="row align-items-center">

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <label>Mã Giao Dịch:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input type="text" class="form-control" name="query[transaction_id]" id="query[transaction_id]" value="{{ request()->input('query.transaction_id')}}">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <label>Mã Giao Dịch Đối Tác:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input type="text" class="form-control" name="query[partner_ref_id]" id="query[partner_ref_id]" value="{{ request()->input('query.partner_ref_id')}}">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <div class="form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>Ngày bắt đầu:</label>
                                        </div>
                                        <input value="{{ request()->input('query.startTime')}}" type='text' class="form-control" id="kt_datepicker_1" name="query[startTime]" readonly placeholder="Chọn thời gian bắt đầu" type="text" />
                                    </div>
                                </div>

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <div class="form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>Ngày kết thúc:</label>
                                        </div>
                                        <input value="{{ request()->input('query.endTime')}}" type='text' class="form-control" id="kt_datepicker_2" name="query[endTime]" readonly placeholder="Chọn thời gian kết thúc" type="text" />
                                    </div>
                                </div>

                            </div>
                            <br>
                            <div class="row align-items-center">
                                <div wire:ignore class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <label>Mã Giao Dịch Đối Tác:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <select wire:ignore type="text" class="form-control" name="query[partner_code]" id="partner_code" value="{{ request()->input('query.partner_code')}}">
                                            <option wire:ignore></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <label>Trạng Thái:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <select class="form-control" name="query[status]" id="status">
                                            <option value="">Tất cả</option>
                                            <option value="success"  {{ request()->input('query.status') && request()->input('query.status') === 'success' ? 'selected' : ''}}>Success</option>
                                            <option value="error" {{ request()->input('query.status') &&  request()->input('query.status') === 'error' ? 'selected' : ''}}>Error</option>
                                            <option value="pending" {{ request()->input('query.status') &&  request()->input('query.status') === 'pending' ? 'selected' : ''}}>Pending</option>
                                            <option value="refund" {{ request()->input('query.status') &&  request()->input('query.status') === 'refund' ? 'selected' : ''}}>Refund</option>
                                        </select>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <div class="form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>&nbsp;</label>
                                        </div>
                                        <button class="btn btn-primary" method="submit">Tìm Kiếm</button>
                                        <button wire:click.prevent="$emit('exportCsvScript')" class="btn btn-primary">Export</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="kt-portlet__body kt-portlet__body--fit">
        <div class="row">
            <div class="col-12 d-flex justify-content-end pr-5">
                <h5>Total amount:&nbsp;<span class="text-monospace field-total-amount">0</span></h5>
            </div>
        </div>
        @include('elements.alert_flash')
        <!--begin: Datatable -->
        <div class="kt-datatable" id="ajax_data"></div>

        <!--end: Datatable -->
    </div>
</div>
</div>

@push('scriptsChart')

    <script>
        Livewire.on('exportCsvScript', ()=>{
            var transaction_id = document.getElementById('query[transaction_id]').value;
            var partner_ref_id = document.getElementById('query[partner_ref_id]').value;
            var startTime = document.getElementById('kt_datepicker_1').value;
            var endTime = document.getElementById('kt_datepicker_2').value;
            var partner_code = document.getElementById('partner_code').value;
            var status = document.getElementById('status').value;

            var protocol = window.location.protocol;
            var host = window.location.host;
            var url = protocol + '//' + host + '/';
            window.open(url + 'bill-transaction-export?transaction_id='+ transaction_id
                + '&partner_ref_id=' +partner_ref_id
                + '&startTime=' +startTime
                + '&endTime=' +endTime
                + '&partner_code=' +partner_code
                + '&status=' +status

                );
        });
    </script>

@endpush
