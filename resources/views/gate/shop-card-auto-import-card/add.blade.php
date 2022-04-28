@extends('index')
@section('page-header', 'Shopcard card')
@section('page-sub_header', 'Thêm mới card')
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
                        Thêm mới card</h3>
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
                                        <label for="providerName" class="col-12 col-lg-12 col-xl-3 col-form-label">Name <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            {{csrf_field()}}
                                            <input class="form-control" type="text" value="" id="name" name="name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Product code <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span> </label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <input class="form-control" type="text" value="" id="productCode" name="productCode">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Vendor <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span> </label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <select class="form-control" id="vendor" name="vendor">
                                                <option value="appota">Appota</option>
                                                <option value="viettel">Viettel</option>
                                                <option value="mobifone">Mobifone</option>
                                                <option value="vinaphone">Vinaphone</option>
                                                <option value="vnmobile">VNMobile</option>
                                                <option value="beeline">Beeline</option>
                                                <option value="zing">Zing</option>
                                                <option value="vcoin">VCoin</option>
                                                <option value="gate">Gate</option>
                                                <option value="garena">Garena</option>
                                                <option value="megacard">MegaCard</option>
                                                <option value="scoin">SCoin</option>
                                                <option value="oncash">OnCash</option>
                                                <option value="soha">Soha</option>
                                                <option value="funtap">Funtap</option>
                                                <option value="viettel_data">Viettel Data</option>
                                                <option value="mobifone_data">Mobifone Data</option>
                                                <option value="vinaphone_data">Vinaphone Data</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Value <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span> </label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <select class="form-control" id="value" name="value">
                                                <option value="10000">10.000</option>
                                                <option value="20000">20.000</option>
                                                <option value="30000">30.000</option>
                                                <option value="50000">50.000</option>
                                                <option value="60000">60.000</option>
                                                <option value="80000">80.000</option>
                                                <option value="100000">100.000</option>
                                                <option value="150000">150.000</option>
                                                <option value="200000">200.000</option>
                                                <option value="250000">250.000</option>
                                                <option value="300000">300.000</option>
                                                <option value="500000">500.000</option>
                                                <option value="1000000">1.000.000</option>
                                                <option value="2000000">2.000.000</option>
                                                <option value="3000000">3.000.000</option>
                                                <option value="5000000">5.000.000</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Price <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span> </label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <input class="form-control" type="text" value="" id="price" name="price">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Public <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span> </label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <select class="form-control" id="public" name="public" >
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
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
    <script src="admin/js/pages/gate/shop-card/add.js" type="text/javascript" defer></script>
@endsection
