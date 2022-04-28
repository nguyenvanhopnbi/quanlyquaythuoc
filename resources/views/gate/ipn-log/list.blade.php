@extends('index')
@section('page-header', 'Danh sách ipn log')
@section('page-sub-header', 'Danh sách giao ipn log')
@section('style')

@endsection
@section('content')
    <livewire:ipn-logs />
@endsection
@section('script')
    <!--begin::Page Vendors(used by this page) -->


    <!--end::Page Vendors -->
    <script src="assets/js/pages/crud/forms/widgets/select2.js" type="text/javascript" defer></script>
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript" defer></script>
    <script src="admin/js/pages/gate/ipn-log/index.js" type="text/javascript" defer></script>
@endsection
