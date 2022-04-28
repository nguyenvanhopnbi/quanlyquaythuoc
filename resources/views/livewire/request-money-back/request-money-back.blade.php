<div>
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Yêu cầu gửi lại thông báo đã nhận tiền
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
                    <label for="Account No">Account No: </label>
                    <input type="text" class="form-control" id="account_no">
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="Account No">Transaction Number: </label>
                    <input type="text" class="form-control"
                    id="XXXtransaction_number">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <button wire:click.prevent = "$emit('RequestMoneyBackScript')" class="btn btn-primary">Request</button>
                </div>
            </div>



        </div>

    </div>
</div>
