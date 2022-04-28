@extends('index')
@section('page-header', 'Quảnl lý partner')
@section('page-sub_header', 'Tạo lệnh chuyển tiền Partner')
@section('style')
    <link rel="stylesheet" href="admin/plugins/fancybox/jquery.fancybox.min.css"/>
    <style>
        .form-group {
            margin-bottom: 1rem !important;
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
                        Tạo yêu cầu thanh toán
                    </h3>
                </div>
            </div>
        </div>

        <!-- end:: Subheader -->

        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

            <form id="formSubmit" action="{{ route('partner.bank-account.make.submit') }}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-8 col-lg-9">
                        <div class="kt-portlet">
                            @include('system.transfer.partials.notification_alert')
                            <div class="kt-form">
                                <div class="kt-portlet__body">
                                    <div class="form-group row">
                                        <label for="providerName" class="col-12 col-lg-12 col-xl-3 col-form-label">
                                            Tài khoản Partner
                                            <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span>
                                        </label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <select class="form-control" id="accTo" name="account_id"></select>
                                            @if($errors->has('account_id'))
                                                <div class="text-danger mt-1">{{$errors->first('account_id')}}</div>
                                            @endif
                                            <input type="hidden" data-name="account_id">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Tổng tiền thanh toán
                                            <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9"
                                             x-data="{formatted: '{{old('amount', 0)}}', get amount() { return this.formatted.replace(/\./g, '')}}"
                                             x-init="$watch('formatted', value => formatted = !value ? '0' : formatted)">
                                            <input class="form-control" type="text" x-model="formatted" value="{{old('amount')}}"
                                                   x-on:input.debounce.400="formatted = FormatMoney.from(parseInt(formatted.replace(/\./g, '')))">
                                            <input class="form-control" type="hidden" x-model="amount" name="amount"
                                                   value="{{old('amount')}}">
                                            @if($errors->has('amount'))
                                                <div class="text-danger mt-1">{{$errors->first('amount')}}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">
                                            ID biên bản đối soát
                                            <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <input class="form-control" type="text" name="bbds_id">
                                            @if($errors->has('bbds_id'))
                                                <div class="text-danger mt-1">{{$errors->first('bbds_id')}}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label class="mt-2 col-form-label">
                                                Nội dung chuyển tiền
                                                <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span>
                                            </label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-inline">

                                                <textarea name="content" class="form-control col-md-12"
                                                          placeholder="Noi dung theo mau sau: Ten dich vu ngay ddmmyyyy">{{old('content')}}</textarea>
                                            </div>
                                            <div class="mt-1" style="font-size: 12px">Tiếng việt không dấu, chỉ gồm chữ và số, không chứa ký tự đặc biệt</div>
                                            @if($errors->has('content'))
                                                <div class="text-danger mt-1">{{$errors->first('content')}}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="providerCode" class="mt-2 col-form-label">
                                                File đối soát
                                                <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-inline">
                                                <input class="form-control" style="width: 100%" type="file" name="file_attach">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label class="mt-2 col-form-label" name="otp_sms">
                                                Nhập mã OTP SMS
                                                <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span>
                                            </label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-inline">
                                                <input type="text" class="form-control col-md-6" name="otp_sms_code"
                                                       placeholder="Nhập mã OTP nhận được từ SMS">
                                                <button type="button" class="btn btn-primary mx-3" id="sendOtpSms">
                                                    <span class="spinner-border spinner-border-sm sr-only" role="status" aria-hidden="true"></span>
                                                    <span class="">Gửi mã OTP</span>
                                                    <b id="timer-count-down1"></b>
                                                </button>
                                            </div>
                                            <div class="text-primary" id="msgSms"></div>
                                            <div data-name="otp_sms_code"></div>
                                            @if($errors->has('otp_sms_code'))
                                                <div class="text-danger mt-1">{{$errors->first('otp_sms_code')}}</div>
                                            @endif
                                            @if($errors->has('otp_code'))
                                                <div class="text-danger mt-1">{{$errors->first('otp_code')}}</div>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group row mt-3">
                                        <div class="col-md-12">
                                            <hr/>
                                        </div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-9">

                                            <button type="submit" class="btn btn-primary" id="btn_add">
                                                <i class="la la-save"></i>
                                                Tạo yêu cầu
                                            </button>
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
    <script>
        var expiredAtSms = '{{$expiredAtSms}}';
        var expiredAtEmail = '{{$expiredAtEmail}}';
        var isAllowViewListTransaction = parseInt("{{Auth::user()->can('partner-bank-account-make-list') ? 1 : 0}}");
    </script>
    <script src="/admin/js/pages/partner/bank-account-create.js?v={{time()}}" type="text/javascript" defer></script>


@endsection
