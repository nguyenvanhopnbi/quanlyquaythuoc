@if($detail)
    <table class="table table-striped table-bordered">
        <tbody>
        <tr>
            <th style="width: 30%">Tài khoản chuyển</th>
            <td>
                <div>{{$detail->account_name_from}}</div>
                <div>{{$detail->account_no_from}}</div>
                <div>{{$detail->bank_code_from}}</div>
            </td>
        </tr>
        <tr>
            <th>Tài khoản nhận</th>
            <td>
                <div>{{$detail->account_name_to}}</div>
                <div>{{$detail->account_no_to}}</div>
                <div>{{$detail->bank_code_to}}</div>
            </td>
        </tr>
        <tr>
            <th>Người tạo lệnh</th>
            <td>{{$detail->email_otp}}</td>
        </tr>
        <tr>
            <th>Tổng tiền</th>
            <td>{{$detail->total_amount_text}}</td>
        </tr>
        <tr>
            <th>Số tiền / 1 lần chuyển</th>
            <td>{{$detail->amount_per_trans_text}}</td>
        </tr>
        <tr>
            <th>Số lần chuyển</th>
            <td>{{$detail->success_times}}</td>
        </tr>
        <tr>
            <th>Số tiền đã chuyển</th>
            <td>{{$detail->amount_transferred}}</td>
        </tr>
        <tr>
            <th>Nội dung chuyển</th>
            <td>{{$detail->content}}</td>
        </tr>
        <tr>
            <th>Tần suất chuyển</th>
            <td>
                {{$detail->schedule_type_text}}
            </td>
        </tr>
        <tr>
            <th>Trạng thái</th>
            <td>
                {{$detail->status_text}}
            </td>
        </tr>
        <tr>
            <th>Hẹn lịch lúc</th>
            <td>
                {{$detail->schedule_at ? $detail->schedule_at : 'Không hẹn'}}
            </td>
        </tr>
        <tr>
            <th>Ngày lên lịch chạy</th>
            <td>
                {{$detail->scheduled_date ? $detail->scheduled_date : ($detail->status === \App\Models\TransferLog::STATUS_PAUSED ? 'Chưa thiết lập' : '')}}
            </td>
        </tr>
        <tr>
            <th>Thời gian tạo</th>
            <td>{{$detail->created_at}}</td>
        </tr>

        </tbody>
    </table>
@endif
