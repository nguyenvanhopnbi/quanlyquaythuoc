@extends('index')
@section('page-header', 'Bill Transaction')
@section('page-sub-header', 'Danh sách Bill Transaction')
@section('style')

@endsection
@section('content')
@livewire('bill.list-bill-transaction')
@endsection
<script>
    var partnerCode = "{{ request()->input('query.partner_code') }}";
</script>
@section('script')
<!--begin::Page Vendors(used by this page) -->


<!--end::Page Vendors -->
<script src="assets/js/pages/crud/forms/widgets/select2.js" type="text/javascript" defer></script>
<script src="assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript" defer></script>
<script src="admin/js/pages/bill/transaction/bill_transaction.js?v1.2" type="text/javascript" defer></script>
@endsection
