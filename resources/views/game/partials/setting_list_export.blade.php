<div class="card-body p-0 pb-3 text-center" id="transaction">
    <table class="table mb-0   w-100" id="table-log-transaction">
        <thead class="bg-light ">
        <tr>
            <th scope="col" class="border-0">Game ID</th>
            <th scope="col" class="border-0">Tên game</th>
            <th scope="col" class="border-0">Kênh bán</th>
            <th scope="col" class="border-0">Partner Code</th>
            <th scope="col" class="border-0">Hoạt động</th>
            <th scope="col" class="border-0">Trạng thái duyệt</th>
            <th scope="col" class="border-0">URL check nhân vật</th>
            <th scope="col" class="border-0">URL lấy danh sách gói nạp</th>
            <th scope="col" class="border-0">URL thông báo kết quả</th>
            <th scope="col" class="border-0">Ngày tạo</th>
        </tr>
        </thead>
        <tbody>
        @foreach( $items as $key => $item)
            <tr>
                <td>{{$item['id']}}</td>
                <td>{{$item['game_name']}}</td>
                <td>{{$item['application_name']}}</td>
                <td>{{$item['partner_code']}}</td>
                <td>{{$item['active'] ? 'Hoạt động' : 'Chưa hoạt động'}}</td>
                <td>{{$item['status_text']}}</td>
                <td>{{$item['role_url']}}</td>
                <td>{{$item['package_url']}}</td>
                <td>{{$item['notify_url']}}</td>
                <td>{{$item['created_at']}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
