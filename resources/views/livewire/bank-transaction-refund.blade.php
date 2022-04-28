<div>
    <div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon2-line-chart"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                Danh sách giao dịch bank refund
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
                                        <input id="refund_transaction_id" type="text" class="form-control" name="transaction_id"
                                            value="{{ request()->input('transaction_id')}}">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <label>Order id:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input id="refund_order_id" type="text" class="form-control" name="order_id"
                                            value="{{ request()->input('order_id')}}">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <label>Vendor Ref ID:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input id="refund_vendor_ref_id" type="text" class="form-control" name="vendor_ref_id"
                                               value="{{ request()->input('vendor_ref_id')}}">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <label>Payment method:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input type="text" class="form-control" name="payment_method"
                                               id="payment_method" value="{{ request()->input('payment_method')}}">
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
                                    <label>Partner code:</label>
                                    <div class="kt-input-icon">
                                        <select class="form-control" name="partner_code" id="partner_code">
                                            <option></option>
                                        </select>
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
                                    <label>Status:</label>
                                    <div class="kt-input-icon">
                                        <select wire:ignore id="refund_transaction_status" type="text" class="form-control" name="refund_status"
                                                value="{{ request()->input('refund_status')}}">
                                            <option value="all" @if(request()->input('refund_status') === 'all') selected
                                                    @endif>All</option>
                                            <option value="pending" @if(request()->input('refund_status') === 'pending')
                                            selected @endif>pending</option>
                                            <option value="processing" @if(request()->input('refund_status') === 'processing')
                                            selected @endif>processing</option>
                                            <option value="success" @if(request()->input('refund_status') === 'success')
                                            selected @endif>success</option>
                                            <option value="cancelled" @if(request()->input('refund_status') === 'cancelled')
                                            selected @endif>cancelled</option>
                                            <option value="error" @if(request()->input('refund_status') === 'error')
                                            selected @endif>error</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <label>Refund type:</label>
                                    <div class="kt-input-icon">
                                        <select id="refund_transaction_type" type="text" class="form-control" name="refund_type"
                                            value="{{ request()->input('refund_type')}}">
                                            <option value="all" @if(request()->input('refund_type') === 'all') selected
                                                @endif>All</option>
                                            <option value="total" @if(request()->input('refund_type') === 'total')
                                                selected @endif>total</option>
                                            <option value="partial" @if(request()->input('refund_type') === 'partial')
                                                selected @endif>partial</option>
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
                                    <div class="form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>&nbsp;</label>
                                        </div>
                                        <button class="btn btn-primary" method="submit">Tìm Kiếm</button>
                                       {{--  <button id="exportTransaction" class="btn btn-success"
                                            method="submit">Export</button> --}}
                                            <a class="btn btn-success text-white" wire:click.prevent="$emit('ExportBankTranSactionScript')">Export</a>
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
        <div wire:ignore class="kt-datatable" id="ajax_data"></div>


        <!--end: Datatable -->

        {{-- change status modal --}}
        <div wire:ignore.self class="modal fade" id="changeStatusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Status Refund Success</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                @if(isset($message) and !$warning)
                <div class="row">
                    <div class="col">
                        <span class="alert alert-primary">{{$message}}</span>
                    </div>
                </div>
                @endif

                @if(isset($message) and $warning)
                <div class="row">
                    <div class="col">
                        <span class="alert alert-danger">{{$message}}</span>
                    </div>
                </div>
                @endif
                <div class="row" style="display: none;">
                    <div class="col">
                        <label for="refundID">Refund ID:</label>
                        <input type="text" id="changeStatusrefundID" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="Vendor Ref ID">Vendor Ref ID: </label>
                        <input type="text" class="form-control" id="refund_vendor_ref_id_change_status">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="status">Status</label>
                        <select wire:change.prevent="$emit('statusScript')" class="form-control" id="StatusChange">
                            <option value="success">Success</option>
                            <option value="error">Error</option>
                        </select>
                    </div>
                </div>
                <div wire:ignore class="row" style="display: none;" id="block_reject_reason">
                    <div class="col">
                        <label for="Reject Reason">Reject Reason: </label>
                        <input type="text" class="form-control" id="reject_reason" >
                    </div>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button wire:click.prevent="$emit('changeStatusrefundIDScript')" type="button" class="btn btn-primary">Change</button>
              </div>
            </div>
          </div>
        </div>
        {{-- end change status modal --}}
    </div>
</div>
</div>
