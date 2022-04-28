<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Chu kỳ đối soát partner
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <button
                    data-toggle="modal"
                    data-target="#addnewDoisoattheoPartner"
                    wire:click.prevent="$emit('AddnewConfirmScheduleScript')"
                    class="btn btn-primary">Add new</button>
                </div>

                <div class="kt-portlet__head-wrapper">
                    <button
                    style="margin-left: 10px;"
                    wire:click.prevent="$emit('ExportDoisoatPartnerScript')"
                    class="btn btn-primary">Export</button>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="row">
                <div class="col">
                    <span>Partner Code:</span>
                    <span><input
                        list="partnerList"
                        style="padding-left: 25px;"
                        placeholder="Nhập partner code"
                        type="text" class="form-control" id="partner_code"></span>
                        <span style="position: absolute; top: 30px; left: 16px; font-size: 20px;">
                            <i class="la la-search"></i>
                        </span>
                        <datalist id="partnerList">
                            @if(isset($partnerList))
                            @foreach($partnerList as $list)
                            <option value="{{$list->partner_code}}">
                                {{($list->partner_code == $list->name)?'':$list->name}}
                            </option>
                            @endforeach
                            @endif
                        </datalist>
                </div>
                <div class="col">
                    <span>Chu kỳ đối soát</span>
                    <select style="margin-top: 5px;" class ="form-control" id="chukydoisoat">
                        <option value="all">ALL</option>
                        <option value="every_day">Hằng ngày</option>
                        <option value="every_week">Hằng tuần</option>
                        <option value="every_month">Hằng tháng</option>
                        <option value="every_three_day">Ba ngày 1 lần</option>
                    </select>
                </div>
                <div class="col">
                    <span>Start Time:</span>
                    <span><input
                        style="padding-left: 25px;"
                        placeholder="d-m-Y H:i:s"
                        type="text" class="form-control" id="start_time"></span>
                        <span style="position: absolute; top: 30px; left: 16px; font-size: 20px;">
                            <i class="la la-search"></i>
                        </span>
                </div>
                <div class="col">
                    <span>End Time:</span>
                    <span><input
                        style="padding-left: 25px;"
                        placeholder="d-m-Y H:i:s"
                        type="text" class="form-control" id="end_time"></span>
                        <span style="position: absolute; top: 30px; left: 16px; font-size: 20px;">
                            <i class="la la-search"></i>
                        </span>
                </div>
                <div class="col">
                    <span><button
                        wire:click.prevent="$emit('SearchDoisoattheoPartnerScript')"
                        style="position: absolute; bottom: 6px;"
                        class="btn btn-primary">Search</button></span>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">

            {{-- modal update new --}}
            <div wire:ignore.self class="modal fade" id="UpdateDoisoattheoPartner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    @if(isset($message) and !$warning)
                    <div class="row">
                        <div class="col">
                            <span class="alert alert-primary">{{$message}}</span>
                        </div>
                    </div>
                    @endif
                    @if(isset($message) and $warning)
                    <div class="row">
                        <div class="col">
                            <span class="alert alert-warning">{{$message}}</span>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col">
                            <label>Partner Code: </label>
                            <input list="partnerListUpdate" type="text" class="form-control" id="update-partnerCode">
                            <datalist id="partnerListUpdate">
                                @if(isset($partnerList))
                                @foreach($partnerList as $listupdate)
                                <option value="{{$listupdate->partner_code}}">

                                    {{($listupdate->partner_code == $listupdate->name)?'':$listupdate->name}}
                                </option>
                                @endforeach
                                @endif
                            </datalist>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>Schedule Code: </label>
                            <select class ="form-control" id="sheduleCodeUpdate">
                                <option id="every_day" value="every_day">Hằng ngày</option>
                                <option id="every_week" value="every_week">Hằng tuần</option>
                                <option id="every_month" value="every_month">Hằng tháng</option>
                                <option id="every_three_day" value="every_three_day">Ba ngày 1 lần</option>
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button
                    wire:click.prevent="$emit('UpdateDoisoattheopartnerScript')"
                    type="button" class="btn btn-primary">Update</button>
                    <input type="hidden" id="UpdateDoisoattheopartner" value="{{$UpdateDoisoattheopartner}}">
                  </div>
                </div>
              </div>
            </div>
            {{-- end modal update new --}}


            {{-- modal add new --}}
            <div wire:ignore.self class="modal fade" id="addnewDoisoattheoPartner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    @if(isset($message) and !$warning)
                    <div class="row">
                        <div class="col">
                            <span class="alert alert-primary">{{$message}}</span>
                        </div>
                    </div>
                    @endif

                    @if(isset($message) and $warning)
                    <div class="row">
                        <div class="col">
                            <span class="alert alert-warning">{{$message}}</span>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col">
                            <label>Partner Code: </label>
                            <input list="partnerListAddnew" type="text" class="form-control" id="addnew-partnerCode">
                            <datalist id="partnerListAddnew">
                                @if(isset($partnerList))
                                @foreach($partnerList as $listaddnew)
                                <option value="{{$listaddnew->partner_code}}">
                                    {{($listaddnew->partner_code == $listaddnew->name)?'':$listaddnew->name}}

                                </option>
                                @endforeach
                                @endif
                                    }
                            </datalist>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="">Schedule Code: </label>
                            <select class="form-control" id="addnew-scheduleCode">
                                <option value="every_day">Hằng ngày</option>
                                <option value="every_week">Hằng tuần</option>
                                <option value="every_month">Hằng tháng</option>
                                <option value="every_three_day">Ba ngày 1 lần</option>
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button
                    wire:click.prevent="$emit('AddnewDoiSoatTheoPartnerScript')"
                    type="button" class="btn btn-primary">Save</button>
                  </div>
                </div>
              </div>
            </div>
            {{-- end modal add new --}}
            <div class="row">
                <div class="col">
                    <span style="float: right; font-weight: bold;">Total: {{(isset($tongRecords))?$tongRecords:''}}</span>
                </div>
            </div>

            <table class="table table-light">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Schedule Code</th>
                        <th>Partner Code</th>
                        <th>Created At</th>
                        <th>Update At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($dataList))
                    @foreach($dataList as $list)
                    <tr>
                        <td>{{$list->id}}</td>
                        <td>{{$list->schedule_code}}
                            <input id="ScheduleCode-{{$list->id}}" type="hidden" value="{{$list->schedule_code}}">
                        </td>
                        <td>{{$list->partner_code}}
                            <input
                            id="partner_code-{{$list->id}}"
                            type="hidden" value="{{$list->partner_code}}">
                        </td>
                        <td>{{date('d-m-Y H:i:s', $list->created_at)}}</td>
                        <td>{{date('d-m-Y H:i:s', $list->updated_at)}}</td>
                        <td>
                            <a
                            data-placement="top" title="Sửa" wire:click.prevent="$emit('getDateTableUpdatePartnerScript', '{{$list->id}}')" data-toggle="modal" data-target="#UpdateDoisoattheoPartner">
                                <i class="flaticon2-pen"></i> |
                            </a>
                            <a
                            data-placement="top" title="Xóa" wire:click.prevent="$emit('deleteCheckPartnerScript', '{{$list->id}}')">
                                <i class="flaticon2-delete"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>

            @if(isset($dataList))
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <li
                wire:click.prevent="gotoCurrentPage('{{$currentPage - 1}}')"
                class="page-item @if($pageCurrent <= 1) {{'disabled'}} @endif">
                  <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                  </a>
                </li>
                @for($i = $start; $i <= $end; $i++)
                <li wire:click.prevent="gotoCurrentPage('{{$i}}')" class="page-item @if($currentPage == $i) {{'active'}} @endif"><a class="page-link" href="#">{{$i}}</a></li>
                @endfor
                <li
                wire:click.prevent="gotoCurrentPage('{{$currentPage + 1}}')"
                class="page-item @if($currentPage >= $totalPage) {{'disabled'}}  @endif">
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
