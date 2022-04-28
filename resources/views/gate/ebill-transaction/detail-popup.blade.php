<div class="modal fade" id="ebillTransactionId{{$detail->transaction_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chi tiết giao dịch ebill</h5>
               {{--  <button class="btn btn-primary" onclick="testFunc(document.getElementById('transaction_id').value, document.getElementById('bill_id').value)">TEST</button> --}}
                {{-- @livewire('detail-ebill-transaction') --}}
                <form action="{{route('gate.ebill-transaction.resendIPN')}}">
                    <input type="hidden" id="transaction_id" name="transaction_id"
                    value="{{@show_to_view($detail->transaction_id)}}">
                    <input type="hidden" id="bill_id" name="bill_id"
                    value="{{@show_to_view($detail->bill_id)}}">
                    <button
                    onclick="return confirm('Bạn có chắc chắn resendIPN?'); " class="btn btn-primary" style="margin-left: 20px;" type="submit">resendIPN </button>
                </form>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Transaction id:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{@show_to_view($detail->transaction_id)}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Bill id:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{@show_to_view($detail->bill_id)}}</span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Amount:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{@show_to_view($detail->amount)}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Type:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{@show_to_view($detail->type)}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Status:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span class="badge {{@show_to_view($detail->status_badge)}}">{{@show_to_view($detail->status)}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Bill code:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span class="badge {{@show_to_view($detail->bill_code)}}">{{@show_to_view($detail->bill_code)}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Account no:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span class="badge {{@show_to_view($detail->account_no)}}">{{@show_to_view($detail->account_no)}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Account name:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span class="badge {{@show_to_view($detail->account_name)}}">{{@show_to_view($detail->account_name)}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Partner code:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span class="badge {{@show_to_view($detail->partner_code)}}">{{@show_to_view($detail->partner_code)}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Application id:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span class="badge {{@show_to_view($detail->application_id)}}">{{@show_to_view($detail->application_id)}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Application name:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span class="badge {{@show_to_view($detail->application_name)}}">{{@show_to_view($detail->application_name)}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Provider code:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span class="badge {{@show_to_view($detail->provider_code)}}">{{@show_to_view($detail->provider_code)}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Provider Ref ID:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span class="badge {{@show_to_view($detail->provider_ref_id)}}">{{@show_to_view($detail->provider_ref_id)}}</span>
                        </div>
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Transaction time:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span class="badge {{@show_to_view($detail->transaction_time)}}">{{@show_to_view(date('d-m-Y H:i:s',$detail->transaction_time))}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Memo:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span class="badge {{@show_to_view($detail->memo)}}">{{@show_to_view($detail->memo)}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Created time:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span class="badge {{@show_to_view($detail->createdAt)}}">{{@show_to_view($detail->createdAt)}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Updated time:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span class="badge {{@show_to_view($detail->updatedAt)}}">{{@show_to_view($detail->updatedAt)}}</span>
                        </div>
                    </div>
                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-brand" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

