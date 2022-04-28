@extends('index')
@section('page-header', 'Bill Service')
@section('page-sub_header', 'Thêm mới bill service')
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Subheader -->
    <div class="kt-subheader kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Thêm mới Bill Service </h3>
            </div>
        </div>
    </div>

    <!-- end:: Subheader -->

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <form id="kt_add_form">
            <div class="row">
                <div class="col-md-8 col-lg-9">
                    <div class="kt-portlet">
                        <div class="kt-form">
                            <div class="kt-portlet__body">

                                <div class="form-group row">
                                    <label for="serviceCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Mã dịch vụ: <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        {{csrf_field()}}
                                        <input class="form-control" type="text" id="serviceCode" name="serviceCode" required="required">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="serviceName" class="col-12 col-lg-12 col-xl-3 col-form-label">Tên dịch vụ: <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <input class="form-control" type="text" id="serviceName" name="serviceName" required="required">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="description" class="col-12 col-lg-12 col-xl-3 col-form-label">Mô tả: <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <textarea cols="5" rows="10" class="form-control" type="text" id="description" name="description" required="required"></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="description" class="col-12 col-lg-12 col-xl-3 col-form-label">Icon <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <div class="kt-avatar kt-avatar--outline" id="kt_icon">
                                            <div class="kt-avatar__holder" style="background-image: url('https://i-shop.vnecdn.net/resize/560/560/images/2018/09/10/5b961966e2774-C77154_01_standard.jpg');"></div>
                                            <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Thay đổi icon">
                                                <i class="fa fa-pen"></i>
                                                <input type="file" name="icon">
                                            </label>
                                            <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Hủy bỏ"></span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-3">
                    <div class="kt-portlet">
                        <div class="kt-portlet__foot kt-align-left p-3">
                            <div class="form-group row mb-3">
                                <label for="categoryCode" class="col-4 col-form-label">Danh mục:</label>
                                <div class="col-8">
                                    <select class="form-control" name="categoryCode" id="categoryCode">
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="public" class="col-4 col-form-label">Hiển thị:</label>
                                <div class="col-8">
                                    <select class="form-control" id="public" name="public">
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="kt-align-right">
                                <button type="button" class="btn btn-primary" id="btn_add"><i class="la la-save"></i> Lưu dữ liệu</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- end:: Content -->
</div>
@endsection
@section('script')
<!--begin::Page Scripts(used by this page) -->
<script src="/admin/js/pages/bill/service/add_service.js?v1" type="text/javascript" defer></script>
@endsection
