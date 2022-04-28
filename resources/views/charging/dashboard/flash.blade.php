<table class="table table-border">
    <thead class="kt-datatable__head">
        <tr class="kt-datatable__row" style="text-align:center">
            <th>Partner code</th>
            <th>Tổng số thẻ</th>
            <th>Tống số tiền</th>
            <!-- <th>Tổng số thẻ ngày hôm qua</th>
            <th>Tống số tiền ngày hôm qua</th> -->
        </tr>
    </thead>
    <tbody>
        @forelse ($data->data as $partnerCode => $partner)
        <tr>
            <td class="kt-datatable__cell; text-center"><div class="kt-user-card-v2__details">{{$partner->partner_code}}</div></td>
            <td class="kt-datatable__cell; text-center"><div class="kt-user-card-v2__details">{{isset($partner->ttcard) ? number_format($partner->ttcard, 0, ',', '.') : 0 }}</div></td>
            <td class="kt-datatable__cell; text-center"><div class="kt-user-card-v2__details">{{isset($partner->ttamount) ? number_format($partner->ttamount, 0, ',', '.') : 0 }}</div></td>
        </tr>
        @empty
        <tr>
            <td colspan="7" style="text-align: center;">Không có dữ liệu</td>
        </tr>
        @endforelse
        @forelse ($data->total as $partnerCode => $partner)
        <tr>
            <td class="kt-datatable__cell; text-center"><div class="kt-user-card-v2__details">{{$partnerCode}}</div></td>
            <td class="kt-datatable__cell; text-center"><div class="kt-user-card-v2__details">{{isset($partner->ttcard) ? number_format($partner->ttcard, 0, ',', '.') : 0 }}</div></td>
            <td class="kt-datatable__cell; text-center"><div class="kt-user-card-v2__details">{{isset($partner->amount) ? number_format($partner->amount, 0, ',', '.') : 0 }}</div></td>
        </tr>
        @empty
        @endforelse
    </tbody>
</table>