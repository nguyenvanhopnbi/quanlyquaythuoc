@extends('index')
@section('page-header', 'Bill Provider')
@section('page-sub_header', 'Cập nhập bill provider')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <!-- begin:: Subheader -->
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">
                        Cập nhập Bill Provider </h3>
                </div>
            </div>
        </div>

        <!-- end:: Subheader -->

        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <form id="kt_edit_form">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
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
                                        <label for="providerName" class="col-12 col-lg-12 col-xl-3 col-form-label">Tên nhà cung cấp:</label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            {{csrf_field()}}
                                            <input type="hidden" id="_id" name="_id" value="{{$detail->providerId}}">
                                            <input class="form-control" type="text" id="providerName" name="providerName" value="{{$detail->providerName}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Mã nhà cung cấp:</label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <input class="form-control" type="text" id="providerCode" name="providerCode" value="{{$detail->providerCode}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="secretKey" class="col-12 col-lg-12 col-xl-3 col-form-label">Secret Key:</label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <input class="form-control" type="text" id="secretKey" name="secretKey" required="required" value="{{$detail->secretKey}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="rsaPublicKey" class="col-12 col-lg-12 col-xl-3 col-form-label">RSA Public Key:</label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <textarea class="form-control" id="rsaPublicKey" name="rsaPublicKey" required="required" cols="5" rows="10">{{$detail->rsaPublicKey}}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="rsaPrivateKey" class="col-12 col-lg-12 col-xl-3 col-form-label">RSA Private Key:</label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <textarea class="form-control" id="rsaPrivateKey" name="rsaPrivateKey" required="required" cols="5" rows="10">{{$detail->rsaPrivateKey}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-portlet__foot kt-align-right">
                                    <div class="form-group row">
                                        <div class="col-12 col-lg-12 col-xl-12">
                                            <button type="button" class="btn btn-primary" id="btn_edit"><i class="la la-save"></i> Lưu dữ liệu</button>
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
    <script src="admin/js/pages/bill/provider/edit_provider.js" type="text/javascript" defer></script>
@endsection
