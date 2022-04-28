@extends('index')
@section('page-header', 'Partner')
@section('page-sub-header', 'Danh sách partner paygate config')
@section('style')

@endsection
@section('content')
    @livewire('gate.pay-gate-config.paygate-config');
@endsection
<script>
    var partnerCode = "{{request()->input('partner_code')}}";
</script>
@section('script')
    <!--begin::Page Vendors(used by this page) -->


    <!--end::Page Vendors -->
    <script src="assets/js/pages/crud/forms/widgets/select2.js" type="text/javascript" defer></script>
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript" defer></script>
    <script src="admin/js/pages/gate/partner-paygate-config/index.js" type="text/javascript" defer></script>
@endsection

@section('scriptlivewire')
    <script src="{{asset('js/paygateconfig.js')}}"></script>
@endsection
