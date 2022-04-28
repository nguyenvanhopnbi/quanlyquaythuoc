@extends('index')
@section('page-header', 'Cấu hình mệnh giá topup')
@section('page-sub-header', 'Cấu hình mệnh giá topup')
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
                    Danh sách cấu hình mệnh giá topup
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="dropdown dropdown-inline">
                        <a href="/topup-denomination/add" class="btn btn-brand btn-icon-sm"><i class="flaticon2-plus"></i> Thêm cấu hình mệnh giá topup </a>
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
                                        <label>Telco:</label>
                                        <div class="kt-input-icon">
                                            <select class="form-control" name="telco" value="{{ request()->input('telco')}}">
                                            <option value="all" @if(request()->input('telco') === 'all') selected @endif>All</option>
                                            <option value="viettel" @if(request()->input('telco') === 'viettel') selected @endif>Viettel</option>
                                            <option value="mobifone"  @if(request()->input('telco') === 'mobifone') selected @endif>Mobifone</option>
                                            <option value="vinaphone"  @if(request()->input('telco') === 'vinaphone') selected @endif>Vinaphone</option>
                                            <option value="beeline"  @if(request()->input('telco') === 'beeline') selected @endif>Beeline</option>
                                            <option value="vnmobile"  @if(request()->input('telco') === 'vnmobile') selected @endif>VNMobile</option>
                                            <option value="viettel_data"  @if(request()->input('telco') === 'viettel_data') selected @endif>Viettel Data</option>
                                            <option value="mobifone_data"  @if(request()->input('telco') === 'mobifone_data') selected @endif>Mobifone Data</option>
                                            <option value="vinaphone_data"  @if(request()->input('telco') === 'vinaphone_data') selected @endif> Vinaphone Data </option>
                                            <option value="vnmobile_data" @if(request()->input('telco') === 'vnmobile_data') selected @endif>VNMobile Data</option>
                                            <option value="beeline_data"  @if(request()->input('telco') === 'beeline_data') selected @endif>Beeline Data</option>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Mệnh giá:</label>
                                        <div class="kt-input-icon">
                                            <input type="text" class="form-control" name="value" value="{{ request()->input('value')}}">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Public:</label>
                                        <div class="kt-input-icon">
                                            <select class="form-control" name="public">
                                            <option value="all" @if(request()->input('public') === 'all') selected @endif>All</option>
                                            <option value="yes" @if(request()->input('public') === 'yes') selected @endif>Yes</option>
                                            <option value="no"  @if(request()->input('public') === 'no') selected @endif>No</option>
                                        </select>
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
    <script src="admin/js/pages/gate/topup-denomination/index.js" type="text/javascript" defer></script>
@endsection
