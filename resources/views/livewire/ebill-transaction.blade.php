<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Danh sách giao dịch ebill
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                </div>
            </div>
        </div>
        @if(request()->session()->has('status_resend'))
        <div class="kt-portlet__body" style="margin:0; padding: 0;">
            <div class="row">
                <div class="col">
                    <span class="alert alert-primary" style="font-weight: bold;">
                        @if(request()->session()->has('status_resend'))
                            {{session('status_resend')}}
                        @endif

                    </span>
                </div>
            </div>
        </div>
        @endif

        <div class="kt-portlet__body">

            <!--begin: Search Form -->
            <form class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10" method="GET">
                <div class="row align-items-center">
                    <div class="col-xl-12 order-2 order-xl-1">
                        <div class="row align-items-center">
                            <div class="col-xl-12 order-2 order-xl-1">
                                <div class="row align-items-center">
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Bill id:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input id="ebill_id" type="text" class="form-control" name="bill_id"
                                                value="{{ request()->input('bill_id') }}">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Transaction id:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input id="ebill_transaction_id" type="text" class="form-control" name="transaction_id"
                                                value="{{ request()->input('transaction_id') }}">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Account No:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input id="account_no" type="text" class="form-control" name="account_no"
                                                value="{{ request()->input('account_no') }}">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Amount:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input id="ebill_amount" type="text" class="form-control" name="amount"
                                                value="{{ request()->input('amount') }}">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>
                                    </div>
                                    {{-- @dump($partnerCodeList) --}}
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Partner code:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input list="listPartnerCode" type="text" class="form-control" id="partner_code" name="partner_code" value="{{ request()->input('partner_code')}}">
                                            <datalist id="listPartnerCode">
                                                @if(isset($partnerCodeList))
                                                @foreach($partnerCodeList as $listCode)
                                                <option value="{{$listCode->partner_code}}"></option>
                                                @endforeach
                                                @endif
                                            </datalist>
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    {{-- @dd($providerCodeList) --}}
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Provider Code:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input
                                            list="providerCodeList"
                                            id="ebill_providerCode"
                                            type="text"
                                            class="form-control"
                                            name="ebill_providerCode"
                                            value="{{ request()->input('ebill_providerCode') }}">

                                            <datalist id="providerCodeList">
                                                @if(isset($providerCodeList))
                                                @foreach($providerCodeList as $listProviderCode)
                                                <option value="{{$listProviderCode->provider_code}}"></option>
                                                @endforeach
                                                @endif
                                            </datalist>
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                        <label>Bill code:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input id="ebill_bill_code" type="text" class="form-control" name="billCode" value="{{ request()->input('billCode')}}">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                        <label>Type:</label>
                                        <div class="kt-input-icon ">
                                            <select id="ebill_type" type="text" class="form-control" name="type"
                                                value="{{ request()->input('type') }}">
                                                <option value="all" @if (request()->input('type') === 'all') selected="true" @endif>All</option>
                                                <option value="VA" @if (request()->input('type') === 'VA') selected="true" @endif>VA</option>
                                                <option value="CASH" @if (request()->input('type') === 'CASH') selected="true" @endif>CASH</option>
                                                <option value="IBANKING" @if (request()->input('type') === 'IBANKING') selected="true" @endif>IBANKING
                                                </option>
                                                <option value="VISA" @if (request()->input('type') === 'VISA') selected="true" @endif>VISA</option>
                                            </select>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                        <label>Status:</label>
                                        <div class="kt-input-icon ">
                                            <select id="ebill_status" type="text" class="form-control" name="status"
                                                value="{{ request()->input('status') }}">
                                                <option value="all" @if (request()->input('status') === 'all') selected="true" @endif>All</option>
                                                <option value="pending" @if (request()->input('status') === 'pending') selected="true" @endif>Pending</option>
                                                <option value="success" @if (request()->input('status') === 'success') selected="true" @endif>Success</option>
                                                <option value="refund" @if (request()->input('status') === 'refund') selected="true" @endif>Refund</option>
                                                <option value="error" @if (request()->input('status') === 'error') selected="true" @endif>Error</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                        <label>Provider Ref ID:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input id="ebill_provider_ref_id" type="text" class="form-control" name="provider_ref_id" value="{{ request()->input('provider_ref_id')}}">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                        <div class="form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Ngày bắt đầu:</label>
                                            </div>
                                            <input
                                            autocomplete="off"
                                            type='text'
                                            class="form-control"
                                            id="startTimeSearch"
                                            name="startTime"
                                             placeholder="Chọn thời gian bắt đầu" type="text"
                                                value="{{ request()->input('startTime') }}" />
                                        </div>
                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                        <div class="form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Ngày kết thúc:</label>
                                            </div>
                                            <input
                                            autocomplete="off" type='text' class="form-control" id="endTimeSearch" name="endTime"
                                             placeholder="Chọn thời gian kết thúc" type="text"
                                                value="{{ request()->input('endTime') }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                        <div class="form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>&nbsp;</label>
                                            </div>
                                            <button class="btn btn-primary" method="submit">Tìm Kiếm</button>
                                           {{--  <button id="exportTransaction" class="btn btn-success"
                                                method="submit">Export</button> --}}
                                                <button wire:click.prevent="$emit('ExportEbillTransactionScript')" class="btn btn-success">Export</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="kt-portlet__body kt-portlet__body--fit">
            <div class="row">
                <div class="col-12 d-flex justify-content-end pr-5">
                    <h5>Total amount:&nbsp;<span class="text-monospace field-total-amount">0</span></h5>
                </div>
            </div>
            @include('elements.alert_flash')
            <!--begin: Datatable -->
            <div class="kt-datatable" id="ajax_data"></div>

            <!--end: Datatable -->
        </div>
    </div>
</div>
