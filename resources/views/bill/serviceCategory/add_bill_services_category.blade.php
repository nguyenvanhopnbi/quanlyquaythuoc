@extends('index')
@section('page-header', 'Bill Service Category')
@section('page-sub_header', 'Thêm mới bill Service Category')
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Subheader -->
    <div class="kt-subheader kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Thêm mới Bill Service Category</h3>
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
                        <!--begin::Form-->
                        <div class="kt-form">
                            <div class="kt-portlet__body">

                                <div class="form-group row" style="display: none;">
                                    <label for="categoryCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Partner Code:  <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <input list="partnerCodeList" class="form-control" type="text" value="" id="partnerCode" name="partnerCode" required="required">
                                        <datalist id="partnerCodeList">
                                            @if(isset($partnerCodeListAll))
                                            @foreach($partnerCodeListAll as $list)
                                            <option value="{{$list->partner_code}}"></option>
                                            @endforeach
                                            @endif
                                        </datalist>
                                    </div>
                                </div>

                                <div class="form-group row" style="display: none;">
                                    <label for="categoryCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Provider Code:  <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <input list="providerCodeList" class="form-control" type="text" value="" id="providerCode" name="providerCode" required="required">
                                        <datalist id="providerCodeList">
                                            @if(isset($providerCodelistAll))
                                            @foreach($providerCodelistAll as $list2)
                                            <option value="{{$list2->providerCode}}"></option>
                                            @endforeach
                                            @endif
                                        </datalist>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="categoryCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Mã Danh Mục:  <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <input class="form-control" type="text" value="" id="categoryCode" name="categoryCode" required="required">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="categoryName" class="col-12 col-lg-12 col-xl-3 col-form-label">Tên Danh Mục:  <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <input class="form-control" type="text" value="" id="categoryName" name="categoryName" required="required">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="description" class="col-12 col-lg-12 col-xl-3 col-form-label">Mô Tả:  <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <textarea class="form-control" id="description" name="description" required="required" cols="5" rows="10"></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-3">
                    <div class="kt-portlet">
                        <div class="kt-portlet__foot kt-align-right p-3">

                            <div class="form-group row mb-3">
                                <label for="public" class="col-4 col-form-label">Public:</label>
                                <div class="col-8">
                                    <select class="form-control" id="public" name="public">
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                {{csrf_field()}}
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
<script src="admin/js/pages/bill/serviceCategory/add_service_category.js" type="text/javascript" defer></script>
@endsection
