@extends('index')
@section('page-header', 'Charging list')
@section('page-sub-header', 'Danh sách gạch thẻ AC')
@section('style')

<style>
    .swal2-icon.swal2-error.swal2-icon-show {
        margin: 10px auto;
    }
</style>

@endsection
@section('content')
@livewire('giao-dich-the-ac-charging')
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
<script src="admin/js/pages/charging/transaction/index.js?v=1.1" type="text/javascript" defer></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection
