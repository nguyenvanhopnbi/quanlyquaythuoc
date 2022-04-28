<div>
    {{-- Do your work, then step back. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Danh sách giao dịch thu hộ qua cổng thanh toán
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="dropdown dropdown-inline">
                       {{--  <a href="/partner-partners/add" class="btn btn-brand btn-icon-sm"><i class="flaticon2-plus"></i> Thêm Provider</a> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="row">
                <div class="col-3">
                    <label for="transaction_id">Transaction ID: </label>
                    <input type="text" class="form-control" id="transaction_id">
                </div>

                <div class="col-3">
                    <label for="partner_code">Partner Code: </label>
                    <input list="partnerList" type="text" class="form-control" id="partner_code">
                    <datalist id="partnerList">
                        {{-- @if(isset($partnerList) and !empty($partnerList->data)) --}}
                        @if(isset($partnerList->data))
                        @foreach($partnerList->data as $listPartner)
                        <option value="{{$listPartner->partner_code}}">
                            {{($listPartner->partner_code == $listPartner->name)?'':$listPartner->name}}
                        </option>
                        @endforeach
                        @endif
                    </datalist>
                </div>

                <div class="col-3">
                    <label for="va_transaction_id">VA Transaction: </label>
                    <input type="text" class="form-control" id="va_transaction_id">
                </div>

                <div class="col-3">
                    <label for="va_transaction_status">VA Transaction Status: </label>
                    {{-- <input list="statusList" type="text" class="form-control" id="va_transaction_status">
                    <datalist id="statusList">
                        <option value="success"></option>
                        <option value="error"></option>
                    </datalist> --}}
                    <select style="margin-top: 5px;" name="va_transaction_status" id="va_transaction_status" class="form-control">
                        <option value="">all</option>
                        <option value="success">Success</option>
                        <option value="error">Error</option>
                    </select>
                </div>

            </div>
            <div class="row">
                <div class="col-3">
                    <label for="order_id">Order ID: </label>
                    <input type="text" class="form-control" id="order_id">
                </div>
                <div class="col-3">
                    <label for="start_time">Start time: </label>
                    <input placeholder="Thời gian bắt đầu" autocomplete="off" type="text" class="form-control" id="startTimeSearch">
                </div>
                <div class="col-3">
                    <label for="end_time">End time: </label>
                    <input placeholder="Thời gian kết thúc" autocomplete="off" type="text" class="form-control" id="endTimeSearch">
                </div>
                <div class="col-3">
                    <button wire:click.prevent="$emit('SearchScript')" style="margin-top: 34px;" class="btn btn-primary">Search</button>
                    <button wire:click.prevent="$emit('exportTransactionCrossCheckScript')" class="btn btn-primary" style="margin-top: 34px;">Export</button>
                </div>
            </div>
            <div class="row" style="overflow: scroll; padding-top: 10px;">
                <table class="table table-light">
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Order ID</th>
                            <th>Payment Amount</th>
                            <th>Partner Code</th>
                            <th>VA Transaction ID</th>
                            <th>VA Transaction Amount</th>
                            <th>VA Transaction Status</th>
                            <th>VA Transaction Timestamp</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($vaList->data))
                        @foreach($vaList->data as $list)
                        <tr>
                            <td>{{$list->transaction_id}}</td>
                            <td>{{$list->order_id}}</td>
                            <td>{{$list->payment_amount}}</td>
                            <td>{{$list->partner_code}}</td>
                            <td>{{$list->va_transaction_id}}</td>
                            <td>{{$list->va_transaction_amount}}</td>
                            <td><a class="badge {{($list->va_transaction_status == 'success')?'badge-primary':'badge-danger'}} text-white">{{$list->va_transaction_status}}</a></td>
                            <td>{{date('Y-m-d H:i:s', $list->va_transaction_timestamp)}}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                <nav aria-label="Page navigation example">
                  <ul class="pagination">
                    <li wire:click.prevent="gotoCurrentPage({{$currentPage - 1}})" class="page-item @if($currentPage <= 1) {{'disabled'}}  @endif">
                      <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                      </a>
                    </li>
                    @for($i = $start; $i <= $end; $i++)
                    <li wire:click.prevent="gotoCurrentPage({{$i}})" class="page-item"><a class="page-link" href="#">{{$i}}</a></li>
                    @endfor
                    <li wire:click.prevent="gotoCurrentPage({{$currentPage + 1}})" class="page-item @if($currentPage >= $totalPage) {{'disabled'}}  @endif">
                      <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                      </a>
                    </li>
                  </ul>
                </nav>
            </div>
        </div>

    </div>
</div>

@push('scripts')
    <script>

        Livewire.on('exportTransactionCrossCheckScript', ()=>{
            var transaction_id = document.getElementById('transaction_id').value;
            var partner_code = document.getElementById('partner_code').value;
            var va_transaction_id = document.getElementById('va_transaction_id').value;
            var va_transaction_status = document.getElementById('va_transaction_status').value;
            var order_id = document.getElementById('order_id').value;
            var start_time = document.getElementById('startTimeSearch').value;
            var end_time = document.getElementById('endTimeSearch').value;

            // Livewire.emit('exportTransactionCrossCheck', transaction_id, partner_code, va_transaction_id, va_transaction_status, order_id, start_time, end_time);

            // setTimeout(function(){
            //     window.location.reload(true);
            // }, 5000);

            var protocol = window.location.protocol;
            var host = window.location.host;
            var url = protocol + '//' + host + '/';

            window.open(url + 'bank-transaction-cross-check-export?transaction_id='+ transaction_id +'&order_id='+order_id+'&va_transaction_id='+va_transaction_id+'&start_time='+start_time+'&end_time='+end_time+'&partner_code='+partner_code+'&va_transaction_status='+va_transaction_status);
        });


        Livewire.on('SearchScript', ()=>{
            var transaction_id = document.getElementById('transaction_id').value;
            var partner_code = document.getElementById('partner_code').value;
            var va_transaction_id = document.getElementById('va_transaction_id').value;
            var va_transaction_status = document.getElementById('va_transaction_status').value;
            var order_id = document.getElementById('order_id').value;
            var startTimeSearch = document.getElementById('startTimeSearch').value;
            var endTimeSearch = document.getElementById('endTimeSearch').value;

            Livewire.emit('Search', transaction_id, partner_code, va_transaction_id, va_transaction_status, order_id, startTimeSearch, endTimeSearch);
        });
    </script>
@endpush
