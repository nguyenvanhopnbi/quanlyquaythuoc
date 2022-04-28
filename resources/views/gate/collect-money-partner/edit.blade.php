@extends('index')
@section('page-header', 'Cấu hình Provider')
@section('page-sub_header', 'Cập nhập cấu hình Provider')
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
                        Cập nhập cấu hình Provider</h3>
                </div>
            </div>
        </div>

        <!-- end:: Subheader -->

        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <form id="kt_edit_form">
                <div class="row">
                    <div class="col-md-8 col-lg-8">
                        <div class="kt-portlet">
                            <!--begin::Form-->
                            <div class="kt-form">
                                <div class="kt-portlet__body">
                                    <div class="form-group row">
                                        <label for="providerName" class="col-12 col-lg-12 col-xl-3 col-form-label">Provider code <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            {{csrf_field()}}
                                            <input type="hidden" id="_id" name="_id" value="{{$detail->id}}">
                                            <input disabled="true" class="form-control" type="text" id="partnerCode" name="partnerCode" placeholder="" value="{{@show_to_view($detail->provider_code)}}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-2 col-lg-2 col-xl-3 col-form-label">Api key <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="btn-create-api-key" data-toggle="tooltip" data-placement="bottom" title="Tự động tạo api key">
                                            <i class="flaticon-refresh" style="font-size:30px;cursor: pointer;"></i>
                                        </div>
                                        <div class="col-8 col-lg-8 col-xl-8">
                                            <input class="form-control" type="text" value="{{@show_to_view($detail->api_key)}}" id="apiKey" name="apiKey" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-2 col-lg-2 col-xl-3 col-form-label">Secret key <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="btn-create-secret-key" data-toggle="tooltip" data-placement="bottom" title="Tự động tạo secret key">
                                            <i class="flaticon-refresh" style="font-size:30px;cursor: pointer;"></i>
                                        </div>
                                        <div class="col-8 col-lg-8 col-xl-8">
                                            <input class="form-control" type="text" value="{{@show_to_view($detail->secret_key)}}" id="secretKey" name="secretKey" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Rsa public key <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <textarea class="form-control" type="text" id="rsaPublicKey" name="rsaPublicKey" required >{{@show_to_view($detail->rsa_public_key)}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Rsa private key <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <textarea class="form-control" type="text" id="systemRsaPrivateKey" name="systemRsaPrivateKey" required >{{@show_to_view($detail->system_rsa_private_key)}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Status<span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <select class="form-control" type="text" value="" id="status" name="status" >
                                                <option value="active" @if($detail->status === 'active') selected="true" @endif >Active</option>
                                                <option value="blocked" @if($detail->status === 'blocked') selected="true" @endif >Blocked</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-lg-2">
                        <div class="kt-portlet">
                            <div class="kt-portlet__foot kt-align-right p-2">
                                <div>
                                    <button type="button" class="btn btn-primary" id="btn_edit"><i class="la la-save"></i> Lưu dữ liệu</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 col-lg-2">
                        <div class="kt-portlet">
                            <div class="kt-portlet__foot kt-align-right p-2">
                                <a href="{{route('gate.collect-money-partner.list')}}">
                                    <button type="button" class="btn btn-info" ><i class="la la-save"></i> Quay lại</button>
                                </a>
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
    <script src="admin/js/pages/gate/collect-money-partner/edit.js" type="text/javascript" defer></script>
    <script src="admin/js/pages/gate/collect-money-partner/base.js" type="text/javascript" defer></script>
@endsection
