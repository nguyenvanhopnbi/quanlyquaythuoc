@extends('index')
@section('page-header', 'Bank vendor')
@section('page-sub-header', 'Danh sách bank vendor')
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
                    Danh sách bank vendor
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="dropdown dropdown-inline">
                        <a href="/gate-vendor/add" class="btn btn-brand btn-icon-sm"><i class="flaticon2-plus"></i> Thêm partner bank vendor</a>
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
                                        <label>Vendor code:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input type="text" class="form-control" name="vendor_code" value="{{ request()->input('vendor_code')}}">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Vendor name:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input type="text" class="form-control" name="vendor_name" value="{{ request()->input('vendor_name')}}">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Public:</label>
                                        <div class="kt-input-icon">
                                            <select type="text" class="form-control" name="public" value="{{ request()->input('public')}}">
                                                <option value="all" @if(request()->input('public') === 'all') selected @endif>All</option>
                                                <option value="yes" @if(request()->input('public') === 'yes') selected @endif>Yes</option>
                                                <option value="no" @if(request()->input('public') === 'no') selected @endif>No</option>
                                            </select>
                                        </span>
                                        </div>
                                    </div>


                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Payment method:</label>
                                        <div class="kt-input-icon">
                                            <select type="text" class="form-control" name="payment_method" value="{{ request()->input('payment_method')}}">
                                                <option value="all" @if(request()->input('payment_method') === 'all') selected @endif>All</option>
                                                <option value="ATM" @if(request()->input('payment_method') === 'ATM') selected @endif>ATM</option>
                                                <option value="CC" @if(request()->input('payment_method') === 'CC') selected @endif>CC</option>

                                                <option value="EWALLET" @if(request()->input('payment_method') === 'EWALLET') selected @endif>EWALLET</option>

                                                <option value="VA" @if(request()->input('payment_method') === 'VA') selected @endif>VA</option>

                                                <option value="Mobile Money" @if(request()->input('payment_method') === 'Mobile Money') selected @endif>Mobile Money</option>
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
@section('script')
    <!--begin::Page Vendors(used by this page) -->


    <!--end::Page Vendors -->
    <script src="assets/js/pages/crud/forms/widgets/select2.js" type="text/javascript" defer></script>
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript" defer></script>
    <script src="admin/js/pages/gate/bank-vendor/index.js" type="text/javascript" defer></script>
@endsection
