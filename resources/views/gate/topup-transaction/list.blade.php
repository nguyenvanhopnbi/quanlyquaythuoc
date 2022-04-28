@extends('index')
@section('page-header', 'Topup transaction')
@section('page-sub-header', 'Danh sách giao dịch topup')
@section('style')

@endsection
@section('content')
@livewire('topup-transaction', [
    'providers' => $providers
    ])
@endsection
<script>
    var partnerCode = "{{ request()->input('partner_code') }}";
    var bankCode = "{{ request()->input('bank_code') }}";
    var applicationId = "{{ request()->input('application_id') }}";
</script>
@section('script')
<!--begin::Page Vendors(used by this page) -->


<!--end::Page Vendors -->
<script src="assets/js/pages/crud/forms/widgets/select2.js" type="text/javascript" defer></script>
<script src="assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript" defer></script>
<script src="admin/js/pages/gate/topup-transaction/index.js?v={{ time() }}" type="text/javascript" defer></script>
@endsection
