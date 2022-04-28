@extends('index')
@section('page-header', 'Quản lý Partner')
@section('page-sub-header', 'Danh sách lệnh chuyển tiền Partner')
@section('style')
    <style>

    </style>
@endsection
@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Danh sách lệnh chuyển tiền Partner
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
                                                   value="{{ request()->input('fd')}}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile form-group mb-0">
                                        <div class="form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Ngày kết thúc:</label>
                                            </div>
                                            <input type='text' class="form-control" id="kt_datepicker_2" name="td"
                                                   readonly placeholder="Chọn thời gian kết thúc" type="text"
                                                   value="{{ request()->input('td')}}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile form-group mb-0">
                                        <label>Loại tài khoản</label>
                                        <div class="kt-input-icon">
                                            <select type="text" class="form-control select2_default" name="bank_account_type"
                                                    value="{{ request()->input('bank_account_type')}}">
                                                @foreach($bankAccountTypes as $value => $text)
                                                    <option
                                                        value="{{$value}}" {{request()->input('bank_account_type') == $value ? 'selected' : ''}}>{{$text}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile form-group mb-0">
                                        <label>Trạng thái thanh toán</label>
                                        <div class="kt-input-icon">
                                            <select type="text" class="form-control select2_default" name="status">
                                                @foreach($statuses as $value => $status)
                                                    <option
                                                        value="{{$value}}" {{request()->input('status') == $value ? 'selected' : ''}}>{{$status}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile form-group mb-0">
                                        <label>Số tài khoản/Số thẻ</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input type="text" class="form-control" name="bank_account_no"
                                                   value="{{request()->input('bank_account_no')}}" placeholder="Số tài khoản/Số thẻ">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile form-group mb-0">
                                        <label>Tên tài khoản</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input type="text" class="form-control" name="bank_account_name"
                                                   value="{{request()->input('bank_account_name')}}"
                                                   placeholder="Tên tài khoản">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile form-group mb-0">
                                        <label>Mã ngân hàng</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input type="text" class="form-control" name="bank_code" value="{{request()->input('bank_code')}}"
                                                   placeholder="Mã ngân hàng">
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
                                            <button class="btn btn-success btn-export-flash-chart">Export</button>
                                            <a href="{{route('partner.bank-account.make.list')}}" class="btn btn-default float-right">Xoá bộ lọc</a>
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
    @include('partner.partials.modal_detail')
@endsection

@section('script')
    <script src="assets/js/pages/crud/forms/widgets/select2.js" type="text/javascript" defer></script>
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript" defer></script>
    <script src="/admin/js/pages/partner/partner-bank-account-transaction.js?v={{time()}}" type="text/javascript" defer></script>

@endsection
