<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div wire:ignore.self class="modal fade" id="addModalConfig1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add new config 1</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">


        <div class="form-group row" id="messageResultc1">
            @if(isset($messageResultC1))
            <label class="alert alert-primary">{{$messageResultC1}}</label>
            @endif
        </div>
        <div class="form-group row">
            <label for="providerName" class="col-12 col-lg-12 col-xl-3 col-form-label">Telco <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
            <div class="col-12 col-lg-12 col-xl-9">
                <select
                class="form-control"
                id="telcoaddconfig1"
                name="telcoconfig1"
                wire:change.prevent="$emit('getTelcoValueConfig1Script')">
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
            <input type="text" list="providerCodeListConfig1" class="form-control" id="addProviderCodeConfig1">

            <datalist id="providerCodeListConfig1">
                @if(isset($providerCodeALL))
                @foreach($providerCodeALL as $providercodeAddconfig1)
                <option
                value="{{$providercodeAddconfig1->providerCode}}">
            </option>
            @endforeach
            @endif
        </datalist>

    </div>
</div>
<div class="form-group row">
    <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Value <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
    <div class="col-12 col-lg-12 col-xl-9">
        <input type="text" list="addValueConfig1List" id="addValueConfig1" class="form-control">
        <datalist id="addValueConfig1List">
            @if(isset($telcoValueDatac1))
            @foreach($telcoValueDatac1 as $telcoc1)
            <option value="{{str_replace('.', '', $telcoc1)}}">{{$telcoc1}}</option>
            @endforeach
            @endif
        </datalist>
    </div>
</div>
<div class="form-group row">
    <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Telco service type <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
    <div class="col-12 col-lg-12 col-xl-9">
        <select class="form-control" id="telcoServiceTypeaddconfig1" name="telcoServiceType" >
            <option value="prepaid">prepaid</option>
            <option value="postpaid">postpaid</option>
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Partner Code<span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
    <div class="col-12 col-lg-12 col-xl-9">
        <input list="partnerCodeAddConfig1" required type="text" class="form-control" name="parner_code_value" id="parner_code_value_addnewconfig1">
        <datalist id="partnerCodeAddConfig1">
            @if(isset($partnerCodeListAddConfig1))
            @foreach($partnerCodeListAddConfig1 as
                $codeAddconfig1)
                <option value="{{$codeAddconfig1->partner_code}}"></option>
                @endforeach
                @endif
            </datalist>


        </div>
    </div>




</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button wire:click.prevent="$emit('addnewConfig1Script')" type="button" class="btn btn-primary">Save</button>

    <input type="hidden" value="{{$resultTimeout}}" id="resultTimeout">
</div>
</div>
</div>
</div>
</div>
