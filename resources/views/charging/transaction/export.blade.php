<div class="card-body p-0 pb-3 text-center" id="transaction">
    <table class="table mb-0   w-100" id="table-log-transaction"> 
        <thead class="bg-light ">
        <tr>
            <th scope="col"  class="border-0">Mã giao dịch</th>
            <th scope="col"  class="border-0">Mã giao dịch partner</th>
            <th scope="col"  class="border-0">Mệnh giá</th>
            <th scope="col"  class="border-0">Serial</th>
            <th scope="col"  class="border-0">Partner code</th>
            <th scope="col"  class="border-0">Thời gian giao dịch</th>
            <th scope="col"  class="border-0">Trạng thái</th>
        </tr>
        </thead>
        <tbody>
            @foreach( $dataTransaction->data as $key => $transaction)
            <tr>
                <td>{{ $transaction->transaction_id }}</td>
                <td>{{ $transaction->partner_transaction_id }}</td>
                <td>{{ number_format($transaction->amount, 0, ',', ',') }}</td>
                <td>{{ $transaction->serial }}</td>
                <td>{{ $transaction->partner_code }}</td>
                <td>{{ date('d-m-Y H:i:s', $transaction->request_time) }}</td>
                <td>{{ $transaction->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
