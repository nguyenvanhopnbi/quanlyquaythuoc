@extends('index')
@section('page-header', 'Dịch vụ cổng thanh toán')
@section('page-sub-header', 'Danh sách Tokens')
@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Danh sách Tokens
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="dropdown dropdown-inline">

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
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile form-group mb-0">
                                        <label
                                            class="form-label">Partner {{request()->input('partner_code') ? '['.request()->input('partner_code').']' : ''}}</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <select class="form-control" id="partnerCode" name="partner_code">
                                                @if(request()->input('partner_code'))
                                                    <option value="{{request()->input('partner_code')}}">{{request()->input('partner_code')}}</option>
                                                @else
                                                    <option value=""></option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile form-group mb-0">
                                        <div class="form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Ngày bắt đầu:</label>
                                            </div>
                                            <input type='text' class="form-control" id="kt_datepicker_1" name="fd"
                                                   readonly placeholder="Chọn thời gian bắt đầu" type="text"
                                                   value="{{$filter['fd']}}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile form-group mb-0">
                                        <div class="form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Ngày kết thúc:</label>
                                            </div>
                                            <input type='text' class="form-control" id="kt_datepicker_2" name="td"
                                                   readonly placeholder="Chọn thời gian kết thúc" type="text"
                                                   value="{{$filter['td']}}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile form-group mb-0">
                                        <label>Status</label>
                                        <div class="kt-input-icon">
                                            <select
                                            id="status"
                                            type="text" class="form-control select2_default" name="status">
                                                @foreach($statuses as $value => $status)
                                                    <option
                                                        value="{{$value}}" {{request()->input('status') == $value ? 'selected' : ''}}>{{$status}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile form-group mb-0">
                                        <label>Status 3ds</label>
                                        <div class="kt-input-icon">
                                            <select
                                            id="status_3ds"
                                            type="text" class="form-control select2_default" name="status_3ds">
                                                @foreach($statuses3ds as $value => $status)
                                                    <option
                                                        value="{{$value}}" {{request()->input('status_3ds') == $value ? 'selected' : ''}}>{{$status}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile form-group mb-0">
                                        <label>Card number</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input
                                            id="card_number"
                                            type="text" class="form-control" name="card_number"
                                                   value="{{request()->input('card_number')}}" placeholder="Card number">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile form-group mb-0">
                                        <label>Card name</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input
                                            id="card_name"
                                            type="text" class="form-control" name="card_name"
                                                   value="{{request()->input('card_name')}}"
                                                   placeholder="Card name">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile form-group mb-0">
                                        <label>Bank code</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input
                                            id="bank_code"
                                            type="text" class="form-control" name="bank_code" value="{{request()->input('bank_code')}}"
                                                   placeholder="Bank code">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile form-group mb-0">
                                        <label>Card type</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input
                                            id="card_type"
                                            type="text" class="form-control" name="card_type" value="{{request()->input('card_type')}}"
                                                   placeholder="Card type">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile form-group mb-0">
                                        <label>Vendor code</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input
                                            id="vendor_code"
                                            type="text" class="form-control" name="vendor_code" value="{{request()->input('vendor_code')}}"
                                                   placeholder="Vendor code">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>

                                    <div class="col-md-12 kt-margin-b-20-tablet-and-mobile form-group mb-0">
                                        <div class="form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>&nbsp;</label>
                                            </div>
                                            <button class="btn btn-primary" method="submit">Tìm Kiếm</button>
                                            {{-- <button class="btn btn-success btn-export-flash-chart">Export</button> --}}

                                            <a onclick="exportCSVBankVendorTokenScript()"
                                            class="btn btn-success text-white">Export</a>

                                            <a href="{{route('gate.bank_vendor.token.list')}}" class="btn btn-default float-right">Xoá bộ lọc</a>
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
        @include('elements.alert_flash')
        <!--begin: Datatable -->
            <div class="kt-datatable" id="ajax_data"></div>

            <!--end: Datatable -->
        </div>

    </div>
    @include('gate.bank-vendor-token.partials.bank_vendor_token_modal_detail')
@endsection

@section('script')
    <script src="assets/js/pages/crud/forms/widgets/select2.js" type="text/javascript" defer></script>
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript" defer></script>
    <script src="/admin/js/pages/gate/bank-vendor/bank-vendor-token-list.js?v={{time()}}" type="text/javascript" defer></script>
    <script>
        function exportCSVBankVendorTokenScript() {
            var partnerCode = document.getElementById('partnerCode').value;
            var startTime = document.getElementById('kt_datepicker_1').value;
            var endTime = document.getElementById('kt_datepicker_2').value;
            var status = document.getElementById('status').value;
            var status_3ds = document.getElementById('status_3ds').value;
            var card_number = document.getElementById('card_number').value;
            var card_name = document.getElementById('card_name').value;
            var bank_code = document.getElementById('bank_code').value;
            var card_type = document.getElementById('card_type').value;
            var vendor_code = document.getElementById('vendor_code').value;

            var protocol = window.location.protocol;
                var host = window.location.host;
                var url = protocol + '//' + host + '/';

            window.open(url + 'gate-vendor-token-list-export?partnerCode='+ partnerCode
                +'&status='+status
                +'&status_3ds='+status_3ds
                +'&card_number='+card_number
                +'&card_name='+card_name
                +'&startTime='+startTime
                +'&endTime='+endTime
                +'&bank_code='+bank_code
                +'&card_type='+card_type
                +'&vendor_code='+vendor_code
                );
        }
    </script>
@endsection
