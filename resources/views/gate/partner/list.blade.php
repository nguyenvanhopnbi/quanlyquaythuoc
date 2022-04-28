@extends('index')
@section('page-header', 'Partner')
@section('page-sub-header', 'Danh sách partner')
@section('style')

@endsection
@section('content')
    @livewire('gate.partner.partner')
@endsection
<script>
    var partnerCode = "{{request()->input('partner_code')}}";
</script>
@section('script')
    <!--begin::Page Vendors(used by this page) -->


    <!--end::Page Vendors -->
    <script src="assets/js/pages/crud/forms/widgets/select2.js" type="text/javascript" defer></script>
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript" defer></script>
    <script src="admin/js/pages/gate/partner/index.js?v=2" type="text/javascript" defer></script>
@endsection
@section('scriptlivewire')
    <script src="{{asset('js/partner.js')}}"></script>
@endsection
