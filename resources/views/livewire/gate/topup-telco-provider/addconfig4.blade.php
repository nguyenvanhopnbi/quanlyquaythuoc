<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div wire:ignore.self class="modal fade" id="addModalConfig4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new config 3</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                        <div class="form-group row" id="messageResultc4">
                            @if($messageResultC4)
                            <label class="alert alert-primary">{{$messageResultC4}}</label>
                            @endif
                        </div>
                        <div class="form-group row">
                            <label for="providerName" class="col-12 col-lg-12 col-xl-3 col-form-label">Telco <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                <div class="col-12 col-lg-12 col-xl-9">
                                    <select
                                        class="form-control"
                                        id="telcoaddconfig4"
                                        name="telcoconfig4"
                                        wire:change.prevent="$emit('getTelcoValueConfig4Script')"
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
                                            <input type="text" list="providerCodeListConfig4" class="form-control" id="addProviderCodeConfig4">

                                    <datalist id="providerCodeListConfig4">
                                        @if(isset($providerCodeALL4))
                                        @foreach($providerCodeALL4 as $providercodeAddconfig4)
                                        <option
                                        value="{{$providercodeAddconfig4->providerCode}}">
                                        </option>
                                        @endforeach
                                        @endif
                                    </datalist>

                                        </div>
                        </div>
                        <div class="form-group row">
                                <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Value <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                <div class="col-12 col-lg-12 col-xl-9">
                                    <input type="text" list="addValueConfig4List" id="addValueConfig4" class="form-control">
                                    <datalist id="addValueConfig4List">
                                        @if(isset($telcoValueDatac4))
                                        @foreach($telcoValueDatac4 as $telcoc4)
                                        <option value="{{str_replace('.', '', $telcoc4)}}">{{$telcoc4}}</option>
                                        @endforeach
                                        @endif
                                    </datalist>
                                </div>
                        </div>
                        <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Telco service type <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <select class="form-control" id="telcoServiceTypeaddconfig4" name="telcoServiceType4" >
                                                <option value="prepaid">prepaid</option>
                                                <option value="postpaid">postpaid</option>
                                            </select>
                                        </div>
                        </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click.prevent="$emit('addnewConfig3Script')" type="button" class="btn btn-primary">Save</button>
                  </div>
                </div>
              </div>
            </div>
</div>
