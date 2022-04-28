<!DOCTYPE html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,">
    <title>Report - AppotaCard</title>
</head>

<body marginwidth="0" marginheight="0" offset="0" topmargin="0" leftmargin="0">
    <table
        style="border: 1px solid #cccccc;border-collapse: collapse; width: 640px; font-size:14px; font-family:Arial; color: #666666; background: #f5f5f5; margin-bottom:24px;">
        <colgroup>
            <col style="width: 124px">
            <col style="width: 124px">
            <col style="width: 124px">
            <col style="width: 124px">
            <col style="width: 124px">
            <col style="width: 124px">
        </colgroup>
        <tr>
            <th colspan="3" style="padding: 28px 0; background-color: #449D47;">
                <img src="https://vi.appota.com/images/appota-wallet.png" alt="appotacard" width="270" height="70">
            </th>
            <th colspan="3" style="
                text-align: right;
                padding-right: 20px;
                line-height: 22px;
            ">
                <h3>
                    <p style="text-align:center" color="#0086ff"> Thống Kê Thẻ Đã Nhập </p>
                    <p style="text-align:center">{{ $start }} - {{ $end }}</p>
                </h3>
            </th>
        </tr>
        <tr style="border: 1px solid #cccccc;background-color:#0095da; color:#fff; ">
            <th style="border: 1px solid #cccccc; padding: 18px 0">Tên thẻ</th>
            <th style="border: 1px solid #cccccc; padding: 18px 0">Mệnh giá</th>
            @foreach ($imported
            ->flatten(1)
            ->pluck('provider_code')
            ->unique()
            as $provider)
            <th style="border: 1px solid #cccccc; padding: 18px 0">{{ $provider }}</th>
            @endforeach
            <th style="border: 1px solid #cccccc; padding: 18px 0">Tổng nhập</th>
        </tr>
        @foreach ($imported as $groupKey => $groupItem)
        <tr style="border: 1px solid #cccccc;">
            <td style="text-align:center;border: 1px solid #cccccc; padding: 18px 0">{{ $groupKey }}</td>
            <td style="text-align:center;border: 1px solid #cccccc; padding: 18px 0">
                {{ number_format($groupItem->first()['value']) }}</td>
            @foreach ($imported
            ->flatten(1)
            ->pluck('provider_code')
            ->unique()
            as $provider)
            <td style="text-align:center;border: 1px solid #cccccc; padding: 18px 0">
                {{ $groupItem->where('provider_code', $provider)->first()['total'] ?? 0 }}</td>
            @endforeach
            <td style="text-align:center;border: 1px solid #cccccc; padding: 18px 0">{{ $groupItem->sum('total') }}</td>
        </tr>
        @endforeach


    </table>

    <table
        style="border: 1px solid #cccccc;border-collapse: collapse; width: 640px; font-size:14px; font-family:Arial; color: #666666; background: #f5f5f5; margin-bottom:24px;">
        <colgroup>
            <col style="width: 124px">
            <col style="width: 124px">
            <col style="width: 124px">
        </colgroup>
        <tr>
            <th colspan="1" style="padding: 28px 0; background-color: #449D47;">
                <img src="https://vi.appota.com/images/appota-wallet.png" alt="appotacard" width="270" height="70">
            </th>
            <th colspan="2" style="
                text-align: right;
                padding-right: 20px;
                line-height: 22px;
            ">
                <h3>
                    <p style="text-align:center" color="#0086ff"> Thống Kê Thẻ Đã Bán </p>
                    <p style="text-align:center">{{ $start }} - {{ $end }}</p>
                </h3>
            </th>
        </tr>
        <tr style="border: 1px solid #cccccc;background-color:#0095da; color:#fff; ">
            <th style="border: 1px solid #cccccc; padding: 18px 0">Tên thẻ</th>
            <th style="border: 1px solid #cccccc; padding: 18px 0">Mệnh giá</th>
            <th style="border: 1px solid #cccccc; padding: 18px 0">Tổng xuất</th>
        </tr>
        @foreach ($sold as $groupKey => $groupItem)
        <tr style="border: 1px solid #cccccc;">
            <td style="text-align:center;border: 1px solid #cccccc; padding: 18px 0">{{ $groupKey }}</td>
            <td style="text-align:center;border: 1px solid #cccccc; padding: 18px 0">
                {{ number_format($groupItem['value']) }}</td>
            <td style="text-align:center;border: 1px solid #cccccc; padding: 18px 0">{{ $groupItem['total'] }}</td>
        </tr>
        @endforeach
    </table>

    <table
        style="border: 1px solid #cccccc;border-collapse: collapse; width: 640px; font-size:14px; font-family:Arial; color: #666666; background: #f5f5f5; margin-bottom:24px;">
        <colgroup>
            <col style="width: 124px">
            <col style="width: 124px">
            <col style="width: 124px">
            <col style="width: 124px">
            <col style="width: 124px">
            <col style="width: 124px">
        </colgroup>
        <tr>
            <th colspan="3" style="padding: 28px 0; background-color: #449D47;">
                <img src="https://vi.appota.com/images/appota-wallet.png" alt="appotacard" width="270" height="70">
            </th>
            <th colspan="3" style="
                text-align: right;
                padding-right: 20px;
                line-height: 22px;
            ">
                <h3>
                    <p style="text-align:center" color="#0086ff"> Thống Kê Thẻ Đã Bán </p>
                    <p style="text-align:center">{{ $start }} - {{ $end }}</p>
                </h3>
            </th>
        </tr>
        <tr style="border: 1px solid #cccccc;background-color:#0095da; color:#fff; ">
            <th style="border: 1px solid #cccccc; padding: 18px 0">Tên thẻ</th>
            <th style="border: 1px solid #cccccc; padding: 18px 0">Mệnh giá</th>
            <th style="border: 1px solid #cccccc; padding: 18px 0">Tồn đầu kỳ</th>
            <th style="border: 1px solid #cccccc; padding: 18px 0">Tổng nhập trong kỳ</th>
            <th style="border: 1px solid #cccccc; padding: 18px 0">Tổng bán trong kỳ</th>
            <th style="border: 1px solid #cccccc; padding: 18px 0">Tồn cuối kỳ</th>
        </tr>
        @foreach ($redundancies as $groupKey => $groupValue)
        <tr style="border: 1px solid #cccccc;">
            <td style="text-align:center;border: 1px solid #cccccc; padding: 18px 0">{{ $groupKey }}</td>
            <td style="text-align:center;border: 1px solid #cccccc; padding: 18px 0"></td>
            <td style="text-align:center;border: 1px solid #cccccc; padding: 18px 0">
                {{ $groupValue['old']['total'] ?? 0 }}</td>
            <td style="text-align:center;border: 1px solid #cccccc; padding: 18px 0">{{ $groupValue['imported'] ?? 0 }}
            </td>
            <td style="text-align:center;border: 1px solid #cccccc; padding: 18px 0">
                {{ $groupValue['sold']['total'] ?? 0 }}</td>
            <td style="text-align:center;border: 1px solid #cccccc; padding: 18px 0">
                {{ $groupValue['current']['total'] ?? 0 }}
            </td>
        </tr>
        @endforeach
    </table>
</body>

</html>