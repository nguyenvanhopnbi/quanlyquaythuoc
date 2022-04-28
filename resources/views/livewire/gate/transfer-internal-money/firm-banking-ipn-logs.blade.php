<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Danh sách Ipn logs
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body" style="overflow: scroll;">
            <div class="row">
                <div class="col-3">
                    <label for="ID">ID:</label>
                    <input type="text" class="form-control" id="log-id" placeholder="Tìm kiếm theo id">
                </div>

                <div class="col-3">
                    <label for="ID">Transaction ID:</label>
                    <input type="text" class="form-control" id="log-transactionID" placeholder="Tìm kiếm theo transid">
                </div>

                <div class="col-3">
                    <label for="ID">Start time:</label>
                    <input type="text" class="form-control" id="startTimeSearch" placeholder="Ngày bắt đầu..">
                </div>

                <div class="col-3">
                    <label for="ID">End time:</label>
                    <input type="text" class="form-control" id="endTimeSearch" placeholder="Ngày kết thúc..">
                </div>
            </div>
            <div class="row mb-3 mt-3">
                <div class="col-3"></div>
                <div class="col-3"></div>
                <div class="col-3"></div>
                <div class="col-3 text-right" >
                    <button wire:click.prevent="$emit('searchScript')" class="btn btn-primary">Search</button>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table table-light" id="tableLogs">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th style="white-space: nowrap;">Transaction ID</th>
                                <th>URL</th>
                                <th>Params</th>
                                <th>Method</th>
                                <th>Response</th>
                                <th>Status</th>
                                <th>Timestamps</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @dump($listLogs) --}}
                            @if(isset($listLogs))
                            @foreach($listLogs as $list)
                            <tr>
                                <td>{{$list->id}}</td>
                                <td id="TransID">
                                    <span id="TransID-text">
                                        {{$list->transaction_id}}
                                    </span>

                                </td>
                                <td id="Url-logs">
                                    <span id="Url-text">
                                        {{$list->url}}
                                    </span>
                                </td>
                                <td id="params-logs">{{$list->params}}</td>
                                <td>{{$list->method}}</td>
                                <td>
                                    <span>
                                        {{$list->response}}
                                    </span>
                                </td>
                                <td>
                                    {!!($list->status == 'error')?'<span class="badge badge-danger">Error</span>':''!!}
                                    {!!($list->status == 'success')?'<span class="badge badge-primary">Error</span>':''!!}
                                </td>
                                <td>{{date('d-m-Y H:i:s', $list->timestamp)}}</td>
                            </tr>
                            @endforeach
                            @endif

                        </tbody>
                    </table>
                    @if(isset($listLogs))
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

                    @endif
                </div>
            </div>
        </div>

    </div>
</div>
@push('scriptsChart')
    <script>
        Livewire.on('searchScript', ()=>{
            var logid = document.getElementById('log-id').value;
            var logtransactionID = document.getElementById('log-transactionID').value;
            var startTimeSearch = document.getElementById('startTimeSearch').value;
            var endTimeSearch = document.getElementById('endTimeSearch').value;

            Livewire.emit('search', logid, logtransactionID, startTimeSearch, endTimeSearch);
        });
    </script>
@endpush
