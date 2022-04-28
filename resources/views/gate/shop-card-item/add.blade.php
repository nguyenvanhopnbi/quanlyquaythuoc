@extends('index')
@section('page-header', 'Shopcard card')
@section('page-sub_header', 'Thêm mới card item')
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
                        Thêm mới card item</h3>
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
                            <div class="kt-portlet__head kt-portlet__head--center progress-header" style="display:none">
                                <div class="col-md-4 col-lg-12 progress-create-card-item" style="margin-top:2%;">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <!--begin::Form-->
                            <div class="kt-form">
                                <div class="kt-portlet__body">
                                    <div class="form-group row">
                                        <div class="col-xl-8 kt-align-left">
                                            <button type="button" class="btn btn-primary" id="btn_add"><i
                                                    class=" flaticon2-add-1"></i> Lưu dữ liệu</button>
                                        </div>
                                        <div class="col-xl-4 kt-align-right">
                                            <a href="/file-temp/card-item.txt" type="button" class="btn btn-success"><i
                                                    class="fas fa-download"></i> Tải file mẫu</a>
                                            <button type="button" class="btn btn-success" id="btn_import"><i
                                                    class="la la-save"></i> Import dữ liệu
                                            </button>
                                            <div style="display:none">
                                                <input type="file" name="card_items" id="card_items">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode"
                                            class="col-4 col-lg-4 col-xl-3 col-form-label text-right">Vendor <span
                                                class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span> </label>
                                        <div class="col-8 col-lg-8 col-xl-8">
                                            <select class="form-control" id="vendor" name="vendor">
                                                @foreach ($vendors as $vendor)
                                                    <option value="{{ $vendor }}">{{ $vendor }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode"
                                            class="col-4 col-lg-4 col-xl-3 col-form-label text-right">Provider <span
                                                class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span> </label>
                                        <div class="col-8 col-lg-8 col-xl-8">
                                            <select class="form-control" id="provider_code" name="provider_code">
                                                <option value="APPOTACARD">appotacard</option>
                                                <option value="GATE">gate</option>
                                                <option value="VTC">vtc</option>
                                                <option value="VTCMOBILE">vtcmobile</option>
                                                <option value="IMEDIA">imedia</option>
                                                <option value="OCTA">octa</option>
                                                <option value="EPAY">epay</option>
                                                <option value="ZOTA">zota</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode"
                                            class="col-4 col-lg-4 col-xl-3 col-form-label text-right">Nhập danh sách thẻ
                                            <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span> </label>
                                        <div class="col-8 col-lg-8 col-xl-8">
                                            {{ csrf_field() }}
                                            <textarea class="form-control" rows="20" id="data" name="data"
                                                placeholder="code:serial:value:expiry"></textarea>
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
    <script src="admin/js/pages/gate/shop-card-item/add.js" type="text/javascript" defer></script>
@endsection
