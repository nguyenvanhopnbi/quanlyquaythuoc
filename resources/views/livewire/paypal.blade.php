<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    List đăng ký paypal
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="dropdown dropdown-inline">
                       {{--  <a data-toggle="modal" data-target="#formCreate" class="btn btn-success btn-icon-sm text-white"><i class="fas fa-plus"></i>
                            Thêm mới
                        </a> --}}
                    </div>
                </div>
            </div>

        </div>
        <div class="kt-portlet__body">
            {{-- data details --}}
            <div class="row">
                <div wire:ignore.self class="modal fade" id="dataDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                <label for="exampleFormControlTextarea1">Details Register</label>
                                  <textarea class="form-control rounded-0"
                                  id="paypalDetails" rows="10">{{$detailsPaypalRegister}}</textarea>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button> --}}
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            {{-- End data details --}}

            {{-- data logs details --}}
            <div class="row">
                <div wire:ignore.self class="modal fade" id="dataDetailsLogs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Details logs</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                <label for="exampleFormControlTextarea1">Details Register</label>
                                  <textarea class="form-control rounded-0"
                                  id="paypalDetails" rows="10">{{$LogPaypal}}</textarea>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button> --}}
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            {{-- End data logs details --}}

            <div class="row">
                <div class="col-3">
                    <label for="">Partner Code: </label>
                    <input list="listPartnerCode" type="text" class="form-control" id="partnerCodeSearch">
                    <datalist id="listPartnerCode">
                        @if(isset($listPartnerCode))
                        @foreach($listPartnerCode as $list1)
                        <option value="{{$list1->partner_code}}">{{($list1->partner_code == $list1->name)?'':$list1->name}}</option>
                        @endforeach
                        @endif
                    </datalist>
                </div>
                <div class="col-3">
                    <label for="">Status: </label>
                    <select class="form-control" id="statusSearch" style="margin-top: 5px;">
                        <option value="">all</option>
                        <option value="pending">Pending</option>
                        <option value="success">Success</option>
                    </select>
                </div>
                <div class="col-3">
                    <label for="startTime">Start Time: </label>
                    <input autocomplete="off" type="text" class="form-control" id="startTimeSearch">
                </div>
                <div class="col-3">
                    <label for="startTime">End Time: </label>
                    <input type="text" autocomplete="off" class="form-control" id="endTimeSearch">
                </div>
            </div>
            <div class="row">
                <div class="col" style="text-align: right; margin: 10px 0 10px 0;">
                    <button wire:click.prevent="$emit('searchScript')" class="btn btn-primary">Search</button>
                </div>
            </div>
            <div class="row">
                <table class="table table-light">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Partner Code</th>
                            <th>Tracking ID</th>
                            <th>Paypal merchant id</th>
                            <th>Status</th>
                            <th>Is active</th>
                            <th>Data details</th>
                            <th>Log paypal</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Paypal email status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($listPaypal))
                        @foreach($listPaypal as $list)
                        <tr>
                            <td>{{$list->id}}</td>
                            <td>{{$list->partner_code}}</td>
                            <td>{{$list->tracking_id}}</td>
                            <td>{{(isset($list->paypal_merchant_id))?$list->paypal_merchant_id:''}}</td>
                            <td>{{$list->status}}</td>
                            <td>{{$list->is_active}}</td>
                            <td>
                                <a data-toggle="modal" data-target="#dataDetails" wire:click.prevent="$emit('ViewDataDetailScript', '{{$list->id}}')" class="badge badge-success text-white">View</a>
                            </td>
                            <td>
                                <a data-toggle="modal" data-target="#dataDetailsLogs" wire:click.prevent="$emit('ViewDataLogsDetailScript', '{{$list->id}}')" class="badge badge-success text-white">View</a>
                            </td>
                            <td>
                                {{date('d-m-Y H:i:s', '1646453909')}}
                            </td>
                            <td>
                                {{date('d-m-Y H:i:s', '1646453909')}}
                            </td>
                            <td>
                                {{$list->paypal_email_status}}
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                <nav aria-label="Page navigation example">
                      <ul class="pagination">
                        <li wire:click.prevent="gotoCurrentPage({{$currentPage - 1}})" class="page-item {{($currentPage <=1)?'disabled':''}}">
                          <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                          </a>
                        </li>
                        @for($i=$start; $i<=$end; $i++)
                        <li wire:click.prevent="gotoCurrentPage({{$i}})" class="page-item"><a class="page-link" href="#">{{$i}}</a></li>
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
@push('scriptsChart')
    <script>
        Livewire.on('ViewDataDetailScript', id=>{
            Livewire.emit('ViewDataDetail', id);
        });

        Livewire.on('ViewDataLogsDetailScript', id=>{
            Livewire.emit('ViewDataLogsDetails', id);
        });

        Livewire.on('searchScript', ()=>{
            var partnerCode = document.getElementById('partnerCodeSearch').value;
            var status = document.getElementById('statusSearch').value;
            var startTime = document.getElementById('startTimeSearch').value;
            var endTime = document.getElementById('endTimeSearch').value;

            Livewire.emit('search', partnerCode, status, startTime, endTime);
        });
    </script>
@endpush
