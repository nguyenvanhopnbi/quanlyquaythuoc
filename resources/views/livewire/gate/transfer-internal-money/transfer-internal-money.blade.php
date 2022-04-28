<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Giao dịch chuyển tiền nội bộ
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="row">
                <div class="col">
                    <label for="Trans ID">Trans ID</label>
                    <input type="text" class="form-control" id="transaction_id">
                </div>
                <div class="col">
                    <label for="Ref Trans ID">Ref Trans ID</label>
                    <input type="text" class="form-control" id="ref_transaction_id">
                </div>
                <div class="col">
                    <label for="From Account No">From Account No</label>
                    <input type="text" class="form-control" id="from_account_no">
                </div>
                <div class="col">
                    <label for="From Account Name">From Account Name</label>
                    <input type="text" class="form-control" id="from_account_name">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="From Bank Code">From Bank Code</label>
                    <input type="text" class="form-control" id="from_bank_code">
                </div>
                <div class="col">
                    <label for="To account No">To Account No</label>
                    <input type="text" class="form-control" id="to_account_no">
                </div>
                <div class="col">
                    <label for="To Account Name">To Account Name</label>
                    <input type="text" class="form-control" id="to_account_name">
                </div>
                <div class="col">
                    <label for="To Bank Code">To Bank Code</label>
                    <input type="text" class="form-control" id="to_bank_code">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="Amount">Amount</label>
                    <input type="text" class="form-control" id="amount">
                </div>
                <div class="col">
                    <label for="Status">Status</label>
                    <select class="form-control" id="status" style="margin-top: 5px;">
                        <option value="all">All</option>
                        <option value="pending">Pending</option>
                        <option value="success">Success</option>
                        <option value="error">Error</option>
                        <option value="processing">Processing</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                <div class="col">
                    <label for="Request Time">Start Time</label>
                    <input type="text" class="form-control" id="startTimeSearch">
                </div>
                <div class="col">
                    <label for="Response Time">End Time</label>
                    <input type="text" class="form-control" id="endTimeSearch">
                </div>
            </div>
            <div class="row">
                <div class="col"></div>
                <div class="col"></div>
                <div class="col"></div>
                <div class="col"><button wire:click.prevent="$emit('SearchTransInternalMoneyScript')" class="btn btn-primary" style="float: right;">Search</button></div>
            </div>
        </div>
        <div class="kt-portlet__body" style="overflow: scroll;">
            <table class="table table-light" id="table-trans-internal-transfer">
                <thead>
                    <tr>
                        <th>Trans ID</th>
                        <th>Ref Trans ID</th>
                        <th>From Account No</th>
                        <th>From Account Name</th>
                        <th>From Bank Code</th>
                        <th>To Account No</th>
                        <th>To Account Name</th>
                        <th>To Bank Code</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Request Time</th>
                        <th>Response Time</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($listTransferInternalMoney))
                    @foreach($listTransferInternalMoney as $listTrans)
                    <tr>
                        <td>{{$listTrans->transaction_id}}</td>
                        <td>{{$listTrans->ref_transaction_id}}</td>
                        <td>{{$listTrans->from_account_no}}</td>
                        <td>{{$listTrans->from_account_name}}</td>
                        <td>{{$listTrans->from_bank_code}}</td>
                        <td>{{$listTrans->to_account_no}}</td>
                        <td>{{$listTrans->to_account_name}}</td>
                        <td>{{$listTrans->to_bank_code}}</td>
                        <td>{{$listTrans->amount}}</td>
                        <td>{{$listTrans->status}}</td>
                        <td>{{date('d-m-Y H:i:s', $listTrans->request_time)}}</td>
                        <td>{{date('d-m-Y H:i:s', $listTrans->response_time)}}</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            @if(isset($listTransferInternalMoney))
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <li wire:click.prevent="gotoCurrentPage({{$currentPage - 1}})" class="page-item @if($currentPage <= 1) {{'disabled'}} @endif">
                  <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                  </a>
                </li>
                @for($i = $start; $i<= $end; $i++)
                <li wire:click.prevent="gotoCurrentPage({{$i}})" class="page-item @if($i == $currentPage) {{'active'}} @endif"><a class="page-link" href="#">{{$i}}</a></li>
                @endfor
                <li wire:click.prevent="gotoCurrentPage({{$currentPage + 1}})" class="page-item @if($currentPage >= $totalPage) @endif">
                  <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                  </a>
                </li>
              </ul>
            </nav>
            @endif

        </div>

    </div>
</div>
