<div class="card-body p-0 pb-3 text-center" id="transaction">
    <table class="table mb-0   w-100" id="table-log-transaction"> 
        <thead class="bg-light ">
        <tr>
            <th scope="col"  class="border-0">Transaction Id</th>
            <th scope="col"  class="border-0">Order Id</th>
            <th scope="col"  class="border-0">Partner Code</th>
            <th scope="col"  class="border-0">Amount</th>
            <th scope="col"  class="border-0">Bank code</th>
            <th scope="col"  class="border-0">Application Id</th>
            <th scope="col"  class="border-0">Application Name</th>
            <th scope="col"  class="border-0">Status</th>
            <th scope="col"  class="border-0">Payment method</th>
            <th scope="col"  class="border-0">Payment type</th>
            <th scope="col"  class="border-0">Ngày giao dịch</th>
            <th scope="col"  class="border-0">Response time</th>
            <th scope="col"  class="border-0">Vendor code</th>
            <th scope="col"  class="border-0">Order info</th>
            <th scope="col"  class="border-0">Refund amount</th>
            <th scope="col"  class="border-0">Refund type</th>
            <th scope="col"  class="border-0">Reason</th>
            <th scope="col"  class="border-0">Time refund</th>
        </tr>
        </thead>
        <tbody>
            @foreach( $dataTransaction->data as $key => $transaction)
            <tr>
                <td>{{ $transaction->transaction_id }}</td>
                <td>{{ $transaction->order_id }}</td>
                <td>{{ $transaction->partner_code }}</td>
                <td>{{ number_format($transaction->amount, 0, ',', ',') }}</td>
                <td>{{ $transaction->bank_code }}</td>
                <td>{{ $transaction->application_id }}</td>
                <td>{{ $transaction->application_name }}</td>
                <td>{{ $transaction->status }}</td>
                <td>{{ $transaction->payment_method }}</td>
                <td>{{ $transaction->payment_type }}</td>
                <td>{{ date('d-m-Y H:i:s',$transaction->request_time) }}</td>
                <td>{{ date('d-m-Y H:i:s',$transaction->response_time) }}</td>
                <td>{{ $transaction->vendor_code }}</td>
                <td>{{ $transaction->order_info }}</td>
                <td>{{ number_format($transaction->refund_amount,0, ',', ',') }}</td>
                <td>{{ $transaction->refund_type }}</td>
                <td>{{ $transaction->reason }}</td>
                <td>{{ date('d-m-Y H:i:s',$transaction->time_refund) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
