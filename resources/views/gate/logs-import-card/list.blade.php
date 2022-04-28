@extends('index')
@section('page-header', 'Logs Danh sách thẻ')
@section('page-sub-header', 'Logs Danh sách thẻ')
@section('style')
    <style>
        .btn-show {
            display: none;
        }

    </style>
@endsection
@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>

            </div>
        </div>
        <div class="container-fluid logs-import-cards">
            <div>
                <livewire:log-search-form />

            </div>
            <div>
            </div>
            <div>
                <table class="table table-bordered kt-datatable__table" style="display: block; overflow-x: auto;" id="log-import-table">
                  <thead class="kt-datatable__head">
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
                  <tbody class="kt-datatable__body ps ps--active-x">
                    @foreach($data->data as $item)
                    <tr class="kt-datatable__row">
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

            @livewire('log-import-card', [
                'page' => $page,
                'pageMax' => $pageMax,
                'pageSize' => $pageSize,
                'total' => $total,
                'part' => $part,
                'startPage' => $startPage,
                'endPage' => $endPage,
                'link' => $link,
                ])

        </div>

    </div>
@endsection
<script>
    var partnerCode = "{{ request()->input('partner_code') }}";
    var bankCode = "{{ request()->input('bank_code') }}";
    var applicationId = "{{ request()->input('application_id') }}";
    var vendorCode = "{{ request()->input('vendor_code') }}";

</script>
@section('script')
<!--begin::Page Vendors(used by this page) -->
<!--end::Page Vendors -->
<script src="assets/js/pages/crud/forms/widgets/select2.js" type="text/javascript" defer></script>
<script src="assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript" defer></script>
<script src="admin/js/pages/gate/bank-transaction/index.js?v1.5" type="text/javascript" defer></script>
<script src="admin/js/pusher.min.js"></script>

<script>
    Livewire.on('eventPusherDownloadExcel', response => {
        var pusher = new Pusher(response.key, {
            cluster: response.cluster
        });

        var channel = pusher.subscribe(response.channelName);
        channel.bind(response.channelEven, function(data) {
            if(data.exportPath === undefined) {
                handleErrorExport();
                return false;
            }
            window.emitEvent('export-ready');
            location.href = data.exportPath;
        });
    })
    function handleErrorExport() {
        window.emitEvent('export-ready');
        $('#select-column-modal').modal('toggle');
        window.emitEvent('notify', {type: 'danger', message: 'Đã có lỗi xảy ra, vui lòng thử lại sau'});
    }
</script>

@endsection

