@extends('index')
@section('page-header', 'Bank vendor')
@section('page-sub_header', 'Thêm mới bank vendor')
@section('style')
    <link rel="stylesheet" href="admin/plugins/fancybox/jquery.fancybox.min.css" />
@endsection
@section('content')
    @livewire('gate.bank-vendor.add-vendor')
@endsection
@section('script')
    <script src="admin/js/pages/gate/bank-vendor/add.js" type="text/javascript" defer></script>
@endsection
