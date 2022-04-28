<div class="card-body p-0 pb-3 text-center">
    <table class="table mb-0 w-100">
        <thead class="bg-light ">
        <tr>
            <th scope="col" class="border-0">Partner Code</th>
            <th scope="col" class="border-0">Tên tài khoản</th>
            <th scope="col" class="border-0">Loại tài khoản - Số tài khoản/Số thẻ</th>
            <th scope="col" class="border-0">Mã ngân hàng</th>
            <th scope="col" class="border-0">Chi nhánh</th>
            <th scope="col" class="border-0">Ngày tạo</th>
        </tr>
        </thead>
        <tbody>
        @foreach( $items as $key => $item)
            <tr>
                <td>{{$item['partner_code']}}</td>
                <td>{{$item['bank_account_name']}}</td>
                <td>[{{$item['bank_account_type_text']}}] {{$item['bank_account_no']}}</td>
                <td>{{$item['bank_code']}}</td>
                <td>{{$item['bank_branch']}}</td>
                <td>{{$item['created_at']}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
