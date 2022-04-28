@extends('index')
@section('page-header', 'Quản lý số dư')
@section('page-sub-header', 'Quản lý số dư')
@section('style')
<link rel="stylesheet" href="{{asset('css/loading.css')}}">
<link rel="stylesheet" href="{{asset('datetimepicker/css/jquery.datetimepicker.min.css')}}">
<style>

</style>
@endsection
@section('content')
@livewire('gate.ebill.quan-ly-so-du-thu-ho')
@endsection
@section('scriptlivewire')

<!-- JavaScript Bundle with Popper -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>





<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="{{asset('datetimepicker/js/jquery.datetimepicker.full.min.js')}}"></script>

<script src="{{asset('js/ebillBank.js')}}"></script>

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
