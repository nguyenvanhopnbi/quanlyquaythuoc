@extends('index')
@section('page-header', 'Partner')
@section('page-sub_header', 'Cập nhập partner paygate config')
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
                    Cập nhập partner paygate config</h3>
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
                                    <label for="providerName" class="col-12 col-lg-12 col-xl-3 col-form-label">Partner
                                        code <span class="kt-font-danger"><i
                                                class="fa fa-xs fa-star"></i></span></label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        {{csrf_field()}}
                                        <input type="hidden" id="_id" name="_id" value="{{$detail->id}}">
                                        <input class="form-control" @if($detail->partner_code != null)readOnly="true"
                                        @endif type="text" id="partner_code" name="partner_code" placeholder=""
                                        value="{{(isset($detail->partner_code))?$detail->partner_code:''}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Số Hợp
                                        Đồng <span class="kt-font-danger"><i
                                                class="fa fa-xs fa-star"></i></span></label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <input class="form-control" type="text" id="contract_number"
                                            name="contract_number" placeholder="" value="{{(isset($detail->contract_number))?$detail->contract_number:''}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Phí Giao
                                        Dịch Nội Địa(VNĐ)<span class="kt-font-danger"><i
                                                class="fa fa-xs fa-star"></i></span></label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <!-- <input class="form-control" type="text" id="atm_transaction_fee" name="atm_transaction_fee"  value="{{(isset($detail->atm_transaction_fee))?$detail->atm_transaction_fee:''}}"> -->
                                        <x-widget.currency class="form-control" type="text" id="atm_transaction_fee"
                                            name="atm_transaction_fee" value="{{$detail->atm_transaction_fee}}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Phí Thanh
                                        Toán Nội Địa(%)<span class="kt-font-danger"><i
                                                class="fa fa-xs fa-star"></i></span></label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <input class="form-control" type="text" id="atm_payment_fee"
                                            name="atm_payment_fee" value="{{(isset($detail->atm_payment_fee))?$detail->atm_payment_fee:''}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Phí Giao
                                        Dịch Quốc Tế(VNĐ)<span class="kt-font-danger"><i
                                                class="fa fa-xs fa-star"></i></span></label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <!-- <input class="form-control" type="text" id="cc_transaction_fee" name="cc_transaction_fee"  value="{{$detail->cc_transaction_fee}}"> -->
                                        <x-widget.currency class="form-control" type="text" id="cc_transaction_fee"
                                            name="cc_transaction_fee" value="{{(isset($detail->cc_transaction_fee))?$detail->cc_transaction_fee:''}}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Phí Thanh
                                        Toán Quốc Tế(%)<span class="kt-font-danger"><i
                                                class="fa fa-xs fa-star"></i></span></label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <input class="form-control" type="text" id="cc_payment_fee"
                                            name="cc_payment_fee" value="{{(isset($detail->cc_payment_fee))?$detail->cc_payment_fee:''}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Phí Giao
                                        Dịch Ewallet(VNĐ)</label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <x-widget.currency class="form-control" id="ewallet_transaction_fee"
                                            name="ewallet_transaction_fee"
                                            value="{{$detail->ewallet_transaction_fee ?? 0}}" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Phí Thanh
                                        Toán Ewallet(%)</label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <input class="form-control" type="text" id="ewallet_payment_fee"
                                            name="ewallet_payment_fee" value="{{(isset($detail->ewallet_payment_fee))?$detail->ewallet_payment_fee:''}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Phí xử lý GD Ví Appota (VNĐ)</label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <input class="form-control" type="text"
                                        id="ewallet_transaction_appota_fee"
                                        name="ewallet_transaction_appota_fee"
                                        value="{{(isset($detail->ewallet_transaction_appota_fee))?$detail->ewallet_transaction_appota_fee:''}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Phí thanh toán Ví Appota (%)</label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <input class="form-control" type="text"
                                        id="ewallet_appota_fee"
                                        name="ewallet_appota_fee" value="{{(isset($detail->ewallet_appota_fee))?$detail->ewallet_appota_fee:''}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Phí xử lý GD JCB (VNĐ)</label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <input class="form-control" type="text"
                                        id="cc_transaction_jcb_fee"
                                        name="cc_transaction_jcb_fee"
                                        value="{{(isset($detail->cc_transaction_jcb_fee))?$detail->cc_transaction_jcb_fee:''}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Phí thanh toán JCB (%)</label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <input class="form-control" type="text"
                                        id="cc_payment_jcb_fee"
                                        name="cc_payment_jcb_fee"
                                        value="{{(isset($detail->cc_payment_jcb_fee))?$detail->cc_payment_jcb_fee:''}}">
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
                                <button type="button" class="btn btn-primary" id="btn_edit"><i class="la la-save"></i>
                                    Lưu dữ liệu</button>
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
<script src="/assets/plugins/custom/accounting/accounting.min.js" defer></script>
<script src="/assets/plugins/custom/accounting/simple_money_format.js" defer></script>
<script src="/admin/js/pages/gate/partner-paygate-config/edit.js" type="text/javascript" defer></script>
@endsection
