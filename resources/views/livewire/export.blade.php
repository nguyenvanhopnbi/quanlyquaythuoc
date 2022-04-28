<div>
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






