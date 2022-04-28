<div>
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
                                            <input id="partner_transaction_id" type="text" class="form-control" name="transaction_id" value="{{ request()->input('transaction_id')}}">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Partner code:</label>
                                        <select class="form-control" name="partner_code" id="partner_code">
                                            <option></option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Amount:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input id="partner_amount" type="text" class="form-control" name="amount" value="{{ request()->input('amount')}}">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Reason:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input id="partner_reason" type="text" class="form-control" name="reason" value="{{ request()->input('reason')}}">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                        <label>Type:</label>
                                        <select id="partner_type" class="form-control" name="type" value="{{ request()->input('type')}}">>
                                            <option value="all" @if(request()->input('type') === 'all') selected @endif>All</option>
                                            <option value="credited" @if(request()->input('type') === 'credited') selected @endif>Credited</option>
                                            <option value="debited" @if(request()->input('type') === 'debited') selected @endif>Debited</option>
                                            <option value="topup" @if(request()->input('type') === 'topup') selected @endif>Topup</option>
                                            <option value="refund_topup" @if(request()->input('type') === 'refund_topup') selected @endif>Refund topup</option>
                                            <option value="paybill" @if(request()->input('type') === 'paybill') selected @endif>Paybill</option>
                                            <option value="refund_paybill" @if(request()->input('type') === 'refund_paybill') selected @endif>Refund paybill</option>
                                            <option value="buycard" @if(request()->input('type') === 'buycard') selected @endif>Buy card</option>
                                            <option value="refund_buycard" @if(request()->input('type') === 'refund_buycard') selected @endif>Refund buy card</option>
                                        </select>
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
                                           {{--  <button id="exportTransaction" class="btn btn-success" method="submit">Export</button> --}}
                                            <a
                                            wire:click.prevent="$emit('ExportPartnerTransactionScript')"
                                            class="btn btn-success"
                                            style="color:#FFF">Export</a>
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
        @include('elements.alert_flash')
        <!--begin: Datatable -->
            <div class="kt-datatable" id="ajax_data"></div>

            <!--end: Datatable -->
        </div>
    </div>
</div>
