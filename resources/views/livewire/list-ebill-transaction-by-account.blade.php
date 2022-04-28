<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    List Ebill Transaction By Account
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
                <div class="col-3">
                    <label for="providerCode">Provider Code: </label>
                    <select class="form-control" id="providerCode" style="margin-top: 5px;">
                        <option value="VIETCAPITALBANK">VIETCAPITALBANK</option>
                    </select>
                </div>
                <div class="col-3">
                    <label for="partnerCode">Account: </label>
                    <input autocomplete="off" type="text" class="form-control" id="Account">
                </div>
                <div class="col-3">
                    <button wire:click.prevent="$emit('searchScript')" class="btn btn-primary" style="margin-top: 34px;">Search</button>
                </div>
            </div>
            @if($search and isset($message))
            <div class="row">
                <div class="col">
                    <span class="alert alert-warning">{{(isset($message))?$message:''}}
                        <a target="_blank" class="badge badge-primary" style="margin-left: 20px" href="{{route('gate.ebill-transaction.list')}}?account_no={{$account}}&ebill_providerCode={{$providerCode}}">Check here</a>
                    </span>

                </div>
            </div>
            @endif
            <div class="row">
                <div class="col">
                    <table class="table table-light">
                        <thead>
                            <tr>
                                <th>Amount</th>
                                <th>CCY</th>
                                <th>Credit Account</th>
                                <th>External RefNo</th>
                                <th>Partner Code</th>
                                <th>Related Account</th>
                                <th>TraceId</th>
                                <th>Transaction Date</th>
                                <th>TrnRefNo</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if(isset($listTrans) and !empty($listTrans))
                            @foreach($listTrans as $list)
                            <tr>
                                <td>{{$list->amount}}</td>
                                <td>{{$list->ccy}}</td>
                                <td>{{$list->creditAccount}}</td>
                                <td>{{$list->externalRefNo}}</td>
                                <td>{{$list->partnerCode}}</td>
                                <td>{{$list->relatedAccount}}</td>
                                <td>{{$list->traceId}}</td>
                                <td>{{$list->transactionDate}}</td>
                                <td>{{(isset($list->trnRefNo))?$list->trnRefNo:''}}</td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scriptsChart')
    <script>
        Livewire.on('searchScript', ()=>{
            var providerCode = document.getElementById('providerCode').value;
            var account = document.getElementById('Account').value;
            Livewire.emit('search', providerCode, account);
        });
    </script>
@endpush
