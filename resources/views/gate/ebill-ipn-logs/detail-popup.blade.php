<div class="modal fade" id="ebillIpnId{{ $detail->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chi tiết nhật ký Ebill Ipn</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-md-4">
                            <label for="providerName" class="col-form-label label-popup">Transaction id:</label>
                        </div>
                        <div class="col-md-8 span-value-popup">
                            <span>{{ @show_to_view($detail->transaction_id) }}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 row">
                        <div class="col-md-4">
                            <label for="providerName" class="col-form-label label-popup">Ebill id:</label>
                        </div>
                        <div class="col-md-8 span-value-popup">
                            <span>{{ @show_to_view($detail->ebill_id) }}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-md-4">
                            <label for="providerName" class="col-form-label label-popup">URL:</label>
                        </div>
                        <div class="col-md-8 span-value-popup">
                            <span class="badge text-wrap text-break">{{ @show_to_view($detail->url) }}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 row">
                        <div class="col-md-4">
                            <label for="providerName" class="col-form-label label-popup">Method:</label>
                        </div>
                        <div class="col-md-8 span-value-popup">
                            <span class="badge">{{ @show_to_view($detail->method) }}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-12 row">
                        <div class="col-md-2">
                            <label class="col-form-label label-popup">Params:</label>
                        </div>

                        <div class="col-md-10 span-value-popup">
                            <textarea class="form-control" rows="4">{{ @show_to_view($detail->params) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-12 row">
                        <div class="col-md-2">
                            <label class="col-form-label label-popup">Response:</label>
                        </div>

                        <div class="col-md-10 span-value-popup">
                            <textarea class="form-control" rows="4">{{ @show_to_view($detail->response) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-md-4">
                            <label for="providerName" class="col-form-label label-popup">Status:</label>
                        </div>
                        <div class="col-md-8 span-value-popup">
                            <span
                                class="badge {{ @show_to_view($detail->status_badge) }}">{{ @show_to_view($detail->status) }}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 row">
                        <div class="col-md-4">
                            <label for="providerName" class="col-form-label label-popup">Ngày giao dịch:</label>
                        </div>
                        <div class="col-md-8 span-value-popup">
                            <span
                                class="badge {{ @show_to_view($detail->bill_code) }}">{{ @show_to_view($detail->timestamp) }}</span>
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
