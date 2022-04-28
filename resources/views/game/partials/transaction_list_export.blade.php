<div class="card-body p-0 pb-3 text-center" id="transaction">
    <table class="table mb-0   w-100" id="table-log-transaction">
        <thead class="bg-light ">
        <tr>
            <th scope="col" class="border-0">Transaction ID</th>
            <th scope="col" class="border-0">Order ID</th>
            <th scope="col" class="border-0">Partner code</th>
            <th scope="col" class="border-0">Status</th>
            <th scope="col" class="border-0">Số tiền</th>
            <th scope="col" class="border-0">Gói nạp</th>
            <th scope="col" class="border-0">Gói nạp ID</th>
            <th scope="col" class="border-0">Nhân vật</th>
            <th scope="col" class="border-0">ID Nhân vật</th>
            <th scope="col" class="border-0">Server</th>
            <th scope="col" class="border-0">ID Server</th>
            <th scope="col" class="border-0">Phương thức thanh toán</th>
            <th scope="col" class="border-0">Đã thông báo cho đối tác?</th>
            <th scope="col" class="border-0">Số lần thông báo</th>
            <th scope="col" class="border-0">Thông báo lỗi</th>
            <th scope="col" class="border-0">Ngày giao dịch</th>
        </tr>
        </thead>
        <tbody>
        @foreach( $items as $key => $item)
            <tr>
                <td>{{$item['transaction_id']}}</td>
                <td>{{$item['order_id']}}</td>
                <td>{{$item['partner_code']}}</td>
                <td>{{isset($statuses[$item['status']]) ? $statuses[$item['status']] : $item['status']}}</td>
                <td>{{$item['amount']}}</td>
                <td>{{$item['package_name']}}</td>
                <td>{{$item['package_id']}}</td>
                <td>{{$item['role_name']}}</td>
                <td>{{$item['role_id']}}</td>
                <td>{{$item['server_name']}}</td>
                <td>{{$item['server_id']}}</td>
                <td>{{isset($paymentMethods[$item['payment_method']]) ? $paymentMethods[$item['payment_method']] : $item['payment_method']}}</td>
                <td>{{$item['is_notify'] ? 'Yes': 'No'}}</td>
                <td>{{$item['notify_times']}}</td>
                <td>{{$item['error_message']}}</td>
                <td>{{$item['created_at']}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
