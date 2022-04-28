@extends('index')
@section('page-header', 'Application')
@section('page-sub-header', 'Danh sách application')
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
                    Danh sách application
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="dropdown dropdown-inline">
                        <a href="/partner-applications/add" class="btn btn-brand btn-icon-sm"><i class="flaticon2-plus"></i> Thêm application</a>
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
                                        <label>Partner code:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <select type="text" class="form-control" name="partner_code"  id="partner_code">
                                                <option></option>
                                            </select>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Name/Id:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input type="text" class="form-control" name="name" value="{{ request()->input('name')}}">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Api key:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input type="text" class="form-control" name="api_key" value="{{ request()->input('api_key')}}">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Status:</label>
                                        <div class="kt-input-icon ">
                                            <select class="form-control" name="status" value="{{ request()->input('status')}}">
                                                <option value="all" @if(request()->input('status') === 'all') selected @endif>All</option>
                                                <option value="active" @if(request()->input('status') === 'active') selected @endif>Active</option>
                                                <option value="inactive" @if(request()->input('status') === 'inactive') selected @endif>Inactive</option>
                                                <option value="blocked" @if(request()->input('status') === 'blocked') selected @endif>Blocked</option>
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
<script>
    var partnerCode = "{{ request()->input('partner_code')}}";
</script>
@section('script')
    <!--begin::Page Vendors(used by this page) -->


    <!--end::Page Vendors -->
    <script src="assets/js/pages/crud/forms/widgets/select2.js" type="text/javascript" defer></script>
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript" defer></script>
    <script src="admin/js/pages/gate/application/gate_application.js" type="text/javascript" defer></script>
@endsection
