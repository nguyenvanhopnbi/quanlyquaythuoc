@extends('index')
@section('page-header', 'Shopcard card')
@section('page-sub_header', 'Xuất CSV card item')
@section('style')
    <link rel="stylesheet" href="admin/plugins/fancybox/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="{{asset('datetimepicker/css/jquery.datetimepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/loading.css')}}">
    <style>
        .table-detail-card-item input{
            margin: 0px;
            padding: 0px;
            border: none;
            background-color: transparent;
            color: #9392a0;
        }
        /*#data-card{
            display: none;
        }*/
    </style>
@endsection
@section('content')
    @livewire('gate.shopcard-item.exportcard')
@endsection
@section('scriptlivewire')
    <script src="{{asset('js/exportcard.js')}}" type="text/javascript" defer></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="{{asset('datetimepicker/js/jquery.datetimepicker.full.min.js')}}"></script>


    <script>
    $('#startTimeSearch').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'Y-m-d H:i:s',
        weeks: true,
        onShow: function(ct){
            this.setOptions({
                maxDate: $('#endTimeSearch').val() ? $('#endTimeSearch').val() : false
            })
        }
    })

    $('#endTimeSearch').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'Y-m-d H:i:s',
        weeks: true,
        onShow: function(ct){
            this.setOptions({
                minDate: $('#startTimeSearch').val() ? $('#startTimeSearch').val() : false
            })
        }
    })
</script>
@endsection
