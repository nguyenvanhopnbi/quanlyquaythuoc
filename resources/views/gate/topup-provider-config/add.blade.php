@extends('index')
@section('page-header', 'Provider config')
@section('page-sub_header', 'Thêm mới provider')
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
                        Thêm mới provider</h3>
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
                                    <div class="form-group row">
                                        <label for="providerName" class="col-12 col-lg-12 col-xl-3 col-form-label">Provider code <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            {{csrf_field()}}
                                            <input class="form-control" type="text" value="" id="providerCode" name="providerCode">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Secret key <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="btn-create-secret-key" data-toggle="tooltip" data-placement="bottom" title="Tự động tạo secret key">
                                            <i class="flaticon-refresh" style="font-size:30px;cursor: pointer;"></i>
                                        </div>
                                        <div class="col-12 col-lg-12 col-xl-8">
                                            <input class="form-control" type="text" value="" id="secretKey" name="secretKey">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Rsa public key <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span> </label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <textarea class="form-control" type="text" value="" id="rsaPublicKey" name="rsaPublicKey"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Rsa private key <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span> </label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <textarea class="form-control" type="text" value="" id="rsaPrivateKey" name="rsaPrivateKey"></textarea>
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
    <script src="admin/js/pages/gate/topup-provider-config/base.js" type="text/javascript" defer></script>
    <script src="admin/js/pages/gate/topup-provider-config/add.js" type="text/javascript" defer></script>
@endsection
