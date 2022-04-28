@push('css')
<style>


</style>
@endpush

<div>

    <div wire:ignore.self class="modal fade bd-example-modal-lg" id="chitietbaocaodoisoat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Chi tiết</h5>
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
                <div class="col"><input disabled id="chitiet-sum_receive" type="text" style="border:none; margin: 0;padding: 0;"></div>
                <div class="col font-weight-bold">Tổng Phí</div>
                <div class="col"><input disabled id="chitiet-sum_cost" type="text" style="border:none; margin: 0;padding: 0;"></div>
            </div>


            <div class="row border-bottom mb-4">
                <div class="col font-weight-bold">Trạng thái</div>
                <div class="col"><input disabled id="chitiet-status" type="text" style="border:none; margin: 0;padding: 0;"></div>

                <div class="col font-weight-bold">Lý do</div>
                <div class="col"><input disabled id="chitiet-reason" type="text" style="border:none; margin: 0;padding: 0;"></div>
            </div>

            <div class="row border-bottom mb-4">
                <div class="col font-weight-bold">Ngày gửi đối soát</div>
                <div class="col"><input disabled id="chitiet-date_perform_reconciliation" type="text" style="border:none; margin: 0;padding: 0;"></div>

                <div class="col font-weight-bold">Ngày bắt đầu đối soát</div>
                <div class="col"><input disabled id="chitiet-start_date" type="text" style="border:none; margin: 0;padding: 0;"></div>
            </div>

            <div class="row border-bottom mb-4">
                <div class="col font-weight-bold">Ngày kết thúc đối soát</div>
                <div class="col">
                    <input disabled id="chitiet-end_date" type="text" style="border:none; margin: 0;padding: 0;">
                </div>
                <div class="col font-weight-bold">Created at</div>
                <div class="col"><input disabled id="chitiet-created_at" type="text" style="border:none; margin: 0;padding: 0;"></div>
            </div>

            <div class="row border-bottom mb-4">
                <div class="col font-weight-bold">Updated at</div>
                <div class="col"><input disabled id="chitiet-updated_at" type="text" style="border:none; margin: 0;padding: 0;"></div>

                <div class="col font-weight-bold">Start time</div>
                <div class="col"><input disabled id="chitiet-start_time" type="text" style="border:none; margin: 0;padding: 0;"></div>
            </div>

            <div class="row border-bottom mb-4">
                <div class="col font-weight-bold">End time</div>
                <div class="col"><input disabled id="chitiet-end_time" type="text" style="border:none; margin: 0;padding: 0;"></div>

                <div class="col font-weight-bold">reconciliation schedule detail id</div>
                <div class="col"><input disabled id="chitiet-reconciliation_schedule_detail_id" type="text" style="border:none; margin: 0;padding: 0;"></div>
            </div>

            <div class="row border-bottom mb-4">
                <div class="col font-weight-bold">Tổng tiền chuyển khoản trực tiếp</div>
                <div class="col"><input disabled id="chitiet-sum_transfer_direct" type="text" style="border:none; margin: 0;padding: 0;"></div>
                <div class="col font-weight-bold">Tổng số giao dịch thành công</div>
                <div class="col"><input disabled id="chitiet-total_trans_revenue" type="text" style="border:none; margin: 0;padding: 0;"></div>
            </div>

          {{--   <div class="row border-bottom mb-4">
                <div class="col font-weight-bold">Auto approved</div>
                <div class="col text-dark"><span id="">
                    <input id="system_auto_change_cf_success" type="text" style="border:none; margin: 0;padding: 0;">
                </span></div>
                <div class="col font-weight-bold">reconciliation_schedule_detail_id</div>
                <div class="col"><input disabled type="text" id="reconciliation_schedule_detail_id" style="border:none; margin: 0;padding: 0;"></div>
            </div> --}}

            <div class="row">
                <div class="col">
                    <div id="chitiet-logs" style="width: 100%; height: 100px; overflow: scroll;" >
                        {{(isset($logsData))?$logsData:""}}
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

    {{-- end chi tiet bao cao doi soat --}}

    <div class="block">
        <div class="block-content">

            <ul class="nav nav-tabs">
                <li
                    wire:click.prevent="$emit('TatcastatusScript')"
                    class="nav-item">
                    <a class="nav-link {{(!isset($status))?'active':''}}" aria-current="page" href="#">Tất cả<span class="text-gray">({{' '. $totalRecord . ' '}})</span></a>
                </li>
                <li
                        wire:click.prevent="$emit('Chodoisoatduyet')"
                        class="nav-item">
                          <a class="nav-link {{($status == 'pending')?'active':''}}" href="#">Chờ xử lý (<span class="text-gray">{{(isset($pending))?' '. $pending . ' ':'0'}}</span>)</a>
                        </li>
                        <li
                        wire:click.prevent="$emit('TuchoiScript')"
                        class="nav-item">
                          <a class="nav-link {{($status == 'confirm_fail')?'active':''}}" href="#">Từ chối <span class="text-gray">({{(isset($confirm_fail))?' '. $confirm_fail . ' ':'0'}})</span></a>
                        </li>
                        <li
                        wire:click.prevent="$emit('KhongduyetScript')"
                        class="nav-item">
                          <a class="nav-link {{($status == 'non_processing')?'active':''}}" href="#">Không duyệt<span class="text-gray">({{(isset($non_processing))?' '.$non_processing . ' ':'0'}})</span></a>
                        </li>
                        <li
                        wire:click.prevent="$emit('DaduyetScript')"
                        class="nav-item">
                          <a class="nav-link {{($status == 'processing')?'active':''}}" href="#">Đã duyệt <span class="text-gray">({{(isset($processing))?' '.$processing. ' ':'0'}})</span></a>

                        </li>
                        <li
                        wire:click.prevent="$emit('ChoxacnhanScript')"
                        class="nav-item">
                          <a class="nav-link {{($status == 'wait_confirm')?'active':''}}" href="#">Chờ xác nhận <span class="text-gray">({{(isset($wait_confirm))?' '.$wait_confirm.' ':'0'}})</span></a>
                        </li>
                        <li
                        wire:click.prevent="$emit('XacnhanthanhcongScript')"
                        class="nav-item">
                          <a class="nav-link {{($status == 'confirm_success')?'active':''}}" href="#">Xác nhận <span class="text-gray">({{(isset($confirm_success))?' '.$confirm_success. ' ':'0'}})</span></a>
                        </li>
                      </ul>
                      <div class="block-main">

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="ds_all" role="tabpanel">
                              <div class="block-header mb-3">
                                <div class="row">
                                  <div class="col">
                                      <input
                                      wire:keydown.enter="$emit('SearchebillVaScript')"
                                      list="partnerCodeList"
                                      id="partner_code_search"
                                      style="padding-left: 2rem;"
                                      type="text" class="form-control ipt-search text-12" placeholder="Nhập partner code">

                                      <datalist id="partnerCodeList">
                                          @if(isset($partnerCodeList->data))
                                          @foreach($partnerCodeList->data as $partnerList)
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
                                        wire:keydown.enter="$emit('SearchebillVaScript')"
                                        autocomplete="off"
                                        placeholder="Từ ngày" id="startTimeSearch" class="form-control text-12" size="16" type="text">
                                        <span class="add-on"></span>
                                      </div>
                                  </div>
                                  <div class="col">
                                    <div class="input-append date text-12">
                                      <input
                                      wire:keydown.enter="$emit('SearchebillVaScript')"
                                      autocomplete="off"
                                      placeholder="Đến ngày" id="endTimeSearch" class="form-control text-12" size="16" type="text">
                                      <span class="add-on"></span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-append date text-12">
                                      <input
                                      wire:keydown.enter="$emit('SearchebillVaScript')"
                                      autocomplete="off"
                                      placeholder="Ngày gửi đối soát" id="TimeSearchPerform" class="form-control text-12" size="16" type="text">
                                      <span class="add-on"></span>
                                    </div>
                                </div>

                                  <div class="col">
                                    <div class="d-grid">

                                        <select
                                        wire:keydown.enter="$emit('SearchebillVaScript')"
                                        style="margin-top: 5px;" class="form-control" id="search_schedule_code">
                                            <option value="all">Chu kỳ đối soát</option>
                                            <option value="every_day">Hằng ngày</option>
                                       {{--      <option value="every_week">Hằng tuần</option>
                                            <option value="every_month">Hằng tháng</option>
                                            <option value="every_three_day">Ba ngày 1 lần</option> --}}
                                        </select>

                                    </div>

                                  </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input
                                        wire:keydown.enter="$emit('SearchebillVaScript')"
                                        id="sum_recieve_search"
                                        style = "padding-left: 2rem;"
                                        type="text" class="form-control ipt-search text-12" placeholder="Tổng nhận">
                                    </div>
                                    <div class="col"></div>
                                    <div class="col"></div>
                                    <div class="col"></div>
                                    <div class="col d-flex" style="text-align: right;">

                                    <button
                                      wire:click.prevent="$emit('SearchebillVaScript')"
                                      style="width: 80px; padding: 10px; margin-top:5px; float: right;"
                                      class="btn btn-success btn-sm btn-block">Tìm kiếm</button>


                                      <button
                                      wire:click.prevent="$emit('ExportbillVaScript')"
                                      style="width: 80px; padding: 10px; margin-top:5px; margin-left: 10px; float: right;"
                                      class="btn btn-success btn-sm btn-block">Export</button>
                                    </div>
                                </div>
                              </div>
                              <div class="table-responsive">
                                <div id="listTrans_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer"><div class="top"></div>
                                <table class="table dataTable no-footer" id="listTrans" aria-describedby="listTrans_info">
                                  <thead>
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
                                    <th style="white-space: nowrap;" class="sorting sorting_asc" tabindex="0" aria-controls="listTrans" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Mã khách hàng: activate to sort column descending" style="width: 50px;">Partner Code
                                            {{-- Mã khách hàng --}}
                                    </th>

                                    <th style="white-space: nowrap;" class="sorting sorting_asc" tabindex="0" aria-controls="listTrans" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Ngày đối soát: activate to sort column descending" style="width: 50px;"> Ngày gửi đối soát

                                    </th>

                                    <th style="white-space: nowrap;" class="sorting" tabindex="0" aria-controls="listTrans" rowspan="1" colspan="1" aria-label="Ngày: activate to sort column ascending" style="width: 44.1979px; padding-right: 2px;">
                                        Chu kỳ đối soát
                                    </th>


                                    <th style="white-space: nowrap;" class="sorting" tabindex="0" aria-controls="listTrans" rowspan="1" colspan="1" aria-label="Ngày: activate to sort column ascending" style="width: 44.1979px; padding-right: 2px;">
                                        Tổng doanh thu
                                    </th>

                     {{--                <th class="sorting" tabindex="0" aria-controls="listTrans" rowspan="1" colspan="1" aria-label="Ngày: activate to sort column ascending"
                                    style="width: 44.1979px; padding-right: 20px; white-space: nowrap; width: 1%;">
                                        Tổng hoàn tiền
                                    </th> --}}

                                    <th style="white-space: nowrap;" class="sorting" tabindex="0" aria-controls="listTrans" rowspan="1" colspan="1" aria-label="Tổng doanh thu: activate to sort column ascending" style="width: 84.125px;">
                                        Tổng phí
                                    </th>
                                    <th style="white-space: nowrap;" class="sorting" tabindex="0" aria-controls="listTrans" rowspan="1" colspan="1" aria-label="Tổng doanh thu: activate to sort column ascending" style="width: 84.125px;">
                                        Tổng nhận
                                    </th>

                                    <th class="sorting" tabindex="0" aria-controls="listTrans" rowspan="1" colspan="1" aria-label="Trạng thái: activate to sort column ascending" style="width: 70.8125px;"> TTCKTT</th>

                                    <th class="sorting" tabindex="0" aria-controls="listTrans" rowspan="1" colspan="1" aria-label="Tổng nhận: activate to sort column ascending" style="width: 57.1146px;">Trạng thái</th>

                                    <th class="sorting" tabindex="0" aria-controls="listTrans" rowspan="1" colspan="1" aria-label="Trạng thái: activate to sort column ascending" style="width: 70.8125px;">Lý do</th>



                                        <th class="dt-center sorting" tabindex="0" aria-controls="listTrans" rowspan="1" colspan="1" aria-label="Thao tác: activate to sort column ascending" style="width: 45.9583px;">Thao tác</th></tr>
                                  </thead>
                                  <tbody>
                                    {{-- @dump($dataList) --}}
                                    @if(isset($dataList))
                                    @foreach($dataList->data as $list)
                                  <tr class="odd">


                                    <td>
                                            @if($list->status == 'pending')
                                            <input type="checkbox" id="crosscheck-all-{{$list->id}}" name="crosscheck-all" value="{{$list->id}}">
                                            @else

                                            <input disabled type="checkbox" id="crosscheck-all-{{$list->id}}" name="crosscheck-all" value="{{$list->id}}">

                                            @endif
                                    </td>

                                        <td>{{$list->id}}
                                            <input id="ID-{{$list->id}}" type="hidden"
                                            value="{{$list->id}}">

                                            <input id="partner_code-{{$list->id}}" type="hidden" value="{{$list->partner_code}}">

                                            <input title="chu ki doi soat" id="schedule_code-{{$list->id}}" type="hidden" value="{{$list->schedule_code}}">

                                            <input title="tong doanh thu" id="sum_revenue-{{$list->id}}" type="hidden" value="{{$list->sum_revenue}}">

                                            <input title="tong hoan tien" id="sum_receive-{{$list->id}}" type="hidden" value="{{$list->sum_receive}}">

                                            <input title="tong phi" id="sum_cost-{{$list->id}}" type="hidden" value="{{$list->sum_cost}}">

                                            <input title="trang thai" id="status-{{$list->id}}" type="hidden" value="{{$list->status}}">

                                            <input title="lý do" id="reason-{{$list->id}}" type="hidden" value="{{$list->reason}}">

                                            <input title="Ngày gửi đối soát" id="date_perform_reconciliation-{{$list->id}}" type="hidden" value="{{date('d-m-Y H:i:s', $list->date_perform_reconciliation)}}">

                                            <input title="Ngày bắt đầu đối soát" id="start_date-{{$list->id}}" type="hidden" value="{{date('d-m-Y H:i:s', $list->start_date)}}">

                                            <input title="Ngày kết thúc đối soát" id="end_date-{{$list->id}}" type="hidden" value="{{date('d-m-Y H:i:s', $list->end_date)}}">

                                            <input title="created_at" id="created_at-{{$list->id}}" type="hidden" value="{{date('d-m-Y H:i:s', $list->created_at)}}">

                                            <input title="updated_at" id="updated_at-{{$list->id}}" type="hidden" value="{{date('d-m-Y H:i:s', $list->updated_at)}}">

                                            <input title="start_time" id="start_time-{{$list->id}}" type="hidden" value="{{date('d-m-Y H:i:s', $list->start_time)}}">

                                            <input title="end_time" id="end_time-{{$list->id}}" type="hidden" value="{{date('d-m-Y H:i:s', $list->end_time)}}">

                                           {{--  <input title="logs" id="logs-{{$list->id}}" type="hidden" value="{{$list->logs}}"> --}}

                                            <input title="reconciliation_schedule_detail_id" id="reconciliation_schedule_detail_id-{{$list->id}}" type="hidden" value="{{$list->reconciliation_schedule_detail_id}}">

                                            <input title="Tổng chuyển khoản trực tiếp" id="sum_transfer_direct-{{$list->id}}" type="hidden" value="{{$list->sum_transfer_direct}}">

                                            <input title="Tổng giao dịch thành công" id="total_trans_revenue-{{$list->id}}" type="hidden" value="{{$list->total_trans_revenue}}">

                                            {{-- <input title="Danh sach ids" id="ids-{{$list->id}}" type="hidden" value="{{$list->ids}}"> --}}


                                        </td>
                                      <td class="sorting_1">
                                        <a href="#" data-bs-target="#transDetail" data-bs-toggle="offcanvas">
                                            {{$list->partner_code}}
                                        </a>
                                        </td>

                                        <td>
                                            {{date('d-m-Y', $list->date_perform_reconciliation)}}
                                        </td>

                                        <td style="white-space: nowrap; width: 1%;">
                                            {{($list->schedule_code == 'every_day')?'Hằng ngày':''}}
                                            {{($list->schedule_code == 'every_week')?'Hằng tuần':''}}
                                            {{($list->schedule_code == 'every_month')?'Hằng tháng':''}}
                                            {{($list->schedule_code == 'every_three_day')?'Ba ngày 1 lần':''}}
                                        </td>

                                        <td>
                                            {{number_format($list->sum_revenue, 0, '', '.')}} đ
                                        </td>

                                           {{--  <td style="white-space: nowrap; width: 1%;">
                                                {{number_format($list->sum_receive, 0, '', '.')}} đ
                                            </td> --}}
                                      <td style="white-space: nowrap; width: 1%;">
                                            {{number_format($list->sum_cost, 0, '', '.')}} đ
                                        </td>

                                        <td class="sumRecieve" style="white-space: nowrap; width: 1%;">
                                                {{number_format($list->sum_receive, 0, '', '.')}} đ
                                            </td>

                                         <td>
                                        {{number_format($list->sum_transfer_direct, 0, '', '.')}} đ
                                       </td>

                                      <td>
                                        <select
                                        wire:change.prevent="$emit('changeConfirmVAEbillScript', '{{$list->id}}')"
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

                                      <td style="min-width: 150px">
                                        {{$list->reason}}
                                       </td>


                                      <td class="dt-center" style="white-space: nowrap; width: 1%;">
                                        <a
                                        href="{{route('gate.ebill.partner.va.bienbandoisoat')}}?id={{$list->id}}">
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
                                        <a wire:click.prevent="$emit('ExportEbillVAScript', '{{$list->id}}')" class="flaticon2-arrow-down" style="color: #333333; cursor: pointer;"></a>
                                      </td>
                                    </tr>
                                    @endforeach
                                    @endif

                                </tbody>
                                </table>

                                <div class="bottom_paging">
                                    <div class="dataTables_info" id="listTrans_info" role="status" aria-live="polite">Hiển thị {{$limit}} của {{$totalRecord}} bản danh sách</div>
                                    <div class="dataTables_length" id="listTrans_length">
                                        <label>Hiển thị
                                            <select
                                            id="select-box-total-record"
                                            wire:change.prevent="$emit('selectTotalRecordScript')"
                                            name="listTrans_length" aria-controls="listTrans" class="form-select form-select-sm">
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="35">35</option>
                                            {{-- <option value="50">50</option>
                                            <option value="100">100</option> --}}
                                        </select> danh sách</label>
                                    </div>
                                    <div class="dataTables_paginate paging_numbers" id="listTrans_paginate"><ul class="pagination">
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


