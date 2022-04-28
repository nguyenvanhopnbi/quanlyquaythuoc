<div class="card-body p-0 pb-3 text-center" id="transaction">
    <table class="table mb-0   w-100" id="table-log-transaction"> 
        <thead class="bg-light ">
        <tr>
            <th scope="col"  class="border-0">Nhà cung cấp</th>
            <th scope="col"  class="border-0">Tổng số giao dịch lỗi</th>
            <th scope="col"  class="border-0">Tổng số giao dịch thành công</th>
            <th scope="col"  class="border-0">Tổng tiền thành công</th>
        </tr>
        </thead>
        <tbody>
            @foreach( $dataTransaction['data'] as $key => $transaction)
            <tr>
                <td>{{ $transaction->vendor_code }}</td>
                <td>{{ $transaction->error_total }}</td>
                <td>{{ $transaction->success_total }}</td>
                <td>{{ $transaction->success_amount }}</td>
            </tr>
            @endforeach
            @if(!empty($dataTransaction['total']))
                @foreach($dataTransaction['total'] as $k => $v)
                    <tr>
                        <td>{{ $k }}</td>
                        <td>{{ $v['total_error'] }}</td>
                        <td>{{ $v['total_success'] }}</td>
                        <td>{{ $v['total_amount_success'] }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
