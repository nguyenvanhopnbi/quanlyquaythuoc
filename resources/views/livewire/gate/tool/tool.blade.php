<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Tool Cập Nhật Giao dịch
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">

            <!--begin: Search Form -->
            <div class="card" style="width: 600px;">
                @if(isset($message) && $message != '')
                <div class="alert alert-primary">{{$message}}
                    <a class="badge badge-success" target="_blank" href="/gate-transactions?transaction_id={{$transactionIDmessage}}">Check here</a>
                </div>

                @endif

              <div class="card-body">
                <form action="">
                    <label for="tool_transactionid">TransactionID:</label>
                    <input type="text" class="form-control" id="tool_transactionid" />
                    <label for="tool_bank_ref_id">Vendor Ref ID:</label>
                    <input type="text" class="form-control"  id="tool_bank_ref_id" />
                    <label for="tool_vendor">Vendor:</label>
                    <input list="list_vendor" type="text" class="form-control" id="tool_vendor" />
                    <datalist id="list_vendor">
                        @if(isset($vendorData))
                        @foreach($vendorData as $vendor)
                        <option value="{{$vendor->vendor_code}}"></option>
                        @endforeach

                        @endif
                    </datalist>

                    <label style="visibility: hidden;" for="tool_requestTime">Today</label>
                    <input style="visibility: hidden;" type="checkbox" id="tool_time_today" aria-label="Checkbox for following text input" checked>
                </form>
                <a class="btn btn-primary" style="color: #FFFFFF" wire:click.prevent="$emit('UpdateToolScript')">Update</a>
              </div>
            </div>

        </div>

    </div>
</div>
