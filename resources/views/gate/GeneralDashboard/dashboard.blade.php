@extends('index')
@section('page-header', 'Tổng Quan Chung')
@section('page-sub-header', 'Tổng Quan Chung')
@section('style')
<link rel="stylesheet" href="{{asset('css/loading.css')}}">
<link rel="stylesheet" href="{{asset('css/lottery.css')}}">

<link rel="stylesheet" href="{{asset('datetimepicker/css/jquery.datetimepicker.min.css')}}">
<link rel="stylesheet" href="{{asset('Lottery/assets/css/style.css')}}">


<style>


</style>
@endsection
@section('content')
@livewire('gate.general-dashboard.dashboard')
@endsection

@section('scriptsExtra')




@endsection
@section('scriptlivewire')



<!-- JavaScript Bundle with Popper -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="{{asset('datetimepicker/js/jquery.datetimepicker.full.min.js')}}"></script>

<script src='https://themes.getbootstrap.com/wp-content/themes/bootstrap-marketplace/assets/javascript/Chart.min.js'></script>
    <script src='https://themes.getbootstrap.com/wp-content/themes/bootstrap-marketplace/assets/javascript/Chart.bundle.min.js'></script>



<script src="{{asset('js/generalDashboard.js')}}"></script>

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
            var date = new Date($('#startTimeSearch').val());
            date.setDate(date.getDate() + 1);
            this.setOptions({
                minDate: $('#startTimeSearch').val() ? date : false
            })
        }
    })
</script>

@endsection
