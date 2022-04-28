@extends('index')
@section('page-header', 'History Manager Risk')
@section('page-sub-header', 'History Manager Risk')
@section('style')
<link rel="stylesheet" href="{{asset('css/loading.css')}}">


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{asset('datetimepicker/css/jquery.datetimepicker.min.css')}}">


<style>


input[type=checkbox], label{
    cursor: pointer;
}

.blockCheck{
    z-index: 9999;
}
</style>
@endsection
@section('content')
@livewire('risk.history-manager-risk')
@endsection
@section('scriptlivewire')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="{{asset('datetimepicker/js/jquery.datetimepicker.full.min.js')}}"></script>




<script src="{{asset('js/risk.js')}}"></script>

<script>
    $('#startTimeSearch').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'Y-m-d H:i:s',
        // value: '',
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
        // value: '',
        onShow: function(ct){
            this.setOptions({
                minDate: $('#startTimeSearch').val() ? $('#startTimeSearch').val() : false
            })
        }
    })
</script>

@endsection
