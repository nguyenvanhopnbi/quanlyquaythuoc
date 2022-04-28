<div class="card-body p-0 pb-3 text-center" id="transaction">
    <table class="table mb-0   w-100" id="table-log-transaction">
        <thead class="bg-light ">
        <tr>
            <th scope="col" class="border-0">Tên khách hàng</th>
            <th scope="col" class="border-0">Email</th>
            <th scope="col" class="border-0">Số điện thoại</th>
            <th scope="col" class="border-0">Địa chỉ</th>
            <th scope="col" class="border-0">Tài khoản thuộc về Partner</th>
            <th scope="col" class="border-0">Ngày tạo</th>
        </tr>
        </thead>
        <tbody>
        @foreach( $items as $key => $item)
            <tr>
                <td>{{$item['customer_name']}}</td>
                <td>{{$item['customer_email']}}</td>
                <td>{{$item['customer_phone']}}</td>
                <td>{{$item['customer_address']}}</td>
                <td>{{$item['partner_code']}}</td>
                <td>{{\Carbon\Carbon::createFromTimestamp($item['created_at'])->format('d/m/Y')}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
