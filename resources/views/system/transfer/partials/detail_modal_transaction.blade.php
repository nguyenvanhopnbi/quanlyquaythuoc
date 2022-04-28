<table class="table">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Mã giao dịch</th>
        <th scope="col">Số tiền chuyển</th>
        <th scope="col">Số tiền đã chuyển</th>
        <th scope="col">Trạng thái</th>
        <th scope="col">Message</th>
    </tr>
    </thead>
    <tbody>
    @if(count($data))
        @foreach($data as $key => $value)
            <tr>
                <th scope="row">{{$value->id}}</th>
                <td>{{$value->appotapay_trans_id}}</td>
                <td>{{$value->amount_text}}</td>
                <td>{{$value->transfer_amount_text}}</td>
                <td class="text-uppercase">{{$value->status}}</td>
                <td>{{$value->message}}</td>
            </tr>
        @endforeach
    @else
        <tr><td colspan="10" align="center">Không có giao dịch</td></tr>
    @endif
    </tbody>
</table>
