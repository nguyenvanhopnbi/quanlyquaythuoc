@extends('index')
@section('page-header', 'Bank')
@section('page-sub_header', 'Cập nhập bank')
@section('style')
    <link rel="stylesheet" href="admin/plugins/fancybox/jquery.fancybox.min.css" />


    <style>
        .form-controlCheckbox {
            display: block;
            width: 6%;
            height: calc(1.5em + 1.3rem + 2px);
            padding: .65rem 1rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #e2e5ec;
            border-radius: 0px;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
    </style>

@endsection
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <!-- begin:: Subheader -->
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">
                        Cập nhập bank </h3>
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
                                    {{-- @dump($detail) --}}
                                    <div class="form-group row">
                                        <label for="providerName" class="col-12 col-lg-12 col-xl-3 col-form-label">Bank code <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            {{csrf_field()}}
                                            <input type="hidden" id="_id" name="_id" value="{{$detail->id}}">
                                            <input class="form-control" type="text" id="bank_code" name="bank_code" value="{{$detail->bank_code}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Bank name <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <input class="form-control" type="text" id="bank_name" name="bank_name" value="{{$detail->bank_name}}">
                                        </div>
                                    </div>
                                    {{-- @dump($detail->vendor_code) --}}
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Vendor Code <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <select class="form-control" type="text" value="" id="vendor_code" name="vendor_code">
                                                <option selected="true"
                                                value="{{$detail->vendor_code}}">
                                                    {{$detail->vendor_code}}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Type <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <select class="form-control" type="text" id="type" name="type" value="{{$detail->type}}">
                                                <option value="ATM" @if($detail->type === 'ATM') selected @endif>ATM</option>
                                                <option value="CC"  @if($detail->type === 'CC') selected @endif>CC</option>
                                                <option value="EWALLET"  @if($detail->type === 'EWALLET') selected @endif>EWALLET</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Public <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <select class="form-control" type="text" id="public" name="public">
                                                <option value="yes" @if($detail->public === 'yes') selected @endif>yes</option>
                                                <option value="no"  @if($detail->public === 'no') selected @endif>no</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row" >
                                        <div class="form-group row" style="margin-right: 100px;">
                                            <label for="enableToken" class="col-12 col-lg-12 col-xl-3 col-form-label">Enable Token <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                            <div class="col-12 col-lg-12 col-xl-9">
                                                <input
                                                style="width: 140px;"
                                                {{($detail->enable_token == 1)?"checked":''}}
                                                class="form-controlCheckbox" type="checkbox" id="enable_token" name="enable_token">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="enableToken" class="col-12 col-lg-12 col-xl-3 col-form-label">Maintenance <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                            <div class="col-12 col-lg-12 col-xl-9">
                                                <input
                                                style="width: 140px;"
                                                {{($detail->maintenance == 'yes')?"checked":''}}
                                                class="form-controlCheckbox" type="checkbox" id="maintenance" name="maintenance">
                                            </div>
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
<script>
    var vendorCode = "{{$detail->vendor_code}}";
</script>
@section('script')
    <script src="admin/js/pages/gate/bank/edit.js" type="text/javascript" defer></script>
@endsection
