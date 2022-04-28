<div>
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Import ebill virtual account provider
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    {{-- <button
                    wire:click.prevent="$emit('ExportCSVDoiSoatProviderScript')"
                    class="btn btn-primary">Export CSV</button> --}}
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            @if(isset($message) and $warning)
            <div class="row">
                <div class="col-md-6">
                    <span class="alert alert-warning">{{$message}}</span>
                </div>
            </div>
            @endif
            @if(isset($message) and !$warning)
            <div class="row">
                <div class="col-md-6">
                    <span class="alert alert-primary">{{$message}}</span>
                </div>
            </div>

            @endif
            <div class="row">
                <div class="col-md-4">
                    <label for="Account No">Provider Code: </label>
                    <input autocomplete="off" list="providerCodeList" type="text" class="form-control" id="provider_code">
                    <datalist id="providerCodeList">
                        @if(isset($providerCodeList))
                        @foreach($providerCodeList as $list)
                        <option value="{{$list->provider_code}}"></option>
                        @endforeach
                        @endif
                    </datalist>
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Data</label>
                        <textarea class="form-control" id="XXXData" rows="3"></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <input type="file" name="file" id="fileXLSXinput">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <button wire:click.prevent = "$emit('ImportVAProviderScript')" class="btn btn-primary">Import</button>
                </div>
            </div>

       {{--      <div class="row">
                <div class="col-md-4">
                    <button wire:click.prevent = "$emit('ImportVAProviderTESTScript')" class="btn btn-primary">TEST</button>
                </div>
            </div> --}}



        </div>

    </div>
</div>
