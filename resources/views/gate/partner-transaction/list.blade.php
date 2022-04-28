@extends('index')
@section('page-header', 'Partner transaction')
@section('page-sub-header', 'Danh sách giao dịch')
@section('style')

@endsection
@section('content')
    <livewire:export-partner-transaction />
@endsection
<script>
    var partnerCode = "{{ request()->input('partner_code')}}";
</script>
@section('script')
    <!--begin::Page Vendors(used by this page) -->


    <!--end::Page Vendors -->
    <script src="assets/js/pages/crud/forms/widgets/select2.js" type="text/javascript" defer></script>
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript" defer></script>
    <script src="admin/js/pages/gate/partner-transaction/index.js" type="text/javascript" defer></script>
    {{-- <script src="{{asset('js/partnerexport.js')}}"></script> --}}
@endsection
