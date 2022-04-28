@extends('index')
@section('page-header', 'Shopcard card')
@section('page-sub_header', 'Cập nhật card discount config')
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
                        Cập nhật card discount config</h3>
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
                            <!--begin::Form-->
                            <div class="kt-form">
                                <div class="kt-portlet__body">
                                    <div class="form-group row">
                                        <label for="providerName" class="col-12 col-lg-12 col-xl-3 col-form-label">Partner code <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            {{csrf_field()}}
                                            <input type="hidden" id="_id" name="_id" value="{{$detail->id}}">
                                            <input class="form-control" disabled="true" type="text" id="partner_code" name="partner_code" placeholder="" value="{{$detail->partner_code}}">
                                        </div>
                                    </div>
                                    @foreach($cards as $vendor => $card)
                                        <div class="row">
                                            <div style="margin-right:5px;"><h3 class="font-size-lg text-dark font-weight-bold mb-6">{{$vendor}}</h3></div>
                                            <div><h3 class="font-size-lg mb-6 btn-hide hide-vendor-{{$vendor}}" data-vendor="{{$vendor}}" style="cursor: pointer">Ẩn<h3></div>
                                            <div><h3 class="font-size-lg mb-6 btn-show show-vendor-{{$vendor}}" data-vendor="{{$vendor}}" style="display:none;cursor: pointer">Hiện<h3></div>
                                        </div>
                                        <div class="form-group row row-vendor-{{$vendor}}">
                                            <label for="providerName" class="text-center col-4 col-lg-4 col-xl-4 col-form-label font-weight-bold">Product code </label>
                                            <label for="providerName" class="text-center col-4 col-lg-4 col-xl-4 col-form-label font-weight-bold">Value</label>
                                            <label for="providerName" class="text-center col-4 col-lg-4 col-xl-4 col-form-label font-weight-bold">Percent (%)</label>
                                        </div>
                                        @foreach($card as $c)
                                        <div class="form-group row row-vendor-{{$vendor}}">
                                            <div class="col-4 col-lg-4 col-xl-4">
                                                <input class="form-control" type="text" disabled="true" value="{{$c->product_code}}">
                                            </div>
                                            <div class="col-4 col-lg-4 col-xl-4">
                                                <input class="form-control" type="text" disabled="true" value="{{$c->value}}">
                                            </div>
                                            <div class="col-4 col-lg-4 col-xl-4">
                                                <input class="form-control" type="number" id="{{$c->product_code}}" value="{{$c->default_value}}" name="{{$c->product_code}}">
                                            </div>
                                        </div>
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <div class="kt-portlet">
                            <div class="kt-portlet__foot kt-align-right p-2">
                                <div>
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
    <script src="admin/js/pages/gate/shop-card-discount-config/edit.js" type="text/javascript" defer></script>
    <script src="admin/js/pages/gate/shop-card-discount-config/base.js" type="text/javascript" defer></script>
@endsection
