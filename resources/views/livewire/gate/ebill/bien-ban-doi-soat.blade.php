
{{-- @dd($datalist) --}}
<div>
    <div class="block-content details-cross-check">
        <div class="block-header">
            <div class="row">

                <div class="col-md-12" id="detail-header">
                    <span>Cộng hòa xã hội chủ nghĩa Việt Nam </span><br>
                    <span>Độc lập - Tự Do - Hạnh Phúc</span><br>
                    <span>***</span><br>
                    <span>BIÊN BẢN XÁC NHẬN DOANH THU DỊCH VỤ THU HỘ</span><br>
                    (<span>Từ ngày </span> {{date('d-m-Y', (isset($datalist->start_time))?$datalist->start_time:'0')}} <span>đến hết ngày</span> {{date('d-m-Y', (isset($datalist->end_time))?$datalist->end_time:'0')}} )<br>

                </div>
            </div>
            <br>
            <div class="row" style="font-weight: 400;">
                <div class="col-md-2" style="max-width:105px">
                    <span>Bên A: </span>
                </div>
                <div class="col-md-10">
                    <span style="text-align: left;">CÔNG TY CỔ PHẦN APPOTAPAY</span>
                </div>
            </div>
            <div class="row" style="font-weight: 400;">
                <div class="col-md-2" style="max-width:105px">
                    <span>Bên B: </span>
                </div>
                <div class="col-md-10">
                    <span style="text-align: left; text-transform: uppercase;"> {{(isset($datalist->partnerName))?$datalist->partnerName:''}} </span>
                </div>
            </div>
            <div class="row" style="font-weight: 400;">
                <div class="col-md-12">
                    <span>- Căn cứ theo hợp đồng hợp tác kinh doanh số: </span>
                </div>
            </div>
            <div class="row" style="font-weight: 400;">
                <div class="col-md-12">
                    <span>- Hôm nay, ngày  {{date('d-m-Y', (isset($datalist->date_perform_reconciliation))?$datalist->date_perform_reconciliation:'0')}} , hai bên cùng ký kết biên bản xác nhận số liệu sản lượng và doanh thu như sau: </span>
                </div>
            </div>
            <div class="row" style="font-weight: 400;">
                <div class="col-md-2" style="max-width:105px">
                    <span>Tên merchant: </span>
                </div>
                <div class="col-md-10">
                    <span style="text-align: left; text-transform: uppercase;"> {{(isset($datalist->partner_code))?$datalist->partner_code:''}} </span>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    {{-- @dump($dataTableType2); --}}
                    <table class="table table-light" id="table-bienbandoisoat">
                        <thead>
                            <tr>
                                <th style="padding: 10px !important; border: 1px solid #ddd !important; ">Số lượng giao dịch</th>
                                <th style="padding: 10px !important; border: 1px solid #ddd !important; ">Tổng tiền</th>
                                <th style="padding: 10px !important; border: 1px solid #ddd !important; ">Đơn giá</th>
                                <th style="padding: 10px !important; border: 1px solid #ddd !important; ">Tổng phí</th>
                                <th style="padding: 10px !important; border: 1px solid #ddd !important; ">Số tiền cộng vào balance</th>

                                <th style="padding: 10px !important; border: 1px solid #ddd !important; ">Số tiền chuyển khoản trực tiếp bên B</th>

                            </tr>
                        </thead>
                        @if(isset($datalist))
                        <tbody>
                            <tr>
                                <td
                                style="padding: 10px !important; border: 1px solid #ddd !important;
                                text-align: center;
                                ">
                                    {{(isset($soluonggiaodich))?number_format($soluonggiaodich, '0', '', '.'):'0'}}
                                </td>
                                <td
                                style="padding: 10px !important; border: 1px solid #ddd !important;
                                text-align: center;
                                ">{{(isset($tongtien))?number_format($tongtien, '0','', '.'):'0'}} đ</td>
                                <td
                                style="padding: 10px !important; border: 1px solid #ddd !important;
                                text-align: center;
                                ">{{(isset($dongiaphiGD))?number_format($dongiaphiGD, '0', '', '.'):'0'}} đ</td>
                                <td
                                style="padding: 10px !important; border: 1px solid #ddd !important;
                                text-align: center;
                                ">{{(isset($tongphi))?number_format($tongphi, '0', '', '.'):'0'}} đ</td>
                                <td
                                style="padding: 10px !important; border: 1px solid #ddd !important;
                                text-align: center;
                                ">{{(isset($sotiencongvaobalance))?number_format($sotiencongvaobalance, '0', '', '.'):'0'}} đ</td>
                                <td
                                style="padding: 10px !important; border: 1px solid #ddd !important;
                                text-align: center;
                                ">{{(isset($sotienchuyenkhoantructiepbenB))?number_format($sotienchuyenkhoantructiepbenB, '0', '', '.'):'0'}} đ</td>
                            </tr>

                        </tbody>
                        @endif
                    </table>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-10">
                    {{-- @dd($tongphi) --}}
                    <span>Tiền phí bên A được hưởng : </span>
                    <span style="color: red">{{(isset($tongphi))?number_format($tongphi, '0', '', '.'):''}} đ</span>
                </div>
                <div class="col-md-2" style="text-align:right">
                    <a href="#" wire:click.prevent="$emit('ExportBienBanDoiSoatVAScript', '{{request()->id}}')" class="btn btn-primary" style="color: #FFFFFF;">Export</a>
                    {{-- <button
                    wire:click.prevent="$emit('ExportTransactionScript', '{{(isset($idString))?$idString:'0000000'}}')"
                    style="background: #28a745" class="btn btn-primary">Export</button> --}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    {{-- <span>Bằng chữ  :</span> <span style="color:red"></span> --}}
                </div>

                <div class="col-md-6">

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <span>Số tiền bên A còn phải thanh toán cho bên B : </span>
                    <span style="color: red">{{(isset($sotienchuyenkhoantructiepbenB))?number_format($sotienchuyenkhoantructiepbenB,'0', '', '.'):''}} đ</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    {{-- <span>Bằng chữ  : </span> --}}
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-10">
                    <span>Biên bản này được thành lập thành 04 bản có giá trị pháp luật như nhau, mỗi bên giữ 02 bản.</span>
                </div>
                <div class="col-md-2">

                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-6 text-center">
                    <span style="font-weight: bold;">CÔNG TY CỔ PHẦN APPOTAPAY</span>
                </div>
                <div class="col-md-6 text-center">
                    <span style="font-weight: bold;">PARTNER</span>
                </div>
            </div>
            <br>
            <br>


        </div>

<div class="block-main" x-data="{open: false}">
    <div class="table-responsive">
      <div id="listTrans_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer"><div class="top">
      </div>
      <div class="row">
          <div class="col-md-12">
            <svg class="bi" width="1em" height="1em" fill="currentColor">
                <use xlink:href="bootstrap-icons.svg#blockquote-right"></use>
            </svg>
          </div>
      </div>




<div class="row entries-bottom">
</div>
</div>
</div>
</div>
</div>
</div>

@push('scriptsChart')

    <script>
        Livewire.on('ExportBienBanDoiSoatVAScript', id=>{
            Livewire.emit('ExportBienBanDoiSoatVA', id);
        });
    </script>

@endpush
