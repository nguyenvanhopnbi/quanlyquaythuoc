<div>
    {{-- Success is as dangerous as failure. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Danh sách giao dịch shopcard
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
                                            <input id="scTransaction_transaction_id" type="text" class="form-control" name="transaction_id" value="{{ request()->input('transaction_id')}}">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Partner ref id:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input id="sc_partner_ref_id" type="text" class="form-control" name="partner_ref_id" value="{{ request()->input('partner_ref_id')}}">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Partner code:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input id="sc_transaction_partner_code" type="text" class="form-control" name="partner_code" value="{{ request()->input('partner_code')}}">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Application id:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input id="sc_transaction_application_id" type="text" class="form-control" name="application_id" value="{{ request()->input('application_id')}}">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                        <label>Amount:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input id="sc_transaction_amount" type="text" class="form-control" name="amount" value="{{ request()->input('amount')}}">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                        <label>Status:</label>
                                        <div class="kt-input-icon ">
                                            <select id="sc_transaction_status" type="text" class="form-control" name="status">
                                                <option value="all"@if(request()->input('status') === 'all') selected="true" @endif>All</option>
                                                <option value="pending" @if(request()->input('status') === 'pending') selected="true" @endif>pending</option>
                                                <option value="success"  @if(request()->input('status') === 'success') selected="true" @endif>success</option>
                                                <option value="error"  @if(request()->input('status') === 'error') selected="true" @endif>error</option>
                                                <option value="processing"  @if(request()->input('status') === 'processing') selected="true" @endif>processing</option>
                                                <option value="refund"  @if(request()->input('status') === 'refund') selected="true" @endif>refund</option>
                                                <option value="cancel"  @if(request()->input('status') === 'cancel') selected="true" @endif>cancel</option>
                                            </select>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                        <label>Vendor:</label>
                                        <div class="kt-input-icon">
                                            <select id="sc_transaction_vendor" type="text" class="form-control" name="vendor" value="{{ request()->input('vendor')}}">
                                                <option value="all" @if(request()->input('vendor') ==='all') selected="true" @endif>All</option>
                                                <option value="appota" @if(request()->input('vendor') ==='appota') selected="true" @endif>Appota</option>
                                                <option value="viettel" @if(request()->input('vendor') ==='viettel') selected="true" @endif>Viettel</option>
                                                <option value="mobifone" @if(request()->input('vendor') ==='mobifone') selected="true" @endif>Mobifone</option>
                                                <option value="vinaphone" @if(request()->input('vendor') ==='vinaphone') selected="true" @endif>Vinaphone</option>
                                                <option value="vnmobile" @if(request()->input('vendor') ==='vnmobile') selected="true" @endif>VNMobile</option>
                                                <option value="beeline" @if(request()->input('vendor') ==='beeline') selected="true" @endif>Beeline</option>
                                                <option value="zing" @if(request()->input('vendor') ==='zing') selected="true" @endif>Zing</option>
                                                <option value="vcoin" @if(request()->input('vendor') ==='vcoin') selected="true" @endif>VCoin</option>
                                                <option value="gate" @if(request()->input('vendor') ==='gate') selected="true" @endif>Gate</option>
                                                <option value="garena" @if(request()->input('vendor') ==='garena') selected="true" @endif>Garena</option>
                                                <option value="megacard" @if(request()->input('vendor') ==='megacard') selected="true" @endif>MegaCard</option>
                                                <option value="scoin" @if(request()->input('vendor') ==='scoin') selected="true" @endif>SCoin</option>
                                                <option value="oncash"  @if(request()->input('vendor') ==='oncash') selected="true" @endif>OnCash</option>
                                                <option value="soha" @if(request()->input('vendor') ==='soha') selected="true" @endif>Soha</option>
                                                <option value="funtap" @if(request()->input('vendor') ==='funtap') selected="true" @endif>Funtap</option>
                                                <option value="viettel_data" @if(request()->input('vendor') ==='viettel_data') selected="true" @endif>Viettel Data</option>
                                                <option value="mobifone_data" @if(request()->input('vendor') ==='mobifone_data') selected="true" @endif>Mobifone Data</option>
                                                <option value="vinaphone_data" @if(request()->input('vendor') ==='vinaphone_data') selected="true" @endif>Vinaphone Data</option>
                                            </select>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                        <div class="form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Ngày bắt đầu:</label>
                                            </div>
                                            <input type='text' class="form-control" id="kt_datepicker_1" name="startTime" readonly placeholder="Chọn thời gian bắt đầu" type="text" value="{{ request()->input('startTime')}}"/>
                                        </div>
                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                        <div class="form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Ngày kết thúc:</label>
                                            </div>
                                            <input type='text' class="form-control" id="kt_datepicker_2" name="endTime" readonly placeholder="Chọn thời gian kết thúc" type="text" value="{{ request()->input('endTime')}}" />
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                        <div class="form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>&nbsp;</label>
                                            </div>
                                            <button class="btn btn-primary" method="submit">Tìm Kiếm</button>
                                            {{-- <button id="exportTransaction" class="btn btn-success" method="submit">Export</button> --}}
                                            <button wire:click.prevent="$emit('ExportShopCardTransactionScript')" class="btn btn-success">Export</button>
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
