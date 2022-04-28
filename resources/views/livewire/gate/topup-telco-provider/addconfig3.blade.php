<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div wire:ignore.self class="modal fade" id="addModalConfig3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new config 4</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                        <div class="form-group row" id="messageResultc3">
                            @if($messageResultC3)
                            <label class="alert alert-primary">{{$messageResultC3}}</label>
                            @endif
                        </div>
                        <div class="form-group row">
                            <label for="providerName" class="col-12 col-lg-12 col-xl-3 col-form-label">Telco <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                <div class="col-12 col-lg-12 col-xl-9">
                                    <select
                                        class="form-control"
                                        id="telcoaddconfig3"
                                        name="telcoconfig3"
                                        >
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
                                            <input style="border: 1px solid #ced4da;" type="text" list="providerCodeListConfig3"
                                            class="form-control" id="addProviderCodeConfig3">
                                            <datalist id="providerCodeListConfig3">
                                                @if(isset($providerCodeALL3))
                                                @foreach($providerCodeALL3 as $providercodeAddconfig3)
                                                <option
                                                value="{{$providercodeAddconfig3->providerCode}}">
                                                </option>
                                                @endforeach
                                                @endif
                                            </datalist>

                                        </div>
                        </div>

                        <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Telco service type <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <select class="form-control" id="telcoServiceTypeaddconfig3" name="telcoServiceTypeaddconfig3" >
                                                <option value="prepaid">prepaid</option>
                                                <option value="postpaid">postpaid</option>
                                            </select>
                                        </div>
                        </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click.prevent="$emit('addnewConfig444Script')" type="button" class="btn btn-primary">Save</button>
                  </div>
                </div>
              </div>
            </div>
</div>
