@extends('index')
@section('page-header', 'Cấu hình phí chi hộ')
@section('page-sub-header', 'Danh sách Cấu hình phí chi hộ')
@section('style')

@endsection
@section('content')
<livewire:gate.transfer-money-config.browse />
@endsection

@section('script')
<script src="/assets/plugins/custom/accounting/accounting.min.js" defer></script>
<script src="/assets/plugins/custom/accounting/simple_money_format.js" defer></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/styles/choices.min.css" />
<script src="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/scripts/choices.min.js"></script>
@endsection