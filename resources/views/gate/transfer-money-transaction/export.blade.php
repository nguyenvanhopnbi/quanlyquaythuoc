<div class="card-body p-0 pb-3 text-center" id="transaction">
    <table class="table mb-0   w-100" id="table-log-transaction"> 
        <thead class="bg-light ">
            <tr>
                <th scope="col" class="border-0">Transaction Id</th>
                <th scope="col" class="border-0">Partner ref id</th>
                <th scope="col" class="border-0">Partner code</th>
                <th scope="col" class="border-0">Application ID</th>
                <th scope="col" class="border-0">Application name</th>
                <th scope="col" class="border-0">Customer phone number</th>
                <th scope="col" class="border-0">Amount</th>
                <th scope="col" class="border-0">Transfer Amount</th>
                <th scope="col" class="border-0">Status</th>
                <th scope="col" class="border-0">Transfer status</th>
                <th scope="col" class="border-0">Thời gian</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $dataTransaction->data as $key => $transaction)
            <tr>
                <td>{{ $transaction->transactionId }}</td>
                <td>{{ $transaction->partnerRefId }}</td>
                <td>{{ $transaction->partnerCode }}</td>
                <td>{{ $transaction->applicationId }}</td>
                <td>{{ $transaction->applicationName }}</td>
                <td>{{ $transaction->customerPhoneNumber }}</td>
                <td>{{ number_format($transaction->amount, 0, ',', ',') }}</td>
                <td>{{ number_format($transaction->transferAmount, 0, ',', ',') }}</td>
                <td>{{ $transaction->status }}</td>
                <td>{{ $transaction->transferStatus }}</td>
                <td>{{ date('d-m-Y H:i:s',$transaction->requestTime) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>