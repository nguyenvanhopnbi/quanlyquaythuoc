<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon2-line-chart"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                Danh sách giao dịch
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
            </div>
        </div>
    </div>
    <div class="kt-portlet__body">

        <!--begin: Search Form -->
        <form class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10" method="GET">
            <div class="row align-items-center">
                <div class="col-xl-12 order-2 order-xl-1">
                    <div class="row align-items-center">
                        <div class="col-xl-12 order-2 order-xl-1">
                            <div class="row align-items-center">
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <label>Transaction id:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input id="topup_transaction_id" type="text" class="form-control" name="transaction_id"
                                            value="{{ request()->input('transaction_id')}}">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <label>Partner ref id:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input id="partner_ref_id" type="text" class="form-control" name="partner_ref_id"
                                            value="{{ request()->input('partner_ref_id')}}">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <label>Partner code:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <select class="form-control" name="partner_code" id="partner_code"></select>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <label>Application id:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <select class="form-control" name="application_id" id="application_id"></select>
                                    </div>
                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <label>Phone number:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input id="topup_phone_number" type="text" class="form-control" name="phone_number"
                                            value="{{ request()->input('phone_number')}}">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <label>Telco:</label>
                                    <select id="topup_Telco" class="form-control" name="telco" value="{{ request()->input('telco')}}">
                                        <option value="all" @if(request()->input('telco') === 'all') selected @endif>All
                                        </option>
                                        <option value="viettel" @if(request()->input('telco') === 'viettel') selected
                                            @endif>Viettel</option>
                                        <option value="mobifone" @if(request()->input('telco') === 'mobifone') selected
                                            @endif>Mobifone</option>
                                        <option value="vinaphone" @if(request()->input('telco') === 'vinaphone')
                                            selected @endif>Vinaphone</option>
                                        <option value="beeline" @if(request()->input('telco') === 'beeline') selected
                                            @endif>Beeline</option>
                                        <option value="vnmobile" @if(request()->input('telco') === 'vnmobile') selected
                                            @endif>VNMobile</option>
                                        <option value="viettel_data" @if(request()->input('telco') === 'viettel_data')
                                            selected @endif>Viettel Data</option>
                                        <option value="mobifone_data" @if(request()->input('telco') === 'mobifone_data')
                                            selected @endif>Mobifone Data</option>
                                        <option value="vinaphone_data" @if(request()->input('telco') ===
                                            'vinaphone_data') selected @endif> Vinaphone Data </option>
                                        <option value="vnmobile_data" @if(request()->input('telco') === 'vnmobile_data')
                                            selected @endif>VNMobile Data</option>
                                        <option value="beeline_data" @if(request()->input('telco') === 'beeline_data')
                                            selected @endif>Beeline Data</option>
                                    </select>

                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <label>Telco service type:</label>
                                    <select id="topup_telco_service_type" class="form-control" name="telco_service_type">
                                        <option value="all" @if(request()->input('telco_service_type') === 'all')
                                            selected @endif>All</option>
                                        <option value="prepaid" @if(request()->input('telco_service_type') ===
                                            'prepaid') selected @endif>Prepaid</option>
                                        <option value="postpaid" @if(request()->input('telco_service_type') ===
                                            'postpaid') selected @endif>Postpaid</option>
                                    </select>
                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <label>Status:</label>
                                    <div class="kt-input-icon ">
                                        <select id="t_status" type="text" class="form-control" name="status">
                                            <option value="all" @if(request()->input('status') === 'all')
                                                selected="true" @endif>All</option>
                                            <option value="pending" @if(request()->input('status') === 'pending')
                                                selected="true" @endif>pending</option>
                                            <option value="success" @if(request()->input('status') === 'success')
                                                selected="true" @endif>success</option>
                                            <option value="error" @if(request()->input('status') === 'error')
                                                selected="true" @endif>error</option>
                                            <option value="processing" @if(request()->input('status') === 'processing')
                                                selected="true" @endif>processing</option>
                                            <option value="refund" @if(request()->input('status') === 'refund')
                                                selected="true" @endif>refund</option>
                                            <option value="cancel" @if(request()->input('status') === 'cancel')
                                                selected="true" @endif>cancel</option>
                                        </select>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <label>Topup status:</label>
                                    <div class="kt-input-icon ">
                                        <select id="topup_status" type="text" class="form-control" name="topup_status">
                                            <option value="all" @if(request()->input('topup_status') === 'all')
                                                selected="true" @endif>All</option>
                                            <option value="pending" @if(request()->input('topup_status') === 'pending')
                                                selected="true" @endif>pending</option>
                                            <option value="success" @if(request()->input('topup_status') === 'success')
                                                selected="true" @endif>success</option>
                                            <option value="error" @if(request()->input('topup_status') === 'error')
                                                selected="true" @endif>error</option>
                                            <option value="processing" @if(request()->input('topup_status') ===
                                                'processing') selected="true" @endif>processing</option>
                                        </select>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <label>Amount:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input id="topup_amount" type="text" class="form-control" name="amount"
                                            value="{{ request()->input('amount')}}">
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
                                        <input type='text' class="form-control" id="kt_datepicker_1" name="startTime"
                                            readonly placeholder="Chọn thời gian bắt đầu" type="text"
                                            value="{{ request()->input('startTime')}}" />
                                    </div>
                                </div>

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <div class="form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>Ngày kết thúc:</label>
                                        </div>
                                        <input type='text' class="form-control" id="kt_datepicker_2" name="endTime"
                                            readonly placeholder="Chọn thời gian kết thúc" type="text"
                                            value="{{ request()->input('endTime')}}" />
                                    </div>
                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <label>Provider:</label>
                                    <select id="topup_provider" class="form-control" name="provider_code">
                                        <option value="all" @if(request()->input('provider_code') === 'all') selected
                                            @endif>All</option>
                                        @foreach($providers as $provider)
                                        <option @if(request()->input('provider_code') === $provider->providerCode)
                                            selected="true" @endif
                                            value="{{$provider->providerCode}}">{{$provider->providerCode}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <label>Provider ref id:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input id="topup_provider_ref_id" type="text" class="form-control" name="provider_ref_id"
                                            value="{{ request()->input('provider_ref_id') }}">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <div class="form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>&nbsp;</label>
                                        </div>
                                        <button class="btn btn-primary" method="submit">Tìm Kiếm</button>
                                        {{-- <button id="exportTransaction" class="btn btn-success"
                                            method="submit">Export</button> --}}
                                        <button wire:click.prevent="$emit('ExportTopUpTransactionScript')" class="btn btn-success">Export</button>
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
