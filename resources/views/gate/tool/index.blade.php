@extends('index')
@section('page-header', 'Tool Cập Nhật Giao dịch')
@section('page-sub-header', 'Tool Cập Nhật Giao dịch')
@section('style')

@endsection
@section('content')
    @livewire('gate.tool.tool')
@endsection

@section('scriptlivewire')

<script src="{{asset('js/tool.js')}}"></script>

@endsection
