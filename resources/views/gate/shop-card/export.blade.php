<div class="card-body p-0 pb-3 text-center" id="transaction">
    <table class="table mb-0   w-100" id="table-log-transaction"> 
        <thead class="bg-light ">
        <tr>
            <th scope="col"  class="border-0">Name</th>
            <th scope="col"  class="border-0">Product code</th>
            <th scope="col"  class="border-0">Vendor</th>
            <th scope="col"  class="border-0">Value</th>
            <th scope="col"  class="border-0">Price</th>
            <th scope="col"  class="border-0">Public</th>
            <th scope="col"  class="border-0">Ngày tạo</th>
        </tr>
        </thead>
        <tbody>
            @foreach( $dataTransaction->data as $key => $transaction)
            <tr>
                <td>{{ $transaction->name }}</td>
                <td>{{ $transaction->product_code }}</td>
                <td>{{ $transaction->vendor }}</td>
                <td>{{ number_format($transaction->value, 0, ',', ',') }}</td>
                <td>{{ number_format($transaction->price, 0, ',', ',') }}</td>
                <td>{{ $transaction->public }}</td>
                <td>{{ date('d-m-Y H:i:s',$transaction->createdAt) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
