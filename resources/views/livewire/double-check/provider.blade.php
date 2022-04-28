<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Đối soát chi hộ với Provider
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
            <div class="row">

                <div class="col">
                    <select wire:change.prevent="$emit('typeProviderCodeScript')" style="margin-top: 4px;" class="form-control" id="search_providerCode">
                        <option value="WOORIBANK">WOORIBANK</option>
                        <option value="TCB">TECHCOMBANK</option>
                    </select>
                </div>


                <div class="col">
                    <input
                    autocomplete="off"
                    placeholder="{{date('d-m-Y')}}"
                    type="text" class="form-control" id="startTimeSearch" style="padding-left: 30px;">
                    <span><i class="la la-search" style="font-size: 25px; position: absolute; top: 12px; left: 15px;"></i></span>

                </div>

                <div class="col" id="checktime" style="display: none;">
                    <label>Check time</label>
                    <input style="width: 20px; height: 20px;" type="checkbox" id="isFrequency" name="isFrequency">
                </div>
                <div class="col">
                    {{-- <button
                    wire:click.prevent="$emit('SearchDoiSoatProviderScript')"
                    style="margin-top: 4px;"
                    class="btn btn-primary">Search</button> --}}
                    <button
                    wire:click.prevent="$emit('ExportCSVDoiSoatProviderVer2Script')"
                    style="margin-top: 4px;"
                    class="btn btn-primary">Export CSV</button>

                </div>
                <div class="col"></div>
                <div class="col"></div>
            </div>
        </div>
        <div class="kt-portlet__body">

        </div>

    </div>
</div>

@push('scriptsChart')
<script>


    Livewire.on('typeProviderCodeScript', ()=>{
        var search_providerCode = document.getElementById('search_providerCode').value;
        if(search_providerCode == 'TCB'){
            document.getElementById('checktime').style.display = 'block';
        }else{
            document.getElementById('checktime').style.display = 'none';
        }
    });


    Livewire.on('ExportCSVDoiSoatProviderVer2Script', ()=>{
    var dateTime = document.getElementById("startTimeSearch").value;
    var providerCode = document.getElementById('search_providerCode').value;
    if(dateTime == ''){
        alert('Hãy chọn ngày đối soát!');
        document.getElementById("startTimeSearch").focus();
        return;
    }

    var checkTime = document.getElementById('isFrequency').checked;

    var protocol = window.location.protocol;
    var host = window.location.host;
    var url = protocol + '//' + host + '/';

    window.open(url + 'transfer-money-config-double-check-provider-export?dateTime='+ dateTime
        + '&providerCode='+providerCode
        + '&isFrequency=' + checkTime
        );

    // Livewire.emit("ExportCSVDoiSoatProvider", dateTime, providerCode);
})
</script>
@endpush
