<div class="card-body p-0 pb-3 text-center" id="transaction">
    <table class="table mb-0   w-100" id="table-log-transaction"> 
        <thead class="bg-light ">
        <tr>
            <th scope="col"  class="border-0">Transaction Id</th>
            <th scope="col"  class="border-0">Partner code</th>
            <th scope="col"  class="border-0">Amount</th>
            <th scope="col"  class="border-0">Balance</th>
            <th scope="col"  class="border-0">Type</th>
            <th scope="col"  class="border-0">Reason</th>
            <th scope="col"  class="border-0">Ngày giao dịch</th>
        </tr>
        </thead>
        <tbody>
            @foreach( $dataTransaction->data as $key => $transaction)
            <tr>
                <td>{{ $transaction->transaction_id }}</td>
                <td>{{ $transaction->partner_code }}</td>
                <td>{{ number_format($transaction->amount, 0, ',', ',') }}</td>
                <td>{{ number_format($transaction->balance, 0, ',', ',') }}</td>
                <td>{{ $transaction->type }}</td>
                <td>{{ $transaction->reason }}</td>
                <td>{{ date('d-m-Y H:i:s',$transaction->timestamp) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
