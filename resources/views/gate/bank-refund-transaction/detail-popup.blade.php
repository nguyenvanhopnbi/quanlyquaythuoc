<div class="modal fade" id="bankTransactionId{{$detail->refund_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-modal="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chi tiết giao dịch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-xl-6 col-md-6">
                                <label for="providerName" class="col-form-label label-popup">Transaction Id:</label>
                            </div>
                            <div class="col-xl-6 col-md-6 span-value-popup">
                                <span>{{$detail->transaction_id}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-md-6">
                                <label for="providerName" class="col-form-label label-popup">Amount:</label>
                            </div>
                            <div class="col-xl-6 col-md-6 span-value-popup">
                                <span>{{$detail->amount}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-md-6">
                                <label for="providerName" class="col-form-label label-popup">Refund Id:</label>
                            </div>
                            <div class="col-xl-6 col-md-6 span-value-popup">
                                <span>{{$detail->refund_id}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-md-6">
                                <label for="providerName" class="col-form-label label-popup">Refund Amount:</label>
                            </div>
                            <div class="col-xl-6 col-md-6 span-value-popup">
                                <span>{{$detail->refund_amount}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-md-6">
                                <label for="providerName" class="col-form-label label-popup">Status:</label>
                            </div>
                            <div class="col-xl-6 col-md-6 span-value-popup">
                                <span class="text-white badge {{$detail->status_badge}}">{{$detail->status}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-md-6">
                                <label for="providerName" class="col-form-label label-popup">Refund Type:</label>
                            </div>
                            <div class="col-xl-6 col-md-6 span-value-popup">
                                <span>{{$detail->refund_type}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-md-6">
                                <label for="providerName" class="col-form-label label-popup">Reason:</label>
                            </div>
                            <div class="col-xl-6 col-md-6 span-value-popup">
                                <span>{{$detail->reason}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-md-6">
                                <label for="providerName" class="col-form-label label-popup">Vendor refund id:</label>
                            </div>
                            <div class="col-xl-6 col-md-6 span-value-popup">
                                <span>{{$detail->vendor_refund_id}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-xl-6 col-md-6">
                                <label for="providerName" class="col-form-label label-popup">Partner Code:</label>
                            </div>
                            <div class="col-xl-6 col-md-6 span-value-popup">
                                <span>{{$detail->partner_code}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-md-6">
                                <label for="providerName" class="col-form-label label-popup">Bank Code:</label>
                            </div>
                            <div class="col-xl-6 col-md-6 span-value-popup">
                                <span>{{$detail->bank_code}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-md-6">
                                <label for="providerName" class="col-form-label label-popup">Vendor Code:</label>
                            </div>
                            <div class="col-xl-6 col-md-6 span-value-popup">
                                <span>{{$detail->vendor_code}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-md-6">
                                <label for="providerName" class="col-form-label label-popup">Payment Method:</label>
                            </div>
                            <div class="col-xl-6 col-md-6 span-value-popup">
                                <span>{{$detail->payment_method}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-12 row">
                            <div class="col-lg-3">
                                <label for="providerName" class="col-form-label label-popup">Vendor callback data:</label>
                            </div>
                            <div class="col-lg-9 span-value-popup">
                            <textarea disabled="true" class="col-xl-12 col-md-12" rows="5"
                                      cols="120">{{$detail->vendor_callback_data}}</textarea>
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
