<div class="modal fade" id="tranferMoneyTransactionId{{ $detail->transactionId }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document"
        x-data="{status: '{{ $detail->status }}', transfer_status: '{{ $detail->transferStatus }}'}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chi tiết giao dịch
                    @can('transfer-money-transaction-refund')
                        <button type="button" class="btn btn-danger" x-cloak
                            x-show="status == 'success' && transfer_status == 'pending'" x-on:click.prevent="
                            fetch('{{ route('gate.transfer.money.transaction.refund', ['transactionId' => $detail->transactionId]) }}')
                                .then(() => {
                                    swal.fire('Thành công', 'Giao dịch đã refund', 'success')
                                    status = 'refund'
                                })
                                .catch(() => swal.fire('Thất bại', 'Có lỗi xảy ra! Xin thử lại sau...', 'danger'))
                        ">Refund</button>
                    @endcan
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="" class="col-form-label label-popup">Transaction id:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{ $detail->transactionId }}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="" class="col-form-label label-popup">Partner ref id:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{ $detail->partnerRefId }}</span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="" class="col-form-label label-popup">Partner code:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{ $detail->partnerCode }}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="" class="col-form-label label-popup">Application Id/Name:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{ $detail->applicationId }}/{{ $detail->applicationName }}</span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="" class="col-form-label label-popup">Customer Phone number:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{ $detail->customerPhoneNumber }}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="" class="col-form-label label-popup">Bank Code:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{ $detail->bankCode }}</span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="" class="col-form-label label-popup">Account Number:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{ $detail->accountNo }}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="" class="col-form-label label-popup">Account Name:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{ $detail->accountName }}</span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="" class="col-form-label label-popup">Account Type:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{ $detail->accountType }}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="" class="col-form-label label-popup">Amount:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{ $detail->amount }}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="" class="col-form-label label-popup">Transfer Amount:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{ $detail->transferAmount }}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="" class="col-form-label label-popup">Fee:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{ $detail->fee }}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="" class="col-form-label label-popup">Contract Number:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{ $detail->contractNumber }}</span>
                        </div>
                    </div>

                </div>
                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="" class="col-form-label label-popup">Status:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span class="badge {{ $detail->status_badge }}">{{ $detail->status }}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="" class="col-form-label label-popup">Transfer Status:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span
                                class="badge {{ $detail->transfer_status_badge }}">{{ $detail->transferStatus }}</span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="" class="col-form-label label-popup">Error code:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{ $detail->errorCode }}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="" class="col-form-label label-popup">Error message:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{ $detail->errorMessage }}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">

                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="" class="col-form-label label-popup">Provider Ref Id:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{ $detail->providerRefId }}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="" class="col-form-label label-popup">Provider Code:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{ $detail->providerCode }}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="" class="col-form-label label-popup">Message:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{ $detail->message }}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="" class="col-form-label label-popup">Extra Data:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <textarea disabled="true" rows="5">{{ $detail->extraData }}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="" class="col-form-label label-popup">Request Time:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{ $detail->requestTime }}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="" class="col-form-label label-popup">Response Time:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{ $detail->responseTime }}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="" class="col-form-label label-popup">Provider Response Data::</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <textarea disabled="true" rows="10"
                                cols="70">{{ $detail->providerResponseData }}</textarea>
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
