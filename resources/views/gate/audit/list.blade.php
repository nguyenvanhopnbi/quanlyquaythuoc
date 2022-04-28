@extends('index')
@section('page-header', 'Đối soát')
@section('page-sub-header', 'Danh sách đối soát')
@section('style')

@endsection
@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Đối soát
                </h3>
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
                                        <label>Partner code:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <select type="text" class="form-control" name="partner_code"  id="partner_code">
                                                <option></option>
                                            </select>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Bank code:</label>
                                        <div class="kt-input-icon">
                                            <select type="text" class="form-control" name="bank_code" id="bank_code">
                                            <option></option>
                                            </select>
                                        </span>
                                        </div>
                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <div class="form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Ngày bắt đầu (Tháng/ngày/năm):</label>
                                            </div>
                                            <input type='text' class="form-control" id="kt_datepicker_1" name="startTime" readonly placeholder="Chọn thời gian bắt đầu" type="text" value="@if(request()->input('startTime')) {{request()->input('startTime')}}@else{{date('01/01/Y')}} @endif"/>
                                        </div>
                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <div class="form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Ngày kết thúc (Tháng/ngày/năm):</label>
                                            </div>
                                            <input type='text' class="form-control" id="kt_datepicker_2" name="endTime" readonly placeholder="Chọn thời gian kết thúc" type="text" value="@if(request()->input('endTime')) {{request()->input('endTime')}}@else{{date('m/d/Y')}} @endif" />
                                        </div>
                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                        <label>Payment method:</label>
                                        <div class="kt-input-icon">
                                            <select type="text" class="form-control" name="payment_method" id="payment_method">
                                            <option value="all"@if(request()->input('payment_method') === 'all') selected="true" @endif >All</option>
                                            <option value="ATM" @if(request()->input('payment_method') === 'ATM') selected="true" @endif>ATM</option>
                                            <option value="CC" @if(request()->input('payment_method') === 'CC') selected="true" @endif>CC</option>
                                            </select>
                                        </span>
                                        </div>
                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                        <div class="form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>&nbsp;</label>
                                            </div>
                                            <button class="btn btn-primary btn-filter" method="submit">Tìm Kiếm</button>
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
@endsection
<script>
    var partnerCode = "{{ request()->input('partner_code')}}";
    var bankCode = "{{ request()->input('bank_code') }}";
</script>
@section('script')
    <!--begin::Page Vendors(used by this page) -->


    <!--end::Page Vendors -->
    <script src="assets/js/pages/crud/forms/widgets/select2.js" type="text/javascript" defer></script>
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript" defer></script>
    <script src="admin/js/pages/gate/audit/index.js" type="text/javascript" defer></script>
@endsection
