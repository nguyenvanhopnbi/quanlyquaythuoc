@extends('index')
@section('page-header', 'Bill Provider Config')
@section('page-sub_header', 'Cập nhật bill provider Config')
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Subheader -->
    <div class="kt-subheader kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Cập nhật Bill Provider Config</h3>
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
                        <div class="kt-portlet__head kt-portlet__head--right">
                            <div class="kt-portlet__head-label ">
                                <span class="kt-font-danger"><i class="fa fa-star"></i> Bắt buộc phải nhập / chọn nội dung</span>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <div class="kt-form">
                            <div class="kt-portlet__body">

                                <div class="form-group row">
                                    <label for="secretKey" class="col-12 col-lg-12 col-xl-3 col-form-label">Secret Key:</label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <input class="form-control" type="text" id="secretKey" name="secretKey" required="required" value="{{$providerConfigInfo->secretKey}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="rsaPublicKey" class="col-12 col-lg-12 col-xl-3 col-form-label">RSA Public Key:</label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <textarea class="form-control" id="rsaPublicKey" name="rsaPublicKey" required="required" cols="5" rows="10">{{$providerConfigInfo->rsaPublicKey}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="rsaPrivateKey" class="col-12 col-lg-12 col-xl-3 col-form-label">RSA Private Key:</label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <textarea class="form-control" id="rsaPrivateKey" name="rsaPrivateKey" required="required" cols="5" rows="10">{{$providerConfigInfo->rsaPrivateKey}}</textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3">
                    <div class="kt-portlet">
                        <div class="kt-portlet__foot kt-align-right p-2">
                            <div>
                                {{csrf_field()}}
                                <input type="hidden" id="_id" name="_id" value="{{$providerConfigInfo->providerId}}">
                                <button type="button" class="btn btn-primary" id="btn_edit"><i class="la la-save"></i> Lưu dữ liệu</button>
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
<script src="admin/js/pages/bill/providerConfig/edit_provider_config.js" type="text/javascript" defer></script>
@endsection
