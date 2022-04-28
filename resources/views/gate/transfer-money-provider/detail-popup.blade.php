<div class="modal fade" id="tranferMoneyProviderId{{$detail->providerId}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chi tiết Provider</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="" class="col-form-label label-popup">Provider ID:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->providerId}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="" class="col-form-label label-popup">Provider Name:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->providerName}}</span>
                        </div>
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="" class="col-form-label label-popup">Created At:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->createdAt}}</span>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="" class="col-form-label label-popup">Last Update:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->updatedAt}}</span>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="" class="col-form-label label-popup">Secret Key:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->secretKey}}</span>
                        </div>
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Rsa Private Key:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <textarea disabled="true" rows="5" cols="70">{{$detail->rsaPrivateKey}}</textarea>
                        </div>
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Rsa Public Key:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <textarea disabled="true" rows="5" cols="70">{{$detail->rsaPublicKey}}</textarea>
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