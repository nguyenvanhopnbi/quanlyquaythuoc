@push('css')
    <style>
        .text-secondary{
            color: red !important;
        }
        .title-dashboard{
            font-size: 16px;
            text-align: left;
            height: 30px;
        }
        .title-dashboard a{
            color: #858585;
        }

        .revenue-in-day > label{
            font-size: 16px;
            color: #858585;
        }

        .revenue-in-day > span{
            font-size: 20px;
            color: #3c9f97;
            font-weight: 800;
        }
        .in-de-notice > label{

        }
        .card-body-custom{
            position: relative;
            padding-top: 4px;
        }

        .row-body{
            position: absolute;
            right: 0;
            bottom: 0;
        }


    </style>
@endpush

<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Tổng Quan Chung
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="dropdown dropdown-inline">
                        {{-- <a href="/partner-partners/add" class="btn btn-brand btn-icon-sm"><i class="flaticon2-plus"></i> Thêm partner</a> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">

            <div class="row mb-5">
                <div class="col-3">
                    <label for="startTime">Start Time: </label>
                    <input placeholder="Ngày bắt đầu" autocomplete="off" type="text" id="startTimeSearch" class="form-control">
                </div>
                <div class="col-3">
                    <label for="startTime">End Time: </label>
                    <input placeholder="Ngày kết thúc" autocomplete="off" type="text" id="endTimeSearch" class="form-control">

                </div>
                <div class="col-3">
                    <button wire:click.prevent="$emit('searchDashboardScript')" class="btn btn-primary" style="margin-top: 34px">Search</button>
                </div>
            </div>

            <div class="row mb-5">

                {{-- dich vu chi ho --}}

                <div class="col-md-6 col-xxl-3">
                    <div class="card h-md-100">
                    <div class="card-header pb-0">
                        <h6 class="mb-0 mt-2 title-dashboard">
                            <a href="{{route('transfer-money.dashboard')}}">Dịch vụ chi hộ</a></h6>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-end card-body-custom">
                      <div class="row justify-content-between">
                        <div class="col-auto align-self-end">
                        @if(!isset($total_ChiHo))
                        <div class="fs-4 fw-normal font-sans-serif text-700 lh-1 mb-1 revenue-in-day">
                            <label for="Tổng tiền">Doanh thu trong ngày: </label> <br/>
                            <span id="tongtienDichVuChiHo">
                                @if(isset($doanhThuTrongNgay_DVChiHo))
                                {{number_format($doanhThuTrongNgay_DVChiHo, 0, '', '.')}} VNĐ
                                @endif
                            </span>
                        </div>

                        @else

                        <div class="fs-4 fw-normal font-sans-serif text-700 lh-1 mb-1 revenue-in-day">
                            <label for="Tổng tiền">Tổng doanh thu: </label> <br/>
                            <span id="tongtienDichVuChiHo">

                                {{number_format($total_ChiHo, 0, '', '.')}} VNĐ

                            </span>
                        </div>

                        @endif


                        </div>


                        <div class="row justify-content-between row-body {{(isset($total_ChiHo))?'d-none':''}}">
                          <div class="col-auto align-self-end">
                            <div class="fs-4 fw-normal font-sans-serif text-700 lh-1 mb-1">
                            @if(isset($tanggiamThongBao_DVChiHo) and $tanggiamThongBao_DVChiHo > 0)
                            <label for="Tang giam" class="text-success">

                            <svg name="icontang" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-circle" viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
                            </svg>
                            {{$phantramTangGiam_DVChiHo}} % so với Hqa</label>

                            @elseif(isset($tanggiamThongBao_DVChiHo) and $tanggiamThongBao_DVChiHo == 0)

                            <label for="Tang giam" class="text-secondary">

                            <svg name="icontang" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-circle" viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
                            </svg>
                            Doanh thu ngày hôm qua bằng 0.</label>

                            @else

                            <label for="Tang giam" class="text-secondary">
                                <svg name="icongiam" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-circle" viewBox="0 0 16 16">
                                  <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                                </svg>
                            {{$phantramTangGiam_DVChiHo}} % so với Hqa
                            </label>
                            @endif
                        </div>
                          </div>
                      </div>



                      </div>
                    </div>
                    </div>
                </div>
                {{-- end dich vu chi ho --}}


                {{-- dich vu thu ho qua va --}}
                <div class="col-md-6 col-xxl-3">
                    <div class="card h-md-100">
                    <div class="card-header pb-0">
                        <h6 class="mb-0 mt-2 title-dashboard">
                            <a href="{{route('gate.ebill-dashboard')}}">Dịch vụ thu hộ qua VA</a></h6>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-end card-body-custom">
                      <div class="row justify-content-between">
                        <div class="col-auto align-self-end">
                        @if(!isset($total_ThuHoQuaVA))
                        <div class="fs-4 fw-normal font-sans-serif text-700 lh-1 mb-1 revenue-in-day">
                            <label for="Tổng tiền">Doanh thu trong ngày: </label> <br/>
                            <span id="tongtienDichVuThuHoquaVA">
                                @if(isset($doanhThuTrongNgay_DVThuHoQuaVA))
                                {{number_format($doanhThuTrongNgay_DVThuHoQuaVA, 0, '', '.')}} VNĐ
                                @endif
                            </span>
                        </div>
                        @else

                        <div class="fs-4 fw-normal font-sans-serif text-700 lh-1 mb-1 revenue-in-day">
                            <label for="Tổng tiền">Tổng doanh thu: </label> <br/>
                            <span id="tongtienDichVuThuHoquaVA">
                                {{number_format($total_ThuHoQuaVA, 0, '', '.')}} VNĐ
                            </span>
                        </div>

                        @endif

                        </div>


                        <div class="row justify-content-between row-body {{(isset($total_ThuHoQuaVA))?'d-none':''}}">
                          <div class="col-auto align-self-end">
                              <div class="fs-4 fw-normal font-sans-serif text-700 lh-1 mb-1">
                            @if(isset($tanggiamThongBao_DVThuHoQuaVA) and $tanggiamThongBao_DVThuHoQuaVA > 0)
                            <label for="Tang giam" class="text-success">

                            <svg name="icontang" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-circle" viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
                            </svg>
                            {{$phantramTangGiam_DVThuHoQuaVA}} % so với Hqa</label>

                            @elseif(isset($tanggiamThongBao_DVThuHoQuaVA) and $tanggiamThongBao_DVThuHoQuaVA == 0)

                            <label for="Tang giam" class="text-secondary">

                            <svg name="icontang" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-circle" viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
                            </svg>
                            Doanh thu ngày hôm qua bằng 0.</label>

                            @else

                            <label for="Tang giam" class="text-secondary">
                                <svg name="icongiam" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-circle" viewBox="0 0 16 16">
                                  <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                                </svg>
                            {{$phantramTangGiam_DVThuHoQuaVA}} % so với Hqa
                            </label>
                            @endif
                        </div>
                          </div>
                      </div>


                      </div>
                    </div>
                    </div>
                </div>
                {{-- end dich vu thu ho qua va --}}


            </div>

            <div class="row mb-5">
                {{-- dich vu cong thanh toan --}}

                <div class="col-md-6 col-xxl-3">
                    <div class="card h-md-100">
                    <div class="card-header pb-0">
                        <h6 class="mb-0 mt-2 title-dashboard">
                            <a href="{{route('gate.money.dashboard')}}">Dịch vụ cổng thanh toán</a>
                        </h6>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-end card-body-custom">

                      <div class="row justify-content-between">
                        <div class="col-auto align-self-end">

                        @if(!isset($total_dvCongTT))
                        <div class="fs-4 fw-normal font-sans-serif text-700 lh-1 mb-1 revenue-in-day">
                            <label for="Tổng tiền">Doanh thu trong ngày: </label> <br/>
                            <span id="tongtienDichVuCongThanhToan" class="">
                                {{number_format($doanhThuTrongNgayDVCongThanhToan, 0, '', '.')}} VNĐ
                            </span>
                        </div>
                        @else
                        <div class="fs-4 fw-normal font-sans-serif text-700 lh-1 mb-1 revenue-in-day">
                            <label for="Tổng tiền">Tổng doanh thu: </label> <br/>
                            <span id="tongtienDichVuCongThanhToan" class="">
                                {{number_format($total_dvCongTT, 0, '', '.')}} VNĐ
                            </span>
                        </div>
                        @endif

                        </div>
                      </div>

                      <div class="row justify-content-between row-body {{(isset($total_dvCongTT))?'d-none':''}}">
                          <div class="col-auto align-self-end">
                              <div class="fs-4 fw-normal font-sans-serif text-700 lh-1 mb-1 revenue-in-day">
                                <div class="fs-4 fw-normal font-sans-serif text-700 lh-1 mb-1 in-de-notice">
                                    @if(isset($tanggiamThongBao) and $tanggiamThongBao == 1)
                                    <label for="Tang giam" class="text-success">

                                    <svg name="icontang" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-circle" viewBox="0 0 16 16">
                                      <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
                                    </svg>
                                    {{$phantramTangGiamDVCongThanhToan}} % so với Hqa</label>

                                    @elseif(isset($tanggiamThongBao) and $tanggiamThongBao == 0)
                                    <label for="Tang giam" class="text-secondary">

                                    <svg name="icontang" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-circle" viewBox="0 0 16 16">
                                      <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
                                    </svg>
                                    Doanh thu ngày hôm qua bằng 0.</label>

                                    @else

                                    <label for="Tang giam" class="text-secondary">
                                    <svg name="icongiam" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-circle" viewBox="0 0 16 16">
                                      <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                                    </svg>
                                    {{$phantramTangGiamDVCongThanhToan}} % so với Hqa
                                </label>
                                    @endif
                                </div>
                            </div>
                          </div>
                      </div>
                    </div>

                    </div>
                </div>

                {{-- end dich vu cong thanh toan --}}

                {{-- dich vu payment link --}}
                <div class="col-md-6 col-xxl-3">
                    <div class="card h-md-100">
                    <div class="card-header pb-0">
                        <h6 class="mb-0 mt-2 title-dashboard">
                            <a href="{{route('plink.overview')}}">Dịch vụ Payment Link</a></h6>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-end card-body-custom">
                      <div class="row justify-content-between">
                        <div class="col-auto align-self-end">

                        @if(!isset($total_paymentLink))
                            <div class="fs-4 fw-normal font-sans-serif text-700 lh-1 mb-1 revenue-in-day">
                                <label for="Tổng tiền">Doanh thu trong ngày: </label> <br/>
                                <span id="tongtienDichVuPaymentLink">
                                    @if(isset($doanhThuTrongNgay_PaymentLink))
                                    {{number_format($doanhThuTrongNgay_PaymentLink, 0, '', '.')}} VNĐ
                                    @endif
                                </span>
                            </div>
                        @else

                            <div class="fs-4 fw-normal font-sans-serif text-700 lh-1 mb-1 revenue-in-day">
                                <label for="Tổng tiền">Tổng doanh thu: </label> <br/>
                                <span id="tongtienDichVuPaymentLink_filter">
                                    {{number_format($total_paymentLink, 0, '', '.')}} VNĐ
                                </span>
                            </div>

                        @endif

                        </div>

                            <div class="row justify-content-between row-body {{(isset($total_paymentLink))?'d-none':''}}">
                              <div class="col-auto align-self-end">
                                  <div class="fs-4 fw-normal font-sans-serif text-700 lh-1 mb-1">
                                    @if(isset($tanggiamThongBao_PaymentLink) and $tanggiamThongBao_PaymentLink > 0)
                                    <label for="Tang giam" class="text-success">

                                    <svg name="icontang" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-circle" viewBox="0 0 16 16">
                                      <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
                                    </svg>
                                    {{$phantramTangGiam_PaymentLink}} % so với Hqa</label>

                                    @elseif(isset($tanggiamThongBao_PaymentLink) and $tanggiamThongBao_PaymentLink == 0)

                                    <label for="Tang giam" class="text-secondary">

                                    <svg name="icontang" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-circle" viewBox="0 0 16 16">
                                      <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
                                    </svg>
                                    Doanh thu ngày hôm qua bằng 0.</label>

                                    @else

                                    <label for="Tang giam" class="text-secondary">
                                        <svg name="icongiam" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-circle" viewBox="0 0 16 16">
                                          <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                                        </svg>
                                    {{$phantramTangGiam_PaymentLink}} % so với Hqa
                                    </label>
                                    @endif
                                </div>
                              </div>
                        </div>





                      </div>
                    </div>
                    </div>
                </div>
                {{-- end dich vu payment link --}}

            </div>


            <div class="row mb-5">
                {{-- dich vu topup --}}

                <div class="col-md-6 col-xxl-3">
                    <div class="card h-md-100">
                    <div class="card-header pb-0">
                        <h6 class="mb-0 mt-2 title-dashboard">
                            <a href="{{route('topup.dashboard')}}">Dịch vụ topup</a>
                        </h6>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-end card-body-custom">
                      <div class="row justify-content-between">
                        <div class="col-auto align-self-end">

                        @if(!isset($total_dvTopup))
                        <div class="fs-4 fw-normal font-sans-serif text-700 lh-1 mb-1 revenue-in-day">
                            <label for="Tổng tiền">Doanh thu trong ngày: </label> <br/>
                            <span id="tongtienDichVuTopUp">
                            @if(isset($doanhThuTrongNgay_DVTopup))
                            {{number_format($doanhThuTrongNgay_DVTopup, 0, '', '.')}} VNĐ
                            @endif</span>

                        </div>
                        @else
                        <div class="fs-4 fw-normal font-sans-serif text-700 lh-1 mb-1 revenue-in-day">
                            <label for="Tổng tiền">Tổng doanh thu: </label> <br/>
                            <span id="tongtienDichVuTopUp">
                            {{number_format($total_dvTopup, 0, '', '.')}} VNĐ
                            </span>

                        </div>
                        @endif

                        </div>
                        <div class="row justify-content-between row-body {{(isset($total_dvTopup))?'d-none':''}}">
                          <div class="col-auto align-self-end">
                              <div class="fs-4 fw-normal font-sans-serif text-700 lh-1 mb-1">
                            @if(isset($tanggiamThongBao_DVTopup) and $tanggiamThongBao_DVTopup > 0)
                            <label for="Tang giam" class="text-success">

                            <svg name="icontang" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-circle" viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
                            </svg>
                            {{$phantramTangGiam_DVTopup}} % so với Hqa</label>

                            @elseif(isset($tanggiamThongBao_DVTopup) and $tanggiamThongBao_DVTopup == 0)

                            <label for="Tang giam" class="text-secondary">

                            <svg name="icontang" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-circle" viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
                            </svg>
                            Doanh thu ngày hôm qua bằng 0.</label>

                            @else

                            <label for="Tang giam" class="text-secondary">
                                <svg name="icongiam" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-circle" viewBox="0 0 16 16">
                                  <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                                </svg>
                            {{$phantramTangGiam_DVTopup}} % so với Hqa
                            </label>
                            @endif
                        </div>
                          </div>
                      </div>




                      </div>
                    </div>
                    </div>
                </div>
                {{-- end dich vu topup --}}

                {{-- dich vu TT hoa don --}}
                <div class="col-md-6 col-xxl-3">
                    <div class="card h-md-100">
                    <div class="card-header pb-0">
                        <h6 class="mb-0 mt-2 title-dashboard">
                            <a href="{{route('bill.serviceCategory.dashboard')}}">Dịch vụ TT hóa đơn</a>
                        </h6>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-end card-body-custom">
                      <div class="row justify-content-between">
                        <div class="col-auto align-self-end">

                        @if(!isset($total_dvTTHoaDon))
                        <div class="fs-4 fw-normal font-sans-serif text-700 lh-1 mb-1 revenue-in-day">
                            <label for="Tổng tiền">Doanh thu trong ngày: </label> <br/>
                            <span id="tongtienDichVuTTHoaDon">
                                @if(isset($doanhThuTrongNgay_DVTTHoaDon))
                                {{number_format($doanhThuTrongNgay_DVTTHoaDon, 0, '', '.')}} VNĐ
                                @endif
                            </span>
                        </div>
                        @else
                        <div class="fs-4 fw-normal font-sans-serif text-700 lh-1 mb-1 revenue-in-day">
                            <label for="Tổng tiền">Tổng doanh thu: </label> <br/>
                            <span id="tongtienDichVuTTHoaDon">
                                {{number_format($total_dvTTHoaDon, 0, '', '.')}} VNĐ
                            </span>
                        </div>
                        @endif
                        </div>


                        <div class="row justify-content-between row-body {{(isset($total_dvTTHoaDon))?'d-none':''}}">
                          <div class="col-auto align-self-end">
                            <div class="fs-4 fw-normal font-sans-serif text-700 lh-1 mb-1">
                            @if(isset($tanggiamThongBao_DVTTHoaDon) and $tanggiamThongBao_DVTTHoaDon > 0)
                            <label for="Tang giam" class="text-success">

                            <svg name="icontang" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-circle" viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
                            </svg>
                            {{$phantramTangGiam_DVTTHoaDon}} % so với Hqa</label>

                            @elseif(isset($tanggiamThongBao_DVTTHoaDon) and $tanggiamThongBao_DVTTHoaDon == 0)

                            <label for="Tang giam" class="text-secondary">

                            <svg name="icontang" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-circle" viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
                            </svg>
                            Doanh thu ngày hôm qua bằng 0.</label>

                            @else

                            <label for="Tang giam" class="text-secondary">
                                <svg name="icongiam" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-circle" viewBox="0 0 16 16">
                                  <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                                </svg>
                            {{$phantramTangGiam_DVTTHoaDon}} % so với Hqa
                            </label>
                            @endif
                        </div>
                          </div>
                      </div>

                      </div>
                    </div>
                    </div>
                </div>
                {{-- end dich vu tt hoa don --}}

            </div>


            <div class="row mb-5">
                {{-- dich vu ban the --}}

                <div class="col-md-6 col-xxl-3">
                    <div class="card h-md-100">
                    <div class="card-header pb-0">
                        <h6 class="mb-0 mt-2 title-dashboard">
                            <a href="{{route('shopcard.dashboard')}}">Dịch vụ bán thẻ</a></h6>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-end card-body-custom">
                      <div class="row justify-content-between">
                        <div class="col-auto align-self-end">

                        @if(!isset($total_dvBanThe))
                        <div class="fs-4 fw-normal font-sans-serif text-700 lh-1 mb-1 revenue-in-day">
                            <label for="Tổng tiền">Doanh thu trong ngày: </label> <br/>
                            <span id="tongtienDichVuBanThe">
                                @if(isset($doanhThuTrongNgay_DVBanThe))
                                {{number_format($doanhThuTrongNgay_DVBanThe, 0, '', '.')}} VNĐ
                                @endif
                            </span>

                        </div>
                        @else
                        <div class="fs-4 fw-normal font-sans-serif text-700 lh-1 mb-1 revenue-in-day">
                            <label for="Tổng tiền">Tổng doanh thu: </label> <br/>
                            <span id="tongtienDichVuBanThe">
                                {{number_format($total_dvBanThe, 0, '', '.')}} VNĐ
                            </span>

                        </div>


                        @endif
                        </div>
                        <div class="row justify-content-between row-body {{(isset($total_dvBanThe))?'d-none':''}}">
                          <div class="col-auto align-self-end">
                              <div class="fs-4 fw-normal font-sans-serif text-700 lh-1 mb-1">
                            @if(isset($tanggiamThongBao_DVBanThe) and $tanggiamThongBao_DVBanThe > 0)
                            <label for="Tang giam" class="text-success">

                            <svg name="icontang" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-circle" viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
                            </svg>
                            {{$phantramTangGiam_DVBanThe}} % so với Hqa</label>

                            @elseif(isset($tanggiamThongBao_DVBanThe) and $tanggiamThongBao_DVBanThe == 0)

                            <label for="Tang giam" class="text-secondary">

                            <svg name="icontang" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-circle" viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
                            </svg>
                            Doanh thu ngày hôm qua bằng 0.</label>

                            @else

                            <label for="Tang giam" class="text-secondary">
                                <svg name="icongiam" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-circle" viewBox="0 0 16 16">
                                  <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                                </svg>
                            {{$phantramTangGiam_DVBanThe}} % so với Hqa
                            </label>
                            @endif
                        </div>
                          </div>
                      </div>

                      </div>
                    </div>
                    </div>
                </div>
                {{-- end dich vu topup --}}

                {{-- dich vu Charging --}}
                <div class="col-md-6 col-xxl-3">
                    <div class="card h-md-100">
                    <div class="card-header pb-0">
                        <h6 class="mb-0 mt-2 title-dashboard">
                            <a href="{{route('charging.card.dashboard')}}">Dịch vụ charging</a>
                        </h6>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-end card-body-custom">
                      <div class="row justify-content-between">
                        <div class="col-auto align-self-end">

                        @if(!isset($total_dvCharging))
                        <div class="fs-4 fw-normal font-sans-serif text-700 lh-1 mb-1 revenue-in-day">
                            <label for="Tổng tiền">Doanh thu trong ngày: </label> <br/>
                            <span id="tongtienDichVuCongThanhToan">
                                @if(isset($doanhThuTrongNgay_DVCharging))
                                {{number_format($doanhThuTrongNgay_DVCharging, 0, '', '.')}} VNĐ
                                @endif
                            </span>
                        </div>
                        @else
                        <div class="fs-4 fw-normal font-sans-serif text-700 lh-1 mb-1 revenue-in-day">
                            <label for="Tổng tiền">Tổng doanh thu: </label> <br/>
                            <span id="tongtienDichVuCongThanhToan">
                                {{number_format($total_dvCharging, 0, '', '.')}} VNĐ
                            </span>
                        </div>
                        @endif

                        </div>
                        <div class="row justify-content-between row-body {{(isset($total_dvCharging))?'d-none':''}}">
                          <div class="col-auto align-self-end">
                              <div class="fs-4 fw-normal font-sans-serif text-700 lh-1 mb-1">
                            @if(isset($tanggiamThongBao_DVCharging) and $tanggiamThongBao_DVCharging > 0)
                            <label for="Tang giam" class="text-success">

                            <svg name="icontang" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-circle" viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
                            </svg>
                            {{$phantramTangGiam_DVCharging}} % so với Hqa</label>

                            @elseif(isset($tanggiamThongBao_DVCharging) and $tanggiamThongBao_DVCharging == 0)

                            <label for="Tang giam" class="text-secondary">

                            <svg name="icontang" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-circle" viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
                            </svg>
                            Doanh thu ngày hôm qua bằng 0.</label>

                            @else

                            <label for="Tang giam" class="text-secondary">
                                <svg name="icongiam" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-circle" viewBox="0 0 16 16">
                                  <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                                </svg>
                            {{$phantramTangGiam_DVCharging}} % so với Hqa
                            </label>
                            @endif
                        </div>

                          </div>
                      </div>

                      </div>
                    </div>
                    </div>
                </div>
                {{-- end dich vu charging --}}

            </div>




        </div>
        <div wire:ignore class="kt-portlet__body">
            <div class="row">
                <div class="col text-center">
                    <h1>Biểu đồ so sánh trong ngày</h1>
                </div>
            </div>

            <div class="row" style="margin-bottom: 40px;">
                <div class="col text-center">
                    <canvas
                        id="ChartDichVuThuHoQuaVA"
                        data-zr-dom-id="zr_0"
                        width="600" height="250"
                        >

                    </canvas>
                </div>
            </div>

            <div class="row" style="margin-bottom: 40px;">
                <div class="col text-center">
                    <canvas
                        id="ChartDichVuChiHo"
                        data-zr-dom-id="zr_0"
                        width="600" height="250"
                        >

                    </canvas>
                </div>

            </div>

            <div class="row" style="margin-bottom: 40px;">
                <div class="col text-center">
                    <canvas
                        id="ChartDichVuCongThanhtoan"
                        data-zr-dom-id="zr_0"
                        width="600" height="250"
                        >

                    </canvas>
                </div>

            </div>


            <div class="row" style="margin-bottom: 40px;">

                <div class="col text-center">
                    <canvas
                        id="ChartDichVuCharging"
                        data-zr-dom-id="zr_0"
                        height="150"
                        >
                    </canvas>
                </div>
            </div>




            <div class="row" style="margin-bottom: 40px;">
                <div class="col text-center">
                    <canvas
                        id="ChartDichVuTopup"
                        data-zr-dom-id="zr_0"
                        height="150"
                        >

                    </canvas>
                </div>

            </div>
            <div class="row" style="margin-bottom: 40px;">
                <div class="col text-center">
                    <canvas
                        id="ChartDichVuTThoadon"
                        data-zr-dom-id="zr_0"
                        height="150"
                        >

                    </canvas>
                </div>
            </div>


            <div class="row" style="margin-bottom: 40px;">
                <div class="col text-center">
                    <canvas
                        id="ChartDichVuBanThe"
                        data-zr-dom-id="zr_0"
                        height="150"
                        >

                    </canvas>
                </div>

            </div>


            <div class="row" style="margin-bottom: 40px;">
                <div class="col text-center">
                    <canvas
                        id="ChartDichVuPaymentLink"
                        data-zr-dom-id="zr_0"
                        height="150"
                        >

                    </canvas>
                </div>
            </div>



        </div>
    </div>
</div>


@push('scriptsChart')

<script>


    document.addEventListener('livewire:load', function () {

        // ChartDichVuPaymentLink

        var ChartDichVuTopup = document.getElementById("ChartDichVuPaymentLink").getContext('2d');
        var myChart = new Chart(ChartDichVuTopup, {
        type: 'line',
        data: {
            labels: @this.dvPaymentLink_head,
            datasets: [{
            label: '# Dịch vụ payment link',
            data: @this.dvPaymentLink_value,
            backgroundColor: [
            '#0043FC',
            // 'rgba(54, 162, 235, 0.2)',
            // 'rgba(255, 206, 86, 0.2)',
            // 'rgba(75, 192, 192, 0.2)',
            // 'rgba(153, 102, 255, 0.2)',
            // 'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
            '#0043FC',
            ],
            borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                        ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
        });

        // ChartDichVuChiHo
         var ChartDichVuTopup = document.getElementById("ChartDichVuChiHo").getContext('2d');
        var myChart = new Chart(ChartDichVuTopup, {
        type: 'line',
        data: {
            labels: @this.dvChiho_head,
            datasets: [{
            label: '# Dịch vụ chi hộ',
            data: @this.dvChiHo_value,
            backgroundColor: [
            '#0043FC',
            ],
            borderColor: [
            '#0043FC',
            ],
            borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                        ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
        });


        // dich vu ChartDichVuThuHoQuaVA

        var ChartDichVuTopup = document.getElementById("ChartDichVuThuHoQuaVA").getContext('2d');
        var myChart = new Chart(ChartDichVuTopup, {
        type: 'line',
        data: {
            labels: @this.dvThuHoVA_head,
            datasets: [{
            label: '# Dịch vụ thu hộ VA',
            data: @this.dvThuHoVA_value,
            backgroundColor: [
            '#0043FC',
            ],
            borderColor: [
            '#0043FC',
            ],
            borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                        ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
        });




        // dich vu Ban the

        var ChartDichVuTopup = document.getElementById("ChartDichVuBanThe").getContext('2d');
        var myChart = new Chart(ChartDichVuTopup, {
        type: 'line',
        data: {
            labels: @this.dvBanThe_head,
            datasets: [{
            label: '# Dịch vụ bán thẻ',
            data: @this.dvBanThe_value,
            backgroundColor: [
            '#0043FC',
            ],
            borderColor: [
            '#0043FC',
            ],
            borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                        ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
        });



        // dich vu ChartDichVuCharging

        var ChartDichVuTopup = document.getElementById("ChartDichVuCharging").getContext('2d');
        var myChart = new Chart(ChartDichVuTopup, {
        type: 'line',
        data: {
            labels: @this.valueChartChargingHead,
            datasets: [{
            label: '# Dịch vụ charging',
            data: @this.valueChartChargingValue,
            backgroundColor: [
            '#0043FC',
            ],
            borderColor: [
            '#0043FC',
            ],
            borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                        ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
        });


        /// dich vu TT hoa don
        var ChartDichVuTopup = document.getElementById("ChartDichVuTThoadon").getContext('2d');
        var myChart = new Chart(ChartDichVuTopup, {
        type: 'line',
        data: {
            labels: @this.valueChartDVTTHoaDonHead,
            datasets: [{
            label: '# Dịch vụ TT hóa đơn',
            data: @this.valueChartDVTTHoaDonValue,
            backgroundColor: [
            '#0043FC',
            ],
            borderColor: [
            '#0043FC',
            ],
            borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                        ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
        });


        /// dich vu topup
        var ChartDichVuTopup = document.getElementById("ChartDichVuTopup").getContext('2d');
        var myChart = new Chart(ChartDichVuTopup, {
        type: 'line',
        data: {
            labels: @this.valueChartTopupHead,
            datasets: [{
            label: '# Dịch vụ topup',
            data: @this.valueChartTopupValue,
            backgroundColor: [
            '#0043FC',
            ],
            borderColor: [
            '#0043FC',
            ],
            borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                        ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
        });


        /// dich vu cổng thanh toán
        var ChartDichVuTopup = document.getElementById("ChartDichVuCongThanhtoan").getContext('2d');
        var myChart = new Chart(ChartDichVuTopup, {
        type: 'line',
        data: {
            labels: @this.dvCongTT_date,
            datasets: [{
            label: '# Dịch vụ cổng thanh toán',
            data: @this.dvCongTT_value,
            backgroundColor: [
            '#0043FC',
            ],
            borderColor: [
            '#0043FC',
            ],
            borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                        ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
        });



    })



</script>

@endpush
