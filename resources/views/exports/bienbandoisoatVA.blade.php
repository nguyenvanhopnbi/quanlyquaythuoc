{{-- @dd($datalist) --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export biên bản đối soát</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th colspan="16" style="text-align: center; font-weight: bold; font-size: 18px;">Cộng hòa xã hội chủ nghĩa Việt Nam</th>
            </tr>
            <tr>
                <th colspan="16" style="text-align: center; font-size: 14px;">Độc lập - Tự Do - Hạnh Phúc</th>
            </tr>
            <tr>
                <th colspan="16" style="text-align: center; font-weight: bold; font-size: 14px;">***</th>
            </tr>
            <tr>
                <th colspan="16" style="text-align: center; font-weight: bold; font-size: 14px;">
                    BIÊN BẢN XÁC NHẬN SẢN LƯỢNG THANH TOÁN TRỰC TUYẾN
                </th>
            </tr>

            <tr>
                <th colspan="16" style="text-align: center; font-size: 10px;">(Từ ngày {{date('d-m-Y', $datalist->start_time)}} đến hết ngày {{date('d-m-Y', $datalist->end_time)}} )</th>
            </tr>

            <tr>
                <th colspan="2" style="text-align: left; font-size: 10px;">
                Bên A: </th>
                <th colspan="14" style="text-align: left; font-size: 10px;">
                CÔNG TY CỔ PHẦN APPOTAPAY </th>
            </tr>
            <tr>
                <th colspan="2" style="text-align: left; font-size: 10px;">
                Bên B: </th>
                <th colspan="14" style="text-align: left; font-size: 10px;">
                    {{$datalist->partnerName}} </th>
            </tr>
                <tr>
                    <th colspan="16" style="text-align: left; font-size: 10px;">
                    - Căn cứ theo hợp đồng hợp tác kinh doanh số: </th>
                               {{--  <th colspan="7" style="text-align: left; font-size: 10px;">
                               </th> --}}
                </tr>
                <tr>
                            <th colspan="16" style="text-align: left; font-size: 10px;">
                            - Hôm nay, ngày {{date('d-m-Y', $datalist->date_perform_reconciliation)}} , hai bên cùng ký kết biên bản xác nhận số liệu sản lượng và doanh thu như sau: </th>

                </tr>
      {{--           <tr>
                    <th colspan="16"></th>
                </tr> --}}
                <tr>

                <th colspan="2" style="text-align: left; font-size: 10px;">
                Tên merchant: </th>
                <th colspan="14" style="text-align: left; font-size: 10px;">
                    {{$datalist->partner_code}} </th>
                </tr>
                        <tr>
                            <th colspan="2" style="padding: 10px !important;">
                                Số lượng giao dịch
                            </th>
                            <th style="padding: 10px !important;">
                                {{-- {{__('doublecheck.tongsogiaodichthanhcong')}} --}}
                                Tổng tiền
                            </th>
                            <th colspan="2" style="padding: 10px !important; ">
                                Đơn giá phí / GD
                            </th>
                            <th style="padding: 10px !important; ">
                                Tổng phí
                            </th>
                            <th colspan="2" style="padding: 10px !important;">
                                Số tiền cộng vào balance
                            </th>

                            <th colspan="6" style="padding: 10px !important; ">
                                Số tiền chuyển khoản trực tiếp bên B
                            </th>

                        </tr>
                    </thead>
                    <tbody>


                        <tr>
                            <td colspan="2" style="padding: 10px !important;">
                            {{(isset($soluonggiaodich))?$soluonggiaodich:''}}</td>
                            <td style="padding: 10px !important;">{{(isset($tongtien))?$tongtien:''}} đ</td>
                            <td colspan="2" style="padding: 10px !important;">{{(isset($dongiaphiGD))?$dongiaphiGD . ' đ':'0 đ'}} </td>
                            <td style="padding: 10px !important;">{{(isset($tongphi))?$tongphi:''}} đ</td>
                            <td colspan="2" style="padding: 10px !important;">{{(isset($sotiencongvaobalance))?$sotiencongvaobalance:''}} đ</td>
                            <td colspan="6" style="padding: 10px !important;">{{(isset($sotienchuyenkhoantructiepbenB))?$sotienchuyenkhoantructiepbenB:''}} đ</td>

                        </tr>


                        <tr>
                            <td colspan="16"></td>
                        </tr>
                        <tr>
                            <td colspan="16"></td>
                        </tr>

                        <tr>
                            <td colspan="16">
                                <span>Tiền phí bên A được hưởng:</span> <span style="color: red; font-weight: bold;">{{(isset($tongphi))?$tongphi:''}} đ</span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="16">
                                <span>Số tiền bên A còn phải thanh toán cho Bên B là :</span> <span style="color: red; font-weight: bold;">{{(isset($sotienchuyenkhoantructiepbenB))?$sotienchuyenkhoantructiepbenB:''}} đ</span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="16">
                                <span>Biên bản này được thành lập thành 04 bản có giá trị pháp luật như nhau, mỗi bên giữ 02 bản.</span>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="16"></td>
                        </tr>
                        <tr>
                            <td colspan="16"></td>
                        </tr>

                        <tr>
                            <td colspan="8" style="font-size: 16; font-weight: bold;">
                                <span >CÔNG TY CỔ PHẦN APPOTAPAY</span>
                            </td>
                            <td colspan="8" style="font-size: 16; font-weight: bold;">
                                <span>PARTNER</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </body>
            </html>
