@extends('index')
@section('page-header', 'Banks transaction')
@section('page-sub-header', 'Danh sách giao dịch bank')
@section('style')

@endsection
@section('content')
    @livewire('export-form-search')
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
@endsection
