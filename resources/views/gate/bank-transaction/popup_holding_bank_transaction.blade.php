@extends('index')
@section('page-header', 'Banks transaction holding')
@section('page-sub-header', 'Holding transaction')
@section('style')

<style>
    .swal2-icon.swal2-error.swal2-icon-show{
        margin: 10px auto;
    }
</style>

@endsection
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

<!-- begin:: Subheader -->
<div class="kt-subheader kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                Holding bank transaction </h3>
        </div>
    </div>
</div>

<!-- end:: Subheader -->

<!-- begin:: Content -->
@livewire('popup-holding-transaction', [
    'detail' => $detail
    ])


<!-- end:: Content -->
</div>

@endsection
@section('script')

@endsection
@section('scriptlivewire')
<script src="{{asset('js/popupholding.js')}}"></script>
@endsection


