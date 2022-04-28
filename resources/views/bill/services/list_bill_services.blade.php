@extends('index')
@section('page-header', 'Bill Services')
@section('page-sub-header', 'Danh sách Bill Services')
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
                Danh sách dịch vụ
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="dropdown dropdown-inline">
                    <a href="{{route('bill.service.add')}}" class="btn btn-brand btn-icon-sm"><i class="flaticon2-plus"></i> Thêm Bill Service</a>
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
                                    <label>Mã dịch vụ:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input type="text" class="form-control" name="query[serviceCode]" value="{{ request()->input('query.serviceCode')}}">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <label>Tên dịch vụ:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input type="text" class="form-control" name="query[serviceName]" value="{{ request()->input('query.serviceName')}}">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <label>Mã danh mục:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <select class="form-control" name="query[categoryCode]" id="query[categoryCode]">
                                            <option value="">Tất cả</option>
                                                @forelse ($data['listAllCategory'] as $category)
                                                    <option value="{{ $category->categoryCode }}"  {{ request()->input('query.categoryCode') && request()->input('query.categoryCode') === $category->categoryCode ? 'selected' : '' }}>{{ $category->categoryName }}</option>
                                                @empty
                                               @endforelse
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <label>Public:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <select class="form-control" name="query[public]">
                                            <option value="">Tất cả</option>
                                            <option value="yes"  {{ request()->input('query.public') && request()->input('query.public') === 'yes' ? 'selected' : ''}}>Yes</option>
                                            <option value="no" {{ request()->input('query.public') &&  request()->input('query.public') === 'no' ? 'selected' : ''}}>No</option>
                                        </select>
                                        </span>
                                    </div>
                                </div>

                            </div>
                            <br>
                            <div class="row align-items-center">

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <div class="form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>Ngày bắt đầu:</label>
                                        </div>
                                        <input type='text' class="form-control" id="kt_datepicker_1" name="query[startTime]" readonly placeholder="Chọn thời gian bắt đầu" type="text" />
                                    </div>
                                </div>

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <div class="form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>Ngày kết thúc:</label>
                                        </div>
                                        <input type='text' class="form-control" id="kt_datepicker_1" name="query[endTime]" readonly placeholder="Chọn thời gian kết thúc" type="text" />
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
<script src="/assets/js/pages/crud/forms/widgets/select2.js" type="text/javascript" defer></script>
<script src="/assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript" defer></script>
<script src="/admin/js/pages/bill/service/bill_services.js" type="text/javascript" defer></script>
@endsection
