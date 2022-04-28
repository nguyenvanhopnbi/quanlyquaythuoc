<div>
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Danh sách đối soát
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">

            {{-- begin search form  --}}

            <div class="kt-portlet__body">
                <div class="row align-items-center">
                    <div class="col-xl-12 order-2 order-xl-1">
                        <div class="row align-items-center">
                            <div class="col-xl-12 order-2 order-xl-1">
                                <div class="row align-items-center">

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Partner Code:</label>
                                        <div class="kt-input-icon kt-input-icon--left">

                                            <input
                                            autocomplete="off"
                                            list="listPartnerCode" placeholder="enter your partner code" type="text" class="form-control" name="search_partner_code" id="search_partner_code"
                                            @if(!empty(request()->input('partnerCode')))
                                            value="{{request()->input('partnerCode')}}"
                                            @endif
                                            >

                                            <datalist id="listPartnerCode">
                                                @if(isset($partnerCodeList))
                                                @foreach($partnerCodeList as $list)
                                                <option value="{{$list->partner_code}}"></option>
                                                @endforeach
                                                @endif
                                            </datalist>
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Status:</label>
                                        <div class="kt-input-icon kt-input-icon--left">

                                            <select class="form-control" name="status" id="status">
                                                <option value="">Tất cả</option>
                                                <option value="pending">Chờ đối soát duyệt</option>
                                                <option value="processing">Duyệt</option>
                                                <option value="non_processing">Không duyệt</option>
                                                <option value="wait_confirm">Đợi confirm</option>
                                                <option value="confirm_success">Confirm success</option>
                                                <option value="confirm_fail">Confirm fail</option>

                                            </select>
                                        </div>
                                    </div>



                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                            <label>Start Time:</label>
                                            <div class="kt-input-icon kt-input-icon--left">
                                                <input
                                                autocomplete="off"
                                                placeholder="Y-m-d H:i:s" class="form-control" type="text" id="startTimeSearch" name="startTimeSearch"
                                                @if(!empty(request()->input('startTime')))
                                                value="{{date('Y-m-d H:i:s', request()->input('startTime'))}}"
                                                @endif
                                                >
                                                <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                    <span><i class="la la-search"></i></span>
                                                </span>
                                            </div>

                                        </div>

                                        <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                            <label>End Time:</label>
                                            <div class="kt-input-icon kt-input-icon--left">
                                                <input
                                                autocomplete="off"
                                                placeholder="Y-m-d H:i:s" class="form-control" type="text" id="endTimeSearch" name="endTimeSearch"
                                                @if(!empty(request()->input('endTime')))
                                                value="{{date('Y-m-d H:i:s', request()->input('endTime'))}}"
                                                @endif
                                                >
                                                <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                    <span><i class="la la-search"></i></span>
                                                </span>
                                            </div>

                                        </div>


                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <div class="form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>&nbsp;</label>
                                            </div>
                                            <a
                                            wire:click.prevent="$emit('searchDoubleCheckScript')"
                                            class="btn btn-primary"
                                            style="color:#FFF">Search</a>

                                           {{--  <a type="button" style="color: #FFF;" class="btn btn-primary" data-toggle="modal" data-target="#addNewPartnerConfigProvider"> Add new </a> --}}

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- end search form --}}
            {{-- reason modal --}}

            <div wire:ignore.self class="modal fade" id="reason" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reason for no confirm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                        <div class="col-md-10">
                            @if (session()->has('messageNotConfirm') and $warning)
                            <span class="alert alert-warning">{{session('messageNotConfirm')}}</span>
                            @elseif(session()->has('messageNotConfirm') and $warning == false)
                            <span class="alert alert-success">{{session('messageNotConfirm')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <textarea name="reason" id="reasonTxt" cols="70" rows="5"></textarea>
                        </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button
                    wire:click.prevent="$emit('NoConfirmScript')"
                    type="button" class="btn btn-primary">Save</button>
                    <input type="hidden" id="IDNotConfirm">
                  </div>
                </div>
              </div>
            </div>
            {{-- end reason modal --}}

            {{-- start details large modal --}}

            <div wire:ignore.self class="modal fade bd-details-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">


                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chi tiết</h5>
                    <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <textarea name="logs" id="mylogs" cols="124" rows="20"></textarea>
                        </div>

                    </div>

                  </div>


                </div>
              </div>
            </div>
            {{-- end details large modal --}}


            <table class="table table-light">
                <thead>
                    @if (session()->has('message') and $warning)
                    <tr>
                        <td colspan="16">
                            <span class="alert alert-warning">
                                {{ session('message') }}
                            </span>
                        </td>
                    </tr>
                    @elseif(session()->has('message') and !$warning)
                    <tr>
                        <td colspan="16">
                            <span class="alert alert-success">{{ session('message') }}</span>
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <th>ID</th>
                        <th>Partner Code</th>
                        <th>Chu kỳ đối soát</th>
                        <th>Tổng doanh thu</th>
                        <th>Tổng hoàn tiền</th>
                        <th>Tổng hold</th>
                        <th>Tổng unhold</th>
                        <th>Tổng nhận</th>
                        <th>Tổng phí</th>
                        <th>Trạng thái</th>
                        <th>Lý do</th>
                        <th>Ngày chốt đốt soát</th>
                        <th colspan="2">Kỳ đối soát</th>
                        {{-- <th>Start Date</th> --}}
                        {{-- <th>End Date</th> --}}
                        <th style="display: none;">Logs</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @dd($transactionList) --}}
                    @if(isset($transactionList))
                    @foreach($transactionList as $list)
                    <tr>
                        <td>{{$list->id}}
                            <input type="hidden" id="ID-{{$list->id}}">
                        </td>
                        <td>{{$list->partner_code}}
                            <input type="hidden" id="partnerCode-{{$list->id}}">
                        </td>
                        <td>
                            @if($list->schedule_code == 'every_day')
                            {{'hằng ngày'}}
                            @elseif($list->schedule_code == 'every_week')
                            {{'hằng tuần'}}
                            @elseif($list->schedule_code == 'every_month')
                            {{'hằng tháng'}}
                            @elseif($list->schedule_code == 'every_three_day')
                            {{'3 ngày 1 lần'}}
                            @endif
                            <input type="hidden" id="scheduleCode-{{$list->id}}">
                        </td>
                        <td>{{$list->sum_revenue}}
                            <input type="hidden" id="SumRevenue-{{$list->id}}">
                        </td>
                        <td>{{$list->sum_refund}}
                            <input type="hidden" id="SumRefund-{{$list->id}}">
                        </td>
                        <td>{{$list->sum_hold}}
                            <input type="hidden" id="SumHold-{{$list->id}}">
                        </td>
                        <td>{{$list->sum_unhold}}
                            <input type="hidden" id="SumUnhold-{{$list->id}}">
                        </td>
                        <td>{{$list->sum_receive}}
                            <input type="hidden" id="SumRecieve-{{$list->id}}">
                        </td>
                        <td>{{$list->sum_cost}}
                            <input type="hidden" id="SumCost-{{$list->id}}">
                        </td>
                        <td>
                            <select id="cbx_status-{{$list->id}}" wire:change="$emit('changeConfirmScript', '{{$list->id}}')" class="form-control" style="width: 150px; margin: 0px; background: #f8f9fa" name="confirm_status" id="confirm_status">
                                @if($list->status == 'pending')
                                    <option value="pending">Chờ đối soát duyệt</option>
                                @elseif($list->status == 'processing')
                                    <option value="processing">Duyệt</option>
                                @elseif($list->status == 'non_processing')
                                    <option value="non_processing">Không duyệt</option>
                                @elseif($list->status == 'wait_confirm')
                                    <option value="wait_confirm">Đợi confirm</option>
                                @elseif($list->status == 'confirm_success')
                                    <option value="confirm_success">Confirm success</option>
                                @elseif($list->status == 'confirm_fail')
                                    <option value="confirm_fail">Confirm fail</option>
                                @endif

                                @if($list->status == 'pending')
                                    <option value="processing">Duyệt</option>
                                    <option value="non_processing">Không duyệt</option>
                                @endif
                            </select>

                            <input type="hidden" id="Status-{{$list->id}}" value="{{$list->status}}">
                        </td>
                        <td>{{$list->reason}}
                            <input type="hidden" id="reason-{{$list->id}}" value="{{$list->reason}}">
                        </td>
                        <td>{{date('Y-m-d', $list->date_perform_reconciliation)}}
                            <input type="hidden" id="DatePerformReconciliation-{{$list->id}}">
                        </td>
                        <td>{{date('Y-m-d', $list->start_date)}}
                            <input type="hidden" id="startDate-{{$list->id}}">
                        </td>
                        <td>{{date('Y-m-d', $list->end_date)}}
                            <input type="hidden" id="endDate-{{$list->id}}">
                        </td>
                        <td style="display: none;">
                            <input id="logs-{{$list->id}}" type="hidden" value="{{$list->logs}}">

                        </td>
                        <td style="width: 100px">
                            <button
                            wire:click.prevent="$emit('GetDetailsScript', '{{$list->id}}')"
                            data-toggle="modal"
                            data-target=".bd-details-modal-lg"
                            class="btn btn-primary">Chi tiết</button>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            @if(isset($transactionList))
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <li class="page-item @if($currentPage <= 1) {{'disabled'}}  @endif">
                  <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                  </a>
                </li>
                @for($i = $start; $i <= $end; $i++)
                <li wire:click.prevent="gotoCurrentPage({{$i}})" class="page-item @if($currentPage == $i) {{'active'}}  @endif"><a class="page-link" href="#">{{$i}}</a></li>
                @endfor
                <li class="page-item @if($currentPage >= $this->totalPage) {{'disabled'}}  @endif">
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
