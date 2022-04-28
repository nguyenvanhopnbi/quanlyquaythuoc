@extends('index')
@section('page-header', 'Topup denomination')
@section('page-sub_header', 'Thêm mới cấu hình mệnh giá topup')
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
                        Thêm mới cấu hình mệnh giá topup</h3>
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
                                        <label for="providerName" class="col-12 col-lg-12 col-xl-3 col-form-label">Telco <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            {{csrf_field()}}
                                            <select style="width: 50%;" class="form-control" id="telco" name="telco">
                                                <option value="viettel">Viettel</option>
                                                <option value="vinaphone">Vinaphone</option>
                                                <option value="mobifone">Mobifone</option>
                                                <option value="vnmobile">VNMobile</option>
                                                <option value="beeline">Beeline</option>
                                                <option value="viettel_data">Viettel Data</option>
                                                <option value="vinaphone_data">Vinaphone Data</option>
                                                <option value="mobifone_data">Mobifone Data</option>
                                                {{-- <option value="vnmobile_data">VNMobile Data</option>
                                                <option value="beeline_data">Beeline Data</option> --}}
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="providerName" class="col-12 col-lg-12 col-xl-3 col-form-label">Mệnh giá <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <input style="width: 50%;" list="valuelist" type="text" class="form-control" id="value" name="value">
                                            <datalist id="valuelist">
                                                <option value="1000">1000</option>
                                                <option value="2000">2000</option>
                                                <option value="3000">3000</option>
                                                <option value="5000">5000</option>

                                                <option value="9000">9000</option>
                                                <option value="15000">15000</option>
                                                <option value="17000">17000</option>
                                                <option value="19000">19000</option>
                                                <option value="24000">24000</option>
                                                <option value="29000">29000</option>
                                                <option value="38000">38000</option>
                                                <option value="55000">55000</option>
                                                <option value="63000">63000</option>
                                                <option value="69000">69000</option>
                                                <option value="150000">150000</option>
                                                <option value="230000">230000</option>
                                                <option value="150">150</option>
                                                <option value="300">300</option>
                                                <option value="600">600</option>
                                                <option value="900">900</option>
                                                <option value="1500">1500</option>

                                                <option value="4500">4500</option>
                                                <option value="5200">5200</option>
                                                <option value="7500">7500</option>
                                                <option value="7800">7800</option>
                                                <option value="160000">160000</option>
                                                <option value="185000">185000</option>
                                                <option value="220000">220000</option>
                                                <option value="275000">275000</option>

                                                <option value="10000">10.000</option>
                                                <option value="13000">13.000</option>
                                                <option value="14000">14.000</option>
                                                <option value="20000">20.000</option>
                                                <option value="28000">28.000</option>
                                                <option value="30000">30.000</option>
                                                <option value="40000">40.000</option>
                                                <option value="42000">42.000</option>
                                                <option value="50000">50.000</option>
                                                <option value="56000">56.000</option>
                                                <option value="60000">60.000</option>
                                                <option value="70000">70.000</option>
                                                <option value="80000">80.000</option>
                                                <option value="84000">84.000</option>
                                                <option value="90000">90.000</option>
                                                <option value="100000">100.000</option>
                                                <option value="120000">120.000</option>
                                                <option value="200000">200.000</option>
                                                <option value="300000">300.000</option>
                                                <option value="500000">500.000</option>
                                                <option value="1000000">1.000.000</option>
                                            </datalist>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Public</label>
                                        <div class="col-3">
                                            <span class="switch">
                                                <label>
                                                    <input type="checkbox" checked="checked" name="public">
                                                    <span></span>
                                                </label>
                                            </span>
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
    <script src="admin/js/pages/gate/topup-denomination/add.js" type="text/javascript" defer></script>
@endsection
