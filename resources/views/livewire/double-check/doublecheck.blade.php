@push('css')

@endpush

<div>
    {{-- The whole world belongs to you. --}}

    {{-- chi tiet bao cao doi soat --}}

    <div class="modal fade bd-example-modal-lg" id="chitietbaocaodoisoat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Chi tiết báo cáo đối soát</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row border-bottom mb-4">
                <div class="col font-weight-bold">ID</div>
                <div class="col"><input disabled id="chitiet-ID" type="text" style="border:none; margin: 0;padding: 0;"></div>
                <div class="col font-weight-bold">Partner Code:</div>
                <div class="col"><input disabled id="chitiet-partner_code" type="text" style="border:none; margin: 0;padding: 0;"></div>
            </div>

            <div class="row border-bottom mb-4">
                <div class="col font-weight-bold">Chu kỳ đối soát: </div>
                <div class="col"><input disabled id="chitiet-schedule_code" type="text" style="border:none; margin: 0;padding: 0;"></div>
                <div class="col font-weight-bold">Tổng doanh thu</div>
                <div class="col"><input disabled id="chitiet-sum_revenue" type="text" style="border:none; margin: 0;padding: 0;"></div>
            </div>

            <div class="row border-bottom mb-4">
                <div class="col font-weight-bold">Tổng hoàn tiền</div>
                <div class="col"><input disabled id="chitiet-sum_refund" type="text" style="border:none; margin: 0;padding: 0;"></div>
                <div class="col font-weight-bold">Tổng Hold</div>
                <div class="col"><input disabled id="chitiet-sum_hold" type="text" style="border:none; margin: 0;padding: 0;"></div>
            </div>


            <div class="row border-bottom mb-4">
                <div class="col font-weight-bold">Tổng Unhold</div>
                <div class="col"><input disabled id="chitiet-sum_unhold" type="text" style="border:none; margin: 0;padding: 0;"></div>
                <div class="col font-weight-bold">Tổng phí</div>
                <div class="col"><input disabled id="chitiet-sum_cost" type="text" style="border:none; margin: 0;padding: 0;"></div>
            </div>

            <div class="row border-bottom mb-4">
                <div class="col font-weight-bold">Tổng nhận</div>
                <div class="col"><input disabled id="chitiet-sum_recieve" type="text" style="border:none; margin: 0;padding: 0;"></div>
                <div class="col font-weight-bold">Trạng thái</div>
                <div class="col"><input disabled id="chitiet-status" type="text" style="border:none; margin: 0;padding: 0;"></div>
            </div>

            <div class="row border-bottom mb-4">
                <div class="col font-weight-bold">Lý do</div>
                <div class="col">
                    <input disabled id="chitiet-reason" type="text" style="border:none; margin: 0;padding: 0; display: none;">
                    <span id="text-chitiet-reason" style="color: #737373; font-weight: 400;"></span>
                </div>
                <div class="col font-weight-bold">Ngày gửi đối soát</div>
                <div class="col"><input disabled id="chitiet-date_perform_reconciliation" type="text" style="border:none; margin: 0;padding: 0;"></div>
            </div>

            <div class="row border-bottom mb-4">
                <div class="col font-weight-bold">Start Date</div>
                <div class="col"><input disabled id="chitiet-start_date" type="text" style="border:none; margin: 0;padding: 0;"></div>
                <div class="col font-weight-bold">End Date</div>
                <div class="col"><input disabled id="chitiet-end_date" type="text" style="border:none; margin: 0;padding: 0;"></div>
            </div>

            <div class="row border-bottom mb-4">
                <div class="col font-weight-bold">Created at</div>
                <div class="col"><input disabled id="chitiet-created_at" type="text" style="border:none; margin: 0;padding: 0;"></div>
                <div class="col font-weight-bold">Updated at</div>
                <div class="col"><input disabled id="chitiet-updated_at" type="text" style="border:none; margin: 0;padding: 0;"></div>
            </div>

            <div class="row border-bottom mb-4">
                <div class="col font-weight-bold">Start Time</div>
                <div class="col"><input disabled id="chitiet-start_time" type="text" style="border:none; margin: 0;padding: 0;"></div>
                <div class="col font-weight-bold">End Time</div>
                <div class="col"><input disabled id="chitiet-end_time" type="text" style="border:none; margin: 0;padding: 0;"></div>
            </div>

            <div class="row border-bottom mb-4">
                <div class="col font-weight-bold">Auto approved</div>
                <div class="col text-dark"><span id="">
                    <input id="system_auto_change_cf_success" type="text" style="border:none; margin: 0;padding: 0;">
                </span></div>
                <div class="col font-weight-bold">reconciliation_schedule_detail_id</div>
                <div class="col"><input disabled type="text" id="reconciliation_schedule_detail_id" style="border:none; margin: 0;padding: 0;"></div>
            </div>

            <div class="row">
                <div class="col">
                    <textarea name="" id="chitiet-logs" cols="60" rows="3"></textarea>
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

    {{-- end chi tiet bao cao doi soat --}}

    <div class="block">
                    <div class="block-content">

                      <ul class="nav nav-tabs">
                        <li
                        wire:click.prevent="$emit('TatcastatusScript')"
                        class="nav-item">
                          <a class="nav-link {{($status == null)?'active':''}}" aria-current="page" href="#">Tất cả
                            <span class="text-gray">({{' '. $totalRecord . ' '}})</span></a>
                        </li>
                        <li
                        wire:click.prevent="$emit('Chodoisoatduyet')"
                        class="nav-item">
                          <a class="nav-link {{($status == 'pending')?'active':''}}" href="#">Chờ xử lý
                            <span class="text-gray">({{(isset($pending))?' '. $pending . ' ':'0'}})</span></a>
                        </li>
                        <li
                        wire:click.prevent="$emit('TuchoiScript')"
                        class="nav-item">
                          <a class="nav-link {{($status == 'confirm_fail')?'active':''}}" href="#">Từ chối
                            <span class="text-gray">({{(isset($confirm_fail))?' '. $confirm_fail . ' ':'0'}})</span></a>
                        </li>
                        <li
                        wire:click.prevent="$emit('KhongduyetScript')"
                        class="nav-item">
                          <a class="nav-link {{($status == 'non_processing')?'active':''}}" href="#">Không duyệt
                            <span class="text-gray">({{(isset($non_processing))?' '.$non_processing . ' ':'0'}})</span></a>
                        </li>
                        <li
                        wire:click.prevent="$emit('DaduyetScript')"
                        class="nav-item">
                          <a class="nav-link {{($status == 'processing')?'active':''}}" href="#">Đã duyệt
                            <span class="text-gray">({{(isset($processing))?' '.$processing. ' ':'0'}})</span></a>

                        </li>
                        <li
                        wire:click.prevent="$emit('ChoxacnhanScript')"
                        class="nav-item">
                          <a class="nav-link {{($status == 'wait_confirm')?'active':''}}" href="#">Chờ xác nhận
                            <span class="text-gray">({{(isset($wait_confirm))?' '.$wait_confirm.' ':'0'}})</span></a>
                        </li>
                        <li
                        wire:click.prevent="$emit('XacnhanthanhcongScript')"
                        class="nav-item">
                          <a class="nav-link {{($status == 'confirm_success')?'active':''}}" href="#">Xác nhận
                            <span class="text-gray">({{(isset($confirm_success))?' '.$confirm_success. ' ':'0'}})</span></a>
                        </li>
                      </ul>
                      <div class="block-main">

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="ds_all" role="tabpanel">
                              <div class="block-header mb-3">
                                <div class="row">
                                  <div class="col-3">
                                      <input
                                      wire:keydown.enter="$emit('SearchScript')"
                                      list="partnerCodeList"
                                      id="partner_code_search"
                                      style="padding-left: 2rem;"
                                      type="text" class="form-control ipt-search text-12" placeholder="Nhập partner code">

                                      <datalist id="partnerCodeList">
                                          @if(isset($partnerCodeList))
                                          @foreach($partnerCodeList as $partnerList)
                                          <option value="{{$partnerList->partner_code}}">
                                             {{
                                                ($partnerList->partner_code == $partnerList->name)?'':$partnerList->name}}
                                          </option>
                                          @endforeach
                                          @endif
                                      </datalist>

                                  </div>
                                  <div class="col">
                                      <div class="input-append date text-12">

                                        <input
                                        wire:keydown.enter="$emit('SearchScript')"
                                        autocomplete="off"
                                        placeholder="Từ ngày (theo update at)" id="startTimeSearch" class="form-control text-12" size="16" type="text">
                                        <span class="add-on"></span>
                                      </div>
                                  </div>
                                  <div class="col">
                                    <div class="input-append date text-12">
                                      <input
                                      wire:keydown.enter="$emit('SearchScript')"
                                      autocomplete="off"
                                      placeholder="Đến ngày (theo update at)" id="endTimeSearch" class="form-control text-12" size="16" type="text">
                                      <span class="add-on"></span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-append date text-12">
                                      <input
                                      wire:keydown.enter="$emit('SearchScript')"
                                      autocomplete="off"
                                      placeholder="Ngày gửi đối soát" id="TimeSearchPerform" class="form-control text-12" size="16" type="text">
                                      <span class="add-on"></span>
                                    </div>
                                </div>


                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <input
                                        wire:keydown.enter="$emit('SearchScript')"
                                        style="padding-left: 2rem;"
                                        type="text" class="form-control ipt-search text-12" id="madoisoat" placeholder="Nhập mã đối soát ">
                                    </div>
                                    <div class="col-3">
                                    <div class="d-grid">

                                        <select
                                        wire:keydown.enter="$emit('SearchScript')"
                                        style="margin-top: 5px;" class="form-control" id="search_schedule_code">
                                            <option value="all">Chu kỳ đối soát</option>
                                            <option value="every_day">Hằng ngày</option>
                                            <option value="every_week">Hằng tuần</option>
                                            <option value="every_month">Hằng tháng</option>
                                            <option value="every_three_day">Ba ngày 1 lần</option>
                                        </select>

                                    </div>

                                  </div>
                                    <div class="col">
                                        <input
                                        wire:keydown.enter="$emit('SearchScript')"
                                        id="search_sum_recieve"
                                        style="padding-left: 2rem;" placeholder="Tổng nhận" type="text" class="form-control ipt-search text-12">
                                    </div>
                                    {{-- <div class="col"></div> --}}
                                    <div class="col" style="text-align: right; display: flex;">
                                        <button
                                      wire:click.prevent="$emit('SearchScript')"
                                      style="width: 80px; padding: 10px; margin-top:5px; float: right;"
                                      class="btn btn-success btn-sm btn-block">Tìm kiếm</button>

                                      <button
                                      wire:click.prevent="$emit('ExportCSVCrosscheckScript')"
                                      style="width: 90px; padding: 10px; margin-top:5px; margin-left: 5px; float: right;"
                                      class="btn btn-success btn-sm btn-block">Export CSV</button>
                                    </div>
                                </div>
                              </div>
                              <div class="table-responsive">
                                <div id="listTrans_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer"><div class="top"></div>
                                <table class="table dataTable no-footer sticky" id="listTrans" aria-describedby="listTrans_info">
                                  <thead id="myHeader">
                                    <tr>
                                        <th>
                                            <select
                                            wire:change.prevent="$emit('changeStatusConfirmScript')"
                                            style="width: 65px;"
                                            class="form-select form-select-sm" id="confirm_reject_multi">
                                                <option value="action" selected>Action..</option>
                                                <option value="confirm">Duyệt</option>
                                                <option value="refuse">Không duyệt</option>
                                            </select>

                                            <input
                                            style="margin-left: 10px;"
                                            type="checkbox" id="crosscheck-all-items" name="crosscheck-all" value="check-all">
                                        </th>
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="listTrans" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Mã khách hàng: activate to sort column descending" style="width: 50px; text-align: center;"> ID
                                            {{-- Mã khách hàng --}}
                                        </th>
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="listTrans" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Mã khách hàng: activate to sort column descending" style="width: 50px;">Partner Code
                                            {{-- Mã khách hàng --}}
                                        </th>

                                        <th class="sorting" tabindex="0" aria-controls="listTrans" rowspan="1" colspan="1" aria-label="Ngày: activate to sort column ascending" style="width: 44.1979px; padding-right: 2px;">
                                        Kỳ đối soát
                                    </th>


                                    <th class="sorting" tabindex="0" aria-controls="listTrans" rowspan="1" colspan="1" aria-label="Ngày: activate to sort column ascending" style="width: 44.1979px; padding-right: 2px;">
                                        Ngày gửi đối soát
                                    </th>

                                    <th class="sorting" tabindex="0" aria-controls="listTrans" rowspan="1" colspan="1" aria-label="Ngày: activate to sort column ascending"
                                    style="width: 44.1979px; padding-right: 20px; white-space: nowrap; width: 1%;">
                                        Chu kỳ đối soát
                                    </th>
                                    {{-- <th class="sorting" tabindex="0" aria-controls="listTrans" rowspan="1" colspan="1" aria-label="Dịch vụ: activate to sort column ascending" style="width: 40.3542px;">
                                    Dịch vụ
                                </th> --}}
                                <th class="sorting" tabindex="0" aria-controls="listTrans" rowspan="1" colspan="1" aria-label="Tổng doanh thu: activate to sort column ascending" style="width: 84.125px;">
                                        Tổng doanh thu
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="listTrans" rowspan="1" colspan="1" aria-label="Tổng hoàn tiền: activate to sort column ascending" style="width: 79.3333px;">
                                            Tổng hoàn tiền
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="listTrans" rowspan="1" colspan="1" aria-label="Tổng tạm giữ: activate to sort column ascending" style="width: 71.3542px;">
                                        Tổng hold
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="listTrans" rowspan="1" colspan="1" aria-label="Tổng tạm giữ: activate to sort column ascending" style="width: 71.3542px;">
                                        Tổng unhold
                                    </th>
                                        <th class="sorting" tabindex="0" aria-controls="listTrans" rowspan="1" colspan="1" aria-label="Tổng nhận: activate to sort column ascending" style="width: 57.1146px;">Tổng nhận</th>

                                        <th class="sorting" tabindex="0" aria-controls="listTrans" rowspan="1" colspan="1" aria-label="Trạng thái: activate to sort column ascending" style="width: 70.8125px;">Trạng thái</th>

                                        <th class="sorting" tabindex="0" aria-controls="listTrans" rowspan="1" colspan="1" aria-label="Trạng thái: activate to sort column ascending" style="width: 70.8125px;">Auto approved</th>

                                        <th class="dt-center sorting" tabindex="0" aria-controls="listTrans" rowspan="1" colspan="1" aria-label="Thao tác: activate to sort column ascending" style="width: 45.9583px;">Thao tác</th></tr>
                                  </thead>
                                  <tbody>
                                    @if(isset($messageExport))
                                    <tr>
                                        <td colspan="12"><span class="alert alert-danger">{{$messageExport}}</span></td>
                                    </tr>
                                    @endif
                                    @if(isset($transactionList))
                                    @foreach($transactionList as $list)

                                    <tr class="odd">

                                        <td>
                                            @if($list->status == 'pending')
                                            <input type="checkbox" id="crosscheck-all-{{$list->id}}" name="crosscheck-all" value="{{$list->id}}">
                                            @else

                                            <input disabled type="checkbox" id="crosscheck-all-{{$list->id}}" name="crosscheck-all" value="{{$list->id}}">

                                            @endif
                                        </td>

                                        <td>{{$list->id}}
                                            <input id="ID-{{$list->id}}" type="hidden" value="{{$list->id}}">

                                            <input type="hidden" id="ids-{{$list->id}}" value="{{(isset($list->log->logs->list_trans_ids_total))?$list->log->logs->list_trans_ids_total:""}}">

                                        </td>
                                      <td class="sorting_1">
                                        <a href="#" data-bs-target="#transDetail" data-bs-toggle="offcanvas">
                                            {{$list->partner_code}}
                                            <input id="partner_code-{{$list->id}}" type="hidden" value="{{$list->partner_code}}">
                                            <input id="schedule_code-{{$list->id}}" type="hidden" value="{{$list->schedule_code}}">
                                        </a>
                                        </td>

                                        <td>
                                            <span style="white-space: nowrap;">{{date('d/m/Y', $list->start_date)}} - {{date('d/m/Y', $list->end_date)}}</span>
                                            <input
                                            readonly
                                            id="start_dateXXX-{{$list->id}}"
                                            style="display: none; border: none; width: 150px; margin: 0; padding: 0" type="text" value="{{date('d/m/Y', $list->start_date)}} - {{date('d/m/Y', $list->end_date)}}">
                                        </td>

                                      <td>
                                        <span style="white-space: nowrap;">{{date('d-m-Y', $list->date_perform_reconciliation)}}</span>
                                        <input
                                        id="date_perform_reconciliation-{{$list->id}}"
                                        style="display: none; border: none; width: 100px; margin: 0; padding: 0" type="text" value="{{date('d-m-Y', $list->date_perform_reconciliation)}}">
                                    </td>

                                    <td style="white-space: nowrap; width: 1%;">
                                        {{($list->schedule_code == 'every_day')?'Hằng ngày':''}}
                                        {{($list->schedule_code == 'every_week')?'Hằng tuần':''}}
                                        {{($list->schedule_code == 'every_month')?'Hằng tháng':''}}
                                        {{($list->schedule_code == 'every_three_day')?'Ba ngày 1 lần':''}}
                                    </td>
                                      {{-- <td>Nạp tiền</td> --}}
                                      <td>{{number_format($list->sum_revenue, 0, '', '.')}} đ
                                        <input id="sum_revenue-{{$list->id}}" type="hidden" value="{{number_format($list->sum_revenue, 0, '', '.')}} đ">
                                      </td>
                                      <td>
                                        {{number_format($list->sum_refund, 0, '', '.')}} đ
                                        <input id="sum_refund-{{$list->id}}" type="hidden" value="{{number_format($list->sum_refund, 0, '', '.')}} đ">
                                    </td>
                                      <td>
                                        {{number_format($list->sum_hold, 0, '', '.')}} đ
                                        <input id="sum_hold-{{$list->id}}" type="hidden" value="{{number_format($list->sum_hold, 0, '', '.')}} đ">
                                       </td>
                                       <td>
                                        {{number_format($list->sum_unhold, 0, '', '.')}} đ
                                        <input id="sum_unhold-{{$list->id}}" type="hidden" value="{{number_format($list->sum_unhold, 0, '', '.')}} đ">
                                       </td>
                                      <td>
                                        {{number_format($list->sum_receive, 0, '', '.')}} đ
                                        <input id="sum_receive-{{$list->id}}" type="hidden" value="{{number_format($list->sum_receive, 0, '', '.')}} đ">
                                        <input id="sum_cost-{{$list->id}}" type="hidden"
                                        value="{{number_format($list->sum_cost, 0, '', '.')}} đ">
                                        <input id="reason-{{$list->id}}" type="hidden" value="{{$list->reason}}">
                                        <input id="start_date-{{$list->id}}" type="hidden" value="{{date('d-m-Y H:i:s', $list->start_date)}}">
                                        <input id="end_date-{{$list->id}}" type="hidden" value="{{date('d-m-Y H:i:s', $list->end_date)}}">
                                        <input id="created_at-{{$list->id}}" type="hidden" value="{{date('d-m-Y H:i:s', $list->created_at)}}">
                                        <input id="updated_at-{{$list->id}}" type="hidden" value="{{date('d-m-Y H:i:s', $list->updated_at)}}">
                                        <input id="start_time-{{$list->id}}" type="hidden" value="{{date('d-m-Y H:i:s', $list->start_time)}}">
                                        <input id="end_time-{{$list->id}}" type="hidden" value="{{date('d-m-Y H:i:s', $list->end_time)}}">
                                        <input id="logs-{{$list->id}}" type="hidden" value="{{$list->logs}}">
                                    </td>
                                      <td>
                                        <input id="txt-status-{{$list->id}}" type="hidden" value="{{$list->status}}">
                                        <select
                                        wire:change.prevent="$emit('changeConfirmScript', '{{$list->id}}')"
                                        id="cbx-status-{{$list->id}}"
                                        @if($list->status == 'processing')
                                        {{'disabled'}}
                                        @endif
                                        @if($list->status == 'non_processing')
                                        {{'disabled'}}
                                        @endif
                                        @if($list->status == 'wait_confirm')
                                        {{'disabled'}}
                                        @endif
                                        @if($list->status == 'confirm_success')
                                        {{'disabled'}}
                                        @endif
                                        @if($list->status == 'confirm_fail')
                                        {{'disabled'}}
                                        @endif
                                        class="form-control form-sm form-select form-select
                                        @if($list->status == 'processing')
                                        {{'form-select-green'}}
                                        @elseif($list->status == 'pending')
                                        {{'form-select-blue'}}
                                        @elseif($list->status == 'non_processing')
                                        {{'form-select-error'}}
                                        @endif">
                                            @if($list->status == 'processing')
                                            <option value="processing" data-text-class="form-select-green"> Duyệt </option>
                                            @endif

                                            @if($list->status == 'pending')
                                            <option value="pending" data-text-class="form-select-blue"> Chờ xử lý </option>
                                            <option
                                            value="confirm" data-text-class="form-select-blue"> Duyệt </option>
                                            <option
                                            value="refuse" data-text-class="form-select-blue"> Không duyệt </option>

                                            @endif

                                            @if($list->status == 'non_processing')
                                            <option value="confirm_fail" data-text-class="form-select-error" selected=""> Không duyệt </option>
                                            @endif

                                            @if($list->status == 'wait_confirm')
                                            <option value="confirm_fail" data-text-class="form-select-error" selected=""> Chờ xác nhận </option>
                                            @endif

                                            @if($list->status == 'confirm_success')
                                            <option value="confirm_fail" data-text-class="form-select-error" selected=""> Xác nhận </option>
                                            @endif

                                            @if($list->status == 'confirm_fail')
                                            <option value="confirm_fail" data-text-class="form-select-error" selected=""> Từ chối </option>
                                            @endif
                                      </select>
                                      </td>

                                      <td>
                                            {{(isset($list->system_auto_change_cf_success))?'Có':'Không'}}
                                            <input type="hidden" id="system_auto_change_cf_success-{{$list->id}}" value="{{(isset($list->system_auto_change_cf_success))?'Có':'Không'}}">
                                            <input type="hidden" id="reconciliation_schedule_detail_id-{{$list->id}}" value="{{$list->reconciliation_schedule_detail_id}}">
                                       </td>

                                      <td class="dt-center" style="white-space: nowrap; width: 1%;">
                                        <a
                                        wire:click.prevent="$emit('BienBanDoiSoatScript', '{{$list->id}}')"
                                        href="#">
                                          <i class="ic-page">Chi tiết</i>
                                        </a> |
                                        <a
                                        wire:click.prevent="$emit('showBaocaoDoisoatChitietScript', '{{$list->id}}')"
                                        data-toggle="modal"
                                        data-target="#chitietbaocaodoisoat"
                                        >
                                            <i
                                            style="font-size: 15px;"
                                            class="flaticon2-search-1"></i>
                                        </a> |
                                        <a wire:click.prevent="$emit('ExportTransactionCrossCheckScript', '{{$list->id}}')" class="flaticon2-arrow-down" style="color: #333333; cursor: pointer;"></a>
                                      </td>
                                    </tr>
                                    @endforeach
                                    @endif

                                </tbody>
                                </table>
                                <div class="bottom_paging">
                                    @if($currentPage < 6)
                                    <div class="dataTables_info" id="listTrans_info" role="status" aria-live="polite">Hiển thị {{$limit}} của {{$totalRecord}} bản danh sách</div>
                                    @endif

                                    <div class="dataTables_length" id="listTrans_length">
                                        <label>Hiển thị
                                            <select
                                                id="select-box-total-record"
                                                wire:change.prevent="$emit('selectTotalRecordScript')"
                                                name="listTrans_length" aria-controls="listTrans" class="form-select form-select-sm">
                                                <option value="10">10</option>
                                                <option value="30">30</option>
                                                <option value="35">35</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select> danh sách</label>
                                    </div>
                                    <div class="dataTables_paginate paging_numbers" id="listTrans_paginate">
                                        <ul class="pagination">
                                        @for($i = $start; $i <= $end; $i++)
                                        <li
                                        wire:click.prevent="gotoCurrentPage('{{$i}}')"
                                        class="paginate_button page-item @if($currentPage == $i) {{'active'}} @endif">
                                            <a aria-controls="listTrans" data-dt-idx="0" tabindex="0" class="page-link">{{$i}}</a>
                                        </li>
                                        @endfor
                                    </ul>
                                </div>
                            </div>
                        </div>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="ds_pending" role="tabpanel">

                            </div>
                            <div class="tab-pane fade" id="ds_reject" role="tabpanel">

                            </div>
                            <div class="tab-pane fade" id="ds_not_approve" role="tabpanel">

                            </div>
                        </div>

                      </div>
                    </div>

                  </div>


                  <div class="loadingWrap" id="loadingWrap" style="display: none;">
                    @livewire('loading.loading')
                </div>

               {{--  <div wire:loading wire:target="loading" class="loadingWrap">
                    @livewire('loading.loading')
                </div> --}}

</div>
 @push('scriptsChart')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>

        $(document).ready(function(){
            $('#crosscheck-all-items').click(function(){
                if($('#crosscheck-all-items').prop('checked')) {

                    var chkBoxAll = document.getElementsByName('crosscheck-all');

                    for (var i = 0; i < chkBoxAll.length; i++){
                        chkBoxAll[i].checked = true;
                    }
                } else {

                    var chkBoxAll = document.getElementsByName('crosscheck-all');

                    for (var i = 0; i < chkBoxAll.length; i++){
                        chkBoxAll[i].checked = false;
                    }
                }
            });
        });



    </script>

  {{--   <script>
    window.onscroll = function() {myFunction()};

    var header = document.getElementById("myHeader");
    var sticky = header.offsetTop;

    function myFunction() {
      if (window.pageYOffset > sticky) {
        header.classList.add("sticky");
      } else {
        header.classList.remove("sticky");
      }
    }
    </script>
 --}}
 @endpush
