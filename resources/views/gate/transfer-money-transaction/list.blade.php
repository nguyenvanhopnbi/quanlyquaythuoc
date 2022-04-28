@extends('index')
@section('page-header', 'Dịch Vụ Chi Hộ')
@section('page-sub-header', 'Danh sách giao dịch chi hộ')
@section('style')


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{asset('datetimepicker/css/jquery.datetimepicker.min.css')}}">
<style>
    #tableTransactionEX tr th, td{
        font-size: 1rem;
    }
</style>
@endsection
@section('content')
<livewire:gate.transfer-money-transaction.browse />
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
@section('scriptlivewire')
<script src="{{asset('js/transfermoneytransaction.js')}}"></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="{{asset('datetimepicker/js/jquery.datetimepicker.full.min.js')}}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/29.1.0/classic/ckeditor.js"></script>

    <script>
    $('#Tm_startTime').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'Y-m-d H:i:s',
        weeks: true,
        onShow: function(ct){
            this.setOptions({
                maxDate: $('#Tm_endTime').val() ? $('#Tm_endTime').val() : false
            })
        }
    })

    $('#Tm_endTime').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'Y-m-d H:i:s',
        weeks: true,
        onShow: function(ct){
            this.setOptions({
                minDate: $('#Tm_startTime').val() ? $('#Tm_startTime').val() : false
            })
        }
    })
</script>

@endsection
