<table>
    <thead>
        <tr>
            <th>Partner code</th>
            <th>Amount</th>
            <th>Type</th>
            <th>Reason</th>
            <th>Time</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transactions ?? [] as $transaction)
        <tr>
            <td>{{ $transaction->partner_code }}</td>
            <td>{{ number_format($transaction->amount) }}</td>
            <td>{{ $transaction->type === 'credited' ? 'Cộng tiền' : 'Trừ tiền' }}</td>
            <td>{{ $transaction->reason }}</td>
            <td>{{ date('d-m-Y H:i:s', $transaction->timestamp) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>