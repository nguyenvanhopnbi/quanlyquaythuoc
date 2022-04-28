<div>
    {{-- Success is as dangerous as failure. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Tool Tạo Giao Dịch
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    {{-- <button
                    wire:click.prevent="$emit('ExportCSVDoiSoatProviderScript')"
                    class="btn btn-primary">Export CSV</button> --}}
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">


            <div class="row" style="width: 500px;">
                <div class="col">
                    <label for="Account No">Account No: </label>
                    <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span>
                    <input placeholder="Nhập Account No:" type="text" class="form-control" id="account_no">

                </div>
            </div>

            <div class="row" style="width: 500px;">
                <div class="col">
                    <label for="Amount">Amount: </label>
                    <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span>
                    <input placeholder="Nhập Amount" type="text" class="form-control" id="amount">
                </div>
            </div>

            <div class="row" style="width: 500px;">
                <div class="col">
                    <label for="Provider Ref ID">Provider Ref ID: </label>
                    <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span>
                    <input placeholder="Nhập Provider Ref ID" type="text" class="form-control" id="provider_ref_id">
                </div>
            </div>

            <div class="row" style="width: 500px;">
                <div class="col">
                    <label for="Provider Ref ID">Provider: </label>
                    <select class="form-control" name="provider" id="provider">
                        <option value="WOORIBANK">WOORIBANK</option>
                        <option value="VIETCAPITALBANK">VIETCAPITALBANK</option>
                        <option value="EPAY">EPAY</option>
                    </select>
                    {{-- <input type="text" class="form-control" id="provider" value="VIETCAPITALBANK"> --}}
                </div>
            </div>

            <div class="row" style="width: 500px;">
                <div class="col">
                    <label for="Provider Ref ID">Memo: </label>
                    <input type="text" class="form-control" id="memo" placeholder="Không bắt buộc">
                </div>
            </div>

            <div class="row" style="width: 500px;">
                <div class="col">
                    <label for="Transaction Time">Transaction Time: </label>
                    <input type="text" class="form-control" id="transaction_time" placeholder="Nhập thời gian">
                </div>
            </div>
            <div class="row" style="width: 500px;">
                <div class="col">
                    <label class="mt-2 col-form-label" name="otp_sms">
                                                Nhập mã OTP SMS
                    <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span>
                    </label>
                    <span style="display: flex;">
                        <input type="text" class="form-control" id="maSmS" placeholder="Nhập mã OTP nhận được từ SMS">
                        @if(!isset($phoneCode) or empty($phoneCode))
                            <button wire:click.prevent="$emit('sendOtpSMSScript')" class="btn btn-primary" style="white-space: nowrap; height: 38px; margin-top: 5px;">Tạo mã OTP SMS</button>
                        @endif
                        <div wire:ignore id="countDownSMS" style="line-height: 43px; font-weight: bold; margin-left: 10px;">
                        </div>
                    {{--     <div
                        style="line-height: 43px; font-weight: bold; margin-left: 10px;">
                        {{ $phoneCode }}
                        </div> --}}
                    </span>
                </div>
            </div>
            <div class="row" style="width: 500px;">
                <div class="col">
                    <label class="mt-2 col-form-label" name="otp_email">
                        Nhập mã OTP Email
                    <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span>
                    </label>
                    <span style="display: flex;">
                        <input type="text" class="form-control" id="maEmail" placeholder="Nhập mã OTP nhận được từ Email">
                        @if(!isset($emailCode) or empty($emailCode))
                        <button wire:click.prevent="$emit('sendOtpEmailScript')" class="btn btn-primary" style="white-space: nowrap; height: 38px; margin-top: 5px;">Tạo mã OTP Email</button>

                        @endif

                        <div wire:ignore id="countDownEmail" style="line-height: 43px; font-weight: bold; margin-left: 10px;">
                        </div>
                    </span>

                </div>
            </div>
            <div class="row" style="width: 500px;">
                <div class="col">
                <button wire:click.prevent="$emit('ResendTransactionScript')" class="btn btn-primary">Resend</button>
                </div>
            </div>

            @if(isset($message) and !$waring)
            <div class="row" style="width: 500px; margin-top: 10px;">
                <div class="col">
                    <span class="alert alert-primary">{{$message}}</span>
                </div>
            </div>
            @endif

            @if(isset($message) and $waring)
            <div class="row" style="width: 500px; margin-top: 10px;">
                <div class="col">
                    <span class="alert alert-danger">{{$message}}</span>
                </div>
            </div>
            @endif
        </div>

    </div>
</div>
