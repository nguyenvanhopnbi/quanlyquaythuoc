@extends('index')
@section('page-header', 'Quản lý hệ thống')
@section('page-sub_header', 'Tạo giao dịch')
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
                        Giao dịch chuyển tiền
                    </h3>
                </div>
            </div>
        </div>

        <!-- end:: Subheader -->

        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

            <form id="formSubmit" action="{{ route('system.transfer.make.submit') }}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-8 col-lg-9">
                        <div class="kt-portlet">
                            @include('system.transfer.partials.notification_alert')
                            <div class="kt-form">
                                <div class="kt-portlet__body">
                                    <div class="form-group row">
                                        <label for="providerName" class="col-12 col-lg-12 col-xl-3 col-form-label">
                                            Chọn tài khoản chuyển tiền
                                            <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span>
                                        </label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <select class="form-control" id="accFrom" name="account_from_id"></select>
                                            @if($errors->has('account_from_id'))
                                                <div class="text-danger mt-1">{{$errors->first('account_from_id')}}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerName" class="col-12 col-lg-12 col-xl-3 col-form-label">
                                            Chọn tài khoản nhận tiền
                                            <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span>
                                        </label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <select class="form-control" id="accTo" name="account_to_id"></select>
                                            @if($errors->has('account_to_id'))
                                                <div class="text-danger mt-1">{{$errors->first('account_to_id')}}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Tổng tiền cần chuyển
                                            <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9"
                                             x-data="{formatted: '{{old('total_amount', 0)}}', get amount() { return this.formatted.replace(/\./g, '')}}"
                                             x-init="$watch('formatted', value => formatted = !value ? '0' : formatted)">
                                            <input class="form-control" type="text" x-model="formatted" value="{{old('total_amount')}}"
                                                   x-on:input.debounce.400="formatted = FormatMoney.from(parseInt(formatted.replace(/\./g, '')))">
                                            <input class="form-control" type="hidden" x-model="amount" name="total_amount"
                                                   value="{{old('total_amount')}}">
                                            @if($errors->has('total_amount'))
                                                <div class="text-danger mt-1">{{$errors->first('total_amount')}}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Số tiền chuyển/lần
                                            <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9"
                                             x-data="{formatted: '{{old('amount_per_trans', 0)}}', get amount() { return this.formatted.replace(/\./g, '')}}"
                                             x-init="$watch('formatted', value => formatted = !value ? '0' : formatted)">
                                            <input class="form-control" type="text" x-model="formatted" value="{{old('amount_per_trans')}}"
                                                   x-on:input.debounce.400="formatted = FormatMoney.from(parseInt(formatted.replace(/\./g, '')))">
                                            <input class="form-control" type="hidden" x-model="amount" name="amount_per_trans"
                                                   value="{{old('amount_per_trans')}}">
                                            @if($errors->has('amount_per_trans'))
                                                <div class="text-danger mt-1">{{$errors->first('amount_per_trans')}}</div>
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
                                                          placeholder="Nhập nội dung chuyển tiền (tối đa 150 ký tự chỉ chứa chữ, số, dấu cách)">{{old('content')}}</textarea>
                                            </div>
                                            @if($errors->has('content'))
                                                <div class="text-danger mt-1">{{$errors->first('content')}}</div>
                                            @endif
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
                                                    <span class="">Tạo mã OTP SMS</span>
                                                    <b id="timer-count-down1"></b>
                                                </button>
                                            </div>
                                            <div class="text-primary" id="msgSms"></div>
                                            @if($errors->has('otp_sms_code'))
                                                <div class="text-danger mt-1">{{$errors->first('otp_sms_code')}}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label class="mt-2 col-form-label" name="otp_sms">
                                                Nhập mã OTP Email
                                                <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span>
                                            </label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-inline">
                                                <input type="text" class="form-control col-md-6" name="otp_email_code"
                                                       placeholder="Nhập mã OTP nhận được từ email">
                                                <button type="button" class="btn btn-primary mx-3" id="sendOtpEmail">
                                                    <span class="spinner-border spinner-border-sm sr-only" role="status" aria-hidden="true"></span>
                                                    <span class="">Tạo mã OTP Email</span>
                                                    <b id="timer-count-down2"></b>
                                                </button>
                                            </div>
                                            <div class="text-primary" id="msgEmail"></div>
                                            @if($errors->has('otp_email_code'))
                                                <div class="text-danger mt-1">{{$errors->first('otp_email_code')}}</div>
                                            @endif
                                            @if($errors->has('otp_code'))
                                                <div class="text-danger mt-1">{{$errors->first('otp_code')}}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row" id="cbSchedule">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-9">
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input mt-2" id="cbSchedule" value="1"
                                                       name="is_schedule" {{old('is_schedule') ? 'checked' : ''}}>
                                                <label class="form-check-label ml-2" for="cbSchedule"> Hẹn lịch đặt lệnh chuyển</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="{{!old('is_schedule') ? 'sr-only' : ''}}" id="cbScheduleWrap">
{{--                                    <div  id="cbScheduleWrap">--}}
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label class="mt-2 col-form-label" name="otp_sms">
                                                    Số lần chuyển
                                                    <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span>
                                                </label>
                                            </div>
                                            <div class="col-md-9">
                                                <div style="margin-top: 10px">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input mt-2" type="radio" name="schedule_type" id="radio_once"
                                                               value="once" {{(!old('schedule_type') || old('schedule_type') === 'once') ? 'checked' : ''}}>
                                                        <label class="form-check-label" for="radio_once">Chuyển 1 lần</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="schedule_type" id="radio_daily"
                                                               value="daily" {{old('schedule_type') === 'daily' ? 'checked' : ''}}>
                                                        <label class="form-check-label mt-0" for="radio_daily">Chuyển hàng ngày</label>
                                                    </div>
                                                </div>
                                                @if($errors->has('schedule_type'))
                                                    <div class="text-danger mt-1">{{$errors->first('schedule_type')}}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label class="mt-2 col-form-label" name="otp_sms">
                                                    Thời gian chuyển
                                                    <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span>
                                                </label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="">
                                                    <input type='text' class="form-control col-md-2" id="datetime_schedule" name="schedule_at"
                                                           readonly placeholder="Chọn thời gian chuyển" type="text"
                                                           value="{{old('schedule_at', now()->addHours(2)->startOfHour()->format('H:i'))}}"/>
                                                </div>
                                                @if($errors->has('schedule_at'))
                                                    <div class="text-danger mt-1">{{$errors->first('schedule_at')}}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row {{(!old('schedule_type') || old('schedule_type') === 'once') ? '':'sr-only'}}" id="scheduleDateWrap">
                                            <div class="col-md-3">
                                                <label class="mt-2 col-form-label" name="otp_sms">
                                                    Ngày chuyển
                                                    <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span>
                                                </label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="">
                                                    <input type='text' class="form-control col-md-2" id="date_schedule" name="scheduled_date"
                                                           readonly placeholder="Chọn ngày chuyển" type="text"
                                                           value="{{old('scheduled_date', now()->addDay()->format('d/m/Y'))}}"/>
                                                    <div class="help-block">Định dạng ngày/tháng/năm</div>
                                                </div>
                                                @if($errors->has('scheduled_date'))
                                                    <div class="text-danger mt-1">{{$errors->first('scheduled_date')}}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row mt-3">
                                        <div class="col-md-12">
                                            <hr/>
                                        </div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-9">

                                            <button type="button" class="btn btn-primary" id="btn_add">
                                                <i class="la la-save"></i>
                                                Tạo giao dịch
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
        var accountFrom = @json(Session::get('account_from'));
        var accountTo = @json(Session::get('account_to'));
        if (accountFrom) {
            accountFrom.selected = true;
        }
        if (accountTo) {
            accountTo.selected = true;
        }
        var expiredAtSms = '{{$expiredAtSms}}';
        var expiredAtEmail = '{{$expiredAtEmail}}';
    </script>
    <script src="/admin/js/pages/system/transfer/transfer-create.js?v={{time()}}" type="text/javascript" defer></script>


@endsection
