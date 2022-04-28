@extends('index')
@section('page-header', 'Quản lý hệ thống')
@section('page-sub-header', 'Tool chuyển tiền')
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
                    Danh sách giao dịch chuyển tiền
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
                                    @if($filter['log_id'])
                                        <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                            <label>Log ID: {{$filter['log_id']}}</label>
                                        </div>
                                    @else
                                        <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                            <div class="form__group kt-form__group--inline">
                                                <div class="kt-form__label">
                                                    <label>Ngày bắt đầu:</label>
                                                </div>
                                                <input type='text' class="form-control" id="kt_datepicker_1" name="startTime"
                                                       readonly placeholder="Chọn thời gian bắt đầu" type="text"
                                                       value="{{ request()->input('startTime')}}"/>
                                            </div>
                                        </div>
                                        <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                            <div class="form__group kt-form__group--inline">
                                                <div class="kt-form__label">
                                                    <label>Ngày kết thúc:</label>
                                                </div>
                                                <input type='text' class="form-control" id="kt_datepicker_2" name="endTime"
                                                       readonly placeholder="Chọn thời gian kết thúc" type="text"
                                                       value="{{ request()->input('endTime')}}"/>
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
                                    @endif
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
    <script src="assets/js/pages/crud/forms/widgets/select2.js" type="text/javascript" defer></script>
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript" defer></script>
    <script src="/admin/js/pages/system/transfer/transfer-transaction.js?v={{time()}}" type="text/javascript" defer></script>

@endsection
