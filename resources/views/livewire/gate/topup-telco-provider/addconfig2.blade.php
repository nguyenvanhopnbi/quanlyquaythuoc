<div>
    {{-- Be like water. --}}
    <div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div wire:ignore.self class="modal fade" id="addModalConfig2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new config 1</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                        <div class="form-group row" id="messageResultc2">
                            @if($messageResultC2)
                            <label class="alert alert-primary">{{$messageResultC2}}</label>
                            @endif
                        </div>
                        <div class="form-group row">
                            <label for="providerName" class="col-12 col-lg-12 col-xl-3 col-form-label">Telco <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                <div class="col-12 col-lg-12 col-xl-9">
                                    <select
                                        class="form-control"
                                        id="telcoaddconfig2"
                                        name="telcoaddconfig2">
                                            <option selected="selected" value="viettel">Viettel</option>
                                            <option value="mobifone">Mobifone</option>
                                            <option value="vinaphone">Vinaphone</option>
                                            <option value="vnmobile">VNMobile</option>
                                            <option value="beeline">Beeline</option>
                                            <option value="viettel_data">Viettel Data</option>
                                            <option value="mobifone_data">Mobifone Data</option>
                                            <option value="vinaphone_data">Vinaphone Data</option>
                                            <option value="vnmobile_data">VNMobile Data</option>
                                            <option value="beeline_data">Beeline Data</option>
                                    </select>
                                </div>
                        </div>
                        <div class="form-group row">
                            <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Provider code
                                <span class="kt-font-danger">
                                    <i class="fa fa-xs fa-star"></i>
                                </span>
                            </label>
                            <div class="col-12 col-lg-12 col-xl-9">
                                <input type="text" list="providerCodeListConfig2" class="form-control" id="addProviderCodeConfig2">

                                    <datalist id="providerCodeListConfig2">
                                        @if(isset($providerCodeALL))
                                        @foreach($providerCodeALL as $providercodeAddconfig2)
                                        <option
                                        value="{{$providercodeAddconfig2->providerCode}}">
                                        </option>
                                        @endforeach
                                        @endif
                                    </datalist>

                            </div>
                        </div>

                        <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Telco service type <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <select class="form-control"
                                            id="telcoServiceTypeaddconfig2"
                                            name="telcoServiceTypeaddconfig2" >
                                                <option value="prepaid">prepaid</option>
                                                <option value="postpaid">postpaid</option>
                                            </select>
                                        </div>
                        </div>
                        <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Partner Code<span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <input list="partnerCodeAddConfig2" required type="text" class="form-control" name="parner_code_value" id="parner_code_value_addnewconfig2">
                                            <datalist id="partnerCodeAddConfig2">
                                                @if(isset($partnerCodeListAddConfig2))
                                                @foreach($partnerCodeListAddConfig2 as
                                                    $codeAddconfig2)
                                                <option value="{{$codeAddconfig2->partner_code}}"></option>
                                                @endforeach
                                                @endif
                                            </datalist>


                                        </div>
                        </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click.prevent="$emit('addnewConfig2Script')" type="button" class="btn btn-primary">Save</button>
                  </div>
                </div>
              </div>
            </div>
</div>

</div>
