<div class="card-body p-0 pb-3 text-center" id="transaction">
    <table class="table mb-0   w-100" id="table-log-transaction">
        <thead class="bg-light ">
        <tr class="kt-datatable__row">
            <th scope="col">ID</th>
            <th scope="col">Transaction ID</th>
            <th scope="col">Vendor</th>
            <th scope="col">Value</th>
            <th scope="col">Quantity</th>
            <th scope="col">Discount Percent</th>
            <th scope="col">Provider ID</th>
            <th scope="col">Provider Name</th>
            <th scope="col">Method</th>
            <th scope="col">Status</th>
            <th scope="col">Time</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data->data as $item)
            <tr>
                <td scope="row">{{$item->id}}</td>
                <td>{{$item->transaction_id}}</td>
                <td>{{$item->vendor}}</td>
                <td>{{$item->value}}</td>
                <td>{{$item->quantity}}</td>
                <td>{{$item->discount_percent}}</td>
                <td>{{$item->provider_id}}</td>
                <td>{{$item->provider_name}}</td>
                <td>{{$item->method}}</td>
                <td>{{$item->status}}</td>
                <td>{{$item->timestamp}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
