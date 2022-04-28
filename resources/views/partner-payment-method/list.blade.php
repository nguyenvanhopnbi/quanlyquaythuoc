@extends('index')
@section('page-header', 'Cấu hình chặn PTTT')
@section('page-sub-header', 'Cấu hình chặn PTTT')
@section('style')
<link rel="stylesheet" href="{{asset('css/loading.css')}}">
<style>
.table{
    margin-top: 40px;
}
.table input{
    border: none;
    background-color: transparent;
}
#listDetailsPartnerMethod input{
    border: none;
    background-color: transparent;
}
</style>
@endsection
@section('content')
    @livewire('gate.partner-method.partner-method')
@endsection
@section('scriptlivewire')
<script src="{{asset('js/partnermethod.js')}}"></script>
@endsection
