<table>
    <thead>
        <tr>
            <th>Transaction ID</th>
            <th>Partner Code</th>
            <th>Account no</th>
            <th>Bank Code</th>
            <th>Fee</th>
            <th>Status</th>
            <th>Check Status</th>
            <th>Time</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions ?? [] as $item)
        <tr>
            <td>{{ $item->transactionId }}</td>
            <td>{{ $item->partnerCode }}</td>
            <td>{{ $item->accountNo }}</td>
            <td>{{ $item->bankCode }}</td>
            <td>{{ number_format($item->fee ?? 0) }}</td>
            <td>{{ $item->status }}</td>
            <td>{{ $item->checkAccountStatus }}</td>
            <td>{{ Carbon\Carbon::createFromTimestamp($item->requestTime)->format('d-m-Y H:i:s') }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
