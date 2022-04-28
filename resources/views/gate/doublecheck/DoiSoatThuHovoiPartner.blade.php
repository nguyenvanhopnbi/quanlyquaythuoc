@extends('index')
@section('page-header', 'Đối soát thu hộ với partner')
@section('page-sub-header', 'Đối soát thu hộ với partner')
@section('style')
    <link rel="stylesheet" href="{{asset('css/loading.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('datetimepicker/css/jquery.datetimepicker.min.css')}}">
@endsection
@section('content')
<livewire:double-check.doi-soat-thu-ho-voi-partner />
@endsection

@section('script')

@endsection

@section('scriptlivewire')
    <script src="{{asset('js/doublecheck.js?v=2')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="{{asset('datetimepicker/js/jquery.datetimepicker.full.min.js')}}"></script>


    <script>
    $('#startTimeSearch').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'Y-m-d H:i:s',
        allowTimes:[
          '00:00:00', '01:00','02:00','03:00','04:00','05:00','06:00','07:00','08:00','09:00','10:00','11:00','12:00', '13:00','14:00', '15:00', '16:00',
          '17:00', '18:00', '19:00', '20:00', '21:00', '22:00','23:00', '23:59'
         ],
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
        allowTimes:[
          '00:00:00', '01:00','02:00','03:00','04:00','05:00','06:00','07:00','08:00','09:00','10:00','11:00','12:00', '13:00','14:00', '15:00', '16:00',
          '17:00', '18:00', '19:00', '20:00', '21:00', '22:00','23:00', '23:59'
         ],
        weeks: true,
        onShow: function(ct){
            this.setOptions({
                minDate: $('#startTimeSearch').val() ? $('#startTimeSearch').val() : false
            })
        }
    })

    $('#TimeSearch').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'Y-m-d',
        weeks: true,

    })


</script>

@endsection
