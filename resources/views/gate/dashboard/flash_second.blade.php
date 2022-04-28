<table class="table table-border">
    <thead class="kt-datatable__head">
        <tr class="kt-datatable__row" style="text-align:center">
            <th>Nhà cung cấp</th>
            <th>Tổng số giao dịch lỗi</th>
            <th>Tổng số giao dịch thành công</th>
            <th>Tổng tiền thành công</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data['data'] as $partnerCode => $partner)
        <tr>
            <td class="kt-datatable__cell; text-center"><div class="kt-user-card-v2__details">{{ !empty($partner->vendor_code) ? $partner->vendor_code : 'Không xác định' }}</div></td>
            <td class="kt-datatable__cell; text-center"><div class="kt-user-card-v2__details">{{$partner->error_total}}</div></td>
            <td class="kt-datatable__cell; text-center"><div class="kt-user-card-v2__details">{{isset($partner->success_total) ? number_format($partner->success_total, 0, ',', '.') : 0 }}</div></td>
            <td class="kt-datatable__cell; text-center"><div class="kt-user-card-v2__details">{{isset($partner->success_amount) ? number_format($partner->success_amount, 0, ',', '.') : 0 }}</div></td>
        </tr>
        @empty
        <tr>
            <td colspan="7" style="text-align: center;">Không có dữ liệu</td>
        </tr>
        @endforelse
        @forelse ($data['total'] as $partnerCode => $partner)
        <tr>
            <td class="kt-datatable__cell; text-center"><div class="kt-user-card-v2__details">{{$partnerCode}}</div></td>
            <td class="kt-datatable__cell; text-center"><div class="kt-user-card-v2__details">{{isset($partner['total_error']) ? number_format($partner['total_error'], 0, ',', '.') : 0 }}</div></td>
            <td class="kt-datatable__cell; text-center"><div class="kt-user-card-v2__details">{{isset($partner['total_success']) ? number_format($partner['total_success'], 0, ',', '.') : 0 }}</div></td>
            <td class="kt-datatable__cell; text-center"><div class="kt-user-card-v2__details">{{isset($partner['total_amount_success']) ? number_format($partner['total_amount_success'], 0, ',', '.') : 0 }}</div></td>
        </tr>
        @empty
        @endforelse
    </tbody>
</table>