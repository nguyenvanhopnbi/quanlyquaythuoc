@extends('index')
@section('page-header', 'Detail transaction')
@section('page-sub_header', 'Chi tiết giao dịch')
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
                        Chi tiết giao dịch </h3>
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
                                        <label for="providerName" class="col-12 col-lg-12 col-xl-3 col-form-label">Transaction id</label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <input type="hidden" id="_id" name="_id" value="{{$detail->transaction_id}}">
                                            <input class="form-control" type="text"  readOnly="true" value="{{$detail->transaction_id}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Order id</label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <input class="form-control" type="text" readOnly="true" value="{{$detail->order_id}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Partner code</label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <input class="form-control" type="text" readOnly="true" value="{{$detail->partner_code}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Amount </label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <input class="form-control" type="text" readOnly="true" value="{{$detail->amount}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Status </label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <input class="form-control" type="text" readOnly="true" value="{{$detail->status}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Payment method </label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <input class="form-control" type="text" readOnly="true" value="{{$detail->payment_method}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Payment type </label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <input class="form-control" type="text" readOnly="true" value="{{$detail->payment_type}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Vendor ref id </label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <input class="form-control" type="text" readOnly="true" value="{{$detail->vendor_ref_id}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Ngày giao dịch</label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <input class="form-control" type="text" readOnly="true" value="{{$detail->request_time}}">
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
    <script src="admin/js/pages/gate/bank/edit.js" type="text/javascript" defer></script>
@endsection
