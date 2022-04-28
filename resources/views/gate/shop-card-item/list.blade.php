@extends('index')
@section('page-header', 'Danh sách item thẻ')
@section('page-sub-header', 'Danh sách item thẻ')
@section('style')

@endsection
@section('content')
    @livewire('shop-card-item')
@endsection
@section('script')
    <!--begin::Page Vendors(used by this page) -->


    <!--end::Page Vendors -->
    <script src="assets/js/pages/crud/forms/widgets/select2.js" type="text/javascript" defer></script>
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript" defer></script>
    <script src="admin/js/pages/gate/shop-card-item/index.js?v={{ time() }}" type="text/javascript" defer></script>
@endsection
