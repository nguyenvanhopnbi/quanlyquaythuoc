@extends('index')
@section('page-header', 'Application')
@section('page-sub_header', 'Cập nhập Application')
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
                        Cập nhập Application </h3>
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
                                            <input class="form-control" type="text" id="partner_code" name="partner_code" value="{{$detail->partner_code}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerName" class="col-12 col-lg-12 col-xl-3 col-form-label">Name<span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <input class="form-control" type="text" id="name" name="name" value="{{$detail->name}}" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerName" class="col-12 col-lg-12 col-xl-3 col-form-label">Icon</label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <input class="form-control" type="text" id="icon" name="icon" value="{{$detail->icon}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-2 col-lg-2 col-xl-3 col-form-label">Api key <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="btn-create-api-key" data-toggle="tooltip" data-placement="bottom" title="Tự động tạo api key">
                                            <i class="flaticon-refresh" style="font-size:30px;cursor: pointer;"></i>
                                        </div>
                                        <div class="col-8 col-lg-8 col-xl-8">
                                            <input class="form-control" type="text" id="api_key" name="api_key" value="{{$detail->api_key}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-2 col-lg-2 col-xl-3 col-form-label">Secret key <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="btn-create-secret-key" data-toggle="tooltip" data-placement="bottom" title="Tự động tạo secret key">
                                            <i class="flaticon-refresh" style="font-size:30px;cursor: pointer;"></i>
                                        </div>
                                        <div class="col-8 col-lg-8 col-xl-8">
                                            <input class="form-control" type="text" id="secret_key" name="secret_key" value="{{$detail->secret_key}}">
                                        </div>
                                    </div>
                                   <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Ebill notify url</span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <input class="form-control" type="text" id="ebill_notify_url" name="ebill_notify_url" value="{{$detail->ebill_notify_url}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Allowed ips</label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <input class="form-control" type="text" id="allowed_ips" name="allowed_ips" value="{{$detail->allowed_ips}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Status</label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <select class="form-control" type="text" value="" id="status" name="status">
                                                <option value='inactive' @if ($detail->status === 'inactive') selected="true" @endif >inactive</option>
                                                <option value='active'  @if ($detail->status === 'active') selected="true" @endif>active</option>
                                                <option value='blocked' @if ($detail->status === 'blocked') selected="true" @endif>blocked</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Rsa public key</label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <textarea class="form-control" type="text" id="rsa_public_key" name="rsa_public_key" >{{$detail->rsa_public_key}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Rsa private key</label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <textarea class="form-control" type="text" id="rsa_private_key" name="rsa_private_key" >{{$detail->rsa_private_key}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Description<span class="kt-font-danger"></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <textarea class="form-control" type="text" value="" id="description" name="description" >{{$detail->description}}</textarea>
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
    <script src="admin/js/pages/gate/application/base.js" type="text/javascript" defer></script>
    <script src="admin/js/pages/gate/application/edit_application.js" type="text/javascript" defer></script>
@endsection
