<div class="modal fade" id="shopcardItemId{{$detail->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chi tiết card item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Serial:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->serial}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Vendor:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->vendor}}</span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Expiry:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->expiry}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Value:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->value}}</span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Sold:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span class="badge {{$detail->sold_badge}}">{{$detail->sold}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Public:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span class="badge {{$detail->public_badge}}">{{$detail->public}}</span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Created at:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->createdAt}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Updated at:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->updatedAt}}</span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Code:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <textarea disabled="true" rows="5" cols="70">{{$detail->code}}</textarea>
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