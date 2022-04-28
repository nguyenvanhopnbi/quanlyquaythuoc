@extends('index')
@section('page-header', 'Qr Code')
@section('page-sub-header', 'Qr Code')
@section('style')

@endsection
@section('content')
@livewire('qr-code')
@endsection
@section('script')
    <!--begin::Page Vendors(used by this page) -->


    <!--end::Page Vendors -->
    <script src="assets/js/pages/crud/forms/widgets/select2.js" type="text/javascript" defer></script>
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript" defer></script>
    <script src="admin/js/pages/gate/shop-card/index.js" type="text/javascript" defer></script>
@endsection
