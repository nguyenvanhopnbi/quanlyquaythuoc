<div class="card-body p-0 pb-3 text-center" id="transaction">
    <table class="table mb-0   w-100" id="table-log-transaction"> 
        <thead class="bg-light ">
        <tr>
            <th scope="col"  class="border-0">Transaction Id</th>
            <th scope="col"  class="border-0">Partner code</th>
            <th scope="col"  class="border-0">Partner ref id</th>
            <th scope="col"  class="border-0">Phone number</th>
            <th scope="col"  class="border-0">Amount</th>
            <th scope="col"  class="border-0">Topup value</th>
            <th scope="col"  class="border-0">Topup Status</th>
            <th scope="col"  class="border-0">Telco</th>
            <th scope="col"  class="border-0">Telco Service type</th>
            <th scope="col"  class="border-0">Discont percent</th>
            <th scope="col"  class="border-0">Provider Code</th>
            <th scope="col"  class="border-0">Provider Ref ID</th>
            <th scope="col"  class="border-0">Topup time</th>
        </tr>
        </thead>
        <tbody>
            @foreach( $dataTransaction->data as $key => $transaction)
            <tr>
                <td>{{ $transaction->transaction_id }}</td>
                <td>{{ $transaction->partner_code }}</td>
                <td>{{ $transaction->partner_ref_id }}</td>
                <td>{{ $transaction->phone_number }}</td>
                <td>{{ number_format($transaction->amount, 0, ',', ',') }}</td>
                <td>{{ number_format($transaction->topup_value, 0, ',', ',') }}</td>
                <td>{{ $transaction->topup_status }}</td>
                <td>{{ $transaction->telco }}</td>
                <td>{{ $transaction->telco_service_type }}</td>
                <td>{{ $transaction->discount_percent }}</td>
                <td>{{ $transaction->provider_code }}</td>
                <td>{{ $transaction->provider_ref_id }}</td>
                <td>{{ date('d-m-Y H:i:s',$transaction->topup_time) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
