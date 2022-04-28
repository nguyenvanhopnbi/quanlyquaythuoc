<div>

   {{-- start details modal --}}
   <div wire:ignore.self class="modal-detail">
       <div
       class="offcanvas offcanvas-end w-600 hide" tabindex="-1" id="transDetail" aria-labelledby="offcanvasExampleLabel" aria-modal="true" role="dialog" style="visibility: visible;">
        <div class="offcanvas-header">
          <div>
          <h4 class="offcanvas-title" id="transDetail">Mã giao dịch: <span wire:ignore id="lotteryTransactionId">#2312312</span></h4>
          <p class="text-orange mb-0">Mã bill: <span wire:ignore id="bill-code">3443</span></p>
          </div>
          <button
          wire:click.prevent="$emit('CLoseDetailsScript')"
          type="button" class="btn-close-x text-reset" data-bs-dismiss="offcanvas" aria-label="Close">
              X
          </button>
        </div>
        <div class="offcanvas-body">
          <div class="receiver_info p-3">
              <div class="receiver_title">Thong tin nguoi nhan</div>
              <div class="receiver-content">
                <div class="row">
                  <div class="col-6 d-flex">
                    <span class="text-gray pe-3 mr-3">Họ tên:  </span>
                    <strong>{{$fullnameLottery}}</strong>
                  </div>
                  <div class="col-6 d-flex">
                    <span class="text-gray pe-3 mr-3">Số điện thoại</span>
                    <strong>{{$phoneNumber}}</strong>
                  </div>
                </div>
              </div>
          </div>

          <div class="ticket_detail">
            <div class="row">
              <div class="col">
                  <div class="bg-gray p-3 br-8 h-full">
                    <h5 class="text-blue mb-0">
                      Thong tin chi tiet ve
                    </h5>
                    <div class="ds-list">

                      <div class="ds-item">
                        <div class="ds-title">Ngày mua</div>
                        <div class="ds-text"><strong><span wire:ignore id="created_at"></span></strong></div>
                      </div>
                      <div class="ds-item">
                        <div class="ds-title">Thời gian</div>
                        <div class="ds-text"><strong><span wire:ignore id="created_at_time"></span></strong></div>
                      </div>
                      <div class="ds-item">
                        <div class="ds-title">Số bộ vé</div>
                        <div class="ds-text"><strong><span wire:ignore id="amountTickets" wire:ignore></span></strong></div>
                      </div>

                        <div class="ds-item">
                          <div class="ds-title">Tổng tiền</div>
                          <div class="ds-text"><strong><span wire:ignore id="price"></span> Đ</strong></div>
                        </div>
                        <div class="ds-item">
                          <div class="ds-title">PTTT</div>
                          <div class="ds-text"><strong>Ví Appota</strong></div>
                        </div>
                        <div class="ds-item">
                          <div class="ds-title">Trạng thái</div>
                          <div class="ds-text"><strong><span wire:ignore id="status"></span></strong></div>
                        </div>
                        <div class="ds-item">
                          <div class="ds-title">Cách chơi</div>
                          <div class="ds-text"><strong><span id="playType">{{$playType}}</span></strong></div>
                        </div>
                        <div class="ds-item">
                          <div class="ds-title">Nhà cung cấp</div>
                          <div class="ds-text"><strong><span wire:ignore id="provider-code"></span></strong></div>
                        </div>
                        <div class="ds-item">
                          <div class="ds-title">Partner</div>
                          <div class="ds-text"><strong><span wire:ignore id="partner-code"></span></strong></div>
                        </div>
                        <div class="ds-item">
                          <div class="ds-title">Kênh bán</div>
                          <div class="ds-text"><strong><span wire:ignore id="saleChannel"></span></strong></div>
                        </div>
                    </div>
                    <div class="d-grid">
                      <button type="button" class="btn btn-outline-blue"><span wire:ignore id="isWinTicket"></span></button>
                    </div>
                  </div>
              </div>
              <div class="col">
                <div class="bg-gray p-3 br-8 h-full">
                  <h5 class="text-blue mb-0">Kết quả kỳ quay</h5>
                  <div class="ds-list">
                    <div class="ds-item">
                      <div class="ds-title">Loại vé</div>
                      <div class="ds-text"><strong class=""><span wire:ignore id="lotteryName"></span></strong></div>
                    </div>
                    <div class="ds-item">
                      <div class="ds-title">Kỳ quay</div>
                      <div class="ds-text"><strong><span id="drawIndex">{{$drawIndex}}</span></strong></div>
                    </div>
                    <div class="ds-item">
                      <div class="ds-title">Ngày xổ số</div>
                      <div class="ds-text"><strong><span wire:ignore id="drawTime"></span></strong></div>
                    </div>
                    <div class="ds-item">
                      <div class="ds-title">Thời gian</div>
                      <div class="ds-text"><strong><span>{{$drawDate}}</span></strong></div>
                    </div>
                      <div class="ds-item">
                        @if(isset($lotteryResultJackpot1))
                        <div class="ds-title">Jackpot1</div>
                        <div class="ds-text"><strong>{{$lotteryResultJackpot1}}</strong></div>
                        @endif



                      </div>
                      <div class="ds-item">
                          @if(isset($lotteryResultJackpot2))
                        <div class="ds-title">Jackpot2</div>
                        <div class="ds-text"><strong>{{$lotteryResultJackpot2}}</strong></div>
                        @endif
                      </div>
                      <div class="ds-item flex-wrap">
                        <div class="ds-title">Kết quả</div>
                        <div class="ds-text ds-full">
                          <div class="ticket-result bd-line br-8">
                            @if(isset($numbers))
                            @foreach($numbers as $num)
                            <div class="t-result">{{$num}}</div>
                            @endforeach
                            @endif
                            <div class="t-result b-line {{(isset($textCountLon13))?'b-red':''}}">Lớn(13)</div>
                            <div class="t-result b-line {{(isset($textCountLon11or12))?'b-red':''}}">Lớn(11)(12)</div>
                            <div class="t-result b-line {{(isset($textHoaLonNho10))?'b-red':''}}">Hòa Lớn Nhỏ(10)</div>
                            <div class="t-result b-line {{(isset($textNho11hoac12))?'b-red':''}}">Nhỏ(11)(12)</div>
                            <div class="t-result b-line {{(isset($textNho13))?'b-red':''}}">Nhỏ(13)</div>
                            <div class="t-result b-line {{(isset($textSoChan15))?'b-red':''}}">Chẵn(15)</div>
                            <div class="t-result b-line {{(isset($textSoChan13hoac14))?'b-red':''}}">Chẵn(13-14)</div>
                            <div class="t-result b-line {{(isset($textSoChan11hoac12))?'b-red':''}}">Chẵn(11-12)</div>
                            <div class="t-result b-line {{(isset($textHoaChanLe10))?'b-red':''}}">Hòa Chẵn Lẻ(10-10)</div>
                            <div class="t-result b-line {{(isset($textLe11hoac12))?'b-red':''}}">Lẻ(11-12)</div>
                            <div class="t-result b-line {{(isset($textLe13hoac14))?'b-red':''}}">Lẻ(13-14)</div>
                            <div class="t-result b-line {{(isset($textLe15))?'b-red':''}}">Lẻ(15)</div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>

          <div class="buyticket-info">
            <h5 class="text-blue">Phí</h5>
            <div class="t-table">
              <div class="d-head">
                  <div class="row">
                    <div class="col-2">#</div>
                    <div class="col-5">Phí provider</div>
                    <div class="col-5">Phí Partner</div>
                  </div>
              </div>
              <div class="d-body">
                <div class="d-list">
                  <div class="row">
                    <div class="col-2">1</div>
                    <div class="col-5"><span wire:ignore id="provider-price"></span></div>
                    <div class="col-5"><span wire:ignore id="partner-price"></span></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="buyticket-info">
            <h5 class="text-blue">Hình scan</h5>
            <div class="t-table">
              <div class="d-head">
                  <div class="row">
                    <div class="col-2">#</div>
                    <div class="col-5">Danh sách vé</div>
                    <div class="col-5">Hình ảnh</div>
                  </div>
              </div>
              <div class="d-body">
                <div class="d-list">
                  <div class="row">
                    <div class="col-2">1</div>
                    <div class="col-5">
                      <div class="ticket-book">
                        {{-- <span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>6</span> --}}
                        {{$danhsachve}}
                      </div>
                    </div>
                    <div class="col-5">
                      <div class="ticket-draf">
                        <input type="file" id="ve_">
                        <label for="ve_" class="text-blue">@if(isset($linkURL)) <img src="{{$linkURL}}" width="80" height="80" alt=""> @endif</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
   </div>


   {{-- end details modal --}}

    {{-- Be like water. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Lottery
                </h3>
            </div>

        </div>

        <div class="kt-portlet__body">
            {{-- main content --}}
            <main class="flex-column d-flex">
                <div class="page-header page-subtrack">
                    <div class="page-top d-flex align-items-center">
                        <h2 class="page-title">Thống kê giao dịch</h2>
                        <button
                        wire:click.prevent="$emit('downloadCSVScript')"
                        style=""
                        type="button" class="btn btn-white d-flex align-items-center btn-download"><i class="ic-24 ic-download"></i><span>Tải dữ liệu về</span></button>
                    </div>
                    <div class="page-search-header">
                        <div class="row row-wrap">
                            <div class="col">
                                <div class="input-append text-12" data-date="{{date('d-m-Y')}}" >
                                  <input
                                  placeholder="Thời gian bắt đầu"
                                  id="startTimeSearch" class="form-control" size="16" type="text">
                                  <span class="add-on"></span>
                                </div>
                            </div>
                            <div class="col">
                              <div class="input-append text-12" >
                                <input
                                placeholder="Thời gian kết thúc"
                                id="endTimeSearch" class="form-control" size="16" type="text">
                                <span class="add-on"></span>
                              </div>
                          </div>
                          <div class="col">
                            <input id="magiaodich" type="text" class="form-control ipt-search text-12" placeholder="Tìm theo mã giao dịch">
                            </div>
                          <div class="col">
                            <input id="mabill" type="text" class="form-control ipt-search text-12" placeholder="Tìm theo mã bill">
                            </div>
                            <div class="col">
                                <div class="dropdown filterStatus" data-bs-toggle="cust_dropdown" data-bs-target="#ds_status">
                                <select name="" id="status" class="form-control"
                                style="margin-top: 5px;"
                                >
                                    <option value="all">Tất cả</option>
                                    <option value="progress">Progress</option>
                                    <option value="pending">Đợi xử lý</option>
                                    <option value="successfully">Thành công</option>
                                    <option value="unsuccessfully">Thất bại</option>
                                </select>

                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col mb-0">
                                <div class="dropdown filterStatus" data-bs-toggle="cust_dropdown" data-bs-target="#ds_status">
                                <input
                                id="partnerCode"
                                list="listPartnerCode" type="text" class="form-control ipt-search text-12" placeholder="Partner Code">
                                <datalist id="listPartnerCode">
                                    @if(isset($partnerCodeList))
                                    @foreach($partnerCodeList as $partnerList)
                                    <option value="{{$partnerList->partner_code}}"></option>
                                    @endforeach
                                    @endif
                                </datalist>
                                {{-- <button class="form-control dropdown-toggle text-12" type="button" id="filterStatus" data-bs-toggle="dropdown" aria-expanded="false">
                                    Partner code
                                </button> --}}

                                </div>
                            </div>
                            <div class="col mb-0">
                                <div class="dropdown filterStatus" data-bs-toggle="cust_dropdown" data-bs-target="#ds_status">
                                <input
                                autocomplete="off"
                                id="providerCode"
                                list="listProviderCode" type="text" class="form-control ipt-search text-12" placeholder="Provider Code">

                                <datalist id="listProviderCode">
                                    @if(isset($providerCodeList))
                                    @foreach($providerCodeList as $listprovider)
                                    <option value="{{$listprovider->code}}">{{($listprovider->name == $listprovider->code)?'':$listprovider->name}}</option>
                                    @endforeach
                                    @endif
                                </datalist>

                                </div>
                            </div>
                            <div class="col mb-0">
                                <div class="dropdown filterStatus" data-bs-toggle="cust_dropdown" data-bs-target="#ds_status">
                                <input
                                id="Ketqua"
                                list="listKetQua" type="text" class="form-control ipt-search text-12" placeholder="Kết quả">

                                </div>
                            </div>
                            <div class="col mb-0">
                                <div class="dropdown filterStatus" data-bs-toggle="cust_dropdown" data-bs-target="#ds_status">
                                <input
                                id="Loaive"
                                list="listLoaiVe" type="text" class="form-control ipt-search text-12" placeholder="Loại vé">
                                <datalist id="listLoaiVe">
                                    @if(isset($listLoaive))
                                    @foreach($listLoaive as $listlv)
                                    <option value="{{$listlv->code}}">{{$listlv->name}}</option>
                                    @endforeach
                                    @endif
                                </datalist>

                                </div>
                            </div>
                            <div class="col mb-0">
                                <div class="d-grid">
                                    <button wire:click.prevent="$emit('SearchLotteryScript')" type="button" class="btn btn-success">Tìm kiếm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- End page header-->
                <div class="block report-block">
                    <div class="report-stats">
                        <div class="row">
                            <div class="col">
                                <div class="report-stats-title">
                                    <div class="block-36"><i class="ic-24 ic-total-trans"></i></div>
                                    <div class="report-stats-text">Tổng số giao dịch</div>
                                </div>
                                <div class="report-stats-number">
                                    {{number_format((isset($totalTransaction))?$totalTransaction:'0', '0', '', ',')}}
                                </div>
                            </div>
                            <div class="col">
                                <div class="report-stats-title">
                                    <div class="block-36"><i class="ic-24 ic-total-rev"></i></div>
                                    <div class="report-stats-text">Tổng doanh thu</div>
                                </div>
                                <div class="report-stats-number">
                                    {{number_format((isset($totalRevenue))?$totalRevenue:'0', '0', '', ',')}}
                                </div>
                            </div>
                            <div class="col">
                                <div class="report-stats-title">
                                    <div class="block-36"><i class="ic-24 ic-total-ticket"></i></div>
                                    <div class="report-stats-text">Tổng số vé trúng thưởng</div>
                                </div>
                                <div class="report-stats-number">
                                    {{number_format((isset($totalWinTicket))?$totalWinTicket:'0', '0', '', ',')}}
                                </div>
                            </div>
                            <div class="col">
                                <div class="report-stats-title">
                                    <div class="block-36"><i class="ic-24 ic-fee-provider"></i></div>
                                    <div class="report-stats-text">Phí provider</div>
                                </div>
                                <div class="report-stats-number">
                                    {{number_format((isset($totalProviderCommission))?$totalProviderCommission:'0', '0', '', ',')}}
                                </div>
                            </div>
                            <div class="col">
                                <div class="report-stats-title">
                                    <div class="block-36"><i class="ic-24 ic-fee-partner"></i></div>
                                    <div class="report-stats-text">Phí Partner</div>
                                </div>
                                <div class="report-stats-number">
                                     {{number_format((isset($totalPartnerCommission))?$totalPartnerCommission:'0', '0', '', ',')}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="report-list">
                        <div class="table-responsive">
                            <table class="table table-light" id="reportList">
                                <thead>
                                    <tr>
                                    <th class="fit">Mã giao dịch</th>
                                    <th>Mã Bill</th>
                                    <th>Loại vé</th>
                                    <th>Ngày mua</th>
                                    <th>Thời gian</th>
                                    <th>Số lượng</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Phí Provider</th>
                                    <th>Phí Partner</th>
                                    <th>Kết quả</th>
                                    <th class="fit">Nhà cung cấp</th>
                                    <th>Ngày xổ số</th>
                                    <th>Kênh</th>
                                    <th>Partner code</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($listTransaction))
                                    @foreach($listTransaction as $list)
                                    <tr>
                                        <td
                                        style="cursor: pointer; color: blue;"
                                        wire:click.prevent="$emit('getDetailsScript', '{{$list->lotteryTransactionId}}')">
                                        {{$list->lotteryTransactionId}}
                                        <input type="hidden" id="lotteryTransactionId-{{$list->lotteryTransactionId}}" value="{{$list->lotteryTransactionId}}">
                                    </td>
                                        <td>{{$list->bill->code}}
                                            <input type="hidden" id="bill-code-{{$list->lotteryTransactionId}}" value="{{$list->bill->code}}">
                                        </td>
                                        <td class="fit">{{$list->lotteryName}}
                                            <input type="hidden" id="lotteryName-{{$list->lotteryTransactionId}}" value="{{$list->lotteryName}}">
                                        </td>
                                        <td class="fit">{{date('d-m-Y', strtotime($list->created_at))}}
                                            <input type="hidden" id="created_at-{{$list->lotteryTransactionId}}" value="{{date('d-m-Y', strtotime($list->created_at))}}">
                                        </td>
                                        <td>{{date('H:i:s', strtotime($list->created_at))}}
                                            <input type="hidden" id="created_at_time-{{$list->lotteryTransactionId}}" value="{{date('H:i:s', strtotime($list->created_at))}}">

                                        </td>
                                        <td>{{$list->bill->amountTickets}}
                                            <input type="hidden" id="amountTickets-{{$list->lotteryTransactionId}}" value="{{$list->bill->amountTickets}}">
                                        </td>
                                        <td>{{$list->price}}
                                            <input type="hidden" id="price-{{$list->lotteryTransactionId}}" value="{{$list->price}}">
                                        </td>
                                        <td><span class="badge badge-light-green">{{($list->status == 'successfully')?'Thành công':'Thất bại'}}</span>

                                            <input type="hidden" id="status-{{$list->lotteryTransactionId}}" value="{{($list->status == 'successfully')?'Thành công':'Thất bại'}}">
                                        </td>
                                        <td>{{$list->partner->price}}
                                            <input type="hidden" id="partner-price-{{$list->lotteryTransactionId}}" value="{{$list->partner->price}}">
                                        </td>
                                        <td>{{$list->provider->price}}

                                            <input type="hidden" id="provider-price-{{$list->lotteryTransactionId}}" value="{{$list->provider->price}}">
                                        </td>
                                        <td class="fit">
                                            {{($list->bill->isWinTicket == null) ? 'Chưa có kết quả' : ''}}
                                            {{($list->bill->isWinTicket == 'yes') ? 'Trúng thưởng' : ''}}
                                            {{($list->bill->isWinTicket == 'no') ? 'Trượt' : ''}}
                                            <input type="hidden" id="isWinTicket-{{$list->lotteryTransactionId}}"
                                            value="{{($list->bill->isWinTicket == null) ? 'Chưa có kết quả' : ''}}
                                            {{($list->bill->isWinTicket == 'yes') ? 'Trúng thưởng' : ''}}
                                            {{($list->bill->isWinTicket == 'no') ? 'Trượt' : ''}}">
                                        </td>
                                        <td>
                                            <div class="ncc">
                                                <div class="ncc_img">
                                                    <img src="{{asset('Lottery/assets/images/ncc/ncc_1.png')}}" class="img-fluid" />
                                                </div>
                                                <div class="ncc_name">
                                                    {{$list->provider->code}}
                                                    <input type="hidden"
                                                    id="provider-code-{{$list->lotteryTransactionId}}" value="{{$list->provider->code}}">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="fit">
                                            {{date('d-m-Y', strtotime($list->bill->drawTime))}}
                                            <input type="hidden" id="drawTime-{{$list->lotteryTransactionId}}" value="{{date('d-m-Y', strtotime($list->bill->drawTime))}}">
                                        </td>

                                        <td>{{$list->saleChannel}}
                                            <input type="hidden" id="saleChannel-{{$list->lotteryTransactionId}}" value="{{$list->saleChannel}}">
                                        </td>
                                        <td><a href="#" data-bs-target="#transDetail" data-bs-toggle="offcanvas">{{$list->partner->code}}</a>
                                            <input type="hidden" id="partner-code-{{$list->lotteryTransactionId}}" value="{{$list->partner->code}}">
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif

                                </tbody>
                            </table>
                            <div class="bottom_paging"><div class="dataTables_info" id="reportList_info" role="status" aria-live="polite">Showing 1 to {{$pageSize}} of {{$totalRecord}} entries</div><div class="dataTables_length" id="reportList_length"><label>Show
                                <select
                                wire:change.prevent="$emit('PageSizeScript')";
                                id="select-page-size"
                                style="border: 1px solid #ced4da; border-radius: .25rem;"
                                name="reportList_length" aria-controls="reportList" class="form-select form-select-sm">
                                    <option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option>
                                </select> entries</label></div>
                                <div class="dataTables_paginate paging_numbers" id="reportList_paginate"><ul class="pagination">
                                    @if(isset($listTransaction))
                                    @for($i = $start; $i <= $end; $i++)
                                    <li
                                    wire:click.prevent="gotoCurrentPage({{$i}})"
                                    class="paginate_button page-item @if($currentPage == $i) {{'active'}} @endif">
                                        <a
                                        style="text-align: center; line-height: 1.7em;"
                                        href="#" aria-controls="reportList" data-dt-idx="0" tabindex="0" class="page-link">
                                        {{$i}}
                                        </a>
                                    </li>
                                    @endfor
                                    @endif
                            </ul></div></div>
                        </div>
                    </div>
                </div>

            </main>

            {{-- end main content --}}

        </div>

    </div>
</div>
