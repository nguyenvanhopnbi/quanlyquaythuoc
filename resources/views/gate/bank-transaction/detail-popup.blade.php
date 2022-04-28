{{-- @dump($detail) --}}
<div class="modal fade" id="bankTransactionId{{$detail->transaction_id}}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-modal="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chi tiết giao dịch</h5>
                @if($detail->status === 'success')
                    @can('resend-action-gate-transaction')
                    <button class="btn btn-primary btn-resend-ipn"
                            style="margin-left: 2%;width:84px;font-size: smaller;"
                            data-transaction-id="{{$detail->transaction_id}}">Resend IPN
                    </button>
                    @endcan
                    @can('refund-action-gate-transaction')
                    <a href="/gate-transactions/refund/popup?transaction_id={{$detail->transaction_id}}&max_amount={{$detail->default_amount}}&bank_code={{$detail->bank_code}}"
                       class="btn btn-dark btn-open-refund"
                       style="cursor:pointer;color:white;margin-left: 1%;width:84px;font-size: smaller;"
                       data-amount="{{$detail->default_amount}}" data-transaction-id="{{$detail->transaction_id}}">Refund</a>
                    @endcan
                    @can('hold-action-gate-transaction')
                    <a href="/gate-transactions/holding/popup?transaction_id={{$detail->transaction_id}}"
                       class="btn btn-dark btn-open-refund"
                       style="cursor:pointer;color:white;margin-left: 1%;width:84px;font-size: smaller;"
                       data-amount="{{$detail->default_amount}}" data-transaction-id="{{$detail->transaction_id}}">Holding</a>
                    @endcan
                    @can('unhold-action-gate-transaction')
                        @if(isset($detail->holding_status))
                            @if($detail->holding_status == 'holding')
                                <a href="/gate-transactions/unholding/popup?transaction_id={{$detail->transaction_id}}"
                                   class="btn btn-dark btn-open-refund"
                                   style="cursor:pointer;color:white;margin-left: 1%;width:84px;font-size: smaller;"
                                   data-amount="{{$detail->default_amount}}"
                                   data-transaction-id="{{$detail->transaction_id}}">
                                    Unhold
                                </a>
                            @endif
                        @endif
                    @endcan
                @endif
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Transaction Id:</label>
                        </div>
                        {{-- @dump($detail) --}}
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->transaction_id}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Partner code:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->partner_code}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Order id:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->order_id}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Bank code:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{(isset($detail->va_transaction->bank_code))?$detail->va_transaction->bank_code:$detail->bank_code}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Amount:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->amount}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Application Id/Name:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->application_id}}/{{$detail->application_name}}</span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Status:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span class="text-white badge {{$detail->status_badge}}">{{$detail->status}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Payment method:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->payment_method}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">

                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Vendor ref id:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->vendor_ref_id}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Payment type:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->payment_type}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Client Ip:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->client_ip}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Vendor code:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->vendor_code}}</span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Error code:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->error_code}}</span>
                        </div>
                    </div>


                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Order info:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->order_info}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Error message:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->error_message}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Token:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{(isset($detail->token))?$detail->token:''}}</span>
                        </div>
                    </div>
                </div>

                {{-- @dump($detail) --}}

                @if(isset($detail->va_transaction->bank_name))
                    <div class="form-group row">
                        <div class="col-lg-6 row">
                            <div class="col-xl-6 col-md-6">
                                <label for="providerName" class="col-form-label label-popup">Bank Name:</label>
                            </div>
                            <div class="col-xl-6 col-md-6 span-value-popup">
                                <span>{{(isset($detail->va_transaction->bank_name))?$detail->va_transaction->bank_name:''}}</span>
                            </div>
                        </div>
                        <div class="col-lg-6 row">
                            <div class="col-xl-6 col-md-6">
                                <label for="providerName" class="col-form-label label-popup">Account No:</label>
                            </div>
                            <div class="col-xl-6 col-md-6 span-value-popup">
                                <span>{{(isset($detail->va_transaction->account_no))?$detail->va_transaction->account_no:''}}</span>
                            </div>
                        </div>
                    </div>



                    <div class="form-group row">
                        <div class="col-lg-6 row">
                            <div class="col-xl-6 col-md-6">
                                <label for="providerName" class="col-form-label label-popup">Account Name:</label>
                            </div>
                            <div class="col-xl-6 col-md-6 span-value-popup">
                                <span>{{(isset($detail->va_transaction->account_name))?$detail->va_transaction->account_name:''}}</span>
                            </div>
                        </div>
                        <div class="col-lg-6 row">
                            <div class="col-xl-6 col-md-6">
                                <label for="providerName" class="col-form-label label-popup">Paid Amount:</label>
                            </div>
                            <div class="col-xl-6 col-md-6 span-value-popup">
                                <span>{{(isset($detail->va_transaction->paid_amount))?$detail->va_transaction->paid_amount:''}}</span>
                            </div>
                        </div>
                    </div>
                @endif


                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Action:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{(isset($detail->action))?$detail->action:''}}</span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Ngày giao dịch:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->request_time}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Response time:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->response_time}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-12 row">
                        <div class="col-xl-3 col-md-3">
                            <label for="providerName" class="col-form-label label-popup">Vendor callback data:</label>
                        </div>
                        <div class="col-xl-9 col-md-9 span-value-popup">
                            <textarea disabled="true" class="col-xl-12 col-md-12" rows="5"
                                      cols="120">{{$detail->vendor_callback_data}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12 row">
                        <div class="col-xl-3 col-md-3">
                            <label for="providerName" class="col-form-label label-popup">Extra data:</label>
                        </div>
                        <div class="col-xl-9 col-md-9 span-value-popup">
                            <textarea disabled="true" class="col-xl-12 col-md-12" rows="5"
                                      cols="120">{{$detail->extra_data}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12 row">
                        <div class="col-xl-3 col-md-3">
                            <label for="providerName" class="col-form-label label-popup">Extra info:</label>
                        </div>
                        <div class="col-xl-9 col-md-9 span-value-popup">
                            <textarea disabled="true" class="col-xl-12 col-md-12" rows="5"
                                      cols="120">{{$detail->extra_info}}</textarea>
                        </div>
                    </div>
                </div>
                @if(isset($detail->refund_transactions))
                @if(count($detail->refund_transactions) > 0)
                    <div class="form-group row justify-content-center">
                        <div class="col-lg-11 row">
                            <table class="table table-striped table-bordered" style="font-size: 1em !important;">
                                <thead class="thead-dark">
                                    <td>Refund Id</td>
                                    <td>Status</td>
                                    <td>Refund Amount</td>
                                    <td>Refund Type</td>
                                    <td>Reason</td>
                                    <td>Vendor Refund Id</td>
                                    <td>Time</td>
                                </thead>
                                <tbody>
                                @foreach($detail->refund_transactions as $refund_item)
                                    <tr>
                                        <td> {{ $refund_item->refund_id }}</td>
                                        <td> <span class="text-white badge {{$refund_item->status_badge}}">{{$refund_item->status}}</span></td>
                                        <td> {{ $refund_item->refund_amount }}</td>
                                        <td> {{ $refund_item->refund_type }}</td>
                                        <td> {{ $refund_item->reason }}</td>
                                        <td> {{ $refund_item->vendor_refund_id }}</td>
                                        <td> {{ $refund_item->time_refund }}</td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                @endif
                @endif

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-brand" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
