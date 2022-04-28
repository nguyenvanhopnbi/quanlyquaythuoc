@extends('index')
@section('page-header', 'Chi tiết giao dịch topup')
@section('page-sub_header', 'Chi tiết giao dịch topup')
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
                        Chi tiết giao dịch topup </h3>
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
                                            {{csrf_field()}}
                                            <input type="hidden" id="_id" name="_id" value="{{$detail->transaction_id}}">
                                            <input class="form-control" type="text" readOnly="true" id="transaction_id" name="transaction_id" placeholder="" value="{{$detail->transaction_id}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Partner ref id</label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <input class="form-control" type="text" readOnly="true" id="partner_ref_id" name="partner_ref_id" placeholder="" value="{{$detail->partner_ref_id}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Partner code</label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <input class="form-control" type="text" readOnly="true" id="partner_code" name="partner_code" placeholder="" value="{{$detail->partner_code}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Application id</label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <input class="form-control" type="text" readOnly="true" id="application_id" name="application_id" placeholder="" value="{{$detail->application_id}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Product code</label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <input class="form-control" type="text" readOnly="true" id="product_code" name="product_code" placeholder="" value="{{$detail->product_code}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">quantity</label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <input class="form-control" type="text" readOnly="true" id="quantity" name="quantity" placeholder="" value="{{$detail->quantity}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Product price</label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <input class="form-control" type="text" readOnly="true" id="product_price" name="product_price" placeholder="" value="{{$detail->product_price}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Amount</label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <input class="form-control" type="text" readOnly="true" id="amount" name="amount" placeholder="" value="{{$detail->amount}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Status</label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <input class="form-control" type="text" readOnly="true" id="status" name="status" placeholder="" value="{{$detail->status}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Discount percent</label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <input class="form-control" type="text" readOnly="true" id="discount_percent" name="discount_percent" placeholder="" value="{{$detail->discount_percent}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Thời gian giao dịch</label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <input class="form-control" type="text" readOnly="true" id="request_time" name="request_time" placeholder="" value="{{$detail->request_time}}">
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
    <script src="admin/js/pages/gate/shopcard-transaction/edit.js" type="text/javascript" defer></script>
@endsection
