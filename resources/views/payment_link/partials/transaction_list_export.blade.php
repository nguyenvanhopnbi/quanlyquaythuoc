<div class="card-body p-0 pb-3 text-center" id="transaction">
    <table class="table mb-0   w-100" id="table-log-transaction">
        <thead class="bg-light ">
        <tr>
            <th scope="col" class="border-0">Transaction ID</th>
            <th scope="col" class="border-0">Partner code</th>
            <th scope="col" class="border-0">Số tiền</th>
            <th scope="col" class="border-0">Bank Code</th>
            <th scope="col" class="border-0">Payment Method</th>
            <th scope="col" class="border-0">Vendor Code</th>
            <th scope="col" class="border-0">Ngày giao dịch</th>
            <th scope="col" class="border-0">Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach( $items as $key => $item)
            <tr>
                <td>{{$item['transactionId']}}</td>
                <td>{{$item['partnerCode']}}</td>
                <td>{{$item['amount']}}</td>
                <td>{{$item['transaction']['bankCode'] ?? ''}}</td>
                <td>{{$item['transaction']['paymentMethod'] ?? ''}}</td>
                <td>{{$item['transaction']['vendorCode'] ?? ''}}</td>
                <td>{{!empty($item['transaction']) ? \Carbon\Carbon::createFromTimestamp($item['transaction']['requestTime'])->format('d/m/Y') : ''}}</td>
                <td>{{$item['transaction']['status'] ?? ''}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
