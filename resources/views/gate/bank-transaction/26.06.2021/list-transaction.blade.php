@extends('index')
@section('page-header', 'Banks transaction')
@section('page-sub-header', 'Danh sách giao dịch bank')
@section('style')

@endsection
@section('content')
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon2-line-chart"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                Danh sách giao dịch bank
            </h3>
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
                                        <input type="text" class="form-control" name="transaction_id"
                                            value="{{ request()->input('transaction_id') }}">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <label>Order id:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input type="text" class="form-control" name="order_id"
                                            value="{{ request()->input('order_id') }}">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <label>Partner code:</label>
                                    <div class="kt-input-icon">
                                        <select class="form-control" name="partner_code" id="partner_code">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <label>Status:</label>
                                    <div class="kt-input-icon">
                                        <select type="text" class="form-control" name="status"
                                            value="{{ request()->input('status') }}">
                                            <option value="all" @if (request()->input('status') === 'all') selected
                                                @endif>All</option>
                                            <option value="pending" @if (request()->input('status') === 'pending')
                                                selected @endif>Pending</option>
                                            <option value="success" @if (request()->input('status') === 'success')
                                                selected @endif>Success</option>
                                            <option value="error" @if (request()->input('status') === 'error') selected
                                                @endif>Error</option>
                                            <option value="processing" @if (request()->input('status') === 'processing')
                                                selected @endif>Processing</option>
                                            <option value="refund" @if (request()->input('status') === 'refund')
                                                selected @endif>Refund</option>
                                            <option value="cancelled" @if (request()->input('status') === 'cancelled')
                                                selected @endif>Canceled</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <label>Amount:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input type="text" class="form-control" name="amount"
                                            value="{{ request()->input('amount') }}">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <label>Bank code:</label>
                                    <div class="kt-input-icon">
                                        <select type="text" class="form-control" name="bank_code" id="bank_code">
                                            <option></option>
                                        </select>
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
                                            value="{{ request()->input('startTime') }}" />
                                    </div>
                                </div>

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <div class="form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>Ngày kết thúc:</label>
                                        </div>
                                        <input type='text' class="form-control" id="kt_datepicker_2" name="endTime"
                                            readonly placeholder="Chọn thời gian kết thúc" type="text"
                                            value="{{ request()->input('endTime') }}" />
                                    </div>
                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <label>Application:</label>
                                    <div class="kt-input-icon">
                                        <select type="text" class="form-control" name="application_id"
                                            id="application_id">
                                            <option></option>
                                        </select>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <label>Payment method:</label>
                                    <div class="kt-input-icon">
                                        <input type="text" class="form-control" name="payment_method"
                                            id="payment_method" value="{{ request()->input('payment_method') }}">
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <div class="form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>Client IP:</label>
                                        </div>
                                        <input type='text' class="form-control" id="client_ip" name="client_ip"
                                            type="text" value="{{ request()->input('client_ip') }}" />
                                    </div>
                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <div class="form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>Order info:</label>
                                        </div>
                                        <input type='text' class="form-control" id="order_info" name="order_info"
                                            type="text" value="{{ request()->input('order_info') }}" />
                                    </div>
                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <div class="form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>Vendor Code:</label>
                                        </div>
                                        <select class="form-control" id="vendor_code" name="vendor_code" type="text"
                                            value="{{ request()->input('vendor_code') }}">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <div class="form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>&nbsp;</label>
                                        </div>
                                        <button class="btn btn-primary" method="submit">Tìm Kiếm</button>
                                        {{-- <button id="exportTransaction" class="btn btn-success" method="submit">Export 2</button> --}}
                                        <button id="select-columns" class="btn btn-success" type="button"
                                            data-toggle="modal" data-target="#select-column-modal">Export</button>
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

<!-- Modal -->
<div class="modal fade" id="select-column-modal" tabindex="-1" aria-labelledby="select-column-modal-label"
    aria-hidden="true">
    <div class="modal-dialog" x-data="{
            is_exporting: false,
            checked: [],
            items: [],
            bulkAction() {
                this.checked = this.checked.length ? [] : this.items
            },
            get bulkText() {
                return this.checked.length ? 'Chọn tất cả' : 'Bỏ chọn'
            },
            get alertText() {
                return this.checked.length ? '&nbsp;' : 'Chọn ít nhất 1'
            }
        }" x-init="
            fetch('/gate-bank-transaction/list-export-columns')
                .then(response => response.text())
                .then(data => { items = JSON.parse(data); checked = items })
        ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="select-column-modal-label">Chọn cột</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <button class="btn btn-primary" x-on:click="bulkAction" x-text="bulkText">select all</button>
                <p class="text-danger my-3" x-html="alertText"></p>
                <div class="row">
                    <template x-for="(item, index) in items" :key="index">
                        <!-- You can also reference "index" inside the iteration if you need. -->
                        <div class="form-group col-6">
                            <label>
                                <input type="checkbox" class="select-column-checkbox" :value="item" x-model="checked">
                                <span x-text="item"></span>
                            </label>
                        </div>
                    </template>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button id="exportTransaction" type="button" class="btn btn-primary btn-export"
                    x-bind:disabled="checked.length < 1 || is_exporting"
                    x-bind:class="{'kt-spinner kt-spinner--right kt-spinner--md kt-spinner--light': is_exporting}"
                    x-on:click="is_exporting = true" x-on:export-ready.window="is_exporting = false">Export</button>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    var partnerCode = "{{ request()->input('partner_code') }}";
    var bankCode = "{{ request()->input('bank_code') }}";
    var applicationId = "{{ request()->input('application_id') }}";
    var vendorCode = "{{ request()->input('vendor_code') }}";

</script>
@section('script')
<!--begin::Page Vendors(used by this page) -->


<!--end::Page Vendors -->
<script src="assets/js/pages/crud/forms/widgets/select2.js" type="text/javascript" defer></script>
<script src="assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript" defer></script>
<script src="admin/js/pages/gate/bank-transaction/index.js?v1.5" type="text/javascript" defer></script>
<script src="admin/js/pusher.min.js"></script>
@endsection
