
<div class="modal fade" id="billTransactionId{{$detail->transaction_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chi tiết bill transaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Mã giao dịch:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->transaction_id}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Mã giao dịch đối tác:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->partner_ref_id}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Mã đối tác:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->partner_code}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Mã bill:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->bill_code}}</span>
                        </div>
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Bill id:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->bill_id}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Mệnh giá bill:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->bill_amount}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Mệnh giá:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->amount}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Trạng thái bill:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span class="badge {{$detail->status_bill_badge}}">{{$detail->bill_status}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Trạng thái:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span class="badge {{$detail->status_badge}}">{{$detail->status}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Application Id:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span class="badge {{$detail->status_badge}}">{{$detail->application_id}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Phần trăm chiết khấu:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->discount_percent}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Mã Nhà Cung Cấp Dịch Vụ:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->provider_service_code}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Mã dịch vụ:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->service_code}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Mã nhà cung cấp:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->provider_code}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">REF ID Nhà Cung Cấp:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->provider_ref_id}}</span>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Mã Trạng Thái:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->status_code}}</span>
                        </div>
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Thời Gian Yêu Cầu:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->request_time}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Thời Gian Phản Hồi:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->response_time}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Status message:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail->status_message}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-12 row">
                        <div class="col-xl-3 col-md-3">
                            <label for="providerName" class="col-form-label label-popup">Provider bill info:</label>
                        </div>
                        <div class="col-xl-9 col-md-9 span-value-popup">
                            <textarea  disabled="true" class="col-xl-12 col-md-12" rows="5" cols="120">{{$detail->provider_bill_info}}</textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-12 row">
                        <div class="col-xl-3 col-md-3">
                            <label for="providerName" class="col-form-label label-popup">Provider response data:</label>
                        </div>
                        <div class="col-xl-9 col-md-9 span-value-popup">
                            <textarea  disabled="true" class="col-xl-12 col-md-12" rows="5" cols="120">{{$detail->provider_response_data}}</textarea>
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
