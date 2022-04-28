<div class="card-body p-0 pb-3 text-center" id="transaction">
    <table class="table mb-0   w-100" id="table-log-transaction"> 
        <thead class="bg-light ">
        <tr>
            <th scope="col"  class="border-0">Transaction ID</th>
            <th scope="col"  class="border-0">Partner code</th>
            <th scope="col"  class="border-0">Product code</th>
            <th scope="col"  class="border-0">Quantity</th>
            <th scope="col"  class="border-0">Amount</th>
            <th scope="col"  class="border-0">Status</th>
            <th scope="col"  class="border-0">Chiết khấu</th>
            <th scope="col"  class="border-0">Vendor</th>
            <th scope="col"  class="border-0">Mệnh giá thẻ</th>
            <th scope="col"  class="border-0">Ngày giao dịch</th>
        </tr>
        </thead>
        <tbody>
            @foreach( $dataTransaction->data as $key => $transaction)
            <tr>
                <td>{{ $transaction->transaction_id }}</td>
                <td>{{ $transaction->partner_code }}</td>
                <td>{{ $transaction->product_code }}</td>
                <td>{{ number_format($transaction->quantity, 0, ',', ',') }}</td>
                <td>{{ number_format($transaction->amount, 0, ',', ',') }}</td>
                <td>{{ $transaction->status }}</td>
                <td>{{ $transaction->discount_percent }}</td>
                <td>{{ $transaction->vendor}}</td>
                <td>{{ $transaction->product_price }}</td>
                <td>{{ date('d-m-Y H:i:s',$transaction->response_time) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
