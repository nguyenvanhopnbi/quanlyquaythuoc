@extends('index')
@section('page-header', 'Bill Provider')
@section('page-sub_header', 'Thêm mới bill provider')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <!-- begin:: Subheader -->
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">
                        Thêm mới Bill Provider </h3>
                </div>
            </div>
        </div>

        <!-- end:: Subheader -->

        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <form id="kt_add_form">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="kt-portlet">
                            <!--begin::Form-->
                            <div class="kt-form">
                                <div class="kt-portlet__body">
                                    <div class="form-group row">
                                        <label for="providerName" class="col-12 col-lg-12 col-xl-3 col-form-label">Tên nhà cung cấp:  <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            {{csrf_field()}}
                                            <input class="form-control" type="text" value="" id="providerName" name="providerName">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Mã nhà cung cấp:  <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <input class="form-control" type="text" value="" id="providerCode" name="providerCode" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="secretKey" class="col-12 col-lg-12 col-xl-3 col-form-label">Secret Key: <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <input class="form-control" type="text" value="" id="secretKey" name="secretKey" required="required">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="rsaPublicKey" class="col-12 col-lg-12 col-xl-3 col-form-label">RSA Public Key: <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <textarea class="form-control" id="rsaPublicKey" name="rsaPublicKey" required="required" cols="5" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="rsaPrivateKey" class="col-12 col-lg-12 col-xl-3 col-form-label">RSA Private Key: <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <textarea class="form-control" id="rsaPrivateKey" name="rsaPrivateKey" required="required" cols="5" rows="10"></textarea>
                                        </div>
                                    </div>

                                </div>
                                <div class="kt-portlet__foot kt-align-right">
                                    <div class="form-group row">
                                        <div class="col-12 col-lg-12 col-xl-12">
                                            <button type="button" class="btn btn-primary" id="btn_add"><i class="la la-save"></i> Lưu dữ liệu</button>
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
    <script src="admin/js/pages/bill/provider/add_provider.js" type="text/javascript" defer></script>
@endsection
