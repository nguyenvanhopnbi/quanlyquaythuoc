@extends('index')
@section('page-header', 'Bill Transaction')
@section('page-sub_header', 'Chi tiết bill Transaction')
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Subheader -->
    <div class="kt-subheader kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Chi Tiết Bill Transaction</h3>
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
                                    <label for="transaction_id" class="col-12 col-lg-12 col-xl-3 col-form-label">Mã Giao Dịch:</label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <span class="form-control">{{$transactionInfo->transaction_id}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="partner_ref_id" class="col-12 col-lg-12 col-xl-3 col-form-label">Mã Giao Dịch Đối Tác:</label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <span class="form-control">{{$transactionInfo->partner_ref_id}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="partner_code" class="col-12 col-lg-12 col-xl-3 col-form-label">Mã Đối Tác:</label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <span class="form-control">{{$transactionInfo->partner_code}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="bill_code" class="col-12 col-lg-12 col-xl-3 col-form-label">Mã Bill:</label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <span class="form-control">{{$transactionInfo->bill_code}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="bill_id" class="col-12 col-lg-12 col-xl-3 col-form-label">Bill ID:</label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <span class="form-control">{{$transactionInfo->bill_id}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="bill_amount" class="col-12 col-lg-12 col-xl-3 col-form-label">Mệnh Giá Bill:</label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <span class="form-control">{{$transactionInfo->bill_amount}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="amount" class="col-12 col-lg-12 col-xl-3 col-form-label">Mệnh Giá:</label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <span class="form-control">{{$transactionInfo->amount}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="bill_status" class="col-12 col-lg-12 col-xl-3 col-form-label">Trạng Thái:</label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <span class="form-control">{{$transactionInfo->bill_status}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="discount_percent" class="col-12 col-lg-12 col-xl-3 col-form-label">Phần Trăm Chiết Khấu:</label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <span class="form-control">{{$transactionInfo->discount_percent}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="provider_service_code" class="col-12 col-lg-12 col-xl-3 col-form-label">Mã Nhà Cung Cấp Dịch Vụ:</label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <span class="form-control">{{$transactionInfo->provider_service_code}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="service_code" class="col-12 col-lg-12 col-xl-3 col-form-label">Mã Dịch Vụ:</label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <span class="form-control">{{$transactionInfo->service_code}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="provider_code" class="col-12 col-lg-12 col-xl-3 col-form-label">Mã Nhà cung Cấp:</label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <span class="form-control">{{$transactionInfo->provider_code}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="provider_ref_id" class="col-12 col-lg-12 col-xl-3 col-form-label">REF ID Nhà Cung Cấp:</label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <span class="form-control">{{$transactionInfo->provider_ref_id}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="provider_bill_info" class="col-12 col-lg-12 col-xl-3 col-form-label">Thông Tin Bill Nhà Cung Cấp:</label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <textarea class="form-control" id="provider_bill_info" name="provider_bill_info" required="required" cols="5" rows="10">{{$transactionInfo->provider_bill_info}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="provider_response_data" class="col-12 col-lg-12 col-xl-3 col-form-label">Thông Tin Nhà Cung Cấp Trả Về:</label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <textarea class="form-control" id="provider_response_data" name="provider_response_data" required="required" cols="5" rows="15">{{$transactionInfo->provider_response_data}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="status_code" class="col-12 col-lg-12 col-xl-3 col-form-label">Mã Trạng Thái:</label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <span class="form-control">{{$transactionInfo->status_code}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="status_message" class="col-12 col-lg-12 col-xl-3 col-form-label">Thông Báo Trạng Thái:</label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <span class="form-control">{{$transactionInfo->status_message}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="request_time" class="col-12 col-lg-12 col-xl-3 col-form-label">Thời Gian Yêu Cầu:</label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <span class="form-control">{{$transactionInfo->request_time}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="response_time" class="col-12 col-lg-12 col-xl-3 col-form-label">Thời Gian Phản Hồi:</label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <span class="form-control">{{$transactionInfo->response_time}}</span>
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
@endsection