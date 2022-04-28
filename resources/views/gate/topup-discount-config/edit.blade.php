@extends('index')
@section('page-header', 'Topup discount config')
@section('page-sub_header', 'Cập nhập topup discount config')
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
                        Cập nhập topup discount config</h3>
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
                                            <input class="form-control" type="text" readOnly="true" id="partnerCode" name="partnerCode" placeholder="" value="{{$detail->partnerCode}}">
                                        </div>
                                    </div>
                                    @foreach($telco as $key => $telco)
                                        <div class="row">
                                            <div style="margin-right:5px;"><h3 class="font-size-lg text-dark font-weight-bold mb-6">{{$telco['name']}}</h3></div>
                                            <div><h6 class="font-size-lg mb-6 btn-hide hide-vendor-{{$telco['key']}}" data-vendor="{{$telco['key']}}" style="display:none;cursor: pointer">Ẩn<h6></div>
                                            <div><h6 class="font-size-lg mb-6 btn-show show-vendor-{{$telco['key']}}" data-vendor="{{$telco['key']}}" style="cursor: pointer">Hiện<h6></div>
                                        </div>
                                        <div class="form-group row row-vendor-{{$telco['key']}}" style="display:none">
                                            <label for="providerName" class="text-center col-6 col-lg-6 col-xl-6 col-form-label font-weight-bold">Value</label>
                                            <label for="providerName" class="text-center col-6 col-lg-6 col-xl-6 col-form-label font-weight-bold">Percent (%)</label>
                                        </div>
                                        @foreach($amount[$telco['name']] as $a)
                                        <div class="form-group row row-vendor-{{$telco['key']}}" style="display:none">
                                            <div class="col-6 col-lg-6 col-xl-6">
                                                <input class="form-control" type="text" disabled="true" value="{{$a['name']}}">
                                            </div>
                                            <div class="col-6 col-lg-6 col-xl-6">
                                                <input class="form-control" type="number" id="{{$a['name']}}" name="{{$telco['key']}}[{{$a['key']}}]" value="@if (isset($config[$telco['key']][$a['key']])){{$config[$telco['key']][$a['key']]}}@else{{$defaultValue}}@endif" >
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
    <script src="admin/js/pages/gate/topup-discount-config/edit.js" type="text/javascript" defer></script>
    <script src="admin/js/pages/gate/topup-discount-config/base.js" type="text/javascript" defer></script>
@endsection
