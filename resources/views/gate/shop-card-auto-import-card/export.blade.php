<div class="card-body p-0 pb-3 text-center" id="transaction">
    <table class="table mb-0   w-100" id="table-log-transaction">
        <thead class="bg-light ">
        <tr>
            <th>Mệnh giá</th>
            <th>Số lượng</th>
            <th>Min card</th>
            <th>Provider</th>
        </tr>
        @foreach($cardByVendors as $k => $v)
            <tr>
                <td><b>{{ $k }}</b>
            </tr>
            @foreach($v as $k_card => $v_card)
                <tr>
                    <td>{{ $k_card }}</td>
                    <td>{{ $v_card['quantity'] }}</td>
                    <td>{{ $v_card['min_card'] }}</td>
                    <td>
                        @foreach($providers as $k_provider => $provider)
                            @if($v_card['provider_id'] == $provider->providerId)
                                {{ $provider->providerCode }}
                                @break
                            @endif
                        @endforeach
                    </td>
                </tr>
            @endforeach
        @endforeach
    </table>
</div>
