<?php
if (!function_exists('currency_format')) {
    function currency_format($number, $suffix = 'đ') {
        if (!empty($number)) {
            return number_format($number, 0, ',', '.') . "{$suffix}";
        }
    }
}

?>
<div>
    {{-- In work, do what you enjoy. --}}
    <input type="hidden" id="tab-now" value="dasboard-index">

<div class="row">
    <div class="col-xl-12">
        <!--begin:: Widgets/Tasks -->
        <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Thống kê nhanh trong ngày
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <!--begin::Section-->
                <div class="kt-section">
                    <div class="kt-section__content kt-wizard-v12__form">
                        <form name="form-filter-billservice">
                            <div class="row">
                                <div class="col col-lg-2 col-xl-2">
                                    <label>Partner code</label>
                                    {{-- <select  class="form-control" type="text" name="partner_code" id="partner_code_flash"></select> --}}
                                    <input type="text" class="form-control" id="billservice_partnerCode" name="billservice_partnerCode" list="listBillServicePartnerCode">
                                    <datalist id="listBillServicePartnerCode">
                                        @if(isset($partnerCodeBillservice))
                                        @foreach($partnerCodeBillservice as $partnerCode)
                                        <option value="{{$partnerCode->partner_code}}"></option>
                                        @endforeach
                                        @endif
                                    </datalist>
                                </div>
                                <div class="col col-lg-3 col-xl-2">
                                    <label for="exampleInputPassword1">Từ ngày (tháng/ngày/năm)</label>
                                    <!-- <input type="date" name="time-from" id="time-from-flash" value="{{ date('Y-m-d') }}" class="form-control"> -->
                                    <input type="text" name="time-from" id="time-from-flash"  value="{{ date('m/d/Y') }}"  class="form-control">
                                </div>
                                <div class="col col-lg-3 col-xl-2">
                                    <label for="exampleInputPassword1">Đến ngày (tháng/ngày/năm)</label>
                                    <!-- <input type="date" name="time-to" id="time-to-flash" value="{{ date('Y-m-d') }}" class="form-control"> -->
                                    <input type="text" name="time-to" id="time-to-flash"   value="{{ date('m/d/Y') }}" class="form-control">
                                </div>
                                <div class="col col-lg-3 col-xl-2" style="padding-top:35px;">
                                  {{--   <button class="btn btn-primary btn-get-flash-chart">Tìm kiếm</button> --}}
                                  <button class="btn btn-primary text-light" wire:click.prevent="$emit('searchBillDashboardScript1')">Tìm kiếm
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <input type="hidden" value="{{ date('m/d/Y') }}" id="day-now">
                </div>
                <div id="table_flash_report_holder">
                    {{-- @dd($totalTransaction) --}}
                    <table class="table table-border">
                            <thead class="kt-datatable__head">
                                <tr class="kt-datatable__row" style="text-align:center">
                                    <th>Partner code</th>
                                    <th>Tổng số giao dịch</th>
                                    <th>Tống số tiền</th>
                                    <!-- <th>Tổng số thẻ ngày hôm qua</th>
                                    <th>Tống số tiền ngày hôm qua</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @dump($totalTransaction) --}}
                                @if(isset($totalTransaction1))
                                @foreach($totalTransaction1 as $total)
                                <tr>
                                    <td class="kt-datatable__cell; text-center">
                                        <div class="kt-user-card-v2__details">
                                            @if(isset($total->partner_code))
                                            {{$total->partner_code}}
                                            @else {{'No value'}}
                                            @endif

                                        </div>
                                    </td>
                                    <td class="kt-datatable__cell; text-center">
                                <div class="kt-user-card-v2__details">
                                    @if(isset($total->totalTransaction))
                                    {{$total->totalTransaction}}
                                    @else{{'No value'}}
                                    @endif


                                </div></td>
                                    <td class="kt-datatable__cell; text-center">
                                <div class="kt-user-card-v2__details">
                                    @if(isset($total->ttamount))
                                    {{currency_format($total->ttamount)}}
                                    @else{{'No value'}}
                                    @endif


                                </div></td>
                                </tr>
                                @endforeach
                                @endif

                            </tbody>
                        </table>
                </div>
                <!--end::Section-->
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <!--begin:: Widgets/Tasks -->
        <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Thống kê giao dịch theo ngày
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__head param-search-dash">

                <div class="kt-portlet__body">
                    <!--begin::Section-->
                    <div class="kt-section">
                        <div class="kt-section__content kt-wizard-v4__form">
                        <form name="form-filter-dashbard">
                            <div class="row">
                                <div class="col col-lg-2 col-xl-2">
                                    <label>Partner code</label>
                                    <input type="text" class="form-control" id="Partner_Code_chart" list="Partner_Code_chartList">
                                    <datalist id="Partner_Code_chartList">
                                        @if(isset($partnerCodeBillservice))
                                        @foreach($partnerCodeBillservice as $partnerCodeList)
                                        <option value="{{$partnerCodeList->partner_code}}"></option>
                                        @endforeach
                                        @endif
                                    </datalist>
                                </div>

                                <div class="col col-lg-3 col-xl-2">
                                    <label for="exampleInputPassword1">Từ ngày (tháng/ngày/năm)</label>
                                    <input type="input" name="time-from" value="{{ date('m/1/Y') }}" id="time-from" class="form-control" >
                                </div>
                                <div class="col col-lg-3 col-xl-2">
                                    <label for="exampleInputPassword1">Đến ngày (tháng/ngày/năm)</label>
                                    <input type="input" name="time-to" value="{{ date('m/d/Y') }}" id="time-to" class="form-control" placeholder="time">
                                </div>
                                <div class="col col-lg-3 col-xl-2" style="padding-top:25px">
                                    <button wire:click.prevent="$emit('getBillChartScript')" class="btn btn-primary btn-get-chart">Tìm kiếm</button>
                                </div>
                            </div>
                        </form>

                        </div>
                        @if(isset($totalTransaction))
                        @foreach($totalTransaction as $total2)
                        <div class="row" style="padding-top:1%;">
                            <div class="col col-lg-3 col-xl-2">
                                <label for="exampleInputPassword1"><b>Tổng giao dịch:</b></label>
                                <b><label  id="count_transaction">
                                    @if(isset($total2->totalTransaction))
                                    {{$total2->totalTransaction}}
                                    @else{{'No value'}}
                                    @endif

                            </label></b>

                            </div>
                            <div class="col col-lg-3 col-xl-2">
                                <label for="exampleInputPassword1"><b>Tổng số tiền:</b></label>
                                <b><label  id="sum_transaction">
                                @if(isset($total2->ttamount))
                                {{currency_format($total2->ttamount)}}
                                @else{{'No value'}}
                                @endif


                            </label></b>

                            </div>
                        </div>

                        @endforeach
                        @endif

                    </div>
                    <!--end::Section-->
                </div>
            </div>
            <div>


            </div>
            <div class="kt-portlet__body holder-chart-used-card" id="chart">
                <canvas height="215" id="BillChart" class="sales-overview-sales-report chartjs-render-monitor dash-board-used-card"  style="width: 100%;"></canvas>
            </div>
        </div>
    </div>
</div>
</div>
@if(isset($dayArray))
@foreach($dayArray as $x)
    {{$x}}
@endforeach
@endif
@push('scripts')
<script src="{{asset('js/billServiceDashboard.js')}}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js@3.4.1/dist/chart.min.js"></script>
<script type="text/javascript">


    function getChart(x, y){

        var ctx = document.getElementById('BillChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                // labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                labels: x,
                datasets: [{
                    label: '# of Bill Transaction',
                    data: y,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        }

    document.addEventListener('DOMContentLoaded', function () {
        let listday = [];
        let ttAmount = [];

        @this.on('getBillChartScript', () => {

            var partner_code = document.getElementById("Partner_Code_chart").value;
            var startTime = document.getElementById("time-from").value;
            var endTime = document.getElementById("time-to").value;
            // alert(parner_code);
            Livewire.emit('getBillChart',
                partner_code,
                startTime,
                endTime
                );


            Livewire.hook('message.processed', (el, component) => {

                var listday2 = @this.dayArray;
                var ttAmount2 = @this.sumArray;
                getChart(listday2, ttAmount2);
            })




        })

        listday = @this.dayArrayX;
        ttAmount = @this.sumAmountY;
        getChart(listday, ttAmount);

    })
</script>

@endpush