</div>
@push('scriptsChart')


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

        Livewire.on('selectTotalRecordScript', ()=>{
            var limit = document.getElementById('select-box-total-record').value;

            Livewire.emit('selectTotalRecord', limit);
        });


        Livewire.on('changeStatusConfirmScript', ()=>{

            // document.getElementById('loadingWrap').style.display = 'block';

            var chkConfirm = document.getElementsByName('crosscheck-all');
            var idArr = [];

                // Lặp qua từng chkConfirm để lấy giá trị
            for (var i = 0; i < chkConfirm.length; i++){
                if (chkConfirm[i].checked === true && chkConfirm[i].disabled === false && chkConfirm[i].value != 'check-all'){
                    idArr.push(chkConfirm[i].value);
                }
            }

            if (idArr === undefined || idArr.length == 0) {
                alert('Cần tích chọn đối soát hợp lệ để duyệt hoặc từ chối');

                document.getElementById("confirm_reject_multi").value = "action";

                return;
            }

            var statusConfirm = document.getElementById('confirm_reject_multi').value;

            if(statusConfirm == 'confirm'){

                Swal.fire({
                    title: "Xác nhận!",
                    text: "Bạn có chắc chắn xác nhận những giao dịch đối soát đã chọn?",
                    showCancelButton: true,
                }).then(function(reason){

                    if(reason.isDismissed){
                        document.getElementById("confirm_reject_multi").value = "action";
                    }
                    if(reason.isConfirmed){

                        $("#loadingWrap").removeAttr("style");
                        Livewire.emit('changeStatusConfirm', idArr);

                        //
                    }
                });
            }


            if(statusConfirm == 'refuse'){

                Swal.fire({
                    title: "Lý do!",
                    text: "Hãy nhập lý do KHÔNG xác nhận:",
                    input: "textarea",
                    type: "input",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    animation: "slide-from-top",
                    inputPlaceholder: "Viết lý do từ chối"
                }).then(function(reason){

                    if(reason.isDismissed){
                        document.getElementById("confirm_reject_multi").value = "action";
                    }
                    if(reason.isConfirmed){

                        $("#loadingWrap").removeAttr("style");

                        Livewire.emit('changeStatusRefuse', idArr, reason.value);
                    }
                });
            }

        });


    Livewire.on('messageConfirmAllScript', message =>{


    var success = message.success;
    var idSuccess = '';

    var error = message.error;
    var idError = '';

    if(success.length >= 1){
        for(var i = 0; i < success.length; i++){
            idSuccess += success[i].id + ',';
        }


        Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Đã duyệt thành công '+ message.countSuccess +' đối soát!',
          text: idSuccess,
          showConfirmButton: false,
          timer: 3000
        })
    }

    if(error.length >= 1){
        for(var i = 0; i < error.length; i++){
            idError += error[i].id + ',';
        }

        Swal.fire({
          position: 'center',
          icon: 'error',
          title: 'Đã duyệt thất bại '+ message.countError +' đối soát!',
          text: idError,
          showConfirmButton: false,
          timer: 3000
        })
    }


    document.getElementById("confirm_reject_multi").value = "action";

    document.getElementById("crosscheck-all-items").checked = false;

});



