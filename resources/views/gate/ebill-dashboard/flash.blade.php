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
{{--    @php dd('dataAll =',$dataAll ) @endphp--}}
        @forelse ($dataAll['data']->data as $key => $partner)
        <tr>
            <td class="kt-datatable__cell; text-center"><div class="kt-user-card-v2__details">{{show_to_view($partner->partner_code)}}</div></td>
            <td class="kt-datatable__cell; text-center"><div class="kt-user-card-v2__details">{{isset($partner->totalTransaction) ? number_format($partner->totalTransaction, 0, ',', '.') : 0 }}</div></td>
            <td class="kt-datatable__cell; text-center"><div class="kt-user-card-v2__details">{{isset($partner->ttamount) ? number_format($partner->ttamount, 0, ',', '.') : 0 }}</div></td>
        </tr>
        @empty
        <tr>
            <td colspan="7" style="text-align: center;">Không có dữ liệu</td>
        </tr>
        @endforelse
        @if($dataAll['total']['totalTransaction'])
        <tr>
            <td class="kt-datatable__cell; text-center"><div class="kt-user-card-v2__details">Tất cả</div></td>
            <td class="kt-datatable__cell; text-center"><div class="kt-user-card-v2__details">{{isset($dataAll['total']['totalTransaction']) ? number_format($dataAll['total']['totalTransaction'], 0, ',', '.') : 0 }}</div></td>
            <td class="kt-datatable__cell; text-center"><div class="kt-user-card-v2__details">{{isset($dataAll['total']['amount']) ? number_format($dataAll['total']['amount'], 0, ',', '.') : 0 }}</div></td>
        </tr>
        @endif
    </tbody>
</table>
