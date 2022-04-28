<div class="card-body p-0 pb-3 text-center" id="transaction">
    <table class="table mb-0   w-100" id="table-log-transaction"> 
        <thead class="bg-light ">
        <tr>
            <th scope="col"  class="border-0">Serial</th>
            <th scope="col"  class="border-0">Vendor</th>
            <th scope="col"  class="border-0">Value</th>
            <th scope="col"  class="border-0">Ngày hết hạn</th>
            <th scope="col"  class="border-0">Sold</th>
            <th scope="col"  class="border-0">Public</th>
            <th scope="col"  class="border-0">Provider</th>
            <th scope="col"  class="border-0">Ngày tạo</th>
        </tr>
        </thead>
        <tbody>
            @foreach( $dataTransaction->data as $key => $transaction)
            <tr>
                <td>{{ $transaction->serial }}</td>
                <td>{{ $transaction->vendor }}</td>
                <td>{{ $transaction->value }}</td>
                <td>{{ $transaction->expiry }}</td>
                <td>{{ $transaction->sold }}</td>
                <td>{{ $transaction->public }}</td>
                <td>{{ $transaction->provider_code }}</td>
                <td>{{ $transaction->createdAt }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
