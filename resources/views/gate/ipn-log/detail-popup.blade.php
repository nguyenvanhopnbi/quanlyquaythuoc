<div class="modal fade" id="ipnLogId{{$detail->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-modal="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chi tiết ipn log</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Queue Id:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->queue_id}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Id:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->id}}</span>
                        </div>
                    </div>

                </div>
                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Method:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->method}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Type:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->type}}</span>
                        </div>
                    </div>
                </div>
             
                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Timestamp:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->timestamp}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Status:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span class="badge {{$detail->status_badge}}">{{$detail->status}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-12 row">
                        <div class="col-xl-3 col-md-3">
                            <label for="providerName" class="col-form-label label-popup">Respons:</label>
                        </div>
                        <div class="col-xl-9 col-md-9 span-value-popup">
                            <span>{{$detail->response}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-12 row">
                        <div class="col-xl-3 col-md-3">
                            <label for="providerName" class="col-form-label label-popup">Url:</label>
                        </div>
                        <div class="col-xl-9 col-md-9 span-value-popup">
                            <span>{{$detail->url}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-12 row">
                        <div class="col-xl-3 col-md-3">
                            <label for="providerName" class="col-form-label label-popup">Params:</label>
                        </div>
                        <div class="col-xl-9 col-md-9 span-value-popup">
                            <textarea disabled="true" class="col-xl-12 col-md-12" rows="10" cols="100">{{$detail->params}}</textarea>
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