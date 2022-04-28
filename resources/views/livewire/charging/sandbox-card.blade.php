<div>
    <div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon2-line-chart"></i>
            </span>

            <h3 class="kt-portlet__head-title">
                Danh sách gạch thẻ AC
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                {{-- <button class="btn btn-primary">Add new</button> --}}
            </div>
        </div>
    </div>
    <div class="kt-portlet__body" style="overflow: scroll;">
        <div class="row">
            <div class="col-3">
                <label for="Transaction ID">Transaction ID: </label>
                <input type="text" class="form-control" id="TransactionID" placeholder="Nhập mã giao dịch" autocomplete="off">
            </div>
            <div class="col-3">
                <label for="Partner TransID ">Partner TransID: </label>
                <input type="text" class="form-control" id="PartnerTransID" placeholder="Nhập Partner TransID" autocomplete="off">
            </div>
            <div class="col-3">
                <label for="PartnerCode">Partner Code: </label>
                <input list="dataListPartner" type="text" class="form-control" id="partnerCode" placeholder="Nhập partner code">
                <datalist id="dataListPartner">
                    @if(isset($dataListPartner))
                    @foreach($dataListPartner as $listPartner)
                    <option value="{{$listPartner->partner_code}}">{{($listPartner->name == $listPartner->partner_code)?'':$listPartner->name}}</option>
                    @endforeach
                    @endif
                </datalist>
            </div>

            <div class="col-3">
                <label for="">Amount: </label>
                <input type="text" class="form-control" id="Amount" placeholder="Nhập amount">
            </div>

        </div>
        <div class="row" style="margin-bottom: 10px;">
            <div class="col-3">
                <label for="Status">Status: </label>
                <select class="form-control" id="Status" style="margin-top: 5px;">
                    <option value="">All</option>
                    <option value="success">Success</option>
                    <option value="error">Error</option>
                </select>
            </div>
            <div class="col-3">
                <label for="Card code">Card code: </label>
                <input type="text" class="form-control" id="Cardcode" placeholder="Nhập card code">
            </div>
            <div class="col-3">
                <label for="">Card serial: </label>
                <input type="text" class="form-control" id="cardSerial" placeholder="Nhập card serial">
            </div>
            <div class="col-3">
                <label for="StartTime">Start time: </label>
                <input type="text" class="form-control" id="startTimeSearch" placeholder="Nhập ngày bắt đầu..">
            </div>
            <div class="col-3">
                <label for="EndTime">End time: </label>
                <input type="text" class="form-control" id="endTimeSearch" placeholder="Nhập ngày kết thúc ..">
            </div>
            <div class="col-3">
                <button wire:click.prevent="$emit('searchScript')" class="btn btn-primary" id="search" style="margin-top: 34px;">Search</button>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <table class="table table-light">

                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Partner TransID</th>
                            <th>App ID</th>
                            <th>App name</th>
                            <th>Code</th>
                            <th>Serial</th>
                            <th>Amount</th>
                            <th>Earning Amount</th>
                            <th>Partner Code</th>
                            <th>Percent</th>
                            <th>Target</th>
                            <th>Service name</th>
                            <th>Status</th>
                            <th>Error code</th>
                            <th>Message</th>
                            <th>Request time</th>
                            <th>Response time</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if(isset($listSandBox))
                        @foreach($listSandBox as $list)
                        <tr>
                            <td>{{$list->transaction_id}}</td>
                            <td>{{$list->partner_transaction_id}}</td>
                            <td>{{$list->application_id}}</td>
                            <td>{{$list->application_name}}</td>
                            <td>{{$list->code}}</td>
                            <td>{{$list->serial}}</td>
                            <td>{{$list->amount}}</td>
                            <td>{{$list->earning_amount}}</td>
                            <td>{{$list->partner_code}}</td>
                            <td>{{$list->percent}}</td>
                            <td>{{$list->target}}</td>
                            <td>{{$list->service_name}}</td>
                            <td>

                                {!! ($list->status == 'success')?'<span class="badge badge-primary"> Success </span>':'<span class="badge badge-danger"> Error </span>' !!}</td>
                            <td>{{$list->error_code}}</td>
                            <td>{{$list->message}}</td>
                            <td>{{date('d-m-Y H:i:s', $list->request_time)}}</td>
                            <td>{{date('d-m-Y H:i:s', $list->response_time)}}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>

                </table>

                <nav aria-label="Page navigation example">
                  <ul class="pagination">
                    <li wire:click.prevent="gotoCurrentPage({{$currentPage - 1}})" class="page-item {{($currentPage <= 1)?'disabled':''}}">
                      <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                      </a>
                    </li>
                    @for($i = $start; $i <= $end; $i++)
                    <li wire:click.prevent="gotoCurrentPage({{$i}})" class="page-item {{($currentPage == $i)?'active':''}}"><a class="page-link" href="#">{{$i}}</a></li>
                    @endfor
                    <li wire:click.prevent="gotoCurrentPage({{$currentPage + 1}})" class="page-item {{($currentPage >= $totalPage)?'disabled':''}}">
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
</div>
@push('scriptsChart')

    <script>
        Livewire.on('searchScript', ()=>{
            var TransactionID = document.getElementById('TransactionID').value;
            var PartnerTransID = document.getElementById('PartnerTransID').value;
            var partnerCode = document.getElementById('partnerCode').value;
            var Amount = document.getElementById('Amount').value;
            var Status = document.getElementById('Status').value;
            var Cardcode = document.getElementById('Cardcode').value;
            var cardSerial = document.getElementById('cardSerial').value;
            var startTimeSearch = document.getElementById('startTimeSearch').value;
            var endTimeSearch = document.getElementById('endTimeSearch').value;

            Livewire.emit('search', TransactionID, PartnerTransID, partnerCode, Amount, Status, Cardcode, cardSerial, startTimeSearch, endTimeSearch);
        });
    </script>

@endpush
