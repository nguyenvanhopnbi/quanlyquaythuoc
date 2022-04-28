@extends('index')
@section('page-header', 'Shopcard card')
@section('page-sub_header', 'Cập nhập card')
@section('style')
    <link rel="stylesheet" href="admin/plugins/fancybox/jquery.fancybox.min.css" />
@endsection
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <!-- begin:: Subheader -->
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">
                        Cập nhập card</h3>
                </div>
            </div>
        </div>

        <!-- end:: Subheader -->

        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <form id="kt_edit_form">
                <div class="row">
                    <div class="col-md-8 col-lg-9">
                        <div class="kt-portlet">
                            <div class="kt-portlet__head kt-portlet__head--right">
                                <div class="kt-portlet__head-label ">
                                    <span class="kt-font-danger"><i class="fa fa-star"></i> Bắt buộc phải nhập / chọn nội dung</span>
                                </div>
                            </div>
                            <!--begin::Form-->
                            <div class="kt-form">
                                <div class="kt-portlet__body">
                                    <div class="form-group row">
                                        <label for="providerName" class="col-12 col-lg-12 col-xl-3 col-form-label">Code</label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            {{csrf_field()}}
                                            <input type="hidden" id="_id" name="_id" value="{{$detail->id}}">
                                            <input class="form-control" readOnly="true" type="text" id="code" name="code" placeholder="" value="{{$detail->code}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Serial</label>
                                        <div class="col-12 col-lg-12 col-xl-8">
                                            <input class="form-control" readOnly="true" type="text" id="serial" name="serial" placeholder="" value="{{$detail->serial}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Vendor</label>
                                        <div class="col-12 col-lg-12 col-xl-8">
                                            <input class="form-control" readOnly="true" type="text" id="vendor" name="vendor" placeholder="" value="{{$detail->vendor}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Value</label>
                                        <div class="col-12 col-lg-12 col-xl-8">
                                            <input class="form-control" readOnly="true" type="text" id="value" name="value" placeholder="" value="{{$detail->value}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Ngày hết hạn</label>
                                        <div class="col-12 col-lg-12 col-xl-8">
                                            <input class="form-control" readOnly="true" type="text" id="price" name="price" placeholder="" value="{{$detail->expiry}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Public</label>
                                        <div class="col-12 col-lg-12 col-xl-8">
                                            <select class="form-control"  disabled="true" id="public" name="public" placeholder="" >
                                                <option value="yes" @if($detail->public === 'yes') selected="true" @endif>Yes</option>
                                                <option value="no" @if($detail->public === 'no') selected="true" @endif>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">sold</label>
                                        <div class="col-12 col-lg-12 col-xl-8">
                                            <select class="form-control" disabled="true" id="sold" name="sold" placeholder="" >
                                                <option value="yes" @if($detail->sold === 'yes') selected="true" @endif>Yes</option>
                                                <option value="no" @if($detail->sold === 'no') selected="true" @endif>No</option>
                                            </select>
                                        </div>
                                    </div>
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
    <script src="admin/js/pages/gate/shop-card-item/edit.js" type="text/javascript" defer></script>
@endsection
