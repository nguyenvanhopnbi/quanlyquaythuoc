<div class="card-body p-0 pb-3 text-center">
    <table class="table mb-0 w-100">
        <thead class="bg-light ">
        <tr>
            <th scope="col" class="border-0">ID</th>
            <th scope="col" class="border-0">Partner Code</th>
            <th scope="col" class="border-0">Order Partner ID</th>
            <th scope="col" class="border-0">Bank code</th>
            <th scope="col" class="border-0">Vendor Code</th>
            <th scope="col" class="border-0">Card Name</th>
            <th scope="col" class="border-0">Card Scheme</th>
            <th scope="col" class="border-0">Card type</th>
            <th scope="col" class="border-0">Status</th>
            <th scope="col" class="border-0">Status 3ds</th>
            <th scope="col" class="border-0">Ngày tạo</th>
        </tr>
        </thead>
        <tbody>
        @foreach( $items as $key => $item)
            <tr>
                <td>{{$item['id']}}</td>
                <td>{{$item['partner_code']}}</td>
                <td>{{$item['order_partner_id']}}</td>
                <td>{{$item['bank_code']}}</td>
                <td>{{$item['vendor_code']}}</td>
                <td>{{$item['card_name']}}</td>
                <td>{{$item['card_scheme']}}</td>
                <td>{{$item['card_type']}}</td>
                <td>{{$item['status']}}</td>
                <td>{{$item['status_3ds']}}</td>
                <td>{{$item['created_at']}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
