<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Danh sách giao dịch ngân hàng hold
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
                <div class="col">
                    <label for="">TransactionID: </label>
                    <input placeholder="Nhập transactionID" type="text" class="form-control" id="TransactionID">
                </div>
                <div class="col">
                    <label for="">Partner Code:</label>
                    <input placeholder="Nhập partnercode" type="text" class="form-control" id="partnerCodeSearch">
                </div>
                <div class="col">
                    <label for="">Start time: </label>
                    <input placeholder="Thời gian bắt đầu" type="text" class="form-control" id="startTimeSearch">
                </div>
                <div class="col">
                    <label for="">End time: </label>
                    <input placeholder="Thời gian kết thúc" type="text" class="form-control" id="endTimeSearch">
                </div>

            </div>
            <div class="row">
                <div class="col"></div>
                <div class="col"></div>
                <div class="col"></div>
                <div class="col">
                    <span style="float: right;">
                        <button wire:click.prevent="$emit('SearchTransactionHoldScript')" class="btn btn-primary" style="">Search</button>
                        <button wire:click.prevent="$emit('ExportTransactionHoldScript')" class="btn btn-primary" style="">Export</button>
                    </span>

                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <table class="table table-light">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Transaction ID</th>
                        <th>Reason</th>
                        <th>Amount</th>
                        <th>PartnerCode</th>
                        <th>Created at</th>
                        {{-- <th>Action</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @if(isset($listTransaction))
                    @foreach($listTransaction as $list)
                    <tr>
                        <td>{{$list->id}}</td>
                        <td>{{$list->transaction_id}}</td>
                        <td>{{$list->reason}}</td>
                        <td>{{number_format($list->amount, '0', '', ',')}} đ</td>
                        <td>{{$list->partner_code}}</td>
                        <td>{{date('d-m-Y H:i:s', $list->created_at)}}</td>
                        {{-- <td>
                            <span><a wire:click.prevent="$emit('HoldTransactionScript', '{{$list->transaction_id}}')" class="badge badge-primary text-white" >Hold</a></span>
                        </td> --}}
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            @if(isset($listTransaction))
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <li wire:click.prevent="gotoCurrentPage('{{$currentPage - 1}}')" class="page-item @if($currentPage <= 1) {{'disabled'}} @endif">
                  <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                  </a>
                </li>
                @for($i = $start; $i <= $end; $i++)
                <li wire:click.prevent = "gotoCurrentPage('{{$i}}')" class="page-item @if($i == $currentPage) {{'active'}} @endif"><a class="page-link" href="#">{{$i}}</a></li>
                @endfor
                <li wire:click.prevent="gotoCurrentPage('{{$currentPage + 1}}')" class="page-item @if($currentPage > $totalPage) {{'disabled'}} @endif">
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
