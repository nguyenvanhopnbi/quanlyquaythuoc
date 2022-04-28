@extends('index')
@section('page-header', 'Cập nhập cấu hình mệnh giá topup')
@section('page-sub_header', 'Cập nhập cấu hình mệnh giá topup')
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
                        Cập nhập cấu hình mệnh giá topup</h3>
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
                                        <label for="providerName" class="col-12 col-lg-12 col-xl-3 col-form-label">Telco <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <input type="hidden" id="_id" name="_id" value="{{$detail->id}}">
                                            {{csrf_field()}}
                                            <select class="form-control" name="telco" disabled="true" value="{{ request()->input('telco')}}">
                                            <option value="viettel" @if($detail->telco === 'viettel') selected @endif>Viettel</option>
                                            <option value="mobifone"  @if($detail->telco === 'mobifone') selected @endif>Mobifone</option>
                                            <option value="vinaphone"  @if($detail->telco === 'vinaphone') selected @endif>Vinaphone</option>
                                            <option value="beeline"  @if($detail->telco === 'beeline') selected @endif>Beeline</option>
                                            <option value="vnmobile"  @if($detail->telco === 'vnmobile') selected @endif>VNMobile</option>
                                            <option value="viettel_data"  @if($detail->telco === 'viettel_data') selected @endif>Viettel Data</option>
                                            <option value="mobifone_data"  @if($detail->telco === 'mobifone_data') selected @endif>Mobifone Data</option>
                                            <option value="vinaphone_data"  @if($detail->telco === 'vinaphone_data') selected @endif> Vinaphone Data </option>
                                            <option value="vnmobile_data" @if($detail->telco === 'vnmobile_data') selected @endif>VNMobile Data</option>
                                            <option value="beeline_data"  @if($detail->telco === 'beeline_data') selected @endif>Beeline Data</option>
                                        </select>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="providerName" class="col-12 col-lg-12 col-xl-3 col-form-label">Mệnh giá <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <input class="form-control" id="value" disabled="true" name="value" value="{{number_format($detail->value, 0, ',', '.')}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Public</label>
                                        <div class="col-3">
                                            <span class="switch">
                                                <input type="checkbox" name="public" @if($detail->public === 'yes') checked="checked" @endif>
                                            <span>
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
    <script src="admin/js/pages/gate/topup-denomination/edit.js" type="text/javascript" defer></script>
@endsection
