<div>
    {{-- The Master doesn't talk, he acts. --}}



    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Danh sách trúng thưởng
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="dropdown dropdown-inline">
                       {{--  <a href="/partner-partners/add" class="btn btn-brand btn-icon-sm"><i class="flaticon2-plus"></i> Thêm Provider</a> --}}
                    </div>
                </div>
            </div>
        </div>
        {{-- modal detail --}}
        <div class="modal-lottery-body-detail" style="padding: 10px; position: fixed; top: 0; right: 0; z-index: 999; height: 100vh;">
        <div wire:ignore.self id="modal-detail-lottery" style="display: none;">
            <span
            wire:click.prevent="$emit('CloseDetailsLotteryPrizeScript')"
            class="close-details-button" style="position: absolute; top: 0; right: 0; margin: 20px; font-size: 14px; font-weight: bold; cursor: pointer;">X</span>

        <div class="offcanvas offcanvas-end w-600" tabindex="-1" id="transDetail" aria-labelledby="offcanvasExampleLabel" aria-modal="true" role="dialog" style="visibility: visible; background: #EEEEEE; padding: 10px;">
        <div class="offcanvas-header">
          <div class="d-flex flex-wrap align-items-center">
            <h4 class="offcanvas-title" id="transDetail" style="margin-top: 5px; margin-right: 20px;">Mã giao dịch: <span wire:ignore id="detail-magiaodich"></span></h4>
            <div class="time_buy d-flex align-items-center ms-1">
              <div class="ic-24 ic-clock"></div>
              <div class="timed"><span wire:ignore id="thoigian-h-i-s"></span></div>
            </div>
            <div class="date_buy d-flex align-items-center ms-1">
              <i class="ic-24 ic-calendar"></i>
              <span wire:ignore id="thoigian-d-m-y"></span>
            </div>
             <p class="text-orange mb-0 ds-full">Mã bill: <span wire:ignore id="chitietMabill"></span></p>
          </div>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <div class="receiver_info p-3">
              <div class="receiver_title">Kỳ quay: <span wire:ignore id="chitietKiQuay"></span></div>
              <div class="receiver-content">
                <div class="ticket-result bd-line br-8">
                    @if(isset($numberTicket))
                    @foreach($numberTicket as $number)
                    <div class="t-result">{{$number}}</div>
                    @endforeach
                    @endif
                  <div class="t-result b-line @if($Lon13) {{'b-red'}} @endif">Lớn(13)</div>
                  <div class="t-result b-line @if($Lon11vs12) {{'b-red'}}  @endif">Lớn(11-12)</div>
                  <div class="t-result b-line @if($HoaLonNho10vs10) {{'b-red'}} @endif">Hòa Lớn-Nhỏ(10-10)</div>
                  <div class="t-result b-line @if($Nho11vs12) {{'b-red'}} @endif">Nhỏ(11-12)</div>
                  <div class="t-result b-line @if($Nho13) {{'b-red'}} @endif">Nhỏ(13)</div>
                  <div class="t-result b-line">Chẵn(15)</div>

                  <div class="t-result b-line @if($Chan15) {{'b-red'}} @endif">Chẵn(15)</div>
                  <div class="t-result b-line @if($Chan13vs14) {{'b-red'}} @endif">Chẵn(13-14)</div>
                  <div class="t-result b-line @if($Chan11vs12) {{'b-red'}} @endif">Chẵn(11-12)</div>
                  <div class="t-result b-line @if($HoaChanLe10vs10) {{'b-red'}} @endif">Hòa Chẵn-Lẻ(10-10)</div>

                  <div class="t-result b-line @if($Le11vs12) {{'b-red'}} @endif">Lẻ(11-12)</div>
                  <div class="t-result b-line @if($Le13vs14) {{'b-red'}} @endif">Lẻ(13-14)</div>
                  <div class="t-result b-line @if($Le15) {{'b-red'}} @endif">Lẻ(15)</div>
                </div>
              </div>
          </div>

          <div class="ticket_detail">
            <div class="row">
              <div class="col">
                  <div class="bg-gray p-3 br-8 h-full">
                    <div class="ds-list">
                      <div class="ds-item">
                        <div class="ds-title">Mã vé: #######</div>
                        <div class="ds-text"><strong class="">@if(isset($playType)) {{$playType}} @endif</strong></div>
                      </div>
                      <div class="ds-item">
                        <div class="ds-title">Bậc {{(isset($bacVe))?count($bacVe) : '0'}}: @if(isset($bacVe)) @foreach($bacVe as $ve) {{$ve}} @endforeach @endif</div>
                        <div class="ds-text"><strong>@if(isset($price)) {{number_format($price, '0', '', '.')}}  @endif đ</strong></div>
                      </div>
                      <div class="ds-item">
                        <div class="ds-title">Provider: Onbit</div>
                        <div class="ds-text"><strong>Partner: AB</strong></div>
                      </div>
                    </div>

                  </div>
              </div>
            </div>
          </div>

          <div class="buyticket-info">
            <h5 class="text-blue">Thông tin giải thưởng</h5>
            <div class="t-table">
              <div class="d-head">
                  <div class="row">
                    <div class="col-4">Giải thưởng</div>
                    <div class="col-4">Số trùng khớp</div>
                    <div class="col-4">Giá trị giải thưởng</div>
                  </div>
              </div>
              <div class="d-body">
                <div class="d-list">
                  <div class="row">
                    <div class="col-4">Trùng {{$countTrung}} số</div>
                    <div class="col-4">@foreach($soTrungKhopArr as $soTrung) {{$soTrung}} @endforeach</div>
                    <div class="col-4">{{(isset($giaTriGiaThuongPrize))?number_format($giaTriGiaThuongPrize, '0', '', '.'):'0'}}đ</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="buyticket-info">
            <h5 class="text-blue">Thông tin người nhận</h5>
            <div class="t-table">
              <div class="d-head">
                  <div class="row">
                    <div class="col-2">Họ tên</div>
                    <div class="col-2">
                      Số điện thoại
                    </div>
                    <div class="col-2">Trạng thái trả thưởng</div>
                    <div class="col-2">Số tiền</div>
                    <div class="col-2">
                      Hình thức trả thưởng
                    </div>
                    <div class="col-2">Ghi chú</div>
                  </div>
              </div>
              <div class="d-body">
                <div class="d-list">
                  <div class="row">
                    <div class="col-2">{{$fullNameDetails}}</div>
                    <div class="col-2">{{$phoneNumberDetails}}</div>
                    <div class="col-2">{{$statusDetails}}</div>
                    <div class="col-2">{{(isset($giaTriGiaThuongPrize))?number_format($giaTriGiaThuongPrize, '0', '', '.'):'0'}}đ</div>
                    <div class="col-2">{{(isset($giaTriGiaThuongPrize) and $giaTriGiaThuongPrize <= 10000000 )?'Cộng vào TK Ví Appota':'Liên hệ trực tiếp'}}</div>
                    <div class="col-2"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
            </div>

        </div>

        {{-- end modal detail --}}
        <div class="kt-portlet__body">
            <main class="flex-column d-flex">
                <div class="page-header page-subtrack bg-ball">
                    <div class="page-top d-flex align-items-center">
                        <h2 class="page-title">Thống kê giao dịch</h2>
                        <button
                        wire:click.prevent="$emit('downloadCSVLotteryWinScript')"
                        style="background: #FFFFFF !important; color: #276EF1 !important; border-radius: 8px !important; padding: 0.375rem 0.75rem !important;"
                        type="button" class="btn btn-white d-flex align-items-center"><i class="ic-24 ic-download"></i>
                        @if($loading)
                        <span>@livewire('loading.loading')</span>
                        @else
                        <span>Tải dữ liệu về</span>
                        @endif
                    </button>

                    </div>
                    <div class="page-search-header">
                        <div class="row row-wrap">
                            <div class="col">
                                <div class="input-append date text-12" >
                                  <input
                                  id="startTimeSearch"
                                  placeholder="Ngày bắt đầu"
                                  class="form-control text-12" size="16" type="text" >
                                  <span class="add-on"></span>
                                </div>
                            </div>
                            <div class="col">
                              <div class="input-append date text-12">
                                <input
                                id="endTimeSearch"
                                placeholder="Ngày kết thúc"
                                class="form-control text-12" size="16" type="text" >
                                <span class="add-on"></span>
                              </div>
                          </div>
                          <div class="col">
                            <input
                            id="phoneNumber"
                            type="text" class="form-control ipt-search text-12" placeholder="Tìm theo SDT người nhận">
                            </div>
                          <div class="col">
                            <input
                            id="fullName"
                            type="text" class="form-control ipt-search text-12" placeholder="Tìm theo tên người nhận">
                            </div>
                            <div class="col">
                                <div class="dropdown filterStatus" data-bs-toggle="cust_dropdown" data-bs-target="#ds_status">
                                <button
                                wire:ignore
                                style="margin-top: 4px;"
                                class="form-control dropdown-toggle text-12" type="button" id="filterStatusButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    Trạng thái
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="filterStatus" id="ds_status">
                                    <li><a class="dropdown-item active" href="javascript:void(0);"><input type="radio" name="ds_status" id="status_approved"
                                        value="all" /><label for="status_approved"><span class="text_filter">Tất cả</span></label></a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">
                                        <input type="radio" name="ds_status" id="status_pending" value="pending"  /><label for="status_pending"><span class="text_filter">Pending</span></label></a></li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);"><input type="radio" name="ds_status" id="status_done" value="successful"  /><label for="status_done"><span class="text_filter">Successful</span></label></a></li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);"><input type="radio" name="ds_status" id="status_cancel"
                                            value="unsuccessful"  /><label for="status_cancel"><span class="text_filter">Unsuccessful</span></label></a></li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);"><input type="radio" name="ds_status" id="status_expired"
                                            value="processing"  /><label for="status_expired"><span class="text_filter">Processing</span></label></a></li>
                                </ul>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col mb-0">
                                <input list="partnerCodeList" type="text" placeholder="Nhập partnerCode" id="partnerCode" class="form-control ipt-search text-12">

                                <datalist id="partnerCodeList">
                                    @if(isset($partnerCodeList))
                                    @foreach($partnerCodeList as $partnerCodeList)
                                    <option value="{{$partnerCodeList->partner_code}}"></option>
                                    @endforeach
                                    @endif
                                </datalist>

                            </div>
                            <div class="col mb-0" style="display: none;">
                                <div class="dropdown filterStatus" data-bs-toggle="cust_dropdown" data-bs-target="#ds_partner">
                                <button class="form-control dropdown-toggle text-12" type="button" id="filterStatus" data-bs-toggle="dropdown" aria-expanded="false">
                                    Partner
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="filterStatus" id="ds_partner">

                                </ul>
                                </div>
                            </div>
                            <div class="col">
                              <input
                              id="maBill"
                              type="text" class="form-control ipt-search text-12" placeholder="Tìm theo mã bill">
                              </div>
                            <div class="col" >

                                <input
                                autocomplete="off"
                                placeholder="Tìm theo loại vé"
                                list="loaiveList" type="text" id="loaive" class="form-control ipt-search text-12">
                                <datalist id="loaiveList">
                                    @if(isset($listLoaiVe))
                                    @foreach($listLoaiVe as $listLV)
                                    <option value="{{$listLV->code}}">{{($listLV->code == $listLV->name)?'':$listLV->name}}</option>
                                    @endforeach
                                    @endif
                                </datalist>


                              <input
                              style="visibility: hidden;"
                              id="maVe"
                              type="text" class="form-control ipt-search text-12" placeholder="Tìm theo mã vé">
                              </div>

                            <div class="col mb-0">

                            </div>

                            <div class="col mb-0" style="display: none;">
                                <div class="dropdown filterStatus" data-bs-toggle="cust_dropdown" data-bs-target="#ds_loaive">
                                <button class="form-control dropdown-toggle text-12" type="button" id="filterStatus" data-bs-toggle="dropdown" aria-expanded="false">
                                    Loại vé
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="filterStatus" id="ds_loaive">

                                </ul>
                                </div>
                            </div>
                            <div class="col mb-0">
                                <div class="d-grid">
                                    <button
                                    style="float: right;"
                                    wire:click.prevent="$emit('SearchLotteryWinPrizeScript')"
                                    type="button" class="btn btn-success">Tìm kiếm</button>
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
                                    <div class="block-36"><i class="ic-24 ic-total-ticket-2"></i></div>
                                    <div class="report-stats-text">Tổng số giao dịch</div>
                                </div>
                                <div class="report-stats-number">
                                    {{$totalTransactionLotterPrize}}
                                </div>
                            </div>
                            <div class="col">
                                <div class="report-stats-title">
                                    <div class="block-36"><i class="ic-24 ic-total-win"></i></div>
                                    <div class="report-stats-text">Tổng số vé trúng thưởng</div>
                                </div>
                                <div class="report-stats-number">
                                    {{$totalWinTicketLotteryPrize}}
                                </div>
                            </div>
                            <div class="col">
                                <div class="report-stats-title">
                                    <div class="block-36"><i class="ic-24 ic-check-blue"></i></div>
                                    <div class="report-stats-text">Tổng số đã trả thưởng</div>
                                </div>
                                <div class="report-stats-number">
                                    {{number_format($totalRevenueLotteryPrize, '0', '', '.')}}đ
                                </div>
                            </div>
                            {{-- <div class="col">
                                <div class="report-stats-title">
                                    <div class="block-36"><i class="ic-24 ic-attach"></i></div>
                                    <div class="report-stats-text">Tổng số chưa trả thưởng</div>
                                </div>
                                <div class="report-stats-number">
                                    32,656
                                </div>
                            </div> --}}
                            {{-- <div class="col">
                                <div class="report-stats-title">
                                    <div class="block-36"><i class="ic-24 ic-info-blue"></i></div>
                                    <div class="report-stats-text">Tổng số trả thưởng thất bại</div>
                                </div>
                                <div class="report-stats-number">
                                    32,656
                                </div>
                            </div> --}}
                        </div>
                    </div>

                    <div class="report-list">
                        <div class="table-responsive">
                            <table class="table" id="reportList">
                                <thead>
                                    <tr>
                                        <th class="fit">ID</th>
                                        <th class="fit">Mã giao dịch</th>
                                        <th class="fit">Mã Bill</th>
                                        <th class="fit">Loại vé</th>
                                        <th class="fit">Nhà cung cấp</th>
                                        <th class="fit">Partner</th>
                                        <th class="fit">Kỳ mua</th>
                                        <th class="fit">Họ tên</th>
                                        <th class="fit">Số điện thoại</th>

                                        <th class="fit">Trị giá giải thưởng</th>
                                        <th class="fit">Trạng thái trả thưởng</th>
                                        <th class="fit">Ngày trả thưởng</th>
                                        <th class="fit">Ghi chú</th>
                                        <th class="fit">Thao tác nhanh</th>
                                        <th style="display: none;">input</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @dd($lotteryTransactions) --}}
                                    @if(isset($lotteryTransactions))
                                    @foreach($lotteryTransactions as $list)
                                    <tr>
                                        <td>{{$list->id}}</td>
                                        <td><a href="#" wire:click.prevent="$emit('showDetailsLotteryWinPrizeScript', '{{$list->bill->lotteryTransactionId}}')">{{$list->bill->lotteryTransactionId}}</a></td>
                                        <td>{{$list->bill->billCode}}</td>
                                        <td>{{$list->lotteryCode}}</td>
                                        <td>{{$list->providerCode}}</td>
                                        <td>{{$list->partnerCode}}</td>
                                        <td class="kimua">{{$list->bill->drawIndex}}</td>
                                        <td>{{$list->bill->fullName}}</td>
                                        <td>{{$list->bill->phoneNumber}}</td>
                                        <td>{{number_format($list->prize, '0', '', ',')}}</td>
                                        <td>{{(isset($list->trangthaitrathuong))?$list->trangthaitrathuong:'Chưa có trạng thái trả thưởng'}}</td>
                                        <td>{{(isset($list->ngaytrathuong))?$list->ngaytrathuong:'Chưa có ngày trả thưởng'}}</td>

                                        <td>{{(isset($list->message))?$list->message:''}}</td>
                                        <td class="fit">
                                            <div style="display: flex;">
                                                <span><a href="#">Thanh toán lại</a></span>
                                            <span><a href="#"><img src="{{asset('css/icon/thaotac.png')}}" alt="" width="20" height="20"></a></span>
                                            </div>

                                        </td>
                                        <td style="display: none;">
                                            <input id="createdAtDay-{{$list->bill->lotteryTransactionId}}" type="hidden" value="{{date('d/m/Y', strtotime($list->createdAt))}}">

                                            <input id="createdAtTime-{{$list->bill->lotteryTransactionId}}" type="hidden" value="{{date('H:i:s', strtotime($list->createdAt))}}">

                                            <input id="billCode-{{$list->bill->lotteryTransactionId}}" type="hidden" value="{{$list->bill->billCode}}">

                                            <input id="drawIndex-{{$list->bill->lotteryTransactionId}}" type="hidden" value="{{$list->bill->drawIndex}}">

                                            <input id="ID-Details-{{$list->bill->lotteryTransactionId}}" type="text" value="{{$list->id}}">


                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif

                                </tbody>
                            </table>
                            @if(isset($lotteryTransactions))

                            <nav aria-label="Page navigation example">
                              <ul class="pagination">
                                <li
                                wire:click.prevent="gotoCurrentPage('{{$currentPage - 1}}')"
                                class="page-item @if($currentPage <= 1) {{'disabled'}}  @endif" style="text-align: center;">
                                  <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                  </a>
                                </li>
                                @for($i = $start; $i <= $end; $i++)
                                <li
                                wire:click.prevent="gotoCurrentPage('{{$i}}')"
                                class="page-item @if($i == $currentPage) {{'active'}} @endif" style="text-align: center;"><a class="page-link" href="#">{{$i}}</a></li>
                                @endfor
                                <li
                                wire:click.prevent="gotoCurrentPage('{{$currentPage + 1}}')"
                                class="page-item @if($currentPage >= $totalPage) {{'disabled'}}  @endif" style="text-align: center;">
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

            </main>
        </div>

    </div>
</div>
