@extends('index')
@section('page-header', 'Dashboard Bill Service')
@section('page-sub-header', 'Dashboard Bill Service')
@section('style')

@endsection
@section('content')
    @livewire('gate.bill-service.dashboard')
@endsection

@section('script')
    <!--begin::Page Vendors(used by this page) -->


    <!--end::Page Vendors -->
    <script src="assets/js/pages/crud/forms/widgets/select2.js" type="text/javascript" defer></script>
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript" defer></script>
    <script src="admin/js/pages/gate/topup-dashboard/index.js" type="text/javascript" defer></script>

@endsection

@section('scriptlivewire')

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> --}}



    <script>
        // alert(listday);

        </script>
@endsection
