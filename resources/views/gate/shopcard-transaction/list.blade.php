@extends('index')
@section('page-header', 'Shopcard transaction')
@section('page-sub-header', 'Danh sách giao dịch shopcard')
@section('style')

@endsection
@section('content')
@livewire('shop-card-transaction')
@endsection
@section('script')
    <!--begin::Page Vendors(used by this page) -->


    <!--end::Page Vendors -->
    <script src="assets/js/pages/crud/forms/widgets/select2.js" type="text/javascript" defer></script>
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript" defer></script>
    <script src="admin/js/pages/gate/shopcard-transaction/index.js?v=1.0" type="text/javascript" defer></script>
@endsection
