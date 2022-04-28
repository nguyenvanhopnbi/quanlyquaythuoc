@extends('index')
@section('page-header', 'Tool Tạo Giao Dịch')
@section('page-sub-header', 'Tool Tạo Giao Dịch')
@section('style')
    <link rel="stylesheet" href="{{asset('css/loading.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('datetimepicker/css/jquery.datetimepicker.min.css')}}">
    <link href="{{asset('doisoat/assets/lib/datepicker.css')}}" rel="stylesheet" />
    <link href="{{asset('doisoat/assets/lib/datatables/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />

@endsection
@section('content')
<livewire:resend-transaction />
@endsection

@section('script')

@endsection

@section('scriptlivewire')
    <script src="{{asset('js/requestMoneyBack.js?v=4')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="{{asset('datetimepicker/js/jquery.datetimepicker.full.min.js')}}"></script>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/read-excel-file@4.x/bundle/read-excel-file.min.js"></script>


    <script>
    $('#start_time').datetimepicker({
        timepicker: true,
        allowTimes:[
          '00:00:00', '01:00','02:00','03:00','04:00','05:00','06:00','07:00','08:00','09:00','10:00','11:00','12:00', '13:00','14:00', '15:00', '16:00',
          '17:00', '18:00', '19:00', '20:00', '21:00', '22:00','23:00', '23:59'
         ],
        datepicker: true,
        format: 'Y-m-d H:i:s',
        weeks: true,
        onShow: function(ct){
            this.setOptions({
                maxDate: $('#end_time').val() ? $('#end_time').val() : false
            })
        }
    })

    $('#end_time').datetimepicker({
        timepicker: true,
        allowTimes:[
          '00:00:00', '01:00','02:00','03:00','04:00','05:00','06:00','07:00','08:00','09:00','10:00','11:00','12:00', '13:00','14:00', '15:00', '16:00',
          '17:00', '18:00', '19:00', '20:00', '21:00', '22:00','23:00', '23:59'
         ],
        datepicker: true,
        format: 'Y-m-d H:i:s',
        weeks: true,
        onShow: function(ct){
            this.setOptions({
                minDate: $('#start_time').val() ? $('#start_time').val() : false
            })
        }
    })


    $('#transaction_time').datetimepicker({
        datepicker: true,
        format: 'Y-m-d H:i:s',
        weeks: true,
        onShow: function(ct){
            this.setOptions({
                // minDate: $('#start_time').val() ? $('#start_time').val() : false
            })
        }
    })

</script>

@endsection
