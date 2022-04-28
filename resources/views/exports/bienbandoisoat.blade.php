<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bien ban doi soat</title>
</head>
<body>
                    <table>
                        <thead>
                            <tr>
                                <th colspan="13" style="text-align: center; font-weight: bold; font-size: 18px;">Cộng hòa xã hội chủ nghĩa Việt Nam</th>

                            </tr>
                            <tr>
                                <th colspan="13" style="text-align: center; font-weight: bold; font-size: 14px;">Độc lập - Tự Do - Hạnh Phúc</th>

                            </tr>
                            <tr>
                                <th colspan="13" style="text-align: center; font-weight: bold; font-size: 14px;">***</th>

                            </tr>
                            <tr>
                                <th colspan="13" style="text-align: center; font-weight: bold; font-size: 10px;">BIÊN BẢN XÁC NHẬN SẢN LƯỢNG THANH TOÁN TRỰC TUYẾN</th>

                            </tr>
                            <tr>
                                <th colspan="13" style="text-align: center; font-weight: bold; font-size: 10px;">
                                (Từ ngày {{date('d-m-Y', $startDate)}} đến hết ngày {{date('d-m-Y', $endDate)}} )
                            </th>

                            </tr>

                            <tr>
                                <th colspan="1" style="text-align: left; font-weight: normal; font-size: 10px;">BÊN A: </th>
                                <th colspan="12" style="text-align: left; font-weight: normal; font-size: 10px;">CÔNG TY CỔ PHÂN APPOTA PAY</th>
                            </tr>

                            <tr>
                                <th colspan="1" style="text-align: left; font-weight: normal; font-size: 10px;">BÊN B: </th>
                                <th colspan="12" style="text-align: left; font-weight: normal; font-size: 10px;">{{(isset($partnerName) and !empty($partnerName))?$partnerName:$partnerCode}}</th>
                            </tr>
                            <tr>
                                <th colspan="13" style="text-align: left; font-weight: normal; font-size: 10px;">- Căn cứ theo hợp đồng hợp tác kinh doanh số: {{(isset($sohopdong))?$sohopdong:''}} </th>

                            </tr>
                            <tr>
                                <th colspan="13" style="text-align: left; font-weight: normal; font-size: 10px;">- Hôm nay, ngày {{date('d-m-Y', $NgayDoisoat)}} , hai bên cùng ký kết biên bản xác nhận số liệu sản lượng và doanh thu như sau: </th>

                            </tr>



                            <tr>
                                <th></th>
                            </tr>


                            <tr>
                                <th>Loại giao dịch</th>
                                <th>Tổng số giao dịch thành công</th>
                                <th>Tổng số giao dịch hoàn tiền</th>
                                <th>Tổng số giao dịch hold</th>
                                <th>Tổng số giao dịch unhold</th>
                                <th>Tổng giá trị giao dịch thành công</th>
                                <th>Tổng giá trị giao dịch hoàn tiền</th>
                                <th>Tổng giá trị giao dịch hold</th>
                                <th>Tổng giá trị giao dịch unhold</th>
                                <th>Phí XLGD</th>
                                <th>Phí chiết khấu</th>
                                <th>Phí bên A hưởng (gồm VAT)</th>
                                <th>Số tiền bên A thanh toán cho bên B</th>
                            </tr>
                        </thead>
                        {{-- start data table type 2 --}}
                        @if(isset($dataTableType2))
                        <tbody>
                            @if(isset($dataTableType2->ATM->revenue->fromPaymentMethod))
                            <tr>
                                <td>Thẻ nội địa </td>
                                <td>{{number_format((isset($dataTableType2->ATM->revenue->fromPaymentMethod->countTrans))?$dataTableType2->ATM->revenue->fromPaymentMethod->countTrans:'0', '0', '', '.')}}</td>
                                <td>
                                    {{number_format((isset($dataTableType2->ATM->refund->fromPaymentMethod->countTrans))?$dataTableType2->ATM->refund->fromPaymentMethod->countTrans:'0', '0', '', '.')}}</td>
                                <td>{{number_format((isset($dataTableType2->ATM->hold->fromPaymentMethod->countTrans))?$dataTableType2->ATM->hold->fromPaymentMethod->countTrans:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->ATM->un_hold->fromPaymentMethod->countTrans))?$dataTableType2->ATM->un_hold->fromPaymentMethod->countTrans:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->ATM->revenue->fromPaymentMethod->totalAmount))?$dataTableType2->ATM->revenue->fromPaymentMethod->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->ATM->refund->fromPaymentMethod->totalAmount))?$dataTableType2->ATM->refund->fromPaymentMethod->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->ATM->hold->fromPaymentMethod->totalAmount))?$dataTableType2->ATM->hold->fromPaymentMethod->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->ATM->un_hold->fromPaymentMethod->totalAmount))?$dataTableType2->ATM->un_hold->fromPaymentMethod->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->ATM->revenue->fromPaymentMethod->fee->transFee))?$dataTableType2->ATM->revenue->fromPaymentMethod->fee->transFee:'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->ATM->revenue->fromPaymentMethod->fee->transPercentFee))?$dataTableType2->ATM->revenue->fromPaymentMethod->fee->transPercentFee:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->ATM->cost->cost_total->value->costTotal))?$dataTableType2->ATM->cost->cost_total->value->costTotal:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->ATM->cost->cost_total->value->sumReceive))?$dataTableType2->ATM->cost->cost_total->value->sumReceive:'0', '0', '', '.')}}</td>

                            </tr>
                            @endif
                            @if(isset($dataTableType2->CC->revenue->fromPaymentMethod))
                            <tr>
                                <td>CC</td>
                                <td>{{number_format((isset($dataTableType2->CC->revenue->fromPaymentMethod->countTrans))?$dataTableType2->CC->revenue->fromPaymentMethod->countTrans:'0', '0', '', '.')}}</td>
                                <td>{{number_format((isset($dataTableType2->CC->refund->fromPaymentMethod->countTrans))?$dataTableType2->CC->refund->fromPaymentMethod->countTrans:'0', '0', '', '.')}}</td>
                                <td>{{number_format((isset($dataTableType2->CC->hold->fromPaymentMethod->countTrans))?$dataTableType2->CC->hold->fromPaymentMethod->countTrans:'0', '0', '', '.')}}</td>
                                <td>{{number_format((isset($dataTableType2->CC->un_hold->fromPaymentMethod->countTrans))?$dataTableType2->CC->un_hold->fromPaymentMethod->countTrans:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->CC->revenue->fromPaymentMethod->totalAmount))?$dataTableType2->CC->revenue->fromPaymentMethod->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->CC->refund->fromPaymentMethod->totalAmount))?$dataTableType2->CC->refund->fromPaymentMethod->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->CC->hold->fromPaymentMethod->totalAmount))?$dataTableType2->CC->hold->fromPaymentMethod->totalAmount:'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->CC->un_hold->fromPaymentMethod->totalAmount))?$dataTableType2->CC->un_hold->fromPaymentMethod->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->CC->revenue->fromPaymentMethod->fee->transFee))?$dataTableType2->CC->revenue->fromPaymentMethod->fee->transFee:'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->CC->revenue->fromPaymentMethod->fee->transPercentFee))?$dataTableType2->CC->revenue->fromPaymentMethod->fee->transPercentFee:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->CC->cost->cost_total->value->costTotal))?$dataTableType2->CC->cost->cost_total->value->costTotal:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->CC->cost->cost_total->value->sumReceive))?$dataTableType2->CC->cost->cost_total->value->sumReceive:'0', '0', '', '.')}}</td>
                            </tr>
                            @endif

                            {{-- begin cc from bank code VISA--}}

                            @if(isset($dataTableType2->CC->revenue->fromBankCode->VISA))
                            <tr>
                                <td>CC/VISA</td>
                                <td>{{number_format((isset($dataTableType2->CC->revenue->fromBankCode->VISA->countTrans))?$dataTableType2->CC->revenue->fromBankCode->VISA->countTrans:'0', '0', '', '.')}}</td>
                                <td>{{number_format((isset($dataTableType2->CC->refund->fromBankCode->VISA->countTrans))?$dataTableType2->CC->refund->fromBankCode->VISA->countTrans:'0', '0', '', '.')}}</td>
                                <td>{{number_format((isset($dataTableType2->CC->hold->fromBankCode->VISA->countTrans))?$dataTableType2->CC->hold->fromBankCode->VISA->countTrans:'0', '0', '', '.')}}</td>
                                <td>{{number_format((isset($dataTableType2->CC->un_hold->fromBankCode->VISA->countTrans))?$dataTableType2->CC->un_hold->fromBankCode->VISA->countTrans:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->CC->revenue->fromBankCode->VISA->totalAmount))?$dataTableType2->CC->revenue->fromBankCode->VISA->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->CC->refund->fromBankCode->VISA->totalAmount))?$dataTableType2->CC->refund->fromBankCode->VISA->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->CC->hold->fromBankCode->VISA->totalAmount))?$dataTableType2->CC->hold->fromBankCode->VISA->totalAmount:'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->CC->un_hold->fromBankCode->VISA->totalAmount))?$dataTableType2->CC->un_hold->fromBankCode->VISA->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->CC->revenue->fromBankCode->VISA->fee->transFee))?$dataTableType2->CC->revenue->fromBankCode->VISA->fee->transFee:'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->CC->revenue->fromBankCode->VISA->fee->transPercentFee))?$dataTableType2->CC->revenue->fromBankCode->VISA->fee->transPercentFee:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->CC->cost->fromBankCode->VISA->costTotal))?$dataTableType2->CC->cost->fromBankCode->VISA->costTotal:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->CC->cost->fromBankCode->VISA->sumReceive))?$dataTableType2->CC->cost->fromBankCode->VISA->sumReceive:'0', '0', '', '.')}}</td>
                            </tr>
                            @endif

                            {{-- end cc from bank code --}}

                            {{-- begin cc from bankcode MASTERCARD --}}

                            @if(isset($dataTableType2->CC->revenue->fromBankCode->MASTERCARD))
                            <tr>
                                <td>CC/MASTERCARD</td>
                                <td>{{number_format((isset($dataTableType2->CC->revenue->fromBankCode->MASTERCARD->countTrans))?$dataTableType2->CC->revenue->fromBankCode->MASTERCARD->countTrans:'0', '0', '', '.')}}</td>
                                <td>{{number_format((isset($dataTableType2->CC->refund->fromBankCode->MASTERCARD->countTrans))?$dataTableType2->CC->refund->fromBankCode->MASTERCARD->countTrans:'0', '0', '', '.')}}</td>
                                <td>{{number_format((isset($dataTableType2->CC->hold->fromBankCode->MASTERCARD->countTrans))?$dataTableType2->CC->hold->fromBankCode->MASTERCARD->countTrans:'0', '0', '', '.')}}</td>
                                <td>{{number_format((isset($dataTableType2->CC->un_hold->fromBankCode->MASTERCARD->countTrans))?$dataTableType2->CC->un_hold->fromBankCode->MASTERCARD->countTrans:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->CC->revenue->fromBankCode->MASTERCARD->totalAmount))?$dataTableType2->CC->revenue->fromBankCode->MASTERCARD->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->CC->refund->fromBankCode->MASTERCARD->totalAmount))?$dataTableType2->CC->refund->fromBankCode->MASTERCARD->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->CC->hold->fromBankCode->MASTERCARD->totalAmount))?$dataTableType2->CC->hold->fromBankCode->MASTERCARD->totalAmount:'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->CC->un_hold->fromBankCode->MASTERCARD->totalAmount))?$dataTableType2->CC->un_hold->fromBankCode->MASTERCARD->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->CC->revenue->fromBankCode->MASTERCARD->fee->transFee))?$dataTableType2->CC->revenue->fromBankCode->MASTERCARD->fee->transFee:'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->CC->revenue->fromBankCode->MASTERCARD->fee->transPercentFee))?$dataTableType2->CC->revenue->fromBankCode->MASTERCARD->fee->transPercentFee:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->CC->cost->fromBankCode->MASTERCARD->costTotal))?$dataTableType2->CC->cost->fromBankCode->MASTERCARD->costTotal:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->CC->cost->fromBankCode->MASTERCARD->sumReceive))?$dataTableType2->CC->cost->fromBankCode->MASTERCARD->sumReceive:'0', '0', '', '.')}}</td>
                            </tr>
                            @endif

                            {{-- end cc from bankcode MASTERCARD --}}

                            {{-- begin EWALLET from Payment method --}}
                             @if(isset($dataTableType2->EWALLET->revenue->fromPaymentMethod))
                            <tr>
                                <td>EWALLET</td>
                                <td>{{number_format((isset($dataTableType2->EWALLET->revenue->fromPaymentMethod->countTrans))?$dataTableType2->EWALLET->revenue->fromPaymentMethod->countTrans:'0', '0', '', '.')}}</td>
                                <td>{{number_format((isset($dataTableType2->EWALLET->refund->fromPaymentMethod->countTrans))?$dataTableType2->EWALLET->refund->fromPaymentMethod->countTrans:'0', '0', '', '.')}}</td>
                                <td>{{number_format((isset($dataTableType2->EWALLET->hold->fromPaymentMethod->countTrans))?$dataTableType2->EWALLET->hold->fromPaymentMethod->countTrans:'0', '0', '', '.')}}</td>
                                <td>{{number_format((isset($dataTableType2->EWALLET->un_hold->fromPaymentMethod->countTrans))?$dataTableType2->EWALLET->un_hold->fromPaymentMethod->countTrans:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->revenue->fromPaymentMethod->totalAmount))?$dataTableType2->EWALLET->revenue->fromPaymentMethod->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->refund->fromPaymentMethod->totalAmount))?$dataTableType2->EWALLET->refund->fromPaymentMethod->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->hold->fromPaymentMethod->totalAmount))?$dataTableType2->EWALLET->hold->fromPaymentMethod->totalAmount:'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->EWALLET->un_hold->fromPaymentMethod->totalAmount))?$dataTableType2->EWALLET->un_hold->fromPaymentMethod->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->revenue->fromPaymentMethod->fee->transFee))?$dataTableType2->EWALLET->revenue->fromPaymentMethod->fee->transFee:'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->EWALLET->revenue->fromPaymentMethod->fee->transPercentFee))?$dataTableType2->EWALLET->revenue->fromPaymentMethod->fee->transPercentFee:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->cost->cost_total->value->costTotal))?$dataTableType2->EWALLET->cost->cost_total->value->costTotal:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->cost->cost_total->value->sumReceive))?$dataTableType2->EWALLET->cost->cost_total->value->sumReceive:'0', '0', '', '.')}}</td>
                            </tr>
                            @endif
                            {{-- end EWALLET from Payment method --}}


                            @if(isset($dataTableType2->EWALLET->revenue->fromBankCode->APPOTA))
                            <tr>
                                <td>EWALLET/APPOTA</td>
                                <td>{{number_format((isset($dataTableType2->EWALLET->revenue->fromBankCode->APPOTA->countTrans))?$dataTableType2->EWALLET->revenue->fromBankCode->APPOTA->countTrans:'0', '0', '', '.')}}</td>
                                <td>{{number_format((isset($dataTableType2->EWALLET->refund->fromBankCode->APPOTA->countTrans))?$dataTableType2->EWALLET->refund->fromBankCode->APPOTA->countTrans:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->hold->fromBankCode->APPOTA->countTrans))?$dataTableType2->EWALLET->hold->fromBankCode->APPOTA->countTrans:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->un_hold->fromBankCode->APPOTA->countTrans))?$dataTableType2->EWALLET->un_hold->fromBankCode->APPOTA->countTrans:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->revenue->fromBankCode->APPOTA->totalAmount))?$dataTableType2->EWALLET->revenue->fromBankCode->APPOTA->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->refund->fromBankCode->APPOTA->totalAmount))?$dataTableType2->EWALLET->refund->fromBankCode->APPOTA->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->hold->fromBankCode->APPOTA->totalAmount))?$dataTableType2->EWALLET->hold->fromBankCode->APPOTA->totalAmount:'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->EWALLET->un_hold->fromBankCode->APPOTA->totalAmount))?$dataTableType2->EWALLET->un_hold->fromBankCode->APPOTA->totalAmount:'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->EWALLET->revenue->fromBankCode->APPOTA->fee->transFee))?$dataTableType2->EWALLET->revenue->fromBankCode->APPOTA->fee->transFee:'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->EWALLET->revenue->fromBankCode->APPOTA->fee->transPercentFee))?$dataTableType2->EWALLET->revenue->fromBankCode->APPOTA->fee->transPercentFee:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->cost->fromBankCode->APPOTA->costTotal))?$dataTableType2->EWALLET->cost->fromBankCode->APPOTA->costTotal:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->cost->fromBankCode->APPOTA->sumReceive))?$dataTableType2->EWALLET->cost->fromBankCode->APPOTA->sumReceive:'0', '0', '', '.')}}</td>
                            </tr>
                            @endif
                            @if(isset($dataTableType2->EWALLET->revenue->fromBankCode->MOCA))
                            <tr>
                                <td>EWALLET/MOCA</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->revenue->fromBankCode->MOCA->countTrans))?$dataTableType2->EWALLET->revenue->fromBankCode->MOCA->countTrans:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->refund->fromBankCode->MOCA->countTrans))?$dataTableType2->EWALLET->refund->fromBankCode->MOCA->countTrans:'0', '0', '', '.')}}</td>
                                <td>{{number_format((isset($dataTableType2->EWALLET->hold->fromBankCode->MOCA->countTrans))?$dataTableType2->EWALLET->hold->fromBankCode->MOCA->countTrans:'0', '0', '', '.')}}</td>
                                <td>{{number_format((isset($dataTableType2->EWALLET->un_hold->fromBankCode->MOCA->countTrans))?$dataTableType2->EWALLET->un_hold->fromBankCode->MOCA->countTrans:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->revenue->fromBankCode->MOCA->totalAmount))?$dataTableType2->EWALLET->revenue->fromBankCode->MOCA->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->refund->fromBankCode->MOCA->totalAmount))?$dataTableType2->EWALLET->refund->fromBankCode->MOCA->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->hold->fromBankCode->MOCA->totalAmount))?$dataTableType2->EWALLET->hold->fromBankCode->MOCA->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->un_hold->fromBankCode->MOCA->totalAmount))?$dataTableType2->EWALLET->un_hold->fromBankCode->MOCA->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->revenue->fromBankCode->MOCA->fee->transFee))?$dataTableType2->EWALLET->revenue->fromBankCode->MOCA->fee->transFee:'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->EWALLET->revenue->fromBankCode->MOCA->fee->transPercentFee))?$dataTableType2->EWALLET->revenue->fromBankCode->MOCA->fee->transPercentFee:'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->EWALLET->cost->fromBankCode->MOCA->costTotal))?$dataTableType2->EWALLET->cost->fromBankCode->MOCA->costTotal:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->cost->fromBankCode->MOCA->sumReceive))?$dataTableType2->EWALLET->cost->fromBankCode->MOCA->sumReceive:'0', '0', '', '.')}}</td>
                            </tr>
                            @endif
                            @if(isset($dataTableType2->EWALLET->revenue->fromBankCode->VNPTWALLET))
                            <tr>
                                <td>EWALLET/VNPTWALLET</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->revenue->fromBankCode->VNPTWALLET->countTrans))?$dataTableType2->EWALLET->revenue->fromBankCode->VNPTWALLET->countTrans:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->refund->fromBankCode->VNPTWALLET->countTrans))?$dataTableType2->EWALLET->refund->fromBankCode->VNPTWALLET->countTrans:'0', '0', '', '.')}}</td>
                                <td>{{number_format((isset($dataTableType2->EWALLET->hold->fromBankCode->VNPTWALLET->countTrans))?$dataTableType2->EWALLET->hold->fromBankCode->VNPTWALLET->countTrans:'0', '0', '', '.')}}</td>
                                <td>{{number_format((isset($dataTableType2->EWALLET->un_hold->fromBankCode->VNPTWALLET->countTrans))?$dataTableType2->EWALLET->un_hold->fromBankCode->VNPTWALLET->countTrans:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->revenue->fromBankCode->VNPTWALLET->totalAmount))?$dataTableType2->EWALLET->revenue->fromBankCode->VNPTWALLET->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->refund->fromBankCode->VNPTWALLET->totalAmount))?$dataTableType2->EWALLET->refund->fromBankCode->VNPTWALLET->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->hold->fromBankCode->VNPTWALLET->totalAmount))?$dataTableType2->EWALLET->hold->fromBankCode->VNPTWALLET->totalAmount:'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->EWALLET->un_hold->fromBankCode->VNPTWALLET->totalAmount))?$dataTableType2->EWALLET->un_hold->fromBankCode->VNPTWALLET->totalAmount:'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->EWALLET->revenue->fromBankCode->VNPTWALLET->fee->transFee))?$dataTableType2->EWALLET->revenue->fromBankCode->VNPTWALLET->fee->transFee:'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->EWALLET->revenue->fromBankCode->VNPTWALLET->fee->transPercentFee))?$dataTableType2->EWALLET->revenue->fromBankCode->VNPTWALLET->fee->transPercentFee:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->cost->fromBankCode->VNPTWALLET->costTotal))?$dataTableType2->EWALLET->cost->fromBankCode->VNPTWALLET->costTotal:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->cost->fromBankCode->VNPTWALLET->sumReceive))?$dataTableType2->EWALLET->cost->fromBankCode->VNPTWALLET->sumReceive:'0', '0', '', '.')}}</td>
                            </tr>
                            @endif
                            @if(isset($dataTableType2->EWALLET->revenue->fromBankCode->MOMO))
                            <tr>
                                <td>EWALLET/MOMO</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->revenue->fromBankCode->MOMO->countTrans))?$dataTableType2->EWALLET->revenue->fromBankCode->MOMO->countTrans:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->refund->fromBankCode->MOMO->countTrans))?$dataTableType2->EWALLET->refund->fromBankCode->MOMO->countTrans:'0', '0', '', '.')}}</td>
                                <td>{{number_format((isset($dataTableType2->EWALLET->hold->fromBankCode->MOMO->countTrans))?$dataTableType2->EWALLET->hold->fromBankCode->MOMO->countTrans:'0', '0', '', '.')}}</td>
                                <td>{{number_format((isset($dataTableType2->EWALLET->un_hold->fromBankCode->MOMO->countTrans))?$dataTableType2->EWALLET->un_hold->fromBankCode->MOMO->countTrans:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->revenue->fromBankCode->MOMO->totalAmount))?$dataTableType2->EWALLET->revenue->fromBankCode->MOMO->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->refund->fromBankCode->MOMO->totalAmount))?$dataTableType2->EWALLET->refund->fromBankCode->MOMO->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->hold->fromBankCode->MOMO->totalAmount))?$dataTableType2->EWALLET->hold->fromBankCode->MOMO->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->un_hold->fromBankCode->MOMO->totalAmount))?$dataTableType2->EWALLET->un_hold->fromBankCode->MOMO->totalAmount:'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->EWALLET->revenue->fromBankCode->MOMO->fee->transFee))?$dataTableType2->EWALLET->revenue->fromBankCode->MOMO->fee->transFee:'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->EWALLET->revenue->fromBankCode->MOMO->fee->transPercentFee))?$dataTableType2->EWALLET->revenue->fromBankCode->MOMO->fee->transPercentFee:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->cost->fromBankCode->MOMO->costTotal))?$dataTableType2->EWALLET->cost->fromBankCode->MOMO->costTotal:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->cost->fromBankCode->MOMO->sumReceive))?$dataTableType2->EWALLET->cost->fromBankCode->MOMO->sumReceive:'0', '0', '', '.')}}</td>
                            </tr>
                            @endif

                            @if(isset($dataTableType2->EWALLET->revenue->fromBankCode->SHOPEEPAY))
                            <tr>
                                <td>EWALLET/SHOPEEPAY</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->revenue->fromBankCode->SHOPEEPAY->apply_fee_percent->countTrans))?
                                    ($dataTableType2->EWALLET->revenue->fromBankCode->SHOPEEPAY->apply_fee_percent->countTrans
                                        +
                                    $dataTableType2->EWALLET->revenue->fromBankCode->SHOPEEPAY->not_apply_fee_percent->countTrans):'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->refund->fromBankCode->SHOPEEPAY->apply_fee_percent->countTrans))?($dataTableType2->EWALLET->refund->fromBankCode->SHOPEEPAY->apply_fee_percent->countTrans
                                        +
                                    $dataTableType2->EWALLET->refund->fromBankCode->SHOPEEPAY->not_apply_fee_percent->countTrans):'0', '0', '', '.')}}</td>
                                <td>{{number_format((isset($dataTableType2->EWALLET->hold->fromBankCode->SHOPEEPAY->apply_fee_percent->countTrans))?($dataTableType2->EWALLET->hold->fromBankCode->SHOPEEPAY->apply_fee_percent->countTrans
                                        +
                                    $dataTableType2->EWALLET->hold->fromBankCode->SHOPEEPAY->not_apply_fee_percent->countTrans):'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->un_hold->fromBankCode->SHOPEEPAY->apply_fee_percent->countTrans))?($dataTableType2->EWALLET->un_hold->fromBankCode->SHOPEEPAY->apply_fee_percent->countTrans
                                        +
                                    $dataTableType2->EWALLET->un_hold->fromBankCode->SHOPEEPAY->not_apply_fee_percent->countTrans):'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->revenue->fromBankCode->SHOPEEPAY->apply_fee_percent->totalAmount))?
                                    ($dataTableType2->EWALLET->revenue->fromBankCode->SHOPEEPAY->apply_fee_percent->totalAmount
                                        +
                                    $dataTableType2->EWALLET->revenue->fromBankCode->SHOPEEPAY->not_apply_fee_percent->totalAmount):'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->EWALLET->refund->fromBankCode->SHOPEEPAY->apply_fee_percent->totalAmount))?
                                    ($dataTableType2->EWALLET->refund->fromBankCode->SHOPEEPAY->apply_fee_percent->totalAmount
                                        +
                                    $dataTableType2->EWALLET->refund->fromBankCode->SHOPEEPAY->not_apply_fee_percent->totalAmount):'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->EWALLET->hold->fromBankCode->SHOPEEPAY->apply_fee_percent->totalAmount))?
                                    ($dataTableType2->EWALLET->hold->fromBankCode->SHOPEEPAY->apply_fee_percent->totalAmount
                                        +
                                    $dataTableType2->EWALLET->hold->fromBankCode->SHOPEEPAY->not_apply_fee_percent->totalAmount):'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->EWALLET->un_hold->fromBankCode->SHOPEEPAY->apply_fee_percent->totalAmount))?
                                    ($dataTableType2->EWALLET->un_hold->fromBankCode->SHOPEEPAY->apply_fee_percent->totalAmount
                                        +
                                    $dataTableType2->EWALLET->un_hold->fromBankCode->SHOPEEPAY->not_apply_fee_percent->totalAmount):'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->EWALLET->revenue->fromBankCode->SHOPEEPAY->apply_fee_percent->fee->transFee))?
                                    ($dataTableType2->EWALLET->revenue->fromBankCode->SHOPEEPAY->apply_fee_percent->fee->transFee
                                        +
                                    $dataTableType2->EWALLET->revenue->fromBankCode->SHOPEEPAY->not_apply_fee_percent->fee->transFee):'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->EWALLET->revenue->fromBankCode->SHOPEEPAY->apply_fee_percent->fee->transPercentFee))?
                                    ($dataTableType2->EWALLET->revenue->fromBankCode->SHOPEEPAY->apply_fee_percent->fee->transPercentFee
                                        +
                                    $dataTableType2->EWALLET->revenue->fromBankCode->SHOPEEPAY->not_apply_fee_percent->fee->transPercentFee):'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->EWALLET->cost->fromBankCode->SHOPEEPAY->costTotal))?$dataTableType2->EWALLET->cost->fromBankCode->SHOPEEPAY->costTotal:'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->EWALLET->cost->fromBankCode->SHOPEEPAY->sumReceive))?$dataTableType2->EWALLET->cost->fromBankCode->SHOPEEPAY->sumReceive:'0', '0', '', '.')}}</td>
                            </tr>
                            @endif


                            {{-- begin VA from payment method --}}

                             @if(isset($dataTableType2->VA->revenue->fromPaymentMethod))
                            <tr>
                                <td>VA</td>
                                <td>{{number_format((isset($dataTableType2->VA->revenue->fromPaymentMethod->countTrans))?$dataTableType2->VA->revenue->fromPaymentMethod->countTrans:'0', '0', '', '.')}}</td>
                                <td>{{number_format((isset($dataTableType2->VA->refund->fromPaymentMethod->countTrans))?$dataTableType2->VA->refund->fromPaymentMethod->countTrans:'0', '0', '', '.')}}</td>
                                <td>{{number_format((isset($dataTableType2->VA->hold->fromPaymentMethod->countTrans))?$dataTableType2->VA->hold->fromPaymentMethod->countTrans:'0', '0', '', '.')}}</td>
                                <td>{{number_format((isset($dataTableType2->VA->un_hold->fromPaymentMethod->countTrans))?$dataTableType2->VA->un_hold->fromPaymentMethod->countTrans:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->VA->revenue->fromPaymentMethod->totalAmount))?$dataTableType2->VA->revenue->fromPaymentMethod->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->VA->refund->fromPaymentMethod->totalAmount))?$dataTableType2->VA->refund->fromPaymentMethod->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->VA->hold->fromPaymentMethod->totalAmount))?$dataTableType2->VA->hold->fromPaymentMethod->totalAmount:'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->VA->un_hold->fromPaymentMethod->totalAmount))?$dataTableType2->VA->un_hold->fromPaymentMethod->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->VA->revenue->fromPaymentMethod->fee->transFee))?$dataTableType2->VA->revenue->fromPaymentMethod->fee->transFee:'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->VA->revenue->fromPaymentMethod->fee->transPercentFee))?$dataTableType2->VA->revenue->fromPaymentMethod->fee->transPercentFee:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->VA->cost->cost_total->value->costTotal))?$dataTableType2->VA->cost->cost_total->value->costTotal:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->VA->cost->cost_total->value->sumReceive))?$dataTableType2->VA->cost->cost_total->value->sumReceive:'0', '0', '', '.')}}</td>
                            </tr>
                            @endif

                            {{-- end VA from payment method --}}

                            @if(isset($dataTableType2->VA->revenue->fromBankCode->WOORIBANK))
                            <tr>
                                <td>VA/WOORIBANK</td>

                                <td>{{number_format((isset($dataTableType2->VA->revenue->fromBankCode->WOORIBANK->countTrans))?$dataTableType2->VA->revenue->fromBankCode->WOORIBANK->countTrans:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->VA->refund->fromBankCode->WOORIBANK->countTrans))?$dataTableType2->VA->refund->fromBankCode->WOORIBANK->countTrans:'0', '0', '', '.')}}</td>
                                <td>{{number_format((isset($dataTableType2->VA->hold->fromBankCode->WOORIBANK->countTrans))?$dataTableType2->VA->hold->fromBankCode->WOORIBANK->countTrans:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->VA->un_hold->fromBankCode->WOORIBANK->countTrans))?$dataTableType2->VA->un_hold->fromBankCode->WOORIBANK->countTrans:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->VA->revenue->fromBankCode->WOORIBANK->totalAmount))?$dataTableType2->VA->revenue->fromBankCode->WOORIBANK->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->VA->refund->fromBankCode->WOORIBANK->totalAmount))?$dataTableType2->VA->refund->fromBankCode->WOORIBANK->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->VA->hold->fromBankCode->WOORIBANK->totalAmount))?$dataTableType2->VA->hold->fromBankCode->WOORIBANK->totalAmount:'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->VA->un_hold->fromBankCode->WOORIBANK->totalAmount))?$dataTableType2->VA->un_hold->fromBankCode->WOORIBANK->totalAmount:'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->VA->revenue->fromBankCode->WOORIBANK->fee->transFee))?$dataTableType2->VA->revenue->fromBankCode->WOORIBANK->fee->transFee:'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->VA->revenue->fromBankCode->WOORIBANK->fee->transPercentFee))?$dataTableType2->VA->revenue->fromBankCode->WOORIBANK->fee->transPercentFee:'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->VA->cost->fromBankCode->WOORIBANK->costTotal))?$dataTableType2->VA->cost->fromBankCode->WOORIBANK->costTotal:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->VA->cost->fromBankCode->WOORIBANK->sumReceive))?$dataTableType2->VA->cost->fromBankCode->WOORIBANK->sumReceive:'0', '0', '', '.')}}</td>
                            </tr>
                            @endif

                            @if(isset($dataTableType2->VA->revenue->fromBankCode->VIETCAPITALBANK))
                            <tr>
                                <td>VA/VIETCAPITALBANK</td>

                                <td>{{number_format((isset($dataTableType2->VA->revenue->fromBankCode->VIETCAPITALBANK->countTrans))?$dataTableType2->VA->revenue->fromBankCode->VIETCAPITALBANK->countTrans:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->VA->refund->fromBankCode->VIETCAPITALBANK->countTrans))?$dataTableType2->VA->refund->fromBankCode->VIETCAPITALBANK->countTrans:'0', '0', '', '.')}}</td>
                                <td>{{number_format((isset($dataTableType2->VA->hold->fromBankCode->VIETCAPITALBANK->countTrans))?$dataTableType2->VA->hold->fromBankCode->VIETCAPITALBANK->countTrans:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->VA->un_hold->fromBankCode->VIETCAPITALBANK->countTrans))?$dataTableType2->VA->un_hold->fromBankCode->VIETCAPITALBANK->countTrans:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->VA->revenue->fromBankCode->VIETCAPITALBANK->totalAmount))?$dataTableType2->VA->revenue->fromBankCode->VIETCAPITALBANK->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->VA->refund->fromBankCode->VIETCAPITALBANK->totalAmount))?$dataTableType2->VA->refund->fromBankCode->VIETCAPITALBANK->totalAmount:'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->VA->hold->fromBankCode->VIETCAPITALBANK->totalAmount))?$dataTableType2->VA->hold->fromBankCode->VIETCAPITALBANK->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->VA->un_hold->fromBankCode->VIETCAPITALBANK->totalAmount))?$dataTableType2->VA->un_hold->fromBankCode->VIETCAPITALBANK->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->VA->revenue->fromBankCode->VIETCAPITALBANK->fee->transFee))?$dataTableType2->VA->revenue->fromBankCode->VIETCAPITALBANK->fee->transFee:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->VA->revenue->fromBankCode->VIETCAPITALBANK->fee->transPercentFee))?$dataTableType2->VA->revenue->fromBankCode->VIETCAPITALBANK->fee->transPercentFee:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->VA->cost->fromBankCode->VIETCAPITALBANK->costTotal))?$dataTableType2->VA->cost->fromBankCode->VIETCAPITALBANK->costTotal:'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->VA->cost->fromBankCode->VIETCAPITALBANK->sumReceive))?$dataTableType2->VA->cost->fromBankCode->VIETCAPITALBANK->sumReceive:'0', '0', '', '.')}}</td>
                            </tr>
                            @endif

                            {{-- begin MM from bankcode --}}

                            @if(isset($dataTableType2->MM->revenue->fromBankCode->VINAPHONE))
                            <tr>
                                <td>MM/VINAPHONE</td>

                                <td>{{number_format((isset($dataTableType2->MM->revenue->fromBankCode->VINAPHONE->countTrans))?$dataTableType2->MM->revenue->fromBankCode->VINAPHONE->countTrans:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->MM->refund->fromBankCode->VINAPHONE->countTrans))?$dataTableType2->MM->refund->fromBankCode->VINAPHONE->countTrans:'0', '0', '', '.')}}</td>
                                <td>{{number_format((isset($dataTableType2->MM->hold->fromBankCode->VINAPHONE->countTrans))?$dataTableType2->MM->hold->fromBankCode->VINAPHONE->countTrans:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->MM->un_hold->fromBankCode->VINAPHONE->countTrans))?$dataTableType2->MM->un_hold->fromBankCode->VINAPHONE->countTrans:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->MM->revenue->fromBankCode->VINAPHONE->totalAmount))?$dataTableType2->MM->revenue->fromBankCode->VINAPHONE->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->MM->refund->fromBankCode->VINAPHONE->totalAmount))?$dataTableType2->MM->refund->fromBankCode->VINAPHONE->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->MM->hold->fromBankCode->VINAPHONE->totalAmount))?$dataTableType2->MM->hold->fromBankCode->VINAPHONE->totalAmount:'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->MM->un_hold->fromBankCode->VINAPHONE->totalAmount))?$dataTableType2->MM->un_hold->fromBankCode->VINAPHONE->totalAmount:'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->MM->revenue->fromBankCode->VINAPHONE->fee->transFee))?$dataTableType2->MM->revenue->fromBankCode->VINAPHONE->fee->transFee:'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->MM->revenue->fromBankCode->VINAPHONE->fee->transPercentFee))?$dataTableType2->MM->revenue->fromBankCode->VINAPHONE->fee->transPercentFee:'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->MM->cost->fromBankCode->VINAPHONE->costTotal))?$dataTableType2->MM->cost->fromBankCode->VINAPHONE->costTotal:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->MM->cost->fromBankCode->VINAPHONE->sumReceive))?$dataTableType2->MM->cost->fromBankCode->VINAPHONE->sumReceive:'0', '0', '', '.')}}</td>
                            </tr>
                            @endif
                            {{-- end MM from bankcode  --}}


                            @if(isset($dataTableType2->MM->revenue->fromPaymentMethod))
                            <tr>
                                <td>MOBILE MONEY</td>

                                <td>{{number_format((isset($dataTableType2->MM->revenue->fromPaymentMethod->countTrans))?$dataTableType2->MM->revenue->fromPaymentMethod->countTrans:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->MM->refund->fromPaymentMethod->countTrans))?$dataTableType2->MM->refund->fromPaymentMethod->countTrans:'0', '0', '', '.')}}</td>
                                <td>{{number_format((isset($dataTableType2->MM->hold->fromPaymentMethod->countTrans))?$dataTableType2->MM->hold->fromPaymentMethod->countTrans:'0', '0', '', '.')}}</td>
                                <td>{{number_format((isset($dataTableType2->MM->un_hold->fromPaymentMethod->countTrans))?$dataTableType2->MM->un_hold->fromPaymentMethod->countTrans:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->MM->revenue->fromPaymentMethod->totalAmount))?$dataTableType2->MM->revenue->fromPaymentMethod->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->MM->refund->fromPaymentMethod->totalAmount))?$dataTableType2->MM->refund->fromPaymentMethod->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->MM->hold->fromPaymentMethod->totalAmount))?$dataTableType2->MM->hold->fromPaymentMethod->totalAmount:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->MM->un_hold->fromPaymentMethod->totalAmount))?$dataTableType2->MM->un_hold->fromPaymentMethod->totalAmount:'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->MM->revenue->fromPaymentMethod->fee->transFee))?$dataTableType2->MM->revenue->fromPaymentMethod->fee->transFee:'0', '0', '', '.')}}</td>

                               <td>{{number_format((isset($dataTableType2->MM->revenue->fromPaymentMethod->fee->transPercentFee))?$dataTableType2->MM->revenue->fromPaymentMethod->fee->transPercentFee:'0', '0', '', '.')}}</td>


                                <td>{{number_format((isset($dataTableType2->MM->cost->cost_total->value->costTotal))?$dataTableType2->MM->cost->cost_total->value->costTotal:'0', '0', '', '.')}}</td>

                                <td>{{number_format((isset($dataTableType2->MM->cost->cost_total->value->sumReceive))?$dataTableType2->MM->cost->cost_total->value->sumReceive:'0', '0', '', '.')}}</td>
                            </tr>
                            @endif

                            @if(isset($dataTableType2->ATM->revenue->fromPaymentMethod))
                            {{-- @dump($dataTableType2); --}}
                            <tr>
                                <td><span style="font-weight: bold;">Tổng</span></td>
                                <td>{{number_format((isset($dataTable->dataRevenue->raw->all->count_total))?$dataTable->dataRevenue->raw->all->count_total:'0', '0', '', '.')}}</td>
                                <td>{{number_format((isset($dataTable->dataRefund->raw->all->count_total))?$dataTable->dataRefund->raw->all->count_total:'0', '0', '', '.')}}</td>
                                <td>{{number_format((isset($dataTable->dataHold->raw->all->count_total))?$dataTable->dataHold->raw->all->count_total:'0', '0', '', '.')}}</td>
                                <td>{{number_format((isset($dataTable->dataUnHold->raw->all->count_total))?$dataTable->dataUnHold->raw->all->count_total:'0', '0', '', '.')}}</td>

                                {{-- tong gia tri giao dich thanh cong --}}
                                <td>{{number_format((isset($dataTableType2->TongGiaTriGiaoDichThanhCong))?$dataTableType2->TongGiaTriGiaoDichThanhCong:'0', '0', '', '.')}}</td>
                                {{-- End tong gia tri giao dich thanh cong --}}

                                {{-- tong gia tri giao dich hoan tien --}}
                                <td>{{number_format((isset($dataTableType2->TongGiaTriGiaoDichHoanTien))?$dataTableType2->TongGiaTriGiaoDichHoanTien:'0', '0', '', '.')}}</td>
                                {{-- End tong gia tri giao dich hoan tien --}}

                                {{-- tong gia tri giao dich hold --}}
                                <td>{{number_format((isset($dataTableType2->sum_hold))?$dataTableType2->sum_hold:'0', '0', '', '.')}}</td>
                                {{-- End tong gia tri giao dich hold --}}

                                {{-- tong gia tri giao dich Un hold --}}
                                <td>{{number_format((isset($dataTableType2->TongGiaTriGiaoDichUnHold))?$dataTableType2->TongGiaTriGiaoDichUnHold:'0', '0', '', '.')}}</td>
                                {{-- End tong gia tri giao dich Un hold --}}

                                {{-- tong phi xu ly giao dich --}}
                                <td>{{number_format((isset($dataTable->dataCost->costHandleTrans->totalCostHandleTrans))?$dataTable->dataCost->costHandleTrans->totalCostHandleTrans:'0', '0', '', '.')}}</td>
                                {{-- end tong phi xu ly giao dich --}}

                                {{-- tong phi chiet khau --}}

                                <td>{{number_format((isset($dataTable->dataCost->costDiscount->totalCostDiscount))?$dataTable->dataCost->costDiscount->totalCostDiscount:'0', '0', '', '.')}}</td>
                                {{-- end tong phi chiet khau --}}

                                {{-- tong phi ben A huong --}}

                                <td>{{number_format((isset($dataTableType2->TongPhiBenAhuong))?$dataTableType2->TongPhiBenAhuong:'0', '0', '', '.')}}</td>
                                {{-- end tong phi ben A huong --}}

                                {{-- tong so tien ben A thanh toan cho ben B --}}

                                <td>{{number_format((isset($dataTableType2->TongBenAThanhToanBenB))?$dataTableType2->TongBenAThanhToanBenB:'0', '0', '', '.')}}</td>
                                {{-- end tong so tien ben A thanh toan cho ben B --}}
                            </tr>
                            @endif

                        </tbody>

                        @endif
                        {{-- end data table type 2 --}}

                        @if(isset($dataTable))
                        <tbody>
                            <tr>
                                <td>Thẻ nội địa </td>
                                <td>{{number_format((isset($dataTable->dataRevenue->raw->dataRevenueAtm->count_total))?$dataTable->dataRevenue->raw->dataRevenueAtm->count_total:'0', '0', '', ',')}}</td>
                                <td>
                                    {{number_format((isset($dataTable->dataRefund->raw->dataRefundAtm->count_total))?$dataTable->dataRefund->raw->dataRefundAtm->count_total:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataHold->raw->dataHoldAtm->count_total))?$dataTable->dataHold->raw->dataHoldAtm->count_total:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataUnHold->raw->dataUnHoldAtm->count_total))?$dataTable->dataUnHold->raw->dataUnHoldAtm->count_total:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataRevenue->totalAmount->totalAmountRevenueAtm))?$dataTable->dataRevenue->totalAmount->totalAmountRevenueAtm:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataRefund->raw->dataRefundAtm->sum_amount))?$dataTable->dataRefund->raw->dataRefundAtm->sum_amount:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataHold->raw->dataHoldAtm->sum_amount))?$dataTable->dataHold->raw->dataHoldAtm->sum_amount:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataUnHold->raw->dataUnHoldAtm->sum_amount))?$dataTable->dataUnHold->raw->dataUnHoldAtm->sum_amount:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataCost->costHandleTrans->totalCostHandleTransAtm))?$dataTable->dataCost->costHandleTrans->totalCostHandleTransAtm:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataCost->costDiscount->totalCostDiscountAtm))?$dataTable->dataCost->costDiscount->totalCostDiscountAtm:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataCost->totalCost->totalCostAtm))?$dataTable->dataCost->totalCost->totalCostAtm:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataReceive->totalAmount->totalReceiveAtm))?$dataTable->dataReceive->totalAmount->totalReceiveAtm:'0', '0', '', ',')}}</td>
                            </tr>
                            <tr>
                                <td>Thẻ Visa/Master</td>
                                <td>{{number_format((isset($dataTable->dataRevenue->raw->dataRevenueCCVisaMCard->count_total))?$dataTable->dataRevenue->raw->dataRevenueCCVisaMCard->count_total:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataRefund->raw->dataRefundCCVisaMCard->count_total))?$dataTable->dataRefund->raw->dataRefundCCVisaMCard->count_total:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataHold->raw->dataHoldCCVisaMCard->count_total))?$dataTable->dataHold->raw->dataHoldCCVisaMCard->count_total:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataUnHold->raw->dataUnHoldCCVisaMCard->count_total))?$dataTable->dataUnHold->raw->dataUnHoldCCVisaMCard->count_total:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataRevenue->totalAmount->totalAmountRevenueCCVisaMCard))?$dataTable->dataRevenue->totalAmount->totalAmountRevenueCCVisaMCard:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataRefund->raw->dataRefundCCVisaMCard->sum_amount))?$dataTable->dataRefund->raw->dataRefundCCVisaMCard->sum_amount:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataHold->raw->dataHoldCCVisaMCard->sum_amount))?$dataTable->dataHold->raw->dataHoldCCVisaMCard->sum_amount:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataUnHold->raw->dataUnHoldCCVisaMCard->sum_amount))?$dataTable->dataUnHold->raw->dataUnHoldCCVisaMCard->sum_amount:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataCost->costHandleTrans->totalCostHandleTransCCVisaMCard))?$dataTable->dataCost->costHandleTrans->totalCostHandleTransCCVisaMCard:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataCost->costDiscount->totalCostDiscountCCVisaMCard))?$dataTable->dataCost->costDiscount->totalCostDiscountCCVisaMCard:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataCost->totalCost->totalCostCCVisaMCard))?$dataTable->dataCost->totalCost->totalCostCCVisaMCard:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataReceive->totalAmount->totalReceiveCCVisaMCard))?$dataTable->dataReceive->totalAmount->totalReceiveCCVisaMCard:'0', '0', '', ',')}}</td>
                            </tr>
                            <tr>
                                <td>Thẻ JCB/Amex</td>
                                <td>{{number_format((isset($dataTable->dataRevenue->raw->dataRevenueRevenueCCJcb->count_total))?$dataTable->dataRevenue->raw->dataRevenueRevenueCCJcb->count_total:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataRefund->raw->dataRefundRevenueCCJcb->count_total))?$dataTable->dataRefund->raw->dataRefundRevenueCCJcb->count_total:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataHold->raw->dataHoldCCJcb->count_total))?$dataTable->dataHold->raw->dataHoldCCJcb->count_total:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataUnHold->raw->dataUnHoldRevenueCCJcb->count_total))?$dataTable->dataUnHold->raw->dataUnHoldRevenueCCJcb->count_total:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataRevenue->totalAmount->totalAmountRevenueCCJcb))?$dataTable->dataRevenue->totalAmount->totalAmountRevenueCCJcb:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataRefund->raw->dataRefundRevenueCCJcb->sum_amount))?$dataTable->dataRefund->raw->dataRefundRevenueCCJcb->sum_amount:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataHold->raw->dataHoldCCJcb->sum_amount))?$dataTable->dataHold->raw->dataHoldCCJcb->sum_amount:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataUnHold->raw->dataUnHoldRevenueCCJcb->sum_amount))?$dataTable->dataUnHold->raw->dataUnHoldRevenueCCJcb->sum_amount:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataCost->costHandleTrans->totalCostHandleTransCCJcb))?$dataTable->dataCost->costHandleTrans->totalCostHandleTransCCJcb:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataCost->costDiscount->totalCostDiscountCCJcbMCard))?$dataTable->dataCost->costDiscount->totalCostDiscountCCJcbMCard:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataCost->totalCost->totalCostCCJcbMCard))?$dataTable->dataCost->totalCost->totalCostCCJcbMCard:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataReceive->totalAmount->totalReceiveCCJcbMCard))?$dataTable->dataReceive->totalAmount->totalReceiveCCJcbMCard:'0', '0', '', ',')}}</td>
                            </tr>
                            <tr>
                                <td>Ví Appota</td>
                                <td>{{number_format((isset($dataTable->dataRevenue->raw->dataRevenueEwalletAppota->count_total))?$dataTable->dataRevenue->raw->dataRevenueEwalletAppota->count_total:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataRefund->raw->dataRefundEwalletAppota->count_total))?$dataTable->dataRefund->raw->dataRefundEwalletAppota->count_total:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataHold->raw->dataHoldEwalletAppota->count_total))?$dataTable->dataHold->raw->dataHoldEwalletAppota->count_total:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataUnHold->raw->dataUnHoldEwalletAppota->count_total))?$dataTable->dataUnHold->raw->dataUnHoldEwalletAppota->count_total:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataRevenue->totalAmount->totalAmountRevenueEwalletAppota))?$dataTable->dataRevenue->totalAmount->totalAmountRevenueEwalletAppota:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataRefund->raw->dataRefundEwalletAppota->sum_amount))?$dataTable->dataRefund->raw->dataRefundEwalletAppota->sum_amount:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataHold->raw->dataHoldEwalletAppota->sum_amount))?$dataTable->dataHold->raw->dataHoldEwalletAppota->sum_amount:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataUnHold->raw->dataUnHoldEwalletAppota->sum_amount))?$dataTable->dataUnHold->raw->dataUnHoldEwalletAppota->sum_amount:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataCost->costHandleTrans->totalCostHandleEwalletAppota))?$dataTable->dataCost->costHandleTrans->totalCostHandleEwalletAppota:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataCost->costDiscount->totalCostDiscountEwalletAppota))?$dataTable->dataCost->costDiscount->totalCostDiscountEwalletAppota:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataCost->totalCost->totalCostEwalletAppota))?$dataTable->dataCost->totalCost->totalCostEwalletAppota:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataReceive->totalAmount->totalReceiveEwalletAppota))?$dataTable->dataReceive->totalAmount->totalReceiveEwalletAppota:'0', '0', '', ',')}}</td>
                            </tr>
                            <tr>
                                <td>Ví điện tử khác</td>
                                <td>{{number_format((isset($dataTable->dataRevenue->raw->dataRevenueOtherEwallet->count_total))?$dataTable->dataRevenue->raw->dataRevenueOtherEwallet->count_total:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataRefund->raw->dataRefundOtherEwallet->count_total))?$dataTable->dataRefund->raw->dataRefundOtherEwallet->count_total:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataHold->raw->dataHoldOtherEwallet->count_total))?$dataTable->dataHold->raw->dataHoldOtherEwallet->count_total:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataUnHold->raw->dataUnHoldOtherEwallet->count_total))?$dataTable->dataUnHold->raw->dataUnHoldOtherEwallet->count_total:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataRevenue->totalAmount->totalAmountRevenueOtherEwallet))?$dataTable->dataRevenue->totalAmount->totalAmountRevenueOtherEwallet:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataRefund->raw->dataRefundOtherEwallet->sum_amount))?$dataTable->dataRefund->raw->dataRefundOtherEwallet->sum_amount:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataHold->raw->dataHoldOtherEwallet->sum_amount))?$dataTable->dataHold->raw->dataHoldOtherEwallet->sum_amount:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataUnHold->raw->dataUnHoldOtherEwallet->sum_amount))?$dataTable->dataUnHold->raw->dataUnHoldOtherEwallet->sum_amount:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataCost->costHandleTrans->totalCostHandleOtherEwallet))?$dataTable->dataCost->costHandleTrans->totalCostHandleOtherEwallet:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataCost->costDiscount->totalCostDiscountOtherEwallet))?$dataTable->dataCost->costDiscount->totalCostDiscountOtherEwallet:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataCost->totalCost->totalCostOtherEwallet))?$dataTable->dataCost->totalCost->totalCostOtherEwallet:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataReceive->totalAmount->totalReceiveOtherEwallet))?$dataTable->dataReceive->totalAmount->totalReceiveOtherEwallet:'0', '0', '', ',')}}</td>
                            </tr>
                            <tr>
                                <td><span style="font-weight: bold;">Tổng</span></td>
                                <td>{{number_format((isset($dataTable->dataRevenue->raw->all->count_total))?$dataTable->dataRevenue->raw->all->count_total:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataRefund->raw->all->count_total))?$dataTable->dataRefund->raw->all->count_total:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataHold->raw->all->count_total))?$dataTable->dataHold->raw->all->count_total:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataUnHold->raw->all->count_total))?$dataTable->dataUnHold->raw->all->count_total:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataRevenue->totalAmount->totalAmountRevenue))?$dataTable->dataRevenue->totalAmount->totalAmountRevenue:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataRefund->raw->all->sum_amount))?$dataTable->dataRefund->raw->all->sum_amount:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataHold->raw->all->sum_amount))?$dataTable->dataHold->raw->all->sum_amount:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataUnHold->raw->all->sum_amount))?$dataTable->dataUnHold->raw->all->sum_amount:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataCost->costHandleTrans->totalCostHandleTrans))?$dataTable->dataCost->costHandleTrans->totalCostHandleTrans:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataCost->costDiscount->totalCostDiscount))?$dataTable->dataCost->costDiscount->totalCostDiscount:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataCost->totalCost->totalCost))?$dataTable->dataCost->totalCost->totalCost:'0', '0', '', ',')}}</td>
                                <td>{{number_format((isset($dataTable->dataReceive->totalAmount->totalReceive))?$dataTable->dataReceive->totalAmount->totalReceive:'0', '0', '', ',')}}</td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="13">
                                    Phí dịch vụ (đã bao gồm VAT) Bên A được hưởng trong kỳ là: {{number_format((isset($dataTable->dataCost->totalCost->totalCost))?$dataTable->dataCost->totalCost->totalCost:'0', '0', '', ',')}} đ
                                </td>
                            </tr>
                            <tr>
                                <td colspan="13">
                                    Số tiền bên A còn phải thanh toán cho Bên B là : {{number_format((isset($dataTable->dataReceive->totalAmount->totalReceive))?$dataTable->dataReceive->totalAmount->totalReceive:'0', '0', '', ',')}} đ
                                </td>
                            </tr>
                            <tr>
                                <td colspan="13">
                                    Biên bản này được thành lập thành 04 bản có giá trị pháp luật như nhau, mỗi bên giữ 02 bản.
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="6">CÔNG TY CỔ PHẦN APPOTAPAY</td>
                                <td colspan="7">PARTNER</td>
                            </tr>
                        </tbody>
                        @endif

                    </table>

</body>
</html>
