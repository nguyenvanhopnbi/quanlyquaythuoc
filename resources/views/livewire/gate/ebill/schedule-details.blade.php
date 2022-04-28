<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Lịch đối soát thu hộ VA
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">

                <div class="kt-portlet__head-wrapper mr-3">
                    <div class="dropdown dropdown-inline">
                        <a
                        data-toggle="modal"
                        data-target="#ConfirmModal"
                        href="#" class="btn btn-brand btn-icon-sm"><i class="flaticon2-plus"></i>
                        Confirm</a>
                    </div>
                </div>


                <div class="kt-portlet__head-wrapper mr-3">
                    <div class="dropdown dropdown-inline">
                        <a
                        wire:click.prevent="$emit('ExportScheduleVACSVScript')"
                        href="#" class="btn btn-brand btn-icon-sm"><i class="flaticon2-plus"></i>
                            Export
                        </a>
                    </div>
                </div>
                <div class="kt-portlet__head-wrapper">
                    <div class="dropdown dropdown-inline">
                        <a
                        data-toggle="modal"
                        data-target="#addnewModal"
                        href="#" class="btn btn-brand btn-icon-sm"><i class="flaticon2-plus"></i> Thêm Mới</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="kt-portlet__body" style="overflow: scroll;">

            <!-- Modal confirm -->
            <div wire:ignore.self class="modal fade" id="ConfirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">

                    <div class="row">
                        <div class="col">
                            Schedule Code:
                            <select class="form-control" id="ScheduleCodeConfirm">
                                <option value="every_day">Hằng ngày</option>
      {{--                           <option value="every_week">Hằng tuần</option>
                                <option value="every_month">Hằng tháng</option>
                                <option value="every_three_day">Ba ngày 1 lần</option> --}}
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            Year:
                            <input id="YearPerformConfirm" type="text" class="form-control" value="{{date('Y')}}">
                        </div>
                    </div>


                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click.prevent="$emit('confirmScheduleScript')" type="button" class="btn btn-primary">confirm</button>
                  </div>
                </div>
              </div>
            </div>

            {{-- end modal confirm --}}


            <!-- Modal add new -->
            <div wire:ignore.self class="modal fade" id="addnewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label for="startTime">Start time: </label>
                            <input
                            autocomplete="off"
                            type="text" class="form-control" id="addnew_startTime">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="startTime">End time: </label>
                            <input
                            autocomplete="off"
                            type="text" class="form-control" id="addnew_endTime">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="startTime">Date perform: </label>
                            <input
                            autocomplete="off"
                            type="text" class="form-control" id="addnew_date_perform">
                        </div>
                    </div>


                    <div class="row">
                        <div class="col">
                            <label for="Created by">Created by: </label>
                            <input type="text" class="form-control" id="addnew_created_by">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="Year perform">Year perform: </label>
                            <input type="text" class="form-control" id="addnew_year_perform">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="Created by">Updated by: </label>
                            <input type="text" class="form-control" id="addnew_updated_by">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="Schedule code">Schedule code: </label>
                            {{-- <input type="text" class="form-control" id="addnew_reconciliation_schedule_code"> --}}
                            <select class="form-control" id="addnew_reconciliation_schedule_code">
                                <option value="all">All</option>
                                <option value="every_day">Hằng ngày</option>
                 {{--                <option value="every_week">Hằng tuần</option>
                                <option value="every_month">Hằng tháng</option>
                                <option value="every_three_day">Ba ngày 1 lần</option> --}}
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="isConfirmed">Is confirmed: </label>
                            <select type="text" class="form-control" id="addnew_is_confirm">
                                <option value="">Choose is confirmed..</option>
                                <option value="1">TRUE</option>
                                <option value="0">FALSE</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="isUsed">Is used: </label>
                            <select type="text" class="form-control" id="addnew_is_used">
                                <option value="">Choose is used..</option>
                                <option value="1">YES</option>
                                <option value="0">NO</option>
                            </select>
                        </div>
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click.prevent="$emit('addnewScript')" type="button" class="btn btn-primary">Save</button>
                  </div>
                </div>
              </div>
            </div>

            {{-- end modal add new --}}

            <!-- Modal update -->
            <div wire:ignore.self class="modal fade" id="editScheduleDetailsVA" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label for="startTime">Start time: </label>
                            <input type="text" class="form-control" id="update_startTime">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="startTime">End time: </label>
                            <input type="text" class="form-control" id="update_endTime">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="startTime">Date perform: </label>
                            <input type="text" class="form-control" id="update_date_perform">
                        </div>
                    </div>


                    <div class="row">
                        <div class="col">
                            <label for="Created by">Created by: </label>
                            <input type="text" class="form-control" id="update_created_by">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="Year perform">Year perform: </label>
                            <input type="text" class="form-control" id="update_year_perform">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="Created by">Updated by: </label>
                            <input type="text" class="form-control" id="update_updated_by">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="Schedule code">Schedule code: </label>
                            {{-- <input type="text" class="form-control" id="update_reconciliation_schedule_code"> --}}
                            <select class="form-control" id="update_reconciliation_schedule_code">
                                <option value="all">All</option>
                                <option value="every_day">Hằng ngày</option>
                         {{--        <option value="every_week">Hằng tuần</option>
                                <option value="every_month">Hằng tháng</option>
                                <option value="every_three_day">Ba ngày 1 lần</option> --}}
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="isConfirmed">Is confirmed: </label>
                            <select type="text" class="form-control" id="update_is_confirm">
                                <option value="">Choose is confirmed..</option>
                                <option value="1">TRUE</option>
                                <option value="0">FALSE</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="logs">Logs: </label>
                            <textarea class="form-control" id="update_logs">

                            </textarea>
                        </div>
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click.prevent="$emit('updateScript')" type="button" class="btn btn-primary">Update</button>
                    <input wire:ignore type="hidden" id="idUpdate">
                  </div>
                </div>
              </div>
            </div>

            {{-- end modal update --}}

            <!-- Modal details -->
            <div class="modal fade bd-example-modal-lg" id="showDetailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chi tiết</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <span class="bold">ID: </span>
                        </div>
                        <div class="col">
                            <span id="chitiet-id">360</span>
                        </div>
                        <div class="col">
                            <span class="bold">Start date:</span>
                        </div>
                        <div class="col">
                            <span id="chitiet-start_date">{{date('d-m-Y H:i:s', '1633107600')}}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <span class="bold">End date: </span>
                        </div>
                        <div class="col">
                            <span id="chitiet-end_date">360</span>
                        </div>
                        <div class="col">
                            <span class="bold">Start time:</span>
                        </div>
                        <div class="col">
                            <span id="chitiet-start_time">{{date('d-m-Y H:i:s', '1633107600')}}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <span class="bold">End time: </span>
                        </div>
                        <div class="col">
                            <span id="chitiet-end_time">360</span>
                        </div>
                        <div class="col">
                            <span class="bold">Created at:</span>
                        </div>
                        <div class="col">
                            <span id="chitiet-created_at">{{date('d-m-Y H:i:s', '1633107600')}}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <span class="bold">Updated at: </span>
                        </div>
                        <div class="col">
                            <span id="chitiet-updated_at">360</span>
                        </div>
                        <div class="col">
                            <span class="bold">Date perform:</span>
                        </div>
                        <div class="col">
                            <span id="chitiet-date_perform">{{date('d-m-Y H:i:s', '1633107600')}}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <span class="bold">Create by: </span>
                        </div>
                        <div class="col">
                            <span id="chitiet-created_by">360</span>
                        </div>
                        <div class="col">
                            <span class="bold">Year perform:</span>
                        </div>
                        <div class="col">
                            <span id="chitiet-year_perform">{{date('d-m-Y H:i:s', '1633107600')}}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <span class="bold">Updated by: </span>
                        </div>
                        <div class="col">
                            <span id="chitiet-updated_by">360</span>
                        </div>
                        <div class="col">
                            <span class="bold">Schedule code:</span>
                        </div>
                        <div class="col">
                            <span id="chitiet-reconciliation_schedule_code">{{date('d-m-Y H:i:s', '1633107600')}}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <span class="bold">Is confirmed: </span>
                        </div>
                        <div class="col">
                            <span id="chitiet-is_confirm">360</span>
                        </div>
                        <div class="col">
                            <span class="bold">Is used:</span>
                        </div>
                        <div class="col">
                            <span id="chitiet-is_used">{{date('d-m-Y H:i:s', '1633107600')}}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <span>
                                <textarea class="form-control" id="chitiet-logs" cols="30" rows="10">

                                </textarea>
                            </span>
                        </div>

                    </div>



                  </div>
           {{--        <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                  </div> --}}
                </div>
              </div>
            </div>

            {{-- end modal detail --}}


            <div class="row">

                <div class="col-3">
                    <span style="margin-left: 20px;"> Start time: </span>
                    <span>
                        <input
                        autocomplete="off"
                        placeholder="Nhập ngày bắt đầu" type="text" style="margin-left: 21px; margin-top: 0px; padding-left: 26px;" class="form-control" id="startTimeSearch">

                    </span>
                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                        <span style="position: absolute; top: 25px; left: 35px; font-size: 20px;">
                            <i class="la la-search"></i>
                        </span>
                    </span>
                </div>

                <div class="col-3">
                    <span style="margin-left: 20px;"> End time: </span>
                    <span>
                        <input
                        autocomplete="off"
                        placeholder="Nhập ngày kết thúc" type="text" style="margin-left: 21px; margin-top: 0px; padding-left: 26px;" class="form-control" id="endTimeSearch">

                    </span>
                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                        <span style="position: absolute; top: 25px; left: 35px; font-size: 20px;">
                            <i class="la la-search"></i>
                        </span>
                    </span>
                </div>

                <div class="col-3">
                    <span style="margin-left: 20px;"> Date perform: </span>
                    <span>
                        <input
                        autocomplete="off"
                        placeholder="Nhập ngày đối soát" type="text" style="margin-left: 21px; margin-top: 0px; padding-left: 26px;" class="form-control" id="DateTimeSearch">

                    </span>
                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                        <span style="position: absolute; top: 25px; left: 35px; font-size: 20px;">
                            <i class="la la-search"></i>
                        </span>
                    </span>
                </div>

                <div class="col-3">
                    <span style="margin-left: 20px;"> Created by: </span>
                    <span>
                        <input placeholder="Created by" type="text" style="margin-left: 21px; margin-top: 0px; padding-left: 26px;" class="form-control" id="search_created_by">

                    </span>
                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                        <span style="position: absolute; top: 25px; left: 35px; font-size: 20px;">
                            <i class="la la-search"></i>
                        </span>
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <span style="margin-left: 20px;"> Is Used: </span>
                    <span>
                        <select style="margin-left: 21px; padding-left: 26px;" class="form-control" id="isUsedSearch">
                            <option value="">All</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                        {{-- <input type="checkbox" style="height: 25px; width: 25px;" placeholder="d-m-Y H:i:s" id="isUsedSearch"> --}}
                    </span>

                </div>
                <div class="col-3">
                    <span style="margin-left: 20px;"> Is Confirmed: </span>
                    <span>
                        <select style="margin-left: 21px; padding-left: 26px;" class="form-control" id="isConfirmSearch">
                            <option value="">All</option>
                            <option value="1">TRUE</option>
                            <option value="0">FALSE</option>
                        </select>
                       {{--  <input type="checkbox" style="height: 25px; width: 25px;" placeholder="d-m-Y H:i:s" id="isConfirmSearch"> --}}
                    </span>

                </div>
                <div class="col-3">
                    <span style="margin-left: 20px;"> Schedule: </span>
                    <span>
                        <select style="margin-left: 21px; padding-left: 26px;" class="form-control" id="search_schedule_code">
                            <option value="all">All</option>
                            <option value="every_day">Hằng ngày</option>
                           {{--  <option value="every_week">Hằng tuần</option>
                            <option value="every_month">Hằng tháng</option>
                            <option value="every_three_day">Ba ngày 1 lần</option> --}}
                        </select>
                    </span>
                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                        <span style="position: absolute; top: 25px; left: 35px; font-size: 20px;">
                            <i class="la la-search"></i>
                        </span>
                    </span>

                </div>
                <div class="col-3">
                    <span style="margin-left: 20px;"> Year perform: </span>
                    <span>
                        <input placeholder="Nhập năm" type="text" style="margin-left: 21px; margin-top: 0px; padding-left: 26px;" class="form-control" id="search_year_perform">

                    </span>
                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                        <span style="position: absolute; top: 25px; left: 35px; font-size: 20px;">
                            <i class="la la-search"></i>
                        </span>
                    </span>
                </div>
            </div>

            <div class="row">
                <div class="col"></div>
                <div class="col"></div>
                <div class="col"></div>
                <div class="col" style="text-align: right; padding-top: 20px; padding-bottom: 20px;">
                    <button wire:click.prevent="$emit('searchScript')" class="btn btn-primary">Search</button>
                </div>
            </div>


            <div class="row">
                <table class="table table-light">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Date Perform</th>
                            {{-- <th>Created by</th> --}}
                            {{-- <th>Year Perform</th> --}}
                            <th style="white-space: nowrap;">Update at</th>
                            <th>Is confirm</th>
                            <th>Is used</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @dump($dataList) --}}
                        @if(isset($dataList))
                        @foreach($dataList as $list)
                        <tr>
                            <td>
                                <a href="#"
                                data-toggle="modal"
                                data-target="#showDetailsModal"
                                wire:click.prevent="$emit('showDetailsModal', '{{$list->id}}')">{{$list->id}}</a>
                                <input type="hidden" id="id-{{$list->id}}" value="{{$list->id}}">
                                <input type="hidden" id="start_date-{{$list->id}}" value="{{date('d-m-Y H:i:s', $list->start_date)}}">
                                <input type="hidden" id="end_date-{{$list->id}}" value="{{date('d-m-Y H:i:s', $list->end_date)}}">
                                <input type="hidden" id="start_time-{{$list->id}}" value="{{date('d-m-Y H:i:s', $list->start_time)}}">
                                <input type="hidden" id="end_time-{{$list->id}}" value="{{date('d-m-Y H:i:s', $list->end_time)}}">
                                <input type="hidden" id="created_at-{{$list->id}}" value="{{date('d-m-Y H:i:s', $list->created_at)}}">
                                <input type="hidden" id="updated_at-{{$list->id}}" value="{{date('d-m-Y H:i:s', $list->updated_at)}}">
                                <input type="hidden" id="date_perform-{{$list->id}}" value="{{date('d-m-Y H:i:s', $list->date_perform)}}">
                                <input type="hidden" id="created_by-{{$list->id}}" value="{{$list->created_by}}">
                                <input type="hidden" id="year_perform-{{$list->id}}" value="{{$list->year_perform}}">
                                <input type="hidden" id="logs-{{$list->id}}" value="{{$list->logs}}">
                                <input type="hidden" id="updated_by-{{$list->id}}" value="{{$list->updated_by}}">
                                <input type="hidden" id="reconciliation_schedule_code-{{$list->id}}" value="{{$list->reconciliation_schedule_code}}">
                                <input type="hidden" id="is_confirm-{{$list->id}}" value="{{$list->is_confirm}}">
                                <input type="hidden" id="is_used-{{$list->id}}" value="{{$list->is_used}}">

                            </td>
                            <td style="white-space: nowrap;">{{date('d-m-Y H:i:s', $list->start_date)}}</td>
                            <td style="white-space: nowrap;">{{date('d-m-Y H:i:s', $list->end_date)}}</td>
                            <td style="white-space: nowrap;">{{date('d-m-Y H:i:s', $list->start_time)}}</td>
                            <td style="white-space: nowrap;">{{date('d-m-Y H:i:s', $list->end_time)}}</td>
                            <td style="white-space: nowrap;">{{date('d-m-Y', $list->date_perform)}}</td>
                            {{-- <td>{{$list->created_by}}</td> --}}
                            {{-- <td>{{$list->year_perform}}</td> --}}
                            <td style="white-space: nowrap;">{{date('d-m-Y H:i:s', $list->updated_at)}}</td>
                            <td>{{$list->is_confirm?'TRUE':'FALSE'}}</td>
                            <td>{{$list->is_used?'YES':'NO'}}</td>
                            <td style="white-space: nowrap;">
                                <a data-placement="top" title="Update Lịch đối soát VA" wire:click.prevent="$emit('getDateTableScheduleDetailsVAScript', '{{$list->id}}')" data-toggle="modal" data-target="#editScheduleDetailsVA">
                                    <i class="flaticon2-pen"></i> |
                                </a>
                                <a data-placement="top" title="Delete lịch đối soát VA" wire:click.prevent="$emit('deleteScheduleDetailsVAScript', '{{$list->id}}')">
                                    <i class="flaticon2-delete"></i>
                                </a>

                            </td>
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
                    <li wire:click.prevent="gotoCurrentPage({{$i}})" class="page-item {{($i == $currentPage)?'active':''}}">
                        <a class="page-link" href="#">{{$i}}</a>
                    </li>
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>

        Livewire.on('messageScript', (message) =>{

            if(message.warning == false){
                Swal.fire({
                    title: 'Thông báo',
                    text: message.message,
                    icon: 'success',
                    timer: 3000
                })
            }else{
                Swal.fire({
                    title: 'Thông báo',
                    text: message.message,
                    icon: 'error',
                    timer: 3000
                  })
            }


        });

        Livewire.on('confirmScheduleScript', ()=>{
            var ScheduleCode = document.getElementById('ScheduleCodeConfirm').value;
            var YearPerform = document.getElementById('YearPerformConfirm').value;
            Livewire.emit('confirmSchedule', ScheduleCode, YearPerform);
        });

        Livewire.on('ExportScheduleVACSVScript', ()=>{
            var startTime = document.getElementById('startTimeSearch').value;
            var endTime = document.getElementById('endTimeSearch').value;
            var dateTime = document.getElementById('DateTimeSearch').value;
            var createdBy = document.getElementById('search_created_by').value;
            var isUsed = document.getElementById('isUsedSearch').value;
            var isConfirmed = document.getElementById('isConfirmSearch').value;
            var search_schedule_code = document.getElementById('search_schedule_code').value;
            var yearPerform = document.getElementById('search_year_perform').value;


            var protocol = window.location.protocol;
            var host = window.location.host;
            var url = protocol + '//' + host + '/';
            window.open(url + 'ebill-partner-schedule-detail-export?startTime='+ startTime
                +'&endTime='+endTime
                +'&dateTime='+dateTime
                +'&createdBy='+createdBy
                +'&isUsed='+isUsed
                +'&isConfirmed='+isConfirmed
                +'&search_schedule_code='+search_schedule_code
                +'&yearPerform='+yearPerform

                );

            // Livewire.emit('ExportScheduleVACSV', startTime, endTime, dateTime, createdBy, isUsed, isConfirmed, search_schedule_code, yearPerform);
        });


        Livewire.on('showDetailsModal', id=>{
            document.getElementById("chitiet-id").innerHTML = id;
            document.getElementById("chitiet-start_date").innerHTML = document.getElementById("start_date-" + id).value;

            document.getElementById("chitiet-end_date").innerHTML = document.getElementById("end_date-" + id).value;

            document.getElementById("chitiet-start_time").innerHTML = document.getElementById("start_time-" + id).value;

            document.getElementById("chitiet-end_time").innerHTML = document.getElementById("end_time-" + id).value;

            document.getElementById("chitiet-created_at").innerHTML = document.getElementById("created_at-" + id).value;

            document.getElementById("chitiet-updated_at").innerHTML = document.getElementById("updated_at-" + id).value;

            document.getElementById("chitiet-date_perform").innerHTML = document.getElementById("date_perform-" + id).value;

            document.getElementById("chitiet-created_by").innerHTML = document.getElementById("created_by-" + id).value;

            document.getElementById("chitiet-year_perform").innerHTML = document.getElementById("year_perform-" + id).value;

            document.getElementById("chitiet-updated_by").innerHTML = document.getElementById("updated_by-" + id).value;

            var scheduleCode = document.getElementById("reconciliation_schedule_code-" + id).value;
            if(scheduleCode == 'every_day'){
                scheduleCode = "Hằng ngày";
            }

            if(scheduleCode == 'every_week'){
                scheduleCode = "Hằng tuần";
            }

            if(scheduleCode == 'every_month'){
                scheduleCode = "Hằng tháng";
            }

            if(scheduleCode == 'every_three_day'){
                scheduleCode = "Ba ngày 1 lần";
            }

            document.getElementById("chitiet-reconciliation_schedule_code").innerHTML = scheduleCode;

            var isConfirmed = document.getElementById("is_confirm-" + id).value;
            if(isConfirmed == '1'){
                isConfirmed = 'TRUE';
            }else{
                isConfirmed = 'FALSE';
            }

            var isUsed = document.getElementById("is_used-" + id).value;
            if(isUsed == '1'){
                isUsed = 'YES';
            }else{
                isUsed = 'NO';
            }

            document.getElementById("chitiet-is_confirm").innerHTML = isConfirmed;

            document.getElementById("chitiet-is_used").innerHTML = isUsed;

            document.getElementById("chitiet-logs").innerHTML = document.getElementById("logs-" + id).value;

        });



        Livewire.on('updateScript', ()=>{
            var id = document.getElementById('idUpdate').value;
            var startTime = document.getElementById('update_startTime').value;
            var endTime = document.getElementById('update_endTime').value;
            var datePerform = document.getElementById('update_date_perform').value;
            var createdBy = document.getElementById('update_created_by').value;
            var yearPerform = document.getElementById('update_year_perform').value;
            var updatedBy = document.getElementById('update_updated_by').value;
            var scheduleCode = document.getElementById('update_reconciliation_schedule_code').value;
            var isConfirm = document.getElementById('update_is_confirm').value;
            var update_logs = document.getElementById('update_logs').value;

            if(startTime == ''){
                alert('Bạn cần chọn thời gian bắt đầu');
                document.getElementById('update_startTime').focus();
                return;
            }

            if(endTime == ''){
                alert('Bạn cần chọn thời gian kết thúc');
                document.getElementById('update_endTime').focus();
                return;
            }

            if(datePerform == ''){
                alert('Bạn cần chọn ngày đối soát');
                document.getElementById('update_date_perform').focus();
                return;
            }

            if(createdBy == ''){
                alert('Bạn cần chọn người tạo: ');
                document.getElementById('update_created_by').focus();
                return;
            }

            if(yearPerform == ''){
                alert('Bạn cần nhập năm đối soát ');
                document.getElementById('update_year_perform').focus();
                return;
            }

            if(updatedBy == ''){
                alert('Bạn cần nhập người cập nhật: ');
                document.getElementById('update_updated_by').focus();
                return;
            }

            if(scheduleCode == ''){
                alert('Bạn cần chọn lịch đối soát');
                document.getElementById('update_reconciliation_schedule_code').focus();
                return;
            }

            if(isConfirm == ''){
                alert('Bạn cần chọn xác nhận');
                document.getElementById('update_is_confirm').focus();
                return;
            }

            if(update_logs == ''){
                alert('Bạn cần nhập logs');
                document.getElementById('update_logs').focus();
                return;
            }

            Livewire.emit('update', id, startTime, endTime, datePerform, createdBy, yearPerform, updatedBy, scheduleCode, isConfirm, update_logs);
        });

        Livewire.on('getDateTableScheduleDetailsVAScript', id=>{
            document.getElementById('idUpdate').value = id;

            document.getElementById('update_startTime').value = document.getElementById('start_time-' + id).value;
            document.getElementById('update_endTime').value = document.getElementById('end_time-' + id).value;
            document.getElementById('update_date_perform').value = document.getElementById('date_perform-' + id).value;
            document.getElementById('update_created_by').value = document.getElementById('created_by-' + id).value;
            document.getElementById('update_year_perform').value = document.getElementById('year_perform-' + id).value;
            document.getElementById('update_updated_by').value = document.getElementById('updated_by-' + id).value;
            document.getElementById('update_reconciliation_schedule_code').value = document.getElementById('reconciliation_schedule_code-' + id).value;
            document.getElementById('update_is_confirm').value = document.getElementById('is_confirm-' + id).value;
            document.getElementById('update_logs').value = document.getElementById('logs-' + id).value;

        });

        Livewire.on('deleteScheduleDetailsVAScript', id=>{
            Swal.fire({
              title: 'Bạn chắc chắn xóa?',
              // text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.isConfirmed) {
                Livewire.emit('deleteScheduleDetailsVA', id);
              }
            })
        });

        Livewire.on('addnewScript', ()=>{

            var addnew_startTime = document.getElementById('addnew_startTime').value;
            var addnew_endTime = document.getElementById('addnew_endTime').value;
            var addnew_date_perform = document.getElementById('addnew_date_perform').value;

            var created_by = document.getElementById("addnew_created_by").value;
            var year_perform = document.getElementById("addnew_year_perform").value;
            var updated_by = document.getElementById("addnew_updated_by").value;
            var reconciliation_schedule_code = document.getElementById("addnew_reconciliation_schedule_code").value;
            var is_confirm = document.getElementById("addnew_is_confirm").value;
            var is_used = document.getElementById("addnew_is_used").value;

            if(addnew_startTime == ''){
                alert('Thời gian bắt đầu: ');
                document.getElementById("addnew_startTime").focus();
                return;
            }

            if(addnew_endTime == ''){
                alert('Bạn cần nhập thời gian kết thúc: ');
                document.getElementById("addnew_endTime").focus();
                return;
            }

            if(addnew_date_perform == ''){
                alert('Bạn cần nhập ngày đối soát: ');
                document.getElementById("addnew_date_perform").focus();
                return;
            }

            if(created_by == ''){
                alert('Bạn cần nhập người tạo: ');
                document.getElementById("addnew_created_by").focus();
                return;
            }

            if(year_perform == ''){
                alert('Bạn cần nhập ngày đối soát: ');
                document.getElementById("addnew_year_perform").focus();
                return;
            }


            if(updated_by == ''){
                alert('Bạn cần nhập người cập nhật: ');
                document.getElementById("addnew_updated_by").focus();
                return;
            }

            if(reconciliation_schedule_code == ''){
                alert('Bạn cần nhập lịch đối soát: ');
                document.getElementById("addnew_reconciliation_schedule_code").focus();
                return;
            }

            if(is_confirm == ''){
                alert('Bạn cần chọn xác nhận: ');
                document.getElementById("addnew_is_confirm").focus();
                return;
            }
            if(is_used == ''){
                alert('Bạn cần chọn được sử dụng: ');
                document.getElementById("addnew_is_used").focus();
                return;
            }

            Livewire.emit('addnew',addnew_startTime, addnew_endTime, addnew_date_perform, created_by, year_perform, updated_by, reconciliation_schedule_code, is_confirm, is_used);

        });


        Livewire.on('searchScript', ()=>{
            var startTime = document.getElementById('startTimeSearch').value;
            var endTime = document.getElementById('endTimeSearch').value;
            var dateTime = document.getElementById('DateTimeSearch').value;
            var createdBy = document.getElementById('search_created_by').value;
            var isUsed = document.getElementById('isUsedSearch').value;
            var isConfirmed = document.getElementById('isConfirmSearch').value;

            var search_schedule_code = document.getElementById('search_schedule_code').value;

            var yearPerform = document.getElementById('search_year_perform').value;

            Livewire.emit('search', startTime, endTime, dateTime, createdBy, isUsed, isConfirmed, search_schedule_code, yearPerform);
        });
    </script>
@endpush
