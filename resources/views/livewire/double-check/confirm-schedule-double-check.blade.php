<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Lịch đối soát
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <button

                    data-toggle="modal"
                    data-target="#Confirmlichdoisoat"
                    style="margin-right: 5px;"
                    class="btn btn-primary">Confirm</button>

                    <button
                    wire:click.prevent="$emit('ExportConfirmScheduleScript')"
                    style="margin-right: 5px;"
                    class="btn btn-primary">Export</button>

                    <button
                    data-toggle="modal"
                    data-target="#add-new-confirm-schedule"
                    wire:click.prevent="$emit('AddnewConfirmScheduleScript')"
                    class="btn btn-primary">Add new</button>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">

            {{-- modal confirm lich doi soat --}}

            <div wire:ignore.self class="modal fade" id="Confirmlichdoisoat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm lịch đối soát</h5>
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
                            Schedule Code:
                            <select class="form-control" id="ScheduleCodeConfirm">
                                <option value="every_day">Hằng ngày</option>
                                <option value="every_week">Hằng tuần</option>
                                <option value="every_month">Hằng tháng</option>
                                <option value="every_three_day">Ba ngày 1 lần</option>
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
                    <button
                    wire:click.prevent="$emit('ConfirmLichDoiSoatScript')"
                    type="button" class="btn btn-primary">Save</button>
                  </div>
                </div>
              </div>
            </div>
            {{-- end modal confirm lich doi soat --}}

            {{-- start modal chi tiet --}}

            <div class="modal fade bd-example-modal-lg" id="Chitietdoisoat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chi tiết</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row" style="border-bottom: 1px solid #EEEEEE;">
                        <div class="col" style="font-weight: bold;">ID: </div>
                        <div class="col"><input
                            style="border: none; margin: 0; padding: 0;"
                            id="chitiet-ID" type="text" value=""></div>
                        <div class="col" style="font-weight: bold;">StartDate: </div>
                        <div class="col">
                            <input
                            style="border: none; margin: 0; padding: 0;"
                            type="text" id="chitiet-startDate">
                        </div>
                        <div class="col" style="font-weight: bold;">EndDate: </div>
                        <div class="col">
                            <input
                            style="border: none; margin: 0; padding: 0;"
                            type="text" id="chitiet-endDate"></div>
                    </div>
                    <div class="row" style="margin-top: 15px; border-bottom: 1px solid #EEEEEE;">
                        <div class="col" style="font-weight: bold;">StartTime: </div>
                        <div class="col">
                            <input
                            style="border: none; margin: 0; padding: 0;"
                            type="text" id="chitiet-startTime"></div>
                        <div class="col" style="font-weight: bold;">EndTime: </div>
                        <div class="col">
                            <input
                            style="border: none; margin: 0; padding: 0;"
                            type="text" id="chitiet-endTime"></div>
                        <div class="col" style="font-weight: bold;">Date Perform</div>
                        <div class="col">
                            <input
                            style="border: none; margin: 0; padding: 0;"
                            type="text" id="chitiet-DatePerform"></div>
                    </div>
                    <div class="row" style="margin-top: 15px; border-bottom: 1px solid #EEEEEE;">
                        <div class="col" style="font-weight: bold;">Created By: </div>
                        <div class="col">
                            <input
                            style="border: none; margin: 0; padding: 0;"
                            type="text" id="chitiet-createdBy"></div>
                        <div class="col" style="font-weight: bold;">Year Perform: </div>
                        <div class="col">
                            <input
                            style="border: none; margin: 0; padding: 0;"
                            type="text" id="chitiet-YearPerform"></div>
                        <div class="col" style="font-weight: bold;">Update By: </div>
                        <div class="col">
                            <input
                            style="border: none; margin: 0; padding: 0;"
                            type="text" id="chitiet-updateBy"></div>
                    </div>
                    <div class="row" style="margin-top: 15px; border-bottom: 1px solid #EEEEEE;">
                        <div class="col" style="font-weight: bold;">Schedule Code: </div>
                        <div class="col">
                            <input
                            style="border: none; margin: 0; padding: 0;"
                            type="text" id="chitiet-cheduleCode"></div>
                        <div class="col" style="font-weight: bold;">Is Confirmed: </div>
                        <div class="col">
                            <input
                            style="border: none; margin: 0; padding: 0;"
                            type="text" id="chitiet-isConfirm"></div>
                        <div class="col" style="font-weight: bold;">Is Used: </div>
                        <div class="col">
                            <input
                            style="border: none; margin: 0; padding: 0;"
                            type="text" id="chitiet-isUsed"></div>
                    </div>
                    <div class="row" style="margin-top: 15px; border-bottom: 1px solid #EEEEEE;">
                        <div class="col" style="font-weight: bold;">Created at: </div>
                        <div class="col">
                            <input
                            style="border: none; margin: 0; padding: 0;"
                            type="text" id="chitiet-createdAt"></div>
                        <div class="col" style="font-weight: bold;">Update at: </div>
                        <div class="col">
                            <input
                            style="border: none; margin: 0; padding: 0;"
                            type="text" id="chitiet-updateAt"></div>
                        <div class="col"></div>
                        <div class="col"></div>
                    </div>
                    <div class="row" style="margin-top: 15px; border-bottom: 1px solid #EEEEEE;">
                        <div class="col" style="font-weight: bold;">
                            Logs
                        </div>
                    </div>
                    <div class="row" border-bottom: 1px solid #EEEEEE;>
                        <div class="col">
                            <div class="col">
                            <textarea
                            style=" border: none; margin: 0; padding: 0;"
                            placeholder="Log here"
                            name="" id="chitiet-log" cols="70" rows="10"></textarea>
                        </div>
                        </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                  </div>
                </div>
              </div>
            </div>

            {{-- end modal chi tiet --}}

            {{-- start modal update --}}
            <div class="row">
                <div class="col">
                    <div
                    wire:ignore.self
                    class="modal fade" id="Sualichdoisoat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            @elseif(isset($message) and $warning)
                            <div class="row">
                                <div class="col">
                                    <span class="alert alert-warning">{{$message}}</span>
                                </div>
                            </div>
                            @endif
                            <div class="row">
                                <div class="col">
                                    <label for="startTimeupdate">Thời gian bắt dầu</label>
                                    <input
                                    placeholder="d-m-Y H:i:s"
                                    type="text" id="startTimeupdate" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="endTimeUpdate">Thời gian kết thúc</label>
                                    <input
                                    placeholder="d-m-Y H:i:s"
                                    type="text" id="endTimeUpdate" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="TimeDatePerformUpdate">Ngày đối soát</label>
                                    <input
                                    placeholder="d-m-Y"
                                    type="text" id="TimeDatePerformUpdate" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="TimeDatePerformUpdate">Năm đối soát</label>
                                    <input
                                    placeholder="2021"
                                    type="text" id="namdoisoatupdate" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="kieudoisoatupdate">Kiểu đối soát</label>
                                    <select
                                    id="kieudoisoatupdate"
                                    class="form-control">
                                        <option id="every_day" value="every_day">Hằng ngày</option>
                                        <option id="every_week" value="every_week">Hằng tuần</option>
                                        <option id="every_month" value="every_month">Hằng tháng</option>
                                        <option id="every_three_day" value="every_three_day">Ba ngày 1 lần</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div
                                    style="margin-top: 20px"
                                    class="form-check form-switch">
                                        <label for="isConfirmed">Is Confirmed</label>
                                        <input
                                        style="width: 20px; height: 20px;"
                                        type="checkbox" value="" id="isConfirmedUpdate" >
                                    </div>
                                </div>
                          </div>

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button
                            wire:click.prevent="$emit('updateConfirmScheduleScript')"
                            type="button" class="btn btn-primary">Save</button>
                            <input type="hidden" id="IDUpdateScheduleConfirm"
                            value="{{$idUpdate}}">
                            <input type="hidden" id="LogUpdate" value="{{$logUpdate}}">
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
            {{-- end modal update --}}

            <div class="row">
                <div class="col">
                    {{-- start modal add new --}}
            <div wire:ignore.self class="modal fade" id="add-new-confirm-schedule" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <div class="row">
                        <div class="col">
                            <label>Thời gian bắt đầu</label>
                            <input
                            placeholder="d-m-Y H:i:s"
                            autocomplete="off"
                            class="form-control" type="text" id="startTimeSearchAddnew">
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <label>Thời gian kết thúc</label>
                            <input
                            placeholder="d-m-Y H:i:s"
                            autocomplete="off"
                            class="form-control" type="text" id="endTimeSearchAddnew">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label>Ngày đối soát</label>
                            <input
                            placeholder="d-m-Y H:i:s"
                            autocomplete="off"
                            class="form-control" type="text" id="TimeDatePerform">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>Năm đối soát</label>
                            <input
                            id="namdoisoat"
                            type="text" class="form-control" value="{{date('Y')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>Kiểu đối soát</label>
                            <select
                            id="kieudoisoat"
                            class="form-control">
                                <option value="every_day">Hằng ngày</option>
                                <option value="every_week">Hằng tuần</option>
                                <option value="every_month">Hằng tháng</option>
                                <option value="every_three_day">Ba ngày 1 lần</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div
                            style="margin-top: 20px"
                            class="form-check form-switch">
                                <label for="isConfirmed">Is Confirmed</label>
                                <input
                                style="width: 20px; height: 20px;"
                                type="checkbox" value="" id="isConfirmed" >
                            </div>
                        </div>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button
                    wire:click.prevent="$emit('AddnewScheduleConfirmScript')"
                    type="button" class="btn btn-primary">Save</button>
                  </div>
                </div>
              </div>
            </div>
            {{-- end modal add new --}}
                </div>
            </div>
            {{-- start search --}}
            <div class="row">
                <div class="col">
                    <span> Time start:</span>
                    <span>
                        <input
                        placeholder="Tìm theo update at"
                        style="padding-left: 25px;" class="form-control" type="text" id="startTimeSearch">
                    </span>
                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                        <span style="position: absolute; top: 30px; left: 16px; font-size: 20px;">
                            <i class="la la-search"></i>
                        </span>
                    </span>
                </div>
                <div class="col">
                    <span> Time end: </span>
                    <span>
                        <input
                        style="padding-left: 25px;"
                        placeholder="Tìm theo update at"
                        class="form-control" type="text" id="endTimeSearch">
                    </span>
                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                        <span style="position: absolute; top: 30px; left: 16px; font-size: 20px;">
                            <i class="la la-search"></i>
                        </span>
                    </span>
                </div>
                <div class="col">
                    <span> Date Perform: </span>
                    <span>
                        <input
                        style="padding-left: 25px;"
                        placeholder="d-m-Y H:i:s"
                        class="form-control" type="text" id="TimeDatePerformSearch">
                    </span>
                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                        <span style="position: absolute; top: 30px; left: 16px; font-size: 20px;">
                            <i class="la la-search"></i>
                        </span>
                    </span>
                </div>

                <div class="col">
                    <span> Created by: </span>
                    <span>
                        <input
                        style="padding-left: 25px;"
                        placeholder="admin@appota.com"
                        class="form-control" type="text" id="createdBy">
                    </span>
                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                        <span style="position: absolute; top: 30px; left: 16px; font-size: 20px;">
                            <i class="la la-search"></i>
                        </span>
                    </span>
                </div>

            </div>
            <div class="row">
                <div class="col" style="margin-top: 15px;">

                    {{-- <span style="margin-left: 20px;"> Is Used: </span> --}}
                    <span>
                        <select
                        style="margin-left: 21px; margin-top: 0px; padding-left: 26px;"
                        class="form-control" id="isUsedSearch">
                        <option value="">Is used..</option>
                        <option value="1">YES</option>
                        <option value="0">NO</option>
                        </select>
                    </span>

                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                        <span style="position: absolute; top: 5px; left: 35px; font-size: 20px;">
                            <i class="la la-search"></i>
                        </span>
                    </span>


                    {{-- <span style="margin-left: 22px; margin-right: 20px;"> Is Used: </span>
                    <span>
                        <input
                        type="checkbox"
                        style="height: 25px; width: 25px;"
                        placeholder="d-m-Y H:i:s" type="text" id="isUsedSearch">
                    </span> --}}

                </div>
                <div class="col" style="margin-top: 15px;">

                    <span>
                        <select
                        style="margin-left: 21px; margin-top: 0px; padding-left: 26px;"
                        class="form-control" id="isConfirmSearch">
                        <option value="">Is confirmed..</option>
                        <option value="1">Confirmed</option>
                        <option value="0">No confirmed</option>
                        </select>
                    </span>

                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                        <span style="position: absolute; top: 5px; left: 35px; font-size: 20px;">
                            <i class="la la-search"></i>
                        </span>
                    </span>

                    {{-- <span style="margin-left: 22px; margin-right: 20px;"> Is Confirmed: </span>
                    <span>
                        <input
                        type="checkbox"
                        style="height: 25px; width: 25px;"
                        placeholder="d-m-Y H:i:s" type="text" id="isConfirmSearch">
                    </span> --}}

                </div>
                <div class="col">
                    <span style="margin-left: 20px;"> Schedule: </span>
                    <span>
                        <select
                        style="margin-left: 21px; padding-left: 26px;"
                        class="form-control" id="search_schedule_code">
                            <option value="all">All</option>
                            <option value="every_day">Hằng ngày</option>
                            <option value="every_week">Hằng tuần</option>
                            <option value="every_month">Hằng tháng</option>
                            <option value="every_three_day">Ba ngày 1 lần</option>
                        </select>
                    </span>
                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                        <span style="position: absolute; top: 25px; left: 35px; font-size: 20px;">
                            <i class="la la-search"></i>
                        </span>
                    </span>

                </div>
                <div class="col">
                    <span style="margin-left: 20px;"> Year perform: </span>
                    <span>
                        <input
                        placeholder="Nhập năm"
                        type="text"
                        style="margin-left: 21px; margin-top: 0px; padding-left: 26px;"
                        class="form-control" id="search_year_perform">

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
                <div class="col">
                    <span style="float: right;">
                        <button
                        style="margin-top: 15px;"
                        wire:click.prevent="$emit('SearchConfirmlichdoisoatScript')"
                        class="btn btn-primary">Search</button>
                    </span>

                </div>
            </div>


        </div>
        <div class="kt-portlet__body" style="overflow: scroll;">

            <table class="table table-light">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th style="white-space: nowrap;">Start Date</th>

                        <th style="white-space: nowrap;">End Date</th>
                        <th style="white-space: nowrap;">Start Time</th>
                        <th style="white-space: nowrap;">End Time</th>
                        <th style="white-space: nowrap;">Date Perform</th>
                        <th style="white-space: nowrap;">Created By</th>
                        <th style="white-space: nowrap;">Year Perform</th>
                        <th>Schedule</th>
                        <th style="white-space: nowrap;">Is Confirm</th>
                        <th style="white-space: nowrap;">Is Used</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @dd($listScheduleConfirm) --}}
                    @if(isset($listScheduleConfirm))
                    @foreach($listScheduleConfirm->data as $list)
                    <tr>
                        <td>{{$list->id}}</td>
                        <td >{{date('d-m-Y H:i:s', $list->start_date)}}
                            <input
                            style="border:none; margin: 0; padding: 0;"
                            id="startDate-{{$list->id}}"
                            type="hidden" value="{{date('d-m-Y H:i:s', $list->start_date)}}">
                        </td>
                        <td>{{date('d-m-Y H:i:s', $list->end_date)}}
                            <input
                            id="endDate-{{$list->id}}"
                            type="hidden" value="{{date('d-m-Y H:i:s', $list->start_date)}}">
                        </td>
                        <td>{{date('d-m-Y H:i:s', $list->start_time)}}
                            <input
                            id="startTime-{{$list->id}}"
                            type="hidden" value="{{date('d-m-Y H:i:s', $list->start_time)}}">
                        </td>
                        <td>{{date('d-m-Y H:i:s', $list->end_time)}}
                            <input
                            id="endTime-{{$list->id}}"
                            type="hidden" value="{{date('d-m-Y H:i:s', $list->end_time)}}">
                        </td>
                        <td>{{date('d-m-Y', $list->date_perform)}}
                            <input
                            id="datePerform-{{$list->id}}"
                            type="hidden" value="{{date('d-m-Y', $list->date_perform)}}">
                        </td>
                        <td>{{$list->created_by}}</td>
                        <td>{{$list->year_perform}}
                            <input
                            id="yearPerform-{{$list->id}}"
                            type="hidden" value="{{$list->year_perform}}">
                        </td>
                        <td>{{$list->reconciliation_schedule_code}}
                            <input
                            id="reconciliation_schedule_code-{{$list->id}}"
                            type="hidden" value="{{$list->reconciliation_schedule_code}}">
                        </td>
                        <td>
                            {{($list->is_confirm == '1')?'Confirmed':'Not Confirmed'}}
                            <input
                            id="isConfirm-{{$list->id}}"
                            type="hidden" value="{{$list->is_confirm}}">
                            <input
                            id="log-{{$list->id}}"
                            type="hidden" value="{{$list->logs}}">
                            <input
                            id="is_used-{{$list->id}}"
                            type="hidden" value="{{$list->is_used}}">
                            <input
                            id="updated_by-{{$list->id}}"
                            type="hidden" value="{{$list->updated_by}}">
                            <input
                            id="created_by-{{$list->id}}"
                            type="hidden" value="{{$list->created_by}}">
                            <input
                            id="created_at-{{$list->id}}"
                            type="hidden" value="{{date('d-m-Y H:i:s', $list->created_at)}}">
                            <input
                            id="updated_at-{{$list->id}}"
                            type="hidden" value="{{date('d-m-Y H:i:s', $list->updated_at)}}">
                        </td>
                        <td>
                            {{($list->is_used == '1')?'Yes':'No'}}
                        </td>
                        <td>

                            <a
                            data-placement="top" title="Sửa lịch đối soát" wire:click.prevent="$emit('getDateTableUpdateScript', '{{$list->id}}')" data-toggle="modal" data-target="#Sualichdoisoat">
                                <i class="flaticon2-pen"></i> |
                            </a>
                            <a
                            data-placement="top" title="Xóa lịch đối soát" wire:click.prevent="$emit('deleteScheduleConfirmScript', '{{$list->id}}')">
                                <i class="flaticon2-delete"></i> |
                            </a>
                            <a
                            wire:click.prevent="$emit('ShowChitietdoisoatScript', '{{$list->id}}')"
                            data-toggle="modal"
                            data-target="#Chitietdoisoat"
                            >
                                <i
                                style="font-size: 1.15rem; color: #93a2dd; cursor: pointer;"
                                class="flaticon-search-magnifier-interface-symbol"></i>
                            </a>
                            <input type="text" width="70px" height="1px" style="visibility: hidden;">

                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            @if(isset($listScheduleConfirm))
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <li
                wire:click.prevent="gotoCurrentPage('{{$currentPage - 1}}')"
                class="page-item @if($currentPage <= 1) {{'disabled'}} @endif">
                  <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                  </a>
                </li>
                @for($i = $start; $i <= $end; $i++)
                <li
                wire:click.prevent="gotoCurrentPage('{{$i}}')"
                class="page-item @if($currentPage == $i) {{'active'}} @endif"><a class="page-link" href="#">{{$i}}</a></li>
                @endfor
                <li
                wire:click.prevent="gotoCurrentPage('{{$currentPage + 1}}')"
                class="page-item">
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
