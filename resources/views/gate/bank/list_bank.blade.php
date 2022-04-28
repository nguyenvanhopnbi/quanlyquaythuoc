@extends('index')
@section('page-header', 'Banks')
@section('page-sub-header', 'Danh sách bank')
@section('style')

<style>
    .enable_token{
        color:#FFF !important;
        width: auto !important;
        height: auto !important;
        border-radius: 2rem !important;
        font-size: .8rem !important;
        padding: .35rem .75rem !important;

    }
    .enable_tokenYES{
        background-color: #0abb87 !important;
    }
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
                    Danh sách bank
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="dropdown dropdown-inline">
                        <a href="/gate-bank/add" class="btn btn-brand btn-icon-sm"><i class="flaticon2-plus"></i> Thêm bank</a>
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
                                        <label>Bank code:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input type="text" class="form-control" name="bank_code" value="{{ request()->input('bank_code')}}">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Bank name:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input type="text" class="form-control" name="bank_name" value="{{ request()->input('bank_name')}}">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Vendor Code:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input type="text" class="form-control" name="vendor_code" value="{{ request()->input('vendor_code')}}">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Type:</label>
                                        <div class="kt-input-icon">
                                            <select type="text" class="form-control" name="type" value="{{ request()->input('type')}}">
                                            <option value="all" @if(request()->input('type') === 'all') selected @endif>All</option>
                                            <option value="atm" @if(request()->input('type') === 'atm') selected @endif>Atm</option>
                                            <option value="cc" @if(request()->input('type') === 'cc') selected @endif>cc</option>
                                            </select>
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
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript" defer></script>
    <script src="admin/js/pages/gate/bank/index.js" type="text/javascript" defer></script>
@endsection
