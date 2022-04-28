@extends('index')
@section('page-header', 'Bank vendor')
@section('page-sub_header', 'Cập nhập bank vendor')
@section('style')
    <link rel="stylesheet" href="admin/plugins/fancybox/jquery.fancybox.min.css" />
@endsection
@section('content')
    {{-- @dd($detail); --}}
    @livewire('gate.bank-vendor.edit-vendor', [
        'detail' => $detail
        ])
@endsection
@section('script')
    <script src="admin/js/pages/gate/bank-vendor/edit.js" type="text/javascript" defer></script>
@endsection
