@extends('index')
@section('page-header', 'Danh sách virtual account')
@section('page-sub-header', 'Danh sách virtual account')
@section('style')

@endsection
@section('content')
    @livewire('virtual-account.virtual-account')
@endsection
@section('script')
    <!--begin::Page Vendors(used by this page) -->


    <!--end::Page Vendors -->
    <script src="assets/js/pages/crud/forms/widgets/select2.js" type="text/javascript" defer></script>
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript" defer></script>
    <script src="admin/js/pages/gate/virtual-account/index.js" type="text/javascript" defer></script>
@endsection
@section('scriptlivewire')
    <script src="{{asset('js/virtualAccount.js')}}"></script>
@endsection
