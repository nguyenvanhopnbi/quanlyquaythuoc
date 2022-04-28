<div>
    {{-- In work, do what you enjoy. --}}
    <div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon2-line-chart"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                Danh sách gạch thẻ AC
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
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
                                    <label>Transaction id:</label>
                                    <div class="kt-input-icon">
                                        <input type="text" class="form-control"
                                        id="transaction_id"
                                        name="transaction_id"
                                            value="{{ request()->input('transaction_id')}}">
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <label>Partner transaction id:</label>
                                    <div class="kt-input-icon">
                                        <input type="text" class="form-control"
                                        id="partner_transaction_id"
                                        name="partner_transaction_id"
                                            value="{{ request()->input('partner_transaction_id')}}">
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <label>Partner code:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <select type="text" class="form-control" id="partner_code"
                                            name="partner_code"></select>
                                        </span>
                                    </div>
                                </div>
                                <!-- <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Application id:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input type="text" class="form-control" name="application_id" value="{{ request()->input('application_id')}}">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div> -->
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <label>Amount:</label>
                                    <div class="kt-input-icon">
                                        <input type="text" class="form-control"
                                        id="amount"
                                        name="amount"
                                            value="{{ request()->input('amount')}}">
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <label>Status:</label>
                                    <div class="kt-input-icon ">
                                        <select type="text" class="form-control"
                                        id="status"
                                        name="status">
                                            <option value="all" @if(request()->input('status') === 'all')
                                                selected="true" @endif>All</option>
                                            <option value="pending" @if(request()->input('status') === 'pending')
                                                selected="true" @endif>pending</option>
                                            <option value="success" @if(request()->input('status') === 'success')
                                                selected="true" @endif>success</option>
                                            <option value="error" @if(request()->input('status') === 'error')
                                                selected="true" @endif>error</option>
                                        </select>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <div class="form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>Ngày bắt đầu:</label>
                                        </div>
                                        <input type='text' class="form-control" id="kt_datepicker_1" name="startTime"
                                            readonly placeholder="Chọn thời gian bắt đầu" type="text"
                                            value="{{ request()->input('startTime')}}" />
                                    </div>
                                </div>

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <div class="form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>Ngày kết thúc:</label>
                                        </div>
                                        <input type='text' class="form-control" id="kt_datepicker_2" name="endTime"
                                            readonly placeholder="Chọn thời gian kết thúc" type="text"
                                            value="{{ request()->input('endTime')}}" />
                                    </div>
                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <label>Card code:</label>
                                    <div class="kt-input-icon">
                                        <input type="text" class="form-control"
                                        id="code"
                                        name="code"
                                            value="{{ request()->input('code')}}">
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <label>Card serial:</label>
                                    <div class="kt-input-icon">
                                        <input type="text" class="form-control"
                                        id="serial"
                                        name="serial"
                                            value="{{ request()->input('serial')}}">
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <div class="form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>&nbsp;</label>
                                        </div>
                                        <button class="btn btn-primary" method="submit">Tìm Kiếm</button>
                                        {{-- <button id="exportTransaction" class="btn btn-success"
                                            method="submit">Export</button> --}}
                                            <a wire:click.prevent="$emit('ExportChargingCSVScript')" class="btn btn-success text-white">Export</a>
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
        Livewire.on('ExportChargingCSVScript', ()=>{
            var transaction_id = document.getElementById('transaction_id').value;
            var partner_transaction_id = document.getElementById('partner_transaction_id').value;
            var partner_code = document.getElementById('partner_code').value;
            var amount = document.getElementById('amount').value;
            var status = document.getElementById('status').value;
            var startTime = document.getElementById('kt_datepicker_1').value;
            var endTime = document.getElementById('kt_datepicker_2').value;
            var code = document.getElementById('code').value;
            var serial = document.getElementById('serial').value;

            var protocol = window.location.protocol;
                var host = window.location.host;
                var url = protocol + '//' + host + '/';

            window.open(url + 'charging-card-transactions-export?transaction_id='+ transaction_id
                +'&partner_transaction_id='+partner_transaction_id
                +'&partner_code='+partner_code
                +'&amount='+amount
                +'&status='+status
                +'&startTime='+startTime
                +'&endTime='+endTime
                +'&code='+code
                +'&serial='+serial
                );
        })
    </script>
@endpush
