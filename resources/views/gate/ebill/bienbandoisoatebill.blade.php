@extends('index')
@section('page-header', 'Đối soát Ebill')
@section('page-sub-header', 'Biên bản đối soát ebill')
@section('style')
    <link rel="stylesheet" href="{{asset('css/loading.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('datetimepicker/css/jquery.datetimepicker.min.css')}}">
    {{-- <link href="{{asset('doisoat/assets/lib/bootstrap/bootstrap.min.css')}}" rel="stylesheet" /> --}}
    <link href="{{asset('doisoat/assets/lib/datepicker.css')}}" rel="stylesheet" />
    <link href="{{asset('doisoat/assets/lib/datatables/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
    <link href="{{asset('doisoat/assets/css/custom.css')}}" rel="stylesheet" />


    <style>
        body{
            font-weight: 400px;
        }
        #table-bienbandoisoat th{
            text-align: center;

        }

        #table-bienbandoisoat tr, th{
            color: #646c9a !important;
        }


    </style>

@endsection
@section('content')
<livewire:gate.ebill.bien-ban-doi-soat />
@endsection

@section('script')

@endsection

@section('scriptlivewire')
    <script src="{{asset('js/doublecheck2.js?v=2')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="{{asset('datetimepicker/js/jquery.datetimepicker.full.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>


@endsection
