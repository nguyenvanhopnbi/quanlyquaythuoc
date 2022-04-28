<div class="card-body p-0 pb-3 text-center" id="transaction">
    <table class="table mb-0   w-100" id="table-log-transaction">
        <thead class="bg-light ">
        <tr>
            <th scope="col"  class="border-0">Transaction id</th>
            <th scope="col"  class="border-0">Bill id</th>
            <th scope="col"  class="border-0">Bill code</th>
            <th scope="col"  class="border-0">Account no</th>
            <th scope="col"  class="border-0">Partner code</th>
            <th scope="col"  class="border-0">Amount</th>
            <th scope="col"  class="border-0">Status</th>
            <th scope="col"  class="border-0">Type</th>
            <th scope="col"  class="border-0">Memo</th>
            <th scope="col"  class="border-0">Transaction time</th>
        </tr>
        </thead>
        <tbody>
        @foreach( $dataTransaction->data as $key => $transaction)
            <tr>
                <td>{{ show_to_view($transaction->transaction_id) }}</td>
                <td>{{ show_to_view($transaction->bill_id) }}</td>
                <td>{{ show_to_view($transaction->bill_code) }}</td>
                <td>{{ show_to_view($transaction->account_no) }}</td>
                <td>{{ show_to_view($transaction->partner_code) }}</td>
                <td>{{ show_to_view(number_format($transaction->amount, 0)) }}</td>
                <td>{{ show_to_view($transaction->status) }}</td>
                <td>{{ show_to_view($transaction->type) }}</td>
                <td>{{ show_to_view($transaction->memo) }}</td>
                <td>{{ show_to_view(date('d-m-Y H:i:s',$transaction->transaction_time)) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
