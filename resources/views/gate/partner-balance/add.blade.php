@extends('index')
@section('page-header', 'Nạp tiền cho partner')
@section('page-sub_header', 'Nạp tiền cho partner')
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
                        Nạp tiền cho partner</h3>
                </div>
            </div>
        </div>

        <!-- end:: Subheader -->

        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <form id="kt_add_form" action="{{ route('gate.partner-balance.addAction') }}" method="POST">
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
                                            {{ csrf_field() }}
                                            <select class="form-control" id="partnerCode" name="partnerCode"></select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Amount
                                            <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9"
                                            x-data="{formatted: '0', get amount() { return this.formatted.replace(/\./g, '')}}"
                                            x-init="$watch('formatted', value => formatted = (value === '') ? '0' : formatted)">
                                            <input class="form-control" type="text" x-model="formatted"
                                                x-on:input.debounce.400="formatted = FormatMoney.from(parseInt(formatted.replace(/\./g, '')))">
                                            <input class="form-control" type="hidden" x-model="amount" name="amount">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Reason
                                            <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <textarea class="form-control" id="reason" name="reason"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row"
                                        x-data="{message: '', counter: -1, interval: null, text_color: '', startCounter() { this.counter = 300; this.interval = setInterval(() => this.counter--, 1000)} }"
                                        x-init="$watch('message', () => setTimeout(() => message = '', 5000)); $watch('counter', value => value === 0 ? clearInterval(interval) : null)"
                                        x-on:partner-balance-added.window="counter = -1">
                                        <label for="providerCode" class="col-3 col-form-label">OTP
                                            <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-4">
                                            <input class="form-control" type="text" value="" id="otp" name="otp">
                                        </div>
                                        <div class="col-1 d-flex align-items-center">
                                            <span class="text-danger" x-text="counter" x-show="counter >= 0"></span>
                                        </div>
                                        <div class="col-4 d-flex align-items-center">
                                            <button class="btn btn-sm btn-primary"
                                                x-bind:disabled="counter > 0"
                                                x-on:click.prevent="axios.get('/new-otp', {headers: {Accept: 'application/json'}}).then(() => {message = 'Đã tạo mới OTP'; clearInterval(interval); startCounter(); text_color = 'text-success'}).catch((error) => {message = 'Vượt quá số lần giới hạn tạo OTP'; text_color = 'text-danger'})">Gửi
                                                mã OTP</button>
                                            <span class="ml-5 font-weight-bold" :class="text_color" x-text="message"></span>
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
                                    <button type="submit" class="btn btn-primary" id="btn_add"><i class="la la-save"></i>
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
    <script src="admin/js/pages/gate/partner-balance/add.js?v=1.1" type="text/javascript" defer></script>
    {{-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script> --}}

@endsection
