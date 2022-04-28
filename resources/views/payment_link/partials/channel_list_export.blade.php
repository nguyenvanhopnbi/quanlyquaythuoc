<div class="card-body p-0 pb-3 text-center" id="transaction">
    <table class="table mb-0   w-100" id="table-log-transaction">
        <thead class="bg-light ">
        <tr>
            <th scope="col" class="border-0">ID</th>
            <th scope="col" class="border-0">Tên kênh bán</th>
            <th scope="col" class="border-0">Tổng tiền</th>
            <th scope="col" class="border-0">Partner Code</th>
            <th scope="col" class="border-0">Status</th>
            <th scope="col" class="border-0">Ngày tạo</th>
        </tr>
        </thead>
        <tbody>
        @foreach( $items as $key => $item)
            <tr>
                <td>{{$item['application_id']}}</td>
                <td>{{$item['application_name']}}</td>
                <td>{{$item['total_amount']}}</td>
                <td>{{$item['partner_code']}}</td>
                <td>{{$item['status']}}</td>
                <td>{{\Carbon\Carbon::createFromTimestamp($item['created_at'])->format('d/m/Y')}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
