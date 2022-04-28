<div class="card-body p-0 pb-3 text-center" id="transaction">
    <table class="table mb-0   w-100" id="table-log-transaction"> 
        <thead class="bg-light ">
        <tr>
            <th scope="col"  class="border-0">Ref transaction id</th>
            <th scope="col"  class="border-0">Partner ref id</th>
            <th scope="col"  class="border-0">Serial</th>
            <th scope="col"  class="border-0">Value</th>
            <th scope="col"  class="border-0">Vendor</th>
            <th scope="col"  class="border-0">Ngày hết hạn</th>
            <th scope="col"  class="border-0">Ngày tạo</th>
        </tr>
        </thead>
        <tbody>
            @foreach( $dataTransaction->data as $key => $transaction)
            <tr>
                <td>{{ $transaction->ref_transaction_id }}</td>
                <td>{{ $transaction->partner_ref_id }}</td>
                <td>{{ $transaction->serial }}</td>
                <td>{{ number_format($transaction->value, 0, ',', ',') }}</td>
                <td>{{ $transaction->vendor }}</td>
                <td>{{ date('d-m-Y H:i:s',$transaction->expiry) }}</td>
                <td>{{ date('d-m-Y H:i:s',$transaction->timestamp) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
