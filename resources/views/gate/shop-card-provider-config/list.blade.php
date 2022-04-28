@extends('index')
@section('page-header', 'Shop Card Provider Config')
@section('page-sub-header', 'Shop Card Provider Config')
@section('style')

@endsection
@section('content')
    @livewire('shop-card-provider-config.shop-card-provider-config')
@endsection
@section('script')
    <!--begin::Page Vendors(used by this page) -->


    <!--end::Page Vendors -->

@endsection

@section('scriptlivewire')
    <script src="{{asset('js/shopcardProviderconfig.js')}}"></script>
@endsection