Livewire.on('messageRefuseAllScript', message =>{

    var success = message.success;
    var idSuccess = '';

    var error = message.error;
    var idError = '';

    if(success.length >= 1){
        for(var i = 0; i < success.length; i++){
            idSuccess += success[i].id + ',';
        }

        Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Đã từ chối thành công '+ message.countSuccess +' đối soát VA!',
          text: idSuccess,
          showConfirmButton: false,
          timer: 3000
        })
    }

    if(error.length >= 1){
        for(var i = 0; i < error.length; i++){
            idError += error[i].id + ',';
        }

        Swal.fire({
          position: 'center',
          icon: 'error',
          title: 'Đã từ chối thất bại '+ message.countError +' đối soát!',
          text: idError,
          showConfirmButton: false,
          timer: 3000
        })
    }

    document.getElementById("confirm_reject_multi").value = "action";

    document.getElementById("crosscheck-all-items").checked = false;


});




    </script>


    <script>
        document.addEventListener('livewire:load', function () {

            Livewire.on('messageScript', message=>{
                if(message.warning == false){
                    Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: message.message,
                      showConfirmButton: false,
                      timer: 3000
                    })
                }else{
                    Swal.fire({
                          title: "Lý do!",
                          text: message.message,
                          input: "textarea",
                          type: "input",
                          showCancelButton: true,
                          closeOnConfirm: false,
                          animation: "slide-from-top",
                          inputPlaceholder: "Write something"
                        }
                    ).then(function(reason){
                        if(reason.isDismissed){
                            document.getElementById("cbx-status-" + message.id).value = "pending";
                        }
                        if(reason.isConfirmed){
                            // Livewire.emit('changeRefuseVAEbill', message.id, reason.value);
                            var chkConfirm = document.getElementsByName('crosscheck-all');
                            var idArr = [];

                                // Lặp qua từng chkConfirm để lấy giá trị
                            for (var i = 0; i < chkConfirm.length; i++){
                                if (chkConfirm[i].checked === true && chkConfirm[i].disabled === false && chkConfirm[i].value != 'check-all'){
                                    idArr.push(chkConfirm[i].value);
                                }
                            }

                            if (idArr === undefined || idArr.length == 0) {

                                $("#loadingWrap").removeAttr("style");

                                Livewire.emit('changeRefuseVAEbill', message.id, reason.value);

                                document.getElementById("confirm_reject_multi").value = "action";

                                document.getElementById("crosscheck-all-items").checked = false;

                                return;
                            }else{

                                $("#loadingWrap").removeAttr("style");

                                Livewire.emit('changeStatusRefuse', message.id, reason.value);

                                document.getElementById("crosscheck-all-items").checked = false;
                            }

                            document.getElementById("cbx-status-" + message.id).value = "pending";
                        }
                    });
                }

            });

            Livewire.on('changeConfirmVAEbillScript', id=>{
                var status = document.getElementById('cbx-status-' + id).value;
                if(status == 'confirm'){
                    Swal.fire({
                          title: "Bạn chắc chắn xác nhận?",
                          // text: "Hãy nhập lý do xác nhận:",
                          // input: "textarea",
                          // type: "input",
                          showCancelButton: true,
                          closeOnConfirm: false,
                          animation: "slide-from-top",
                          inputPlaceholder: "Write something"
                        }
                    ).then(function(reason){
                        if(reason.isDismissed){
                            document.getElementById("cbx-status-" + id).value = "pending";
                        }
                        if(reason.isConfirmed){

                            var chkConfirm = document.getElementsByName('crosscheck-all');
                            var idArr = [];

                                // Lặp qua từng chkConfirm để lấy giá trị
                            for (var i = 0; i < chkConfirm.length; i++){
                                if (chkConfirm[i].checked === true && chkConfirm[i].disabled === false && chkConfirm[i].value != 'check-all'){
                                    idArr.push(chkConfirm[i].value);
                                }
                            }

                            if (idArr === undefined || idArr.length == 0) {

                                $("#loadingWrap").removeAttr("style");

                                Livewire.emit('changeConfirmVAEbill', id);

                                document.getElementById("confirm_reject_multi").value = "action";

                                document.getElementById("crosscheck-all-items").checked = false;

                                return;
                            }else{

                                $("#loadingWrap").removeAttr("style");

                                Livewire.emit('changeStatusConfirm', idArr);

                                document.getElementById("crosscheck-all-items").checked = false;
                            }

                            document.getElementById("cbx-status-" + id).value = "pending";


                        }
                    });
                }

                if(status == 'refuse'){
                    Swal.fire({
                          title: "Lý do!",
                          text: "Hãy nhập lý do KHÔNG xác nhận:",
                          input: "textarea",
                          type: "input",
                          showCancelButton: true,
                          closeOnConfirm: false,
                          animation: "slide-from-top",
                          inputPlaceholder: "Write something"
                        }
                    ).then(function(reason){
                        if(reason.isDismissed){
                            document.getElementById("cbx-status-" + id).value = "pending";
                        }
                        if(reason.isConfirmed){


                            var chkConfirm = document.getElementsByName('crosscheck-all');
                            var idArr = [];

                                // Lặp qua từng chkConfirm để lấy giá trị
                            for (var i = 0; i < chkConfirm.length; i++){
                                if (chkConfirm[i].checked === true && chkConfirm[i].disabled === false && chkConfirm[i].value != 'check-all'){
                                    idArr.push(chkConfirm[i].value);
                                }
                            }

                            if (idArr === undefined || idArr.length == 0) {

                                $("#loadingWrap").removeAttr("style");

                                Livewire.emit('changeRefuseVAEbill', id, reason.value);

                                document.getElementById("confirm_reject_multi").value = "action";

                                document.getElementById("crosscheck-all-items").checked = false;

                                return;
                            }else{

                                $("#loadingWrap").removeAttr("style");

                                Livewire.emit('changeStatusRefuse', idArr, reason.value);

                                document.getElementById("crosscheck-all-items").checked = false;
                            }

                            document.getElementById("cbx-status-" + id).value = "pending";


                        }
                    });
                }
            });


            Livewire.on('ExportEbillVAScript', id=>{
                // var ids = document.getElementById('ids-' + id ).value;
                var protocol = window.location.protocol;
                var host = window.location.host;
                var url = protocol + '//' + host + '/';

                window.open(url + 'ebill-partner-va-reconciliation-data-export?id='+ id);
            });

            Livewire.on('ExportbillVaScript', ()=>{
                var partner_code = document.getElementById('partner_code_search').value;
                var startTimeSearch = document.getElementById('startTimeSearch').value;
                var endTimeSearch = document.getElementById('endTimeSearch').value;
                var date_perform_reconciliation = document.getElementById('TimeSearchPerform').value;
                var search_schedule_code = document.getElementById('search_schedule_code').value;
                var sum_recieve = document.getElementById('sum_recieve_search').value;


                var TimeSearchPerform = document.getElementById("TimeSearchPerform").value;
                var schedule_code_search = document.getElementById("search_schedule_code").value;

                var protocol = window.location.protocol;
                var host = window.location.host;
                var url = protocol + '//' + host + '/';

                window.open(url + 'cross-check-va-export-csv?partner_code='+ partner_code
                +'&startTime='+startTimeSearch
                +'&endTime='+endTimeSearch
                +'&date_perform_reconciliation='+date_perform_reconciliation
                +'&search_schedule_code='+search_schedule_code
                +'&sum_recieve='+sum_recieve
                );


            });


            Livewire.on('SearchebillVaScript', ()=>{
                var partner_code = document.getElementById('partner_code_search').value;
                var startTimeSearch = document.getElementById('startTimeSearch').value;
                var endTimeSearch = document.getElementById('endTimeSearch').value;
                var date_perform_reconciliation = document.getElementById('TimeSearchPerform').value;
                var search_schedule_code = document.getElementById('search_schedule_code').value;
                var sum_recieve = document.getElementById('sum_recieve_search').value;

                Livewire.emit('SearchebillVa',partner_code, startTimeSearch, endTimeSearch,date_perform_reconciliation, search_schedule_code, sum_recieve  );
            });

            Livewire.on('showBaocaoDoisoatChitietScript', id=>{

                document.getElementById('chitiet-logs').innerHTML = "";

                document.getElementById('chitiet-ID').value = id;
                document.getElementById('chitiet-partner_code').value = document.getElementById('partner_code-' + id).value;

                var schedule_code = document.getElementById('schedule_code-' + id).value;
                if(schedule_code == 'every_day'){
                    schedule_code = 'Hằng ngày';
                }
                if(schedule_code == 'every_week'){
                    schedule_code = 'Hằng tuần';
                }
                if(schedule_code == 'every_month'){
                    schedule_code = 'Hằng tháng';
                }
                if(schedule_code == 'every_three_day'){
                    schedule_code = 'Ba ngày 1 lần';
                }
                document.getElementById('chitiet-schedule_code').value = schedule_code;
                document.getElementById('chitiet-sum_revenue').value = document.getElementById('sum_revenue-' + id).value;

                document.getElementById('chitiet-sum_receive').value = document.getElementById('sum_receive-' + id).value;

                document.getElementById('chitiet-sum_cost').value = document.getElementById('sum_cost-' + id).value;

                var status = document.getElementById('status-' + id).value;
                if(status == 'processing'){
                    status = 'Duyệt';
                }
                if(status == 'pending'){
                    status = 'Chờ xử lý';
                }
                if(status == 'non_processing'){
                    status = 'Không duyệt';
                }
                if(status == 'wait_confirm'){
                    status = 'Chờ xác nhận';
                }
                if(status == 'confirm_success'){
                    status = 'Xác nhận';
                }
                if(status == 'confirm_fail'){
                    status = 'Từ chối';
                }

                document.getElementById('chitiet-status').value = status;
                document.getElementById('chitiet-reason').value = document.getElementById('reason-' + id).value;

                document.getElementById('chitiet-date_perform_reconciliation').value = document.getElementById('date_perform_reconciliation-' + id).value;

                document.getElementById('chitiet-start_date').value = document.getElementById('start_date-' + id).value;

                document.getElementById('chitiet-end_date').value = document.getElementById('end_date-' + id).value;

                document.getElementById('chitiet-created_at').value = document.getElementById('created_at-' + id).value;

                document.getElementById('chitiet-updated_at').value = document.getElementById('updated_at-' + id).value;

                document.getElementById('chitiet-start_time').value = document.getElementById('start_time-' + id).value;

                document.getElementById('chitiet-end_time').value = document.getElementById('end_time-' + id).value;

                document.getElementById('chitiet-reconciliation_schedule_detail_id').value = document.getElementById('reconciliation_schedule_detail_id-' + id).value;

                document.getElementById('chitiet-sum_transfer_direct').value = document.getElementById('sum_transfer_direct-' + id).value;

                document.getElementById('chitiet-total_trans_revenue').value = document.getElementById('total_trans_revenue-' + id).value;

                // document.getElementById('chitiet-logs').value = document.getElementById('logs-' + id).value;


                Livewire.emit('getDetailsLogs', id);

            });


            Livewire.on('TatcastatusScript', ()=>{

                $("#loadingWrap").removeAttr("style");

                Livewire.emit('Tatcastatus');
            })

            Livewire.on('XacnhanthanhcongScript', ()=>{

                $("#loadingWrap").removeAttr("style");

                Livewire.emit('Xacnhanthanhcong');
            })

            Livewire.on('ChoxacnhanScript', ()=>{

                $("#loadingWrap").removeAttr("style");

                Livewire.emit('Choxacnhan');
            })

            Livewire.on('DaduyetScript', ()=>{

                $("#loadingWrap").removeAttr("style");

                Livewire.emit('Daduyet');
            })

            Livewire.on('KhongduyetScript', ()=>{

                $("#loadingWrap").removeAttr("style");

                Livewire.emit('Khongduyet');
            })

            Livewire.on('TuchoiScript', ()=>{

                $("#loadingWrap").removeAttr("style");

                Livewire.emit('Tuchoi');
            })

            Livewire.on('Chodoisoatduyet', ()=>{

                $("#loadingWrap").removeAttr("style");

                Livewire.emit('SearchChodoisoatduyet');
            })


        });

    </script>
@endpush
