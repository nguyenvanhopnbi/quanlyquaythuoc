<div>
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
                                        <input type="text" class="form-control" id="input_bank_transaction_id" name="transaction_id"
                                            value="{{ request()->input('transaction_id') }}" >
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <label>Order id:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input
                                        id="order_id"
                                        type="text" class="form-control"
                                        name="order_id"
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
                                        <select id = "select-status" type="text" class="form-control" name="status"
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
                                           {{--  <option value="refund" @if (request()->input('status') === 'refund')
                                                selected @endif>Refund</option> --}}
                                            <option value="cancelled" @if (request()->input('status') === 'cancelled')
                                                selected @endif>Canceled</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <label>Amount: </label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input id="input-Amount" type="text" class="form-control" name="amount"
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
                                        <select class="form-control" id="payment_method" name="payment_method">
                                            <option value="">Chọn payment method..</option>
                                            @if(request()->input('payment_method'))
                                            <option selected value="{{request()->input('payment_method')}}">{{request()->input('payment_method')}}</option>
                                            @endif
                                            <option value="ATM">ATM</option>
                                            <option value="CC">CC</option>
                                            <option value="EWALLET">EWALLET</option>
                                            <option value="VA">VA</option>
                                            <option value="MM">Mobile money</option>

                                        </select>
                                        {{-- <input type="text" class="form-control" name="payment_method"
                                            id="payment_method" value="{{ request()->input('payment_method') }}">
                                        </span> --}}
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
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
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
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <label>Vendor Ref id:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input type="text" class="form-control" id="input_bank_vendor_ref_id" name="vendor_ref_id"
                                            value="{{ request()->input('vendor_ref_id') }}" >
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <label>Holding Status:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input list="holding_status_list" type="text" class="form-control" id="input_bank_holding_status" name="holding_status"
                                            value="{{ request()->input('holding_status') }}" >
                                        <datalist id="holding_status_list">
                                            <option value="all"></option>
                                            <option value="no"></option>
                                            <option value="holding"></option>
                                            <option value="un_hold"></option>
                                        </datalist>

                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <label>Has Refund:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <select name="hasRefund" id="hasRefund" class="form-control">
                                            <option @if(request()->input('hasRefund') == '' || request()->input('hasRefund') == null) {{'selected'}}  @endif value="">All</option>
                                            <option @if(request()->input('hasRefund') == '1') {{'selected'}}  @endif value="1">True</option>
                                            <option @if(request()->input('hasRefund') == '0') {{'selected'}}  @endif value="0">False</option>
                                        </select>

                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>

                                {{-- <livewire:export /> --}}
                                <div id="displayBlock" style="display: none;">
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="" id="transaction_id">
                                      <label class="form-check-label" for="flexCheckDefault">
                                        Transaction ID
                                      </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="" id="Order_info">
                                      <label class="form-check-label" for="flexCheckChecked">
                                        Order Info
                                      </label>
                                    </div>

                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <div class="form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>&nbsp;</label>
                                        </div>
                                        <button class="btn btn-primary" method="submit">
                                        Tìm Kiếm
                                        </button>
                                        <button id="select-columns" class="btn btn-success" type="button"
                                            data-toggle="modal" data-target="#select-column-modal">Export
                                        </button>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        {{-- End Form Search --}}

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
                                <input name="ck_transaction_id" type="checkbox" class="select-column-checkbox" :value="item" x-model="checked">
                                <span x-text="item"></span>
                            </label>
                        </div>
                    </template>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                {{-- <button id="exportTransaction" type="button" class="btn btn-primary btn-export"
                    x-bind:disabled="checked.length < 1 || is_exporting"
                    x-bind:class="{'kt-spinner kt-spinner--right kt-spinner--md kt-spinner--light': is_exporting}"
                    x-on:click="is_exporting = true" x-on:export-ready.window="is_exporting = false">Export</button> --}}
                    {{-- <livewire:export /> --}}
                    <a style="color: #FFFFFF;" class="btn btn-primary btn-export" wire:click="$emit('ExportCSV2')">Export</a>
                    {{-- <a class="btn btn-primary btn-export"  href="/exportCSV">Export</a> --}}
            </div>

        </div>
    </div>
</div>
</div>


